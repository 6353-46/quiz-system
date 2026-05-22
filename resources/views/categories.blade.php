<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
        }

        .page { padding: 2.5rem 1rem; min-height: 100vh; }
        .container { max-width: 860px; margin: 0 auto; }

        /* ── ALERT ── */
        .alert-success {
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.3);
            color: #86efac;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: rgba(255,255,255,0.03);
            border: 0.5px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 1.75rem;
            max-width: 400px;
            margin: 0 auto 2.5rem;
        }
        .form-title {
            font-family: 'Syne', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .form-title-dot { width: 7px; height: 7px; border-radius: 50%; background: #e94560; flex-shrink: 0; }

        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #fff;
            outline: none;
            transition: border-color 0.15s;
            margin-bottom: 6px;
            font-family: 'DM Sans', sans-serif;
        }
        .form-input::placeholder { color: rgba(255,255,255,0.25); }
        .form-input:focus { border-color: rgba(233,69,96,0.5); }
        .form-error { font-size: 12px; color: #f87171; margin-bottom: 10px; }

        .form-btn {
            width: 100%;
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
            font-family: 'DM Sans', sans-serif;
        }
        .form-btn:hover { background: #c73652; }

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
        .section-title-dot { width: 8px; height: 8px; border-radius: 50%; background: #e94560; flex-shrink: 0; }

        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 55px 1fr 1fr 90px;
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
            grid-template-columns: 55px 1fr 1fr 90px;
            padding: 12px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.03); }

        .cell-num     { font-size: 12px; color: rgba(255,255,255,0.25); }
        .cell-name    { font-size: 14px; font-weight: 500; color: #e2e8f0; }
        .cell-creator { font-size: 13px; color: rgba(255,255,255,0.4); }
        .cell-action  { display: flex; align-items: center; gap: 8px; }

        /* ── ICON BUTTONS ── */
        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 0.5px solid transparent;
            text-decoration: none;
            transition: all 0.15s;
        }
        .icon-btn svg { width: 16px; height: 16px; transition: fill 0.15s; }

        .icon-btn-delete {
            background: rgba(220,38,38,0.1);
            border-color: rgba(220,38,38,0.2);
        }
        .icon-btn-delete svg { fill: #f87171; }
        .icon-btn-delete:hover { background: rgba(220,38,38,0.22); border-color: rgba(220,38,38,0.45); }

        .icon-btn-view {
            background: rgba(59,130,246,0.1);
            border-color: rgba(59,130,246,0.2);
        }
        .icon-btn-view svg { fill: #93c5fd; }
        .icon-btn-view:hover { background: rgba(59,130,246,0.22); border-color: rgba(59,130,246,0.45); }

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

<x-navbar :name="$name" />

<div class="page">
    <div class="container">

        @if(session('category'))
            <div class="alert-success">{{ session('category') }}</div>
        @endif

        {{-- ADD CATEGORY FORM --}}
        <div class="form-card">
            <div class="form-title">
                <span class="form-title-dot"></span>
                Add category
            </div>
            <form action="/add-category" method="post">
                @csrf
                <input type="text" name="category"
                       placeholder="Enter category name"
                       class="form-input">
                @error('category')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <button type="submit" class="form-btn">Add</button>
            </form>
        </div>

        {{-- CATEGORY LIST --}}
        <div class="section-title">
            <span class="section-title-dot"></span>
            Category list
        </div>

        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>#</span>
                <span>Name</span>
                <span>Creator</span>
                <span>Action</span>
            </div>

            @foreach($categories as $category)
            <div class="tbl-row">
                <span class="cell-num">{{ $category->id }}</span>
                <span class="cell-name">{{ $category->name }}</span>
                <span class="cell-creator">{{ $category->creator }}</span>
                <span class="cell-action">
                    <a class="icon-btn icon-btn-delete"
                       href="category/delete/{{ $category->id }}"
                       onclick="return confirm('Delete {{ $category->name }}?')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                            <path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/>
                        </svg>
                    </a>
                    <a class="icon-btn icon-btn-view"
                       href="quiz-list/{{ $category->id }}/{{ $category->name }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
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
</div>

</body>
</html>