<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
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

        .hero {
            text-align: center;
            padding: 3rem 1rem 2rem;
        }
        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: 2.25rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.4rem;
        }
        .hero-title span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-sub {
            font-size: 15px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 1.75rem;
        }

        .search-wrap {
            position: relative;
            max-width: 460px;
            margin: 0 auto;
        }
        .search-input {
            width: 100%;
            padding: 11px 44px;
            border: 0.5px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #fff;
            background: rgba(255,255,255,0.07);
            outline: none;
            transition: border 0.2s;
        }
        .search-input::placeholder { color: rgba(255,255,255,0.3); }
        .search-input:focus { border-color: #e94560; }
        .search-icon-left {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            fill: rgba(255,255,255,0.3);
            pointer-events: none;
        }
        .search-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .search-btn svg { fill: rgba(255,255,255,0.35); transition: fill 0.2s; }
        .search-btn:hover svg { fill: #e94560; }

        .main-container {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 1.5rem 4rem;
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

        .section-label {
            font-family: 'Syne', sans-serif;
            font-size: 17px;
            font-weight: 600;
            color: #fff;
            margin: 2rem 0 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 48px 1fr 120px 70px;
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
            grid-template-columns: 48px 1fr 120px 70px;
            padding: 13px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.04); }

        .cell-num  { font-size: 12px; color: rgba(255,255,255,0.25); }
        .cell-name { font-size: 14px; font-weight: 500; color: #e2e8f0; }

        .badge-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 28px;
            font-size: 12px;
            font-weight: 600;
            color: #93c5fd;
            background: rgba(59,130,246,0.12);
            padding: 3px 10px;
            border-radius: 20px;
            border: 0.5px solid rgba(59,130,246,0.2);
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

        /* ── PAGINATION ── */
        .pagination-wrap {
            margin-top: 1rem;
            padding: 0.75rem 0;
        }
        .pagination-wrap nav { width: 100%; }
        .pagination-wrap nav > div {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: wrap;
            gap: 8px;
        }
        .pagination-wrap nav > div > p {
            color: rgba(255,255,255,0.35) !important;
            font-size: 13px !important;
            margin: 0 !important;
        }
        .pagination-wrap nav > div > div {
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
        }
        .pagination-wrap nav button,
        .pagination-wrap nav a {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 32px !important;
            height: 32px !important;
            padding: 0 8px !important;
            background: rgba(255,255,255,0.05) !important;
            border: 0.5px solid rgba(255,255,255,0.1) !important;
            border-radius: 7px !important;
            color: rgba(255,255,255,0.55) !important;
            font-size: 13px !important;
            text-decoration: none !important;
            transition: all 0.15s !important;
        }
        .pagination-wrap nav span[aria-current="page"] > span {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 32px !important;
            height: 32px !important;
            padding: 0 8px !important;
            background: rgba(233,69,96,0.3) !important;
            border: 0.5px solid rgba(233,69,96,0.5) !important;
            border-radius: 7px !important;
            color: #fff !important;
            font-size: 13px !important;
            font-weight: 600 !important;
        }
        .pagination-wrap nav button:hover,
        .pagination-wrap nav a:hover {
            background: rgba(233,69,96,0.2) !important;
            border-color: rgba(233,69,96,0.4) !important;
            color: #fff !important;
        }
        .pagination-wrap nav span:not([aria-current]) > span {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 32px !important;
            height: 32px !important;
            background: rgba(255,255,255,0.02) !important;
            border: 0.5px solid rgba(255,255,255,0.07) !important;
            border-radius: 7px !important;
            color: rgba(255,255,255,0.2) !important;
            font-size: 13px !important;
        }
        .pagination-wrap nav svg {
            fill: currentColor !important;
            width: 14px !important;
            height: 14px !important;
        }
    </style>
</head>
<body>

    <x-user-navbar></x-user-navbar>

    <div class="hero">
        <h1 class="hero-title">Check Your <span>Skills</span></h1>
        <p class="hero-sub">Browse categories and attempt quizzes to test your knowledge</p>

        <div class="search-wrap">
            <form action="search-quiz" method="get" style="position:relative">
                <svg class="search-icon-left" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px">
                    <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/>
                </svg>
                <input class="search-input" type="text" name="search" placeholder="Search quiz..." />
                <button class="search-btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56Z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="main-container">

        @if(session('message-success'))
            <div class="alert-success">{{ session('message-success') }}</div>
        @endif

        <div class="section-label">🏆 Top Categories</div>
        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>#</span>
                <span>Name</span>
                <span>Quiz Count</span>
                <span>Action</span>
            </div>

            @foreach($categories as $key => $category)
            <div class="tbl-row">
                <span class="cell-num">{{ $key + 1 }}</span>
                <span class="cell-name">{{ $category->name }}</span>
                <span>
                    <span class="badge-count">{{ $category->quizzes_count }}</span>
                </span>
                <span>
                    <a class="icon-btn"
                       href="user-quiz-list/{{ $category->id }}/{{ str_replace(' ', '-', $category->name) }}"
                       title="View Quizzes">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px">
                            <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                        </svg>
                    </a>
                </span>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $categories->links() }}
        </div>

    </div>

    <x-footer-user></x-footer-user>

</body>
</html>