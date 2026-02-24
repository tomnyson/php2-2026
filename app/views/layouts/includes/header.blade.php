  @php
    $cartItems = (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) ? $_SESSION['cart'] : [];
    $cartCount = 0;
    $cartTotal = 0;
    foreach ($cartItems as $cartItem) {
      $qty = (int) ($cartItem['quantity'] ?? 0);
      $price = (float) ($cartItem['price'] ?? 0);
      $cartCount += $qty;
      $cartTotal += ($qty * $price);
    }
  @endphp

  <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="#">MyShop</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              Categories
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Phones</a></li>
              <li><a class="dropdown-item" href="#">Laptops</a></li>
              <li><a class="dropdown-item" href="#">Accessories</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">All Categories</a></li>
            </ul>
          </li>
        </ul>

        <form class="d-flex me-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search products..." />
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <span>Cart</span>
              <span class="badge text-bg-primary">{{ $cartCount }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 320px;">
              <div class="px-3 py-2 border-bottom bg-light d-flex justify-content-between align-items-center">
                <strong>Cart</strong>
                <span class="small text-muted">{{ $cartCount }} item(s)</span>
              </div>

              @if (empty($cartItems))
                <div class="px-3 py-3 text-muted small">Your cart is empty.</div>
              @else
                <div style="max-height: 320px; overflow: auto;">
                  @foreach ($cartItems as $cartItem)
                    <div class="px-3 py-2 border-bottom">
                      <div class="fw-semibold small">{{ $cartItem['name'] ?? 'Product' }}</div>
                      <div class="small text-muted">
                        {{ $cartItem['colorName'] ?? 'N/A' }} / {{ $cartItem['sizeName'] ?? 'N/A' }}
                      </div>
                      <div class="small">
                        Qty: {{ (int) ($cartItem['quantity'] ?? 0) }}
                        x
                        {{ number_format((float) ($cartItem['price'] ?? 0), 0, '.', ',') }}
                      </div>
                    </div>
                  @endforeach
                </div>

                <div class="px-3 py-2 d-flex justify-content-between align-items-center">
                  <strong>Total</strong>
                  <strong>{{ number_format($cartTotal, 0, '.', ',') }}</strong>
                </div>
              @endif

              <div class="border-top p-2">
                <a href="/cart/index" class="btn btn-primary btn-sm w-100">View cart</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
