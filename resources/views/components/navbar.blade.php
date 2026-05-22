
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
    .qs-nav {
        font-family: 'DM Sans', sans-serif;
        background: #0f0f13;
        border-bottom: 0.5px solid rgba(255,255,255,0.07);
        padding: 0 1.5rem;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .qs-brand {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 17px;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .qs-brand-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #e94560;
        flex-shrink: 0;
    }

    .qs-links {
        display: flex;
        align-items: center;
        gap: 2px;
    }
    .qs-link {
        font-size: 13px;
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        padding: 5px 11px;
        border-radius: 7px;
        border: 0.5px solid transparent;
        transition: all 0.15s;
    }
    .qs-link:hover {
        color: rgba(255,255,255,0.85);
        background: rgba(255,255,255,0.06);
    }
    .qs-link.active {
        color: #fff;
        background: rgba(233,69,96,0.15);
        border-color: rgba(233,69,96,0.3);
    }

    .qs-sep {
        width: 1px;
        height: 16px;
        background: rgba(255,255,255,0.09);
        margin: 0 6px;
    }

    .qs-welcome {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: rgba(255,255,255,0.55);
        padding: 4px 10px;
        border-radius: 7px;
        text-decoration: none;
        transition: all 0.15s;
    }
    .qs-welcome:hover {
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.8);
    }
    .qs-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #3C3489;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 500;
        color: #CECBF6;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .qs-logout {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        text-decoration: none;
        padding: 5px 11px;
        border-radius: 7px;
        border: 0.5px solid rgba(255,255,255,0.09);
        transition: all 0.15s;
    }
    .qs-logout:hover {
        background: rgba(220,38,38,0.12);
        border-color: rgba(220,38,38,0.3);
        color: #fca5a5;
    }

    .qs-badge {
        font-size: 11px;
        color: #EF9F27;
        padding: 3px 9px 3px 7px;
        border-radius: 20px;
        border: 0.5px solid rgba(239,159,39,0.3);
        background: rgba(239,159,39,0.08);
        margin-left: 4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .qs-badge-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #EF9F27;
        flex-shrink: 0;
    }
</style>

<nav class="qs-nav">
    {{-- Brand --}}
    <a class="qs-brand" href="/dashboard">
        <span class="qs-brand-dot"></span>
        QuizSystem
    </a>

    {{-- Links --}}
    <div class="qs-links">
        <a class="qs-link" href="/dashboard">Dashboard</a>
        <a class="qs-link" href="/expert-categories">Categories</a>
        <a class="qs-link" href="/add-quiz">Quiz</a>

        <div class="qs-sep"></div>

        <a class="qs-welcome" href="/expert/dashboard">
            <span class="qs-avatar">{{ substr($name, 0, 1) }}</span>
            {{ $name }}
        </a>

        <a class="qs-logout" href="/expert-logout">Logout</a>

        <span class="qs-badge">
            <span class="qs-badge-dot"></span>
            Expert
        </span>
    </div>
</nav>