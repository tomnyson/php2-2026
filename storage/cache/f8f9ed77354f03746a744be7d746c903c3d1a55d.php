<?php $__env->startSection('title', $title ?? 'Cart'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Shopping cart</h2>
        <a href="/product" class="btn btn-outline-secondary btn-sm">Continue shopping</a>
    </div>

    <?php if(empty($items)): ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <h5 class="mb-2">Your cart is empty</h5>
                <p class="text-muted mb-3">Add products with variants from the product detail page.</p>
                <a href="/product" class="btn btn-primary">Go to products</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">Cart items</div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Variant</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if(!empty($item['image'])): ?>
                                                        <img src="<?php echo e($item['image']); ?>" alt="" width="48" height="48"
                                                            style="object-fit: cover;" class="rounded border">
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="fw-semibold"><?php echo e($item['name'] ?? 'Product'); ?></div>
                                                        <div class="small text-muted">
                                                            Product ID: <?php echo e($item['productId'] ?? ''); ?> | Variant ID:
                                                            <?php echo e($item['variantId'] ?? ''); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo e($item['colorName'] ?? 'N/A'); ?> / <?php echo e($item['sizeName'] ?? 'N/A'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e(number_format((float) ($item['price'] ?? 0), 0, '.', ',')); ?>

                                            </td>
                                            <td class="text-center"><?php echo e((int) ($item['quantity'] ?? 0)); ?></td>
                                            <td class="text-end fw-semibold">
                                                <?php echo e(number_format((float) ($item['subtotal'] ?? 0), 0, '.', ',')); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">Summary</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total items</span>
                            <strong><?php echo e((int) ($totalQty ?? 0)); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total amount</span>
                            <strong><?php echo e(number_format((float) ($totalAmount ?? 0), 0, '.', ',')); ?></strong>
                        </div>
                        <button class="btn btn-success w-100" type="button" disabled>Checkout (coming soon)</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/cart/index.blade.php ENDPATH**/ ?>