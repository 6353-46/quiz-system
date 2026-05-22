<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ str_replace('-',' ', $quizName) }} - Quiz System</title>
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
 
        /* ── ALERT ── */
        .alert-success {
            max-width: 640px;
            margin: 1.5rem auto 0;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px; font-weight: 500;
            text-align: center;
            background: rgba(34,197,94,0.1);
            border: 0.5px solid rgba(34,197,94,0.25);
            color: #86efac;
        }
 
        /* ── PAGE ── */
        .page-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5rem 1.5rem 6rem;
            min-height: calc(100vh - 56px);
        }
 
        /* ── CARD ── */
        .quiz-card {
            width: 100%; max-width: 580px;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .quiz-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #16a34a, #22c55e, #16a34a);
        }
 
        .trophy-wrap {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: rgba(34,197,94,0.1);
            border: 0.5px solid rgba(34,197,94,0.2);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.75rem;
            font-size: 32px;
        }
 
        .quiz-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.9rem; font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.25;
            text-transform: capitalize;
        }
 
        .quiz-meta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 30px;
            padding: 7px 18px;
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            margin-bottom: 1rem;
        }
        .quiz-meta span { color: #4ade80; font-weight: 600; }
 
        .quiz-note {
            font-size: 14px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 0.5rem;
        }
 
        .good-luck {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem; font-weight: 700;
            color: #4ade80;
            margin: 1.5rem 0 2.25rem;
        }
 
        .divider {
            border: none;
            border-top: 0.5px solid rgba(255,255,255,0.07);
            margin: 0 0 2rem;
        }
 
        /* ── BUTTONS ── */
        .btn-start {
            display: inline-block;
            width: 100%;
            padding: 13px;
            background: #16a34a;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 15px; font-weight: 600;
            border-radius: 11px;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-start:hover { background: #15803d; transform: translateY(-1px); color: #fff; }
 
        .btn-group { display: flex; flex-direction: column; gap: 12px; }
 
        .btn-outline {
            display: inline-block;
            width: 100%;
            padding: 12px;
            background: rgba(255,255,255,0.05);
            color: #e2e8f0;
            font-family: 'Syne', sans-serif;
            font-size: 14px; font-weight: 600;
            border-radius: 11px;
            border: 0.5px solid rgba(255,255,255,0.12);
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, transform 0.15s;
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.09);
            border-color: rgba(255,255,255,0.22);
            transform: translateY(-1px);
            color: #fff;
        }
        .btn-outline.green {
            border-color: rgba(34,197,94,0.25);
            color: #4ade80;
        }
        .btn-outline.green:hover {
            background: rgba(34,197,94,0.08);
            border-color: rgba(34,197,94,0.4);
        }
 
        .login-note {
            font-size: 13px;
            color: rgba(255,255,255,0.35);
            margin-top: 1.25rem;
        }
    </style>
</head>
<body>
 
    <x-user-navbar></x-user-navbar>
 
    @if(session('message-success'))
        <div class="alert-success">{{ session('message-success') }}</div>
    @endif
 
    <div class="page-wrap">
        <div class="quiz-card">
 
            <div class="trophy-wrap">🏆</div>
 
            <h1 class="quiz-title">{{ str_replace('-', ' ', $quizName) }}</h1>
 
            <div class="quiz-meta">
                📝 &nbsp;This quiz contains <span>{{ $quizCount }} Questions</span>
            </div>
 
            <p class="quiz-note">No attempt limit — try as many times as you like!</p>
 
            <p class="good-luck">✨ Good Luck!</p>
 
            <hr class="divider">
 
            @if(session('user'))
                <a href="/mcq/{{ session('firstMCQ')->id }}/{{ $quizName }}" class="btn-start">
                    Start Quiz →
                </a>
            @else
                <div class="btn-group">
                    <a href="/user-signup-quiz" class="btn-outline green">
                        Signup to Start Quiz
                    </a>
                    <a href="/user-login-quiz" class="btn-outline">
                        Login to Start Quiz
                    </a>
                </div>
                <p class="login-note">You need an account to attempt this quiz</p>
            @endif
 
        </div>
    </div>
 
    <x-footer-user></x-footer-user>
 
</body>
</html>