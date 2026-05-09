<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Zmenit produkt</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
    <link href="{{ asset('adminstyle.css') }}" rel="stylesheet">
   <style>
      .page-title {
         font-size: 22px;
         font-weight: 900;
         color: var(--text);
         margin-bottom: 24px;
         display: flex;
         align-items: center;
         gap: 10px;
      }

      .form-card {
         background: #302c3a;
         border-radius: 16px;
         padding: 32px;
         max-width: 680px;
         display: flex;
         flex-direction: column;
         gap: 20px;
         border: 1px solid rgba(255, 255, 255, 0.08);
      }

      .form-row {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 16px;
      }

      .form-group {
         display: flex;
         flex-direction: column;
         gap: 6px;
      }

      .form-group.full {
         grid-column: 1 / -1;
      }

      label {
         font-size: 11px;
         font-weight: 800;
         text-transform: uppercase;
         letter-spacing: 1px;
         color: var(--purple-light);
      }

      input[type="text"],
      input[type="number"],
      select,
      textarea {
         background: #231f2e;
         border: 1.5px solid rgba(255, 255, 255, 0.1);
         border-radius: 10px;
         padding: 10px 14px;
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 600;
         color: var(--text);
         outline: none;
         transition: border-color .18s;
         width: 100%;
      }

      input:focus,
      select:focus,
      textarea:focus {
         border-color: var(--purple);
      }

      textarea {
         resize: vertical;
         min-height: 100px;
      }

      select option {
         background: #231f2e;
      }

      .img-upload {
         background: #231f2e;
         border: 2px dashed rgba(255, 255, 255, 0.15);
         border-radius: 10px;
         padding: 28px;
         text-align: center;
         cursor: pointer;
         transition: border-color .18s;
         color: var(--text-light);
         font-size: 13px;
         font-weight: 700;
      }

      .img-upload:hover {
         border-color: var(--purple);
      }

      .img-upload input {
         display: none;
      }

      .img-upload-icon {
         font-size: 28px;
         margin-bottom: 8px;
      }

      .divider {
         height: 1px;
         background: rgba(255, 255, 255, 0.07);
      }

      .btn-row {
         display: flex;
         gap: 12px;
         justify-content: flex-end;
      }

      .btn-primary {
         background: var(--purple);
         color: #fff;
         border: none;
         padding: 12px 28px;
         border-radius: 10px;
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 800;
         cursor: pointer;
         transition: background .18s, transform .15s;
      }

      .btn-primary:hover {
         background: var(--purple-dark);
         transform: translateY(-1px);
      }

      .btn-secondary {
         background: transparent;
         color: var(--text-light);
         border: 1.5px solid rgba(255, 255, 255, 0.15);
         padding: 12px 28px;
         border-radius: 10px;
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 800;
         cursor: pointer;
         transition: border-color .18s;
      }

      .btn-secondary:hover {
         border-color: var(--purple-light);
         color: var(--text);
      }

      .success-toast {
         display: none;
         position: fixed;
         bottom: 28px;
         right: 28px;
         background: #3a7d44;
         color: #fff;
         padding: 14px 22px;
         border-radius: 12px;
         font-weight: 800;
         font-size: 14px;
         z-index: 999;
         animation: slideUp .3s ease;
      }

      @keyframes slideUp {
         from {
            opacity: 0;
            transform: translateY(12px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      @media (max-width: 600px) {
         .form-row {
            grid-template-columns: 1fr;
         }

         .form-card {
            padding: 20px;
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
       <div class="logo-text" onclick="location.href='{{ route('admin.dashboard') }}'">
           Mostly Sunny Admin
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
           <div class="page-title">Zmeniť produkt: {{ $product->name }}</div>

           <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')

               <div class="form-card">
                   <div class="form-row">
                       <div class="form-group">
                           <label>Názov produktu</label>
                           <input type="text" name="name" placeholder="napr. Plyšová sova" value="{{ old('name', $product->name) }}">
                       </div>
                       <div class="form-group">
                           <label>Kategória</label>
                           <select name="category">
                               <option value="">Vybrať</option>
                               @foreach(['Plyšové hračky','Bábiky','Pre najmenších','Elektronika','Puzzle','Stavebnice','Spoločenské hry','Dopravné prostriedky','Roboti','Zvieratká','Interaktívne zvieratá','Hudobné nástroje','Do záhrady','Do vody','Vozidlá'] as $cat)
                               <option value="{{ $cat }}" {{ old('category', $product->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                               @endforeach
                           </select>
                       </div>
                   </div>

                   <div class="form-row">
                       <div class="form-group">
                           <label>Cena (€)</label>
                           <input type="number" name="price" placeholder="0.00" step="0.01" min="0" value="{{ old('price', $product->price) }}">
                       </div>
                   </div>

                   <div class="form-row">
                       <div class="form-group">
                           <label>Materiál</label>
                           <input type="text" name="material" placeholder="napr. Polyester" value="{{ old('material', $product->material) }}">
                       </div>
                   </div>

                   <div class="form-row">
                       <div class="form-group">
                           <label>Skladom (ks)</label>
                           <input type="number" name="stock" placeholder="0" min="0" value="{{ old('stock', $product->stock) }}">
                       </div>
                   </div>

                   <div class="form-group">
                       <label>Farba</label>
                       <input type="text" name="color" placeholder="napr. Modrá" value="{{ old('color', $product->color ?? '') }}">
                   </div>

                   <div class="form-group">
                       <label>Popis</label>
                       <textarea name="description" placeholder="Krátky popis produktu...">{{ old('description', $product->description) }}</textarea>
                   </div>

                   <div class="divider"></div>

                   <div class="form-group">
                       <label>Fotografie produktu (min. 2, prvá bude hlavná)</label>
                       <div class="img-upload" onclick="document.getElementById('imgFiles').click()">
                           <input type="file" id="imgFiles" name="images[]" accept="image/*" multiple
                                  onchange="showFileNames(this)">
                           <div class="img-upload-icon">🖼️</div>
                           <div id="fileName">Kliknite pre výber súborov</div>
                       </div>
                   </div>

                   @if($errors->any())
                   <div style="color:#e07070;font-size:13px;font-weight:700;">
                       @foreach($errors->all() as $error)
                       <div>{{ $error }}</div>
                       @endforeach
                   </div>
                   @endif

                   <div class="btn-row">
                       <button type="button" class="btn-secondary" onclick="location.href='{{ route('admin.products.editProduct') }}'">Zrušiť</button>
                       <button type="submit" class="btn-primary">Uložiť zmeny</button>
                   </div>
               </div>
           </form>
       </main>
   </div>

   <footer>© 2026 Mostly Sunny Toys</footer>
   <div class="success-toast" id="toast">✅ Produkt bol zmenený!</div>

   <script>
       const burgerBtn = document.getElementById('burgerBtn');
       const overlay = document.getElementById('sidebarOverlay');
       const toggleSidebar = () => document.body.classList.toggle('sidebar-open');
       burgerBtn.addEventListener('click', toggleSidebar);
       overlay.addEventListener('click', toggleSidebar);
       document.addEventListener('keydown', e => { if (e.key === 'Escape') document.body.classList.remove('sidebar-open'); });
       window.addEventListener('resize', () => { if (window.innerWidth > 1100) document.body.classList.remove('sidebar-open'); });
       function showFileNames(input) {
           const names = Array.from(input.files).map(f => f.name).join(', ');
           document.getElementById('fileName').textContent = names || 'Kliknite pre výber súborov';
       }
   </script>
</body>

</html>
