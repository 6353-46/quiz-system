<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - Quiz System</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
            padding: 2.5rem 1.5rem 5rem;
        }
 
        /* ── TOP BAR ── */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 820px;
            margin: 0 auto 2rem;
        }
        .top-link {
            font-size: 14px; font-weight: 500;
            color: #4ade80;
            text-decoration: none;
            display: flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            border: 0.5px solid rgba(34,197,94,0.25);
            border-radius: 8px;
            background: rgba(34,197,94,0.06);
            transition: background 0.2s;
        }
        .top-link:hover { background: rgba(34,197,94,0.12); }
 
        /* ── CERTIFICATE CARD ── */
        .cert-wrap {
            max-width: 820px;
            margin: 0 auto;
            background: linear-gradient(135deg, #0f1f10 0%, #0d1a0e 100%);
            border: 2px solid #16a34a;
            border-radius: 20px;
            padding: 3.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
 
        /* corner decorations */
        .cert-wrap::before,
        .cert-wrap::after {
            content: '';
            position: absolute;
            width: 120px; height: 120px;
            border: 2px solid rgba(34,197,94,0.2);
            border-radius: 4px;
        }
        .cert-wrap::before { top: 12px; left: 12px; border-right: none; border-bottom: none; }
        .cert-wrap::after  { bottom: 12px; right: 12px; border-left: none; border-top: none; }
 
        /* inner border */
        .cert-inner {
            border: 0.5px solid rgba(34,197,94,0.15);
            border-radius: 12px;
            padding: 2.5rem;
        }
 
        /* ── BADGE ── */
        .badge-wrap {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(34,197,94,0.1);
            border: 1.5px solid rgba(34,197,94,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
        }
 
        /* ── TITLE ── */
        .cert-heading {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: rgba(255,255,255,0.35);
            margin-bottom: 0.5rem;
        }
        .cert-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem; font-weight: 700;
            color: #fff;
            margin-bottom: 0.4rem;
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .cert-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.35);
            margin-bottom: 2.5rem;
        }
 
        /* ── DIVIDER ── */
        .divider {
            display: flex; align-items: center; gap: 16px;
            margin: 0 auto 2rem;
            max-width: 400px;
        }
        .divider-line {
            flex: 1; height: 0.5px;
            background: rgba(34,197,94,0.25);
        }
        .divider-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #4ade80;
        }
 
        /* ── CONTENT ── */
        .cert-presented {
            font-size: 14px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .cert-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem; font-weight: 700;
            color: #4ade80;
            margin-bottom: 1.25rem;
            line-height: 1.1;
        }
        .cert-completed {
            font-size: 15px;
            color: rgba(255,255,255,0.45);
            margin-bottom: 0.6rem;
        }
        .cert-quiz {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem; font-weight: 700;
            color: #fff;
            margin-bottom: 2.5rem;
        }
 
        /* ── FOOTER ── */
        .cert-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 1rem;
            padding-top: 1.5rem;
            border-top: 0.5px solid rgba(255,255,255,0.07);
        }
        .cert-date {
            text-align: left;
        }
        .cert-date-label {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 4px;
        }
        .cert-date-val {
            font-family: 'Syne', sans-serif;
            font-size: 14px; font-weight: 600;
            color: rgba(255,255,255,0.7);
        }
        .cert-seal {
            text-align: right;
        }
        .cert-seal-label {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 4px;
        }
        .cert-seal-name {
            font-family: 'Playfair Display', serif;
            font-size: 16px; font-weight: 700;
            color: #4ade80;
        }
    </style>
</head>
<body>
 
    <!-- TOP BAR -->
    <div class="top-bar">
        <a class="top-link" href="/">← Back</a>
        <a class="top-link" href="/download-certificate">⬇ Download</a>
    </div>
 
    <!-- CERTIFICATE -->
    <div class="cert-wrap">
        <div class="cert-inner">
 
            <!-- Badge -->
            <div class="badge-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#4ade80">
                    <path d="m385-412 36-115-95-74h116l38-119 37 119h117l-95 74 35 115-94-71-95 71ZM244-40v-304q-45-47-64.5-103T160-560q0-136 92-228t228-92q136 0 228 92t92 228q0 57-19.5 113T716-344v304l-236-79-236 79Zm236-260q109 0 184.5-75.5T740-560q0-109-75.5-184.5T480-820q-109 0-184.5 75.5T220-560q0 109 75.5 184.5T480-300ZM304-124l176-55 176 55v-171q-40 29-86 42t-90 13q-44 0-90-13t-86-42v171Zm176-86Z"/>
                </svg>
            </div>
 
            <!-- Heading -->
            <p class="cert-heading">QuizSystem</p>
            <h1 class="cert-title">Certificate of Completion</h1>
            <p class="cert-subtitle">This is to proudly certify that</p>
 
            <!-- Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-dot"></div>
                <div class="divider-line"></div>
            </div>
 
            <!-- Name -->
            <p class="cert-presented">Presented to</p>
            <h2 class="cert-name">{{ $data['name'] }}</h2>
 
            <!-- Quiz -->
            <p class="cert-completed">has successfully completed the</p>
            <h3 class="cert-quiz">{{ $data['quiz'] }}</h3>
 
            <!-- Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-dot"></div>
                <div class="divider-line"></div>
            </div>
 
            <!-- Footer -->
            <div class="cert-footer">
                <div class="cert-date">
                    <p class="cert-date-label">Date Issued</p>
                    <p class="cert-date-val">{{ date('d-m-Y') }}</p>
                </div>
                <div class="cert-seal">
                    <p class="cert-seal-label">Authorized by</p>
                    <p class="cert-seal-name">QuizSystem</p>
                </div>
            </div>
 
        </div>
    </div>
 
</body>
</html>