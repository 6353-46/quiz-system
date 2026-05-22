<!DOCTYPE html>
<html lang="en">
<head>
    <title>Expert Login</title>
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
            display: flex;
            flex-direction: column;
        }

        .form-page {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
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

        /* Expert badge on top */
        .expert-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 1.25rem;
        }
        .expert-badge-pill {
            font-size: 12px;
            font-weight: 500;
            color: #fbbf24;
            background: rgba(251,191,36,0.1);
            border: 0.5px solid rgba(251,191,36,0.3);
            padding: 4px 12px;
            border-radius: 20px;
            letter-spacing: 0.5px;
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
            text-transform: capitalize;
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
            border-color: #fbbf24;
            background: rgba(251,191,36,0.04);
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
            background: linear-gradient(135deg, #f59e0b, #d97706);
            cursor: pointer;
            margin-top: 0.5rem;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-submit:active { transform: scale(0.98); }

        .back-link {
            display: block;
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            margin-top: 1.25rem;
            transition: color 0.2s;
        }
        .back-link:hover { color: rgba(255,255,255,0.7); }
    </style>
</head>
<body>

    <div class="form-page">
        <div class="form-card">

            {{-- Expert Badge --}}
            <div class="expert-badge">
                <span class="expert-badge-pill">⚡ Expert Portal</span>
            </div>

            <h2 class="form-title">Expert Login</h2>

            {{-- Global error --}}
            @error('user')
                <div class="form-error" style="margin-bottom:1rem;font-size:13px;">{{ $message }}</div>
            @enderror

            <form action="/expert-login" method="post">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label class="form-label">Expert Name</label>
                    <input type="text" placeholder="Enter expert name" name="name"
                           class="form-input" value="{{ old('name') }}">
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" placeholder="Enter expert password" name="password"
                           class="form-input">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Login →</button>
            </form>

            <a href="/" class="back-link">← Back to Home</a>
        </div>
    </div>

</body>
</html>