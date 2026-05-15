<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300;1,700&family=Space+Mono:wght@400;700&display=swap');

:root {
    --gold: #c9a84c; --gold-light: #e8c97a;
    --gold-dim: rgba(201,168,76,0.12);
    --dark: #06080d; --surface: rgba(10,13,20,0.88);
    --border: rgba(201,168,76,0.12); --muted: #52525b;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body, .min-h-screen { background-color: var(--dark) !important; }

.cin-bg { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }
.cin-bg::before {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 80% 60% at 15% 20%, rgba(201,168,76,0.07) 0%, transparent 60%),
        radial-gradient(ellipse 60% 80% at 85% 80%, rgba(30,60,120,0.12) 0%, transparent 60%),
        linear-gradient(160deg, #060810 0%, #080c14 40%, #060a0f 100%);
}
.cin-bg::after {
    content: ''; position: absolute; width: 700px; height: 700px;
    top: -150px; right: -200px; border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.06) 0%, transparent 70%);
    animation: orb-drift 14s ease-in-out infinite alternate;
}
@keyframes orb-drift { from { transform: translate(0,0) scale(1); } to { transform: translate(-40px,60px) scale(1.12); } }
.cin-orb2 {
    position: fixed; width: 600px; height: 600px; bottom: -200px; left: -100px;
    border-radius: 50%; background: radial-gradient(circle, rgba(20,60,140,0.08) 0%, transparent 70%);
    animation: orb2 18s ease-in-out infinite alternate; pointer-events: none; z-index: 0;
}
@keyframes orb2 { from { transform: scale(1); } to { transform: scale(1.15) translate(40px,-30px); } }
.grid-overlay {
    position: fixed; inset: 0; z-index: 0; pointer-events: none;
    background-image: linear-gradient(rgba(201,168,76,0.025) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(201,168,76,0.025) 1px, transparent 1px);
    background-size: 60px 60px;
}
.scanlines {
    position: fixed; inset: 0; z-index: 0; pointer-events: none;
    background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.07) 2px, rgba(0,0,0,0.07) 4px);
}
.page-content { position: relative; z-index: 1; }

.glass-card {
    background: var(--surface) !important;
    backdrop-filter: blur(20px) saturate(1.4);
    border: 1px solid var(--border) !important;
    position: relative; overflow: hidden;
}
.glass-card::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(201,168,76,0.04) 0%, transparent 50%);
    pointer-events: none;
}

.stat-card { transition: transform 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease; }
.stat-card:hover {
    transform: translateY(-4px);
    border-color: rgba(201,168,76,0.3) !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 30px rgba(201,168,76,0.05);
}
.stat-value {
    font-family: 'Cormorant Garamond', serif;
    background: linear-gradient(160deg, #ffffff 30%, var(--gold));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.progress-bar {
    height: 1px; background: linear-gradient(90deg, var(--gold), transparent);
    width: 0; transition: width 1.2s cubic-bezier(0.16,1,0.3,1);
}
.stat-card:hover .progress-bar { width: 100%; }
.deco-num {
    font-family: 'Cormorant Garamond', serif; font-size: 80px; font-weight: 300;
    color: rgba(201,168,76,0.04); line-height: 1;
    position: absolute; right: 20px; bottom: 10px; user-select: none;
}

table { background-color: transparent !important; font-family: 'Space Mono', monospace; }
tr.asset-row { transition: background 0.2s ease; }
tr.asset-row:hover { background: rgba(201,168,76,0.03) !important; }
.asset-preview {
    width: 52px; height: 52px; object-fit: cover;
    border-radius: 10px; border: 1px solid rgba(201,168,76,0.2);
    transition: transform 0.3s ease;
}
tr.asset-row:hover .asset-preview { transform: scale(1.08); }

.btn-gold { position: relative; overflow: hidden; transition: color 0.3s ease, box-shadow 0.3s ease; }
.btn-gold::after {
    content: ''; position: absolute; inset: 0;
    background: white; transform: translateY(105%);
    transition: transform 0.3s cubic-bezier(0.16,1,0.3,1);
}
.btn-gold:hover::after { transform: translateY(0); }
.btn-gold:hover { color: black !important; box-shadow: 0 0 30px rgba(201,168,76,0.2); }
.btn-gold span { position: relative; z-index: 1; }
.action-btn { transition: all 0.25s ease; }
.action-btn:hover { transform: scale(1.05); }

.corner-deco { position: absolute; width: 40px; height: 40px; border-color: rgba(201,168,76,0.3); border-style: solid; }
.corner-deco.tl { top: 16px; left: 16px; border-width: 1px 0 0 1px; }
.corner-deco.br { bottom: 16px; right: 16px; border-width: 0 1px 1px 0; }
.rule-line { display: inline-block; width: 32px; height: 1px; background: var(--gold); vertical-align: middle; margin-right: 10px; }
.cat-tag {
    font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: 0.15em;
    padding: 2px 8px; border-radius: 4px;
    background: rgba(201,168,76,0.08); border: 1px solid rgba(201,168,76,0.2); color: var(--gold);
}

.pulse-dot { box-shadow: 0 0 0 0 rgba(34,197,94,0.6); animation: pulse-ring 2s ease-out infinite; }
@keyframes pulse-ring {
    0% { box-shadow: 0 0 0 0 rgba(34,197,94,0.5); }
    70% { box-shadow: 0 0 0 8px rgba(34,197,94,0); }
    100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
}

.fade-up { opacity: 0; transform: translateY(20px); animation: fadeUp 0.7s ease forwards; }
@keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; }
.delay-4 { animation-delay: 0.4s; }
.delay-5 { animation-delay: 0.5s; }

.switch-btn {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 9px; letter-spacing: 0.2em; text-transform: uppercase; font-weight: 700;
    color: var(--gold); background: var(--gold-dim);
    border: 1px solid rgba(201,168,76,0.25); border-radius: 20px;
    padding: 6px 16px; text-decoration: none; transition: all 0.25s;
    font-family: 'Space Mono', monospace;
}
.switch-btn:hover { background: rgba(201,168,76,0.2); color: var(--gold-light); }

.admin-tab {
    cursor: pointer; padding: 8px 20px; border-radius: 50px;
    font-size: 9px; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase;
    font-family: 'Space Mono', monospace; border: 1px solid rgba(255,255,255,0.08);
    background: transparent; color: #71717a; transition: all 0.25s;
}
.admin-tab.active, .admin-tab:hover { background: var(--gold); color: black; border-color: var(--gold); }

