<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
        }
        .main { max-width: 1100px; margin: 0 auto; padding: 2.5rem 1.5rem 4rem; }
 
        /* ── PAGE TITLE ── */
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 26px; font-weight: 700;
            color: #fff; text-align: center;
            margin-bottom: 2.5rem;
        }
        .page-title span {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
 
        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem; margin-bottom: 2.5rem;
        }
        @media(max-width: 900px) { .stats-grid { grid-template-columns: repeat(2,1fr); } }
        @media(max-width: 500px) { .stats-grid { grid-template-columns: 1fr; } }
 
        .stat-card {
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.1);
            border-radius: 16px; padding: 1.5rem 1.25rem;
            position: relative; overflow: hidden;
            animation: fadeUp 0.4s ease both;
            transition: transform 0.2s, border-color 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); border-color: rgba(255,255,255,0.18); }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.10s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.20s; }
        .stat-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            border-radius: 16px 16px 0 0;
        }
        .stat-card.blue::before   { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .stat-card.purple::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .stat-card.green::before  { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card.red::before    { background: linear-gradient(90deg, #e94560, #f97316); }
        .stat-icon { font-size: 22px; margin-bottom: 0.75rem; }
        .stat-label {
            font-size: 12px; color: rgba(255,255,255,0.4);
            text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 0.4rem;
        }
        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 32px; font-weight: 700; color: #fff; line-height: 1;
        }
        .stat-value.sm { font-size: 20px; line-height: 1.3; }
        .stat-card.blue   .stat-value { color: #93c5fd; }
        .stat-card.purple .stat-value { color: #c4b5fd; }
        .stat-card.green  .stat-value { color: #6ee7b7; }
        .stat-card.red    .stat-value { color: #fda4af; }
 
        /* ── CHARTS GRID ── */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }
        @media(max-width: 750px) { .charts-grid { grid-template-columns: 1fr; } }
 
        .chart-card {
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 16px; padding: 1.5rem;
        }
        .chart-title {
            font-family: 'Syne', sans-serif;
            font-size: 15px; font-weight: 600; color: #fff;
            margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }
        .chart-wrap { position: relative; height: 240px; }
 
        /* ── RECENT ATTEMPTS TABLE ── */
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 16px; font-weight: 600; color: #fff;
            margin-bottom: 1rem;
            display: flex; align-items: center; gap: 8px;
        }
        .tbl-wrap {
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 14px; overflow: hidden;
        }
        .tbl-header {
            display: grid;
            grid-template-columns: 50px 1fr 1fr 120px 100px;
            padding: 10px 18px;
            font-size: 11px; font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.03);
            border-bottom: 0.5px solid rgba(255,255,255,0.07);
        }
        .tbl-row {
            display: grid;
            grid-template-columns: 50px 1fr 1fr 120px 100px;
            padding: 12px 18px; align-items: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .tbl-row:last-child { border-bottom: none; }
        .tbl-row:hover { background: rgba(255,255,255,0.03); }
        .cell-num { font-size: 12px; color: rgba(255,255,255,0.25); font-family: monospace; }
        .cell-text { font-size: 13px; color: #e2e8f0; text-transform: capitalize; }
        .cell-date { font-size: 12px; color: rgba(255,255,255,0.35); }
        .badge-pass {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 600; color: #4ade80;
            background: rgba(34,197,94,0.1); border: 0.5px solid rgba(34,197,94,0.2);
            padding: 3px 10px; border-radius: 20px;
        }
        .badge-fail {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 600; color: #f87171;
            background: rgba(239,68,68,0.1); border: 0.5px solid rgba(239,68,68,0.2);
            padding: 3px 10px; border-radius: 20px;
        }
        .badge-pending {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 600; color: #fbbf24;
            background: rgba(234,179,8,0.1); border: 0.5px solid rgba(234,179,8,0.2);
            padding: 3px 10px; border-radius: 20px;
        }
    </style>
</head>
<body>
 
    <x-admin-navbar name="{{ $name }}" />
 
    <div class="main">
 
        <h1 class="page-title">Admin <span>Dashboard</span></h1>
 
        <!-- ── STAT CARDS ── -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon">📝</div>
                <div class="stat-label">Total Quizzes</div>
                <div class="stat-value">{{ $totalQuizzes }}</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon">❓</div>
                <div class="stat-label">Total MCQs</div>
                <div class="stat-value">{{ $totalMcqs }}</div>
            </div>
            <div class="stat-card red">
                <div class="stat-icon">🏆</div>
                <div class="stat-label">Top Category</div>
                <div class="stat-value sm">{{ $topCategory->name }}</div>
            </div>
        </div>
 
        <!-- ── CHARTS ── -->
        <div class="charts-grid">
 
            <!-- Bar Chart: Top 5 Quizzes by Attempts -->
            <div class="chart-card">
                <div class="chart-title">📊 Top 5 Quizzes by Attempts</div>
                <div class="chart-wrap">
                    <canvas id="barChart"> 
                    </canvas>
                </div>
            </div>
 
            <!-- Line Chart: Last 7 Days Registrations -->
            <div class="chart-card">
                <div class="chart-title">📈 Last 7 Days Registrations</div>
                <div class="chart-wrap">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
 
        </div>
 
        <!-- ── RECENT ATTEMPTS ── -->
        <div class="section-title">🕐 Recent Attempts</div>
        <div class="tbl-wrap">
            <div class="tbl-header">
                <span>#</span>
                <span>User</span>
                <span>Quiz</span>
                <span>Date</span>
                <span>Status</span>
            </div>
 
            @forelse($recentAttempts as $key => $attempt)
            <div class="tbl-row">
                <span class="cell-num">{{ $key + 1 }}</span>
                <span class="cell-text">{{ $attempt->user->name ?? 'N/A' }}</span>
                <span class="cell-text">{{ $attempt->quiz->name ?? 'N/A' }}</span>
                <span class="cell-date">{{ \Carbon\Carbon::parse($attempt->created_at)->format('d M Y') }}</span>
                <span>
                    @if($attempt->status == 2)
                        <span class="badge-pass">✓ Completed</span>
                    @elseif($attempt->status == 1)
                        <span class="badge-pending">⏳ In Progress</span>
                    @else
                        <span class="badge-fail">✗ Failed</span>
                    @endif
                </span>
            </div>
            @empty
            <div style="padding: 2rem; text-align: center; color: rgba(255,255,255,0.2); font-size: 14px;">
                No recent attempts found.
            </div>
            @endforelse
        </div>
 
    </div>
 
    <script>
        // ── BAR CHART ──
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topQuizzes->pluck('name')) !!},
                datasets: [{
                    label: 'Attempts',
                    data: {!! json_encode($topQuizzes->pluck('attempts_count')) !!},
                    backgroundColor: [
                        'rgba(233,69,96,0.7)',
                        'rgba(249,115,22,0.7)',
                        'rgba(139,92,246,0.7)',
                        'rgba(59,130,246,0.7)',
                        'rgba(16,185,129,0.7)',
                    ],
                    borderColor: [
                        '#e94560','#f97316','#8b5cf6','#3b82f6','#10b981',
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 11 } },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    },
                    y: {
                        ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 11 } },
                        grid: { color: 'rgba(255,255,255,0.05)' },
                        beginAtZero: true
                    }
                }
            }
        });
 
        // ── LINE CHART ──
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($last7Days->pluck('date')) !!},
                datasets: [{
                    label: 'Registrations',
                    data: {!! json_encode($last7Days->pluck('count')) !!},
                    borderColor: '#e94560',
                    backgroundColor: 'rgba(233,69,96,0.1)',
                    borderWidth: 2,
                    pointBackgroundColor: '#e94560',
                    pointRadius: 4,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 11 } },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    },
                    y: {
                        ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 11 } },
                        grid: { color: 'rgba(255,255,255,0.05)' },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
 
</body>
</html>