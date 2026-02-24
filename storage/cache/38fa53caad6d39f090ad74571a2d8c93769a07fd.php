<?php $__env->startSection('title', $title ?? 'Product detail'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product detail</h2>
        <a href="/product" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <?php if(!empty($product['image'])): ?>
                        <img src="<?php echo e($product['image']); ?>" alt="<?php echo e($product['name']); ?>" class="img-fluid rounded border">
                    <?php else: ?>
                        <div class="border rounded d-flex align-items-center justify-content-center text-muted"
                            style="height: 220px;">
                            No image
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th style="width: 140px;">ID</th>
                            <td><?php echo e($product['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo e($product['name']); ?></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td><?php echo e($product['price']); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo e((int) ($product['status'] ?? 0) === 1 ? 'active' : 'disable'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Variants
        </div>
        <div class="card-body">
            <?php
                $cartCount = 0;
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $cartCount += (int) ($cartItem['quantity'] ?? 0);
                    }
                }
            ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>Select a variant to add to cart</span>
                <span class="badge text-bg-primary">Cart items: <?php echo e($cartCount); ?></span>
            </div>

            <?php if(!empty($variants)): ?>
                <form method="POST" action="/product/add_cart" class="row g-2 align-items-end mb-3">
                    <input type="hidden" name="productId" value="<?php echo e($product['id']); ?>">
                    <div class="col-md-6">
                        <label class="form-label" for="variantId">Variant</label>
                        <select class="form-select" id="variantId" name="variantId" required>
                            <option value="">Choose variant</option>
                            <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($variant['id']); ?>">
                                    <?php echo e($variant['colorName']); ?> / <?php echo e($variant['sizeName']); ?> (Stock:
                                    <?php echo e((int) ($variant['quantity'] ?? 0)); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input class="form-control" type="number" id="quantity" name="quantity" min="1"
                            value="1" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Add to cart</button>
                    </div>
                </form>
            <?php endif; ?>

            <?php if(empty($variants)): ?>
                <p class="text-muted mb-0">No variants for this product.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($variant['id']); ?></td>
                                    <td><?php echo e($variant['colorName']); ?></td>
                                    <td><?php echo e($variant['sizeName']); ?></td>
                                    <td><?php echo e($variant['quantity'] ?? 0); ?></td>
                                    <td>
                                        <?php if(!empty($variant['image'])): ?>
                                            <img src="<?php echo e($variant['image']); ?>" alt="" width="70">
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/product/show.blade.php ENDPATH**/ ?>