<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result - Quiz System</title>
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
 
        /* ── PAGE ── */
        .page-wrap {
            max-width: 780px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 5rem;
        }
 
        /* ── RESULT HEADER ── */
        .result-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .result-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(34,197,94,0.1);
            border: 0.5px solid rgba(34,197,94,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 36px;
            margin: 0 auto 1.25rem;
        }
        .result-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem; font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }
 
        /* ── SCORE CARD ── */
        .score-card {
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        .score-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #16a34a, #4ade80);
        }
        .score-number {
            font-family: 'Syne', sans-serif;
            font-size: 3.5rem; font-weight: 700;
            color: #4ade80;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        .score-label {
            font-size: 15px;
            color: rgba(255,255,255,0.45);
        }
        .score-label span { color: #fff; font-weight: 600; }
 
        /* ── CERTIFICATE LINK ── */
        .cert-banner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(34,197,94,0.08);
            border: 0.5px solid rgba(34,197,94,0.25);
            border-radius: 12px;
            padding: 14px 20px;
            margin-bottom: 1.75rem;
            text-decoration: none;
            color: #4ade80;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.2s;
        }
        .cert-banner:hover {
            background: rgba(34,197,94,0.14);
            color: #4ade80;
        }
 
        /* ── TABLE ── */
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 60px 1fr 110px;
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
            grid-template-columns: 60px 1fr 110px;
            padding: 13px 18px;
            align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.03); }
        .tbl-row:nth-child(even) { background: rgba(255,255,255,0.02); }
 
        .cell-num {
            font-size: 12px;
            color: rgba(255,255,255,0.25);
        }
        .cell-question {
            font-size: 14px;
            color: #e2e8f0;
            line-height: 1.5;
            padding-right: 1rem;
        }
        .badge-correct {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            color: #4ade80;
            background: rgba(34,197,94,0.1);
            border: 0.5px solid rgba(34,197,94,0.2);
            padding: 4px 10px;
            border-radius: 20px;
        }
        .badge-incorrect {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            color: #f87171;
            background: rgba(239,68,68,0.1);
            border: 0.5px solid rgba(239,68,68,0.2);
            padding: 4px 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
 
    <x-user-navbar></x-user-navbar>
 
    <div class="page-wrap">
 
        <!-- HEADER -->
        <div class="result-header">
            <div class="result-icon">🏆</div>
            <h1 class="result-title">Quiz Result</h1>
        </div>
 
        <!-- SCORE CARD -->
        <div class="score-card">
            <div class="score-number">{{ $correctAnswers }} / {{ count($resultData) }}</div>
            <p class="score-label">
                You got <span>{{ $correctAnswers }}</span> out of <span>{{ count($resultData) }}</span> correct
            </p>
        </div>
 
        <!-- CERTIFICATE LINK -->
        @if(count($resultData) > 0 && $correctAnswers * 100 / count($resultData) > 70)
            <a class="cert-banner" href="/certificate">
                🎓 View and Download Certificate
            </a>
        @endif
 
        <!-- RESULT TABLE -->
        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>S. No</span>
                <span>Question</span>
                <span>Result</span>
            </div>
 
            @foreach($resultData as $key => $item)
            <div class="tbl-row">
                <span class="cell-num">{{ $key + 1 }}</span>
                <span class="cell-question">{{ $item->question }}</span>
                <span>
                    @if($item->is_correct)
                        <span class="badge-correct">✓ Correct</span>
                    @else
                        <span class="badge-incorrect">✗ Incorrect</span>
                    @endif
                </span>
            </div>
            @endforeach
        </div>
 
    </div>
 
    <x-footer-user></x-footer-user>
 
</body>
</html>