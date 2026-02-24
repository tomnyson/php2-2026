<?php

class CartController extends Controller
{
    public function index()
    {
        $cartItems = (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) ? $_SESSION['cart'] : [];

        $items = [];
        $totalQty = 0;
        $totalAmount = 0;

        foreach ($cartItems as $item) {
            $qty = (int) ($item['quantity'] ?? 0);
            $price = (float) ($item['price'] ?? 0);
            $subtotal = $qty * $price;

            $item['quantity'] = $qty;
            $item['price'] = $price;
            $item['subtotal'] = $subtotal;
            $items[] = $item;

            $totalQty += $qty;
            $totalAmount += $subtotal;
        }

        $this->view('cart/index', [
            'title' => 'Cart',
            'items' => $items,
            'totalQty' => $totalQty,
            'totalAmount' => $totalAmount,
        ]);
    }
}
