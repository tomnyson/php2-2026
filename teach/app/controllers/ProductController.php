<?php
declare(strict_types=1);

class ProductController extends Controller
{
    public function index(): void
    {
        $product = $this->model('product');
        $items = $product->all();
        $this->view('product/index', ['items' => $items]);
    }

    public function show(string $id): void
    {
        $productId = $this->parseId($id);
        if ($productId === null) {
            $this->notFound('Product not found');
            return;
        }

        $product = $this->model('product');
        $item = $product->find($productId);
        if ($item === null) {
            $this->notFound('Product not found');
            return;
        }

        $this->view('product/show', ['item' => $item]);
    }

    public function create(): void
    {
        $this->view('product/create', [
            'errors' => [],
            'values' => ['name' => '', 'price' => ''],
        ]);
    }

    public function store(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirect('/product/create');
        }

        $data = $this->productDataFromRequest();
        $errors = $this->validate($data);
        if (!empty($errors)) {
            $this->view('product/create', ['errors' => $errors, 'values' => $data]);
            return;
        }

        $product = $this->model('product');
        $product->create($data);
        $this->redirect('/product/index');
    }

    public function edit(string $id): void
    {
        $productId = $this->parseId($id);
        if ($productId === null) {
            $this->notFound('Product not found');
            return;
        }

        $product = $this->model('product');
        $item = $product->find($productId);
        if ($item === null) {
            $this->notFound('Product not found');
            return;
        }

        $this->view('product/edit', [
            'item' => $item,
            'errors' => [],
            'values' => ['name' => $item['name'], 'price' => (string) $item['price']],
        ]);
    }

    public function update(string $id): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirect('/product/index');
        }

        $productId = $this->parseId($id);
        if ($productId === null) {
            $this->notFound('Product not found');
            return;
        }

        $product = $this->model('product');
        $item = $product->find($productId);
        if ($item === null) {
            $this->notFound('Product not found');
            return;
        }

        $data = $this->productDataFromRequest();
        $errors = $this->validate($data);
        if (!empty($errors)) {
            $this->view('product/edit', [
                'item' => $item,
                'errors' => $errors,
                'values' => $data,
            ]);
            return;
        }

        $product->update($productId, $data);
        $this->redirect('/product/index');
    }

    public function delete(string $id): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirect('/product/index');
        }

        $productId = $this->parseId($id);
        if ($productId === null) {
            $this->notFound('Product not found');
            return;
        }

        $product = $this->model('product');
        $product->delete($productId);
        $this->redirect('/product/index');
    }

    private function parseId(string $id): ?int
    {
        $value = filter_var($id, FILTER_VALIDATE_INT);
        if ($value === false || $value < 1) {
            return null;
        }

        return (int) $value;
    }

    private function productDataFromRequest(): array
    {
        $name = trim((string) ($_POST['name'] ?? ''));
        $priceInput = trim((string) ($_POST['price'] ?? ''));

        return [
            'name' => $name,
            'price' => $priceInput,
        ];
    }

    private function validate(array $data): array
    {
        $errors = [];
        if ($data['name'] === '') {
            $errors[] = 'Name is required.';
        }

        if ($data['price'] === '' || !is_numeric($data['price'])) {
            $errors[] = 'Price must be a number.';
        } elseif ((float) $data['price'] < 0) {
            $errors[] = 'Price must be zero or greater.';
        }

        return $errors;
    }
}
