<div class="flex w-full">
    <div class="sm:w-full lg:w-1/4 sm:mx-4 bg-white py-4 rounded-lg">
        <div class="w-10/12 bg-gray-300 mx-auto py-4 px-8 rounded-lg">
            <div class="w-full mx-auto py-1">
                <label class="w-full" for="monto">Sistema</label>
                <select class="input" name="sistema" wire:model="sistema">
                    <option value="" selected>Seleccione</option>
                    @foreach($sistemas as $key => $sistema)
                    @switch($sistema)
                    @case('frances')
                    <option value="{{ $sistema }}">Francés</option>
                    @break
                    @case('aleman')
                    <option value="{{ $sistema }}">Alemán</option>
                    @break
                    @case('americano')
                    <option value="{{ $sistema }}">Americano</option>
                    @break
                    @endswitch
                    @endforeach
                </select>
                @error('sistema')
                <span class="requerido">Requerido</span>
                @enderror
            </div>
            <div class="sm:flex sm:gap-2 lg:block">
                <div class="sm:w-1/2 lg:w-full mx-auto py-1">
                    <label class="w-full" for="fecha">Fecha</label>
                    <input class="input" type="date" name="fecha" value="1" wire:model="fecha" />
                    @error('fecha')
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
                <div class="sm:w-1/2 lg:w-full mx-auto py-1">
                    <label class="w-full" for="monto">Períodos</label>
                    <select class="input" name="periodos" wire:model="periodo">
                        <option value="" selected>Seleccione</option>
                        @foreach ($periodos as $key =>$periodo)
                        <option value="{{ $periodo }}" selected>{{ ucWords($periodo) }}</option>
                        @endforeach
                    </select>
                    @error('periodo')
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
            </div>
            <div class="sm:flex sm:gap-2 lg:block">
                <div class="w-full mx-auto py-1">
                    <label class="w-full" for="capital">Capital</label>
                    <input class="input" type="number" name="capital" value="1" wire:model="capital" />
                    @error('capital')
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
                <div class="w-full mx-auto py-1">
                    <label class="w-full" for="tasa">Tasa (anual)</label>
                    <input class="input" type="number" name="tasa" value="1" wire:model="tasa" />
                    @error('tasa')
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
            </div>
            <div class="sm:flex sm:gap-2 lg:block">
                <div class="w-full mx-auto py-1">
                    <label class="w-full" for="mto">Mto Valor</label>
                    <input class="input" type="number" name="mto" value="1" wire:model="mto" />
                    @error('mto')
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
                <div class="w-full mx-auto py-1">
                    <label class="w-full" for="plazo">Plazo</label>
                    <input class="input" type="number" name="plazo" value="1" wire:model="plazo" />
                    @error('plazo')
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
            </div>

            <div class="w-full mx-auto self-center">
                <button wire:click="seleccionarSistema()"
                    class="w-full text-white rounded-md hover:bg-blue-500 border-2 bg-blue-600 border-blue-700 mx-auto">Calcular</button>
            </div>
        </div>
    </div>
    @if($calculado)
    <div class="w-3/4">
        <table class="table">
            <thead>
                <tr>
                    <th>No. Cuota</th>
                    <th>Fecha de Pago</th>
                    <th>Pago de Principal</th>
                    <th>Pago Intereses</th>
                    <th>Mto Valor</th>
                    <th>Monto Cuota</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tablaAmortizacion as $key => $fila)
                <tr>
                    <td class="text-center">{{ $key + 1}}</td>
                    <td class="text-center">{{ $fila['fechaPago'] }}</td>
                    <td class="text-right">{{ number_format($fila['amortizacion'], 2 ) }}</td>
                    <td class="text-right">{{ number_format($fila['interes'], 2 ) }}</td>
                    <td class="text-right">{{ number_format($fila['mtoValor'], 2 ) }}</td>
                    <td class="text-right">{{ number_format($cuota, 2 ) }}</td>
                    <td class="text-right">{{ number_format($fila['saldo'], 2 ) }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @endif
</div>
