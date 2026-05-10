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
   <title>Dodacie údaje</title>

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

      /* FORM */
      .form-section {
         flex: 2;
      }

      .form-grid {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 15px;
      }

      .form-group {
         display: flex;
         flex-direction: column;
      }

      .form-group.full {
         grid-column: 1 / 3;
      }

      label {
         font-size: 13px;
         margin-bottom: 5px;
         color: var(--text-light);
      }

      input {
         padding: 10px;
         border-radius: 6px;
         border: 1px solid var(--text-light);
         font-size: 14px;
      }

      /* SUMMARY */
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

         .form-grid {
            grid-template-columns: 1fr;
         }

         .form-group.full {
            grid-column: auto;
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

         <div class="checkout-steps">
            Košík → Doprava → Platba → <b>Údaje</b>
         </div>

         <form action="{{ route('checkout.placeOrder') }}" method="POST">
    @csrf
    <div class="checkout-layout">
        <div class="form-section">
            <h3 style="margin-bottom:20px;">Dodacie údaje</h3>
            <div class="form-grid">
                <div class="form-group"><label>Meno</label><input type="text" name="first_name" required></div>
                <div class="form-group"><label>Priezvisko</label><input type="text" name="last_name" required></div>
                <div class="form-group full">
    <label>Email</label>
    <input type="email"
           name="email"
           placeholder="meno@domena.sk"
           required
           {{-- Ak je prihlásený, vyplň email a pridaj atribút readonly --}}
           @auth
               value="{{ auth()->user()->email }}"
               readonly
               style="background-color: #f0f0f0; cursor: not-allowed;"
           @endauth
    >
    @auth
        <small style="color: var(--text-light); font-size: 11px; margin-top: 4px;">
            Email nie je možné zmeniť, pretože ste prihlásený.
        </small>
    @endauth
</div>
                <div class="form-group full"><label>Telefón</label><input type="tel" name="phone" required></div>
                <div class="form-group full"><label>Ulica a číslo</label><input type="text" name="address" required></div>
                <div class="form-group"><label>Mesto</label><input type="text" name="city" required></div>
                <div class="form-group"><label>PSČ</label><input type="text" name="zip" required></div>
            </div>

            <input type="hidden" name="total_val" value="{{ $total + $shipping['price'] }}">

            <button type="submit" class="checkout-btn">Dokončiť objednávku</button>
        </div>

        <div class="cart-summary">
            <div class="summary-title">Tvoj košík</div>
            @foreach($cartItems as $item)
                <div class="summary-item">
                    <span>{{ is_object($item) ? $item->product->name : $item['name'] }}</span>
                    <span>€{{ number_format((is_object($item) ? $item->product->price : $item['price']) * (is_object($item) ? $item->quantity : $item['quantity']), 2) }}</span>
                </div>
            @endforeach
            <div class="summary-item" style="border-top: 1px solid #ccc; padding-top: 10px;">
                <span>Doprava: {{ $shipping['name'] }}</span>
                <span>€{{ number_format($shipping['price'], 2) }}</span>
            </div>
            <div class="summary-item">
                <span>Spôsob Platby: {{ $payment['name'] }}</span>
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

   <footer>
      © 2026 Mostly Sunny Toys
   </footer>

</body>

</html>
