<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Quiz System</title>
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

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(15,15,30,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 0.5px solid rgba(255,255,255,0.07);
            padding: 0 2rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-logo {
            display: flex; align-items: center; gap: 8px;
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 16px;
            color: #fff; text-decoration: none;
        }
        .nav-logo-dot { width: 10px; height: 10px; border-radius: 50%; background: #e94560; }
        .nav-links { display: flex; align-items: center; gap: 6px; }
        .nav-link {
            font-size: 14px; color: rgba(255,255,255,0.6); text-decoration: none;
            padding: 6px 14px; border-radius: 8px; transition: color 0.2s, background 0.2s;
        }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,0.06); }
        .nav-divider { width: 1px; height: 18px; background: rgba(255,255,255,0.12); margin: 0 4px; }
        .btn-signup {
            font-size: 14px; font-weight: 500; padding: 7px 18px; border-radius: 9px;
            background: #e94560; color: #fff; border: none; cursor: pointer;
            text-decoration: none; transition: opacity 0.18s;
        }
        .btn-signup:hover { opacity: 0.88; }
        .btn-expert {
            font-size: 13px; font-weight: 500; padding: 6px 14px; border-radius: 9px;
            background: rgba(234,179,8,0.12); color: #fbbf24;
            border: 0.5px solid rgba(234,179,8,0.25); cursor: pointer;
            text-decoration: none; display: flex; align-items: center; gap: 5px;
            transition: background 0.2s;
        }
        .btn-expert:hover { background: rgba(234,179,8,0.2); }

        /* ── HERO ── */
        .hero {
            padding: 5rem 1.5rem 4rem;
            text-align: center;
            border-bottom: 0.5px solid rgba(255,255,255,0.06);
        }
        .hero h1 {
            font-family: 'Syne', sans-serif;
            font-size: 3rem; font-weight: 700;
            color: #fff; margin-bottom: 1rem;
        }
        .hero h1 span {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            font-size: 1.1rem; color: rgba(255,255,255,0.45);
            margin-bottom: 2rem; max-width: 560px;
            margin-left: auto; margin-right: auto;
        }
        .hero-btn {
            display: inline-block; font-weight: 600; padding: 12px 32px;
            border-radius: 10px; background: #16a34a; color: #fff;
            text-decoration: none; font-size: 15px;
            transition: background 0.2s, transform 0.15s;
        }
        .hero-btn:hover { background: #15803d; transform: translateY(-1px); }

        /* ── SHARED ── */
        .section { padding: 4rem 2rem; }
        .section-alt { padding: 4rem 2rem; background: rgba(255,255,255,0.02); }
        .container { max-width: 1100px; margin: 0 auto; }
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem; font-weight: 700;
            color: #fff; text-align: center; margin-bottom: 2.5rem;
        }

        /* ── MISSION ── */
        .mission-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 3rem; align-items: center;
        }
        @media(max-width:700px){ .mission-grid { grid-template-columns: 1fr; } }
        .mission-text h2 {
            font-family: 'Syne', sans-serif; font-size: 2rem; font-weight: 700;
            color: #fff; margin-bottom: 1.25rem; text-align: center;
        }
        .mission-text p {
            color: rgba(255,255,255,0.55); font-size: 15px;
            line-height: 1.75; text-align: center; margin-bottom: 0.85rem;
        }
        .mission-card {
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 3rem;
            display: flex; align-items: center; justify-content: center;
        }
        .icon-circle-lg {
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.2);
            border-radius: 50%; width: 8rem; height: 8rem;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── FEATURE CARDS ── */
        .feature-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;
        }
        @media(max-width:800px){ .feature-grid { grid-template-columns: 1fr; } }
        .feature-card {
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.08);
            border-radius: 14px; padding: 2rem; text-align: center;
            transition: background 0.2s, transform 0.2s, border-color 0.2s;
            cursor: default;
        }
        .feature-card:hover {
            background: rgba(255,255,255,0.07);
            border-color: rgba(34,197,94,0.25);
            transform: translateY(-6px);
        }
        .icon-circle-sm {
            background: rgba(34,197,94,0.12);
            border: 0.5px solid rgba(34,197,94,0.2);
            border-radius: 50%; width: 56px; height: 56px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
        }
        .feature-card h3 {
            font-family: 'Syne', sans-serif; font-size: 1.1rem;
            font-weight: 700; color: #fff; margin-bottom: 0.6rem;
        }
        .feature-card p { color: rgba(255,255,255,0.5); font-size: 14px; line-height: 1.65; }

        /* ── STATS ── */
        .stats-section {
            background: linear-gradient(135deg, rgba(22,163,74,0.18), rgba(22,163,74,0.06));
            border-top: 0.5px solid rgba(34,197,94,0.15);
            border-bottom: 0.5px solid rgba(34,197,94,0.15);
            padding: 4rem 2rem;
        }
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 2rem; text-align: center;
        }
        @media(max-width:700px){ .stats-grid { grid-template-columns: repeat(2,1fr); } }
        .stat-num {
            font-family: 'Syne', sans-serif; font-size: 3rem;
            font-weight: 700; color: #4ade80; margin-bottom: 0.4rem;
        }
        .stat-label { color: rgba(255,255,255,0.5); font-size: 1rem; }

        /* ── HOW IT WORKS ── */
        .steps-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; text-align: center;
        }
        @media(max-width:800px){ .steps-grid { grid-template-columns: repeat(2,1fr); } }
        .step-num {
            background: #16a34a; color: #fff; border-radius: 50%;
            width: 64px; height: 64px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 700;
            margin: 0 auto 1rem;
        }
        .step h3 {
            font-family: 'Syne', sans-serif; font-size: 1rem;
            font-weight: 700; color: #fff; margin-bottom: 0.5rem;
        }
        .step p { color: rgba(255,255,255,0.5); font-size: 14px; line-height: 1.6; }

        /* ── CTA ── */
        .cta-wrap { padding: 0 2rem 4rem; }
        .cta-section {
            background: linear-gradient(135deg, rgba(22,163,74,0.2), rgba(22,163,74,0.06));
            border: 0.5px solid rgba(34,197,94,0.18);
            border-radius: 16px; padding: 3.5rem 2rem; text-align: center;
        }
        .cta-section h2 {
            font-family: 'Syne', sans-serif; font-size: 2rem;
            font-weight: 700; color: #fff; margin-bottom: 0.85rem;
        }
        .cta-section p { color: rgba(255,255,255,0.5); font-size: 1rem; margin-bottom: 2rem; }
        .cta-btn {
            display: inline-block; background: #16a34a; color: #fff;
            font-weight: 600; padding: 12px 32px; border-radius: 10px;
            font-size: 15px; text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }
        .cta-btn:hover { background: #15803d; transform: translateY(-1px); }

        /* ── FOOTER ── */
        .footer {
            background: rgba(0,0,0,0.3);
            color: rgba(255,255,255,0.25);
            text-align: center; padding: 1.5rem;
            font-size: 13px;
            border-top: 0.5px solid rgba(255,255,255,0.06);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
   <x-user-navbar></x-user-navbar>

<!-- HERO -->
<div class="hero">
    <h1>About Our <span>Quiz System</span></h1>
    <p>Empowering learners worldwide with engaging quizzes and comprehensive analytics</p>
    <a href="/" class="hero-btn">Explore Quizzes</a>
</div>

<!-- MISSION -->
<div class="section">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-text">
                <h2>Our Mission</h2>
                <p>We believe that education should be accessible, engaging, and effective for everyone. Our quiz system is designed to make learning fun and interactive.</p>
                <p>Whether you're a student preparing for exams or a professional looking to expand your knowledge, our platform provides the tools you need to succeed.</p>
                <p>With our user-friendly interface and comprehensive question database, learning has never been easier.</p>
            </div>
            <div class="mission-card">
                <div class="icon-circle-lg">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WHY CHOOSE US -->
<div class="section-alt">
    <div class="container">
        <h2 class="section-title">Why Choose Us?</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="icon-circle-sm">
                    <svg width="26" height="26" viewBox="0 0 20 20" fill="#4ade80">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2 4 4 0 00-4 4v10a4 4 0 004 4h12a4 4 0 004-4V5a4 4 0 00-4-4 1 1 0 000 2 2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3>Diverse Content</h3>
                <p>Access thousands of questions across multiple categories and difficulty levels</p>
            </div>
            <div class="feature-card">
                <div class="icon-circle-sm">
                    <svg width="26" height="26" viewBox="0 0 20 20" fill="#4ade80">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                </div>
                <h3>Detailed Analytics</h3>
                <p>Track your progress with comprehensive performance reports and insights</p>
            </div>
            <div class="feature-card">
                <div class="icon-circle-sm">
                    <svg width="26" height="26" viewBox="0 0 20 20" fill="#4ade80">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                </div>
                <h3>Community</h3>
                <p>Connect with learners worldwide and compete on leaderboards</p>
            </div>
        </div>
    </div>
</div>

<!-- STATS -->
<div class="stats-section">
    
    <div class="container">
        <h2 class="section-title">By The Numbers</h2>
        
        <div class="stats-grid">
            <div>
                <div class="stat-num">{{ $question }}</div>
                <p class="stat-label">Questions</p>
            </div>
            <div>
                <div class="stat-num">{{ $category }}</div>
                <p class="stat-label">Categories</p>
            </div>
            <div>
                <div class="stat-num">{{ $userCount }}</div>
                <p class="stat-label">Users</p>
            </div>
            <div>
                <div class="stat-num">100%</div>
                <p class="stat-label">Free Access</p>
            </div>
        </div>
    </div>
</div>

<!-- HOW IT WORKS -->
<div class="section">
    <div class="container">
        <h2 class="section-title">How It Works</h2>
        <div class="steps-grid">
            <div class="step">
                <a href="user-signup" class="step-link" style="text-decoration:none;">
                    <div class="step-num">1</div>
                    <h3>Sign Up</h3>
                    <p>Create your free account in seconds</p>
                </a>
            </div>
            <div class="step">
                <a href="categories-list" class="step-link" style="text-decoration:none;">

                    <div class="step-num">2</div>
                    <h3>Choose Category</h3>
                    <p>Select from multiple quiz categories</p>
                </a>
            </div>
            <div class="step">
                <a href="/" class="step-link" style="text-decoration:none;">
                    <div class="step-num">3</div>
                    <h3>Take Quiz</h3>
                    <p>Answer engaging questions with instant feedback</p>
                </a>    
            </div>
            <div class="step">
                <div class="step-num">4</div>
                <h3>Get Results</h3>
                <p>Receive certificates and performance analytics</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-wrap">
    <div class="container">
        <div class="cta-section">
            <h2>Ready to Test Your Knowledge?</h2>
            <p>Join thousands of learners taking quizzes and improving their skills</p>
            <a href="/" class="cta-btn">Get Started Now</a>
        </div>
    </div>
</div>

<!-- FOOTER -->
<x-footer-user></x-footer-user>

</body>
</html>
