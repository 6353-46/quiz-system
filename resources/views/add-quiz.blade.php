<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Quiz</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #0d0d14; color: #fff; min-height: 100vh; }

        .page { padding: 2.5rem 1rem; min-height: 100vh; display: flex; flex-direction: column; align-items: center; }

        /* ── CARD ── */
        .card {
            background: rgba(255,255,255,0.03);
            border: 0.5px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 2rem;
            width: 100%;
            max-width: 680px;
        }

        /* ── TITLES ── */
        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .title-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #e94560;
            flex-shrink: 0;
        }

        /* ── QUIZ INFO BAR ── */
        .quiz-info {
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.07);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }
        .quiz-info-name {
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .quiz-info-name-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #e94560;
            flex-shrink: 0;
        }
        .quiz-mcq-count {
            font-size: 13px;
            color: rgba(255,255,255,0.4);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .link-show {
            font-size: 12px;
            color: #EF9F27;
            text-decoration: none;
            padding: 3px 9px;
            border-radius: 6px;
            background: rgba(239,159,39,0.1);
            border: 0.5px solid rgba(239,159,39,0.25);
            transition: all 0.15s;
        }
        .link-show:hover { background: rgba(239,159,39,0.2); }

        /* ── SUCCESS BANNER ── */
        .success-banner {
            background: rgba(15,110,86,0.15);
            border: 0.5px solid rgba(93,202,165,0.25);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #5DCAA5;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── CSV IMPORT ── */
        .csv-section {
            background: rgba(255,255,255,0.02);
            border: 0.5px dashed rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 1.25rem;
        }
        .csv-title {
            font-size: 12px;
            font-weight: 500;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .csv-row {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .csv-input {
            flex: 1;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 7px;
            padding: 8px 12px;
            font-size: 12.5px;
            color: rgba(255,255,255,0.6);
            outline: none;
            font-family: 'DM Sans', sans-serif;
        }
        .csv-input:focus { border-color: rgba(233,69,96,0.35); }
        .csv-hint {
            font-size: 11px;
            color: rgba(255,255,255,0.2);
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .csv-sample {
            font-size: 11px;
            color: #AFA9EC;
            text-decoration: none;
            padding: 2px 8px;
            border-radius: 4px;
            background: rgba(83,74,183,0.12);
            border: 0.5px solid rgba(83,74,183,0.25);
            transition: all 0.15s;
        }
        .csv-sample:hover { background: rgba(83,74,183,0.22); }

        /* ── FORM ELEMENTS ── */
        .form-group { margin-bottom: 12px; }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 0.5px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #fff;
            outline: none;
            transition: border-color 0.15s;
            font-family: 'DM Sans', sans-serif;
        }
        .form-textarea { resize: vertical; min-height: 72px; }
        .form-input::placeholder,
        .form-textarea::placeholder { color: rgba(255,255,255,0.25); }
        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus { border-color: rgba(233,69,96,0.45); }

        .form-select { appearance: none; cursor: pointer; }
        .form-select option { background: #1a1a24; color: #fff; }

        .form-error { font-size: 12px; color: #f87171; margin-top: 5px; }

        /* ── DIVIDER ── */
        .divider {
            height: 0.5px;
            background: rgba(255,255,255,0.07);
            margin: 1.25rem 0;
        }

        /* ── BUTTONS ── */
        .btn {
            width: 100%;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'DM Sans', sans-serif;
            display: block;
            text-align: center;
            text-decoration: none;
            margin-bottom: 8px;
        }
        .btn-primary { background: #e94560; color: #fff; }
        .btn-primary:hover { background: #c73652; }

        .btn-import {
            background: rgba(83,74,183,0.2);
            color: #AFA9EC;
            border: 0.5px solid rgba(83,74,183,0.35);
            padding: 8px 14px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            white-space: nowrap;
            transition: all 0.15s;
        }
        .btn-import:hover { background: rgba(83,74,183,0.35); }

        .btn-add-row {
            width: 100%;
            background: transparent;
            border: 0.5px dashed rgba(233,69,96,0.3);
            border-radius: 8px;
            padding: 10px;
            font-size: 13px;
            color: rgba(233,69,96,0.7);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.15s;
            margin-bottom: 1rem;
        }
        .btn-add-row:hover {
            background: rgba(233,69,96,0.06);
            border-color: rgba(233,69,96,0.55);
            color: #e94560;
        }

        .btn-add-more {
            background: rgba(83,74,183,0.2);
            color: #AFA9EC;
            border: 0.5px solid rgba(83,74,183,0.35);
        }
        .btn-add-more:hover { background: rgba(83,74,183,0.35); }

        .btn-done {
            background: rgba(15,110,86,0.25);
            color: #5DCAA5;
            border: 0.5px solid rgba(15,110,86,0.4);
        }
        .btn-done:hover { background: rgba(15,110,86,0.4); }

        .btn-finish {
            background: rgba(220,38,38,0.1);
            color: #f87171;
            border: 0.5px solid rgba(220,38,38,0.25);
        }
        .btn-finish:hover { background: rgba(220,38,38,0.2); }

        /* ── OPTIONS GRID ── */
        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 12px;
        }
        .option-label {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        /* ── MCQ ROW ── */
        .mcq-row {
            background: rgba(255,255,255,0.02);
            border: 0.5px solid rgba(255,255,255,0.07);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            position: relative;
            transition: border-color 0.15s;
            animation: fadeSlideIn 0.2s ease;
        }
        .mcq-row:hover { border-color: rgba(255,255,255,0.12); }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .mcq-row-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .mcq-badge {
            font-size: 11px;
            font-weight: 600;
            color: #e94560;
            background: rgba(233,69,96,0.1);
            border: 0.5px solid rgba(233,69,96,0.2);
            border-radius: 5px;
            padding: 2px 8px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }
        .mcq-remove {
            background: rgba(220,38,38,0.08);
            border: 0.5px solid rgba(220,38,38,0.2);
            border-radius: 5px;
            color: #f87171;
            font-size: 12px;
            padding: 2px 9px;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.15s;
        }
        .mcq-remove:hover { background: rgba(220,38,38,0.18); }

        .mcq-counter {
            font-size: 12px;
            color: rgba(255,255,255,0.2);
            text-align: center;
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body>

<x-navbar :name="$name" />

<div class="page">
    <div class="card">

        @if(!session('quizDetails'))

            {{-- ── ADD QUIZ FORM ── --}}
            <div class="card-title">
                <span class="title-dot"></span>
                Add quiz
            </div>

            <form action="/add-quiz" method="get">
                <div class="form-group">
                    <input type="text" placeholder="Enter quiz name" name="quiz"
                           required class="form-input">
                </div>
                <div class="form-group">
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 4px;">Create quiz</button>
            </form>

        @else

            {{-- ── QUIZ INFO BAR ── --}}
            <div class="quiz-info">
                <span class="quiz-info-name">
                    <span class="quiz-info-name-dot"></span>
                    {{ session('quizDetails')->name }}
                </span>
         
         
         
                <span class="quiz-mcq-count">
                   
                    @if($totalMCQs > 0)
                       <a class="link-show" href="show-quiz/{{ session('quizDetails')->id }}/{{ str_replace(' ', '-', session('quizDetails')->name) }}">View imported MCQs </a>
                   
                    @endif
                </span>
            </div>

            {{-- ── SUCCESS BANNER ── --}}
            @if(session('message-success'))
            <div class="success-banner">
                ✓ {{ session('message-success') }}
            </div>
            @endif

            {{-- ── CSV IMPORT ── --}}
            <div class="csv-section">
                <div class="csv-title">
                    ↑ Import from CSV
                </div>
                <form action="add-mcq" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="csv-row">
                        <input type="file" name="csv_file" accept=".csv" class="csv-input">
                        <button type="submit" class="btn-import">Import</button>
                    </div>
                    <div class="csv-hint">
                        <span>Columns: question, a, b, c, d, correct_ans</span>
                        <a href="data:text/csv;charset=utf-8,question,a,b,c,d,correct_ans%0AWhat is HTML?,Hypertext Markup Language,A programming language,A database,A framework,a%0AWhat does CSS stand for?,Cascading Style Sheets,Computer Style System,Colorful Style Sheets,Creative Sheet System,a"
                           download="sample_mcqs.csv" class="csv-sample">
                            ↓ Sample CSV
                        </a>
                    </div>
                </form>
            </div>

            <div class="divider"></div>

            {{-- ── MANUAL MULTI-MCQ FORM ── --}}
            <div class="card-title" style="margin-bottom: 1rem;">
                <span class="title-dot"></span>
                Add MCQs manually
            </div>

            <form action="add-mcq" method="post" id="mcq-form">
                @csrf

                <div id="mcq-container"></div>

                <button type="button" onclick="addMCQRow()" class="btn-add-row">
                    + Add another MCQ
                </button>

                <div class="mcq-counter" id="mcq-counter">1 MCQ ready to submit</div>

                <div class="divider"></div>

                <button type="submit" name="submit" value="add-more" class="btn btn-add-more">Save & add more</button>
                <button type="submit" name="submit" value="done" class="btn btn-done">Submit all</button>
            </form>

            <a href="/end-quiz" class="btn btn-finish" style="margin-top: 4px;">Finish quiz</a>

        @endif
    </div>
</div>

<script>
let mcqCount = 0;

function createMCQRow(index) {
    const isFirst = index === 0;
    const div = document.createElement('div');
    div.className = 'mcq-row';
    div.id = `mcq-row-${index}`;
    div.innerHTML = `
        <div class="mcq-row-header">
            <span class="mcq-badge" id="badge-${index}">MCQ #${index + 1}</span>
            ${!isFirst ? `<button type="button" class="mcq-remove" onclick="removeMCQRow(${index})">✕ Remove</button>` : ''}
        </div>
        <div class="form-group">
            <textarea placeholder="Enter your question" name="questions[${index}][question]"
                class="form-textarea" rows="2"></textarea>
        </div>
        <div class="options-grid">
            <div>
                <div class="option-label">Option A</div>
                <input type="text" placeholder="First option" name="questions[${index}][a]" class="form-input">
            </div>
            <div>
                <div class="option-label">Option B</div>
                <input type="text" placeholder="Second option" name="questions[${index}][b]" class="form-input">
            </div>
            <div>
                <div class="option-label">Option C</div>
                <input type="text" placeholder="Third option" name="questions[${index}][c]" class="form-input">
            </div>
            <div>
                <div class="option-label">Option D</div>
                <input type="text" placeholder="Fourth option" name="questions[${index}][d]" class="form-input">
            </div>
        </div>
        <div class="form-group">
            <select name="questions[${index}][correct_ans]" class="form-select">
                <option value="">Select correct answer</option>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>
    `;
    return div;
}

function addMCQRow() {
    const container = document.getElementById('mcq-container');
    const row = createMCQRow(mcqCount);
    container.appendChild(row);
    mcqCount++;
    updateCounter();
    if (mcqCount > 1) row.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function removeMCQRow(index) {
    const row = document.getElementById(`mcq-row-${index}`);
    if (row) {
        row.style.opacity = '0';
        row.style.transform = 'translateY(-8px)';
        row.style.transition = 'all 0.15s';
        setTimeout(() => { row.remove(); updateCounter(); }, 150);
    }
}

function updateCounter() {
    const rows = document.querySelectorAll('.mcq-row').length;
    const counter = document.getElementById('mcq-counter');
    counter.textContent = `${rows} MCQ${rows !== 1 ? 's' : ''} ready to submit`;
}

// Start with one row
addMCQRow();
</script>

</body>
</html>