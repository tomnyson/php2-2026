<?php $__env->startSection('title', 'Size'); ?>
<?php $__env->startSection('content'); ?>
    <a href="/size/them" class="btn btn-sm btn-light border text-succes">Add Size</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th>action</th>
        </tr>
        <?php $__currentLoopData = $size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['id']); ?></td>
                <td><?php echo e($item['name']); ?></td>
                <td>
                    <a href="/size/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-light border text-danger">Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    alert("Size here")
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/sizes/index.blade.php ENDPATH**/ ?>