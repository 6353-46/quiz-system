<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    .qs-footer {
        font-family: 'DM Sans', sans-serif;
        background: rgba(255,255,255,0.03);
        border-top: 0.5px solid rgba(255,255,255,0.08);
        padding: 2rem 1.5rem;
        text-align: center;
    }

    .qs-footer-brand {
        font-family: 'Syne', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 0.75rem;
    }

    .qs-footer-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e94560, #f97316);
        display: inline-block;
        box-shadow: 0 0 8px rgba(233,69,96,0.5);
    }

    .qs-footer-links {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        margin-bottom: 1rem;
    }

    .qs-footer-link {
        font-size: 13px;
        color: rgba(255,255,255,0.4);
        text-decoration: none;
        padding: 5px 12px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .qs-footer-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.07);
    }

    .qs-footer-sep {
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
    }

    .qs-footer-copy {
        font-size: 12px;
        color: rgba(255,255,255,0.2);
    }

    .qs-footer-copy span {
        color: #e94560;
    }
</style>

<footer class="qs-footer">
    <div class="qs-footer-brand">
        <span class="qs-footer-dot"></span>
        QuizSystem
    </div>

    <div class="qs-footer-links">
        <a class="qs-footer-link" href="/">Home</a>
        <div class="qs-footer-sep"></div>
        <a class="qs-footer-link" href="about">About</a>
        <div class="qs-footer-sep"></div>
        <a class="qs-footer-link" href="contact">Contact</a>
    </div>

    <p class="qs-footer-copy">&copy; 2026 QuizSystem. Made with <span>♥</span> All Rights Reserved.</p>
</footer>