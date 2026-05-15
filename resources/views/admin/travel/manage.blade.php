<x-app-layout>
    <style>
        .text-gold { color: #d4af37 !important; }
        .bg-gold { background-color: #d4af37 !important; }
        .glass-card {
            background: rgba(15, 15, 15, 0.9) !important;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 175, 85, 0.1);
        }
        /* Custom Radio Styling */
        .category-radio:checked + .category-card {
            border-color: #d4af37 !important;
            background: rgba(212, 175, 85, 0.1) !important;
        }
        .category-radio:checked + .category-card i, 
        .category-radio:checked + .category-card span {
            color: #d4af37 !important;
        }
    </style>

    <div class="min-h-screen bg-[#080808] text-white p-4 md:p-8">
        <div class="max-w-4xl mx-auto">
            
            <div class="mb-10 flex justify-between items-end">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-zinc-500 hover:text-gold text-xs uppercase tracking-widest flex items-center gap-2 mb-4 transition-all">
                        <i class='bx bx-left-arrow-alt'></i> Back to Command Center
                    </a>
                    <h2 class="text-4xl font-black uppercase tracking-tighter text-white">
                        Secure New <span class="text-gold italic">Asset</span>
                    </h2>
                    <p class="text-zinc-600 text-[10px] uppercase tracking-[0.3em] mt-2">Inventory Input Terminal • Authorized Personnel Only</p>
                </div>
            </div>

            <form action="{{ route('travel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="glass-card p-6 rounded-3xl">
                    <label class="block text-gold text-[10px] font-black uppercase tracking-[0.4em] mb-6">00. Asset Classification</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(['Travel', 'Vehicle', 'Food'] as $cat)
                        <label class="cursor-pointer relative">
                            <input type="radio" name="category" value="{{ $cat }}" class="hidden category-radio main-category" {{ $cat == 'Travel' ? 'checked' : '' }} required>
                            <div class="category-card p-4 bg-black/40 border border-zinc-800 rounded-2xl text-center transition-all hover:border-zinc-500">
                                <i class='bx {{ $cat == "Travel" ? "bx-map-alt" : ($cat == "Vehicle" ? "bx-car" : "bx-dish") }} text-2xl mb-2 text-zinc-500'></i>
                                <span class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400">{{ $cat }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="glass-card p-6 rounded-3xl">
                    <label class="block text-gold text-[10px] font-black uppercase tracking-[0.4em] mb-6">01. Select Asset Type / Environment</label>
                    <div id="sub-category-container" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        </div>
                </div>

                <div class="glass-card p-6 rounded-3xl">
                    <label class="block text-gold text-[10px] font-black uppercase tracking-[0.4em] mb-6">02. Asset Visual Briefing</label>
                    <div class="flex flex-col items-center">
                        <div id="preview-container" class="w-full h-64 bg-black/50 border-2 border-dashed border-zinc-800 rounded-2xl overflow-hidden flex items-center justify-center mb-4 relative group">
                            <img id="image-preview" class="hidden w-full h-full object-cover">
                            <div id="placeholder-text" class="text-center">
                                <i class='bx bx-cloud-upload text-5xl text-zinc-700 group-hover:text-gold transition-colors'></i>
                                <p class="text-zinc-600 text-[10px] uppercase font-bold mt-2">Click to upload asset photo</p>
                            </div>
                            <input type="file" name="image" id="image-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" required>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-3xl space-y-6">
                    <label class="block text-gold text-[10px] font-black uppercase tracking-[0.4em] mb-2">03. Intelligence Details</label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase text-zinc-500 font-bold mb-2">Asset Name</label>
                            <input type="text" name="name" required class="w-full bg-black/50 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:border-gold outline-none transition-all" placeholder="e.g. FAMILY VAN / LOMI OVERLOAD">
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase text-zinc-500 font-bold mb-2">Valuation (PHP)</label>
                            <input type="number" name="price" required class="w-full bg-black/50 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:border-gold outline-none transition-all" placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase text-zinc-500 font-bold mb-2">Description / Mission Briefing</label>
                        <textarea name="description" rows="3" required class="w-full bg-black/50 border border-zinc-800 rounded-xl px-4 py-3 text-white focus:border-gold outline-none transition-all" placeholder="Enter asset intelligence..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gold text-black font-black uppercase text-xs tracking-[0.2em] py-5 rounded-2xl hover:bg-white hover:scale-[1.01] active:scale-[0.99] transition-all">
                            Finalize & Deploy Asset
                        </button>
                    </div>
                </div>
            </form>

            <p class="text-center text-zinc-800 text-[9px] uppercase tracking-[0.5em] my-8 font-bold">
                Internal Mainframe Access Only • ID: {{ auth()->user()->id }}
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
                    <div class="category-card p-4 bg-black/40 border border-zinc-800 rounded-2xl text-center transition-all hover:border-zinc-500">
                        <i class='bx ${item.icon} text-2xl mb-2 text-zinc-500'></i>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400">${item.val}</span>
                    </div>
                `;
                subContainer.appendChild(label);
            });
        }

        // Initial Load
        updateSubCategories('Travel');

        // Event Listener for Category Change
        categoryRadios.forEach(radio => {
            radio.addEventListener('change', (e) => {
                updateSubCategories(e.target.value);
            });
        });

        // Image Preview Logic
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const placeholderText = document.getElementById('placeholder-text');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                placeholderText.classList.add('hidden');
                imagePreview.classList.remove('hidden');
                reader.addEventListener('load', function() {
                    imagePreview.setAttribute('src', this.result);
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>