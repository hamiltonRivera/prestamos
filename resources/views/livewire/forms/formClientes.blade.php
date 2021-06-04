@section('title', 'Crear Cliente')

<div class="mt-2">
    <div class="bg-white rounded-lg mx-auto w-2/3 shadow">
        <div class="flex">
            <div class="w-1/2">
                <a href="{{ route('home') }}">
                    <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
                </a>

                <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                    {{ $editando ? 'Editar Cliente' : 'Crear Nuevo Cliente'}}
                </h2>

                <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                    O
                    <a href="{{ route('home') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Regresar
                    </a>
                </p>
            </div>
            <div class="w-1/2">
                @if ($foto)
                Foto Seleccionada:
                <img src="{{ $foto->temporaryUrl() }}">
                @endif
            </div>
        </div>

        <div class="flex container px-4 py-8 sm:px-10 gap-4">
            <div class="w-1/2">
                <div class="grid grid-cols-2">
                    <label for="nombres_apellidos" class="flex text-sm font-medium text-gray-700 leading-5">
                        Fiador  {{ $pic }}
                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:click="$toggle('pic')" id="pic" type="checkbox" class="appearance-none block left-2 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('pic') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>
                    </label>

                </div>
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 leading-5">
                        Agregar Imagen
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="foto" id="foto" type="file" required
                        {{ $pic ? '' : 'disabled' }}
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('foto') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('foto')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700 leading-5">
                        Dni
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="dni" id="dni" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('dni') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('dni')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nombres_apellidos" class="block text-sm font-medium text-gray-700 leading-5">
                        Nombres y Apellidos
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="nombres_apellidos" id="nombres_apellidos" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('nombres_apellidos') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('nombres_apellidos')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <label for="sexo" class="block text-sm font-medium text-gray-700 leading-5">
                            Sexo
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <select wire:model.lazy="sexo" id="sexo" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('sexo') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror">
                                <option value="">Seleccione</option>
                                @foreach($sexos as $key => $sexo)
                                <option value="{{$key}}">{{$sexo}}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('sexo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 leading-5">
                            Fecha de Nacimiento
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:model.lazy="fecha_nacimiento" id="fecha_nacimiento" type="date" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('fecha_nacimiento') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('fecha_nacimiento')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                        Email
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="email" id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for="telefono" class="block text-sm font-medium text-gray-700 leading-5">
                        Teléfono
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="telefono" id="telefono" type="tel" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('telefono') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('telefono')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="w-1/2">
                <div>
                    <label for="direccion" class="block text-sm font-medium text-gray-700 leading-5">
                        Dirección
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="direccion" id="direccion" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('direccion') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('direccion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="departamento" class="block text-sm font-medium text-gray-700 leading-5">
                        Departamento
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="departamento" id="departamento" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('departamento') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('departamento')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="municipio" class="block text-sm font-medium text-gray-700 leading-5">
                        Municipio
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="municipio" id="municipio" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('municipio') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('municipio')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nivel_academico" class="block text-sm font-medium text-gray-700 leading-5">
                        Nivel Académico
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <select wire:model.lazy="nivel_academico" id="nivel_academico" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('nivel_academico') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror">
                            <option value="">Seleccione</option>
                            @foreach($nivel_academicos as $nivel_academico)
                            <option value="{{$nivel_academico}}">{{$nivel_academico}}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('nivel_academico')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profesion" class="block text-sm font-medium text-gray-700 leading-5">
                        Profesión
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="profesion" id="profesion" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('profesion') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('profesion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="estado_civil" class="block text-sm font-medium text-gray-700 leading-5">
                        Estado Civil
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <select wire:model.lazy="estado_civil" id="estado_civil" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('estado_civil') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror">
                            <option value="">Seleccione</option>
                            @foreach($estado_civiles as $key => $estado_civil)
                            <option value="{{$key}}">{{$estado_civil}}(a)</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @error('estado_civil')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="px-4">
            <span class="block w-full rounded-md shadow-sm">
                <button wire:click="cOEPic()" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                    {{ $editando ? 'Actualizar' : 'Registrar'}}
                </button>
            </span>
        </div>
        <div class="px-4">
            <span class="block w-full rounded-md shadow-sm">
                <button wire:click="$set('manejarPic', false)" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700 transition duration-150 ease-in-out">
                    Cancelar
                </button>
            </span>
        </div>


    </div>
</div>
