<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LocateIT - Welcome</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
            * {
                box-sizing: border-box;
            }
            body {
                font-family: 'Instrument Sans', sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background-color: #FDFDFC;
                color: #1b1b18;
            }
            .container {
                text-align: center;
                padding: 2rem;
                max-width: 700px;
                width: 100%;
            }
            .logo {
                font-size: 4.5rem;
                font-weight: 700;
                color: #9E1B1E; /* Your brand red color */
                margin-bottom: 0.5rem;
                margin-top: 0;
                letter-spacing: -1px;
            }
            .tagline {
                font-size: 1.5rem;
                color: #555;
                margin-bottom: 3rem;
                line-height: 1.5;
                font-weight: 400;
            }
            .actions {
                display: flex;
                gap: 1.5rem;
                justify-content: center;
                flex-wrap: wrap;
            }
            .btn {
                padding: 1rem 2.5rem;
                border-radius: 50px; /* Pill shaped buttons */
                font-size: 1.1rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                min-width: 160px;
            }
            /* Primary Button (Filled) */
            .btn-primary {
                background-color: #9E1B1E;
                color: white;
                border: 2px solid #9E1B1E;
                box-shadow: 0 4px 6px rgba(158, 27, 30, 0.2);
            }
            .btn-primary:hover {
                background-color: #7d1519;
                border-color: #7d1519;
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(158, 27, 30, 0.3);
            }
            /* Secondary Button (Outline) */
            .btn-outline {
                background-color: transparent;
                color: #9E1B1E;
                border: 2px solid #9E1B1E;
            }
            .btn-outline:hover {
                background-color: #FFF5F5;
                transform: translateY(-2px);
            }
            
            /* Icon decoration (optional) */
            .icon-container {
                font-size: 3rem;
                color: #9E1B1E;
                margin-bottom: 1rem;
                opacity: 0.9;
            }

            @media (max-width: 600px) {
                .logo { font-size: 3rem; }
                .tagline { font-size: 1.2rem; }
                .actions { flex-direction: column; align-items: center; gap: 1rem; }
                .btn { width: 100%; }
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="icon-container">
                <i class="fas fa-search-location"></i>
            </div>
            
            <h1 class="logo">LocateIT</h1>
            
            <p class="tagline">
                The central hub for lost and found items.<br>
                Find what you've lost, report what you've found.
            </p>
            
            <div class="actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-primary">Go to Feed</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </body>
</html>