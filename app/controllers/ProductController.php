<?php

class ProductController extends Controller
{
    public function index()
    {
        $size = $this->model('product');
        $data = $size->all();
        $title = "Quản lý Product";
        $this->view("product/index", [
            'title' => $title,
            'products' => $data
        ]);
    }

    public function delete($id)
    {
        $size = $this->model('product');
        $size->delete($id);
        header('location: products/index');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $image = trim($_POST['image']);
            $status = trim($_POST['status']);
            var_dump($_POST);
            var_dump($name);


            if (!empty($name)) {
                $colorModel = $this->model('product');
                $colorModel->create(array(
                    'name' => $name,
                    'price' => $price,
                    'image' => $image,
                    'status' => $status
                ));
                $this->redirect('/product');
            }
        } else {
            $this->view("product/add",[]);
        }
    }
    public function update($id)
    {
        $product = $this->model('product');
        $colors = $this->model('color')->all();
        $sizes = $this->model('size')->all();
        $data = $product->find($id);
        // var_dump($colors);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("product/edit", [
                'title' => 'edit product',
                'product' => $data,
                'colors' => $colors,
                'sizes' => $sizes
        ]);
        } else {
            $name = trim($_POST['name']);
            $price =trim($_POST['price']);
            $image =trim($_POST['image']);
            $status =trim($_POST['status']);
            if (!empty($name)) {
                $colorModel = $this->model('product');
                $isSuccess = $colorModel->update(
                    array(
                        'name' => $name,
                        'price' => $price,
                        'image' => $image,
                        'status' => $status,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "upadted successful";
                }
                $this->redirect('/product');
            }
        }
    }

    function add_variant(){
        /**
         *  xử lý method post
         *  kiểm tra trùng, validate 
         *  thêm thành công ->
         *  dùng js để load lên giao diện người dùng
         */
        header('Content-Type: application/json');
        $variant = $this->model('variant');

        $data = array(
            'sizeId' => 1,
            'colorId' => 2,
            'image' => '',
            'quantity' => 5
        );
        $variant->create($data);
        $json_string = json_encode($data);
        echo $json_string;
    }
}
