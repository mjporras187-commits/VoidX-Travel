<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VOIDX | Elite Travel Selection</title>
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300;1,700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
 
    <style>
    /* ════════════════════════════════════
       TOKENS
    ════════════════════════════════════ */
    :root {
        --gold:      #c9a84c;
        --gold-dim:  rgba(201,168,76,0.12);
        --dark:      #06080d;
        --border:    rgba(201,168,76,0.12);
        --muted:     #52525b;
    }
 
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
    html { scroll-behavior: smooth; }
 
    body {
        background: var(--dark);
        color: #e4e4e7;
        font-family: 'Space Mono', monospace;
        min-height: 100vh;
        overflow-x: hidden;
    }
 
    /* ════════════════════════════════════
       CINEMATIC BACKGROUND
    ════════════════════════════════════ */
    .cin-bg {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        overflow: hidden;
    }
    .cin-bg::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 80% 70% at 10% 15%, rgba(201,168,76,0.08) 0%, transparent 55%),
            radial-gradient(ellipse 70% 80% at 90% 85%, rgba(20,50,130,0.12) 0%, transparent 55%),
            linear-gradient(160deg, #060810 0%, #080c16 45%, #060a0f 100%);
    }
    .cin-bg::after {
        content: '';
        position: absolute;
        width: 800px; height: 800px;
        top: -200px; right: -200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,168,76,0.07) 0%, transparent 65%);
        animation: orb1 16s ease-in-out infinite alternate;
    }
    @keyframes orb1 {
        from { transform: scale(1) translate(0,0); }
        to   { transform: scale(1.15) translate(-40px, 60px); }
    }
    .cin-orb2 {
        position: fixed; pointer-events: none; z-index: 0;
        width: 600px; height: 600px;
        bottom: -150px; left: -150px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(20,60,150,0.08) 0%, transparent 65%);
        animation: orb2 20s ease-in-out infinite alternate;
    }
    @keyframes orb2 {
        from { transform: scale(1); }
        to   { transform: scale(1.2) translate(30px,-30px); }
    }
    .grid-overlay {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background-image:
            linear-gradient(rgba(201,168,76,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(201,168,76,0.025) 1px, transparent 1px);
        background-size: 60px 60px;
    }
    .scanlines {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background: repeating-linear-gradient(
            0deg, transparent, transparent 2px,
            rgba(0,0,0,0.07) 2px, rgba(0,0,0,0.07) 4px
        );
    }
    .page-wrap { position: relative; z-index: 1; min-height: 100vh; display: flex; flex-direction: column; }
 
    /* ════════════════════════════════════
       NAVBAR
    ════════════════════════════════════ */
    .vx-nav {
        padding: 22px 0;
        position: relative; z-index: 10;
        border-bottom: 1px solid rgba(201,168,76,0.06);
    }
    .vx-nav-inner {
        max-width: 1280px; margin: 0 auto;
        padding: 0 32px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .vx-brand {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.7rem; font-weight: 700;
        color: var(--gold);
        letter-spacing: 6px;
        font-style: italic;
        text-decoration: none;
    }
    .vx-brand span { color: #e4e4e7; font-style: normal; }
 
    .nav-links { display: flex; align-items: center; gap: 20px; }
 
    .nav-link {
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.3em; text-transform: uppercase;
        color: var(--muted); text-decoration: none;
        transition: color 0.3s ease;
    }
    .nav-link:hover { color: var(--gold); }
 
    .nav-btn {
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.3em; text-transform: uppercase;
        color: var(--gold); text-decoration: none;
        border: 1px solid rgba(201,168,76,0.3);
        padding: 9px 22px; border-radius: 50px;
        background: var(--gold-dim);
        transition: all 0.3s ease;
        position: relative; overflow: hidden;
    }
    .nav-btn::after {
        content: '';
        position: absolute; inset: 0;
        background: var(--gold);
        transform: translateY(105%);
        transition: transform 0.3s cubic-bezier(0.16,1,0.3,1);
    }
    .nav-btn:hover::after { transform: translateY(0); }
    .nav-btn:hover { color: black; border-color: var(--gold); }
    .nav-btn span { position: relative; z-index: 1; }
 
    /* ════════════════════════════════════
       HERO
    ════════════════════════════════════ */
    .hero-section {
        flex: 1;
        display: flex; align-items: center;
        padding: 60px 32px 60px;
        max-width: 1280px; margin: 0 auto; width: 100%;
    }
 
    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
        width: 100%;
    }
    @media (max-width: 900px) {
        .hero-grid { grid-template-columns: 1fr; gap: 48px; }
        .hero-right { display: none; }
    }
 
    /* LEFT */
    .hero-eyebrow {
        font-size: 9px; letter-spacing: 0.5em;
        color: var(--muted); text-transform: uppercase;
        margin-bottom: 16px;
        display: flex; align-items: center; gap: 10px;
    }
    .rule { display: inline-block; width: 28px; height: 1px; background: var(--gold); }
 
    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(4rem, 8vw, 7rem);
        font-weight: 300;
        line-height: 0.92;
        letter-spacing: -0.02em;
        color: white;
        margin-bottom: 28px;
    }
    .hero-title .line2 {
        color: var(--gold);
        font-weight: 700;
        font-style: italic;
        display: block;
    }
 
    .hero-desc {
        font-size: 11px; line-height: 2;
        color: #71717a;
        max-width: 400px;
        margin-bottom: 40px;
        border-left: 1px solid rgba(201,168,76,0.2);
        padding-left: 20px;
    }
 
    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }
 
    .btn-primary {
        font-family: 'Space Mono', monospace;
        font-size: 10px; font-weight: 700;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: black; background: var(--gold);
        border: none; padding: 16px 36px;
        border-radius: 12px; cursor: pointer;
        text-decoration: none;
        position: relative; overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
        display: inline-block;
    }
    .btn-primary::after {
        content: '';
        position: absolute; inset: 0;
        background: white;
        transform: translateY(105%);
        transition: transform 0.35s cubic-bezier(0.16,1,0.3,1);
    }
    .btn-primary:hover::after { transform: translateY(0); }
    .btn-primary:hover {
        box-shadow: 0 12px 40px rgba(201,168,76,0.3);
        transform: translateY(-2px);
        color: black;
    }
    .btn-primary:active { transform: scale(0.98); }
    .btn-primary span { position: relative; z-index: 1; }
 
    .btn-ghost {
        font-family: 'Space Mono', monospace;
        font-size: 10px; font-weight: 700;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--muted); background: transparent;
        border: 1px solid rgba(255,255,255,0.08);
        padding: 15px 28px; border-radius: 12px;
        cursor: pointer; text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .btn-ghost:hover { color: white; border-color: rgba(255,255,255,0.2); }
 
    /* Stats row */
    .hero-stats {
        display: flex; gap: 32px; margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid rgba(201,168,76,0.08);
    }
    .stat-item {}
    .stat-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem; font-weight: 700;
        color: var(--gold); line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 8px; letter-spacing: 0.25em;
        color: var(--muted); text-transform: uppercase;
    }
 
    /* RIGHT */
    .hero-right { position: relative; }
 
    .card-stack { position: relative; }
 
    /* Main glass card */
    .glass-feature-card {
        background: rgba(10,13,20,0.85);
        backdrop-filter: blur(20px) saturate(1.4);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 36px;
        position: relative;
        overflow: hidden;
    }
    .glass-feature-card::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(201,168,76,0.05) 0%, transparent 60%);
        pointer-events: none;
    }
    .corner-deco {
        position: absolute; width: 36px; height: 36px;
        border-color: rgba(201,168,76,0.25); border-style: solid;
    }
    .corner-deco.tl { top: 16px; left: 16px; border-width: 1px 0 0 1px; }
    .corner-deco.br { bottom: 16px; right: 16px; border-width: 0 1px 1px 0; }
 
    .feature-row {
        display: flex; align-items: center; gap: 16px;
        padding: 16px;
        background: rgba(0,0,0,0.3);
        border: 1px solid rgba(255,255,255,0.04);
        border-radius: 14px;
        margin-bottom: 14px;
        transition: border-color 0.3s ease;
    }
    .feature-row:hover { border-color: rgba(201,168,76,0.15); }
    .feature-icon {
        width: 44px; height: 44px;
        background: rgba(201,168,76,0.08);
        border: 1px solid rgba(201,168,76,0.15);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold); font-size: 18px;
        flex-shrink: 0;
    }
    .feature-label {
        font-size: 11px; font-weight: 700;
        color: white; margin-bottom: 2px;
    }
    .feature-sub { font-size: 9px; color: var(--muted); letter-spacing: 0.1em; }
 
    .quote-block {
        margin: 20px 0;
        padding: 20px 0;
        border-top: 1px solid rgba(201,168,76,0.08);
        border-bottom: 1px solid rgba(201,168,76,0.08);
    }
    .quote-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem; font-style: italic;
        color: #a1a1aa; line-height: 1.6;
    }
    .quote-text em { color: var(--gold); }
 
    .card-footer-label {
        font-size: 8px; letter-spacing: 0.4em;
        color: rgba(255,255,255,0.1); text-transform: uppercase;
        margin-top: 16px;
    }
 
    /* Floating accent card */
    .accent-card {
        position: absolute;
        bottom: -20px; left: -30px;
        background: rgba(10,13,20,0.95);
        border: 1px solid rgba(201,168,76,0.2);
        border-radius: 16px;
        padding: 16px 20px;
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-8px); }
    }
    .accent-card-label {
        font-size: 8px; letter-spacing: 0.25em;
        color: var(--muted); text-transform: uppercase; margin-bottom: 4px;
    }
    .accent-card-val {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem; font-weight: 700; color: var(--gold);
    }
 
    /* Pulse dot */
    .pulse-dot {
        display: inline-block; width: 7px; height: 7px;
        border-radius: 50%; background: #22c55e;
        animation: pulse-ring 2s ease-out infinite;
        margin-right: 6px;
        vertical-align: middle;
    }
    @keyframes pulse-ring {
        0%   { box-shadow: 0 0 0 0 rgba(34,197,94,0.5); }
        70%  { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
        100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
    }
 
    /* ════════════════════════════════════
       FEATURES STRIP
    ════════════════════════════════════ */
    .features-strip {
        max-width: 1280px; margin: 0 auto;
        padding: 0 32px 80px;
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    @media (max-width: 768px) {
        .features-strip { grid-template-columns: 1fr; }
    }
 
    .strip-card {
        background: rgba(10,13,20,0.7);
        border: 1px solid var(--border);
        border-radius: 20px; padding: 28px;
        backdrop-filter: blur(12px);
        position: relative; overflow: hidden;
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .strip-card:hover {
        transform: translateY(-4px);
        border-color: rgba(201,168,76,0.3);
        box-shadow: 0 16px 50px rgba(0,0,0,0.4), 0 0 30px rgba(201,168,76,0.05);
    }
    .strip-card::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(201,168,76,0.03) 0%, transparent 60%);
        pointer-events: none;
    }
    .strip-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 4rem; font-weight: 300;
        color: rgba(201,168,76,0.06);
        position: absolute; right: 16px; bottom: 8px;
        line-height: 1; user-select: none;
    }
    .strip-icon {
        width: 48px; height: 48px;
        background: rgba(201,168,76,0.08);
        border: 1px solid rgba(201,168,76,0.15);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold); font-size: 20px;
        margin-bottom: 18px;
    }
    .strip-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem; font-weight: 700;
        color: white; margin-bottom: 8px;
        font-style: italic;
    }
    .strip-desc {
        font-size: 10px; line-height: 1.8;
        color: var(--muted);
    }
 
    /* ════════════════════════════════════
       FOOTER
    ════════════════════════════════════ */
    .vx-footer {
        border-top: 1px solid rgba(201,168,76,0.06);
        padding: 28px 32px;
        text-align: center;
    }
    .vx-footer p {
        font-size: 9px; letter-spacing: 0.4em;
        color: rgba(255,255,255,0.08); text-transform: uppercase;
    }
 
    /* ════════════════════════════════════
       FADE-UP ANIMATIONS
    ════════════════════════════════════ */
    .fade-up { opacity: 0; transform: translateY(24px); animation: fu 0.8s ease forwards; }
    @keyframes fu { to { opacity:1; transform:translateY(0); } }
    .d1 { animation-delay: 0.05s; }
    .d2 { animation-delay: 0.15s; }
    .d3 { animation-delay: 0.25s; }
    .d4 { animation-delay: 0.35s; }
    .d5 { animation-delay: 0.45s; }
    .d6 { animation-delay: 0.55s; }
    .d7 { animation-delay: 0.65s; }
    </style>
