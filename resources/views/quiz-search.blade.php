<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
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

        .search-header {
            margin-bottom: 1.75rem;
        }
        .search-label {
            font-size: 13px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .search-query {
            font-family: 'Syne', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .search-query span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .result-badge {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: #f87191;
            background: rgba(233,69,96,0.15);
            border: 0.5px solid rgba(233,69,96,0.3);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 70px 1fr 110px 140px;
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
            grid-template-columns: 70px 1fr 110px 140px;
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
        .cell-mcq {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: #93c5fd;
            background: rgba(59,130,246,0.12);
            padding: 3px 10px;
            border-radius: 20px;
            border: 0.5px solid rgba(59,130,246,0.2);
        }

        .attempt-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 8px;
            background: linear-gradient(135deg, #e94560, #c2185b);
            color: #fff;
            text-decoration: none;
            transition: opacity 0.18s, transform 0.15s;
            white-space: nowrap;
        }
        .attempt-btn:hover {
            opacity: 0.88;
            transform: translateY(-1px);
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: rgba(255,255,255,0.3);
        }
        .empty-icon { font-size: 40px; margin-bottom: 0.75rem; }
        .empty-text { font-size: 15px; }
    </style>
</head>
<body>

    <x-user-navbar></x-user-navbar>

    <div class="main">

        <div class="search-header">
            <div class="search-label">🔍 Search Results for</div>
            <div class="search-query">
                "<span>{{ $quiz }}</span>"
                <span class="result-badge">{{ $quizData->count() }} results</span>
            </div>
        </div>

        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>Quiz ID</span>
                <span>Name</span>
                <span>MCQ Count</span>
                <span>Action</span>
            </div>

            @forelse($quizData as $item)
            <div class="tbl-row">
                <span class="cell-id">#{{ $item->id }}</span>
                <span class="cell-name">{{ $item->name }}</span>
                <span>
                    <span class="cell-mcq">❓ {{ $item->mcq_count }}</span>
                </span>
                <span>
                    <a class="attempt-btn"
                       href="/start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}">
                        Attempt →
                    </a>
                </span>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <div class="empty-text">No quizzes found for "{{ $quiz }}"</div>
            </div>
            @endforelse

        </div>

    </div>

</body>
</html>