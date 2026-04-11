<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kategória – Mostly Sunny Toys</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="{{ asset('mainstyle.css') }}" rel="stylesheet">
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

         <section class="category-topbar">
            <h1 class="category-title">{{ $category }}</h1>
            <div class="wrapper">
               <select class="sort-select">
                  <option>Všetky</option>
                  <option>Iba veľké</option>
                  <option>Iba malé</option>
                  <option>Iba s hodnotením</option>
               </select>
               <select class="sort-select">
                  <option>Zoradiť: Odporúčané</option>
                  <option>Cena: od najnižšej</option>
                  <option>Cena: od najvyššej</option>
                  <option>Najnovšie</option>
               </select>
            </div>


         </section>

         <section class="product-grid" id="productGrid">

            @foreach($products as $product)
            <article class="product-card" onclick="location.href='{{ route('product.show', $product->id) }}'">
               <div class="product-img-wrapper">
                  <img class="product-img" src="{{ asset($product->mainImage->image ?? 'src/img/placeholder.jpg') }}"
                        onerror="this.style.background='#d4d0e0';this.removeAttribute('src')">
               </div>
               <div class="product-info">
                  <div class="product-name">{{ $product->name }}</div>
                  <div class="product-footer">
                        <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                        <button class="btn-cart">Do košíka</button>
                  </div>
               </div>
            </article>
            @endforeach


         </section>
         <div class="pagination" id="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
         </div>

      </main>
   </div><!-- /.page-wrapper -->

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