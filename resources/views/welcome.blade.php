@extends('layouts.app')

@section('content')
<div class="" x-data="{ isOpen : false, opcion : 0 }"
    class="flex flex-col justify-center min-h-screen bg-gray-50 sm:px-6 lg:px-8">
    <div class="absolute w-full top-0 right-0">
        @include('layouts.navbar')
    </div>

    <div class="flex pt-20">
        <div class="w-full flex flex-col">
            <div class="">
                <div x-show="opcion === 1">
                    <livewire:calculadora>
                </div>
                <div x-show="opcion === 2">
                    <livewire:clientes>
                </div>
                <div x-show="opcion === 3">
                    <livewire:contratos>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
