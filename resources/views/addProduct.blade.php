<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pridať produkt</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="adminstyle.css" rel="stylesheet">
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
            <li class="active"><a href="addProduct.html">Pridať nový produkt <span class="arrow">›</span></a></li>
            <li><a href="deleteProduct.html">Vymazať produkt <span class="arrow">›</span></a></li>
            <li><a href="editProduct.html">Zmeniť detaily produktu <span class="arrow">›</span></a></li>
         </ul>
      </nav>

      <main class="main-content">
         <div class="page-title">Pridať nový produkt</div>

         <div class="form-card">
            <div class="form-row">
               <div class="form-group">
                  <label>Názov produktu</label>
                  <input type="text" id="name" placeholder="napr. Plyšová sova">
               </div>
               <div class="form-group">
                  <label>Kategória</label>
                  <select id="category">
                     <option value="">Vybrať</option>
                     <option>Plyšové hračky</option>
                     <option>Bábiky</option>
                     <option>Pre najmenších</option>
                     <option>Elektronika</option>
                     <option>Puzzle</option>
                     <option>Stavebnice</option>
                     <option>Spoločenské hry</option>
                     <option>Dopravné prostriedky</option>
                     <option>Roboti</option>
                     <option>Zvieratká</option>
                     <option>Interaktívne zvieratá</option>
                     <option>Hudobné nástroje</option>
                     <option>Do záhrady</option>
                     <option>Do vody</option>
                     <option>Vozidlá</option>
                  </select>
               </div>
            </div>

            <div class="form-row">
               <div class="form-group">
                  <label>Cena (€)</label>
                  <input type="number" id="price" placeholder="0.00" step="0.01" min="0">
               </div>
               <div class="form-group">
                  <label>Skladom (ks)</label>
                  <input type="number" id="stock" placeholder="0" min="0">
               </div>
            </div>

            <div class="form-row">
               <div class="form-group">
                  <label>Materiál</label>
                  <input type="text" id="material" placeholder="napr. Polyester">
               </div>
               <div class="form-group">
                  <label>Veľkosť</label>
                  <input type="text" id="size" placeholder="napr. 20 cm">
               </div>
            </div>

            <div class="form-group">
               <label>Popis</label>
               <textarea id="desc" placeholder="Krátky popis produktu..."></textarea>
            </div>

            <div class="divider"></div>

            <div class="form-group">
               <label>Fotografia produktu</label>
               <div class="img-upload" onclick="document.getElementById('imgFile').click()">
                  <input type="file" id="imgFile1" accept="image/*" onchange="showFileName(this)">
                  <div class="img-upload-icon">🖼️</div>
                  <div id="fileName">Kliknite pre výber súboru 1</div>
               </div>
               <div class="img-upload" onclick="document.getElementById('imgFile').click()">
                  <input type="file" id="imgFile2" accept="image/*" onchange="showFileName(this)">
                  <div class="img-upload-icon">🖼️</div>
                  <div id="fileName">Kliknite pre výber súboru 2</div>
               </div>
               <div class="img-upload" onclick="document.getElementById('imgFile').click()">
                  <input type="file" id="imgFile3" accept="image/*" onchange="showFileName(this)">
                  <div class="img-upload-icon">🖼️</div>
                  <div id="fileName">Kliknite pre výber súboru 3</div>
               </div>
            </div>

            <div class="btn-row">
               <button class="btn-secondary" onclick="clearForm()">Vymazať</button>
               <button class="btn-primary" onclick="submitForm()">Pridať produkt</button>
            </div>
         </div>
      </main>
   </div>

   <footer>© 2026 Mostly Sunny Toys</footer>
   <div class="success-toast" id="toast">✅ Produkt bol pridaný!</div>

   <script>
      const burgerBtn = document.getElementById('burgerBtn');
      const overlay = document.getElementById('sidebarOverlay');
      const toggleSidebar = () => document.body.classList.toggle('sidebar-open');
      burgerBtn.addEventListener('click', toggleSidebar);
      overlay.addEventListener('click', toggleSidebar);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') document.body.classList.remove('sidebar-open'); });
      window.addEventListener('resize', () => { if (window.innerWidth > 1100) document.body.classList.remove('sidebar-open'); });

      function showFileName(input) {
         document.getElementById('fileName').textContent = input.files[0]?.name || 'Kliknite pre výber súboru';
      }

      function clearForm() {
         ['name', 'price', 'stock', 'material', 'size', 'desc'].forEach(id => document.getElementById(id).value = '');
         document.getElementById('category').value = '';
         document.getElementById('fileName').textContent = 'Kliknite pre výber súboru';
      }

      function submitForm() {
         const name = document.getElementById('name').value.trim();
         const price = document.getElementById('price').value;
         const category = document.getElementById('category').value;
         const image1 = document.getElementById('imgFile1').value;
         const image2 = document.getElementById('imgFile2').value;
         if (!name || !price || !category || !image1 || !image2) {
            alert('Vyplňte aspoň názov, kategóriu, cenu a dva obrázky.');
            return;
         }
         const toast = document.getElementById('toast');
         toast.style.display = 'block';
         setTimeout(() => { toast.style.display = 'none'; clearForm(); }, 2500);
      }
   </script>
</body>

</html>