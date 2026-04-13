<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="mainstyle.css" rel="stylesheet">
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
        <div class="logo-text" onclick="location.href='index.html'">
            Mostly Sunny Toys
        </div>
        <div class="search-box">
            <span class="search-icon">🔍</span>
            <input type="text" placeholder="Hľadať produkty...">
        </div>
        <div class="header-icons">
            <button title="Účet" onclick="location.href='login.html'">👤 Účet</button>
            <button title="Košík" onclick="location.href='cart.html'">🛒 Košík</button>
        </div>
    </header>
    <div class="main">
    <div class="cart-container">
        <div class="checkout-steps">Košík → <b>Doprava</b> → Platba → Údaje</div>
        <div class="checkout-layout">
            <div class="shipping-section">
                <h3 style="margin-bottom:20px;">Vyber spôsob dopravy</h3>
                <div class="shipping-option">
                    <div class="shipping-head">
                        <div class="shipping-left">
                            <input type="radio" name="shipping" checked>
                            <span>Kuriér na adresu</span>
                        </div>
                        <div class="shipping-price">€4.99</div>
                    </div>
                </div>
                <div class="shipping-option">
                    <div class="shipping-head">
                        <div class="shipping-left">
                            <input type="radio" name="shipping">
                            <span>Zásielkovňa</span>
                        </div>
                        <div class="shipping-price">€2.99</div>
                    </div>
                    <div class="form-group">
                        <label>Vyber pobočku</label>
                        <select>
                            <option>Bratislava – Centrum</option>
                            <option>Nitra – OC Mlyny</option>
                            <option>Trnava – City Arena</option>
                        </select>
                    </div>
                </div>
                <div class="shipping-option">
                    <div class="shipping-head">
                        <div class="shipping-left">
                            <input type="radio" name="shipping">
                            <span>Osobný odber</span>
                        </div>
                        <div class="shipping-price">€0.00</div>
                    </div>
                    <p style="font-size:14px;">
                        Osobný odber je možný na adrese:<br>
                        <strong>Mostly Sunny Toys<br>
                        Hlavná 15, Nitra</strong>
                    </p>
                </div>
                <button class="checkout-btn" onclick="location.href='{{ url('/checkout/payment') }}'">Pokračovať k platbe</button>
            </div>

            <div class="cart-summary">
                <div class="summary-title">Tvoj košík</div>
                @forelse($cartItems as $id => $item)
                    @php
                        // Zjednotenie dát pre prihlásených aj hostí
                        $isObject = is_object($item);
                        $product = $isObject ? $item->product : (isset($item['product']) ? (object)$item['product'] : null);
                        $qty = $isObject ? $item->quantity : $item['quantity'];
                        $price = $isObject ? ($item->product->price ?? 0) : ($item['price'] ?? 0);
                    @endphp
                    
                    <div class="summary-item">
                        <span>{{ $product->name ?? 'Produkt' }} ×{{ $qty }}</span>
                        <span>{{ number_format($price * $qty, 2) }} €</span>
                    </div>
                @empty
                    <div class="summary-item">Košík je prázdny</div>
                @endforelse

                <div class="summary-item" style="margin-top: 20px; color: var(--text-light);">
                    <span>Doprava (kuriér)</span>
                    <span>€4.99</span>
                </div>

                <div class="summary-total">
                    <span>Spolu</span>
                    {{-- Celková suma z košíka + doprava --}}
                    <span>{{ number_format($total + 4.99, 2) }} €</span>
                </div>
            </div>
        </div>
    </div>
</div>
    <footer>© 2026 Mostly Sunny Toys</footer>
</body>

</html>