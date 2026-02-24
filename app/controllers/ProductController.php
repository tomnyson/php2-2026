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

    public function show($id)
    {
        $productId = filter_var($id, FILTER_VALIDATE_INT);
        if ($productId === false || $productId < 1) {
            $this->notFound('Product not found');
            return;
        }

        $productModel = $this->model('product');
        $item = $productModel->find((int) $productId);
        if (!$item) {
            $this->notFound('Product not found');
            return;
        }

        $variantRows = $this->model('variant')->findByProductId($productId);
        $colors = $this->model('color')->all();
        $sizes = $this->model('size')->all();

        $colorMap = [];
        foreach ($colors as $color) {
            $colorMap[(int) $color['id']] = $color['name'];
        }
        // echo "<pre>";
        // var_dump($colorMap);
        // echo "</pre>";
        $sizeMap = [];
        foreach ($sizes as $size) {
            $sizeMap[(int) $size['id']] = $size['name'];
        }
        // echo "<pre>";
        // var_dump($variantRows);
        // echo "</pre>";
        $variants = [];

        foreach ($variantRows as $variant) {
            if ((int) ($variant['productId'] ?? 0) !== (int) $productId) {
                continue;
            }

            $variant['colorName'] = $colorMap[(int) ($variant['colorId'] ?? 0)] ?? 'N/A';
            $variant['sizeName'] = $sizeMap[(int) ($variant['sizeId'] ?? 0)] ?? 'N/A';
            $variants[] = $variant;
        }
        // echo "<pre>";
        // var_dump($variants);
        // echo "</pre>";
        $this->view("product/show", [
            'title' => 'Product detail',
            'product' => $item,
            'variants' => $variants
        ]);
    }

    public function add_cart()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->redirect('/product');
            return;
        }


        $productId = filter_var($_POST['productId'] ?? null, FILTER_VALIDATE_INT);
        $variantId = filter_var($_POST['variantId'] ?? null, FILTER_VALIDATE_INT);
        $quantity = filter_var($_POST['quantity'] ?? null, FILTER_VALIDATE_INT);

        if ($productId === false || $productId < 1 || $variantId === false || $variantId < 1 || $quantity === false || $quantity < 1) {
            $_SESSION['error'] = 'Invalid cart data.';
            $this->redirect('/product');
            return;
        }

        $productModel = $this->model('product');
        $variantModel = $this->model('variant');

        $product = $productModel->find((int) $productId);
        $variant = $variantModel->find((int) $variantId);

        if (!$product || !$variant || (int) ($variant['productId'] ?? 0) !== (int) $productId) {
            $_SESSION['error'] = 'Product variant not found.';
            $this->redirect('/product/show/' . $productId);
            return;
        }

        $stock = (int) ($variant['quantity'] ?? 0);
        if ($stock < 1) {
            $_SESSION['error'] = 'This variant is out of stock.';
            $this->redirect('/product/show/' . $productId);
            return;
        }

        if ($quantity > $stock) {
            $quantity = $stock;
        }
        $userId = $_SESSION['userId'];
        $cartModel = $this->model('cart');
        $variantItem = $cartModel->getCartItemByUserId($variantId, $userId);
        /**
         * check cart model neu chua co thi them moi
         *  neu ma co roi thi cap nhat
         */
        
        if(empty($variantItem)) {
            // them moi
            $cartModel->create([
                'userId' => $userId,
                'quantity' => $quantity,
                'variantId' => $variantId
            ]);
        } else {
             $cartModel->update([
                'userId' => $userId,
                'quantity' => $quantity + $variantItem['quantity']
            ], $variantItem['id']);
        }
      
        
        $this->redirect('/product/show/' . $productId);
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
            $this->view("product/add", []);
        }
    }
    public function update($id)
    {
        $product = $this->model('product');
        $colors = $this->model('color')->all();
        $sizes = $this->model('size')->all();
        $data = $product->find($id);
        $variant = $this->model('variant');
        $variant_data = $variant->all();
        // var_dump($colors);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("product/edit", [
                'title' => 'edit product',
                'product' => $data,
                'colors' => $colors,
                'sizes' => $sizes,
                'variants' => $variant_data
            ]);
        } else {
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $image = trim($_POST['image']);
            $status = trim($_POST['status']);
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

    function add_variant()
    {
        /**
         *  xử lý method post
         *  kiểm tra trùng, validate 
         *  thêm thành công ->
         *  dùng js để load lên giao diện người dùng
         */
        header('Content-Type: application/json');
        $variant = $this->model('variant');

        $productId = $_POST['productId'];
        $sizeId = $_POST['sizeId'];
        $colorId = $_POST['colorId'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $quantity = $_POST['quantity'];
        $tonTai = $variant->KTTonTai($productId, $sizeId, $colorId);

        $data = array(
            'productId' => intval($productId),
            'sizeId' => intval($sizeId),
            'colorId' => intval($colorId),
            'image' => $image,
            'quantity' => intval($quantity),
            'price' => (float)$price
        );
        if ($tonTai) {
            echo json_encode([
                'status' => false,
                'message' => 'da ton tai',
            ]);
        } else {
            $variant->create($data);
            $json_string = json_encode($data);
            echo $json_string;
        }
    }
}
