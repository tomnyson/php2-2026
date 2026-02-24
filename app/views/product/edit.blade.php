@extends('layouts.index')
@section('title', $title)
@section('content')
    <h1>Edit product</h1>
    <form action="/product/update/{{ $product['id'] }}" method="POST">
        <label for="">product</label>
        <input name="name" type="text" value="{{ $product['name'] }}">
        <label for="">price</label>
        <input name="price" type="text" value="{{ $product['price'] }}">
        <label for="">image</label>
        <input name="image" type="text" value="{{ $product['image'] }}">
        <label for="">status</label>
        <select name="status" id="" value="{{ $product['status'] }}">
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
     
        @foreach ($variants as $item)
        
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['colorName'] }}</td>
                <td>{{ $item['sizeName'] }}</td>
                 <td>{{ $item['quantity'] }}</td>
                <td>
                     <a href="/size/show/{{ $item['id'] }}" class="btn btn-success">View
                        
                    </a>
                    <a href="/product/delete/{{ $item['id'] }}" class="btn btn-danger">Delete
                        
                    </a>
                       <a href="/product/update/{{ $item['id'] }}" class="btn btn-primary">Edit
                        
                    </a>
                </td>
            </tr>
        @endforeach

    </table>
    <!-- tao table html and render data tu ajax -->
    <button type="submit" class="btn btn-primary mb-3">+</button>
    <form class="row g-2">
        <div class="col-auto">
            <label for="staticEmail2" class="visually-hidden">Email</label>
            <select id="color" class="form-select" aria-label="Default select example">
                <option selected>Chọn kích thước</option>
                @foreach ($colors as $color)
                    <option value="{{ $color['id'] }}">{{ $color['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Kích thước</label>
            <select id="size" class="form-select" aria-label="Default select example">
                <option selected>chọn kich thuoc</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size['id'] }}">{{ $size['name'] }}</option>
                @endforeach
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
@endsection
@push('scripts')
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
            formData.append('productId', {{$product['id']}});
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
@endpush
