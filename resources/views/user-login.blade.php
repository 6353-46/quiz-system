<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
        }
        .form-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 58px);
            padding: 2rem 1rem;
        }

        .form-card {
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.1);
            border-radius: 18px;
            padding: 2.25rem 2rem;
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(10px);
            animation: fadeUp 0.4s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-title {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background: rgba(239,68,68,0.12);
            border: 0.5px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            padding: 10px 14px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .alert-success {
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.3);
            color: #86efac;
            padding: 10px 14px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: block;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 0.5px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #fff;
            background: rgba(255,255,255,0.07);
            outline: none;
            transition: border 0.2s, background 0.2s;
        }
        .form-input::placeholder { color: rgba(255,255,255,0.25); }
        .form-input:focus {
            border-color: #e94560;
            background: rgba(233,69,96,0.05);
        }

        .form-error {
            font-size: 12px;
            color: #f87171;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .form-error::before { content: '⚠ '; }

        .btn-submit {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Syne', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #e94560, #c2185b);
            cursor: pointer;
            margin-top: 0.5rem;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-submit:active { transform: scale(0.98); }

        .forgot-link {
            display: block;
            text-align: center;
            font-size: 13px;
            color: #e94560;
            text-decoration: none;
            margin-top: 1rem;
            transition: opacity 0.2s;
        }
        .forgot-link:hover { opacity: 0.75; text-decoration: underline; }

        .form-divider {
            text-align: center;
            font-size: 12px;
            color: rgba(255,255,255,0.25);
            margin: 1rem 0 0.75rem;
            position: relative;
        }
        .form-divider::before,
        .form-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 38%;
            height: 0.5px;
            background: rgba(255,255,255,0.1);
        }
        .form-divider::before { left: 0; }
        .form-divider::after  { right: 0; }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 10px;
            border: 0.5px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.05);
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }

        /* ── Google button ── */
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 10px;
            border: 0.5px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: rgba(255,255,255,0.85);
            background: rgba(255,255,255,0.05);
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .btn-google:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-color: rgba(255,255,255,0.25);
        }
        .btn-google svg { flex-shrink: 0; }

        .or-divider {
            text-align: center;
            font-size: 12px;
            color: rgba(255,255,255,0.25);
            margin: 0.85rem 0;
            position: relative;
        }
        .or-divider::before,
        .or-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 44%;
            height: 0.5px;
            background: rgba(255,255,255,0.1);
        }
        .or-divider::before { left: 0; }
        .or-divider::after  { right: 0; }
    </style>
</head>
<body>

    <x-user-navbar></x-user-navbar>

    <div class="form-page">
        <div class="form-card">
            <h2 class="form-title">Welcome Back 👋</h2>

            {{-- Error Alert --}}
            @if(session('message-error'))
                <div class="alert-error">⚠ {{ session('message-error') }}</div>
            @endif

            {{-- Success Alert --}}
            @if(session('message-success'))
                <div class="alert-success">✓ {{ session('message-success') }}</div>
            @endif

            {{-- Global user error --}}
            @error('user')
                <div class="form-error" style="margin-bottom:1rem;font-size:13px;">{{ $message }}</div>
            @enderror

            <form action="/user-login" method="post">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">User Email</label>
                    <input type="email" placeholder="Enter your email" name="email"
                           class="form-input" value="{{ old('email') }}">
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" placeholder="Enter your password" name="password"
                           class="form-input">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Login →</button>
                <a href="user-forgot-password" class="forgot-link">Forgot Password?</a>
            </form>

            {{-- Google Login --}}
            <div class="or-divider">or continue with</div>

            <a href="{{ route('auth.google') }}" class="btn-google">
                <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </a>

            <div class="form-divider">Don't have an account?</div>
            <a href="/user-signup" class="btn-secondary">Create Account</a>
        </div>
    </div>

</body>
</html>