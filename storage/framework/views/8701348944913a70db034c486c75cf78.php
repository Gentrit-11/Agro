<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row g-3">

            <!-- STOKU -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-success h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-box text-success fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Stoku total</div>
                            <div class="fs-4 fw-bold"><?php echo e($stok); ?> kg</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BORXH FURNITORË -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-danger h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-truck text-danger fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Borxh furnitorë</div>
                            <div class="fs-4 fw-bold text-danger">
                                <?php echo e($borxhFurnitore); ?> €
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BORXH KLIENTË -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-warning h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people text-warning fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Borxh klientë</div>
                            <div class="fs-4 fw-bold text-warning">
                                <?php echo e($borxhKliente); ?> €
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SHITJE SOT -->
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-primary h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-cash-stack text-primary fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Shitje sot</div>
                            <div class="fs-4 fw-bold text-primary">
                                <?php echo e($shitjeSot); ?> €
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\yverb\agro-app\resources\views/dashboard.blade.php ENDPATH**/ ?>