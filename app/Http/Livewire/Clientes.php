<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Cliente;
use App\Models\Fiador;
use Illuminate\Support\Facades\Storage;


class Clientes extends Component
{
    use WithFileUploads;
    public $cliente_id, $dni, $nombres_apellidos, $direccion, $telefono, $email, $sexo, $nivel_academico, $estado_civil,
        $fecha_nacimiento, $profesion, $departamento, $municipio, $manejarPic = false, $editando = false,
        $eliminando = false, $foto, $imagen, $nombre_foto;

    public $sexos = [
        'f' => 'Femenino',
        'm' => 'Masculino',
        'o' => 'Otro',
    ];

    public $nivel_academicos = [
        'Básico',
        'Secundaria',
        'Técnico',
        'Universitario',
        'Máster',
        'Doctorado',
    ];

    public $estado_civiles = [
        'a' => 'Ajuntado',
        's' => 'Soltero',
        'c' => 'Casado',
        'd' => 'Divorciado',
        'v' => 'Viudo',
    ];

    protected $rules = [
        'dni' => 'required|min:8',
        'nombres_apellidos' => 'required|min:8',
        'sexo' => 'required',
        'fecha_nacimiento' => 'required|date',
        'email' => 'required|email',
        'telefono' => 'required|min:8',
        'direccion' => 'required|min:4',
        'departamento' => 'required|min:4',
        'municipio' => 'required|min:4',
        'nivel_academico' => 'required|min:4',
        'profesion' => 'required|min:4',
        'estado_civil' => 'required',
    ];


    public function render()
    {
        return view('livewire.clientes', [
            'clientes' => Cliente::with(['contratos', 'contratos.pendientes'])->get(),
        ]);
    }

    public function resetCliente()
    {
        $this->reset([
            'editando',
            'cliente_id',
            'dni',
            'nombres_apellidos',
            'sexo',
            'fecha_nacimiento',
            'email',
            'telefono',
            'direccion',
            'departamento',
            'municipio',
            'nivel_academico',
            'profesion',
            'estado_civil',
            'foto', 'imagen'
        ]);
    }

    public $pic = true, $fiador_id;

    public function cOEPic()
    {
        $this->validate();
        $ente = [
            'dni' => $this->dni,
            'nombres_apellidos' => $this->nombres_apellidos,
            'fecha_nac' => $this->fecha_nacimiento,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'departamento' => $this->departamento,
            'municipio' => $this->municipio,
            'sexo' => $this->sexo,
            'nivel_academico' => $this->nivel_academico,
            'profesion' => $this->profesion,
            'estado_civil' => $this->estado_civil,
        ];

        if ($this->pic) {
            $cliente = Cliente::updateOrCreate(['id' => $this->cliente_id], $ente);
            $this->cliente_id = $cliente->id;
            $this->manejarPic = false;
        } else {
            $fiador = Fiador::updateOrCreate(['id' => $this->fiador_id], $ente);
            $this->fiador_id = $fiador->id;
            $this->manejarPic = false;
        }

        // solo si existe foto
        if ($this->editando && $cliente->imagen) {
            $this->eliminar_foto($cliente->imagen);
        }

        if ($this->foto) {
            $this->guardar_foto();
            $cliente->update(['imagen' => $this->nombre_foto]);
        }

        session()->flash('message', $this->pic ? ($this->editando ? 'Cliente Editado Con Éxito' : 'Cliente Creado Con Éxito') : ($this->editando ? 'Fiador Editado Con Éxito' : 'Fiador Creado Con Éxito'));
        $this->resetCliente();
    }

    public function seleccionar($id)
    {
        $this->editando = true;

        if ($this->pic) {
            $ente = Cliente::whereId($id)->first();
            $this->cliente_id = $ente->id;
        } else {
            $ente = Fiador::whereId($id)->first();
            $this->fiador_id = $ente->id;
        }

        $this->dni = $ente->dni;
        $this->nombres_apellidos = $ente->nombres_apellidos;
        $this->fecha_nacimiento = $ente->fecha_nac;
        $this->direccion = $ente->direccion;
        $this->telefono = $ente->telefono;
        $this->email = $ente->email;
        $this->departamento = $ente->departamento;
        $this->municipio = $ente->municipio;
        $this->sexo = $ente->sexo;
        $this->nivel_academico = $ente->nivel_academico;
        $this->profesion = $ente->profesion;
        $this->estado_civil = $ente->estado_civil;
        $this->imagen = $ente->imagen;
        $this->manejarPic = true;
    }

    public function confirmar($id)
    {
        $this->eliminando = true;

        if ($this->pic) {
            $this->cliente_id = $id;
        } else {
            $this->fiador_id = $id;
        }
    }

    public function eliminar()
    {
        if ($this->pic) {
            $cliente = Cliente::whereId($this->cliente_id)->first(['id', 'imagen']);
            if ($cliente->imagen) {
                $this->eliminar_foto($cliente->imagen);
            }
            Cliente::destroy($this->cliente_id);
        } else {
            Fiador::destroy($this->fiador_id);
        }

        session()->flash('message', 'Cliente Eliminado Con Éxito');
        $this->eliminando = false;
    }

    public function guardar_foto()
    {

        $this->validate([
            'foto' => 'image|max:1024'
        ]);
        $this->nombre_foto = $this->foto->getClientOriginalName();
        $this->foto->storeAs('imagenes/clientes', $this->nombre_foto);
    }

    public function eliminar_foto($nombre)
    {

        if (Storage::disk('local')->exists("imagenes/clientes/$nombre")) {
            $ruta = public_path("imagenes/clientes/$nombre");
            unlink($ruta);
        }
    }
}
