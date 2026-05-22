<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Signup</title>
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
            min-height: calc(100vh - 56px);
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
            margin-bottom: 1.75rem;
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
    </style>
</head>
<body>
 
    <x-user-navbar></x-user-navbar>
 
    <div class="form-page">
        <div class="form-card">
            <h2 class="form-title">Create Account ✨</h2>
 
            {{-- Global error --}}
            @error('user')
                <div class="form-error" style="margin-bottom:1rem; font-size:13px;">{{ $message }}</div>
            @enderror
 
            <form action="/user-signup" method="post">
                @csrf
 
                {{-- Name --}}
                <div class="form-group">
                    <label class="form-label">User Name</label>
                    <input type="text" placeholder="Enter your name" name="name"
                           class="form-input" value="{{ old('name') }}">
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
 
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
                    <input type="password" placeholder="Create a password" name="password"
                           class="form-input">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
 
                {{-- Confirm Password --}}
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" placeholder="Confirm your password" name="password_confirmation"
                           class="form-input">
                </div>
 
                <button type="submit" class="btn-submit">Sign Up →</button>
            </form>
 
            <div class="form-divider">Already have an account?</div>
            <a href="/user-login" class="btn-secondary">Login Instead</a>
        </div>
    </div>
 
</body>
</html>