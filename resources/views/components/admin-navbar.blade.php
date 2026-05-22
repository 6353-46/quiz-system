<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
    .an-nav {
        font-family: 'DM Sans', sans-serif;
        background: rgba(255,255,255,0.03);
        border-bottom: 0.5px solid rgba(255,255,255,0.07);
        padding: 0 1.75rem;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .an-brand {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 17px;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .an-brand-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #e94560;
        flex-shrink: 0;
    }

    .an-links {
        display: flex;
        align-items: center;
        gap: 2px;
    }
    .an-link {
        font-size: 13px;
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        padding: 5px 11px;
        border-radius: 7px;
        border: 0.5px solid transparent;
        transition: all 0.15s;
    }
    .an-link:hover {
        color: rgba(255,255,255,0.85);
        background: rgba(255,255,255,0.06);
    }
    .an-link.active {
        color: #fff;
        background: rgba(233,69,96,0.15);
        border-color: rgba(233,69,96,0.3);
    }

    .an-sep {
        width: 1px; height: 16px;
        background: rgba(255,255,255,0.09);
        margin: 0 6px;
    }

    .an-badge-admin {
        font-size: 11px;
        color: #e94560;
        padding: 3px 9px 3px 7px;
        border-radius: 20px;
        border: 0.5px solid rgba(233,69,96,0.3);
        background: rgba(233,69,96,0.08);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .an-badge-dot {
        width: 5px; height: 5px;
        border-radius: 50%;
        background: #e94560;
        flex-shrink: 0;
    }

    .an-welcome {
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
    .an-welcome:hover {
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.8);
    }
    .an-avatar {
        width: 26px; height: 26px;
        border-radius: 50%;
        background: rgba(233,69,96,0.2);
        border: 0.5px solid rgba(233,69,96,0.35);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 500;
        color: #e94560;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .an-logout {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        text-decoration: none;
        padding: 5px 11px;
        border-radius: 7px;
        border: 0.5px solid rgba(255,255,255,0.09);
        transition: all 0.15s;
    }
    .an-logout:hover {
        background: rgba(220,38,38,0.12);
        border-color: rgba(220,38,38,0.3);
        color: #fca5a5;
    }
</style>

<nav class="an-nav">
    <a class="an-brand" href="/admin-dashboard">
        <span class="an-brand-dot"></span>
        QuizSystem
        <span class="an-badge-admin">
            <span class="an-badge-dot"></span>
            Admin
        </span>
    </a>

    <div class="an-links">
        <a class="an-link" href="/admin-dashboard">Dashboard</a>
        <a class="an-link" href="/admin-users">Users</a>
        <a class="an-link" href="/admin-experts">Experts</a>
        <a class="an-link" href="/admin-add-expert">Add expert</a>

        <div class="an-sep"></div>

        <span class="an-welcome">
            <span class="an-avatar">{{ substr($name, 0, 1) }}</span>
            {{ $name }}
        </span>

        <a class="an-logout" href="/admin-logout">Logout</a>
    </div>
</nav>