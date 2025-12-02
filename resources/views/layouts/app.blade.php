{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LocateIT - Helping you find what\'s lost')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #F7F7F7;
            color: #333;
        }

        header {
            background: #FFFFFF;
            padding: 1rem 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #9E1B1E;
            text-decoration: none;
        }

        .logo:hover {
            color: #7d1519;
        }

        .logo i {
            font-size: 2rem;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-icon {
            position: relative;
            font-size: 1.3rem;
            color: #666;
            cursor: pointer;
            transition: color 0.3s;
            text-decoration: none;
        }

        .nav-icon:hover {
            color: #9E1B1E;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .profile-btn:hover {
            background: #F7F7F7;
        }

        .profile-pic {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #9E1B1E;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            overflow: hidden;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        main {
            min-height: calc(100vh - 200px);
        }

        footer {
            background: #333;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: 4rem;
        }

        footer p {
            opacity: 0.8;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin: 1rem auto;
            max-width: 1400px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            nav {
                padding: 0 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-map-marker-alt"></i>
                <span>LocateIT</span>
            </a>
            
            @auth
                <div class="nav-right">
                    <a href="{{ route('profile.show', Auth::id()) }}" class="profile-btn">
                        <div class="profile-pic">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                            @else
                                {{ Auth::user()->initials }}
                            @endif
                        </div>
                        <span style="font-weight: 500;">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @else
                <div class="nav-right">
                    <a href="{{ route('login') }}" class="nav-icon">Login</a>
                    <a href="{{ route('register') }}" class="nav-icon">Sign Up</a>
                </div>
            @endauth
        </nav>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} LocateIT - BatStateU. All rights reserved.</p>
        <p style="margin-top: 0.5rem;">Helping you find what's lost.</p>
    </footer>

    <script>
        // CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    </script>

    @stack('scripts')
</body>
</html>