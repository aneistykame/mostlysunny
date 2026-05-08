<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Platba</title>
    <style>
        :root {
            --purple: #8584B3;
            --purple-light: #b8b7d8;
            --purple-dark: #6b6a9a;
            --bg: #e8e8f5;
            --sidebar-bg: #d8d8ee;
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

        .payment-section {
            flex: 2;
        }

        .payment-option {
            padding: 15px;
            border: 1px solid var(--text-light);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .payment-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .payment-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-option input {
            margin-right: 8px;
        }

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
            <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" placeholder="Hľadať produkty...">
        </div>
        <div class="header-icons">
            <button title="Účet" onclick="location.href='login.html'">
                <i class="fa-solid fa-user"></i> Účet
            </button>
            <button title="Košík" onclick="location.href='cart.html'">
                <i class="fa-solid fa-cart-shopping"></i> Košík
            </button>
        </div>
    </header>
    <div class="main">
        <div class="cart-container">
            <div class="checkout-steps">
                Košík → Doprava → <b>Platba</b> → Údaje
            </div>
            <form action="{{ route('checkout.storePayment') }}" method="POST">
                @csrf
                <div class="checkout-layout">
                    <div class="payment-section">
                        <h3 style="margin-bottom:20px;">Vyber spôsob platby</h3>
                        
                        @foreach($paymentMethods as $method)
                        <div class="payment-option">
                            <div class="payment-head">
                                <div class="payment-left">
                                    <input type="radio" name="payment_id" value="{{ $method->payment_id }}" 
                                        {{ $loop->first ? 'checked' : '' }} class="payment-radio">
                                    <span>{{ $method->name }}</span>
                                </div>
                            </div>

                                @if($method->name == 'Platba kartou')
<div class="card-details-fields" id="card-fields" style="margin-top: 15px;">
    <div class="form-group">
        <label>Číslo karty</label>
        <input type="text" id="card_number" name="card_num" 
               placeholder="0000 0000 0000 0000" 
               pattern="\d{16}" title="Zadajte 16 číslic čísla karty" 
               maxlength="16">
    </div>
    <div style="display:flex; gap:10px;">
        <div class="form-group" style="flex:2;">
            <label>Platnosť (MM/YY)</label>
            <input type="text" id="card_expiry" name="card_exp" 
                   placeholder="MM/YY" 
                   pattern="(0[1-9]|1[0-2])\/?([0-9]{2})" 
                   title="Formát musí byť MM/YY" maxlength="5">
        </div>
        <div class="form-group" style="flex:1;">
            <label>CVC</label>
            <input type="text" id="card_cvc" name="card_cvc" 
                   placeholder="123" 
                   pattern="\d{3}" title="Zadajte 3 číslice na zadnej strane karty" 
                   maxlength="3">
        </div>
    </div>
</div>
@endif
                        </div>
                        @endforeach

                        <button type="submit" class="checkout-btn">Pokračovať k údajom</button>
                    </div>

                    <div class="cart-summary">
                        <div class="summary-title">Tvoj košík</div>
                        
                        @foreach($cartItems as $item)
                            <div class="summary-item">
                                <span>{{ is_object($item) ? $item->product->name : $item['name'] }} ×{{ is_object($item) ? $item->quantity : $item['quantity'] }}</span>
                                <span>€{{ number_format((is_object($item) ? $item->product->price : $item['price']) * (is_object($item) ? $item->quantity : $item['quantity']), 2) }}</span>
                            </div>
                        @endforeach
                        
                        <div class="summary-item" style="margin-top: 20px; color: var(--text-light);">
                            <span>Doprava ({{ $shipping['name'] }})</span>
                            <span>€{{ number_format($shipping['price'], 2) }}</span>
                        </div>

                        <div class="summary-total">
                            <span>Spolu</span>
                            <span>€{{ number_format($total + $shipping['price'], 2) }}</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>© 2026 Mostly Sunny Toys</footer>
</body>

</html>