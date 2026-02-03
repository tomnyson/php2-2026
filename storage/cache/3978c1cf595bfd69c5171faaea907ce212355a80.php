<?php $__env->startSection('title', 'products'); ?>
<?php $__env->startSection('content'); ?>
    <a href="/product/add" class="btn btn-sm btn-light border text-succes">Add product</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> price </th>
            <th> image </th>
            <th> status </th>
            <th>action</th>
        </tr>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['id']); ?></td>
                <td><?php echo e($item['name']); ?></td>
                <td><?php echo e($item['price']); ?></td>
                <td><img src="<?php echo e($item['image']); ?>" alt="" width="100"></td>
                <td><?php echo e($item['status'] == 1 ? 'active' : 'disable'); ?></td>
                <td>
                     <a href="/size/show/<?php echo e($item['id']); ?>" class="btn btn-success">View
                        
                    </a>
                    <a href="/product/delete/<?php echo e($item['id']); ?>" class="btn btn-danger">Delete
                        
                    </a>
                       <a href="/product/update/<?php echo e($item['id']); ?>" class="btn btn-primary">Edit
                        
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/product/index.blade.php ENDPATH**/ ?>