<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Quizzes</title>
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

        .main {
            max-width: 860px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* ── HEADER ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
            gap: 10px;
        }
        .header-left { display: flex; flex-direction: column; gap: 4px; }
        .header-label {
            font-size: 12px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-title span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .quiz-badge {
            font-size: 12px;
            font-weight: 500;
            color: #f87191;
            background: rgba(233,69,96,0.15);
            border: 0.5px solid rgba(233,69,96,0.3);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 9px;
            border: 0.5px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            transition: all 0.2s;
        }
        .back-btn:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.2);
        }

        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 80px 1fr 70px;
            padding: 10px 18px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.03);
            border-bottom: 0.5px solid rgba(255,255,255,0.07);
        }
        .tbl-row {
            display: grid;
            grid-template-columns: 80px 1fr 70px;
            padding: 13px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
            animation: rowIn 0.3s ease both;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.04); }

        @keyframes rowIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .tbl-row:nth-child(1){animation-delay:0.04s}
        .tbl-row:nth-child(2){animation-delay:0.08s}
        .tbl-row:nth-child(3){animation-delay:0.12s}
        .tbl-row:nth-child(4){animation-delay:0.16s}
        .tbl-row:nth-child(5){animation-delay:0.20s}

        .cell-id {
            font-size: 12px;
            color: rgba(255,255,255,0.25);
            font-family: monospace;
        }
        .cell-name {
            font-size: 14px;
            font-weight: 500;
            color: #e2e8f0;
        }

        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 0.5px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            transition: all 0.15s;
            text-decoration: none;
        }
        .icon-btn:hover {
            background: rgba(59,130,246,0.2);
            border-color: rgba(59,130,246,0.4);
        }
        .icon-btn svg { fill: rgba(255,255,255,0.55); transition: fill 0.15s; }
        .icon-btn:hover svg { fill: #93c5fd; }

        /* ── EMPTY ── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: rgba(255,255,255,0.3);
        }
        .empty-icon { font-size: 36px; margin-bottom: 0.75rem; }
        .empty-text { font-size: 14px; }
    </style>
</head>
<body>

    <x-navbar name="{{ $name }}"></x-navbar>

    <div class="main">

        <div class="page-header">
            <div class="header-left">
                <div class="header-label">📂 Category</div>
                <div class="page-title">
                    <span>{{ $category }}</span>
                    <span class="quiz-badge">{{ count($quizData) }} quizzes</span>
                </div>
            </div>
            <a class="back-btn" href="/add-quiz">← Back</a>
        </div>

        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>Quiz ID</span>
                <span>Name</span>
                <span>Action</span>
            </div>

            @forelse($quizData as $item)
            <div class="tbl-row">
                <span class="cell-id">#{{ $item->id }}</span>
                <span class="cell-name">{{ $item->name }}</span>
                <span>
                    <a class="icon-btn"
                       href="/show-quiz/{{ $item->id }}/{{ $item->name }}"
                       title="View Quiz">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px">
                            <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                        </svg>
                    </a>
                </span>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📝</div>
                <div class="empty-text">No quizzes in this category yet</div>
            </div>
            @endforelse

        </div>

    </div>

</body>
</html>