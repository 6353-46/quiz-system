<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .card {
            background: rgba(255,255,255,0.03);
            border: 0.5px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 2.25rem 2rem;
            width: 100%;
            max-width: 380px;
        }

        /* ── LOGO / TITLE ── */
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 0.4rem;
        }
        .brand-dot {
            width: 9px; height: 9px;
            border-radius: 50%;
            background: #e94560;
            flex-shrink: 0;
        }
        .brand-name {
            font-family: 'Syne', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
        }
        .card-subtitle {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.35);
            margin-bottom: 1.75rem;
        }

        /* ── FORM ── */
        .form-group { margin-bottom: 14px; }

        .form-label {
            display: block;
            font-size: 12px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #fff;
            outline: none;
            transition: border-color 0.15s;
            font-family: 'DM Sans', sans-serif;
        }
        .form-input::placeholder { color: rgba(255,255,255,0.2); }
        .form-input:focus { border-color: rgba(233,69,96,0.5); }

        .form-error {
            font-size: 12px;
            color: #f87171;
            margin-top: 5px;
        }

        /* ── DIVIDER ── */
        .divider {
            height: 0.5px;
            background: rgba(255,255,255,0.06);
            margin: 1.5rem 0;
        }

        /* ── BUTTON ── */
        .btn-login {
            width: 100%;
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 11px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.2px;
        }
        .btn-login:hover { background: #c73652; }
        .btn-login:active { transform: scale(0.99); }
    </style>
</head>
<body>

    <div class="card">

        <div class="brand">
            <span class="brand-dot"></span>
            <span class="brand-name">QuizSystem</span>
        </div>
        <p class="card-subtitle">Admin panel login</p>

        @error('user')
            <div class="form-error" style="text-align:center; margin-bottom: 12px;">{{ $message }}</div>
        @enderror

        <form action="/admin-login" method="post">
            @csrf

            <div class="form-group">
                <label class="form-label">Admin email</label>
                <input type="email" name="email"
                       placeholder="Enter admin email"
                       class="form-input">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       placeholder="Enter admin password"
                       class="form-input">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="divider"></div>

            <button type="submit" class="btn-login">Login</button>
        </form>

    </div>

</body>
</html>