<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(config('app.name')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('icons/bootstrap-icons.css')); ?>">

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


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

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar position-fixed top-0 start-0 d-lg-block d-none text-light">
        <div class="p-3 border-bottom fw-bold">
 <img
        src="<?php echo e(asset('WhatsApp Image 2026-01-13 at 11.35.44.jpeg')); ?>"
        class="sidebar-logo"
        alt="Logo"
    >        </div>

        <nav class="p-3 d-flex flex-column gap-1">

            
            <a href="<?php echo e(route('dashboard')); ?>" class="px-3 py-2 <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            
            <button class="px-3 py-2" onclick="toggleMenu('productsMenu')">
                <i class="bi bi-box-seam me-2"></i> Produkte
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="productsMenu" class="ms-3 d-none">
                <a href="<?php echo e(route('products.index')); ?>" class="d-block px-3 py-1">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="<?php echo e(route('products.create')); ?>" class="d-block px-3 py-1">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            
            <button class="px-3 py-2" onclick="toggleMenu('suppliersMenu')">
                <i class="bi bi-truck me-2"></i> Furnitorë
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="suppliersMenu" class="ms-3 d-none">
                <a href="<?php echo e(route('suppliers.index')); ?>" class="d-block px-3 py-1">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="<?php echo e(route('suppliers.create')); ?>" class="d-block px-3 py-1">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            
            <button class="px-3 py-2" onclick="toggleMenu('purchasesMenu')">
                <i class="bi bi-cart-plus me-2"></i> Blerje
                <i class="bi bi-chevron-down float-end"></i>
            </button>
            <div id="purchasesMenu" class="ms-3 d-none">
                <a href="<?php echo e(route('purchases.index')); ?>" class="d-block px-3 py-1">
                    <i class="bi bi-list-ul me-2"></i> Lista
                </a>
                <a href="<?php echo e(route('purchases.create')); ?>" class="d-block px-3 py-1">
                    <i class="bi bi-plus-circle me-2"></i> Shto
                </a>
            </div>

            
            <span class="px-3 py-2 d-flex align-items-center text-secondary" style="opacity:.5;cursor:default">
                <i class="bi bi-cash-coin me-2"></i> Shitje
                <small class="ms-auto badge bg-secondary">Së shpejti</small>
            </span>

            <hr class="border-secondary my-2">

            <a href="#" class="px-3 py-2">
                <i class="bi bi-exclamation-circle me-2"></i> Borxhe
            </a>
        </nav>

        <div class="p-3 border-top position-absolute bottom-0 w-100">
            <i class="bi bi-person-circle me-2"></i> <?php echo e(auth()->user()->name); ?>

        </div>
    </aside>

    <!-- OVERLAY MOBILE -->
    <div id="overlay"
         class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none"
         style="z-index:1040"
         onclick="toggleSidebar()"></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- CONTENT -->
<div class="content-wrapper min-vh-100 d-flex flex-column">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
        <header class="bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h6 class="mb-0 fw-bold"><?php echo $__env->yieldContent('title','Dashboard'); ?></h6>
            </div>

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                    <?php echo e(auth()->user()->name); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <main class="flex-grow-1 p-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</div>

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

<script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>

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
<?php /**PATH C:\Users\yverb\agro-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>