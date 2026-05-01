@php
    $cartCount = 0;
    if (auth()->check()) {
        $cartCount = \App\Models\CartItem::whereHas('cart', function($q) {
            $q->where('user_id', auth()->id());
        })->sum('quantity');
    } else {
        $cartCount = collect(session()->get('cart'))->sum('quantity');
    }
@endphp

<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kategória - Mostly Sunny Toys</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
      .category-topbar {
         display: flex;
         align-items: center;
         justify-content: space-between;
         margin-bottom: 14px;
      }

      .category-title {
         font-size: 18px;
         font-weight: 700;
         color: var(--purple-dark);
         display: flex;
         align-items: center;
         gap: 4px;
         letter-spacing: 0.6px;
         text-transform: uppercase;
      }

      .sort-select {
         padding: 6px 12px;
         border-radius: 8px;
         border: none;
         background: #dddaf0;
         font-family: 'Nunito', sans-serif;
         font-size: 13px;
         color: var(--text);
         cursor: pointer;
         outline: none;
      }

      /* ── PAGINATION ── */
      .pagination {
         display: flex;
         justify-content: center;
         align-items: center;
         gap: 6px;
         padding: 20px 0 4px;
      }

      .page-btn {
         width: 34px;
         height: 34px;
         border-radius: 8px;
         border: none;
         background: #dddaf0;
         color: var(--text);
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 700;
         cursor: pointer;
         transition: background 0.15s, color 0.15s, transform 0.1s;
      }

      .page-btn:hover {
         background: var(--purple-light);
         color: #fff;
      }

      .page-btn.active {
         background: var(--purple);
         color: #fff;
      }

      .page-btn.arrow {
         font-size: 16px;
         background: #ccc8e4;
      }

      .page-btn.arrow:hover {
         background: var(--purple);
         color: #fff;
      }

      .product-card.hidden {
         display: none;
      }
      .product-grid {
         align-content: start;
         justify-content: start;
         grid-template-columns: repeat(auto-fill, minmax(180px, 220px));
      }

      .product-card {
         max-width: 220px;
      }
      @media (max-width: 700px) {
         .main-content {
            padding: 10px;
         }
      }
   </style>
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
         <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
         <input type="text" name="search" placeholder="Hľadať produkty..." value="{{ request('search') }}">
      </form>
      <div class="header-icons">
         @auth
            <button title="Môj profil" onclick="location.href='{{ route('dashboard') }}'">
               <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
            </button>
         @else
            <button title="Prihlásiť sa" onclick="location.href='{{ route('login') }}'">
               <i class="fa-solid fa-user"></i> Prihlásiť sa
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

      <main class="main-content">

         <form method="GET" action="{{ route('category', $category) }}" id="filterForm">
      <section class="category-topbar">
         <h1 class="category-title">{{ $category }}</h1>
         <div class="wrapper">

               <select class="sort-select" name="color" onchange="document.getElementById('filterForm').submit()">
                  <option value="">Všetky farby</option>
                  @foreach($colors as $color)
                     <option value="{{ $color }}" {{ request('color') == $color ? 'selected' : '' }}>
                           {{ $color }}
                     </option>
                  @endforeach
               </select>

               <select class="sort-select" name="material" onchange="document.getElementById('filterForm').submit()">
                  <option value="">Všetky materiály</option>
                  @foreach($materials as $material)
                     <option value="{{ $material }}" {{ request('material') == $material ? 'selected' : '' }}>
                           {{ $material }}
                     </option>
                  @endforeach
               </select>

               <input class="sort-select" type="number" name="price_min" placeholder="Cena od €"
                     value="{{ request('price_min') }}" style="width:90px">
               <input class="sort-select" type="number" name="price_max" placeholder="Cena do €"
                     value="{{ request('price_max') }}" style="width:90px">

               <select class="sort-select" name="sort" onchange="document.getElementById('filterForm').submit()">
                  <option value="">Zoradiť: Odporúčané</option>
                  <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                     Cena: od najnižšej
                  </option>
                  <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                     Cena: od najvyššej
                  </option>
                  <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                     Najnovšie
                  </option>
               </select>

               <button type="submit" class="sort-select" style="cursor:pointer">Filtrovať</button>
         </div>
      </section>
</form>
         <section class="product-grid" id="productGrid">
            @foreach($products as $product)
               <article class="product-card">
                  <div class="product-img-wrapper" onclick="location.href='{{ route('product.show', $product->id) }}'" style="cursor: pointer;">
                        <img class="product-img" src="{{ asset($product->mainImage->image ?? 'src/img/placeholder.jpg') }}"
                           onerror="this.style.background='#d4d0e0';this.removeAttribute('src')">
                  </div>
                  <div class="product-info">
                     <h3 class="product-name">{{ $product->name }}</h3>
                     <div class="product-footer">
                        <p class="product-price">€{{ number_format($product->price, 2) }}</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    {{-- Skrytý vstup pre množstvo --}}
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-cart">Do košíka</button>
                        </form>
                     </div>
                  </div>
               </article>
            @endforeach
         </section>
         <div class="pagination" id="pagination">
            
            @if ($products->onFirstPage())
               <button class="page-btn arrow" disabled style="opacity: 0.5; cursor: not-allowed;">&lsaquo;</button>
            @else
               <button class="page-btn arrow" onclick="location.href='{{ $products->previousPageUrl() }}'">&lsaquo;</button>
            @endif

            {{-- čísla strán --}}
            @foreach ($products->onEachSide(2)->linkCollection() as $link)
               @if (is_numeric($link['label']))
                     {{-- Číselné stránky --}}
                     <button class="page-btn {{ $link['active'] ? 'active' : '' }}" 
                           onclick="location.href='{{ $link['url'] }}'">
                        {{ $link['label'] }}
                     </button>
               @elseif ($link['label'] === '...')
                     
                     <span class="page-btn" style="cursor: default; background: transparent; display: flex; align-items: center; justify-content: center;">...</span>
               @endif
            @endforeach

            @if ($products->hasMorePages())
               <button class="page-btn arrow" onclick="location.href='{{ $products->nextPageUrl() }}'">&rsaquo;</button>
            @else
               <button class="page-btn arrow" disabled style="opacity: 0.5; cursor: not-allowed;">&rsaquo;</button>
            @endif
         </div>

      </main>
   </div>

   <footer>© 2026 Mostly Sunny Toys</footer>

   <script>
      const burgerBtn = document.getElementById('burgerBtn');
      const overlay = document.getElementById('sidebarOverlay');

      function toggleSidebar() {
         document.body.classList.toggle('sidebar-open');
      }

      burgerBtn.addEventListener('click', toggleSidebar);
      overlay.addEventListener('click', toggleSidebar);

      document.addEventListener('keydown', e => {
         if (e.key === 'Escape') document.body.classList.remove('sidebar-open');
      });

      window.addEventListener('resize', () => {
         if (window.innerWidth > 1100) {
            document.body.classList.remove('sidebar-open');
         }
      });
   </script>

</body>

</html>