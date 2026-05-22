<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expert Dashboard</title>
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

        /* ── HEADER ROW ── */
        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
        }
        .page-title span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .users-badge {
            font-size: 12px;
            font-weight: 500;
            color: #f87191;
            background: rgba(233,69,96,0.15);
            border: 0.5px solid rgba(233,69,96,0.3);
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 52px 1fr 1fr;
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
            grid-template-columns: 52px 1fr 1fr;
            padding: 13px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
            animation: rowIn 0.3s ease both;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.04); }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-8px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .tbl-row:nth-child(1){animation-delay:0.04s}
        .tbl-row:nth-child(2){animation-delay:0.08s}
        .tbl-row:nth-child(3){animation-delay:0.12s}
        .tbl-row:nth-child(4){animation-delay:0.16s}
        .tbl-row:nth-child(5){animation-delay:0.20s}

        .cell-num   { font-size: 12px; color: rgba(255,255,255,0.25); }
        .cell-name  { font-size: 14px; font-weight: 500; color: #e2e8f0; }
        .cell-email { font-size: 13px; color: rgba(255,255,255,0.45); }

        /* Avatar */
        .user-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        /* Avatar colors cycle */
        .av-0 { background: linear-gradient(135deg,#3b82f6,#60a5fa); }
        .av-1 { background: linear-gradient(135deg,#8b5cf6,#a78bfa); }
        .av-2 { background: linear-gradient(135deg,#10b981,#34d399); }
        .av-3 { background: linear-gradient(135deg,#e94560,#f97316); }
        .av-4 { background: linear-gradient(135deg,#f59e0b,#fbbf24); }

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

    <x-navbar name="{{ $name }}"></x-navbar>

    <div class="main">

        <div class="header-row">
            <h1 class="page-title">Users <span>List</span></h1>
            <span class="users-badge">{{ $users->total() }} users</span>
        </div>

        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>#</span>
                <span>Name</span>
                <span>Email</span>
            </div>

            @foreach($users as $key => $user)
            <div class="tbl-row">
                <span class="cell-num">{{ $key + 1 }}</span>
                <span>
                    <div class="user-row">
                        <div class="avatar av-{{ $key % 5 }}">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <span class="cell-name">{{ $user->name }}</span>
                    </div>
                </span>
                <span class="cell-email">{{ $user->email }}</span>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $users->links() }}
        </div>

    </div>

</body>
</html>