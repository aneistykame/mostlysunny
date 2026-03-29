<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Vymazať produkt</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="adminstyle.css" rel="stylesheet">
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

      .btn-delete {
         background: rgba(200, 60, 60, 0.15);
         color: #e07070;
         border: 1.5px solid rgba(200, 60, 60, 0.3);
         padding: 8px 16px;
         border-radius: 8px;
         font-family: 'Nunito', sans-serif;
         font-size: 13px;
         font-weight: 800;
         cursor: pointer;
         transition: background .18s, color .18s;
         flex-shrink: 0;
      }

      .btn-delete:hover {
         background: rgba(200, 60, 60, 0.35);
         color: #ff9090;
      }

      .empty-state {
         color: rgba(255, 255, 255, 0.3);
         font-size: 14px;
         font-weight: 700;
         padding: 32px 0;
      }

      /* Confirm dialog */
      .confirm-overlay {
         display: none;
         position: fixed;
         inset: 0;
         background: rgba(20, 18, 30, 0.75);
         z-index: 300;
         align-items: center;
         justify-content: center;
         backdrop-filter: blur(3px);
      }

      .confirm-overlay.visible {
         display: flex;
      }

      .confirm-box {
         background: #302c3a;
         border-radius: 16px;
         padding: 32px;
         max-width: 360px;
         width: 90%;
         border: 1px solid rgba(255, 255, 255, 0.1);
         text-align: center;
      }

      .confirm-icon {
         font-size: 36px;
         margin-bottom: 12px;
      }

      .confirm-title {
         font-size: 18px;
         font-weight: 900;
         color: var(--text);
         margin-bottom: 8px;
      }

      .confirm-sub {
         font-size: 13px;
         color: var(--purple-light);
         margin-bottom: 24px;
      }

      .confirm-btns {
         display: flex;
         gap: 10px;
         justify-content: center;
      }

      .btn-cancel {
         background: transparent;
         color: var(--text-light);
         border: 1.5px solid rgba(255, 255, 255, 0.15);
         padding: 10px 24px;
         border-radius: 10px;
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 800;
         cursor: pointer;
      }

      .btn-confirm-delete {
         background: #c43c3c;
         color: #fff;
         border: none;
         padding: 10px 24px;
         border-radius: 10px;
         font-family: 'Nunito', sans-serif;
         font-size: 14px;
         font-weight: 800;
         cursor: pointer;
         transition: background .18s;
      }

      .btn-confirm-delete:hover {
         background: #a83030;
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
      }
   </style>
</head>

<body>
   <header>
      <div class="burger-area" id="burgerBtn">
         <div class="burger-icon"><span></span><span></span><span></span></div>
      </div>
      <div class="logo-text" onclick="location.href='adminindex.html'">Mostly Sunny Admin</div>
      <div class="header-icons">
         <button onclick="location.href='adminlogin.html'">👤 Účet</button>
      </div>
   </header>

   <div class="sidebar-overlay" id="sidebarOverlay"></div>
   <div class="page-wrapper">
      <nav class="sidebar">
         <div class="sidebar-title">Kategórie</div>
         <ul>
            <li><a href="addProduct.html">Pridať nový produkt <span class="arrow">›</span></a></li>
            <li class="active"><a href="deleteProduct.html">Vymazať produkt <span class="arrow">›</span></a></li>
            <li><a href="editProduct.html">Zmeniť detaily produktu <span class="arrow">›</span></a></li>
         </ul>
      </nav>

      <main class="main-content">
         <div class="page-title">Vymazať produkt</div>

         <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Hľadať produkt..." oninput="filterProducts()">
         </div>

         <div class="product-list" id="productList"></div>
      </main>
   </div>

   <footer>© 2026 Mostly Sunny Toys</footer>

   <!-- Confirm dialog -->
   <div class="confirm-overlay" id="confirmOverlay">
      <div class="confirm-box">
         <div class="confirm-icon">⚠️</div>
         <div class="confirm-title">Naozaj vymazať?</div>
         <div class="confirm-sub" id="confirmSub">Táto akcia sa nedá vrátiť.</div>
         <div class="confirm-btns">
            <button class="btn-cancel" onclick="closeConfirm()">Zrušiť</button>
            <button class="btn-confirm-delete" onclick="confirmDelete()">Vymazať</button>
         </div>
      </div>
   </div>

   <div class="success-toast" id="toast">✅ Produkt bol vymazaný!</div>

   <script>
      const burgerBtn = document.getElementById('burgerBtn');
      const overlay = document.getElementById('sidebarOverlay');
      const toggleSidebar = () => document.body.classList.toggle('sidebar-open');
      burgerBtn.addEventListener('click', toggleSidebar);
      overlay.addEventListener('click', toggleSidebar);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') document.body.classList.remove('sidebar-open'); });
      window.addEventListener('resize', () => { if (window.innerWidth > 1100) document.body.classList.remove('sidebar-open'); });

      let products = [
         { id: 1, name: 'Plyšová sova', category: 'Plyšové hračky', price: '€13.95' },
         { id: 2, name: 'Plyšový medvedík', category: 'Plyšové hračky', price: '€15.95' },
         { id: 3, name: 'Plyšový zajačik', category: 'Plyšové hračky', price: '€11.95' },
         { id: 4, name: 'Plyšový lev', category: 'Plyšové hračky', price: '€14.95' },
         { id: 5, name: 'Plyšový slon', category: 'Plyšové hračky', price: '€16.95' },
         { id: 6, name: 'Stavebnica základná', category: 'Stavebnice', price: '€24.95' },
         { id: 7, name: 'Spoločenská hra rodina', category: 'Spoločenské hry', price: '€19.95' },
      ];

      let deleteTargetId = null;

      function renderProducts(list) {
         const container = document.getElementById('productList');
         if (list.length === 0) {
            container.innerHTML = '<div class="empty-state">Žiadne produkty nenájdené.</div>';
            return;
         }
         container.innerHTML = list.map(p => `
            <div class="product-row" id="row-${p.id}">
               <div class="product-row-img"></div>
               <div class="product-row-info">
                  <div class="product-row-name">${p.name}</div>
                  <div class="product-row-meta">${p.category} · ${p.price}</div>
               </div>
               <button class="btn-delete" onclick="askDelete(${p.id}, '${p.name}')">Vymazať</button>
            </div>
         `).join('');
      }

      function askDelete(id, name) {
         deleteTargetId = id;
         document.getElementById('confirmSub').textContent = `„${name}" bude natrvalo vymazaný.`;
         document.getElementById('confirmOverlay').classList.add('visible');
      }

      function closeConfirm() {
         document.getElementById('confirmOverlay').classList.remove('visible');
         deleteTargetId = null;
      }

      function confirmDelete() {
         if (!deleteTargetId) return;
         products = products.filter(p => p.id !== deleteTargetId);
         closeConfirm();
         filterProducts();
         const toast = document.getElementById('toast');
         toast.style.display = 'block';
         setTimeout(() => { toast.style.display = 'none'; }, 2500);
      }

      renderProducts(products);
   </script>
</body>

</html>