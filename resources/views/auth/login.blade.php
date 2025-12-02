{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - LocateIT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #9E1B1E 0%, #7d1519 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }

        .branding-side {
            background: linear-gradient(135deg, #9E1B1E 0%, #7d1519 100%);
            color: white;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo-large {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .branding-side h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .branding-side p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .form-side {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #E5E5E5;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #9E1B1E;
        }

        .error-message {
            color: #9E1B1E;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .forgot-password {
            text-align: right;
            margin-top: 0.5rem;
        }

        .forgot-password a {
            color: #9E1B1E;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background: #9E1B1E;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: #7d1519;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(158, 27, 30, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }

        .register-link a {
            color: #9E1B1E;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }

            .branding-side {
                display: none;
            }

            .form-side {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="branding-side">
            <i class="fas fa-map-marker-alt logo-large"></i>
            <h1>LocateIT</h1>
            <p>Helping you find what's lost.</p>
            <p style="margin-top: 1rem; font-size: 0.95rem;">Welcome back! Login to access your account and help the BatStateU community find lost items.</p>
        </div>

        <div class="form-side">
            <h2>Welcome Back</h2>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email or Username</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter your email or username" required autofocus>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <div class="register-link">
                    Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>