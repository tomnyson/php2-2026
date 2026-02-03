<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <h1>Edit product</h1>
    <form action="/product/update/<?php echo e($product['id']); ?>" method="POST">
        <label for="">product</label>
        <input name="name" type="text" value="<?php echo e($product['name']); ?>">
        <label for="">price</label>
        <input name="price" type="text" value="<?php echo e($product['price']); ?>">
        <label for="">image</label>
        <input name="image" type="text" value="<?php echo e($product['image']); ?>">
        <label for="">status</label>
        <select name="status" id="" value="<?php echo e($product['status']); ?>">
            <option value="1">hoat dong</option>
            <option value="0">ko hoat dong</option>
        </select>
        <button type="submit" class="btn btn-success">Sua</button>
    </form>
    <h3>Danh sách biến thể</h3>
     <button type="submit" class="btn btn-primary mb-3">+</button>
    <form class="row g-2">
        <div class="col-auto">
            <label for="staticEmail2" class="visually-hidden">Email</label>
            <select id="color" class="form-select" aria-label="Default select example">
                <option selected>Chọn kích thước</option>
             <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($color['id']); ?>"><?php echo e($color['name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Password</label>
            <select id="size" class="form-select" aria-label="Default select example">
                <option selected>chọn kich thuoc</option>
                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($size['id']); ?>"><?php echo e($size['name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
          <div class="col-auto">
            <input type="number" id="soLuong"class="form-control" placeholder="nhập số lượng" min="0" />
          </div>
         <div class="col-auto">
            <input type="text" id="image"class="form-control" placeholder="nhập hình ảnh"  />
        </div>
        <div class="col-auto">
            <button type="button"  id="add_variant"  class="btn btn-info mb-3">+</button>
            <button type="button"class="btn btn-danger mb-3">x</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
   document.getElementById('add_variant').addEventListener('click', function(event) {
    const colorId = document.getElementById('color').value;
    const sizeId = document.getElementById('size').value;
    const soLuong = document.getElementById('soLuong').value;
    const image = document.getElementById('image').value;
    fetch('/product/add_variant', {
    method: 'POST',
     headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        colorId,
        sizeId,
        productId: <?php echo e($product['id']); ?>,
        soLuong,
        image
    })
})
    
})
</script>
<?php $__env->stopPush(); ?> 

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/product/edit.blade.php ENDPATH**/ ?>