@extends('layouts.index')

@section('title', $title ?? 'Product detail')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product detail</h2>
        <a href="/product" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    @if (!empty($product['image']))
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="img-fluid rounded border">
                    @else
                        <div class="border rounded d-flex align-items-center justify-content-center text-muted"
                            style="height: 220px;">
                            No image
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th style="width: 140px;">ID</th>
                            <td>{{ $product['id'] }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $product['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ $product['price'] }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ (int) ($product['status'] ?? 0) === 1 ? 'active' : 'disable' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Variants
        </div>
        <div class="card-body">
            @php
                $cartCount = 0;
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $cartCount += (int) ($cartItem['quantity'] ?? 0);
                    }
                }
            @endphp

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>Select a variant to add to cart</span>
                <span class="badge text-bg-primary">Cart items: {{ $cartCount }}</span>
            </div>

            @if (!empty($variants))
                <form method="POST" action="/product/add_cart" class="row g-2 align-items-end mb-3">
                    <input type="hidden" name="productId" value="{{ $product['id'] }}">
                    <div class="col-md-6">
                        <label class="form-label" for="variantId">Variant</label>
                        <select class="form-select" id="variantId" name="variantId" required>
                            <option value="">Choose variant</option>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant['id'] }}">
                                    {{ $variant['colorName'] }} / {{ $variant['sizeName'] }} (Stock:
                                    {{ (int) ($variant['quantity'] ?? 0) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input class="form-control" type="number" id="quantity" name="quantity" min="1"
                            value="1" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Add to cart</button>
                    </div>
                </form>
            @endif

            @if (empty($variants))
                <p class="text-muted mb-0">No variants for this product.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variants as $variant)
                                <tr>
                                    <td>{{ $variant['id'] }}</td>
                                    <td>{{ $variant['colorName'] }}</td>
                                    <td>{{ $variant['sizeName'] }}</td>
                                    <td>{{ $variant['quantity'] ?? 0 }}</td>
                                    <td>
                                        @if (!empty($variant['image']))
                                            <img src="{{ $variant['image'] }}" alt="" width="70">
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
