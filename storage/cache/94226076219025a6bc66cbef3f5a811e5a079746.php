<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <h3>add products</h3>
    <form action="/product/add" method="post">
        <label for="">product</label>
        <input name="name" type="text">
        <label for="">price</label>
        <input name="price" type="text">
        <label for="">image</label>
        <input name="img" type="text">
        <label for="">status</label>
        <select name="status" id="">
            <option value="1">hoat dong</option>
            <option value="0">ko hoat dong</option>
        </select>
        <button type="submit" class="btn btn-success">them</button>
    </form>
<?php $__env->stopSection(); ?>
 

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/product/add.blade.php ENDPATH**/ ?>