<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300;1,700&family=Space+Mono:wght@400;700&display=swap');

        :root {
            --gold: #c9a84c;
            --dark: #06080d;
            --surface: rgba(10,13,20,0.88);
            --border: rgba(201,168,76,0.12);
        }
        .text-gold { color: var(--gold) !important; }
        body, .min-h-screen { background-color: var(--dark) !important; }

        .cin-bg {
            position: fixed; inset: 0; z-index: 0; overflow: hidden;
        }
        .cin-bg::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 30%, rgba(201,168,76,0.07) 0%, transparent 55%),
                radial-gradient(ellipse 60% 80% at 80% 70%, rgba(10,40,100,0.1) 0%, transparent 55%),
                linear-gradient(160deg, #060810 0%, #07090e 100%);
        }
        .cin-bg::after {
            content: '';
            position: absolute;
            width: 800px; height: 800px;
            top: -300px; right: -200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.05) 0%, transparent 65%);
            animation: orb 15s ease-in-out infinite alternate;
        }
        @keyframes orb { from { transform: scale(1); } to { transform: scale(1.15) translate(-20px,40px); } }
        .grid-overlay {
            position: fixed; inset: 0; z-index: 0;
            background-image: linear-gradient(rgba(201,168,76,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(201,168,76,0.02) 1px, transparent 1px);
            background-size: 60px 60px; pointer-events: none;
        }
        .scanlines {
            position: fixed; inset: 0; z-index: 0;
            background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.06) 2px, rgba(0,0,0,0.06) 4px);
            pointer-events: none;
        }
        .page-content { position: relative; z-index: 1; }

        .glass-card {
            background: var(--surface) !important;
            backdrop-filter: blur(20px) saturate(1.4);
            border: 1px solid var(--border) !important;
            position: relative; overflow: hidden;
        }
        .glass-card::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(201,168,76,0.04) 0%, transparent 50%);
            pointer-events: none;
        }

        .fade-up { opacity:0; transform:translateY(16px); animation: fu 0.7s ease forwards; }
        @keyframes fu { to { opacity:1; transform:translateY(0); } }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        .rule-line { display: inline-block; width: 28px; height: 1px; background: var(--gold); vertical-align: middle; margin-right: 8px; }

        .corner-deco { position: absolute; width: 36px; height: 36px; border-color: rgba(201,168,76,0.25); border-style: solid; }
        .corner-deco.tl { top: 16px; left: 16px; border-width: 1px 0 0 1px; }
        .corner-deco.br { bottom: 16px; right: 16px; border-width: 0 1px 1px 0; }

        .income-amount {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 8vw, 5.5rem);
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .pulse-dot {
            animation: pulse-ring 2s ease-out infinite;
        }
        @keyframes pulse-ring {
            0%   { box-shadow: 0 0 0 0 rgba(34,197,94,0.5); }
            70%  { box-shadow: 0 0 0 8px rgba(34,197,94,0); }
            100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
        }

        .back-link {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .back-link:hover { color: var(--gold); }
        .back-link:hover i { transform: translateX(-4px); }
        .back-link i { transition: transform 0.3s ease; }

        /* Analytics placeholder shimmer */
        @keyframes shimmer {
            0%   { background-position: -400px 0; }
            100% { background-position: 400px 0; }
        }
        .shimmer-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,0.3), transparent);
            background-size: 400px 100%;
            animation: shimmer 3s infinite;
        }
    </style>

    <div class="cin-bg"></div>
    <div class="grid-overlay"></div>
    <div class="scanlines"></div>

    <div class="page-content min-h-screen text-white p-4 md:p-8" style="background:transparent !important;">

        <!-- HEADER -->
        <div class="max-w-7xl mx-auto mb-12 fade-up">
            <p class="text-[9px] uppercase tracking-[0.5em] text-zinc-600 mb-3 font-bold" style="font-family:'Space Mono',monospace;">
                <span class="rule-line"></span>Financial Records
            </p>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.5rem,6vw,4rem); font-weight:300; line-height:1.1; letter-spacing:-0.02em;">
                Total <em style="color:var(--gold); font-weight:700; font-style:italic;">Revenue</em>
            </h1>
            <p class="text-zinc-600 text-[9px] uppercase tracking-[0.4em] mt-2 font-bold" style="font-family:'Space Mono',monospace;">Confidential Data — Owner Access Only</p>
        </div>

        <!-- MAIN GRID -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            <!-- INCOME CARD -->
            <div class="lg:col-span-1 glass-card p-8 rounded-2xl fade-up delay-1">
                <div class="corner-deco tl"></div>
                <div class="corner-deco br"></div>
                <div class="absolute -right-4 -top-6 font-black italic text-gold/[0.04]" style="font-family:'Cormorant Garamond',serif; font-size:7rem; user-select:none;">₱</div>

                <p class="text-[9px] uppercase tracking-[0.35em] text-zinc-500 mb-5 font-bold" style="font-family:'Space Mono',monospace;">Gross Income</p>
                <div class="income-amount mb-2">₱{{ number_format($income, 2) }}</div>
                <div class="shimmer-line my-5"></div>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full pulse-dot bg-green-500"></div>
                    <span class="text-green-500 text-[9px] font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">System Live & Generating</span>
                </div>
            </div>

            <!-- ANALYTICS PLACEHOLDER -->
            <div class="lg:col-span-2 glass-card p-8 rounded-2xl fade-up delay-2 flex flex-col justify-center items-center text-center">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6" style="background: rgba(201,168,76,0.08); border: 1px solid rgba(201,168,76,0.15);">
                    <i class='bx bx-bar-chart-alt-2 text-3xl' style="color:var(--gold);"></i>
                </div>
                <h4 class="font-bold uppercase tracking-[0.25em] text-sm mb-3" style="font-family:'Space Mono',monospace;">Revenue Analytics</h4>
                <p class="text-zinc-500 text-xs max-w-sm leading-relaxed" style="font-family:'Space Mono',monospace; font-size:10px;">
                    Detailed charts and monthly growth reports will be automatically generated once booking transactions are finalized.
                </p>
                <div class="shimmer-line mt-8 w-32"></div>
            </div>
        </div>

        <!-- BACK LINK -->
        <div class="max-w-7xl mx-auto fade-up delay-3">
            <a href="{{ route('admin.dashboard') }}" class="back-link text-zinc-600">
                <i class='bx bx-left-arrow-alt text-base'></i>
                Back to Command Center
            </a>
        </div>

        <!-- FOOTER -->
        <div class="max-w-7xl mx-auto mt-12 text-center">
            <p class="text-zinc-800 text-[9px] uppercase tracking-[0.5em]" style="font-family:'Space Mono',monospace;">
                Voidx Elite Selection · Financial Terminal · encrypted_link_active
            </p>
        </div>
    </div>
</x-app-layout>
