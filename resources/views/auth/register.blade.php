{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up - LocateIT</title>
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

        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #E5E5E5;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #9E1B1E;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .error-message {
            color: #9E1B1E;
            font-size: 0.85rem;
            margin-top: 0.25rem;
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

        .login-link {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }

        .login-link a {
            color: #9E1B1E;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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

            .form-grid {
                grid-template-columns: 1fr;
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
            <p style="margin-top: 1rem; font-size: 0.95rem;">Join the trusted campus-wide community for reporting and finding lost or found items across all BatStateU campuses.</p>
        </div>

        <div class="form-side">
            <h2>Create Account</h2>
            
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Juan Dela Cruz" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Username *</label>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="juandc" required>
                        @error('username')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="juan@g.batstate-u.edu.ph" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="password" name="password" placeholder="Min. 8 characters" required>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password *</label>
                        <input type="password" name="password_confirmation" placeholder="Re-enter password" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Campus *</label>
                        <select name="campus" required>
                            <option value="">Select Campus</option>
                            <option value="Alangilan Campus" {{ old('campus') == 'Alangilan Campus' ? 'selected' : '' }}>Alangilan Campus</option>
                            <option value="Pablo Borbon Campus" {{ old('campus') == 'Pablo Borbon Campus' ? 'selected' : '' }}>Pablo Borbon Campus</option>
                            <option value="Lipa Campus" {{ old('campus') == 'Lipa Campus' ? 'selected' : '' }}>Lipa Campus</option>
                            <option value="Nasugbu Campus" {{ old('campus') == 'Nasugbu Campus' ? 'selected' : '' }}>Nasugbu Campus</option>
                            <option value="Malvar Campus" {{ old('campus') == 'Malvar Campus' ? 'selected' : '' }}>Malvar Campus</option>
                            <option value="Lemery Campus" {{ old('campus') == 'Lemery Campus' ? 'selected' : '' }}>Lemery Campus</option>
                            <option value="Balayan Campus" {{ old('campus') == 'Balayan Campus' ? 'selected' : '' }}>Balayan Campus</option>
                            <option value="San Juan Campus" {{ old('campus') == 'San Juan Campus' ? 'selected' : '' }}>San Juan Campus</option>
                        </select>
                        @error('campus')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Contact Number *</label>
                        <input type="tel" name="contact_number" value="{{ old('contact_number') }}" placeholder="09XX XXX XXXX" required>
                        @error('contact_number')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>