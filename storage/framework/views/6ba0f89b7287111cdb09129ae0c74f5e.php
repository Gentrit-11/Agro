<div>

    <!-- SEARCH -->
    <div class="mb-3">
        <input
            type="text"
            wire:model.live="search"
            class="form-control w-100 w-md-50"
            placeholder="Kërko produkt..."
        >
    </div>

    <!-- ================= MOBILE (CARDS) ================= -->
    <div class="d-block d-md-none">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex gap-3">

                    <img
                        src="<?php echo e($product->image ? asset('storage/'.$product->image) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2780%27 height=%2780%27%3E%3Crect width=%2780%27 height=%2780%27 fill=%27%23e9ecef%27/%3E%3Ctext x=%2750%%25%27 y=%2750%%25%27 dominant-baseline=%27middle%27 text-anchor=%27middle%27 fill=%27%236c757d%27 font-size=%2712%27%3EFoto%3C/text%3E%3C/svg%3E'); ?>"
                        class="rounded"
                        style="width:80px;height:80px;object-fit:cover"
                    >

                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1"><?php echo e($product->name); ?></h6>
                        <div class="text-muted small"><?php echo e($product->unit); ?></div>

                        <div class="small text-secondary mb-2">
                            <?php echo e(Str::limit($product->description, 80)); ?>

                        </div>

                        <span class="badge <?php echo e($product->is_active ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($product->is_active ? 'Aktiv' : 'Jo aktiv'); ?>

                        </span>

                        <div class="mt-2 d-flex gap-2">
                            <a href="<?php echo e(route('products.edit',$product)); ?>"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form method="POST" action="<?php echo e(route('products.toggle', $product)); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button class="btn btn-sm btn-outline-<?php echo e($product->is_active ? 'danger' : 'success'); ?>">
                                    <?php echo e($product->is_active ? 'Çaktivizo' : 'Aktivizo'); ?>

                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- ================= DESKTOP (TABLE) ================= -->
    <div class="d-none d-md-block">
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Emri</th>
                        <th>Njësia</th>
                        <th>Përshkrimi</th>
                        <th>Statusi</th>
                        <th class="text-end">Veprime</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img
                                    src="<?php echo e($product->image ? asset('storage/'.$product->image) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2750%27 height=%2750%27%3E%3Crect width=%2750%27 height=%2750%27 fill=%27%23e9ecef%27/%3E%3Ctext x=%2750%%25%27 y=%2750%%25%27 dominant-baseline=%27middle%27 text-anchor=%27middle%27 fill=%27%236c757d%27 font-size=%2710%27%3EFoto%3C/text%3E%3C/svg%3E'); ?>"
                                    class="rounded"
                                    style="width:50px;height:50px;object-fit:cover"
                                >
                            </td>
                            <td class="fw-semibold"><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->unit); ?></td>
                            <td class="text-muted">
                                <?php echo e(Str::limit($product->description, 120)); ?>

                            </td>
                            <td>
                                    <span class="badge <?php echo e($product->is_active ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e($product->is_active ? 'Aktiv' : 'Jo aktiv'); ?>

                                    </span>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo e(route('products.edit',$product)); ?>"
                                   class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="<?php echo e(route('products.toggle', $product)); ?>"
                                      class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button class="btn btn-sm btn-outline-<?php echo e($product->is_active ? 'danger' : 'success'); ?>">
                                        <?php echo e($product->is_active ? 'Çaktivizo' : 'Aktivizo'); ?>

                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\yverb\agro-app\resources\views/livewire/products-table.blade.php ENDPATH**/ ?>