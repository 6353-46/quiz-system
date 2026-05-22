<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expert List</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        body { background: #0d0d14; color: #fff; min-height: 100vh; }

        /* ── PAGE ── */
        .page { padding: 2.5rem 1rem; min-height: 100vh; }
        .container { max-width: 860px; margin: 0 auto; }

        /* ── ALERT ── */
        .alert-success {
            background: rgba(5,46,22,0.8);
            color: #86efac;
            font-size: 13px;
            padding: 10px 16px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 0.5px solid rgba(134,239,172,0.2);
        }

        /* ── TITLE ── */
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-title-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #e94560;
            flex-shrink: 0;
            display: inline-block;
        }

        /* ── TABLE ── */
        .table-wrap {
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border: 0.5px solid rgba(255,255,255,0.08);
            overflow: hidden;
        }
        .table-head {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background: rgba(255,255,255,0.03);
            border-bottom: 0.5px solid rgba(255,255,255,0.07);
        }
        .th {
            font-size: 11px;
            font-weight: 500;
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .row {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .row:last-child { border-bottom: none; }
        .row:hover { background: rgba(255,255,255,0.03); }

        .col-sno   { width: 60px; flex-shrink: 0; }
        .col-name  { flex: 1; }
        .col-email { flex: 1.5; }
        .col-action { width: 80px; flex-shrink: 0; text-align: right; }

        .td-sno  { font-size: 12px; color: rgba(255,255,255,0.25); }
        .td-name { font-size: 14px; color: #fff; font-weight: 500; display: flex; align-items: center; gap: 10px; }
        .td-email { font-size: 13px; color: rgba(255,255,255,0.4); }

        .avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: rgba(83,74,183,0.3);
            border: 0.5px solid rgba(83,74,183,0.5);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500;
            color: #AFA9EC;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .btn-delete {
            font-size: 12px;
            color: #f87171;
            padding: 4px 12px;
            border-radius: 6px;
            background: rgba(220,38,38,0.1);
            border: 0.5px solid rgba(220,38,38,0.25);
            text-decoration: none;
            transition: all 0.15s;
            display: inline-block;
        }
        .btn-delete:hover {
            background: rgba(220,38,38,0.2);
            border-color: rgba(220,38,38,0.45);
            color: #fca5a5;
        }

        /* ── PAGINATION ── */
        .pagination-wrap {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }
        /* Override Laravel pagination for dark theme */
        .pagination-wrap nav span,
        .pagination-wrap nav a {
            background: rgba(255,255,255,0.04) !important;
            border: 0.5px solid rgba(255,255,255,0.08) !important;
            color: rgba(255,255,255,0.5) !important;
            border-radius: 7px !important;
            font-size: 13px !important;
            margin: 0 2px !important;
            padding: 5px 11px !important;
        }
        .pagination-wrap nav a:hover {
            background: rgba(255,255,255,0.08) !important;
            color: #fff !important;
        }
        .pagination-wrap nav span[aria-current="page"] span {
            background: #e94560 !important;
            border-color: #e94560 !important;
            color: #fff !important;
        }
    </style>
</head>
<body>

<x-admin-navbar :name="$name" />

<div class="page">
    <div class="container">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="page-title">
            <span class="page-title-dot"></span>
            Experts list
        </div>

        <div class="table-wrap">
            <div class="table-head">
                <span class="th col-sno">#</span>
                <span class="th col-name">Name</span>
                <span class="th col-email">Email</span>
                <span class="th col-action">Action</span>
            </div>

            @foreach($experts as $key => $expert)
            <div class="row">
                <span class="td-sno col-sno">{{ $key + 1 }}</span>
                <span class="col-name">
                    <span class="td-name">
                        <span class="avatar">{{ substr($expert->name, 0, 1) }}</span>
                        {{ $expert->name }}
                    </span>
                </span>
                <span class="td-email col-email">{{ $expert->email }}</span>
                <span class="col-action">
                    <a class="btn-delete"
                       href="/delete-expert/{{ $expert->id }}"
                       onclick="return confirm('Delete {{ $expert->name }}?')">
                        Delete
                    </a>
                </span>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $experts->links() }}
        </div>

    </div>
</div>

</body>
</html>