/* ══ PROMO CARDS ══ */
.promo-card {
    background: rgba(10,13,20,0.85); border: 1px solid var(--border);
    border-radius: 20px; overflow: hidden; position: relative;
    transition: transform 0.35s ease, border-color 0.3s ease, box-shadow 0.35s ease;
}
.promo-card:hover {
    transform: translateY(-5px);
    border-color: rgba(201,168,76,0.4);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 30px rgba(201,168,76,0.06);
}
.promo-card-img-wrap { position: relative; height: 200px; overflow: hidden; }
.promo-card-img-wrap img {
    width: 100%; height: 100%; object-fit: cover;
    filter: brightness(0.45) saturate(0.8);
    transition: transform 1.2s cubic-bezier(0.4,0,0.2,1), filter 0.6s;
}
.promo-card:hover .promo-card-img-wrap img { transform: scale(1.08); filter: brightness(0.65) saturate(1); }
.promo-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(6,8,13,0.95) 0%, transparent 60%);
    display: flex; flex-direction: column; justify-content: flex-end;
    padding: 16px 18px 10px;
}
.promo-multi-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(6,8,13,0.95) 0%, transparent 55%);
    display: flex; flex-direction: column; justify-content: flex-end;
    padding: 16px 18px 10px;
}
.promo-card-body { padding: 16px 18px 18px; }
.promo-badge {
    display: inline-block; padding: 3px 10px; border-radius: 20px;
    font-size: 8px; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase;
    font-family: 'Space Mono', monospace;
}
.promo-badge.active-badge { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #22c55e; }
.promo-badge.inactive-badge { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.3); color: #f87171; }
.promo-actions { display: flex; gap: 8px; margin-top: 14px; }
.promo-action-btn {
    flex: 1; padding: 9px 12px; border-radius: 10px;
    font-family: 'Space Mono', monospace; font-size: 8px; font-weight: 700;
    letter-spacing: 0.15em; text-transform: uppercase; cursor: pointer;
    transition: all 0.2s ease; border: none;
}
.promo-action-btn.edit-btn { background: rgba(201,168,76,0.1); color: var(--gold); border: 1px solid rgba(201,168,76,0.2); }
.promo-action-btn.edit-btn:hover { background: rgba(201,168,76,0.2); }
.promo-action-btn.delete-btn { background: rgba(248,113,113,0.07); color: #f87171; border: 1px solid rgba(248,113,113,0.2); }
.promo-action-btn.delete-btn:hover { background: rgba(248,113,113,0.15); }
.promo-cat-chips { display: flex; flex-wrap: wrap; gap: 4px; margin-top: 8px; }
.promo-cat-chip {
    font-size: 7px; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 700;
    padding: 2px 8px; border-radius: 4px;
    background: rgba(201,168,76,0.08); border: 1px solid rgba(201,168,76,0.15); color: var(--gold);
    font-family: 'Space Mono', monospace;
}

/* ══ MODAL ══ */
.modal { z-index: 99999 !important; }
.modal-backdrop { z-index: 99998 !important; }
.modal-dialog { z-index: 100000 !important; position: relative; }
.modal-content {
    position: relative; z-index: 100001 !important;
    background: rgba(8,10,16,0.99) !important;
    border: 1px solid var(--border) !important;
    border-radius: 24px !important; overflow: hidden;
}

/* ══ FORM INPUTS — CRITICAL: color must be visible ══ */
.vx-label {
    display: block; font-size: 8px; letter-spacing: 0.3em; color: var(--gold);
    text-transform: uppercase; font-weight: 700; margin-bottom: 8px;
    font-family: 'Space Mono', monospace;
}
.vx-input {
    width: 100%; padding: 12px 14px;
    background: rgba(255,255,255,0.06) !important;
    border: 1px solid rgba(201,168,76,0.25) !important;
    border-radius: 12px;
    color: #ffffff !important;
    font-family: 'Space Mono', monospace !important;
    font-size: 12px !important;
    outline: none;
    transition: border-color 0.3s, background 0.3s !important;
    caret-color: var(--gold);
    -webkit-text-fill-color: #ffffff !important;
}
.vx-input:focus {
    border-color: rgba(201,168,76,0.6) !important;
    background: rgba(255,255,255,0.10) !important;
    -webkit-text-fill-color: #ffffff !important;
}
.vx-input::placeholder { color: #52525b !important; -webkit-text-fill-color: #52525b !important; opacity: 1; }
.vx-input:not(:placeholder-shown) { -webkit-text-fill-color: #ffffff !important; color: #ffffff !important; }
select.vx-input option { background: #0d0f18; color: #e4e4e7; }
textarea.vx-input { resize: none; }

/* Currency prefix wrapper */
.input-prefix-wrap { position: relative; }
.input-prefix {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: var(--gold); font-family: 'Space Mono', monospace;
    font-size: 12px; font-weight: 700; pointer-events: none; z-index: 2;
}
.input-prefix-wrap .vx-input { padding-left: 34px; }

/* CAT SELECTOR */
.cat-selector { display: flex; flex-wrap: wrap; gap: 8px; }
.cat-toggle {
    padding: 6px 14px; border-radius: 20px; font-size: 8px; font-weight: 700;
    letter-spacing: 0.15em; text-transform: uppercase; cursor: pointer;
    font-family: 'Space Mono', monospace; border: 1px solid rgba(255,255,255,0.08);
    background: transparent; color: #71717a; transition: all 0.2s; user-select: none;
}
.cat-toggle.selected { background: var(--gold-dim); color: var(--gold); border-color: rgba(201,168,76,0.35); }

/* Cat img slots */
.cat-img-slots { margin-top: 16px; }
.cat-img-slot {
    border: 1px dashed rgba(201,168,76,0.25); border-radius: 12px;
    padding: 12px 14px; margin-bottom: 10px; transition: border-color 0.2s;
}
.cat-img-slot:hover { border-color: rgba(201,168,76,0.5); }
.cat-img-slot-label {
    font-size: 8px; letter-spacing: 0.2em; color: var(--gold); text-transform: uppercase;
    font-weight: 700; font-family: 'Space Mono', monospace; margin-bottom: 10px; display: flex;
    align-items: center; gap: 8px;
}
.slot-img-preview { width: 100%; height: 90px; object-fit: cover; border-radius: 8px; display: none; margin-bottom: 8px; border: 1px solid rgba(201,168,76,0.2); }
.slot-img-preview.visible { display: block; }
.img-upload-trigger {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 8px; letter-spacing: 0.15em; text-transform: uppercase; font-weight: 700;
    color: var(--gold); background: rgba(201,168,76,0.08);
    border: 1px solid rgba(201,168,76,0.2); border-radius: 8px;
    padding: 6px 12px; cursor: pointer; transition: all 0.2s; font-family: 'Space Mono', monospace;
}
.img-upload-trigger:hover { background: rgba(201,168,76,0.15); }

/* Price display in table */
.price-badge {
    font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700;
    color: var(--gold); background: rgba(201,168,76,0.08);
    border: 1px solid rgba(201,168,76,0.2); border-radius: 6px;
    padding: 3px 10px; display: inline-block;
}
</style>

<!-- BG -->
<div class="cin-bg"></div>
<div class="cin-orb2"></div>
<div class="grid-overlay"></div>
<div class="scanlines"></div>

<div class="page-content min-h-screen text-white p-4 md:p-8" style="background:transparent !important;">

    <!-- HEADER -->
    <div class="max-w-7xl mx-auto mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 fade-up">
        <div>
            <p class="text-[9px] uppercase tracking-[0.5em] text-zinc-600 mb-3 font-bold" style="font-family:'Space Mono',monospace;">
                <span class="rule-line"></span>Voidx Management System
            </p>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.5rem,6vw,4.5rem); font-weight:300; line-height:1; letter-spacing:-0.02em;">
                {{ strtoupper(trim(auth()->user()->role)) }}<br>
                <em style="color:var(--gold); font-weight:700; font-style:italic;">Command Center</em>
            </h1>
        </div>
        <div class="flex flex-col items-end gap-3">
            <a href="{{ route('dashboard') }}" class="switch-btn">
                <i class='bx bx-user' style="font-size:13px;"></i>
                User View
            </a>
            <div class="flex items-center gap-2 bg-black/40 border border-zinc-800 px-4 py-2 rounded-full">
                <div class="w-1.5 h-1.5 rounded-full pulse-dot bg-green-500"></div>
                <span class="text-zinc-300 text-xs" style="font-family:'Space Mono',monospace;">{{ now()->format('M d, Y • H:i') }}</span>
            </div>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
        <div class="glass-card stat-card p-8 rounded-2xl fade-up delay-1">
            <div class="corner-deco tl"></div>
            <div class="corner-deco br"></div>
            <p class="text-[9px] uppercase tracking-[0.3em] text-zinc-500 mb-4" style="font-family:'Space Mono',monospace;">Total Assets</p>
            <h3 class="stat-value" style="font-size:4rem; line-height:1;">{{ $totalHistory }}</h3>
            <div class="mt-5 progress-bar"></div>
            <div class="deco-num">01</div>
        </div>

        @if(in_array(strtolower(trim(auth()->user()->role)), ['high_admin', 'owner']))
        <div class="glass-card stat-card p-8 rounded-2xl fade-up delay-2">
            <p class="text-[9px] uppercase tracking-[0.3em] text-zinc-500 mb-4" style="font-family:'Space Mono',monospace;">Elite Members</p>
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:4rem; font-weight:700; color:var(--gold); line-height:1;">{{ $userCount }}</h3>
            <p class="text-[9px] italic text-zinc-600 mt-3">Verified VIP Database</p>
            <div class="deco-num">02</div>
        </div>
        @endif

        <div class="glass-card stat-card p-8 rounded-2xl fade-up delay-3">
            <p class="text-[9px] uppercase tracking-[0.3em] text-zinc-500 mb-4" style="font-family:'Space Mono',monospace;">System Status</p>
            <div class="flex items-center gap-3 mb-3">
                <div class="w-2.5 h-2.5 rounded-full pulse-dot bg-green-500"></div>
                <span class="text-white text-sm font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">{{ strtoupper(trim(auth()->user()->role)) }} ACTIVE</span>
            </div>
            <p class="text-[9px] text-zinc-600 uppercase tracking-widest" style="font-family:'Space Mono',monospace;">Security: Encrypted ●●●●●●●</p>
            <div class="deco-num">03</div>
        </div>
    </div>

    <!-- OWNER CONTROLS -->
    @if(strtolower(trim(auth()->user()->role)) === 'owner')
    <div class="max-w-7xl mx-auto mb-10 fade-up delay-3">
        <div class="glass-card p-8 rounded-2xl">
            <p class="text-[9px] uppercase tracking-[0.4em] text-zinc-500 mb-6" style="font-family:'Space Mono',monospace;">Master Privilege Controls</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.income') }}" class="btn-gold text-black px-8 py-4 rounded-xl font-bold uppercase text-[10px] tracking-[0.2em] inline-block" style="font-family:'Space Mono',monospace; background:var(--gold); color:black;">
                    <span>View Total Income</span>
                </a>
                <a href="{{ route('admin.users') }}" class="bg-transparent text-white border border-zinc-700 px-8 py-4 rounded-xl font-bold uppercase text-[10px] tracking-[0.2em] hover:border-gold hover:text-gold transition-all inline-block" style="font-family:'Space Mono',monospace;">
                    Manage Users & Roles
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- FLASH MESSAGES -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto mb-6 p-4 rounded-xl border fade-up" style="background:rgba(34,197,94,0.05); border-color:rgba(34,197,94,0.2);">
        <p class="text-green-500 text-[9px] font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">
            <i class='bx bx-check-circle' style="font-size:14px; vertical-align:middle; margin-right:6px;"></i>
            {{ session('success') }}
        </p>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto mb-6 p-4 rounded-xl border fade-up" style="background:rgba(248,113,113,0.05); border-color:rgba(248,113,113,0.2);">
        <p class="text-red-400 text-[9px] font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">
            <i class='bx bx-x-circle' style="font-size:14px; vertical-align:middle; margin-right:6px;"></i>
            {{ session('error') }}
        </p>
    </div>
    @endif

    <!-- TAB NAVIGATION -->
    <div class="max-w-7xl mx-auto mb-6 fade-up delay-3">
        <div class="flex gap-3 flex-wrap">
            <button class="admin-tab active" onclick="switchTab('assets', this)">
                <i class='bx bx-list-ul'></i> Asset Inventory
            </button>
            <button class="admin-tab" onclick="switchTab('promos', this)">
                <i class='bx bx-gift'></i> Promo Management
            </button>
        </div>
    </div>

    <!-- ══ TAB: ASSETS ══ -->
    <div id="tab-assets" class="max-w-7xl mx-auto fade-up delay-4">
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="p-7 border-b flex justify-between items-center" style="border-color:var(--border); background:linear-gradient(90deg,rgba(201,168,76,0.04),transparent);">
                <div>
                    <h4 class="font-bold uppercase tracking-[0.2em] text-sm" style="font-family:'Space Mono',monospace; color:var(--gold);">Asset Inventory</h4>
                    <p class="text-zinc-600 text-[9px] uppercase mt-1 tracking-widest" style="font-family:'Space Mono',monospace;">Live Management · Travel / Vehicles / Foods</p>
                </div>
                <button onclick="openAssetModal()" class="btn-gold text-black px-6 py-2.5 rounded-lg text-[9px] font-bold uppercase tracking-widest inline-block" style="font-family:'Space Mono',monospace; background:var(--gold); color:black; border:none; cursor:pointer;">
                    <span>+ Add New Item</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr style="background:rgba(0,0,0,0.4);">
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500" style="font-family:'Space Mono',monospace;">Asset</th>
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500 text-center" style="font-family:'Space Mono',monospace;">Sub-Category</th>
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500 text-center" style="font-family:'Space Mono',monospace;">Price</th>
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500" style="font-family:'Space Mono',monospace;">Status</th>
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500 text-right" style="font-family:'Space Mono',monospace;">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTravels as $travel)
                        <tr class="asset-row border-t" style="border-color:rgba(201,168,76,0.06);">
                            <td class="p-5">
                                <div class="flex items-center gap-4">
                                    @if($travel->image_url)
                                        <img src="{{ asset('storage/' . $travel->image_url) }}" class="asset-preview">
                                    @else
                                        <div class="asset-preview bg-zinc-900 flex items-center justify-center" style="display:flex;">
                                            <i class='bx bx-image text-zinc-700 text-lg'></i>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="font-bold uppercase tracking-tight text-zinc-200 block" style="font-family:'Space Mono',monospace; font-size:11px;">{{ $travel->name }}</span>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <span class="cat-tag">{{ $travel->category }}</span>
                                            <span class="text-zinc-700 text-[9px]" style="font-family:'Space Mono',monospace;">#{{ str_pad($travel->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-5 text-center">
                                <span class="text-[9px] font-bold text-zinc-400 uppercase tracking-widest" style="font-family:'Space Mono',monospace;">{{ $travel->sub_category ?? '—' }}</span>
                            </td>
                            <td class="p-5 text-center">
                                @if($travel->price)
                                    <span class="price-badge">₱{{ number_format($travel->price, 2) }}</span>
                                @else
                                    <span class="text-zinc-700 text-[9px]" style="font-family:'Space Mono',monospace;">—</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full pulse-dot bg-green-500"></div>
                                    <span class="text-green-500 text-[9px] font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">Active</span>
                                </div>
                            </td>
                            <td class="p-5">
                                <div class="flex justify-end gap-2">
                                    <button onclick='openEditAssetModal({{ json_encode($travel) }})'
                                        class="action-btn h-9 w-9 flex items-center justify-center rounded-lg border border-zinc-800"
                                        style="background:rgba(0,0,0,0.3); color:var(--gold);" title="Edit">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    @if(in_array(strtolower(trim(auth()->user()->role)), ['high_admin', 'owner']))
                                    <form action="{{ route('travel.destroy', $travel->id) }}" method="POST" onsubmit="return confirmDelete(event, 'CRITICAL: Terminate asset?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn h-9 w-9 flex items-center justify-center rounded-lg border border-zinc-800 text-zinc-600 hover:border-red-500 hover:text-red-500" style="background:rgba(0,0,0,0.3);" title="Delete">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center text-zinc-700 uppercase text-[10px] tracking-[0.4em]" style="font-family:'Space Mono',monospace;">
                                No data detected in mainframe
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ══ TAB: PROMOS ══ -->
    <div id="tab-promos" class="max-w-7xl mx-auto fade-up delay-4" style="display:none;">
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="p-7 border-b flex justify-between items-center" style="border-color:var(--border); background:linear-gradient(90deg,rgba(201,168,76,0.04),transparent);">
                <div>
                    <h4 class="font-bold uppercase tracking-[0.2em] text-sm" style="font-family:'Space Mono',monospace; color:var(--gold);">Promo Management</h4>
                    <p class="text-zinc-600 text-[9px] uppercase mt-1 tracking-widest" style="font-family:'Space Mono',monospace;">Deploy promos · visible to all users</p>
                </div>
                <button onclick="openPromoModal()" class="btn-gold text-black px-6 py-2.5 rounded-lg text-[9px] font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace; background:var(--gold); color:black; border:none; cursor:pointer;">
                    <span>+ New Promo</span>
                </button>
            </div>

            <div class="p-6">
                @php
                    $promos = class_exists('\App\Models\Promo')
                        ? \App\Models\Promo::latest()->get()
                        : collect([]);
                    $catImages = [
                        'Travel'=>'https://images.unsplash.com/photo-1544161515-4af6b1d462c2?w=700&q=80',
                        'Vehicle'=>'https://images.unsplash.com/photo-1631214499551-739c9a008431?w=700&q=80',
                        'Food'=>'https://images.unsplash.com/photo-1546241072-48010ad28c2c?w=700&q=80',
                        'Beach'=>'https://images.unsplash.com/photo-1519046904884-53103b34b206?w=700&q=80',
                        'Mountain'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=700&q=80',
                        'Resort'=>'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=700&q=80',
                        'City'=>'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=700&q=80',
                        'Sedan'=>'https://images.unsplash.com/photo-1631214499551-739c9a008431?w=700&q=80',
                        'SUV'=>'https://images.unsplash.com/photo-1617469767796-f778aff9f0e8?w=700&q=80',
                        'Motorcycle'=>'https://images.unsplash.com/photo-1558980664-769d59546b3d?w=700&q=80',
                        'Family Van'=>'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=700&q=80',
                        'Fine Dining'=>'https://images.unsplash.com/photo-1546241072-48010ad28c2c?w=700&q=80',
                        'Local Delicacy'=>'https://images.unsplash.com/photo-1555126634-323283e090fa?w=700&q=80',
                        'Street Food'=>'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=700&q=80',
                        'Cafe'=>'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=700&q=80',
                        'default'=>'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=700&q=80',
                    ];
                    $catIcons = [
                        'Travel'=>'bx-map-alt','Vehicle'=>'bx-car','Food'=>'bx-dish',
                        'Beach'=>'bx-sun','Mountain'=>'bx-landscape','Resort'=>'bx-pool',
                        'City'=>'bx-buildings','Sedan'=>'bx-car','SUV'=>'bx-car',
                        'Motorcycle'=>'bx-cycling','Family Van'=>'bx-bus',
                        'Fine Dining'=>'bx-wine','Local Delicacy'=>'bx-dish',
                        'Street Food'=>'bx-store','Cafe'=>'bx-coffee','default'=>'bx-star',
                    ];
                @endphp

                @if($promos->isEmpty())
                <div class="text-center py-16">
                    <i class='bx bx-gift text-5xl text-zinc-700 block mb-4'></i>
                    <p class="text-zinc-600 text-[10px] uppercase tracking-[0.3em] mb-2" style="font-family:'Space Mono',monospace;">No promos deployed yet</p>
                    <p class="text-zinc-700 text-[9px]" style="font-family:'Space Mono',monospace;">Click "+ New Promo" to create your first promotion</p>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($promos as $promo)
                    @php
                        $cats = array_filter(array_map('trim', explode(',', $promo->category ?? '')));
                        $imgs = [];
                        if (!empty($promo->image_urls)) {
                            $imgs = is_array($promo->image_urls)
                                ? $promo->image_urls
                                : json_decode($promo->image_urls, true) ?? [];
                        }
                        if (empty($imgs)) {
                            foreach ($cats as $c) { $imgs[] = $catImages[$c] ?? $catImages['default']; }
                        }
                        if (empty($imgs)) $imgs[] = $catImages['default'];
                        $imgCount = count($imgs);
                    @endphp
                    <div class="promo-card" style="animation: fadeUp 0.5s ease {{ $loop->index * 0.08 }}s both;">
                        @if($imgCount === 1)
                        <div class="promo-card-img-wrap" style="position:relative;">
                            <img src="{{ $imgs[0] }}" alt="{{ $promo->title }}" onerror="this.src='{{ $catImages['default'] }}'">
                            <div class="promo-img-overlay">
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span class="promo-badge {{ $promo->is_active ? 'active-badge' : 'inactive-badge' }}">{{ $promo->is_active ? 'Active' : 'Inactive' }}</span>
                                    <span style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:#000; background:var(--gold); padding:2px 12px; border-radius:20px; line-height:1.2;">{{ $promo->discount_percent }}<span style="font-family:'Space Mono',monospace; font-size:0.6rem;">%</span></span>
                                </div>
                            </div>
                        </div>
                        @elseif($imgCount === 2)
                        <div style="position:relative; height:200px;">
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px; height:100%; overflow:hidden;">
                                @foreach($imgs as $img)
                                <img src="{{ $img }}" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.45) saturate(0.8);" onerror="this.src='{{ $catImages['default'] }}'">
                                @endforeach
                            </div>
                            <div class="promo-multi-overlay">
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span class="promo-badge {{ $promo->is_active ? 'active-badge' : 'inactive-badge' }}">{{ $promo->is_active ? 'Active' : 'Inactive' }}</span>
                                    <span style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:#000; background:var(--gold); padding:2px 12px; border-radius:20px; line-height:1.2;">{{ $promo->discount_percent }}<span style="font-family:'Space Mono',monospace; font-size:0.6rem;">%</span></span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div style="position:relative; height:200px;">
                            <div style="display:grid; grid-template-columns:1fr 1fr; grid-template-rows:1fr 1fr; gap:2px; height:100%; overflow:hidden;">
                                <img src="{{ $imgs[0] }}" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.45) saturate(0.8);grid-row:span 2;" onerror="this.src='{{ $catImages['default'] }}'">
                                <img src="{{ $imgs[1] }}" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.45) saturate(0.8);" onerror="this.src='{{ $catImages['default'] }}'">
                                <img src="{{ $imgs[2] }}" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.45) saturate(0.8);" onerror="this.src='{{ $catImages['default'] }}'">
                            </div>
                            <div class="promo-multi-overlay">
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span class="promo-badge {{ $promo->is_active ? 'active-badge' : 'inactive-badge' }}">{{ $promo->is_active ? 'Active' : 'Inactive' }}</span>
                                    <span style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:#000; background:var(--gold); padding:2px 12px; border-radius:20px; line-height:1.2;">{{ $promo->discount_percent }}<span style="font-family:'Space Mono',monospace; font-size:0.6rem;">%</span></span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="promo-card-body">
                            <div class="promo-cat-chips mb-2">
                                @foreach($cats as $c)
                                <span class="promo-cat-chip"><i class='bx {{ $catIcons[$c] ?? "bx-star" }}' style="vertical-align:middle;font-size:10px;margin-right:3px;"></i>{{ $c }}</span>
                                @endforeach
                            </div>
                            <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.25rem; font-weight:700; color:white; margin-bottom:6px; line-height:1.2;">{{ $promo->title }}</h3>
                            <p style="font-size:10px; color:#71717a; line-height:1.7; margin-bottom:10px;">{{ Str::limit($promo->description, 80) }}</p>
                            @if($promo->valid_until)
                            <p style="font-size:8px; color:var(--muted); letter-spacing:0.15em; text-transform:uppercase; font-family:'Space Mono',monospace;">
                                <i class='bx bx-time' style="vertical-align:middle; font-size:10px;"></i>
                                Valid until {{ \Carbon\Carbon::parse($promo->valid_until)->format('M d, Y') }}
                            </p>
                            @else
                            <p style="font-size:8px; color:var(--muted); letter-spacing:0.15em; text-transform:uppercase; font-family:'Space Mono',monospace;">
                                <i class='bx bx-infinite' style="vertical-align:middle; font-size:10px;"></i> No expiry
                            </p>
                            @endif
                            <div class="promo-actions">
                                <button class="promo-action-btn edit-btn" onclick='openEditPromoModal({{ json_encode($promo) }})'>
                                    <i class='bx bx-edit-alt' style="vertical-align:middle; margin-right:4px;"></i> Edit
                                </button>
                                @if(in_array(strtolower(trim(auth()->user()->role)), ['high_admin','owner']))
                                <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST"
                                      onsubmit="return confirmDelete(event, 'Delete this promo?');" class="inline" style="flex:1;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="promo-action-btn delete-btn" style="width:100%;">
                                        <i class='bx bx-trash' style="vertical-align:middle; margin-right:4px;"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="max-w-7xl mx-auto mt-12 text-center fade-up delay-5">
        <p class="text-zinc-800 text-[9px] uppercase tracking-[0.5em]" style="font-family:'Space Mono',monospace;">
            Voidx Elite Selection · Terminal v2.0.4 · encrypted_link_active
        </p>
    </div>
