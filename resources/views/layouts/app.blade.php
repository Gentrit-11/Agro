<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css'])
    @livewireStyles

</head>


<body class="bg-gray-100 text-gray-800">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-900 text-gray-100
           transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 ease-in-out">
        <div class="p-4 text-xl font-bold border-b border-gray-700">
            🌱 AgroApp
        </div>

        <nav class="p-4 space-y-1 text-sm">

            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded bg-green-600 font-semibold">
                Dashboard
            </a>

            <!-- PRODUKTE -->
            <div>
                <button onclick="toggleProductsMenu()"
                    class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-700">
                    <span>Produkte</span>
                    <svg id="productsArrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- NËNMENU -->
                <div id="productsMenu" class="ml-4 mt-1 space-y-1 hidden">
                    <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                        Shih Produkte
                    </a>

                    <a href="{{ route('products.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                        Shto Produkt
                    </a>
                </div>
            </div>

            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                Furnitorë
            </a>

            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                Blerje
            </a>

            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                Shitje
            </a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                Prodhim
            </a>

            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                Borxhe
            </a>

        </nav>


        <div class="absolute bottom-0 w-full p-4 border-t border-gray-700 text-sm">
            👤 {{ auth()->user()->name }}
        </div>
    </aside>

    <!-- OVERLAY (MOBILE ONLY) -->
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden">
    </div>

    <!-- CONTENT WRAPPER -->
    <div class="lg:ml-64 min-h-screen flex flex-col">

        <!-- TOP BAR -->
        <header class="flex items-center justify-between bg-white shadow px-4 py-3">

            <!-- LEFT -->
            <div class="flex items-center gap-3">
                <!-- HAMBURGER (MOBILE ONLY) -->
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-700 text-2xl">
                    ☰
                </button>

                <h1 class="text-lg font-bold text-gray-800">
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            <!-- RIGHT (PROFILE) -->
            <div class="relative group">
                <button class="flex items-center gap-2 focus:outline-none">
                    <span class="text-sm font-medium text-gray-700">
                        {{ auth()->user()->name }}
                    </span>
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- DROPDOWN -->
                <div
                    class="absolute right-0 mt-2 w-40 bg-white rounded shadow-md border
                       hidden group-hover:block z-50">
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        Profili
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-4">
            @yield('content')
        </main>

    </div>

    @livewireScripts
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleProductsMenu() {
            const menu = document.getElementById('productsMenu');
            const arrow = document.getElementById('productsArrow');
            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }
    </script>
</body>

</html>