</head>
<body>
 
<!-- BG LAYERS -->
<div class="cin-bg"></div>
<div class="cin-orb2"></div>
<div class="grid-overlay"></div>
<div class="scanlines"></div>
 
<div class="page-wrap">
 
    <!-- ══════════════════════════════════
         NAVBAR
    ══════════════════════════════════ -->
    <header class="vx-nav fade-up d1">
        <div class="vx-nav-inner">
            <a href="#" class="vx-brand">VOID<span>X</span></a>
 
            @if (Route::has('login'))
            <nav class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Log In</a>
                    @if (Route::has('register'))
                    <a href="{{ route('login') }}?action=register" class="nav-btn">
                        <span>Sign Up</span>
                    </a>
                    @endif
                @endauth
            </nav>
            @endif
        </div>
    </header>
 
    <!-- ══════════════════════════════════
         HERO
    ══════════════════════════════════ -->
    <div style="flex:1; display:flex; flex-direction:column; justify-content:center;">
        <section style="max-width:1280px; margin:0 auto; width:100%; padding:60px 32px;">
            <div class="hero-grid">
 
                <!-- LEFT -->
                <div>
                    <p class="hero-eyebrow fade-up d2">
                        <span class="rule"></span>Elite Selection · Titanium Access
                    </p>
 
                    <h1 class="hero-title fade-up d3">
                        Unlock<br>
                        <span class="line2">Adventure</span>
                    </h1>
 
                    <p class="hero-desc fade-up d4">
                        Experience the world's most exclusive destinations, vehicles, and cuisine — curated for the bold, designed for the elite.
                    </p>
 
                    <div class="hero-actions fade-up d5">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">
                            <span>Enter Portal</span>
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn-primary">
                            <span>Explore Now</span>
                        </a>
                        <a href="{{ route('login') }}?action=register" class="btn-ghost">
                            Create Account
                        </a>
                        @endauth
                    </div>
 
                    <div class="hero-stats fade-up d6">
                        <div class="stat-item">
                            <div class="stat-num">150+</div>
                            <div class="stat-label">Destinations</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">40+</div>
                            <div class="stat-label">Vehicles</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">100%</div>
                            <div class="stat-label">Exclusive</div>
                        </div>
                    </div>
                </div>
 
                <!-- RIGHT -->
                <div class="hero-right fade-up d4">
                    <div class="card-stack">
                        <div class="glass-feature-card">
                            <div class="corner-deco tl"></div>
                            <div class="corner-deco br"></div>
 
                            <div class="feature-row">
                                <div class="feature-icon"><i class='bx bx-map-alt'></i></div>
                                <div>
                                    <div class="feature-label">Global Destinations</div>
                                    <div class="feature-sub">Beaches · Mountains · Cities · Resorts</div>
                                </div>
                            </div>
 
                            <div class="feature-row">
                                <div class="feature-icon"><i class='bx bx-car'></i></div>
                                <div>
                                    <div class="feature-label">Premium Fleet</div>
                                    <div class="feature-sub">Sedans · SUVs · Motorcycles · Vans</div>
                                </div>
                            </div>
 
                            <div class="feature-row" style="margin-bottom:0;">
                                <div class="feature-icon"><i class='bx bx-dish'></i></div>
                                <div>
                                    <div class="feature-label">Private Cuisine</div>
                                    <div class="feature-sub">Fine Dining · Local Delicacies · Cafes</div>
                                </div>
                            </div>
 
                            <div class="quote-block">
                                <p class="quote-text">
                                    "Travel is the only thing you buy<br>that makes you <em>richer.</em>"
                                </p>
                            </div>
 
                            <div class="card-footer-label">
                                <span class="pulse-dot"></span>
                                Authorized by VoidX Elite · System Active
                            </div>
                        </div>
 
                        <!-- Floating accent -->
                        <div class="accent-card">
                            <div class="accent-card-label">Live Bookings</div>
                            <div class="accent-card-val">₱2.4M+</div>
                            <div style="font-size:8px; color:#22c55e; letter-spacing:0.15em; margin-top:4px;">
                                <span class="pulse-dot" style="width:5px;height:5px;"></span>
                                Secured Today
                            </div>
                        </div>
                    </div>
                </div>
 
            </div>
        </section>
 
        <!-- ══════════════════════════════════
             FEATURE STRIP
        ══════════════════════════════════ -->
        <div class="features-strip">
            <div class="strip-card fade-up d5">
                <div class="strip-num">01</div>
                <div class="strip-icon"><i class='bx bx-map-alt'></i></div>
                <div class="strip-title">Elite Destinations</div>
                <p class="strip-desc">From private island resorts to mountain peak estates — handpicked for the discerning traveller.</p>
            </div>
            <div class="strip-card fade-up d6">
                <div class="strip-num">02</div>
                <div class="strip-icon"><i class='bx bx-car'></i></div>
                <div class="strip-title">Premium Vehicles</div>
                <p class="strip-desc">Arrive in style with our curated fleet — sedans, SUVs, and motorcycles at your command.</p>
            </div>
            <div class="strip-card fade-up d7">
                <div class="strip-num">03</div>
                <div class="strip-icon"><i class='bx bx-wine'></i></div>
                <div class="strip-title">Private Cuisine</div>
                <p class="strip-desc">Elevate every journey with fine dining and local delicacies sourced from the best in the region.</p>
            </div>
        </div>
    </div>
 
    <!-- ══════════════════════════════════
         FOOTER
    ══════════════════════════════════ -->
    <footer class="vx-footer">
        <p>© 2026 VOIDX · Elite Travel Selection · All Rights Reserved · encrypted_link_active</p>
    </footer>
 
</div><!-- end .page-wrap -->
 
</body>
</html>
 