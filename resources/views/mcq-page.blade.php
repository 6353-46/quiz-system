<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quizName }} - Quiz System</title>
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

        /* ── ALERT ── */
        .alert-msg {
            max-width: 600px;
            margin: 1.25rem auto 0;
            padding: 11px 18px;
            border-radius: 10px;
            font-size: 14px; font-weight: 500;
            text-align: center;
        }
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 0.5px solid rgba(239,68,68,0.25);
            color: #fca5a5;
        }
        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 0.5px solid rgba(34,197,94,0.25);
            color: #86efac;
        }

        /* ── PAGE ── */
        .page-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2.5rem 1.5rem 5rem;
            min-height: calc(100vh - 56px);
        }

        /* ── QUIZ TITLE ── */
        .quiz-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem; font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 1.25rem;
            text-transform: capitalize;
        }

        /* ── PROGRESS ── */
        .progress-wrap {
            width: 100%; max-width: 560px;
            margin-bottom: 1.75rem;
        }
        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .progress-label {
            font-size: 12px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }
        .progress-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .progress-count {
            font-family: 'Syne', sans-serif;
            font-size: 13px; font-weight: 600;
            color: #4ade80;
        }
        .progress-bar-bg {
            width: 100%; height: 5px;
            background: rgba(255,255,255,0.07);
            border-radius: 99px; overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #16a34a, #4ade80);
            border-radius: 99px;
            transition: width 0.4s ease;
        }

        /* ── TIMER BADGE ── */
        .timer-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 4px 12px;
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #e2e8f0;
            min-width: 68px;
            justify-content: center;
            transition: border-color 0.3s, color 0.3s, background 0.3s;
        }
        .timer-badge.warn {
            border-color: rgba(251,146,60,0.5);
            color: #fb923c;
            background: rgba(251,146,60,0.08);
        }
        .timer-badge.danger {
            border-color: rgba(239,68,68,0.5);
            color: #f87171;
            background: rgba(239,68,68,0.08);
            animation: timerPulse 0.5s ease-in-out infinite alternate;
        }
        @keyframes timerPulse {
            from { opacity: 1; }
            to   { opacity: 0.45; }
        }

        /* ── CARD ── */
        .mcq-card {
            width: 100%; max-width: 560px;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 18px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        .mcq-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #16a34a, #4ade80);
        }

        .question-num {
            font-size: 11px; font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: rgba(255,255,255,0.3);
            margin-bottom: 10px;
        }
        .question-text {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem; font-weight: 600;
            color: #fff; line-height: 1.55;
            margin-bottom: 1.5rem;
        }

        /* ── OPTIONS ── */
        .options { display: flex; flex-direction: column; gap: 10px; margin-bottom: 1.5rem; }

        .option-label {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 16px;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.18s, border-color 0.18s;
            user-select: none;
        }
        .option-label:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.18);
        }
        .option-label input[type="radio"] { display: none; }
        .option-label input[type="radio"] + .radio-dot {
            width: 18px; height: 18px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.25);
            background: transparent; flex-shrink: 0;
            transition: border-color 0.18s, background 0.18s;
            display: flex; align-items: center; justify-content: center;
        }
        .option-label input[type="radio"]:checked + .radio-dot {
            border-color: #4ade80;
            background: #16a34a;
        }
        .option-label input[type="radio"]:checked + .radio-dot::after {
            content: '';
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #fff;
        }
        .option-label:has(input:checked) {
            background: rgba(34,197,94,0.08);
            border-color: rgba(34,197,94,0.3);
        }
        .option-letter {
            font-size: 11px; font-weight: 600;
            color: rgba(255,255,255,0.3);
            width: 18px; flex-shrink: 0;
            text-transform: uppercase;
        }
        .option-text { font-size: 14px; color: #e2e8f0; line-height: 1.5; }

        /* ── TIMEOUT STATE — all options go red, no correct revealed ── */
        .option-label.timed-out {
            background: rgba(239,68,68,0.07) !important;
            border-color: rgba(239,68,68,0.3) !important;
            cursor: not-allowed;
            opacity: 0.75;
            pointer-events: none;
        }
        .option-label.timed-out .radio-dot {
            border-color: rgba(239,68,68,0.5) !important;
            background: rgba(239,68,68,0.15) !important;
        }
        .option-label.timed-out .option-letter {
            color: rgba(239,68,68,0.6) !important;
        }

        /* ── TIMEOUT MESSAGE ── */
        .timeout-msg {
            font-size: 13px;
            font-weight: 600;
            color: #f87171;
            text-align: center;
            margin-bottom: 10px;
        }

        /* ── ADVANCE BAR ── */
        .advance-bar-track {
            width: 100%; height: 4px;
            background: rgba(255,255,255,0.07);
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 14px;
        }
        .advance-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #dc2626, #f87171);
            border-radius: 99px;
            width: 100%;
            transition: width 0.05s linear;
        }

        /* ── SUBMIT BTN ── */
        .submit-btn {
            width: 100%; padding: 13px;
            background: #16a34a; color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 15px; font-weight: 600;
            border: none; border-radius: 11px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, opacity 0.2s;
        }
        .submit-btn:hover:not(:disabled) { background: #15803d; transform: translateY(-1px); }
        .submit-btn:active:not(:disabled) { transform: translateY(0); }
        .submit-btn:disabled {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.2);
            border: 0.5px solid rgba(255,255,255,0.08);
            cursor: not-allowed;
            transform: none;
        }

        .hint-text {
            text-align: center;
            font-size: 12px;
            color: rgba(255,255,255,0.2);
            margin-bottom: 10px;
            min-height: 18px;
            transition: color 0.2s;
        }
        .hint-text.active { color: rgba(74,222,128,0.5); }
    </style>
