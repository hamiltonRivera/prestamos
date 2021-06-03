<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Calculadora extends Component
{
    public $capital, $tasa, $plazo, $sistema, $periodo, $cuota, $tCea, $saldo, $calculado = false, 
        $intereses, $tablaAmortizacion = [], $mto, $mtoEf, $mtoValor, $fecha, $fechaPago;
    public $sistemas = [
        'frances',
        'aleman',
        'americano',
    ];
    public $periodos = [
        'Mensual',
        'Bimestral',
        'Trimestral',
        'Semestral',
        'Anual',
        'Semanal',
        'Diario'
    ];
    public function render()
    {
        return view('livewire.calculadora');
    }
    public function seleccionarSistema(){
        $this->validate([
            'sistema' => 'required|min:5',
            'periodo' => 'required|min:5',
            'capital' => 'required|numeric',
            'tasa' => 'required|numeric',
            'mto' => 'required|numeric',
            'plazo' => 'required|numeric',
        ]);
        //tCea
        switch ($this->periodo) {
            case 'Mensual':
                $this->tCea = $this->tasa  / 100 / 12;
                $this->mtoEf = $this->mto  / 100;
                break;
            case 'Bimestral':
                $this->tCea = $this->tasa / 100 / 6;
                $this->mtoEf = $this->mto / 100 * 2;
                break;
            case 'Trimestral':
                $this->tCea = $this->tasa  / 100 / 4;
                $this->mtoEf = $this->mto  / 100 * 3;
                break;
            case 'Semestral':
                $this->tCea = $this->tasa / 100 / 2;
                $this->mtoEf = $this->mto / 100 * 6;
                break;
            case 'Anual':
                $this->tCea = $this->tasa / 100;
                $this->mtoEf = $this->mto / 100 * 12;
                break;
            case 'Semanal':
                $this->tCea = $this->tasa  / 100 / 52;
                $this->mtoEf = $this->mto  / 100 / 30 * 7;
                break;
            case 'Diario':
                $this->tCea = $this->tasa  / 100 / 360;
                $this->mtoEf = $this->mto  / 100 / 30;
                break;
        }

        //seleccionar sistema de cálculo
        switch ($this->sistema) {
            case 'frances':
                $this->sistemaFrances();
                break;
            case 'aleman':
                $this->sistemaAleman();
                break;
            case 'americano':
                $this->sistemaAmericano();
                break;
        }
    }
    //sistema francés
    public function sistemaFrances(){
        // a= Co * ( i / 1 - ( 1 + i ) -n)
        $this->fechaPago = Carbon::createFromDate($this->fecha);
        
        $this->tCea = $this->tCea + $this->mtoEf;
        $this->saldo = $this->capital;
        $denominador = 1 - pow( 1 + $this->tCea, -$this->plazo);
        $this->cuota = $this->capital * ( $this->tCea / $denominador);
        for ($i=0; $i < $this->plazo; $i++) { 
            switch ($this->periodo) {
                case 'Mensual':
                    $this->fechaPago = $this->fechaPago->addMonth();
                    break;
                case 'Bimestral':
                    $this->fechaPago = $this->fechaPago->addMonths(2);
                    break;
                case 'Trimestral':
                    $this->fechaPago = $this->fechaPago->addMonths(3);
                    break;
                case 'Semestral':
                    $this->fechaPago = $this->fechaPago->addMonths(6);
                    break;
                case 'Anual':
                    $this->fechaPago = $this->fechaPago->addYear();
                    break;
                case 'Semanal':
                    $this->fechaPago = $this->fechaPago->addWeek();
                    break;
                case 'Diario':
                    $this->fechaPago = $this->fechaPago->addDay();
                    break;
            }
            
            $this->tablaAmortizacion [$i] = [
            'fechaPago' => $this->fechaPago->format('d-m-Y'),
            'interes' => $this->intereses = $this->saldo * ($this->tCea - $this->mtoEf),
            'mtoValor' => $this->mtoValor = $this->saldo * $this->mtoEf,
            'amortizacion' => $amortizable = $this->cuota - $this->intereses - $this->mtoValor,
            'saldo' => $this->saldo = $this->saldo - $amortizable,
            ];
        }

        $this->calculado = true;
    }
    //sistema alemán
    public function sistemaAleman(){
        // a= Co * ( i / 1 - ( 1 + i ) -n)
        dd('sistema alemán');
    }
    //sistema americano
    public function sistemaAmericano(){
        // a= Co * ( i / 1 - ( 1 + i ) -n)
        dd('sistema americano');
    }

    public function mount(){
        $this->fecha = now()->format('Y-m-d');
    }
}
