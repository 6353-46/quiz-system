<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate - {{ $data['name'] }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Georgia', serif;
            background-color: #0d1a0e;
            color: #1f2937;
        }
        .certificate-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .certificate-card {
            width: 100%;
            max-width: 900px;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #f0fdf4 100%);
            border: 6px solid #15803d;
            border-radius: 20px;
            box-shadow: 0 0 0 2px #4ade80, 0 24px 60px rgba(0,0,0,0.4);
            padding: 56px 64px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
 
        /* corner ornaments */
        .corner {
            position: absolute;
            width: 80px; height: 80px;
            border: 2.5px solid #16a34a;
        }
        .corner-tl { top: 14px; left: 14px; border-right: none; border-bottom: none; border-radius: 4px 0 0 0; }
        .corner-tr { top: 14px; right: 14px; border-left: none; border-bottom: none; border-radius: 0 4px 0 0; }
        .corner-bl { bottom: 14px; left: 14px; border-right: none; border-top: none; border-radius: 0 0 0 4px; }
        .corner-br { bottom: 14px; right: 14px; border-left: none; border-top: none; border-radius: 0 0 4px 0; }
 
        /* header */
        .cert-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 8px;
        }
        .icon {
            width: 56px; height: 56px;
            fill: #15803d;
            flex-shrink: 0;
        }
        .cert-title {
            font-size: 38px;
            font-weight: 700;
            color: #14532d;
            line-height: 1.1;
        }
 
        /* org name */
        .cert-org {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #16a34a;
            margin-bottom: 28px;
        }
 
        /* divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 auto 24px;
            max-width: 500px;
        }
        .divider-line { flex: 1; height: 1px; background: #16a34a; opacity: 0.3; }
        .divider-dot { width: 5px; height: 5px; border-radius: 50%; background: #16a34a; }
 
        /* body text */
        .cert-subtitle {
            font-size: 16px;
            color: #374151;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .cert-name {
            font-size: 46px;
            font-weight: 700;
            color: #14532d;
            margin: 10px 0 20px;
            line-height: 1.1;
        }
        .cert-text {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 6px;
        }
        .cert-quiz {
            font-size: 26px;
            font-weight: 700;
            color: #14532d;
            margin: 8px 0 24px;
        }
 
        /* score badge */
        .score-badge {
            display: inline-block;
            background: #14532d;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 30px;
            margin-bottom: 28px;
            letter-spacing: 0.5px;
        }
 
        /* footer */
        .cert-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 8px;
            padding-top: 20px;
            border-top: 1px solid rgba(22,163,74,0.2);
        }
        .footer-item { text-align: center; }
        .footer-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .footer-value {
            font-size: 15px;
            font-weight: 600;
            color: #14532d;
            border-top: 1.5px solid #16a34a;
            padding-top: 6px;
            min-width: 140px;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-card">
 
            <!-- Corner ornaments -->
            <div class="corner corner-tl"></div>
            <div class="corner corner-tr"></div>
            <div class="corner corner-bl"></div>
            <div class="corner corner-br"></div>
 
            <!-- Header -->
            <div class="cert-header">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                    <path d="m385-412 36-115-95-74h116l38-119 37 119h117l-95 74 35 115-94-71-95 71ZM244-40v-304q-45-47-64.5-103T160-560q0-136 92-228t228-92q136 0 228 92t92 228q0 57-19.5 113T716-344v304l-236-79-236 79Zm236-260q109 0 184.5-75.5T740-560q0-109-75.5-184.5T480-820q-109 0-184.5 75.5T220-560q0 109 75.5 184.5T480-300ZM304-124l176-55 176 55v-171q-40 29-86 42t-90 13q-44 0-90-13t-86-42v171Zm176-86Z"/>
                </svg>
                <h1 class="cert-title">Certificate of Completion</h1>
            </div>
 
            <p class="cert-org">QuizSystem &nbsp;•&nbsp; Official Certificate</p>
 
            <!-- Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-dot"></div>
                <div class="divider-line"></div>
            </div>
 
            <p class="cert-subtitle">This is to certify that</p>
            <h2 class="cert-name">{{ $data['name'] }}</h2>
 
            <p class="cert-text">has successfully completed the quiz</p>
            <h3 class="cert-quiz">{{ $data['quiz'] }}</h3>
 
            <div class="score-badge">
                Score: {{ $data['score'] }} / {{ $data['total'] }} &nbsp;({{ $data['percentage'] }}%)
            </div>
 
            <!-- Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-dot"></div>
                <div class="divider-line"></div>
            </div>
 
            <!-- Footer -->
            <div class="cert-footer">
                <div class="footer-item">
                    <p class="footer-label">Date Issued</p>
                    <p class="footer-value">{{ date('d-m-Y') }}</p>
                </div>
                <div class="footer-item">
                    <p class="footer-label">Authorized by</p>
                    <p class="footer-value">QuizSystem</p>
                </div>
                <div class="footer-item">
                    <p class="footer-label">Status</p>
                    <p class="footer-value">Completed ✓</p>
                </div>
            </div>
 
        </div>
    </div>
</body>
</html>
 