</head>
<body>

    <x-user-navbar></x-user-navbar>

    {{-- Alerts --}}
    @if(session('error'))
        <div class="alert-msg alert-error">⚠ {{ session('error') }}</div>
    @endif
    @if(session('message'))
        <div class="alert-msg alert-success">{{ session('message') }}</div>
    @endif

    <div class="page-wrap">

        <!-- Quiz Title -->
        <h1 class="quiz-title">{{ str_replace('-', ' ', $quizName) }}</h1>

        <!-- Progress -->
        <div class="progress-wrap">
            <div class="progress-info">
                <span class="progress-label">Progress</span>
                <div class="progress-right">
                    <span class="progress-count">
                        {{ session('currentQuiz')['currentMcq'] }} of {{ session('currentQuiz')['totalMcq'] }}
                    </span>
                    <!-- Timer Badge -->
                    <div class="timer-badge" id="timer-badge">
                        ⏱ <span id="timer-display">20s</span>
                    </div>
                </div>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill"
                    style="width: {{ (session('currentQuiz')['currentMcq'] / session('currentQuiz')['totalMcq']) * 100 }}%">
                </div>
            </div>
        </div>

        <!-- MCQ Card -->
        <div class="mcq-card">
            <p class="question-num">Question {{ session('currentQuiz')['currentMcq'] }}</p>

            <h3 class="question-text">{{ $mcqData->question }}</h3>

            <form action="/submit-next/{{ $mcqData->id }}" method="post" id="mcq-form">
                @csrf
                <input type="hidden" name="id" value="{{ $mcqData->id }}">
                {{-- hidden field sent when timer expires with no answer --}}
                <input type="hidden" name="timed_out" id="timed-out-field" value="0">

                <div class="options" id="options-wrap">
                    <label class="option-label">
                        <input type="radio" value="a" name="option" onchange="onOptionSelect()">
                        <span class="radio-dot"></span>
                        <span class="option-letter">A</span>
                        <span class="option-text">{{ $mcqData->a }}</span>
                    </label>

                    <label class="option-label">
                        <input type="radio" value="b" name="option" onchange="onOptionSelect()">
                        <span class="radio-dot"></span>
                        <span class="option-letter">B</span>
                        <span class="option-text">{{ $mcqData->b }}</span>
                    </label>

                    <label class="option-label">
                        <input type="radio" value="c" name="option" onchange="onOptionSelect()">
                        <span class="radio-dot"></span>
                        <span class="option-letter">C</span>
                        <span class="option-text">{{ $mcqData->c }}</span>
                    </label>

                    <label class="option-label">
                        <input type="radio" value="d" name="option" onchange="onOptionSelect()">
                        <span class="radio-dot"></span>
                        <span class="option-letter">D</span>
                        <span class="option-text">{{ $mcqData->d }}</span>
                    </label>
                </div>

                <!-- Timeout message + advance bar (hidden until timer fires) -->
                <div id="timeout-area" style="display:none;">
                    <p class="timeout-msg">❌ Time's up! Moving to next question...</p>
                    <div class="advance-bar-track">
                        <div class="advance-bar-fill" id="advance-bar"></div>
                    </div>
                </div>

                <p class="hint-text" id="hint-text">Select an option to continue</p>
                <button type="submit" class="submit-btn" id="submit-btn" disabled>
                    Submit Answer &amp; Next →
                </button>
            </form>
        </div>

    </div>

    <x-footer-user></x-footer-user>

    <script>
        const TOTAL_TIME    = 20;       // seconds per question
        const ADVANCE_DELAY = 1500;     // ms to show "time's up" before auto-submit

        let timeLeft        = TOTAL_TIME;
        let timerInterval   = null;
        let optionSelected  = false;

        const timerDisplay  = document.getElementById('timer-display');
        const timerBadge    = document.getElementById('timer-badge');
        const submitBtn     = document.getElementById('submit-btn');
        const hintText      = document.getElementById('hint-text');
        const timeoutArea   = document.getElementById('timeout-area');
        const advanceBar    = document.getElementById('advance-bar');
        const timedOutField = document.getElementById('timed-out-field');
        const optionsWrap   = document.getElementById('options-wrap');
        const form          = document.getElementById('mcq-form');

        function pad(n) { return String(n).padStart(2, '0'); }

        function updateTimerUI() {
            timerDisplay.textContent = pad(timeLeft) + 's';
            timerBadge.className = 'timer-badge'
                + (timeLeft <= 5  ? ' danger'
                :  timeLeft <= 10 ? ' warn'
                :  '');
        }

        function lockOptions() {
            // Disable all radio inputs and apply red timed-out style
            optionsWrap.querySelectorAll('.option-label').forEach(label => {
                label.classList.add('timed-out');
                label.querySelector('input[type="radio"]').disabled = true;
            });
        }

        function onTimeout() {
            clearInterval(timerInterval);

            if (optionSelected) {
                // User already picked — just submit normally
                form.submit();
                return;
            }

            // No answer — lock UI, mark as wrong, auto-advance
            lockOptions();
            timedOutField.value = '1';   // tell backend: timed out, count as wrong
            submitBtn.style.display = 'none';
            hintText.style.display  = 'none';
            timeoutArea.style.display = 'block';

            // Shrink the advance bar over ADVANCE_DELAY ms
            const start = performance.now();
            const barInterval = setInterval(() => {
                const pct = Math.max(0, 100 - ((performance.now() - start) / ADVANCE_DELAY * 100));
                advanceBar.style.width = pct + '%';
                if (pct <= 0) clearInterval(barInterval);
            }, 30);

            setTimeout(() => {
                clearInterval(barInterval);
                form.submit();
            }, ADVANCE_DELAY);
        }

        function startTimer() {
            updateTimerUI();
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerUI();
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    onTimeout();
                }
            }, 1000);
        }

        function onOptionSelect() {
            optionSelected = true;
            submitBtn.disabled = false;
            hintText.textContent = '✓ Option selected — ready to submit';
            hintText.classList.add('active');
        }

        // Kick off timer on page load
        startTimer();
    </script>

</body>
</html>