<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details Page</title>
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
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .page-title span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .total-badge {
            font-size: 12px;
            font-weight: 500;
            color: #f87191;
            background: rgba(233,69,96,0.15);
            border: 0.5px solid rgba(233,69,96,0.3);
            padding: 4px 12px;
            border-radius: 20px;
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
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            border-radius: 12px 12px 0 0;
        }
        .stat-card.total::before  { background: linear-gradient(90deg,#e94560,#f97316); }
        .stat-card.done::before   { background: linear-gradient(90deg,#10b981,#34d399); }
        .stat-card.pending::before{ background: linear-gradient(90deg,#f59e0b,#fbbf24); }
        .stat-label {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 0.4rem;
        }
        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 28px;
            font-weight: 700;
        }
        .stat-card.total  .stat-value { color: #fda4af; }
        .stat-card.done   .stat-value { color: #6ee7b7; }
        .stat-card.pending .stat-value { color: #fcd34d; }

        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 52px 1fr 130px;
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
            grid-template-columns: 52px 1fr 130px;
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

        .cell-num  { font-size: 12px; color: rgba(255,255,255,0.25); }
        .cell-name { font-size: 14px; font-weight: 500; color: #e2e8f0; }

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
        .status-pill.completed {
            color: #86efac;
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.3);
        }
        .status-pill.pending {
            color: #fcd34d;
            background: rgba(245,158,11,0.12);
            border: 0.5px solid rgba(245,158,11,0.3);
        }
        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }
        .completed .status-dot { background: #4ade80; }
        .pending   .status-dot { background: #fbbf24; }

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

    <x-user-navbar></x-user-navbar>

    <div class="main">

        <!-- Header -->
        <div class="page-header">
            <div class="page-title">
                Attempted <span>Quizzes</span>
                <span class="total-badge">{{ count($quizRecord) }} total</span>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-card total">
                <div class="stat-label">Total Attempted</div>
                <div class="stat-value">{{ count($quizRecord) }}</div>
            </div>
            <div class="stat-card done">
                <div class="stat-label">Completed</div>
                <div class="stat-value">{{ $quizRecord->where('status', 2)->count() }}</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-label">Not Completed</div>
                <div class="stat-value">{{ $quizRecord->where('status', '!=', 2)->count() }}</div>
            </div>
        </div>

        <!-- Table -->
        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>#</span>
                <span>Quiz Name</span>
                <span>Status</span>
            </div>

            @forelse($quizRecord as $key => $record)
            <div class="tbl-row">
                <span class="cell-num">{{ $key + 1 }}</span>
                <span class="cell-name">{{ $record->name }}</span>
                <span>
                    @if($record->status == 2)
                        <span class="status-pill completed">
                            <span class="status-dot"></span>
                            Completed
                        </span>
                    @else
                        <span class="status-pill pending">
                            <span class="status-dot"></span>
                            Not Completed
                        </span>
                    @endif
                </span>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <div class="empty-text">No quizzes attempted yet</div>
            </div>
            @endforelse

        </div>

    </div>

    <x-footer-user></x-footer-user>

</body>
</html>