<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category: {{ str_replace('-',' ', $category) }} - Quiz System</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
 
        body {
            font-family: 'DM Sans', sans-serif;
            background: #080c14;
            min-height: 100vh;
            color: #e2e8f0;
            overflow-x: hidden;
        }
 
        /* ── ANIMATED BG ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.12;
            animation: drift 12s ease-in-out infinite alternate;
        }
        .bg-blob-1 {
            width: 500px; height: 500px;
            background: #e94560;
            top: -100px; left: -100px;
            animation-delay: 0s;
        }
        .bg-blob-2 {
            width: 400px; height: 400px;
            background: #6366f1;
            bottom: -80px; right: -80px;
            animation-delay: -4s;
        }
        .bg-blob-3 {
            width: 300px; height: 300px;
            background: #f97316;
            top: 40%; left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -8s;
        }
        @keyframes drift {
            0%   { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 20px) scale(1.08); }
        }
 
        /* dot grid */
        .bg-dots {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }
 
        /* ── LAYOUT ── */
        .page-wrap {
            position: relative;
            z-index: 1;
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 1.5rem 6rem;
        }
 
        /* ── HEADER ── */
        .page-header {
            margin-bottom: 3rem;
            position: relative;
        }
        .header-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #e94560;
            background: rgba(233,69,96,0.1);
            border: 0.5px solid rgba(233,69,96,0.25);
            border-radius: 30px;
            padding: 5px 14px;
            margin-bottom: 1rem;
        }
        .header-tag::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #e94560;
            animation: pulse 1.5s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.8); }
        }
 
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            text-transform: capitalize;
            margin-bottom: 0.5rem;
        }
        .page-title .highlight {
            position: relative;
            display: inline-block;
            color: transparent;
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            background-clip: text;
        }
        .page-subtitle {
            font-size: 15px;
            color: rgba(255,255,255,0.35);
            font-style: italic;
        }
 
        /* ── GRID ── */
        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }
        @media(max-width: 900px) { .quiz-grid { grid-template-columns: repeat(2, 1fr); } }
        @media(max-width: 560px) { .quiz-grid { grid-template-columns: 1fr; } }
 
        /* ── CARD ── */
        .quiz-card {
            background: rgba(255,255,255,0.03);
            border: 0.5px solid rgba(255,255,255,0.07);
            border-radius: 18px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 14px;
            position: relative;
            overflow: hidden;
            transition: transform 0.25s ease, border-color 0.25s, background 0.25s;
            cursor: default;
            animation: fadeUp 0.5s ease both;
        }
        .quiz-card:nth-child(1) { animation-delay: 0.05s; }
        .quiz-card:nth-child(2) { animation-delay: 0.1s; }
        .quiz-card:nth-child(3) { animation-delay: 0.15s; }
        .quiz-card:nth-child(4) { animation-delay: 0.2s; }
        .quiz-card:nth-child(5) { animation-delay: 0.25s; }
        .quiz-card:nth-child(6) { animation-delay: 0.3s; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
 
        .quiz-card:hover {
            transform: translateY(-6px);
            border-color: rgba(233,69,96,0.3);
            background: rgba(255,255,255,0.06);
        }
 
        /* card number badge */
        .card-number {
            position: absolute;
            top: 14px; right: 16px;
            font-family: 'Syne', sans-serif;
            font-size: 3rem; font-weight: 800;
            color: rgba(255,255,255,0.04);
            line-height: 1;
            user-select: none;
            transition: color 0.25s;
        }
        .quiz-card:hover .card-number { color: rgba(233,69,96,0.08); }
 
        /* emoji icon */
        .card-emoji {
            font-size: 28px;
            width: 52px; height: 52px;
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s, transform 0.2s;
        }
        .quiz-card:hover .card-emoji {
            background: rgba(233,69,96,0.1);
            border-color: rgba(233,69,96,0.2);
            transform: rotate(-5deg) scale(1.1);
        }
 
        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem; font-weight: 700;
            color: #fff;
            line-height: 1.4;
            text-transform: capitalize;
            padding-right: 2rem;
        }
 
        /* meta row */
        .card-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: rgba(255,255,255,0.35);
        }
        .meta-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #e94560;
            flex-shrink: 0;
        }
        .card-meta strong { color: #f97316; font-weight: 600; }
 
        /* progress bar decorative */
        .card-bar-bg {
            width: 100%; height: 3px;
            background: rgba(255,255,255,0.05);
            border-radius: 99px;
            overflow: hidden;
        }
        .card-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #e94560, #f97316);
            border-radius: 99px;
            width: 60%;
        }
 
        /* attempt button */
        .attempt-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            background: linear-gradient(135deg, #e94560, #c2185b);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 13px; font-weight: 700;
            border-radius: 10px;
            text-decoration: none;
            transition: opacity 0.18s, transform 0.18s, box-shadow 0.18s;
            margin-top: auto;
            letter-spacing: 0.3px;
        }
        .attempt-btn:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(233,69,96,0.35);
            color: #fff;
        }
        .attempt-btn svg { transition: transform 0.2s; }
        .attempt-btn:hover svg { transform: translateX(3px); }
 
        /* empty */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 5rem 1rem;
            color: rgba(255,255,255,0.2);
            font-size: 15px;
        }
 
        /* emoji pool for variety */
    </style>
</head>
<body>
 
    <!-- BG -->
    <div class="bg-layer">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>
    </div>
    <div class="bg-dots"></div>
 
    <x-user-navbar></x-user-navbar>
 
    <div class="page-wrap">
 
        <!-- HEADER -->
        <div class="page-header">
            <div class="header-tag">Browse Quizzes</div>
            <h1 class="page-title">
                <span class="highlight">{{ str_replace('-', ' ', $category) }}</span>
            </h1>
            <p class="page-subtitle">Pick a quiz and test your knowledge</p>
        </div>
 
        <!-- GRID -->
        <div class="quiz-grid">
            @php
                $emojis = ['🧠','⚡','🎯','🔥','💡','🚀','📚','🎓','🏆','🧩','💻','🌟'];
            @endphp
 
            @forelse($quizData as $index => $item)
            <div class="quiz-card">
                <span class="card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
 
                <div class="card-emoji">{{ $emojis[$index % count($emojis)] }}</div>
 
                <h3 class="card-title">{{ $item->name }}</h3>
 
                <div class="card-meta">
                    <span class="meta-dot"></span>
                    <span><strong>{{ $item->mcq_count }}</strong> Questions</span>
                </div>
 
                <div class="card-bar-bg">
                    <div class="card-bar-fill" style="width: {{ min(100, $item->mcq_count * 5) }}%"></div>
                </div>
 
                <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}"
                   class="attempt-btn">
                    Attempt Quiz
                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#fff">
                        <path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/>
                    </svg>
                </a>
            </div>
            @empty
                <div class="empty-state">No quizzes found in this category.</div>
            @endforelse
        </div>
 
    </div>
 
    <x-footer-user></x-footer-user>
 
</body>
</html>
 