</div>

<!-- ══════════════════════════════════════
     ASSET CREATE MODAL  ← BAGO ITO
══════════════════════════════════════ -->
<div class="modal fade" id="assetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:580px;">
        <div class="modal-content">
            <div style="padding:32px 34px 34px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px;">
                    <div>
                        <p style="font-size:8px; letter-spacing:0.4em; color:var(--gold); text-transform:uppercase; font-weight:700; font-family:'Space Mono',monospace; margin-bottom:6px;">New Asset</p>
                        <h4 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:white;">
                            Add <em style="color:var(--gold);">Item</em>
                        </h4>
                    </div>
                    <button onclick="assetModal.hide();"
                        style="width:32px;height:32px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:50%;color:#71717a;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
                        onmouseover="this.style.color='white'" onmouseout="this.style.color='#71717a'">
                        <i class='bx bx-x'></i>
                    </button>
                </div>

                <form action="{{ route('travel.store') }}" method="POST" enctype="multipart/form-data" id="createAssetForm">
                    @csrf

                    {{-- Name --}}
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Item Name *</label>
                        <input type="text" name="name" required
                               class="vx-input"
                               placeholder="e.g. Boracay Beach Package"
                               autocomplete="off">
                    </div>

                    {{-- Category + Sub-category --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
                        <div>
                            <label class="vx-label">Category *</label>
                            <select name="category" required class="vx-input" style="cursor:pointer;" onchange="updateSubCategories(this.value, 'create-sub-category')">
                                <option value="" disabled selected style="color:#52525b;">Select...</option>
                                <option value="Travel">Travel</option>
                                <option value="Vehicle">Vehicle</option>
                                <option value="Food">Food</option>
                            </select>
                        </div>
                        <div>
                            <label class="vx-label">Sub-Category</label>
                            <select name="sub_category" id="create-sub-category" class="vx-input" style="cursor:pointer;">
                                <option value="">— Select category first —</option>
                            </select>
                        </div>
                    </div>

                    {{-- Price + Description --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
                        <div>
                            <label class="vx-label">Price (₱)</label>
                            <div class="input-prefix-wrap">
                                <span class="input-prefix">₱</span>
                                <input type="number" name="price" min="0" step="0.01"
                                       class="vx-input"
                                       placeholder="0.00">
                            </div>
                        </div>
                        <div>
                            <label class="vx-label">Duration / Unit</label>
                            <input type="text" name="duration"
                                   class="vx-input"
                                   placeholder="e.g. per day, 3 nights">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Description</label>
                        <textarea name="description" rows="3" class="vx-input" placeholder="Describe this item..."></textarea>
                    </div>

                    {{-- Location --}}
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Location</label>
                        <input type="text" name="location"
                               class="vx-input"
                               placeholder="e.g. Boracay, Aklan">
                    </div>

                    {{-- Image Upload --}}
                    <div style="margin-bottom:20px;">
                        <label class="vx-label">Item Image</label>
                        <div style="border:1px dashed rgba(201,168,76,0.3); border-radius:14px; padding:18px; text-align:center; background:rgba(201,168,76,0.03); cursor:pointer;" onclick="document.getElementById('create-asset-img').click()">
                            <img id="create-asset-preview" src="" style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; margin-bottom:12px; border:1px solid rgba(201,168,76,0.2);">
                            <i class='bx bx-image-add' style="font-size:28px; color:#3f3f46; display:block; margin-bottom:6px;" id="create-asset-icon"></i>
                            <span style="font-size:9px; color:#52525b; font-family:'Space Mono',monospace; text-transform:uppercase; letter-spacing:0.15em;" id="create-asset-label">Click to upload image</span>
                            <input type="file" id="create-asset-img" name="image" accept="image/*" style="display:none;"
                                   onchange="previewAssetImg(this, 'create')">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div style="margin-bottom:20px;">
                        <label class="vx-label">Status</label>
                        <select name="status" class="vx-input" style="cursor:pointer;">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <button type="submit" style="flex:1; padding:14px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; background:var(--gold); color:black; border:none; cursor:pointer;">
                            Deploy Asset
                        </button>
                        <button type="button" onclick="assetModal.hide();" style="padding:14px 24px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; text-transform:uppercase; background:transparent; color:#52525b; border:1px solid #3f3f46; cursor:pointer;">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     ASSET EDIT MODAL  ← BAGO ITO
══════════════════════════════════════ -->
<div class="modal fade" id="editAssetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:580px;">
        <div class="modal-content">
            <div style="padding:32px 34px 34px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px;">
                    <div>
                        <p style="font-size:8px; letter-spacing:0.4em; color:var(--gold); text-transform:uppercase; font-weight:700; font-family:'Space Mono',monospace; margin-bottom:6px;">Edit Asset</p>
                        <h4 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:white;">
                            Update <em style="color:var(--gold);">Item</em>
                        </h4>
                    </div>
                    <button onclick="editAssetModal.hide();"
                        style="width:32px;height:32px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:50%;color:#71717a;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
                        onmouseover="this.style.color='white'" onmouseout="this.style.color='#71717a'">
                        <i class='bx bx-x'></i>
                    </button>
                </div>

                <form id="editAssetForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Item Name *</label>
                        <input type="text" name="name" id="edit-asset-name" required
                               class="vx-input"
                               placeholder="e.g. Boracay Beach Package"
                               autocomplete="off">
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
                        <div>
                            <label class="vx-label">Category *</label>
                            <select name="category" id="edit-asset-category" required class="vx-input" style="cursor:pointer;" onchange="updateSubCategories(this.value, 'edit-asset-sub-category')">
                                <option value="" disabled>Select...</option>
                                <option value="Travel">Travel</option>
                                <option value="Vehicle">Vehicle</option>
                                <option value="Food">Food</option>
                            </select>
                        </div>
                        <div>
                            <label class="vx-label">Sub-Category</label>
                            <select name="sub_category" id="edit-asset-sub-category" class="vx-input" style="cursor:pointer;">
                                <option value="">—</option>
                            </select>
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
                        <div>
                            <label class="vx-label">Price (₱)</label>
                            <div class="input-prefix-wrap">
                                <span class="input-prefix">₱</span>
                                <input type="number" name="price" id="edit-asset-price" min="0" step="0.01"
                                       class="vx-input" placeholder="0.00">
                            </div>
                        </div>
                        <div>
                            <label class="vx-label">Duration / Unit</label>
                            <input type="text" name="duration" id="edit-asset-duration"
                                   class="vx-input" placeholder="e.g. per day">
                        </div>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Description</label>
                        <textarea name="description" id="edit-asset-description" rows="3" class="vx-input" placeholder="Describe this item..."></textarea>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Location</label>
                        <input type="text" name="location" id="edit-asset-location"
                               class="vx-input" placeholder="e.g. Boracay, Aklan">
                    </div>

                    <div style="margin-bottom:20px;">
                        <label class="vx-label">Replace Image</label>
                        <div style="border:1px dashed rgba(201,168,76,0.3); border-radius:14px; padding:18px; text-align:center; background:rgba(201,168,76,0.03); cursor:pointer;" onclick="document.getElementById('edit-asset-img').click()">
                            <img id="edit-asset-preview" src="" style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; margin-bottom:12px; border:1px solid rgba(201,168,76,0.2);">
                            <i class='bx bx-image-add' style="font-size:28px; color:#3f3f46; display:block; margin-bottom:6px;" id="edit-asset-icon"></i>
                            <span style="font-size:9px; color:#52525b; font-family:'Space Mono',monospace; text-transform:uppercase; letter-spacing:0.15em;" id="edit-asset-label">Click to replace image</span>
                            <input type="file" id="edit-asset-img" name="image" accept="image/*" style="display:none;"
                                   onchange="previewAssetImg(this, 'edit')">
                        </div>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label class="vx-label">Status</label>
                        <select name="status" id="edit-asset-status" class="vx-input" style="cursor:pointer;">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <button type="submit" style="flex:1; padding:14px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; background:var(--gold); color:black; border:none; cursor:pointer;">
                            Save Changes
                        </button>
                        <button type="button" onclick="editAssetModal.hide();" style="padding:14px 24px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; text-transform:uppercase; background:transparent; color:#52525b; border:1px solid #3f3f46; cursor:pointer;">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════
     PROMO CREATE MODAL
══════════════════════════ -->
<div class="modal fade" id="promoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:560px;">
        <div class="modal-content">
            <div style="padding:32px 34px 34px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px;">
                    <div>
                        <p style="font-size:8px; letter-spacing:0.4em; color:var(--gold); text-transform:uppercase; font-weight:700; font-family:'Space Mono',monospace; margin-bottom:6px;">New Promotion</p>
                        <h4 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:white;">
                            Create <em style="color:var(--gold);">Promo</em>
                        </h4>
                    </div>
                    <button onclick="promoModal.hide();"
                        style="width:32px;height:32px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:50%;color:#71717a;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                        <i class='bx bx-x'></i>
                    </button>
                </div>

                <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data" id="createPromoForm">
                    @csrf
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Promo Title</label>
                        <input type="text" name="title" required class="vx-input" placeholder="e.g. Summer Beach Special">
                    </div>
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Description</label>
                        <textarea name="description" rows="3" class="vx-input" placeholder="Describe the promo offer..."></textarea>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
                        <div>
                            <label class="vx-label">Discount (%)</label>
                            <input type="number" name="discount_percent" min="1" max="100" class="vx-input" placeholder="e.g. 20">
                        </div>
                        <div>
                            <label class="vx-label">Valid Until</label>
                            <input type="date" name="valid_until" class="vx-input">
                        </div>
                    </div>
                    <div style="margin-bottom:20px;">
                        <label class="vx-label">Status</label>
                        <select name="is_active" class="vx-input" style="cursor:pointer;">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Applies to Categories</label>
                        <p style="font-size:9px; color:#52525b; margin-bottom:10px; font-family:'Space Mono',monospace;">Select 1–3 categories.</p>
                        <div class="cat-selector" id="create-cat-selector">
                            @foreach(['Travel','Vehicle','Food','Beach','Mountain','Resort','City','Sedan','SUV','Motorcycle','Family Van','Fine Dining','Local Delicacy','Street Food','Cafe'] as $c)
                            <button type="button" class="cat-toggle" data-cat="{{ $c }}" onclick="toggleCat(this,'create')">{{ $c }}</button>
                            @endforeach
                        </div>
                        <input type="hidden" name="category" id="create-category-input">
                    </div>
                    <div class="cat-img-slots" id="create-cat-img-slots"></div>
                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <button type="submit" style="flex:1; padding:14px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; background:var(--gold); color:black; border:none; cursor:pointer;">Deploy Promo</button>
                        <button type="button" onclick="promoModal.hide();" style="padding:14px 24px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; text-transform:uppercase; background:transparent; color:#52525b; border:1px solid #3f3f46; cursor:pointer;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════
     PROMO EDIT MODAL
══════════════════════════ -->
<div class="modal fade" id="editPromoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:560px;">
        <div class="modal-content">
            <div style="padding:32px 34px 34px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px;">
                    <div>
                        <p style="font-size:8px; letter-spacing:0.4em; color:var(--gold); text-transform:uppercase; font-weight:700; font-family:'Space Mono',monospace; margin-bottom:6px;">Edit Promotion</p>
                        <h4 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:700; color:white;">
                            Update <em style="color:var(--gold);">Promo</em>
                        </h4>
                    </div>
                    <button onclick="editPromoModal.hide();"
                        style="width:32px;height:32px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:50%;color:#71717a;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
                <form id="editPromoForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Promo Title</label>
                        <input type="text" name="title" id="edit-title" required class="vx-input" placeholder="e.g. Summer Beach Special">
                    </div>
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Description</label>
                        <textarea name="description" id="edit-description" rows="3" class="vx-input" placeholder="Describe the promo offer..."></textarea>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
                        <div>
                            <label class="vx-label">Discount (%)</label>
                            <input type="number" name="discount_percent" id="edit-discount" min="1" max="100" class="vx-input" placeholder="e.g. 20">
                        </div>
                        <div>
                            <label class="vx-label">Valid Until</label>
                            <input type="date" name="valid_until" id="edit-valid-until" class="vx-input">
                        </div>
                    </div>
                    <div style="margin-bottom:20px;">
                        <label class="vx-label">Status</label>
                        <select name="is_active" id="edit-is-active" class="vx-input" style="cursor:pointer;">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div style="margin-bottom:16px;">
                        <label class="vx-label">Applies to Categories</label>
                        <div class="cat-selector" id="edit-cat-selector">
                            @foreach(['Travel','Vehicle','Food','Beach','Mountain','Resort','City','Sedan','SUV','Motorcycle','Family Van','Fine Dining','Local Delicacy','Street Food','Cafe'] as $c)
                            <button type="button" class="cat-toggle" data-cat="{{ $c }}" onclick="toggleCat(this,'edit')">{{ $c }}</button>
                            @endforeach
                        </div>
                        <input type="hidden" name="category" id="edit-category-input">
                    </div>
                    <div class="cat-img-slots" id="edit-cat-img-slots"></div>
                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <button type="submit" style="flex:1; padding:14px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; background:var(--gold); color:black; border:none; cursor:pointer;">Save Changes</button>
                        <button type="button" onclick="editPromoModal.hide();" style="padding:14px 24px; border-radius:12px; font-family:'Space Mono',monospace; font-size:10px; font-weight:700; text-transform:uppercase; background:transparent; color:#52525b; border:1px solid #3f3f46; cursor:pointer;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ══ BOOTSTRAP MODALS ══ */
const assetModal     = new bootstrap.Modal(document.getElementById('assetModal'));
const editAssetModal = new bootstrap.Modal(document.getElementById('editAssetModal'));
const promoModal     = new bootstrap.Modal(document.getElementById('promoModal'));
const editPromoModal = new bootstrap.Modal(document.getElementById('editPromoModal'));

/* ══ FIX: Force white text in all modal inputs after bootstrap init ══ */
document.querySelectorAll('.vx-input').forEach(el => {
    el.style.color = '#ffffff';
    el.style.webkitTextFillColor = '#ffffff';
    el.addEventListener('input', function() {
        this.style.color = '#ffffff';
        this.style.webkitTextFillColor = '#ffffff';
    });
});

/* ══ TAB SWITCHING ══ */
function switchTab(tab, btn) {
    document.getElementById('tab-assets').style.display = 'none';
    document.getElementById('tab-promos').style.display = 'none';
    document.getElementById('tab-' + tab).style.display = 'block';
    document.querySelectorAll('.admin-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

/* ══ CONFIRM DELETE ══ */
function confirmDelete(e, msg) {
    e.preventDefault();
    const form = e.target.closest('form') || e.currentTarget;
    Swal.fire({
        title: 'Are you sure?',
        text: msg || 'This cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c9a84c',
        cancelButtonColor: '#3f3f46',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
        background: 'rgba(10,13,20,0.99)',
        color: '#e4e4e7',
        iconColor: '#f87171',
    }).then(result => {
        if (result.isConfirmed) form.submit();
    });
    return false;
}

/* ══ SUB-CATEGORY MAP ══ */
const SUB_CATS = {
    'Travel':  ['Beach','Mountain','Resort','City','Island','Waterfall','Heritage Site'],
    'Vehicle': ['Sedan','SUV','Motorcycle','Family Van','Coaster','Bus','Tricycle'],
    'Food':    ['Fine Dining','Local Delicacy','Street Food','Cafe','Buffet','Seafood','Bakery'],
};

function updateSubCategories(cat, targetId) {
    const sel = document.getElementById(targetId);
    sel.innerHTML = '<option value="">— None —</option>';
    const subs = SUB_CATS[cat] || [];
    subs.forEach(s => {
        const opt = document.createElement('option');
        opt.value = s; opt.textContent = s;
        sel.appendChild(opt);
    });
}

/* ══ ASSET IMAGE PREVIEW ══ */
function previewAssetImg(input, mode) {
    const prefix = mode === 'create' ? 'create-asset' : 'edit-asset';
    const preview = document.getElementById(prefix + '-preview');
    const icon = document.getElementById(prefix + '-icon');
    const label = document.getElementById(prefix + '-label');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            icon.style.display = 'none';
            label.textContent = input.files[0].name;
            label.style.color = 'var(--gold)';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/* ══ OPEN ASSET CREATE MODAL ══ */
function openAssetModal() {
    document.getElementById('createAssetForm').reset();
    document.getElementById('create-asset-preview').style.display = 'none';
    document.getElementById('create-asset-icon').style.display = 'block';
    document.getElementById('create-asset-label').textContent = 'Click to upload image';
    document.getElementById('create-asset-label').style.color = '#52525b';
    document.getElementById('create-sub-category').innerHTML = '<option value="">— Select category first —</option>';
    // Re-apply text fill fix after modal opens
    setTimeout(() => {
        document.querySelectorAll('#assetModal .vx-input').forEach(el => {
            el.style.color = '#ffffff';
            el.style.webkitTextFillColor = '#ffffff';
        });
    }, 300);
    assetModal.show();
}

/* ══ OPEN ASSET EDIT MODAL ══ */
function openEditAssetModal(asset) {
    document.getElementById('edit-asset-name').value        = asset.name || '';
    document.getElementById('edit-asset-description').value = asset.description || '';
    document.getElementById('edit-asset-price').value       = asset.price || '';
    document.getElementById('edit-asset-duration').value    = asset.duration || '';
    document.getElementById('edit-asset-location').value    = asset.location || '';

    const catSel = document.getElementById('edit-asset-category');
    catSel.value = asset.category || '';
    if (asset.category) {
        updateSubCategories(asset.category, 'edit-asset-sub-category');
        setTimeout(() => {
            document.getElementById('edit-asset-sub-category').value = asset.sub_category || '';
        }, 50);
    }

    const statusSel = document.getElementById('edit-asset-status');
    if (statusSel) statusSel.value = asset.status || 'active';

    // Show existing image
    const preview = document.getElementById('edit-asset-preview');
    const icon = document.getElementById('edit-asset-icon');
    const label = document.getElementById('edit-asset-label');
    if (asset.image_url) {
        preview.src = '/storage/' + asset.image_url;
        preview.style.display = 'block';
        icon.style.display = 'none';
        label.textContent = 'Current image · click to replace';
        label.style.color = 'var(--gold)';
    } else {
        preview.style.display = 'none';
        icon.style.display = 'block';
        label.textContent = 'Click to upload image';
        label.style.color = '#52525b';
    }

    // Dynamic route — adjust to your route pattern
    document.getElementById('editAssetForm').action = '/travel/' + asset.id;

    // Re-apply text fix
    setTimeout(() => {
        document.querySelectorAll('#editAssetModal .vx-input').forEach(el => {
            el.style.color = '#ffffff';
            el.style.webkitTextFillColor = '#ffffff';
        });
    }, 300);

    editAssetModal.show();
}

/* ══ CAT ICONS MAP (for promos) ══ */
const CAT_ICONS = {
    'Travel':'bx-map-alt','Vehicle':'bx-car','Food':'bx-dish',
    'Beach':'bx-sun','Mountain':'bx-landscape','Resort':'bx-pool',
    'City':'bx-buildings','Sedan':'bx-car','SUV':'bx-car',
    'Motorcycle':'bx-cycling','Family Van':'bx-bus','Fine Dining':'bx-wine',
    'Local Delicacy':'bx-dish','Street Food':'bx-store','Cafe':'bx-coffee',
};

const selectedCats = { create: [], edit: [] };

function toggleCat(btn, mode) {
    const cat = btn.dataset.cat;
    const arr = selectedCats[mode];
    if (btn.classList.contains('selected')) {
        btn.classList.remove('selected');
        const idx = arr.indexOf(cat);
        if (idx > -1) arr.splice(idx, 1);
    } else {
        if (arr.length >= 3) {
            Swal.fire({ toast:true, position:'top-end', icon:'warning', title:'Max 3 categories', showConfirmButton:false, timer:1500, background:'rgba(10,13,20,0.97)', color:'#e4e4e7', iconColor:'#c9a84c' });
            return;
        }
        btn.classList.add('selected');
        arr.push(cat);
    }
    document.getElementById(mode + '-category-input').value = arr.join(',');
    renderCatImgSlots(mode);
}

function renderCatImgSlots(mode) {
    const container = document.getElementById(mode + '-cat-img-slots');
    const cats = selectedCats[mode];
    if (!cats.length) { container.innerHTML = ''; return; }
    container.innerHTML = cats.map((cat, i) => `
    <div class="cat-img-slot">
        <div class="cat-img-slot-label">
            <i class='bx ${CAT_ICONS[cat] || 'bx-star'}'></i>
            ${cat} image
            <span style="color:#52525b; font-size:7px;">(optional)</span>
        </div>
        <img id="${mode}-preview-${i}" class="slot-img-preview" src="" alt="">
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
            <label class="img-upload-trigger" for="${mode}-img-upload-${i}">
                <i class='bx bx-image-add'></i> Choose Image
            </label>
            <input type="file" id="${mode}-img-upload-${i}" name="images[${i}]"
                   accept="image/*" style="display:none;"
                   onchange="previewSlotImg(this, '${mode}', ${i})">
            <span id="${mode}-img-name-${i}" style="font-size:8px; color:#52525b; font-family:'Space Mono',monospace;">No file selected</span>
        </div>
    </div>`).join('');
}

function previewSlotImg(input, mode, idx) {
    const nameEl = document.getElementById(mode + '-img-name-' + idx);
    const preview = document.getElementById(mode + '-preview-' + idx);
    if (input.files && input.files[0]) {
        nameEl.style.color = 'var(--gold)';
        nameEl.textContent = input.files[0].name;
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.add('visible');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function openPromoModal() {
    selectedCats.create = [];
    document.getElementById('create-category-input').value = '';
    document.getElementById('create-cat-img-slots').innerHTML = '';
    document.getElementById('createPromoForm').reset();
    document.querySelectorAll('#create-cat-selector .cat-toggle').forEach(b => b.classList.remove('selected'));
    promoModal.show();
}

function openEditPromoModal(promo) {
    document.getElementById('edit-title').value       = promo.title || '';
    document.getElementById('edit-description').value = promo.description || '';
    document.getElementById('edit-discount').value    = promo.discount_percent || '';
    document.getElementById('edit-valid-until').value = promo.valid_until ? promo.valid_until.substring(0,10) : '';
    document.getElementById('edit-is-active').value   = promo.is_active ? '1' : '0';
    document.getElementById('editPromoForm').action   = '/admin/promo/' + promo.id;

    const cats = (promo.category || '').split(',').map(c => c.trim()).filter(Boolean);
    selectedCats.edit = [...cats];
    document.getElementById('edit-category-input').value = cats.join(',');
    document.querySelectorAll('#edit-cat-selector .cat-toggle').forEach(b => {
        b.classList.toggle('selected', cats.includes(b.dataset.cat));
    });
    renderCatImgSlots('edit');

    const existingImgs = promo.image_urls
        ? (typeof promo.image_urls === 'string' ? JSON.parse(promo.image_urls) : promo.image_urls)
        : [];
    cats.forEach((cat, i) => {
        const preview = document.getElementById('edit-preview-' + i);
        if (preview && existingImgs[i]) {
            const src = existingImgs[i].startsWith('http') ? existingImgs[i] : '/storage/' + existingImgs[i];
            preview.src = src;
            preview.classList.add('visible');
            const nameEl = document.getElementById('edit-img-name-' + i);
            if (nameEl) { nameEl.textContent = 'Current image'; nameEl.style.color = 'var(--gold)'; }
        }
    });

    editPromoModal.show();
}
</script>

</x-app-layout>
