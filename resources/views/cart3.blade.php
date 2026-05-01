<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="mainstyle.css" rel="stylesheet">
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
            <div class="checkout-layout">
                <!-- LEFT SIDE -->
                <div class="payment-section">
                    <h3 style="margin-bottom:20px;">Vyber spôsob platby</h3>
                    <!-- Platba kartou -->
                    <div class="payment-option">
                        <div class="payment-head">
                            <div class="payment-left">
                                <input type="radio" name="payment">
                                <span>Platba kartou</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Typ karty</label>
                            <select>
                                <option>MasterCard</option>
                                <option>Visa</option>
                                <option>AMEX</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Číslo karty</label>
                            <input type="text">
                        </div>
                        <div class="form-group">
                            <label>Mesiac/rok platnosti</label>
                            <input type="text">
                        </div>
                        <div class="form-group">
                            <label>CVC</label>
                            <input type="text">
                        </div>
                    </div>
                    <!-- Apple/Google Pay -->
                    <div class="payment-option">
                        <div class="payment-head">
                            <div class="payment-left">
                                <input type="radio" name="payment">
                                <span>Apple Pay / Google Pay</span>
                            </div>
                        </div>
                        <p style="font-size:14px;">Platba prebehne cez Apple Pay alebo Google Pay.</p>
                    </div>
                    <!-- Dobierka -->
                    <div class="payment-option">
                        <div class="payment-head">
                            <div class="payment-left">
                                <input type="radio" name="payment">
                                <span>Dobierka</span>
                            </div>
                        </div>
                        <p style="font-size:14px;">Hotovosť pri doručení.</p>
                    </div>
                    <button class="checkout-btn" onclick="location.href='cart4.html'">Pokračovať k údajom</button>
                </div>
                <!-- RIGHT SIDE -->
                <div class="cart-summary">
                    <div class="summary-title">Tvoj košík</div>
                    <div class="summary-item">
                        <span>Plyšový medveď ×1</span>
                        <span>€15.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Doprava</span>
                        <span>€4.99</span>
                    </div>
                    <div class="summary-total">
                        <span>Spolu</span>
                        <span>€20.98</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>© 2026 Mostly Sunny Toys</footer>
</body>

</html>