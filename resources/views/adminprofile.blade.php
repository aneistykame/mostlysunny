<!DOCTYPE html>
<html lang="sk">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet">
    <link href="{{ asset('adminstyle.css') }}" rel="stylesheet">
   <title>Môj profil</title>

   <style>
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
         background: rgb(46, 42, 61);
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
    <div class="burger-area" id="burgerBtn">
        <div class="burger-icon"><span></span><span></span><span></span></div>
    </div>
    <div class="logo-text" onclick="location.href='{{ route('admin.dashboard') }}'">Mostly Sunny Admin</div>
    <div class="header-icons">
        <button title="Dashboard" onclick="location.href='{{ route('admin.dashboard') }}'">
            Dashboard
        </button>
    </div>
</header>

<div class="main">
    <div class="profile-container">
        <div class="section">
            <h3>Môj profil</h3>
            <div>Prihlásený ako <b>{{ Auth::user()->name }}</b> ({{ Auth::user()->email }})</div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn logout-btn">Odhlásiť sa</button>
        </form>
    </div>
</div>

<footer>© 2026 Mostly Sunny Toys</footer>

<script>
    const burgerBtn = document.getElementById('burgerBtn');
    const toggleSidebar = () => document.body.classList.toggle('sidebar-open');
    burgerBtn.addEventListener('click', toggleSidebar);
</script>
</body>

</html>
