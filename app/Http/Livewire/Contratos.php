<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Pendiente;
use Carbon\Carbon;

class Contratos extends Component
{
<<<<<<< HEAD
    public $fecha, $nroContrato, $busqueda, $cliente_sel, $cliente_id,
        $monto, $tasa, $periodo = "mensual", $mto, $plazo, $garantia;
=======
>>>>>>> 97f0ab136d9e017bdafe642c6be5532bf5b6c489
    public $periodos = [
        'diario', 'semanal', 'mensual', 'bimensual', 'trimestral', 'semestral', 'anual'
    ];

    public function render()
    {
        return view('livewire.contratos', [
            'clientes' => Cliente::get(),
        ]);
    }

<<<<<<< HEAD
    public function contratos()
    {
      $this->validate(
          [
            'fecha' =>'required|date',
            'nroContrato' =>'required|min:1',
            'cliente_id' =>'required|numeric',
            'monto'=>'required|numeric',
            'mto'=>'required|numeric',
            'tasa'=>'required|numeric',
            'periodo'=>'required|min:4',
            'plazo'=>'required|numeric',
            'garantia'=>'required|min:4',
          ]);

          dd('validate');

     $contrato = Contrato::updateOrCreate(['id' => $this->contrato_id],
       []

    );
=======
    public $fecha, $nroContrato, $busqueda, $cliente_sel, $cliente_id,
        $monto, $tasa, $periodo = 'mensual', $mto, $plazo, $garantia, $contrato_id;
    public $intereses, $monto_mto, $total, $cuotas, $status;

    public function mount()
    {
        $fecha = Carbon::now();
        $this->fecha = $fecha->format('Y-m-d');
    }

    public function contratos()
    {
        $this->validate([
            'fecha'         => 'required|date',
            'nroContrato'   => 'required|min:1',
            'cliente_id'    => 'required|numeric',
            'monto'         => 'required|numeric',
            'mto'           => 'required|numeric',
            'tasa'          => 'required|numeric',
            'plazo'         => 'required|numeric',
            'garantia'      => 'required|min:4',
        ]);
        $this->sistemaFrances();
        $this->amortizacion();
        dd($this->tablaAmortizacion);
        $contrato = Contrato::updateOrCreate(
            ['id' => $this->contrato_id],
            [
                'fecha'             => $this->fecha,
                'numero'            => $this->nroContrato,
                'cliente_id'        => $this->cliente_id,
                'monto_prestamo'    => $this->monto,
                'tasa'              => $this->tasa,
                'monto_interes'     => $this->intereses,
                'mto'               => $this->mto,
                'monto_total'       => $this->total,
                'garantia'          => $this->garantia,
                'cuotas'            => $this->cuotas,
                'plazo'             => $this->plazo,
                'periodo'           => $this->periodo,
                'mantenimiento'     => $this->monto_mto,
            ]
        );
        $this->contrato_id = $contrato->id;
    }

    public function tblPendientes()
    {
        foreach ($this->tablaAmortizacion as $cuota) {
            Pendiente::updateOrCreate(['contrato_id' => $this->contrato_id], [
                'fecha_contrato' => $cuota->fecha_contrato,
                'contrato_id' => $this->contrato_id,
                'fecha_cuota' => $cuota->fecha_cuota,
                'monto' => $cuota->cuota
            ]);
        }
    }

    public $fechaPago, $tablaAmortizacion;
    public function amortizacion()
    {
        $this->fechaPago = Carbon::createFromDate($this->fecha);
        $monto = $this->monto;

        for ($i = 0; $i < $this->plazo; $i++) {
            switch ($this->periodo) {
                case 'mensual':
                    $this->fechaPago = $this->fechaPago->addMonth();
                    break;
                case 'bimestral':
                    $this->fechaPago = $this->fechaPago->addMonths(2);
                    break;
                case 'trimestral':
                    $this->fechaPago = $this->fechaPago->addMonths(3);
                    break;
                case 'semestral':
                    $this->fechaPago = $this->fechaPago->addMonths(6);
                    break;
                case 'anual':
                    $this->fechaPago = $this->fechaPago->addYear();
                    break;
                case 'semanal':
                    $this->fechaPago = $this->fechaPago->addWeek();
                    break;
                case 'diario':
                    $this->fechaPago = $this->fechaPago->addDay();
                    break;
            }

            $this->tablaAmortizacion[$i] = [
                'fecha_contrato'    => $this->fecha,
                'fecha_cuota'       => $this->fechaPago->format('d-m-Y'),
                'cuota'             => $this->cuotas, //21517.02
                'interes'           => $interes = $monto * ($this->tasa / 12 / 100), //3.333,33
                'intereses'         => $this->intereses = $this->intereses + $interes,
                'mto'               => $monto_mto = $monto * ($this->mto  / 100), //5000
                'monto_mto'         => $this->monto_mto = $this->monto_mto + $monto_mto,
                'monto'             => $monto = $monto - ($this->cuotas - $interes - $monto_mto),
            ];
        }
    }

    public function sistemaFrances()
    {
        $tasaE = $this->tasa / 100;
        $tasaEMto = $this->mto * 12 / 100;
        //suma de tasas
        $tasaTotal = $tasaE + $tasaEMto;

        switch ($this->periodo) {
            case 'diario':
                $tasaTotal = $tasaTotal / 360;
                $tasaE = $tasaE / 360;
                break;
            case 'semanal':
                $tasaTotal = $tasaTotal / 52;
                $tasaE = $tasaE / 52;
                break;
            case 'mensual':
                $tasaTotal = $tasaTotal / 12;
                $tasaE = $tasaE / 12;
                break;
            case 'bimensual':
                $tasaTotal = $tasaTotal / 6;
                $tasaE = $tasaE / 6;
                break;
            case 'trimestral':
                $tasaTotal = $tasaTotal / 4;
                $tasaE = $tasaE / 4;
                break;
            case 'semestral':
                $tasaTotal = $tasaTotal / 2;
                $tasaE = $tasaE / 2;
                break;
        }
        //denominador 1-(1+i)-n
        $denominador = 1 - pow((1 + floatval($tasaTotal)), -intval($this->plazo));
        //factor = i / denominador
        $factor = floatval($tasaTotal) / floatval($denominador);
        // cuota =  monto * factor
        $this->cuotas = floatval($this->monto) * floatval($factor);
        $this->total = $this->cuotas * $this->plazo;
>>>>>>> 97f0ab136d9e017bdafe642c6be5532bf5b6c489
    }
}
