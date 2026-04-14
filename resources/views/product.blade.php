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
   <title>{{ $product->name }} - Mostly Sunny Toys</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
   <link href="{{ asset('productstyle.css') }}" rel="stylesheet">
</head>

<body>

   <header>
      <div class="burger-area" id="burgerBtn">
         <div class="burger-icon">
            <span></span><span></span><span></span>
         </div>
      </div>
      <div class="logo-text" onclick="location.href='{{ route('index') }}'">
         Mostly Sunny Toys
      </div>
      <form action="{{ route('products.index') }}" method="GET" class="search-box">
         <span class="search-icon">🔍</span>
         <input type="text" name="search" placeholder="Hľadať produkty..." value="{{ request('search') }}">
      </form>
      <div class="header-icons">
         @auth
            <button title="Môj profil" onclick="location.href='{{ route('dashboard') }}'">
               👤 {{ Auth::user()->name }}
            </button>
         @else
            <button title="Prihlásiť sa" onclick="location.href='{{ route('login') }}'">
               👤 Prihlásiť sa
            </button>
         @endauth
         <button title="Košík" onclick="location.href='{{ route('cart.index') }}'" style="position: relative;">
         🛒 Košík
         @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
         @endif
      </button>
      </div>
   </header>
   <div class="sidebar-overlay" id="sidebarOverlay"></div>
   <div class="page-wrapper">
      <nav class="sidebar">
         <div class="sidebar-title">Kategórie</div>
         <ul>
            <li><a href="{{ route('category', 'Plyšové hračky') }}">Plyšové hračky <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Bábiky') }}">Bábiky <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Pre najmenších') }}">Pre najmenších <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Elektronika') }}">Elektronika <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Puzzle') }}">Puzzle <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Stavebnice') }}">Stavebnice <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Spoločenské hry') }}">Spoločenské hry <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Dopravné prostriedky') }}">Dopravné prostriedky <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Roboti') }}">Roboti <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Zvieratká') }}">Zvieratká <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Interaktívne zvieratá') }}">Interaktívne zvieratá <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Hudobné nástroje') }}">Hudobné nástroje <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Do záhrady') }}">Do záhrady <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Do vody') }}">Do vody <span class="arrow">›</span></a></li>
            <li><a href="{{ route('category', 'Vozidlá') }}">Vozidlá <span class="arrow">›</span></a></li>
         </ul>
      </nav>

      <div class="product-page">

         <nav class="breadcrumb">
            <a href="{{ route('index') }}">Domov</a>
            <span>›</span>
            <a href="{{ route('category', $product->category) }}">{{ $product->category }}</a>
            <span>›</span>
            {{ $product->name }}
         </nav>

         <!-- MAIN PRODUCT SECTION -->
         <section class="product-main">

            <!-- THUMBNAILS -->
            <div class="thumbs" id="thumbs">
               @foreach($product->images as $img)
               <div class="thumb {{ $loop->first ? 'active' : '' }}" data-src="{{ asset($img->image) }}">
                  <img src="{{ asset($img->image) }}" alt="{{ $product->name }}">
               </div>
               @endforeach
            </div>

            <!-- MAIN IMAGE -->
            <div class="main-img-wrap">
               <img class="main-img" id="mainImg"
                     src="{{ asset($product->images->first()->image ?? $product->image) }}"
                     alt="{{ $product->name }}">
            </div>

            <!-- INFO -->
            <div class="product-info">
               <div class="product-category">{{ $product->category }}</div>
               <h1 class="product-title">{{ $product->name }}</h1>

               <div class="product-rating">
                  <span class="stars">★★★★★</span>
                  <span class="rating-count">4.9 (38 recenzií)</span>
               </div>

               <div class="divider"></div>

               <div class="specs-grid">
                  <div class="specs-grid">
                     @if($product->material)
                     <div class="spec-item">
                        <div class="spec-label">Materiál</div>
                        <div class="spec-value">{{ $product->material }}</div>
                     </div>
                     @endif
                     @if($product->color)
                     <div class="spec-item">
                        <div class="spec-label">Farba</div>
                        <div class="spec-value">{{ $product->color }}</div>
                     </div>
                     @endif
                  </div>
                  <div class="spec-item">
                     <div class="spec-label">Vhodné od</div>
                     <div class="spec-value">0+</div>
                  </div>
               </div>

               <div class="divider"></div>

               <div class="price-block">
                  <div class="product-price">€{{ number_format($product->price, 2) }}</div>
                  <div class="price-note">vrátane DPH</div>
               </div>

               <div class="buy-row">
                  <div class="qty-wrap">
                     <button class="qty-btn" id="qtyMinus">−</button>
                     <input class="qty-input" id="qtyInput" type="number" value="1" min="1" name = "qtyInput">
                     <button class="qty-btn" id="qtyPlus">+</button>
                  </div>
                  <form action="{{ route('cart.add', $product->id) }}" method="POST" id="cartForm">
                     @csrf
                     <input type="hidden" name="quantity" id="quantityHidden" value="1">
                     <button type="submit" class="btn-cart-main">🛒 Do košíka</button>
                  </form>
                  <button class="btn-wishlist" title="Pridať do wishlistu">♡</button>
               </div>

               <div class="trust-row">
                  <div class="trust-badge"><span class="trust-badge-icon">🚚</span> Doprava od 20 €</div>
                  <div class="trust-badge"><span class="trust-badge-icon">🔄</span> Vrátenie 30 dní</div>
                  <div class="trust-badge"><span class="trust-badge-icon">✅</span> Certifikované</div>
               </div>
            </div>

         </section>

         <!-- DESCRIPTION -->
         <section class="desc-section">
            <div class="desc-tabs">
               <button class="desc-tab active">O produkte</button>
               <button class="desc-tab">Parametre</button>
               <button class="desc-tab">Recenzie (38)</button>
            </div>
            <div class="desc-body">
               {{ $product->description }}
            </div>
         </section>

      </div>
   </div>

   <footer>© 2026 Mostly Sunny Toys</footer>

   <script>
      /* BURGER*/
      const burgerBtn = document.getElementById('burgerBtn');
      const overlay = document.getElementById('sidebarOverlay');
      const toggleSidebar = () => document.body.classList.toggle('sidebar-open');
      burgerBtn.addEventListener('click', toggleSidebar);
      overlay.addEventListener('click', toggleSidebar);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') document.body.classList.remove('sidebar-open'); });
      window.addEventListener('resize', () => {
         if (window.innerWidth > 1100) document.body.classList.remove('sidebar-open');
      });

      /*IMAGE SWITCH*/
      const mainImg = document.getElementById('mainImg');
      const thumbs = document.querySelectorAll('.thumb');

      function switchImage(thumb) {
         const src = thumb.dataset.src;
         if (mainImg.src.endsWith(src) && !mainImg.classList.contains('switching')) return;
         mainImg.classList.add('switching');

         setTimeout(() => {
            mainImg.src = src;
            mainImg.onload = () => mainImg.classList.remove('switching');
            if (mainImg.complete) mainImg.classList.remove('switching');
         }, 200);

         thumbs.forEach(t => t.classList.remove('active'));
         thumb.classList.add('active');
      }

      thumbs.forEach(thumb => {
         thumb.addEventListener('click', () => switchImage(thumb));
      });


      document.querySelectorAll('.desc-tab').forEach(tab => {
         tab.addEventListener('click', () => {
            document.querySelectorAll('.desc-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
         });
      });

      const qtyInput = document.getElementById('qtyInput');
      const quantityHidden = document.getElementById('quantityHidden');

      document.getElementById('qtyMinus').addEventListener('click', () => {
         if (qtyInput.value > 1) qtyInput.value--;
         quantityHidden.value = qtyInput.value;
      });
      document.getElementById('qtyPlus').addEventListener('click', () => {
         qtyInput.value++;
         quantityHidden.value = qtyInput.value;
      });

      qtyInput.addEventListener('input', () => {
         quantityHidden.value = qtyInput.value;
      });
   </script>

</body>

</html>