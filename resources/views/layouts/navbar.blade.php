<nav class="flex items-center border-t-4 border-b-4 shadow-lg bg-yellow-400 border-white justify-between flex-wrap px-6 py-2 w-full">
    <!--Logo etc-->
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a class="text-white no-underline hover:text-white hover:no-underline" href="{{ route('home') }}">
            <x-logo class="w-12"></x-logo>
        </a>
        <span class="lg:text-2xl text-black font-bold pl-2">{{ config('app.name') }}</span>
    </div>

    <!--Toggle button (hidden on large screens)-->
    <button @click="isOpen = !isOpen" type="button" class="block lg:hidden px-2 text-black hover:text-white focus:outline-none focus:text-white sm:right-1" :class="{ 'transition transform-180': isOpen }">
        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path x-show="isOpen" fill-rule="evenodd" clip-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z" />
            <path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
        </svg>
    </button>

    <!--Menu-->
    <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto" :class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }" @click.away="isOpen = false" x-show.transition="true">
        <ul class="pt-6 lg:pt-0 list-reset lg:flex justify-end flex-1 items-center">
            <li class="mr-3">
                <a :class="{ 'bg-yellow-500  rounded text-white font-bold': opcion == 1 } " class="inline-block text-black no-underline hover:text-white hover:text-underline py-2 px-4" href="#" @click="opcion = 1, isOpen = false">Calculadora
                </a>
            </li>
            <li class="mr-3">
                <a :class="{ 'bg-yellow-500  rounded text-white font-bold': opcion == 2 } " class="inline-block text-black no-underline hover:text-white hover:text-underline py-2 px-4" href="#" @click="opcion = 2, isOpen = false">Clientes
                </a>
            </li>
            <li class="mr-3">
                <a :class="{ 'bg-yellow-500  rounded text-white font-bold': opcion == 3 } " class="inline-block text-black no-underline hover:text-white hover:text-underline py-2 px-4" href="#" @click="opcion = 3, isOpen = false">Contratos
                </a>
            </li>

            @guest
            <li class="mr-3">
                <a href="{{ route('login') }}" class="font-medium text-black hover:text-white focus:outline-none focus:underline transition ease-in-out duration-150">Login</a>
            </li>
            @endguest
            @if (Route::has('login'))
            <div class="space-x-4 right-1">
                @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-medium text-black hover:text-white focus:outline-none focus:underline transition ease-in-out duration-150">
                    Log out
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="font-medium text-black hover:text-white focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                @endif

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
            </div>
            @endif
        </ul>
    </div>
</nav>
