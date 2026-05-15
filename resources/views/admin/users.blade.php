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

        .cin-bg { position: fixed; inset: 0; z-index: 0; overflow: hidden; }
        .cin-bg::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 80% 10%, rgba(201,168,76,0.06) 0%, transparent 55%),
                radial-gradient(ellipse 80% 70% at 10% 90%, rgba(10,30,90,0.1) 0%, transparent 55%),
                linear-gradient(160deg, #06080e 0%, #070910 100%);
        }
        .cin-bg::after {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            bottom: -150px; right: -200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.05) 0%, transparent 65%);
            animation: orb3 16s ease-in-out infinite alternate;
        }
        @keyframes orb3 { from { transform: scale(1); } to { transform: scale(1.1) translate(-30px,-30px); } }
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
            background: linear-gradient(135deg, rgba(201,168,76,0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .fade-up { opacity:0; transform:translateY(16px); animation: fu 0.7s ease forwards; }
        @keyframes fu { to { opacity:1; transform:translateY(0); } }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        .rule-line { display:inline-block; width:28px; height:1px; background:var(--gold); vertical-align:middle; margin-right:8px; }

        /* TABLE */
        table { background: transparent !important; font-family: 'Space Mono', monospace; }
        tr.user-row { transition: background 0.2s ease; }
        tr.user-row:hover { background: rgba(201,168,76,0.025) !important; }

        /* ROLE BADGES */
        .role-owner   { background: var(--gold); color: black; }
        .role-high    { background: white; color: black; }
        .role-admin   { border: 1px solid var(--gold); color: var(--gold); background: transparent; }
        .role-user    { background: rgba(255,255,255,0.05); color: #71717a; border: 1px solid rgba(255,255,255,0.06); }

        /* SELECT */
        select {
            background: rgba(0,0,0,0.5) !important;
            color: white !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 9px !important;
            border-color: #3f3f46 !important;
            transition: border-color 0.25s ease !important;
            cursor: pointer;
        }
        select:focus {
            outline: none !important;
            border-color: var(--gold) !important;
        }
        select option { background: #0a0a0a; color: white; }

        /* UPDATE BUTTON */
        .btn-update {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
            background: var(--gold);
            color: black;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-update::after {
            content: '';
            position: absolute; inset: 0;
            background: white;
            transform: translateY(105%);
            transition: transform 0.3s ease;
        }
        .btn-update:hover::after { transform: translateY(0); }
        .btn-update span { position: relative; z-index: 1; }

        /* BACK LINK */
        .back-link {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #52525b;
        }
        .back-link:hover { color: var(--gold); }
        .back-link:hover i { transform: translateX(-4px); }
        .back-link i { transition: transform 0.3s ease; }

        /* Avatar placeholder */
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px; font-weight: 700;
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.2);
            color: var(--gold);
            flex-shrink: 0;
        }
    </style>

    <div class="cin-bg"></div>
    <div class="grid-overlay"></div>
    <div class="scanlines"></div>

    <div class="page-content min-h-screen text-white p-4 md:p-8" style="background:transparent !important;">

        <!-- HEADER -->
        <div class="max-w-7xl mx-auto mb-12 fade-up">
            <p class="text-[9px] uppercase tracking-[0.5em] text-zinc-600 mb-3 font-bold" style="font-family:'Space Mono',monospace;">
                <span class="rule-line"></span>Master Control
            </p>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.5rem,6vw,4rem); font-weight:300; line-height:1.1; letter-spacing:-0.02em;">
                User <em style="color:var(--gold); font-weight:700; font-style:italic;">Management</em>
            </h1>
            <p class="text-zinc-600 text-[10px] mt-2" style="font-family:'Space Mono',monospace;">Promote or demote elite members of VOIDX.</p>
        </div>

        <!-- SUCCESS ALERT -->
        @if(session('success'))
        <div class="max-w-7xl mx-auto mb-6 p-4 rounded-xl border fade-up" style="background: rgba(34,197,94,0.05); border-color: rgba(34,197,94,0.2);">
            <p class="text-green-500 text-[9px] font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">{{ session('success') }}</p>
        </div>
        @endif

        <!-- TABLE -->
        <div class="max-w-7xl mx-auto glass-card rounded-2xl overflow-hidden fade-up delay-1">

            <!-- Table header bar -->
            <div class="p-6 border-b flex items-center justify-between" style="border-color:var(--border); background: linear-gradient(90deg, rgba(201,168,76,0.03), transparent);">
                <div>
                    <h4 class="font-bold uppercase tracking-[0.2em] text-sm" style="font-family:'Space Mono',monospace; color:var(--gold);">Personnel Database</h4>
                    <p class="text-zinc-600 text-[9px] mt-1 uppercase tracking-widest" style="font-family:'Space Mono',monospace;">Role Assignment Terminal</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr style="background: rgba(0,0,0,0.4);">
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500">Name / Email</th>
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500">Current Role</th>
                            <th class="p-5 text-[9px] uppercase tracking-[0.25em] text-zinc-500 text-right">Assign New Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="user-row border-t" style="border-color: rgba(201,168,76,0.05);">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    <div>
                                        <div class="font-bold uppercase tracking-tight text-zinc-200 text-xs" style="font-family:'Space Mono',monospace;">{{ $user->name }}</div>
                                        <div class="text-zinc-600 text-[10px] mt-0.5">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-5">
                                <span class="px-3 py-1 rounded-md text-[9px] font-bold uppercase tracking-widest
                                    {{ $user->role === 'owner' ? 'role-owner' :
                                       ($user->role === 'high_admin' ? 'role-high' :
                                       ($user->role === 'admin' ? 'role-admin' : 'role-user')) }}"
                                    style="font-family:'Space Mono',monospace;">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="p-5 text-right">
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.updateRole', $user->id) }}" method="POST" class="flex justify-end items-center gap-2">
                                    @csrf @method('PATCH')
                                    <select name="role" class="border border-zinc-800 rounded-lg px-3 py-2 focus:border-gold outline-none">
                                        <option value="user"       {{ $user->role == 'user'       ? 'selected' : '' }}>User</option>
                                        <option value="admin"      {{ $user->role == 'admin'      ? 'selected' : '' }}>Admin</option>
                                        <option value="high_admin" {{ $user->role == 'high_admin' ? 'selected' : '' }}>High Admin</option>
                                        <option value="owner"      {{ $user->role == 'owner'      ? 'selected' : '' }}>Owner</option>
                                    </select>
                                    <button type="submit" class="btn-update px-4 py-2 rounded-lg">
                                        <span>Update</span>
                                    </button>
                                </form>
                                @else
                                <span class="text-[9px] text-zinc-600 italic font-bold uppercase tracking-widest" style="font-family:'Space Mono',monospace;">You (Master)</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BACK LINK -->
        <div class="max-w-7xl mx-auto mt-8 fade-up delay-2">
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <i class='bx bx-left-arrow-alt text-base'></i>
                Back to Command Center
            </a>
        </div>

        <!-- FOOTER -->
        <div class="max-w-7xl mx-auto mt-10 text-center">
            <p class="text-zinc-800 text-[9px] uppercase tracking-[0.5em]" style="font-family:'Space Mono',monospace;">
                Voidx Elite Selection · Personnel Terminal · encrypted_link_active
            </p>
        </div>
    </div>
</x-app-layout>
