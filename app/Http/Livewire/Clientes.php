<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;


class Clientes extends Component
{
    use WithFileUploads;
    public $cliente_id, $dni, $nombres_apellidos, $direccion, $telefono, $email, $sexo, $nivel_academico, $estado_civil,
        $fecha_nacimiento, $profesion, $departamento, $municipio, $crearCliente = false, $editando = false,
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

    public function cOECliente()
    {
        $this->validate();
        $cliente = Cliente::updateOrCreate(['id' => $this->cliente_id], [
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
        ]);
        $this->cliente_id = $cliente->id;
        $this->crearCliente = false;

        if ($this->editando && $cliente->imagen) {
            $this->eliminar_foto($cliente->imagen);
        }

        if ($this->foto) {
            $this->guardar_foto();
            $cliente->update(['imagen' => $this->nombre_foto]);
        }

        session()->flash('message', $this->editando ? 'Cliente Editado Con Éxito' : 'Cliente Creado Con Éxito');
        $this->resetCliente();
    }

    public function seleccionar($id)
    {
        $this->editando = true;
        $cliente = Cliente::whereId($id)->first();
        $this->cliente_id = $cliente->id;
        $this->dni = $cliente->dni;
        $this->nombres_apellidos = $cliente->nombres_apellidos;
        $this->fecha_nacimiento = $cliente->fecha_nac;
        $this->direccion = $cliente->direccion;
        $this->telefono = $cliente->telefono;
        $this->email = $cliente->email;
        $this->departamento = $cliente->departamento;
        $this->municipio = $cliente->municipio;
        $this->sexo = $cliente->sexo;
        $this->nivel_academico = $cliente->nivel_academico;
        $this->profesion = $cliente->profesion;
        $this->estado_civil = $cliente->estado_civil;
        $this->imagen = $cliente->imagen;
        $this->crearCliente = true;
    }

    public function confirmar($id)
    {
        $this->eliminando = true;
        $this->cliente_id = $id;
    }

    public function eliminar()
    {
        $cliente = Cliente::whereId($this->cliente_id)->first(['id', 'imagen']);
        if ($cliente->imagen) {
            $this->eliminar_foto($cliente->imagen);
        }
        Cliente::destroy($this->cliente_id);
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
