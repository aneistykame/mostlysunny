<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Vymazať produkt</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
    <link href="{{ asset('adminstyle.css') }}" rel="stylesheet">
   <style>
      .page-title {
         font-size: 22px;
         font-weight: 900;
         color: var(--text);
         margin-bottom: 24px;
      }

      .search-bar {
         display: flex;
         gap: 10px;
         max-width: 500px;
         margin-bottom: 24px;
      }

      .search-bar input {
         flex: 1;
         background: #302c3a;
         border: 1.5px solid rgba(255, 255, 255, 0.1);
         border-radius: 10px;
         padding: 10px 16px;
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 600;
         color: var(--text);
         outline: none;
         transition: border-color .18s;
      }

      .search-bar input:focus {
         border-color: var(--purple);
      }

      .search-bar input::placeholder {
         color: rgba(255, 255, 255, 0.3);
      }

      .product-list {
         display: flex;
         flex-direction: column;
         gap: 10px;
         max-width: 700px;
      }

      .product-row {
         background: #302c3a;
         border: 1px solid rgba(255, 255, 255, 0.08);
         border-radius: 12px;
         padding: 14px 18px;
         display: flex;
         align-items: center;
         gap: 14px;
         transition: border-color .18s;
      }

      .product-row:hover {
         border-color: rgba(255, 255, 255, 0.18);
      }

      .product-row-img {
         width: 52px;
         height: 52px;
         border-radius: 8px;
         background: #231f2e;
         object-fit: cover;
         flex-shrink: 0;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 22px;
      }

      .product-row-info {
         flex: 1;
         min-width: 0;
      }

      .product-row-name {
         font-size: 14px;
         font-weight: 800;
         color: var(--text);
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis;
      }

      .product-row-meta {
         font-size: 12px;
         color: var(--purple-light);
         font-weight: 600;
         margin-top: 2px;
      }

      .btn-edit {
         background: rgba(144, 60, 200, 0.15);
         color: #663594;
         border: 1.5px solid rgba(149, 60, 200, 0.3);
         padding: 8px 16px;
         border-radius: 8px;
         font-family: 'Nunito', sans-serif;
         font-size: 13px;
         font-weight: 800;
         cursor: pointer;
         transition: background .18s, color .18s;
         flex-shrink: 0;
      }

      .btn-edit:hover {
         background: rgba(53, 67, 190, 0.35);
         color: #90bcff;
      }

      .empty-state {
         color: rgba(255, 255, 255, 0.3);
         font-size: 14px;
         font-weight: 700;
         padding: 32px 0;
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
       <div class="logo-text" onclick="location.href='{{ route('admin.dashboard') }}'">
           Mostly Sunny Admin
       </div>
       <div class="header-icons">
           @auth
           <button title="Môj profil" onclick="location.href='{{ Auth::user()->role === 'admin' ? route('admin.profile') : route('dashboard') }}'">
               <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
           </button>
           @else
           <button title="Prihlásiť sa" onclick="location.href='{{ route('login') }}'">
               <i class="fa-solid fa-circle-user"></i> Prihlásiť sa
           </button>
           @endauth
       </div>
   </header>

   <div class="sidebar-overlay" id="sidebarOverlay"></div>
   <div class="page-wrapper">
      <nav class="sidebar">
         <div class="sidebar-title">Kategórie</div>
         <ul>
             <li><a href="{{ route('admin.products.create') }}">Pridať nový produkt <span class="arrow">›</span></a></li>
             <li><a href="{{ route('admin.products.deleteProduct') }}">Vymazať produkt <span class="arrow">›</span></a></li>
             <li class="active"><a href="{{ route('admin.products.editProduct') }}">Zmeniť detaily produktu <span class="arrow">›</span></a></li>
         </ul>
      </nav>

      <main class="main-content">
         <div class="page-title">Zmeniť detaily produktu</div>

         <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Hľadať produkt..." oninput="filterProducts()">
         </div>

         <div class="product-list" id="productList">
             @forelse($products as $product)
             <div class="product-row" id="row-{{ $product->id }}" data-name="{{ strtolower($product->name) }}">
                 <div class="product-row-img">
                     <img src="{{ asset($product->mainImage->image ?? 'src/img/placeholder.jpg') }}"
                          style="width:52px;height:52px;border-radius:8px;object-fit:cover;" alt="">
                 </div>
                 <div class="product-row-info">
                     <div class="product-row-name">{{ $product->name }}</div>
                     <div class="product-row-meta">{{ $product->category }} · {{ number_format($product->price, 2) }} €</div>
                 </div>
                 <button class="btn-edit" onclick="location.href='{{ route('admin.products.edit', $product->id) }}'">Zmeniť</button>
             </div>
             @empty
             <div class="empty-state">Žiadne produkty.</div>
             @endforelse
         </div>
      </main>
   </div>

   <footer>© 2026 Mostly Sunny Toys</footer>

   <script>
      const burgerBtn = document.getElementById('burgerBtn');
      const overlay = document.getElementById('sidebarOverlay');
      const toggleSidebar = () => document.body.classList.toggle('sidebar-open');
      burgerBtn.addEventListener('click', toggleSidebar);
      overlay.addEventListener('click', toggleSidebar);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') document.body.classList.remove('sidebar-open'); });
      window.addEventListener('resize', () => { if (window.innerWidth > 1100) document.body.classList.remove('sidebar-open'); });

      function filterProducts() {
          const q = document.getElementById('searchInput').value.toLowerCase();
          document.querySelectorAll('.product-row').forEach(row => {
              row.style.display = row.dataset.name.includes(q) ? '' : 'none';
          });
      }
   </script>
</body>

</html>
