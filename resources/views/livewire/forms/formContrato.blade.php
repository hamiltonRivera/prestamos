<form wire:submit.prevent="contratos">

    <div class="sm:w-10/12 lg:w-2/3 w mx-auto bg-white rounded-xl p-8 capitalize">
        <!-- primer div -->
        <div class="sm:block lg:flex sm:gap-2 w-full">
            <div class="flex lg:w-1/2 sm:gap-1">
                <!-- fecha -->
                <div class="block w-1/2 campos p-2 rounded-lg mb-2">
                    <label for="fecha">Fecha</label>
                    <input wire:model="fecha" class="inputs" value="{{ $fecha }}" type="date" name="fecha" required />
                    @error($fecha)
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
                <!-- numero de contrato -->
                <div class="block w-1/2 campos p-2 rounded-lg mb-2">
                    <label for="nro_contrato"># de contrato</label>
                    <input wire:model="nroContrato" class="inputs" type="number" name="nro_contrato" required />
                    @error($nroContrato)
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
            </div>

            <!-- segundo div contenedor -->
            <div class="flex sm:gap-2 lg:w-1/2 bg-gray-200 rounded-lg mb-2">
                <!-- cliente -->
                <div class="block sm:w-full lg:w-1/2 campos p-2 rounded-l-lg mb-2">
                    <label for="buscar_cliente">Buscar cliente</label>
                    <input wire:model="busqueda" class="inputs" type="search" name="buscar_cliente" />
                </div>
                <!-- selecionar cliente -->
                <div class="block sm:w-full lg:w-1/2 campos p-2 rounded-r-lg mb-2 sm:ml-8 lg:-ml-2">
                    <label for="cliente_sel">Cliente</label>{{$cliente_id}}
                    <select wire:model="cliente_id" class="inputs w-full" name="cliente_sel">
                        <option>--Seleccione al cliente--</option>
                        @forelse ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{$cliente->nombres_apellidos}}</option>
                        @empty

                        @endforelse
                    </select>
                    @error($cliente_id)
                    <span class="requerido">Requerido</span>
                    @enderror
                </div>
            </div>
        </div>
        <!-- tercer div contenedor -->
        <div class="lg:flex lg:gap-1">
            <div class="lg:w-1/2">
                <!-- monto -->
                <div class="flex sm:gap-1 sm:justify-between">
                    <div class="block campos p-2 sm:w-1/3 rounded-lg mb-2">
                        <label for="monto">Monto</label>
                        <input wire:model="monto" class="inputs" type="number" name="monto" step="0.01" required />
                        @error($monto)
                        <span class="requerido">Requerido</span>
                        @enderror
                    </div>
                    <!-- tasa -->
                    <div class="block campos p-2 sm:w-1/3 rounded-lg mb-2">
                        <label for="tasa">tasa</label>
                        <input wire:model="tasa" class="inputs" type="number" name="tasa" step="0.01" required />
                        @error($tasa)
                        <span class="requerido">Requerido</span>
                        @enderror
                    </div>
                    <!-- mto -->
                    <div class="block campos p-2 sm:w-1/3 rounded-lg mb-2">
                        <label for="mto">mto</label>
                        <input wire:model="mto" class="inputs" type="number" name="mto" step="0.01" required />
                        @error($mto)
                        <span class="requerido">Requerido</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- cuarto contenedor -->
            <div class="lg:w-1/2">
                <div class="flex sm:gap-1 sm:justify-between">
                    <!-- periodo -->
                    <div class="block campos p-2 w-1/2 rounded-lg mb-2">
                        <label for="periodo">periodo</label>
                        <select wire:model="periodo" class="inputs w-full" name="periodo">
                            <option>Seleccione</option>
                            @forelse ($periodos as $periodo)
                            <option class="capitalize" value="{{ $periodo }}">{{$periodo}}</option>
                            @empty

                            @endforelse
                        </select>
                        @error($periodo)
                        <span class="requerido">Requerido</span>
                        @enderror
                    </div>
                    <!-- plazo -->
                    <div class="block campos p-2 w-1/2 rounded-lg mb-2">
                        <label for="plazo">plazo</label>
                        <input wire:model="plazo" class="inputs" type="number" name="plazo" required />
                        @error($plazo)
                        <span class="requerido">Requerido</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- garatia -->
        <div class="block campos p- w-full rounded-lg mb-2 px-2 pb-2">
            <label for="garantia">Garantía</label>
            <input wire:model="garantia" class="inputs" type="text" name="garantia" required />
            @error($garantia)
            <span class="requerido">Requerido</span>
            @enderror
        </div>
        <button type="submit"
            class="w-full text-white rounded-md hover:bg-blue-500 border-2 bg-blue-600 border-blue-700 mx-auto">
            Generar Contrato
        </button>
    </div>
</form>
