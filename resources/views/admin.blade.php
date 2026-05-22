<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
        }

        .page { padding: 2.5rem 1rem; min-height: 100vh; }
        .container { max-width: 860px; margin: 0 auto; }

        /* ── SECTION TITLE ── */
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-title-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #e94560;
            flex-shrink: 0;
        }

        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 55px 1fr 1fr;
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
            grid-template-columns: 55px 1fr 1fr;
            padding: 12px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.03); }

        .cell-num   { font-size: 12px; color: rgba(255,255,255,0.25); }
        .cell-name  {
            font-size: 14px;
            font-weight: 500;
            color: #e2e8f0;
            display: flex;
            align-items: center;
            gap: 9px;
        }
        .cell-email { font-size: 13px; color: rgba(255,255,255,0.4); }

        .avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: rgba(83,74,183,0.25);
            border: 0.5px solid rgba(83,74,183,0.4);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500;
            color: #AFA9EC;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        /* ── PAGINATION ── */
        .pagination-wrap { margin-top: 1rem; padding: 0.75rem 0; }
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

<x-admin-navbar :name="$name" />

<div class="page">
    <div class="container">

        <div class="section-title">
            <span class="section-title-dot"></span>
            Users list
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
                <span class="cell-name">
                    <span class="avatar">{{ substr($user->name, 0, 1) }}</span>
                    {{ $user->name }}
                </span>
                <span class="cell-email">{{ $user->email }}</span>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $users->links() }}
        </div>

    </div>
</div>

</body>
</html>