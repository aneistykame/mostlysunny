<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
    <title>Košík</title>
    <style>
        :root {
            --purple: #8584B3;
            --purple-dark: #6b6a9a;
            --bg: #e8e8f5;
            --card-bg: #f5f0f5;
            --text: #3a3a5c;
            --text-light: #7070a0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }




        .main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* CART CONTAINER - rovnaké ako Doprava */
        .cart-container {
            background: white;
            width: 100%;
            max-width: 1100px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .checkout-steps {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 25px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background: var(--sidebar-bg);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
            margin-left: 15px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .quantity input {
            width: 60px;
            padding: 5px;
            margin-left: 5px;
            border-radius: 6px;
            border: 1px solid var(--text-light);
        }

        .price {
            font-weight: bold;
            margin-left: 15px;
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--text);
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
        }

        .total-container {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
            font-size: 16px;
        }

        .checkout-btn {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            background: var(--purple);
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkout-btn:hover {
            background: var(--purple-dark);
        }

        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: var(--text-light);
            margin: 50px 0;
        }

        footer {
            background: #6b6a9a;
            color: white;
            text-align: center;
            padding: 24px;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .price {
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-text" onclick="location.href='{{ url('/') }}'">
            Mostly Sunny Toys
        </div>
        <div class="search-box">
            <span class="search-icon">🔍</span>
            <input type="text" placeholder="Hľadať produkty...">
        </div>
        <div class="header-icons">
            <button title="Účet" onclick="location.href='{{ route('login') }}'">👤 Účet</button>
            <button title="Košík" onclick="location.href='{{ route('cart.index') }}'">🛒 Košík</button>
        </div>
    </header>

    <div class="main">
        <div class="cart-container">
            <div class="checkout-steps"><b>Košík</b> → Doprava → Platba → Údaje</div>
            <div id="cart-items">
                @forelse($cartItems as $id => $item)
                <div class="cart-item">

                    @if(is_object($item))
                        <img src="{{ asset($item->product->mainImage->image ?? 'src/img/placeholder.jpg') }}" class="product-img">
                    @else
                        <img src="{{ asset('src/img/placeholder.jpg') }}" class="product-img">
                    @endif

                    <div class="item-info">
                        <div class="product-name">
                            {{ is_object($item) ? $item->product->name : $item['name'] }}
                        </div>

                        <div class="quantity">
                            @if(is_object($item))
                            <form action="{{ route('cart.update', $item->cart_item_id) }}" method="POST" id="update-form-{{ $item->cart_item_id }}">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                    onchange="document.getElementById('update-form-{{ $item->cart_item_id }}').submit()">
                            </form>
                            @else
                                Množstvo: {{ $item['quantity'] }}
                            @endif
                        </div>
                    </div>

                    <div class="price">
                        @if(is_object($item))
                            {{ number_format($item->product->price * $item->quantity, 2) }} €
                        @else
                            {{ number_format($item['price'] * $item['quantity'], 2) }} €
                        @endif
                    </div>

                    @if(is_object($item))
                    <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">✕</button>
                    </form>
                    @else
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">✕</button>
                    </form>
                    @endif

                </div>
                @empty
                <div class="empty-cart">Tvoj košík je momentálne prázdny.</div>
                @endforelse
            </div>
            {{-- Ak košík nie je prázdny, zobrazíme sumu a tlačidlo --}}
            @if(count($cartItems) > 0)
            <div class="total-container">
                Spolu: {{ number_format($total, 2) }} €
            </div>
            {{-- Smerovanie na ďalší krok objednávky --}}
            <button class="checkout-btn" onclick="location.href='{{ url('/checkout') }}'">
                Pokračovať k doprave
            </button>
            @endif
        </div>
    </div>
    <footer>© 2026 Mostly Sunny Toys</footer>
</body>
</html>