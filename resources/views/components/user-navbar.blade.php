<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
 
<style>
    .qs-nav {
        font-family: 'DM Sans', sans-serif;
        background: rgba(255,255,255,0.04);
        border-bottom: 0.5px solid rgba(255,255,255,0.08);
        padding: 0 2rem;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 999;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
 
    /* Brand */
    .qs-brand {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: 0.3px;
    }
    .qs-brand-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e94560, #f97316);
        display: inline-block;
        box-shadow: 0 0 8px rgba(233,69,96,0.6);
    }
 
    /* Nav links */
    .qs-links {
        display: flex;
        align-items: center;
        gap: 2px;
    }
    .qs-link {
        font-size: 13.5px;
        color: rgba(255,255,255,0.55);
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 8px;
        transition: all 0.2s;
        border: 0.5px solid transparent;
    }
    .qs-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.06);
    }
    .qs-link.active {
        color: #fff;
        background: rgba(233,69,96,0.18);
        border-color: rgba(233,69,96,0.3);
    }
 
    /* Separator */
    .qs-sep {
        width: 1px;
        height: 18px;
        background: rgba(255,255,255,0.1);
        margin: 0 6px;
    }
 
    /* Welcome chip */
    .qs-welcome {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: rgba(255,255,255,0.55);
        padding: 5px 12px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .qs-welcome:hover {
        color: #fff;
        background: rgba(255,255,255,0.07);
    }
    .qs-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e94560, #c2185b);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
        flex-shrink: 0;
    }
 
    /* Logout btn */
    .qs-logout {
        font-size: 13px;
        color: rgba(255,255,255,0.45);
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 8px;
        border: 0.5px solid rgba(255,255,255,0.1);
        transition: all 0.2s;
    }
    .qs-logout:hover {
        background: rgba(239,68,68,0.15);
        border-color: rgba(239,68,68,0.35);
        color: #fca5a5;
    }
 
    /* Expert badge */
    .qs-expert {
        font-size: 12px;
        color: #fbbf24;
        text-decoration: none;
        padding: 4px 10px;
        border-radius: 20px;
        border: 0.5px solid rgba(251,191,36,0.3);
        background: rgba(251,191,36,0.08);
        transition: all 0.2s;
        margin-left: 4px;
    }
    .qs-expert:hover {
        background: rgba(251,191,36,0.18);
        color: #fde68a;
    }
</style>
 
<nav class="qs-nav">
    {{-- Brand --}}
    <a class="qs-brand" href="/">
        <span class="qs-brand-dot"></span>
        QuizSystem
    </a>
 
    {{-- Links --}}
    <div class="qs-links">
        <a class="qs-link" href="/">Home</a>
        <a class="qs-link" href="/categories-list">Categories</a>
 
        @if(session('user'))
            <div class="qs-sep"></div>
            <a class="qs-welcome" href="/user-details">
                <span class="qs-avatar">{{ substr(session('user')->name, 0, 1) }}</span>
                {{ session('user')->name }}
            </a>
            <a class="qs-logout" href="/user-logout">Logout</a>
        @else
            <div class="qs-sep"></div>
            <a class="qs-link" href="/user-login">Login</a>
            <a class="qs-link active" href="/user-signup">Signup</a>
        @endif
 
        <a class="qs-expert" href="/expert-login">⚡ Expert</a>
    </div>
</nav>