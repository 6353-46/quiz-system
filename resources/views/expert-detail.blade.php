<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expert Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
        }

        .main {
            max-width: 900px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* ── PROFILE HERO ── */
        .profile-hero {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 1.75rem;
            position: relative;
            overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }
        .profile-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #e94560, #f97316);
            border-radius: 16px 16px 0 0;
        }
        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e94560, #f97316);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
            box-shadow: 0 0 0 3px rgba(233,69,96,0.2);
        }
        .profile-info { flex: 1; min-width: 0; }
        .profile-name {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .profile-email {
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }
        .expert-badge {
            font-size: 11px;
            font-weight: 600;
            color: #fda4af;
            background: rgba(233,69,96,0.15);
            border: 0.5px solid rgba(233,69,96,0.3);
            padding: 4px 14px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── STATS ROW ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.75rem;
        }
        .stat-card {
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            position: relative;
            overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }
        .stat-card:nth-child(1){ animation-delay: 0.08s; }
        .stat-card:nth-child(2){ animation-delay: 0.14s; }
        .stat-card:nth-child(3){ animation-delay: 0.20s; }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            border-radius: 12px 12px 0 0;
        }
        .stat-card.quizzes::before  { background: linear-gradient(90deg,#e94560,#f97316); }
        .stat-card.students::before { background: linear-gradient(90deg,#10b981,#34d399); }
        .stat-card.active::before   { background: linear-gradient(90deg,#6366f1,#a78bfa); }
        .stat-label {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 0.4rem;
        }
        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 30px;
            font-weight: 700;
        }
        .stat-card.quizzes  .stat-value { color: #fda4af; }
        .stat-card.students .stat-value { color: #6ee7b7; }
        .stat-card.active   .stat-value { color: #c4b5fd; }
        .stat-sub {
            font-size: 11px;
            color: rgba(255,255,255,0.25);
            margin-top: 4px;
        }

        /* ── SECTION TITLE ── */
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 0.5px;
            background: rgba(255,255,255,0.08);
        }

        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
            animation: fadeUp 0.4s ease 0.25s both;
        }
     .tbl-header {
    display: grid;
    grid-template-columns: 60px 1fr 120px; /* ✅ slightly wider */
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
    grid-template-columns: 60px 1fr 120px; /* ✅ must match header exactly */
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

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .cell-num  { font-size: 12px; color: rgba(255,255,255,0.25); }
        .cell-name { font-size: 14px; font-weight: 500; color: #e2e8f0; }

        /* Players count badge */
        .players-count {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            font-weight: 500;
            color: #6ee7b7;
        }
        .players-icon { font-size: 13px; }

        /* Status pills */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 20px;
        }
        .status-pill.active {
            color: #86efac;
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.3);
        }
        .status-pill.inactive {
            color: #fcd34d;
            background: rgba(245,158,11,0.12);
            border: 0.5px solid rgba(245,158,11,0.3);
        }
        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
        }
        .active   .status-dot { background: #4ade80; }
        .inactive .status-dot { background: #fbbf24; }

        /* ── EMPTY ── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: rgba(255,255,255,0.3);
        }
        .empty-icon { font-size: 36px; margin-bottom: 0.75rem; }
        .empty-text { font-size: 14px; }

        /* ── RESPONSIVE ── */
        @media(max-width: 600px) {
            .stats-row { grid-template-columns: 1fr 1fr; }
            .tbl-header,
            .tbl-row { grid-template-columns: 40px 1fr 100px; }
            .profile-hero { flex-wrap: wrap; }
        }
        /* Pagination Styling */
.pagination {
    display: flex;
    align-items: center;
    gap: 6px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li a,
.pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    font-size: 13px;
    color: rgba(255,255,255,0.6);
    background: rgba(255,255,255,0.05);
    border: 0.5px solid rgba(255,255,255,0.1);
    text-decoration: none;
    transition: all 0.2s;
}

.pagination li a:hover {
    background: rgba(255,255,255,0.12);
    color: #fff;
}

.pagination li.active span {
    background: #e94560;
    color: #fff;
    border-color: #e94560;
    font-weight: 600;
}

.pagination li.disabled span {
    opacity: 0.3;
    cursor: not-allowed;
}
/* Hide Next/Previous text */
.page-item:first-child .page-link,
.page-item:last-child .page-link {
    font-size: 13px;
    color: transparent;
    position: relative;
}

/* Show arrow icons instead of text */
.page-item:first-child .page-link::after {
    content: '‹';
    position: absolute;
    color: rgba(255,255,255,0.6);
    font-size: 16px;
}

.page-item:last-child .page-link::after {
    content: '›';
    position: absolute;
    color: rgba(255,255,255,0.6);
    font-size: 16px;
}


    </style>
</head>
<body>

    <x-navbar name="{{ $expert->name }}"></x-navbar>

    <div class="main">

        {{-- ── PROFILE HERO ── --}}
        <div class="profile-hero">
            <div class="avatar">
                {{ strtoupper(substr($expert->name, 0, 1)) }}
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $expert->name }}</div>
                <div class="profile-email">{{ $expert->email }}</div>
            </div>
            <span class="expert-badge">Quiz Creator</span>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-row">
            <div class="stat-card quizzes">
                <div class="stat-label">Total Quizzes</div>
                <div class="stat-value">{{ $quiz->count() }}</div>
                <div class="stat-sub">quizzes created</div>
            </div>
            <div class="stat-card students">
                <div class="stat-label">Total Questions</div>
                <div class="stat-value">{{ $totalMCQs }}</div>
                <div class="stat-sub">questions created</div>
            </div>
            <div class="stat-card active">
                <div class="stat-label">Categories</div>
                <div class="stat-value">{{ $categories->count() }}</div>
                <div class="stat-sub">across categories</div>
            </div>
        </div>

        {{-- ── QUIZ TABLE ── --}}
        <div class="section-title">My Quizzes</div>

        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>#</span>
                <span>Quiz Name</span>
                <span>Players</span>
            </div>

            @forelse($quizzes as $key => $quiz)
            <div class="tbl-row">
                <span class="cell-num">{{ $key + 1 }}</span>
                <span class="cell-name">{{ $quiz->name }}</span>
                <span>
                    <span class="players-count">
                        <span class="players-icon">👥</span>
                        {{ $quiz->quiz_records_count ?? 0 }}
                    </span>
                </span>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <div class="empty-text">No quizzes created yet</div>
            </div>
            @endforelse
                            <div >
                    {{ $quizzes->links() }}
                </div>
        </div>
        
    </div>
  



</body>
</html>
