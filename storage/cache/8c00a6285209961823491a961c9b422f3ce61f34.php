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
      <table class="table">
        <tr>
            <th> id </th>
            <th> color </th>
            <th> size </th>
            <th> quantity </th>
            <th>action</th>
        </tr>
     
        <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
            <tr>
                <td><?php echo e($item['id']); ?></td>
                <td><?php echo e($item['colorName']); ?></td>
                <td><?php echo e($item['sizeName']); ?></td>
                 <td><?php echo e($item['quantity']); ?></td>
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
    <!-- tao table html and render data tu ajax -->
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
            <label for="inputPassword2" class="visually-hidden">Kích thước</label>
            <select id="size" class="form-select" aria-label="Default select example">
                <option selected>chọn kich thuoc</option>
                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($size['id']); ?>"><?php echo e($size['name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Giá sản phẩm</label>
            <input type="number" class="form-control" placeholder="nhập giá" name="price" id="price" min="0"/>
        </div>
        <div class="col-auto">
            <input type="number" id="soLuong"class="form-control" placeholder="nhập số lượng" min="0" />
        </div>
        <div class="col-auto">
            <input type="text" id="image"class="form-control" placeholder="nhập hình ảnh" />
        </div>
        <div class="col-auto">
            <button type="button" id="add_variant" class="btn btn-info mb-3">+</button>
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
            const price = document.getElementById('price').value;
            const image = document.getElementById('image').value;
            const formData = new FormData();
            formData.append('colorId', colorId);
            formData.append('sizeId', sizeId);
            formData.append('price', price);
            formData.append('quantity', soLuong);
            formData.append('image', image);
            formData.append('productId', <?php echo e($product['id']); ?>);
            fetch('/product/add_variant', {
                method: 'POST',
                body: formData
            }).then(result => {
                console.log(result)
                /*
                b1: check status 
                error -> alert loi
                success => c1. reload page danh cho cac ban trung binh
                kha > => dung javascript them 1 dong vao table ko can load lai page
                */
            })

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/php2_mvc/app/views/product/edit.blade.php ENDPATH**/ ?>