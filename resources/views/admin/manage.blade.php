<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300;1,700&family=Space+Mono:wght@400;700&display=swap');

        :root {
            --gold: #c9a84c;
            --gold-light: #e8c97a;
            --gold-dim: rgba(201,168,76,0.12);
            --dark: #06080d;
            --surface: rgba(10,13,20,0.88);
            --border: rgba(201,168,76,0.12);
        }

        .text-gold { color: var(--gold) !important; }
        .bg-gold { background-color: var(--gold) !important; }

        body, .min-h-screen {
            background-color: var(--dark) !important;
        }

        /* ── BACKGROUND ── */
        .cin-bg {
            position: fixed; inset: 0; z-index: 0; overflow: hidden;
        }
        .cin-bg::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 90% 70% at 10% 10%, rgba(201,168,76,0.06) 0%, transparent 55%),
                radial-gradient(ellipse 70% 90% at 90% 90%, rgba(20,50,120,0.1) 0%, transparent 55%),
                linear-gradient(160deg, #06080e 0%, #08080f 50%, #060a0d 100%);
        }
        .cin-bg::after {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            bottom: -200px; left: -100px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.04) 0%, transparent 70%);
            animation: orb2 14s ease-in-out infinite alternate;
        }
        @keyframes orb2 {
            from { transform: translate(0,0); }
            to   { transform: translate(60px,-40px); }
        }
        .grid-overlay {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(201,168,76,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }
        .scanlines {
            position: fixed; inset: 0; z-index: 0;
            background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.06) 2px, rgba(0,0,0,0.06) 4px);
            pointer-events: none;
        }
        .page-content { position: relative; z-index: 1; }

        /* ── GLASS ── */
        .glass-card {
            background: var(--surface) !important;
            backdrop-filter: blur(20px) saturate(1.4);
            border: 1px solid var(--border) !important;
            position: relative;
            overflow: hidden;
        }
        .glass-card::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(201,168,76,0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        /* ── CATEGORY CARDS ── */
        .category-radio:checked + .category-card {
            border-color: var(--gold) !important;
            background: rgba(201,168,76,0.08) !important;
            box-shadow: 0 0 20px rgba(201,168,76,0.1);
        }
        .category-radio:checked + .category-card .cat-icon,
        .category-radio:checked + .category-card .cat-label {
            color: var(--gold) !important;
        }
        .category-card {
            transition: all 0.3s ease;
        }
        .category-card:hover {
            border-color: rgba(201,168,76,0.3) !important;
            transform: translateY(-2px);
        }

        /* ── INPUTS ── */
        input, textarea, select {
            color: white !important;
            background-color: rgba(0, 0, 0, 0.4) !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 12px !important;
            transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
        }
        input:focus, textarea:focus {
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.08) !important;
            outline: none !important;
        }
        input::placeholder, textarea::placeholder {
            color: #3a3a3a !important;
            font-size: 11px !important;
        }

        /* ── UPLOAD ZONE ── */
        #preview-container {
            transition: border-color 0.3s ease, background 0.3s ease;
        }
        #preview-container:hover {
            border-color: rgba(201,168,76,0.4) !important;
            background: rgba(201,168,76,0.02) !important;
        }

        /* ── SUBMIT BUTTON ── */
        .btn-submit {
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            font-family: 'Space Mono', monospace;
        }
        .btn-submit::after {
            content: '';
            position: absolute; inset: 0;
            background: white;
            transform: translateY(105%);
            transition: transform 0.35s cubic-bezier(0.16,1,0.3,1);
        }
        .btn-submit:hover::after { transform: translateY(0); }
        .btn-submit:hover {
            color: black !important;
            box-shadow: 0 10px 40px rgba(201,168,76,0.25);
        }
        .btn-submit:active { transform: scale(0.99); }
        .btn-submit span { position: relative; z-index: 1; }

        /* ── STEP LABEL ── */
        .step-label {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            letter-spacing: 0.4em;
            color: var(--gold);
            text-transform: uppercase;
            font-weight: 700;
        }

        /* ── FADE UP ── */
        .fade-up { opacity: 0; transform: translateY(16px); animation: fadeUp 0.6s ease forwards; }
        @keyframes fadeUp { to { opacity:1; transform:translateY(0); } }
        .delay-1 { animation-delay: 0.08s; }
        .delay-2 { animation-delay: 0.16s; }
        .delay-3 { animation-delay: 0.24s; }
        .delay-4 { animation-delay: 0.32s; }
        .delay-5 { animation-delay: 0.40s; }

        /* Corner deco */
        .corner-deco { position: absolute; width: 32px; height: 32px; border-color: rgba(201,168,76,0.25); border-style: solid; }
        .corner-deco.tl { top: 14px; left: 14px; border-width: 1px 0 0 1px; }
        .corner-deco.br { bottom: 14px; right: 14px; border-width: 0 1px 1px 0; }

        /* Rule line */
        .rule-line { display: inline-block; width: 28px; height: 1px; background: var(--gold); vertical-align: middle; margin-right: 8px; }
    </style>

    <!-- BG LAYERS -->
    <div class="cin-bg"></div>
    <div class="grid-overlay"></div>
    <div class="scanlines"></div>

    <div class="page-content min-h-screen text-white p-4 md:p-8" style="background:transparent !important;">
        <div class="max-w-4xl mx-auto">

            <!-- HEADER -->
            <div class="mb-10 fade-up">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-zinc-600 hover:text-gold transition-colors text-[9px] uppercase tracking-[0.4em] mb-5 group" style="font-family:'Space Mono',monospace;">
                    <i class='bx bx-left-arrow-alt group-hover:-translate-x-1 transition-transform'></i>
                    Back to Command Center
                </a>
                <p class="text-[9px] uppercase tracking-[0.5em] text-zinc-600 mb-3" style="font-family:'Space Mono',monospace;">
                    <span class="rule-line"></span>Inventory Input Terminal
                </p>
                <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.2rem,5vw,3.5rem); font-weight:300; line-height:1.1; letter-spacing:-0.01em;">
                    Secure New<br>
                    <em style="color:var(--gold); font-weight:700;">Asset</em>
                </h1>
                <p class="text-zinc-700 text-[9px] uppercase tracking-[0.4em] mt-2" style="font-family:'Space Mono',monospace;">Authorized Personnel Only</p>
            </div>

            <form action="{{ route('travel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- 00. CATEGORY -->
                <div class="glass-card p-6 rounded-2xl fade-up delay-1">
                    <div class="corner-deco tl"></div>
                    <p class="step-label mb-5">00 · Asset Classification</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(['Travel', 'Vehicle', 'Food'] as $cat)
                        <label class="cursor-pointer relative">
                            <input type="radio" name="category" value="{{ $cat }}" class="hidden category-radio main-category" {{ $cat == 'Travel' ? 'checked' : '' }} required>
                            <div class="category-card p-5 bg-black/30 border border-zinc-800 rounded-xl text-center">
                                <i class='bx {{ $cat == "Travel" ? "bx-map-alt" : ($cat == "Vehicle" ? "bx-car" : "bx-dish") }} text-2xl mb-2 text-zinc-600 cat-icon block'></i>
                                <span class="cat-label text-[9px] font-bold uppercase tracking-[0.25em] text-zinc-500" style="font-family:'Space Mono',monospace;">{{ $cat }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- 01. SUB-CATEGORY -->
                <div class="glass-card p-6 rounded-2xl fade-up delay-2">
                    <p class="step-label mb-5">01 · Asset Type / Environment</p>
                    <div id="sub-category-container" class="grid grid-cols-2 md:grid-cols-4 gap-3"></div>
                </div>

                <!-- 02. IMAGE -->
                <div class="glass-card p-6 rounded-2xl fade-up delay-3">
                    <p class="step-label mb-5">02 · Asset Visual Briefing</p>
                    <div id="preview-container" class="w-full h-60 bg-black/40 border-2 border-dashed border-zinc-800 rounded-xl overflow-hidden flex items-center justify-center relative group cursor-pointer">
                        <img id="image-preview" class="hidden w-full h-full object-cover">
                        <div id="placeholder-text" class="text-center pointer-events-none">
                            <i class='bx bx-cloud-upload text-5xl text-zinc-700 group-hover:text-gold transition-colors'></i>
                            <p class="text-[9px] uppercase tracking-[0.3em] text-zinc-600 mt-3 font-bold" style="font-family:'Space Mono',monospace;">Click to upload asset photo</p>
                        </div>
                        <input type="file" name="image" id="image-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" required>
                    </div>
                </div>

                <!-- 03. DETAILS -->
                <div class="glass-card p-7 rounded-2xl fade-up delay-4">
                    <div class="corner-deco br"></div>
                    <p class="step-label mb-6">03 · Intelligence Details</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-[9px] uppercase tracking-[0.3em] text-zinc-500 mb-2 font-bold" style="font-family:'Space Mono',monospace;">Asset Name</label>
                            <input type="text" name="name" required
                                class="w-full border border-zinc-800 rounded-xl px-4 py-3"
                                placeholder="e.g. FAMILY VAN / LOMI OVERLOAD">
                        </div>
                        <div>
                            <label class="block text-[9px] uppercase tracking-[0.3em] text-zinc-500 mb-2 font-bold" style="font-family:'Space Mono',monospace;">Valuation (PHP)</label>
                            <input type="number" name="price" required
                                class="w-full border border-zinc-800 rounded-xl px-4 py-3"
                                placeholder="0.00">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-[9px] uppercase tracking-[0.3em] text-zinc-500 mb-2 font-bold" style="font-family:'Space Mono',monospace;">Description / Mission Briefing</label>
                        <textarea name="description" rows="3" required
                            class="w-full border border-zinc-800 rounded-xl px-4 py-3 resize-none"
                            placeholder="Enter asset intelligence..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit w-full py-5 rounded-xl font-bold uppercase text-[10px] tracking-[0.25em]" style="background:var(--gold); color:black;">
                        <span>Finalize & Deploy Asset</span>
                    </button>
                </div>
            </form>

            <p class="text-center text-zinc-800 text-[9px] uppercase tracking-[0.5em] my-8 font-bold" style="font-family:'Space Mono',monospace;">
                Internal Mainframe Access Only · ID: {{ auth()->user()->id }}
            </p>
        </div>
    </div>

    <script>
        const subCategoryData = {
            'Travel': [
                { val: 'Mountain', icon: 'bx-landscape' },
                { val: 'Resort', icon: 'bx-pool' },
                { val: 'City', icon: 'bx-buildings' },
                { val: 'Beach', icon: 'bx-sun' }
            ],
            'Vehicle': [
                { val: 'Family Van', icon: 'bx-bus' },
                { val: 'SUV', icon: 'bx-car' },
                { val: 'Sedan', icon: 'bx-car' },
                { val: 'Motorcycle', icon: 'bx-cycling' }
            ],
            'Food': [
                { val: 'Street Food', icon: 'bx-store' },
                { val: 'Fine Dining', icon: 'bx-wine' },
                { val: 'Local Delicacy', icon: 'bx-dish' },
                { val: 'Cafe', icon: 'bx-coffee' }
            ]
        };

        const subContainer = document.getElementById('sub-category-container');
        const categoryRadios = document.querySelectorAll('.main-category');

        function updateSubCategories(category) {
            subContainer.innerHTML = '';
            subCategoryData[category].forEach(item => {
                const label = document.createElement('label');
                label.className = 'cursor-pointer relative';
                label.innerHTML = `
                    <input type="radio" name="sub_category" value="${item.val}" class="hidden category-radio" required>
                    <div class="category-card p-4 bg-black/30 border border-zinc-800 rounded-xl text-center">
                        <i class='bx ${item.icon} text-xl mb-2 text-zinc-600 cat-icon block'></i>
                        <span class="cat-label text-[9px] font-bold uppercase tracking-widest text-zinc-500" style="font-family:'Space Mono',monospace;">${item.val}</span>
                    </div>
                `;
                subContainer.appendChild(label);
            });
        }

        updateSubCategories('Travel');
        categoryRadios.forEach(r => r.addEventListener('change', e => updateSubCategories(e.target.value)));

        // Image preview
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const placeholderText = document.getElementById('placeholder-text');
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    placeholderText.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                    imagePreview.setAttribute('src', this.result);
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
