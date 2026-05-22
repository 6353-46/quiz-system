<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz MCQs</title>
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
            flex-wrap: wrap;
        }
        .page-title span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .mcq-badge {
            font-size: 12px;
            font-weight: 500;
            color: #86efac;
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.3);
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
            grid-template-columns: 80px 1fr;
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
            grid-template-columns: 80px 1fr;
            padding: 14px 18px;
            align-items: start;
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
        .tbl-row:nth-child(6){animation-delay:0.24s}
        .tbl-row:nth-child(7){animation-delay:0.28s}

        .cell-id {
            font-size: 12px;
            color: rgba(255,255,255,0.25);
            font-family: monospace;
            padding-top: 3px;
        }

        .question-wrap {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .q-number {
            font-size: 11px;
            color: rgba(255,255,255,0.25);
        }
        .cell-question {
            font-size: 14px;
            font-weight: 500;
            color: #e2e8f0;
            line-height: 1.5;
        }

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
                <div class="header-label">📝 Quiz Questions</div>
                <div class="page-title">
                    <span>{{ $quizName }}</span>
                    <span class="mcq-badge">{{ count($mcqs) }} MCQs</span>
                </div>
            </div>
            <a class="back-btn" href="/add-quiz">← Back</a>
        </div>

        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>MCQ ID</span>
                <span>Question</span>
            </div>

            @forelse($mcqs as $key => $mcq)
            <div class="tbl-row">
                <span class="cell-id">#{{ $mcq->id }}</span>
                <div class="question-wrap">
                    <span class="q-number">Q{{ $key + 1 }}</span>
                    <span class="cell-question">{{ $mcq->question }}</span>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">❓</div>
                <div class="empty-text">No MCQs added to this quiz yet</div>
            </div>
            @endforelse

        </div>

    </div>

</body>
</html>