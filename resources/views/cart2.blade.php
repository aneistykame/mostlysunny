@php
    $cartCount = 0;
    if (auth()->check()) {
        $cartCount = \App\Models\CartItem::whereHas('cart', function($q) {
            $q->where('user_id', auth()->id());
        })->sum('quantity');
    } else {
        $cartCount = collect(session()->get('cart', []))->sum('quantity');
    }
@endphp

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Doprava</title>
    <style>
        :root {
            --purple: #8584B3;
            --purple-light: #b8b7d8;
            --purple-dark: #6b6a9a;
            --pink: #d4a0b5;
            --pink-light: #e8c5d5;
            --bg: #e8e8f5;
            --card-bg: #f5f0f5;
            --sidebar-bg: #d8d8ee;
            --btn-bg: #b0b0c8;
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


        /* MAIN */
        .main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* CONTAINER */
        .cart-container {
            background: white;
            width: 100%;
            max-width: 1100px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .checkout-steps {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 25px;
        }

        /* LAYOUT */
        .checkout-layout {
            display: flex;
            gap: 40px;
        }

        /* SHIPPING */
        .shipping-section {
            flex: 2;
        }

        .shipping-option {
            padding: 15px;
            border: 1px solid var(--text-light);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .shipping-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .shipping-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .shipping-price {
            font-weight: bold;
        }

        /* FORM */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form-group label {
            font-size: 13px;
            margin-bottom: 4px;
            color: var(--text-light);
        }

        .form-group input,
        .form-group select {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid var(--text-light);
        }

        /* CART SUMMARY */
        .cart-summary {
            flex: 1;
            background: var(--sidebar-bg);
            padding: 20px;
            border-radius: 10px;
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .summary-total {
            border-top: 1px solid var(--text-light);
            padding-top: 10px;
            margin-top: 10px;
            font-weight: bold;
        }

        /* BUTTON */
        .checkout-btn {
            margin-top: 25px;
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

        /* MOBILE */
        @media(max-width:800px) {
            .checkout-layout {
                flex-direction: column;
            }
        }

        footer {
            background: #6b6a9a;
            color: white;
            text-align: center;
            padding: 24px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-text" onclick="location.href='{{ route('index') }}'">
            Mostly Sunny Toys
        </div>

        <div class="header-icons">
            @auth
                <button title="Môj profil" onclick="location.href='{{ route('dashboard') }}'">
                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                </button>
            @else
                <button title="Prihlásiť sa" onclick="location.href='{{ route('login') }}'">
                <i class="fa-solid fa-circle-user"></i> Prihlásiť sa
                </button>
            @endauth

            <button title="Košík" onclick="location.href='{{ route('cart.index') }}'" style="position: relative;">
                <i class="fa-solid fa-cart-shopping"></i> Košík
                @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </button>
        </div>
    </header>
    <div class="main">
    <div class="cart-container">
        <div class="checkout-steps">Košík → <b>Doprava</b> → Platba → Údaje</div>
        <div class="checkout-layout">
            <form action="{{ route('checkout.storeShipping') }}" method="POST">
            @csrf
            <div class="shipping-section">
                <h3 style="margin-bottom:20px;">Vyber spôsob dopravy</h3>

                @foreach($shippingMethods as $method)
                <div class="shipping-option">
                    <div class="shipping-head">
                        <div class="shipping-left">
                            <input type="radio" name="shipping_id" value="{{ $method->shipping_id }}"
                                class="shipping-radio" data-price="{{ $method->price }}"
                                {{ $loop->first ? 'checked' : '' }}>
                            <span>{{ $method->name }}</span>
                        </div>
                        <div class="shipping-price">€{{ number_format($method->price, 2) }}</div>
                    </div>

                    @if($method->name == 'Zásielkovňa')
                    <div class="form-group branch-select" style="display:none;">
                        <label>Vyber pobočku</label>
                        <select name="branch_location">
                            <option>Bratislava – Centrum</option>
                            <option>Nitra – OC Mlyny</option>
                            <option>Trnava – City Arena</option>
                        </select>
                    </div>
                    @endif
                </div>
                @endforeach

                <button type="submit" class="checkout-btn">Pokračovať k platbe</button>
            </div>
        </form>

            <div class="cart-summary">
    <div class="summary-title">Tvoj košík</div>
    @php $firstMethod = $shippingMethods->first(); @endphp

    @foreach($cartItems as $id => $item)
        @php
            $isObject = is_object($item);
            $productName = $isObject ? $item->product->name : ($item['name'] ?? 'Produkt');
            $qty = $isObject ? $item->quantity : $item['quantity'];
            $price = $isObject ? ($item->product->price ?? 0) : ($item['price'] ?? 0);
        @endphp
        <div class="summary-item">
            <span>{{ $productName }} ×{{ $qty }}</span>
            <span>{{ number_format($price * $qty, 2) }} €</span>
        </div>
    @endforeach

    <div class="summary-item" style="margin-top: 20px; color: var(--text-light);">
        <span>Doprava</span>
        <span id="shipping-price-display">€{{ number_format($firstMethod->price ?? 0, 2) }}</span>
    </div>

    <div class="summary-total">
        <span>Spolu</span>
        <span id="total-price-display">€{{ number_format($total + ($firstMethod->price ?? 0), 2) }}</span>
    </div>
</div>
        </div>
    </div>
</div>
    <footer>© 2026 Mostly Sunny Toys</footer>

<script>
    const radios = document.querySelectorAll('.shipping-radio');
    const shippingDisplay = document.getElementById('shipping-price-display');
    const totalDisplay = document.getElementById('total-price-display');
    const baseTotal = {{ $total }};

    radios.forEach(radio => {
        if (radio.checked) {
            updateSummary(radio);
        }

        radio.addEventListener('change', function() {
            updateSummary(this);
        });
    });

    function updateSummary(element) {
        const price = parseFloat(element.dataset.price);

        // Aktualizuj texty cez ID
        shippingDisplay.innerText = '€' + price.toFixed(2);
        totalDisplay.innerText = '€' + (baseTotal + price).toFixed(2);

        // Logika pre Zásielkovňu
        document.querySelectorAll('.branch-select').forEach(el => el.style.display = 'none');

        // Ak má tento rádio button v sebe branch-select, ukáž ho
        const branchGroup = element.closest('.shipping-option').querySelector('.branch-select');
        if(branchGroup) {
            branchGroup.style.display = 'block';
        }
    }
</script>
</body>

</html>
