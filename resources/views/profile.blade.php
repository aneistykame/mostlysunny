<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link href="mainstyle.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <title>Môj profil</title>

   <style>
      :root {
         --purple: #8584B3;
         --purple-dark: #6b6a9a;
         --bg: #e8e8f5;
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
         padding: 40px;
      }

      .profile-container {
         background: white;
         width: 100%;
         max-width: 800px;
         padding: 40px;
         border-radius: 12px;
         box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
      }

      .section {
         margin-bottom: 30px;
      }

      .section h3 {
         margin-bottom: 15px;
      }

      .form-group {
         display: flex;
         flex-direction: column;
         margin-bottom: 12px;
      }

      .form-group label {
         font-size: 13px;
         margin-bottom: 4px;
         color: var(--text-light);
      }

      .form-group input {
         padding: 10px;
         border-radius: 6px;
         border: 1px solid var(--text-light);
      }

      .btn {
         padding: 12px;
         border: none;
         border-radius: 6px;
         cursor: pointer;
         font-size: 15px;
         width: 100%;
         margin-top: 10px;
      }

      .static-field {
         padding: 10px;
         border-radius: 6px;
         background: #f0eef8;
         border: 1px solid var(--text-light);
      }

      .btn-primary {
         background: var(--purple);
         color: white;
      }

      .btn-primary:hover {
         background: var(--purple-dark);
      }

      .logout-btn {
         background: #e57373;
         color: white;
      }

      .logout-btn:hover {
         background: #d32f2f;
      }

      .order {
         background: #f8f8fc;
         padding: 15px;
         border-radius: 8px;
         margin-bottom: 10px;
      }

      .order-top {
         display: flex;
         justify-content: space-between;
         margin-bottom: 8px;
         font-size: 14px;
      }

      .order-items {
         font-size: 13px;
         color: var(--text-light);
      }

      .order {
         display: flex;
         gap: 15px;
         align-items: center;
         background: #f8f8fc;
         padding: 15px;
         border-radius: 8px;
         margin-bottom: 10px;
      }

      .order img {
         width: 60px;
         height: 60px;
         object-fit: cover;
         border-radius: 8px;
      }

      .order-content {
         flex: 1;
      }

      .order-top {
         display: flex;
         justify-content: space-between;
         margin-bottom: 6px;
         font-size: 14px;
      }

      footer {
         background: #6b6a9a;
         color: white;
         text-align: center;
         padding: 24px;
         font-size: 13px;
      }
   </style>
</head>

<body>

<header>
   <div class="logo-text" onclick="location.href='{{ url('/') }}'">
      Mostly Sunny Toys
   </div>
   <div class="search-box">
      <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
      <input type="text" placeholder="Hľadať produkty...">
   </div>
   <div class="header-icons">
      <button title="Účet" onclick="location.href='{{ route('dashboard') }}'">
         <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
      </button>
      <button title="Košík" onclick="location.href='{{ url('/cart') }}'">
         <i class="fa-solid fa-cart-shopping"></i> Košík
      </button>
   </div>
</header>

   <div class="main">
      <div class="profile-container">

         <div class="section">
            <h3>Moje údaje</h3>

            <div class="form-group">
               <label>Meno</label>
               <div class="static-field">{{ Auth::user()->name }}</div>
            </div>

            <div class="form-group">
               <label>Email</label>
               <div class="static-field">{{ Auth::user()->email }}</div>
            </div>

            <div class="form-group">
               <label>Účet vytvorený</label>
               <div class="static-field">{{ Auth::user()->created_at->format('d.m.Y') }}</div>
            </div>
         </div>

         <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn logout-btn">
               Odhlásiť sa
            </button>
         </form>

         <div class="section" style="margin-top:30px;">
            <h3>História objednávok</h3>

            <p style="color: var(--text-light); font-size: 14px;">Momentálne nemáte žiadne reálne objednávky v databáze.</p>

            <div class="order">
               <img src="{{ asset('src/img/sickBear.jpg') }}" alt="produkt">
               <div class="order-content">
                  <div class="order-top">
                     <span>Ukážková objednávka #2026001</span>
                     <span>€20.98</span>
                  </div>
                  <div class="order-items">
                     Plyšový medveď ×1
                  </div>
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