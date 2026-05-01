<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="mainstyle.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <title>Potvrdenie objednávky</title>

   <style>
      :root {
         --purple: #8584B3;
         --purple-light: #b8b7d8;
         --purple-dark: #6b6a9a;
         --bg: #e8e8f5;
         --sidebar-bg: #d8d8ee;
         --text: #3a3a5c;
         --text-light: #7070a0;
      }

      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
      }

      body {
         background: var(--bg);
         color: var(--text);
         display: flex;
         flex-direction: column;
         min-height: 100vh;
      }



      .main {
         flex: 1;
         display: flex;
         justify-content: center;
         align-items: center;
         padding: 40px;
      }

      .cart-container {
         background: white;
         width: 100%;
         max-width: 1100px;
         padding: 40px;
         border-radius: 12px;
         box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
      }

      .checkout-layout {
         display: flex;
         gap: 40px;
      }

      .confirmation {
         flex: 2;
      }

      .success-box {
         background: #e6f7ee;
         border: 1px solid #b7e4c7;
         padding: 20px;
         border-radius: 10px;
         margin-bottom: 25px;
      }

      .success-box h2 {
         color: #2d7a4b;
         margin-bottom: 10px;
      }

      .invoice-box {
         background: #f8f8fc;
         padding: 20px;
         border-radius: 10px;
      }

      .invoice-row {
         display: flex;
         justify-content: space-between;
         margin-bottom: 10px;
      }

      .invoice-total {
         border-top: 1px solid var(--text-light);
         margin-top: 10px;
         padding-top: 10px;
         font-weight: bold;
      }

      .cart-summary {
         flex: 1;
         background: var(--sidebar-bg);
         padding: 20px;
         border-radius: 10px;
      }

      .summary-title {
         font-weight: bold;
         margin-bottom: 15px;
      }

      .summary-item {
         display: flex;
         justify-content: space-between;
         margin-bottom: 10px;
      }

      .summary-total {
         border-top: 1px solid var(--text-light);
         padding-top: 10px;
         margin-top: 10px;
         font-weight: bold;
      }

      .btn {
         margin-top: 15px;
         width: 100%;
         padding: 12px;
         border: none;
         border-radius: 6px;
         cursor: pointer;
         font-size: 15px;
      }

      .btn-primary {
         background: var(--purple);
         color: white;
      }

      .btn-primary:hover {
         background: var(--purple-dark);
      }

      footer {
         background: #6b6a9a;
         color: white;
         text-align: center;
         padding: 24px;
         font-size: 13px;
      }

      @media(max-width:800px) {
         .checkout-layout {
            flex-direction: column;
         }
      }
   </style>
</head>

<body>

   <header>
      <div class="logo-text" onclick="location.href='index.html'">
         Mostly Sunny Toys
      </div>
      <div class="search-box">
         <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
         <input type="text" placeholder="Hľadať produkty...">
      </div>
      <div class="header-icons">
         <button title="Účet" onclick="location.href='login.html'">
            <i class="fa-solid fa-user"></i> Účet
         </button>
         <button title="Košík" onclick="location.href='cart.html'">
            <i class="fa-solid fa-cart-shopping"></i> Košík
         </button>
      </div>
   </header>

   <div class="main">
      <div class="cart-container">

         <div class="checkout-layout">

            <!-- LEFT -->
            <div class="confirmation">

               <div class="success-box">
                  <h2>🎉 Objednávka potvrdená!</h2>
                  <p>Ďakujeme za nákup. Na email sme ti poslali potvrdenie.</p>
               </div>

               <div class="invoice-box">
                  <h3 style="margin-bottom:15px;">Fakturačné údaje</h3>

                  <div class="invoice-row">
                     <span>Meno:</span>
                     <span>Ján Novák</span>
                  </div>

                  <div class="invoice-row">
                     <span>Email:</span>
                     <span>jan@example.com</span>
                  </div>

                  <div class="invoice-row">
                     <span>Telefón:</span>
                     <span>+421 900 000 000</span>
                  </div>
               </div>

               <button class="btn btn-primary" onclick="location.href='index.html'">Späť na obchod</button>

            </div>

            <!-- RIGHT -->
            <div class="cart-summary">
               <div class="summary-title">Zhrnutie objednávky</div>

               <div class="summary-item">
                  <span>Plyšový medveď ×1</span>
                  <span>€15.99</span>
               </div>

               <div class="summary-item">
                  <span>Doprava</span>
                  <span>€4.99</span>
               </div>

               <div class="summary-total">
                  <span>Spolu</span>
                  <span>€20.98</span>
               </div>
            </div>

         </div>
      </div>
   </div>

   <footer>
      © 2026 Mostly Sunny Toys
   </footer>

</body>

</html>