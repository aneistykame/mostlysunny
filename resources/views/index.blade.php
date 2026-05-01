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
   <title>Mostly Sunny Toys</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
</head>

<body>
   
   <header>
      <div class="burger-area" id="burgerBtn">
         <div class="burger-icon">
            <span></span><span></span><span></span>
         </div>
      </div>
      
      <div class="logo-text">
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

         <div class="banner-large">
            <div class="large-content">
               <div>
                  <div class="large-intro">☀ Jarná kolekcia 2026</div>
                  <div class="large-title">Zľava na všetko<br>s kódom <em>"APRIL24"</em></div>
               </div>
               <button class="large-go" onclick="location.href='category'">Nakupovať →</button>
            </div>
         </div>
         <div class="midi-banners">
            <div class="banner-medium">
               <div class="banner-medium-text"><strong>Neviete, čo si vybrať?</strong> <span>Vyplňte formulár!</span>
               </div>
               <div class="banner-medium-arrow">›</div>
            </div>
            <div class="banner-medium">
               <div class="banner-medium-text"><strong>Novinky každý týždeň</strong> <span>Sledujte nás na
                     Instagram</span>
               </div>
               <div class="banner-medium-arrow">›</div>
            </div>
         </div>

         <div class="section-hd">
            <h1 class="section-hd-title">Odporúčané produkty</h1>
            <a href="category" class="section-hd-link">Zobraziť všetky →</a>
         </div>

         <section class="product-grid">
            @foreach($products->take(5) as $product)
               {{-- Odstránil som onclick z article, aby sa karta správala prirodzene --}}
               <article class="product-card">
                     {{-- Kliknutím na obrázok alebo meno pôjdeš na detail --}}
                     <div class="product-img-wrapper" onclick="location.href='{{ route('product.show', $product->id) }}'" style="cursor: pointer;">
                        <img class="product-img" src="{{ asset($product->mainImage->image ?? 'src/img/placeholder.jpg') }}" alt="{{ $product->name }}">
                     </div>
                     <div class="product-info">
                        <h3 class="product-name" onclick="location.href='product'" style="cursor: pointer;">
                           {{ $product->name }}
                        </h3>  
                        <div class="product-footer">
                           <p class="product-price">{{ number_format($product->price, 2) }} €</p>
                           
                           {{-- FORMULÁR PRE PRIDANIE DO KOŠÍKA --}}
                           <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                 @csrf
                                 {{-- Skrytý vstup pre množstvo (defaultne 1) --}}
                                 <input type="hidden" name="quantity" value="1">
                                 <button type="submit" class="btn-cart">Do košíka</button>
                           </form>
                        </div>
                     </div>
               </article>
            @endforeach
         </section>

         <section class="promo-row">
            <article class="promo-box" onclick="location.href='category'">
               <div class="promo-box-bg"></div>
               <div class="promo-box-overlay"></div>
               <div class="promo-box-body">
                  <div>
                     <div class="promo-box-tag">Špeciálna ponuka</div>
                     <div class="promo-box-title">Plyšové hračky<br>od 10 €</div>
                  </div>
                  <button class="promo-btn">Zobraziť →</button>
               </div>
            </article>
            <article class="promo-box">
               <div class="promo-box-bg"></div>
               <div class="promo-box-overlay"></div>
               <div class="promo-box-body">
                  <div>
                     <div class="promo-box-title">2 % z nákupu<br>ide lesom</div>
                  </div>
                  <button class="promo-btn">Viac info →</button>
               </div>
            </article>
         </section>
      </main>
   </div>

   <footer>
      © 2026 Mostly Sunny Toys
   </footer>
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
         if (window.innerWidth > 1100) document.body.classList.remove('sidebar-open');
      });
   </script>
</body>

</html>