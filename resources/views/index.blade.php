<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mostly Sunny Toys</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
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
      <div class="search-box">
         <span class="search-icon">🔍</span>
         <input type="text" placeholder="Hľadať produkty...">
      </div>
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

         <button title="Košík" onclick="location.href='{{ url('cart') }}'">🛒 Košík</button>
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
               <article class="product-card" onclick="location.href='product'">
                  <div class="product-img-wrapper"><img class="product-img" src="{{ asset($product->mainImage->image ?? 'src/img/placeholder.jpg') }}" alt="{{ $product->name }}"></div>
                  <div class="product-info">
                     <h3 class="product-name">{{ $product->name }}</h3>
                     <div class="product-footer">
                        <p class="product-price">{{ $product->price }} €</p>
                        <button class="btn-cart">Do košíka</button>
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