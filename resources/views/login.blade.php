<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mostly Sunny Toys</title>

    <style>
        :root {
            --purple: #8584B3;
            --purple-light: #b8b7d8;
            --purple-dark: #6b6a9a;
            --pink: #d4a0b5;
            --pink-light: #e8c5d5;
            --bg: #e8e8f5;
            --card-bg: #f5f0f5;
            --sidebar-bg: #d8d8ee;
            --text: #3a3a5c;
            --text-light: #7070a0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Trebuchet MS', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--bg);
        }

        header {
            background: var(--purple);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            position: relative;
            box-shadow: 0 2px 12px rgba(100, 100, 180, 0.18);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 26px;
            cursor: pointer;
        }

        .main-container {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 420px 1fr;
            align-items: center;
        }

        .side {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .side img {
            max-width: 100%;
            opacity: 0.85;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            color: var(--text);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: var(--card-bg);
            color: var(--text);
        }

        .error-msg {
            color: #e3342f;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .forgot {
            text-align: center;
            margin: 10px 0 15px 0;
        }

        .forgot a {
            text-decoration: none;
            color: var(--text);
            font-size: 14px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            background: var(--purple);
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .login-btn:hover {
            background: var(--purple-dark);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: var(--text-light);
        }

        .social-login {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .social-btn {
            padding: 10px;
            border: 1px solid #ccc;
            background: #b0b0c8;
            border-radius: 6px;
            cursor: pointer;
            color: var(--text);
        }

        .register {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .register a {
            color: var(--text-light);
            text-decoration: none;
        }

        footer {
            background: #6b6a9a;
            color: white;
            text-align: center;
            padding: 24px;
            font-size: 13px;
        }

        @media (max-width:900px) {
            .main-container { grid-template-columns: 1fr; padding: 20px; }
            .side { display: none; }
        }
    </style>
</head>

<body>
    <header>
        Mostly Sunny Toys
        <button class="close-btn" onclick="location.href='{{ url('/') }}'">
            <i class="fa-solid fa-house"></i>
        </button>
    </header>

    <div class="main-container">
        <div class="side">
            <img src="{{ asset('src/img/sun.png') }}" alt="sun">
        </div>

        <div class="login-box">
            <h2>Login</h2>

            @if ($errors->any())
                <div class="error-msg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                <input type="password" name="password" placeholder="Heslo" required>

                <div class="forgot">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Zabudnuté heslo?</a>
                    @endif
                </div>

                <button type="submit" class="login-btn">Prihlásiť sa</button>
            </form>

            <div class="divider">alebo</div>

            <div class="social-login">
                <button class="social-btn" type="button">Prihlásiť cez Google</button>
            </div>

            <div class="register">
                Ešte nemáte účet? <a href="{{ route('register') }}">Zaregistrujte sa</a>
            </div>
        </div>

        <div class="side">
            <img src="{{ asset('src/img/sun.png') }}" alt="sun">
        </div>
    </div>

    <footer>© 2026 Mostly Sunny Toys</footer>
</body>

</html>