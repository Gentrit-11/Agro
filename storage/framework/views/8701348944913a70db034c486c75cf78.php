<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- STOKU -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-green-600">
        <p class="text-sm text-gray-500">Stoku total</p>
        <h2 class="text-2xl font-bold"><?php echo e($stok); ?> kg</h2>
    </div>

    <!-- BORXH FURNITORË -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-red-600">
        <p class="text-sm text-gray-500">Borxh furnitorë</p>
        <h2 class="text-2xl font-bold text-red-600">
            <?php echo e($borxhFurnitore); ?> €
        </h2>
    </div>

    <!-- BORXH KLIENTË -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-yellow-500">
        <p class="text-sm text-gray-500">Borxh klientë</p>
        <h2 class="text-2xl font-bold text-yellow-600">
            <?php echo e($borxhKliente); ?> €
        </h2>
    </div>

    <!-- SHITJE SOT -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-blue-600">
        <p class="text-sm text-gray-500">Shitje sot</p>
        <h2 class="text-2xl font-bold text-blue-600">
            <?php echo e($shitjeSot); ?> €
        </h2>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\yverb\agro-app\resources\views/dashboard.blade.php ENDPATH**/ ?>