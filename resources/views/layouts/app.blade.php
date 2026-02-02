<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons.css') }}">

    @livewireStyles

    <style>
        body { font-size: 14px; }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1f2933, #111827);
            z-index: 1050;
        }
        .sidebar-logo {
    max-width: 100%;
    height: auto;
    max-height: 80px;   /* rregullo sipas qejfit */
    object-fit: contain;
    display: block;
    margin: 0 auto;
}


        .sidebar a,
        .sidebar button {
            color: #d1d5db;
            text-decoration: none;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        .sidebar a:hover,
        .sidebar button:hover {
            background-color: rgba(255,255,255,.08);
            border-radius: .375rem;
            color: #fff;
        }

        .sidebar .active {
            background-color: #198754;
            color: #fff !important;
        }

        @media (min-width: 992px) {
            .content-wrapper {
                margin-left: 260px;
            }
        }
    </style>
</head>

<body class="bg-light">

@auth
    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar position-fixed top-0 start-0 d-lg-block d-none text-light">
        <div class="p-3 border-bottom fw-bold">
 <img
        src="{{ asset('WhatsApp Image 2026-01-13 at 11.35.44.jpeg') }}"
        class="sidebar-logo"
        alt="Logo"
    >        </div>

        <nav class="p-3 d-flex flex-column gap-1">

            {{-- DASHBOARD --}}
            <a href="{{ route('dashboard') }}" class="px-3 py-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            {{-- PRODUKTE --}}
            <button class="px-3 py-2" onclick="toggleMenu('productsMenu')">
                <i class="bi bi-box-seam me-2"></i> Produkte
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="productsMenu" class="ms-3 d-none">
                <a href="{{ route('products.index') }}" class="d-block px-3 py-1">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="{{ route('products.create') }}" class="d-block px-3 py-1">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            {{-- FURNITORË --}}
            <button class="px-3 py-2" onclick="toggleMenu('suppliersMenu')">
                <i class="bi bi-truck me-2"></i> Furnitorë
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="suppliersMenu" class="ms-3 d-none">
                <a href="{{ route('suppliers.index') }}" class="d-block px-3 py-1">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="{{ route('suppliers.create') }}" class="d-block px-3 py-1">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            {{-- BLERJE --}}
            <button class="px-3 py-2" onclick="toggleMenu('purchasesMenu')">
                <i class="bi bi-cart-plus me-2"></i> Blerje
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="purchasesMenu" class="ms-3 d-none">
                <a href="{{ route('purchases.index') }}" class="d-block px-3 py-1">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="{{ route('purchases.create') }}" class="d-block px-3 py-1">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            {{-- SHITJE --}}
            <button class="px-3 py-2" onclick="toggleMenu('salesMenu')">
                <i class="bi bi-cash-coin me-2"></i> Shitje
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="salesMenu" class="ms-3 {{ request()->routeIs('sales.*') ? '' : 'd-none' }}">
                <a href="{{ route('sales.index') }}" class="d-block px-3 py-1 {{ request()->routeIs('sales.index') ? 'active' : '' }}">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="{{ route('sales.create') }}" class="d-block px-3 py-1 {{ request()->routeIs('sales.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            <hr class="border-secondary my-2">

            <button class="px-3 py-2" onclick="toggleMenu('debtsMenu')">
                <i class="bi bi-exclamation-circle me-2"></i> Borxhe
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="debtsMenu" class="ms-3 {{ request()->routeIs('debts.*') || request()->routeIs('client-debts.*') ? '' : 'd-none' }}">
                <a href="{{ route('debts.index') }}" class="d-block px-3 py-1 {{ request()->routeIs('debts.*') ? 'active' : '' }}">
                    <i class="bi bi-truck me-2"></i> Borxhe Furnitoresh
                </a>
                <a href="{{ route('client-debts.index') }}" class="d-block px-3 py-1 {{ request()->routeIs('client-debts.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Borxhi i Klienteve
                </a>
            </div>
        </nav>

        <div class="p-3 border-top position-absolute bottom-0 w-100">
            <i class="bi bi-person-circle me-2"></i> {{ auth()->user()->name }}
        </div>
    </aside>

    <!-- OVERLAY MOBILE -->
    <div id="overlay"
         class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none"
         style="z-index:1040"
         onclick="toggleSidebar()"></div>
@endauth

<!-- CONTENT -->
<div class="content-wrapper min-vh-100 d-flex flex-column">

    @auth
        <header class="bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h6 class="mb-0 fw-bold">@yield('title','Dashboard')</h6>
            </div>

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>
    @endauth

    <main class="flex-grov-1 p-4">
        @yield('content')
    </main>

</div>

@livewireScripts
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('d-none');
        document.getElementById('overlay').classList.toggle('d-none');
    }

    function toggleMenu(id) {
        document.getElementById(id).classList.toggle('d-none');
    }
</script>

</body>
</html>
