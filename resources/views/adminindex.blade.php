<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mostly Sunny Toys</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="{{ asset('adminstyle.css') }}" rel="stylesheet">
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
            <li><a href="{{ route('admin.products.editProduct') }}">Zmeniť detaily produktu <span class="arrow">›</span></a></li>
         </ul>
      </nav>
      <main class="main-content">
         <div class="placeholder-text">Ako ste na tom dnes?</div>
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
