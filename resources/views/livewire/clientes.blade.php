<div>
    <div>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <button wire:click="$set('manejarPic', true)">Manejar PICs</button>
    @forelse($clientes as $cliente)
    <img class="w-20 h-20 rounded-full" src="{{ asset("storage/imagenes/clientes/$cliente->imagen") }}" alt="">
    {{ $cliente->nombres_apellidos }}
    <button wire:click="seleccionar({{ $cliente->id }})">Editar</button>
    <button wire:click="confirmar({{ $cliente->id }})">Eliminar</button>
    @empty
    <p>No hay clientes registrados</p>
    @endforelse

    @if($manejarPic)
    <div class="absolute bg-black inset-0">
        @include('livewire.forms.formClientes')
    </div>
    @endif
    <dialog {{ $eliminando ? 'open' : '' }}>Confirme para Eliminar
        <button wire:click="eliminar()">Eliminar</button>
        <button wire:click="$toggle('eliminando')">Cancelar</button>
    </dialog>
</div>
