<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
 
        :root {
            --red: #e94560;
            --orange: #f97316;
            --navy: #0d0d1a;
            --navy2: #111827;
            --navy3: #0f172a;
            --glass: rgba(255,255,255,0.05);
            --border: rgba(255,255,255,0.09);
        }
 
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            min-height: 100vh;
            color: #e2e8f0;
            overflow-x: hidden;
        }
 
        /* ── AMBIENT BG ── */
        body::before {
            content: '';
            position: fixed;
            top: -200px; left: -200px;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(233,69,96,0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -200px; right: -200px;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }
 
        /* ── HERO ── */
        .hero {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 2rem;
            max-width: 1060px;
            margin: 0 auto;
            padding: 3.5rem 2rem 2rem;
        }
 
        @media(max-width: 720px) {
            .hero { grid-template-columns: 1fr; text-align: center; }
            .hero-illustration { display: none; }
        }
 
        .hero-left { display: flex; flex-direction: column; gap: 1.25rem; }
 
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 500;
            color: var(--red);
            background: rgba(233,69,96,0.1);
            border: 0.5px solid rgba(233,69,96,0.3);
            padding: 5px 12px;
            border-radius: 20px;
            width: fit-content;
            animation: fadeUp 0.5s ease both;
        }
        .hero-eyebrow-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--red);
            animation: pulse 2s ease infinite;
        }
        @keyframes pulse {
            0%,100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.5; transform: scale(0.8); }
        }
 
        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            animation: fadeUp 0.5s 0.1s ease both;
        }
        .hero-title .grad {
            background: linear-gradient(135deg, var(--red), var(--orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
 
        .hero-sub {
            font-size: 15px;
            color: rgba(255,255,255,0.45);
            line-height: 1.7;
            max-width: 400px;
            animation: fadeUp 0.5s 0.2s ease both;
        }
 
        /* Search */
        .search-wrap {
            position: relative;
            max-width: 420px;
            animation: fadeUp 0.5s 0.3s ease both;
        }
        .search-icon-svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            fill: rgba(255,255,255,0.3);
            pointer-events: none;
        }
        .search-input {
            width: 100%;
            padding: 12px 48px;
            border: 0.5px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #fff;
            background: rgba(255,255,255,0.07);
            outline: none;
            transition: border 0.2s, background 0.2s;
        }
        .search-input::placeholder { color: rgba(255,255,255,0.3); }
        .search-input:focus {
            border-color: var(--red);
            background: rgba(233,69,96,0.04);
        }
        .search-submit {
            position: absolute;
            right: 8px; top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, var(--red), #c2185b);
            border: none;
            border-radius: 10px;
            width: 34px; height: 34px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .search-submit:hover { opacity: 0.85; }
        .search-submit svg { fill: #fff; }
 
        /* Stats strip */
        .hero-stats {
            display: flex;
            gap: 1.5rem;
            animation: fadeUp 0.5s 0.4s ease both;
        }
        .hero-stat { display: flex; flex-direction: column; gap: 2px; }
        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
        }
        .stat-lbl { font-size: 12px; color: rgba(255,255,255,0.35); }
        .stat-divider {
            width: 1px;
            background: rgba(255,255,255,0.08);
            align-self: stretch;
        }
 
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
 
        /* ── SVG ILLUSTRATION ── */
        .hero-illustration {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeUp 0.6s 0.2s ease both;
        }
        .illus-svg {
            width: 100%;
            max-width: 420px;
            filter: drop-shadow(0 20px 60px rgba(233,69,96,0.2));
        }
 
        /* ── MAIN ── */
        .main-container {
            max-width: 1060px;
            margin: 0 auto;
            padding: 0 2rem 5rem;
            position: relative;
            z-index: 1;
        }
 
        .section-label {
            font-family: 'Syne', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: #fff;
            margin: 2.5rem 0 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-label::after {
            content: '';
            flex: 1;
            height: 0.5px;
            background: rgba(255,255,255,0.07);
            margin-left: 8px;
        }
 
        .alert-success {
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.3);
            color: #86efac;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 1.25rem;
            text-align: center;
        }
 
        /* ── TWO COL LAYOUT ── */
        .tables-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        @media(max-width: 700px) { .tables-grid { grid-template-columns: 1fr; } }
 
        .tbl-card {
            background: var(--glass);
            border: 0.5px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }
        .tbl-card-header {
            padding: 14px 18px;
            border-bottom: 0.5px solid var(--border);
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.02);
        }
 
        .tbl-header {
            display: grid;
            padding: 8px 18px;
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255,255,255,0.25);
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
        }
        .tbl-row {
            display: grid;
            padding: 11px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.04);
            transition: background 0.15s;
            animation: rowIn 0.35s ease both;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.04); }
 
        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-6px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .tbl-row:nth-child(1){animation-delay:0.05s}
        .tbl-row:nth-child(2){animation-delay:0.10s}
        .tbl-row:nth-child(3){animation-delay:0.15s}
        .tbl-row:nth-child(4){animation-delay:0.20s}
        .tbl-row:nth-child(5){animation-delay:0.25s}
 
        .cat-grid { grid-template-columns: 36px 1fr 70px 44px; }
        .quiz-grid { grid-template-columns: 1fr 130px; }
 
        .cell-num  { font-size: 11px; color: rgba(255,255,255,0.2); }
        .cell-name { font-size: 13px; font-weight: 500; color: #e2e8f0; }
 
        .badge-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: #93c5fd;
            background: rgba(59,130,246,0.12);
            padding: 2px 9px;
            border-radius: 20px;
            border: 0.5px solid rgba(59,130,246,0.2);
        }
 
        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px; height: 28px;
            border-radius: 7px;
            border: 0.5px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
        }
        .icon-btn:hover {
            background: rgba(59,130,246,0.2);
            border-color: rgba(59,130,246,0.4);
        }
        .icon-btn svg { fill: rgba(255,255,255,0.45); transition: fill 0.15s; }
        .icon-btn:hover svg { fill: #93c5fd; }
 
        .attempt-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 500;
            padding: 5px 13px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--red), #c2185b);
            color: #fff;
            text-decoration: none;
            transition: opacity 0.18s, transform 0.15s;
            white-space: nowrap;
        }
        .attempt-btn:hover { opacity: 0.88; transform: translateY(-1px); color: #fff; }
    </style>
</head>
<body>
 
    <x-user-navbar></x-user-navbar>
 
    {{-- HERO --}}
    <div class="hero">
        <div class="hero-left">
            <span class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Live Quiz Platform
            </span>
 
            <h1 class="hero-title">
                Check Your<br>
                <span class="grad">Skills Today</span>
            </h1>
 
            <p class="hero-sub">
                Browse categories, attempt quizzes, and earn certificates. Test your knowledge across dozens of topics.
            </p>
 
            <div class="search-wrap">
                <form action="search-quiz" method="get" style="position:relative">
                    <svg class="search-icon-svg" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/>
                    </svg>
                    <input class="search-input" type="text" name="search" placeholder="Search any quiz..." />
                    <button class="search-submit" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px">
                            <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56Z"/>
                        </svg>
                    </button>
                </form>
            </div>
 
            <div class="hero-stats">
                <div class="hero-stat">
                   <span class="stat-num">{{ $totalQuizzes }}</span>
<span class="stat-lbl">Quizzes</span>
                </div>
                <div class="stat-divider"></div>
                <div class="hero-stat">
                  <span class="stat-num">{{ $totalCategories }}</span>
<span class="stat-lbl">Categories</span>
                </div>
                <div class="stat-divider"></div>
                <div class="hero-stat">
                    <span class="stat-num">∞</span>
                    <span class="stat-lbl">Attempts</span>
                </div>
            </div>
        </div>
 
        {{-- SVG ILLUSTRATION --}}
        <div class="hero-illustration">
            <svg class="illus-svg" viewBox="0 0 420 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- BG circle -->
                <circle cx="210" cy="190" r="170" fill="rgba(233,69,96,0.06)" />
                <circle cx="210" cy="190" r="130" fill="rgba(233,69,96,0.05)" />
 
                <!-- Main card -->
                <rect x="60" y="60" width="300" height="260" rx="20" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.12)" stroke-width="1"/>
 
                <!-- Card header -->
                <rect x="60" y="60" width="300" height="52" rx="20" fill="rgba(233,69,96,0.15)"/>
                <rect x="60" y="92" width="300" height="20" fill="rgba(233,69,96,0.15)"/>
 
                <!-- Header dots -->
                <circle cx="90" cy="86" r="6" fill="#e94560" opacity="0.9"/>
                <circle cx="110" cy="86" r="6" fill="#f97316" opacity="0.7"/>
                <circle cx="130" cy="86" r="6" fill="rgba(255,255,255,0.2)"/>
 
                <!-- Header text placeholder -->
                <rect x="155" y="80" width="120" height="12" rx="6" fill="rgba(255,255,255,0.15)"/>
 
                <!-- Question text -->
                <rect x="90" y="135" width="200" height="10" rx="5" fill="rgba(255,255,255,0.2)"/>
                <rect x="90" y="153" width="160" height="10" rx="5" fill="rgba(255,255,255,0.12)"/>
 
                <!-- Option rows -->
                <!-- Option 1 - selected -->
                <rect x="85" y="178" width="250" height="34" rx="10" fill="rgba(233,69,96,0.18)" stroke="rgba(233,69,96,0.5)" stroke-width="1"/>
                <circle cx="105" cy="195" r="7" fill="rgba(233,69,96,0.3)" stroke="#e94560" stroke-width="1.5"/>
                <circle cx="105" cy="195" r="3" fill="#e94560"/>
                <rect x="120" y="190" width="110" height="10" rx="5" fill="rgba(255,255,255,0.25)"/>
 
                <!-- Option 2 -->
                <rect x="85" y="220" width="250" height="34" rx="10" fill="rgba(255,255,255,0.04)" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                <circle cx="105" cy="237" r="7" stroke="rgba(255,255,255,0.2)" stroke-width="1.5" fill="none"/>
                <rect x="120" y="232" width="90" height="10" rx="5" fill="rgba(255,255,255,0.12)"/>
 
                <!-- Option 3 -->
                <rect x="85" y="262" width="250" height="34" rx="10" fill="rgba(255,255,255,0.04)" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                <circle cx="105" cy="279" r="7" stroke="rgba(255,255,255,0.2)" stroke-width="1.5" fill="none"/>
                <rect x="120" y="274" width="130" height="10" rx="5" fill="rgba(255,255,255,0.12)"/>
 
                <!-- Progress bar -->
                <rect x="90" y="308" width="240" height="5" rx="3" fill="rgba(255,255,255,0.08)"/>
                <rect x="90" y="308" width="140" height="5" rx="3" fill="url(#prog)"/>
 
                <defs>
                    <linearGradient id="prog" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%" stop-color="#e94560"/>
                        <stop offset="100%" stop-color="#f97316"/>
                    </linearGradient>
                </defs>
 
                <!-- Floating badge - score -->
                <rect x="290" y="40" width="90" height="44" rx="12" fill="rgba(34,197,94,0.15)" stroke="rgba(34,197,94,0.4)" stroke-width="1"/>
                <text x="335" y="58" text-anchor="middle" font-family="Syne,sans-serif" font-size="13" font-weight="700" fill="#4ade80">100%</text>
                <text x="335" y="74" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9" fill="rgba(255,255,255,0.4)">Score</text>
 
                <!-- Floating badge - timer -->
                <rect x="32" y="150" width="48" height="44" rx="12" fill="rgba(249,115,22,0.15)" stroke="rgba(249,115,22,0.4)" stroke-width="1"/>
                <text x="56" y="168" text-anchor="middle" font-family="Syne,sans-serif" font-size="11" font-weight="700" fill="#fb923c">2:30</text>
                <text x="56" y="182" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="8" fill="rgba(255,255,255,0.35)">Timer</text>
 
                <!-- Floating star -->
                <circle cx="360" cy="200" r="18" fill="rgba(233,69,96,0.12)" stroke="rgba(233,69,96,0.3)" stroke-width="1"/>
                <text x="360" y="205" text-anchor="middle" font-size="14">⭐</text>
 
                <!-- Sparkles -->
                <circle cx="55" cy="100" r="3" fill="#e94560" opacity="0.6"/>
                <circle cx="375" cy="300" r="4" fill="#f97316" opacity="0.5"/>
                <circle cx="40" cy="290" r="2" fill="#93c5fd" opacity="0.5"/>
                <circle cx="390" cy="120" r="2.5" fill="#4ade80" opacity="0.5"/>
            </svg>
        </div>
    </div>
 
    {{-- MAIN CONTENT --}}
    <div class="main-container">
 
        @if(session('message-success'))
            <div class="alert-success">{{ session('message-success') }}</div>
        @endif
 
        <div class="tables-grid">
 
            {{-- TOP CATEGORIES --}}
            <div>
                <div class="section-label">🏆 Top Categories</div>
                <div class="tbl-card">
                    <div class="tbl-card-header">
                        🗂 Categories
                    </div>
                    <div class="tbl-header cat-grid">
                        <span>#</span>
                        <span>Name</span>
                        <span>Quizzes</span>
                        <span></span>
                    </div>
                    @foreach($categories as $key => $category)
                    <div class="tbl-row cat-grid">
                        <span class="cell-num">{{ $key + 1 }}</span>
                        <span class="cell-name">{{ $category->name }}</span>
                        <span>
                            <span class="badge-count">{{ $category->quizzes_count }}</span>
                        </span>
                        <span>
                            <a class="icon-btn"
                               href="user-quiz-list/{{ $category->id }}/{{ str_replace(' ', '-', $category->name) }}"
                               title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px">
                                    <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                                </svg>
                            </a>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
 
            {{-- TOP QUIZ --}}
            <div>
                <div class="section-label">🎯 Top Quiz</div>
                <div class="tbl-card">
                    <div class="tbl-card-header">
                        📝 Quizzes
                    </div>
                    <div class="tbl-header quiz-grid">
                        <span>Name</span>
                        <span>Action</span>
                    </div>
                    @forelse($quizData as $item)
                    <div class="tbl-row quiz-grid">
                        <span class="cell-name">{{ $item->name }}</span>
                        <span>
                            <a class="attempt-btn"
                               href="/start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}">
                                Attempt →
                            </a>
                        </span>
                    </div>
                    @empty
                    <div style="text-align:center;padding:2rem;color:rgba(255,255,255,0.25);font-size:13px;">
                        No quizzes available yet
                    </div>
                    @endforelse
                </div>
            </div>
 
        </div>
    </div>
 
    <x-footer-user></x-footer-user>
 
</body>
</html>