@php
$fullname = Auth::user()->fullname ?? Auth::user()->name ?? "Elite Traveller";
$user_email = Auth::user()->email ?? ""; 
$user_phone = Auth::user()->phone ?? "";

$profile_pic = (Auth::user() && Auth::user()->profile_pic) 
    ? asset('storage/' . Auth::user()->profile_pic) 
    : "https://ui-avatars.com/api/?name=" . urlencode($fullname) . "&background=000&color=c9a84c";

if(!isset($items) || $items->isEmpty()){
    $items = collect([
        (object)['id'=>99,'name'=>'Amanpulo Private Island','category'=>'Travel','price'=>150000,'description'=>'Ultra-exclusive island getaway in Palawan — secluded, pristine, elite.','image_url'=>'https://images.unsplash.com/photo-1544161515-4af6b1d462c2','sub_category'=>'Beach'],
        (object)['id'=>107,'name'=>'El Nido Hideaway','category'=>'Travel','price'=>85000,'description'=>'Hidden coves and crystal waters in El Nido, Palawan.','image_url'=>'https://images.unsplash.com/photo-1519046904884-53103b34b206','sub_category'=>'Beach'],
        (object)['id'=>108,'name'=>'Siargao Surf Estate','category'=>'Travel','price'=>65000,'description'=>'World-class waves and island luxury in Siargao.','image_url'=>'https://images.unsplash.com/photo-1501854140801-50d01698950b','sub_category'=>'Beach'],
        (object)['id'=>102,'name'=>'Baguio Peak Estate','category'=>'Travel','price'=>75000,'description'=>'Mountain view luxury estate with cool pine-scented air.','image_url'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b','sub_category'=>'Mountain'],
        (object)['id'=>109,'name'=>'Sagada Highlands Retreat','category'=>'Travel','price'=>55000,'description'=>'Misty mountains, hanging coffins, and total serenity.','image_url'=>'https://images.unsplash.com/photo-1506905925346-21bda4d32df4','sub_category'=>'Mountain'],
        (object)['id'=>103,'name'=>'Boracay Grand Resort','category'=>'Travel','price'=>95000,'description'=>'World-class beachfront resort in Boracay — pure indulgence.','image_url'=>'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4','sub_category'=>'Resort'],
        (object)['id'=>110,'name'=>'Shangri-La Mactan','category'=>'Travel','price'=>120000,'description'=>'Five-star private island resort in Cebu.','image_url'=>'https://images.unsplash.com/photo-1571896349842-33c89424de2d','sub_category'=>'Resort'],
        (object)['id'=>104,'name'=>'BGC City Escape','category'=>'Travel','price'=>45000,'description'=>'Urban luxury in the heart of Bonifacio Global City.','image_url'=>'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df','sub_category'=>'City'],
        (object)['id'=>111,'name'=>'Manila Bay Penthouse','category'=>'Travel','price'=>88000,'description'=>'Sunset views and skyline luxury in Manila Bay.','image_url'=>'https://images.unsplash.com/photo-1534430480872-3498386e7856','sub_category'=>'City'],
        (object)['id'=>100,'name'=>'Rolls-Royce Phantom','category'=>'Vehicle','price'=>85000,'description'=>'The pinnacle of luxury ground transport — effortless power.','image_url'=>'https://images.unsplash.com/photo-1631214499551-739c9a008431','sub_category'=>'Sedan'],
        (object)['id'=>112,'name'=>'Mercedes S-Class','category'=>'Vehicle','price'=>45000,'description'=>'German engineering meets first-class comfort.','image_url'=>'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8','sub_category'=>'Sedan'],
        (object)['id'=>105,'name'=>'Range Rover Vogue','category'=>'Vehicle','price'=>55000,'description'=>'Commanding presence and capability on any terrain.','image_url'=>'https://images.unsplash.com/photo-1617469767796-f778aff9f0e8','sub_category'=>'SUV'],
        (object)['id'=>113,'name'=>'Toyota Land Cruiser GR','category'=>'Vehicle','price'=>35000,'description'=>'Ultimate off-road luxury for the bold adventurer.','image_url'=>'https://images.unsplash.com/photo-1559416523-140ddc3d238c','sub_category'=>'SUV'],
        (object)['id'=>114,'name'=>'Toyota Hi-Ace Super Grandia','category'=>'Vehicle','price'=>18000,'description'=>'Premium family van — spacious, comfortable, elite.','image_url'=>'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957','sub_category'=>'Family Van'],
        (object)['id'=>115,'name'=>'Mercedes Sprinter VIP','category'=>'Vehicle','price'=>28000,'description'=>'Executive group transport with conference-room comfort.','image_url'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64','sub_category'=>'Family Van'],
        (object)['id'=>116,'name'=>'Harley-Davidson Fat Boy','category'=>'Vehicle','price'=>12000,'description'=>'Iconic American iron — ride in legendary style.','image_url'=>'https://images.unsplash.com/photo-1558980664-769d59546b3d','sub_category'=>'Motorcycle'],
        (object)['id'=>101,'name'=>'Wagyu Gold Steak','category'=>'Food','price'=>12000,'description'=>'24k Gold leaf wagyu — curated by Michelin-star executive chefs.','image_url'=>'https://images.unsplash.com/photo-1546241072-48010ad28c2c','sub_category'=>'Fine Dining'],
        (object)['id'=>117,'name'=>'Omakase Kaiseki Experience','category'=>'Food','price'=>9500,'description'=>'Japanese multi-course perfection, ingredient by ingredient.','image_url'=>'https://images.unsplash.com/photo-1579871494447-9811cf80d66c','sub_category'=>'Fine Dining'],
        (object)['id'=>106,'name'=>'Cebu Lechon Fiesta Platter','category'=>'Food','price'=>3500,'description'=>'Authentic Cebuano lechon — the best roast pig in the world.','image_url'=>'https://images.unsplash.com/photo-1555126634-323283e090fa','sub_category'=>'Local Delicacy'],
        (object)['id'=>118,'name'=>'Ilocos Empanada Set','category'=>'Food','price'=>1200,'description'=>'Crispy, golden, and filled with authentic Ilocano flavor.','image_url'=>'https://images.unsplash.com/photo-1565299585323-38d6b0865b47','sub_category'=>'Local Delicacy'],
        (object)['id'=>119,'name'=>'Mercato Street Food Tour','category'=>'Food','price'=>2500,'description'=>'A guided crawl through the best street food in Manila.','image_url'=>'https://images.unsplash.com/photo-1504674900247-0877df9cc836','sub_category'=>'Street Food'],
        (object)['id'=>120,'name'=>'Manila Chinatown Night Walk','category'=>'Food','price'=>1800,'description'=>'Binondo — the world\'s oldest Chinatown, one bite at a time.','image_url'=>'https://images.unsplash.com/photo-1563245372-f21724e3856d','sub_category'=>'Street Food'],
        (object)['id'=>121,'name'=>'Artisan Brew Café','category'=>'Food','price'=>800,'description'=>'Single-origin Philippine coffee, roasted and brewed to perfection.','image_url'=>'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085','sub_category'=>'Cafe'],
        (object)['id'=>122,'name'=>'Sagada Sunset Café','category'=>'Food','price'=>1200,'description'=>'Mountain-grown Arabica with a view that takes your breath away.','image_url'=>'https://images.unsplash.com/photo-1442512595331-e89e73853f31','sub_category'=>'Cafe'],
    ]);
}

if (!function_exists('getImagePath')) {
    function getImagePath($path) {
        if (empty($path)) return 'https://placehold.co/600x800/080808/c9a84c?text=No+Image';
        if (strpos($path, 'http') === 0) return $path;
        return asset('storage/' . str_replace('uploads/', '', $path));
    }
}

$subMeta = [
    'Beach'        => ['icon'=>'bx-sun',        'color'=>'#38bdf8','label'=>'Beach Destinations',   'desc'=>'Sun, sand, and crystal-clear waters await.'],
    'Mountain'     => ['icon'=>'bx-landscape',  'color'=>'#86efac','label'=>'Mountain Escapes',      'desc'=>'Peak views and cool highland serenity.'],
    'Resort'       => ['icon'=>'bx-pool',       'color'=>'#c4b5fd','label'=>'Luxury Resorts',        'desc'=>'World-class amenities, total indulgence.'],
    'City'         => ['icon'=>'bx-buildings',  'color'=>'#fbbf24','label'=>'City Experiences',      'desc'=>'Urban luxury at the heart of the action.'],
    'Sedan'        => ['icon'=>'bx-car',        'color'=>'#f472b6','label'=>'Luxury Sedans',         'desc'=>'Executive comfort, effortless elegance.'],
    'SUV'          => ['icon'=>'bx-car',        'color'=>'#34d399','label'=>'Premium SUVs',          'desc'=>'Command the road in power and style.'],
    'Family Van'   => ['icon'=>'bx-bus',        'color'=>'#60a5fa','label'=>'Family & Group Vans',   'desc'=>'Spacious luxury for the whole crew.'],
    'Motorcycle'   => ['icon'=>'bx-cycling',    'color'=>'#fb923c','label'=>'Motorcycles',           'desc'=>'Feel the road — freedom on two wheels.'],
    'Fine Dining'  => ['icon'=>'bx-wine',       'color'=>'#f59e0b','label'=>'Fine Dining',           'desc'=>'Michelin-worthy experiences on every plate.'],
    'Local Delicacy'=>['icon'=>'bx-dish',       'color'=>'#a78bfa','label'=>'Local Delicacies',      'desc'=>'Authentic Filipino flavors, elevated.'],
    'Street Food'  => ['icon'=>'bx-store',      'color'=>'#fb7185','label'=>'Street Food',           'desc'=>'Bold, honest, and unforgettably local.'],
    'Cafe'         => ['icon'=>'bx-coffee',     'color'=>'#92400e','label'=>'Cafés',                 'desc'=>'Single-origin brews and artisan experiences.'],
];

// ── PROMOS: pull active, non-expired promos from DB ──
$promos = collect();
try {
    $promos = \App\Models\Promo::where('is_active', true)
        ->where(function($q){ 
            $q->whereNull('valid_until')->orWhere('valid_until', '>=', now()); 
        })
        ->latest()
        ->get();
} catch(\Exception $e) {
    // Table may not exist yet — silently ignore
}

// Category images used when promo has no custom image_url
$promoCategoryImages = [
    'Travel'       => 'https://images.unsplash.com/photo-1544161515-4af6b1d462c2?w=700&q=80',
    'Destination'  => 'https://images.unsplash.com/photo-1544161515-4af6b1d462c2?w=700&q=80',
    'Beach'        => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?w=700&q=80',
    'Mountain'     => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=700&q=80',
    'Resort'       => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=700&q=80',
    'City'         => 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=700&q=80',
    'Vehicle'      => 'https://images.unsplash.com/photo-1631214499551-739c9a008431?w=700&q=80',
    'Sedan'        => 'https://images.unsplash.com/photo-1631214499551-739c9a008431?w=700&q=80',
    'SUV'          => 'https://images.unsplash.com/photo-1617469767796-f778aff9f0e8?w=700&q=80',
    'Motorcycle'   => 'https://images.unsplash.com/photo-1558980664-769d59546b3d?w=700&q=80',
    'Family Van'   => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=700&q=80',
    'Food'         => 'https://images.unsplash.com/photo-1546241072-48010ad28c2c?w=700&q=80',
    'Fine Dining'  => 'https://images.unsplash.com/photo-1546241072-48010ad28c2c?w=700&q=80',
    'Local Delicacy'=> 'https://images.unsplash.com/photo-1555126634-323283e090fa?w=700&q=80',
    'Street Food'  => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=700&q=80',
    'Cafe'         => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=700&q=80',
    'default'      => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=700&q=80',
];

$promoCategoryIcons = [
    'Travel'        => 'bx-map-alt',
    'Destination'   => 'bx-map-alt',
    'Beach'         => 'bx-sun',
    'Mountain'      => 'bx-landscape',
    'Resort'        => 'bx-pool',
    'City'          => 'bx-buildings',
    'Vehicle'       => 'bx-car',
    'Sedan'         => 'bx-car',
    'SUV'           => 'bx-car',
    'Motorcycle'    => 'bx-cycling',
    'Family Van'    => 'bx-bus',
    'Food'          => 'bx-dish',
    'Fine Dining'   => 'bx-wine',
    'Local Delicacy'=> 'bx-dish',
    'Street Food'   => 'bx-store',
    'Cafe'          => 'bx-coffee',
    'default'       => 'bx-star',
];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VoidX | Traveller Portal</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300;1,700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
:root {
    --gold: #c9a84c; --gold-light: #e8c97a;
    --gold-dim: rgba(201,168,76,0.12);
    --dark: #06080d; --surface: rgba(10,13,20,0.88);
    --border: rgba(201,168,76,0.12); --muted: #52525b;
}
*,::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--dark);color:#e4e4e7;font-family:'Space Mono',monospace;scroll-behavior:smooth;overflow-x:hidden;}

/* ── BACKGROUND ── */
.cin-bg{position:fixed;inset:0;z-index:0;overflow:hidden;pointer-events:none;}
.cin-bg::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 15% 20%,rgba(201,168,76,.07) 0%,transparent 60%),radial-gradient(ellipse 60% 80% at 85% 80%,rgba(30,60,120,.12) 0%,transparent 60%),linear-gradient(160deg,#060810 0%,#080c14 40%,#060a0f 100%);}
.cin-bg::after{content:'';position:absolute;width:700px;height:700px;top:-150px;right:-200px;border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,.06) 0%,transparent 70%);animation:orb-drift 14s ease-in-out infinite alternate;}
@keyframes orb-drift{from{transform:translate(0,0) scale(1);}to{transform:translate(-40px,60px) scale(1.12);}}
.cin-orb2{position:fixed;width:600px;height:600px;bottom:-200px;left:-100px;border-radius:50%;background:radial-gradient(circle,rgba(20,60,140,.08) 0%,transparent 70%);animation:orb2 18s ease-in-out infinite alternate;pointer-events:none;z-index:0;}
@keyframes orb2{from{transform:scale(1);}to{transform:scale(1.15) translate(40px,-30px);}}
.grid-overlay{position:fixed;inset:0;z-index:0;pointer-events:none;background-image:linear-gradient(rgba(201,168,76,.025) 1px,transparent 1px),linear-gradient(90deg,rgba(201,168,76,.025) 1px,transparent 1px);background-size:60px 60px;}
.scanlines{position:fixed;inset:0;z-index:0;pointer-events:none;background:repeating-linear-gradient(0deg,transparent,transparent 2px,rgba(0,0,0,.07) 2px,rgba(0,0,0,.07) 4px);}
.page-wrap{position:static;z-index:auto;}

/* ── MODAL Z-INDEX FIX ── */
.modal{z-index:99999!important;}
.modal-backdrop{z-index:99998!important;}
.modal-dialog{z-index:100000!important;position:relative;}
.modal-content{position:relative;z-index:100001!important;background:rgba(8,10,16,.99)!important;border:1px solid var(--border)!important;border-radius:24px!important;overflow:hidden;}
#itinerary-bar{z-index:9990!important;}
#backToTop{z-index:9990!important;}

/* ── NAVBAR ── */
.vx-navbar{position:sticky;top:0;z-index:9995;padding:14px 0;background:rgba(6,8,13,.98);border-bottom:1px solid var(--border);}
.vx-brand{font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:700;letter-spacing:6px;color:var(--gold)!important;text-decoration:none;font-style:italic;}
.vx-brand span{color:#e4e4e7;font-style:normal;}
.nav-avatar{width:40px;height:40px;border-radius:50%;object-fit:cover;border:1px solid rgba(201,168,76,.4);cursor:pointer;transition:border-color .3s,box-shadow .3s;}
.nav-avatar:hover{border-color:var(--gold);box-shadow:0 0 16px rgba(201,168,76,.25);}
.user-tier{font-size:8px;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;font-weight:700;}
.pulse-dot{display:inline-block;width:7px;height:7px;border-radius:50%;background:#22c55e;animation:pulse-ring 2s ease-out infinite;margin-right:4px;vertical-align:middle;}
@keyframes pulse-ring{0%{box-shadow:0 0 0 0 rgba(34,197,94,.5);}70%{box-shadow:0 0 0 6px rgba(34,197,94,0);}100%{box-shadow:0 0 0 0 rgba(34,197,94,0);}}
.admin-peek-btn{display:inline-flex;align-items:center;gap:6px;font-size:9px;letter-spacing:.2em;text-transform:uppercase;font-weight:700;color:var(--gold);background:var(--gold-dim);border:1px solid rgba(201,168,76,.25);border-radius:20px;padding:5px 14px;text-decoration:none;transition:all .25s;}
.admin-peek-btn:hover{background:rgba(201,168,76,.2);color:var(--gold-light);}
.dropdown-menu{background:rgba(8,10,16,.99)!important;border:1px solid var(--border)!important;border-radius:16px!important;padding:8px!important;min-width:200px;}
.dropdown-item{border-radius:10px!important;font-size:11px!important;letter-spacing:.08em;padding:10px 14px!important;color:#a1a1aa!important;transition:all .2s;}
.dropdown-item:hover{background:var(--gold-dim)!important;color:var(--gold)!important;}
.dropdown-item.text-danger{color:#f87171!important;}
.dropdown-item.text-danger:hover{background:rgba(248,113,113,.08)!important;}
.dropdown-divider{border-color:var(--border)!important;}

/* ── HERO ── */
.vx-hero{padding:60px 0 30px;}
.hero-eyebrow{font-size:9px;letter-spacing:.5em;color:var(--muted);text-transform:uppercase;margin-bottom:12px;}
.hero-eyebrow span.rule{display:inline-block;width:28px;height:1px;background:var(--gold);vertical-align:middle;margin-right:10px;}
.hero-title{font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,8vw,5.5rem);font-weight:300;line-height:1;letter-spacing:-.02em;color:white;}
.hero-title em{color:var(--gold);font-weight:700;}
.hero-sub{font-size:9px;letter-spacing:.35em;color:var(--muted);text-transform:uppercase;margin-top:10px;}

/* ── CAT NAV ── */
.cat-nav-wrapper{position:sticky;top:69px;z-index:9994;padding:14px 0;background:rgba(6,8,13,.98);border-bottom:1px solid rgba(201,168,76,.06);}
.btn-pill{padding:9px 22px;border-radius:50px;border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);color:#71717a;font-size:9px;font-weight:700;letter-spacing:.2em;transition:all .3s;text-transform:uppercase;white-space:nowrap;cursor:pointer;font-family:'Space Mono',monospace;}
.btn-pill.active,.btn-pill:hover{background:var(--gold);color:#000;border-color:var(--gold);box-shadow:0 4px 20px rgba(201,168,76,.2);}
.search-wrap{position:relative;}
.search-wrap i{position:absolute;top:50%;left:14px;transform:translateY(-50%);color:var(--gold);opacity:.5;font-size:13px;pointer-events:none;}
.vx-search{width:100%;background:rgba(0,0,0,.5)!important;border:1px solid rgba(201,168,76,.15)!important;border-radius:50px!important;padding:10px 16px 10px 38px!important;color:white!important;font-family:'Space Mono',monospace!important;font-size:11px!important;transition:border-color .3s!important;outline:none;}
.vx-search:focus{border-color:rgba(201,168,76,.4)!important;}
.vx-search::placeholder{color:#3a3a3a!important;}

/* ── VIEWS: MAIN / SUB-PAGE ── */
#view-main{display:block;}
#view-subpage{display:none;}

/* ── SECTION HEADERS ── */
.luxury-section{padding-top:60px;}
.section-head{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:28px;flex-wrap:wrap;gap:14px;}
.section-title-vx{font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:var(--gold);font-style:italic;position:relative;padding-left:18px;}
.section-title-vx::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:70%;background:var(--gold);border-radius:2px;}
.section-num{font-family:'Cormorant Garamond',serif;font-size:.75rem;color:var(--muted);display:block;margin-bottom:2px;font-style:normal;letter-spacing:.2em;}

/* ── SUB-FILTER ── */
.sub-filter-btn{padding:5px 14px;font-size:9px;letter-spacing:.15em;border:1px solid rgba(255,255,255,.08);background:transparent;color:#71717a;border-radius:6px;transition:all .25s;margin-right:5px;text-transform:uppercase;cursor:pointer;font-family:'Space Mono',monospace;}
.sub-filter-btn.active{background:var(--gold-dim);color:var(--gold);border-color:rgba(201,168,76,.3);}
.sub-filter-btn:hover{color:var(--gold);border-color:rgba(201,168,76,.2);}

/* ── PROMO CARDS ── */
.promo-card-vx{border-radius:20px;border:1px solid var(--border);overflow:hidden;position:relative;height:340px;cursor:pointer;transition:transform .4s cubic-bezier(.4,0,.2,1),border-color .3s,box-shadow .4s;background:rgba(10,13,20,.7);}
.promo-card-vx:hover{transform:translateY(-10px);border-color:rgba(201,168,76,.6);box-shadow:0 20px 60px rgba(0,0,0,.6),0 0 40px rgba(201,168,76,.1);}
.promo-img-wrap-vx{position:absolute;inset:0;}
.promo-img-vx{width:100%;height:100%;object-fit:cover;filter:brightness(.4) saturate(.8);transition:transform 1.2s cubic-bezier(.4,0,.2,1),filter .6s;}
.promo-card-vx:hover .promo-img-vx{transform:scale(1.08);filter:brightness(.65) saturate(1.1);}
.promo-overlay-vx{position:absolute;inset:0;background:linear-gradient(to top,rgba(6,8,13,.97) 0%,rgba(6,8,13,.55) 50%,transparent 100%);padding:20px 22px 22px;display:flex;flex-direction:column;justify-content:space-between;}
.promo-cat-badge-vx{font-size:8px;letter-spacing:.2em;text-transform:uppercase;font-weight:700;padding:5px 12px;border-radius:20px;background:rgba(201,168,76,.15);border:1px solid rgba(201,168,76,.3);color:var(--gold);display:inline-flex;align-items:center;gap:5px;}
.promo-discount-pill-vx{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:700;color:#000;background:var(--gold);padding:3px 14px;border-radius:30px;line-height:1;white-space:nowrap;}
.promo-discount-pill-vx small{font-family:'Space Mono',monospace;font-size:.65rem;font-weight:700;}
.promo-title-vx{font-family:'Cormorant Garamond',serif;font-size:1.35rem;font-weight:700;color:white;margin-bottom:6px;line-height:1.2;}
.promo-desc-vx{font-size:10px;color:#71717a;margin-bottom:14px;line-height:1.6;letter-spacing:.04em;}
.promo-footer-vx{display:flex;justify-content:space-between;align-items:center;}
.promo-valid-vx{font-size:8px;letter-spacing:.15em;text-transform:uppercase;color:var(--muted);}
.promo-cta-vx{font-size:8px;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:var(--gold);background:var(--gold-dim);border:1px solid rgba(201,168,76,.25);border-radius:20px;padding:5px 14px;cursor:pointer;transition:all .2s;font-family:'Space Mono',monospace;}
.promo-cta-vx:hover{background:rgba(201,168,76,.25);}
.promo-shine{position:absolute;inset:0;background:linear-gradient(105deg,transparent 40%,rgba(201,168,76,.04) 50%,transparent 60%);pointer-events:none;}

/* ── SUB-CATEGORY PICKER CARDS ── */
.subcat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-top:8px;}
.subcat-picker-card{background:rgba(10,13,20,.8);border:1px solid var(--border);border-radius:20px;padding:28px 20px;cursor:pointer;transition:all .35s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden;text-align:center;}
.subcat-picker-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(201,168,76,.04) 0%,transparent 60%);pointer-events:none;}
.subcat-picker-card:hover{transform:translateY(-6px);border-color:rgba(201,168,76,.5);box-shadow:0 16px 50px rgba(0,0,0,.5),0 0 30px rgba(201,168,76,.08);}
.subcat-picker-card .spc-icon{font-size:2.5rem;margin-bottom:14px;display:block;transition:transform .3s;}
.subcat-picker-card:hover .spc-icon{transform:scale(1.15);}
.subcat-picker-card .spc-name{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;font-style:italic;color:white;margin-bottom:6px;}
.subcat-picker-card .spc-desc{font-size:9px;letter-spacing:.1em;color:var(--muted);text-transform:uppercase;line-height:1.6;}
.subcat-picker-card .spc-count{position:absolute;top:14px;right:14px;font-size:8px;font-weight:700;letter-spacing:.15em;padding:3px 10px;border-radius:20px;background:var(--gold-dim);border:1px solid rgba(201,168,76,.2);color:var(--gold);}
.subcat-picker-card .spc-arrow{position:absolute;bottom:16px;right:16px;width:28px;height:28px;border-radius:50%;background:var(--gold-dim);border:1px solid rgba(201,168,76,.2);display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:13px;transition:all .3s;}
.subcat-picker-card:hover .spc-arrow{background:var(--gold);color:black;}

/* ── SUB-PAGE VIEW ── */
.subpage-header{padding:40px 0 24px;}
.back-btn{display:inline-flex;align-items:center;gap:8px;font-size:9px;font-weight:700;letter-spacing:.3em;text-transform:uppercase;color:var(--muted);background:none;border:none;cursor:pointer;font-family:'Space Mono',monospace;transition:color .25s;margin-bottom:20px;}
.back-btn:hover{color:var(--gold);}
.back-btn i{font-size:16px;transition:transform .25s;}
.back-btn:hover i{transform:translateX(-4px);}
.subpage-eyebrow{font-size:9px;letter-spacing:.4em;color:var(--muted);text-transform:uppercase;margin-bottom:8px;}
.subpage-title{font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,6vw,4rem);font-weight:300;line-height:1;letter-spacing:-.02em;color:white;}
.subpage-title em{font-weight:700;font-style:italic;}
.subpage-desc{font-size:10px;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-top:10px;}
.subpage-filter-row{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:32px;padding-bottom:20px;border-bottom:1px solid rgba(201,168,76,.06);}

/* ── LUXURY CARDS ── */
.luxury-card{background:rgba(10,13,20,.7);border-radius:20px;border:1px solid var(--border);overflow:hidden;transition:transform .4s cubic-bezier(.4,0,.2,1),border-color .4s,box-shadow .4s;cursor:pointer;position:relative;height:420px;backdrop-filter:blur(10px);}
.luxury-card:hover{transform:translateY(-10px);border-color:rgba(201,168,76,.5);box-shadow:0 20px 60px rgba(0,0,0,.6),0 0 40px rgba(201,168,76,.08);}
.img-viewport{height:100%;width:100%;position:relative;overflow:hidden;}
.item-img{width:100%;height:100%;object-fit:cover;transition:transform 1.2s cubic-bezier(.4,0,.2,1),filter .6s;filter:brightness(.65) saturate(.9);}
.luxury-card:hover .item-img{transform:scale(1.08);filter:brightness(.85) saturate(1.1);}
.card-overlay{position:absolute;bottom:0;left:0;right:0;padding:40px 22px 22px;background:linear-gradient(to top,rgba(6,8,13,.98) 0%,rgba(6,8,13,.7) 55%,transparent 100%);}
.card-corner{position:absolute;top:14px;right:14px;width:28px;height:28px;border-top:1px solid rgba(201,168,76,.4);border-right:1px solid rgba(201,168,76,.4);border-radius:0 6px 0 0;transition:opacity .3s;opacity:0;}
.luxury-card:hover .card-corner{opacity:1;}
.item-name{font-family:'Cormorant Garamond',serif;font-size:1.25rem;font-weight:700;color:white;margin-bottom:8px;letter-spacing:.01em;}
.item-price{font-family:'Cormorant Garamond',serif;font-size:1.4rem;font-weight:700;color:var(--gold);}
.item-badge{font-family:'Space Mono',monospace;font-size:8px;letter-spacing:.15em;padding:3px 10px;border-radius:4px;background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);color:var(--gold);text-transform:uppercase;}

/* ── NO RESULTS ── */
#no-results{padding:80px 0;text-align:center;}
.no-res-icon{font-size:4rem;color:var(--muted);margin-bottom:20px;}
.no-res-title{font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold);font-style:italic;margin-bottom:8px;}
.no-res-sub{font-size:10px;color:var(--muted);letter-spacing:.2em;text-transform:uppercase;margin-bottom:24px;}

/* ── BACK TO TOP ── */
#backToTop{position:fixed;bottom:110px;right:24px;width:44px;height:44px;background:var(--gold);color:#000;border-radius:50%;display:none;align-items:center;justify-content:center;cursor:pointer;font-size:13px;box-shadow:0 4px 20px rgba(201,168,76,.3);border:none;transition:transform .2s;}
#backToTop:hover{transform:scale(1.08);}

/* ── ITINERARY BAR ── */
#itinerary-bar{position:fixed;bottom:24px;right:24px;background:rgba(10,13,20,.97);border:1px solid rgba(201,168,76,.4);border-top:3px solid var(--gold);padding:16px 24px;border-radius:18px;display:none;cursor:pointer;box-shadow:0 20px 60px rgba(0,0,0,.6);transition:transform .2s;align-items:center;gap:20px;}
#itinerary-bar:hover{transform:translateY(-2px);}
#itinerary-bar.active{display:flex;}
.itin-label{font-size:8px;letter-spacing:.3em;text-transform:uppercase;color:var(--muted);margin-bottom:2px;}
.itin-count{font-size:11px;font-weight:700;color:white;}
.itin-total{font-family:'Cormorant Garamond',serif;font-size:1.4rem;font-weight:700;color:var(--gold);}
.cart-badge{width:18px;height:18px;background:#ef4444;color:white;font-size:8px;font-weight:700;border-radius:50%;display:flex;align-items:center;justify-content:center;position:absolute;top:-6px;right:-6px;}

/* ── MODAL INTERNALS ── */
.modal-luxury-img{width:100%;height:500px;object-fit:cover;display:block;}
.modal-body-vx{padding:40px;}
.modal-eyebrow{font-size:8px;letter-spacing:.4em;color:var(--gold);text-transform:uppercase;font-weight:700;margin-bottom:12px;}
.modal-title-vx{font-family:'Cormorant Garamond',serif;font-size:2rem;font-weight:700;color:white;margin-bottom:14px;line-height:1.1;}
.modal-desc{color:#71717a;font-size:11px;line-height:1.8;margin-bottom:20px;}
.price-label{font-size:8px;letter-spacing:.3em;color:var(--muted);text-transform:uppercase;margin-bottom:4px;}
.price-big{font-family:'Cormorant Garamond',serif;font-size:2.2rem;font-weight:700;color:var(--gold);margin-bottom:20px;}
.qty-control{display:flex;align-items:center;background:rgba(0,0,0,.5);border:1px solid rgba(255,255,255,.1);border-radius:50px;padding:6px;width:fit-content;margin-bottom:20px;gap:4px;}
.qty-btn{width:32px;height:32px;background:none;border:none;color:var(--gold);font-size:18px;cursor:pointer;border-radius:50%;transition:background .2s;display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-weight:700;}
.qty-btn:hover{background:var(--gold-dim);}
.qty-val{font-size:13px;font-weight:700;color:white;padding:0 16px;min-width:44px;text-align:center;}
.btn-vx-primary{width:100%;padding:14px;background:var(--gold);color:black;border:none;border-radius:12px;font-family:'Space Mono',monospace;font-size:10px;font-weight:700;letter-spacing:.2em;text-transform:uppercase;cursor:pointer;position:relative;overflow:hidden;transition:box-shadow .3s,transform .2s;}
.btn-vx-primary::after{content:'';position:absolute;inset:0;background:white;transform:translateY(105%);transition:transform .3s cubic-bezier(.16,1,.3,1);}
.btn-vx-primary:hover::after{transform:translateY(0);}
.btn-vx-primary:hover{box-shadow:0 8px 30px rgba(201,168,76,.3);transform:translateY(-1px);}
.btn-vx-primary:active{transform:scale(.99);}
.btn-vx-primary span{position:relative;z-index:1;}
.btn-vx-ghost{width:100%;padding:12px;background:transparent;color:#52525b;border:none;font-family:'Space Mono',monospace;font-size:10px;letter-spacing:.15em;text-transform:uppercase;cursor:pointer;margin-top:8px;transition:color .2s;}
.btn-vx-ghost:hover{color:white;}
.booking-item{display:flex;align-items:center;gap:14px;padding:14px;background:rgba(0,0,0,.4);border:1px solid rgba(255,255,255,.06);border-radius:14px;margin-bottom:10px;transition:border-color .2s;}
.booking-item:hover{border-color:rgba(201,168,76,.15);}
.booking-item-img{width:48px;height:48px;object-fit:cover;border-radius:10px;border:1px solid rgba(201,168,76,.15);flex-shrink:0;}
.booking-item-name{font-size:11px;font-weight:700;color:white;}
.booking-item-sub{font-size:9px;color:var(--gold);letter-spacing:.1em;text-transform:uppercase;}
.booking-remove{background:none;border:none;color:#52525b;cursor:pointer;margin-left:auto;transition:color .2s;font-size:14px;flex-shrink:0;}
.booking-remove:hover{color:#ef4444;}
.booking-total-bar{background:linear-gradient(135deg,rgba(201,168,76,.12),rgba(201,168,76,.05));border:1px solid rgba(201,168,76,.25);border-radius:14px;padding:16px 20px;display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;}
.booking-total-label{font-size:8px;letter-spacing:.3em;color:var(--muted);text-transform:uppercase;margin-bottom:4px;}
.booking-total-val{font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:var(--gold);}
.btn-execute{background:rgba(0,0,0,.7);color:white;border:1px solid rgba(255,255,255,.1);border-radius:50px;padding:10px 22px;font-family:'Space Mono',monospace;font-size:9px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;cursor:pointer;transition:all .25s;}
.btn-execute:hover{background:black;border-color:rgba(201,168,76,.3);color:var(--gold);}
.vx-label{display:block;font-size:8px;letter-spacing:.3em;color:var(--gold);text-transform:uppercase;font-weight:700;margin-bottom:8px;}
.vx-input{width:100%;padding:12px 14px;background:rgba(0,0,0,.5)!important;border:1px solid rgba(255,255,255,.08)!important;border-radius:12px;color:white!important;font-family:'Space Mono',monospace!important;font-size:11px!important;outline:none;transition:border-color .3s!important;}
.vx-input:focus{border-color:rgba(201,168,76,.4)!important;}
.vx-input::placeholder{color:#3a3a3a!important;}
.profile-avatar-wrap{position:relative;display:inline-block;}
.profile-avatar{width:90px;height:90px;border-radius:50%;object-fit:cover;border:2px solid rgba(201,168,76,.4);}
.avatar-upload-btn{position:absolute;bottom:0;right:0;width:28px;height:28px;background:var(--gold);color:black;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:11px;transition:transform .2s;}
.avatar-upload-btn:hover{transform:scale(1.1);}
.vx-footer{text-align:center;padding:50px 0 30px;font-size:9px;letter-spacing:.4em;color:rgba(255,255,255,.08);text-transform:uppercase;}
.fade-up{opacity:0;transform:translateY(20px);animation:fu .7s ease forwards;}
@keyframes fu{to{opacity:1;transform:translateY(0);}}
.delay-1{animation-delay:.08s;}.delay-2{animation-delay:.16s;}.delay-3{animation-delay:.24s;}

/* ── PROMO MODAL ── */
.promo-modal-img{width:100%;height:260px;object-fit:cover;display:block;filter:brightness(.6);}
.promo-applied-bar{background:linear-gradient(135deg,rgba(201,168,76,.15),rgba(201,168,76,.05));border:1px solid rgba(201,168,76,.3);border-radius:12px;padding:12px 16px;display:flex;align-items:center;gap:12px;margin-bottom:16px;}
.promo-applied-icon{width:36px;height:36px;background:var(--gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;color:#000;flex-shrink:0;}
.promo-applied-text{font-size:9px;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;}
.promo-applied-val{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:700;color:var(--gold);}

@media(max-width:768px){
    .modal-luxury-img{height:250px;}
    .modal-body-vx{padding:24px;}
    .hero-title{font-size:3rem;}
    .subcat-grid{grid-template-columns:1fr 1fr;}
    .promo-card-vx{height:300px;}
}
</style>
</head>
<body>

<div class="cin-bg"></div>
<div class="cin-orb2"></div>
<div class="grid-overlay"></div>
<div class="scanlines"></div>

<div class="page-wrap">

{{-- ══ NAVBAR ══ --}}
<nav class="vx-navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="vx-brand" href="javascript:void(0)" onclick="goHome()">VOID<span>X</span></a>
        <div class="d-flex align-items-center gap-3">
            @if(Auth::check() && in_array(Auth::user()->role ?? '',['admin','high_admin','owner']))
            <a href="{{ route('admin.dashboard') }}" class="admin-peek-btn d-none d-md-inline-flex">
                <i class='bx bx-layout' style="font-size:12px;"></i> Admin View
            </a>
            @endif
            <div class="text-end d-none d-sm-block">
                <div style="font-size:12px;font-weight:700;color:white;" id="display-name">{{ $fullname }}</div>
                <div class="user-tier"><span class="pulse-dot"></span>Titanium Traveller</div>
            </div>
            <div class="dropdown">
                <img id="nav-avatar" src="{{ $profile_pic }}" class="nav-avatar" data-bs-toggle="dropdown" alt="avatar">
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="openProfile()"><i class="fa fa-user-cog me-2" style="color:var(--gold);"></i>Profile Settings</a></li>
                    @if(Auth::check() && in_array(Auth::user()->role ?? '',['admin','high_admin','owner']))
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class='bx bx-layout me-2' style="color:var(--gold);"></i>Switch to Admin</a></li>
                    @endif
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-bold"><i class="fa fa-power-off me-2"></i>Terminate Session</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Back to top">
    <i class="fa fa-chevron-up"></i>
</button>

{{-- ══ HERO ══ --}}
<header class="container vx-hero fade-up" id="main-hero">
    <div class="hero-eyebrow"><span class="rule"></span>Secured Access Granted</div>
    <h1 class="hero-title">Elite<br><em>Travels</em></h1>
    <p class="hero-sub">Curated exclusively for Titanium members</p>
</header>

{{-- ══ CATEGORY NAV ══ --}}
<div class="cat-nav-wrapper fade-up delay-1">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-7">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn-pill active" id="btn-all" onclick="goHome()">All Access</button>
                    @if($promos->isNotEmpty())
                    <button class="btn-pill" id="btn-promos" onclick="navToSection('promos','Promo')"><i class='bx bx-purchase-tag me-1'></i>Promos</button>
                    @endif
                    <button class="btn-pill" id="btn-destinations" onclick="navToSection('destinations','Travel')"><i class='bx bx-map-alt me-1'></i>Destinations</button>
                    <button class="btn-pill" id="btn-vehicles" onclick="navToSection('vehicles','Vehicle')"><i class='bx bx-car me-1'></i>Vehicles</button>
                    <button class="btn-pill" id="btn-food" onclick="navToSection('food','Food')"><i class='bx bx-dish me-1'></i>Cuisine</button>
                </div>
            </div>
            <div class="col-md-5">
                <div class="search-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" id="portal-search" class="vx-search" placeholder="Search experiences..." onkeyup="executeSearch()">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════
     VIEW A: MAIN LANDING
══════════════════════════════ --}}
<div id="view-main">
<main class="container py-4">

    <div id="no-results" class="d-none">
        <div class="no-res-icon"><i class="fa fa-ghost"></i></div>
        <div class="no-res-title">Void Encountered</div>
        <p class="no-res-sub">No luxury match found for your search</p>
        <button class="btn-pill" onclick="resetSearch()">Clear Filter</button>
    </div>

    {{-- ══ PROMO SECTION ══ --}}
    @if($promos->isNotEmpty())
    <section id="promos" class="luxury-section mb-5">
        <div class="section-head">
            <div>
                <span class="section-num">00</span>
                <h2 class="section-title-vx">Active Promos</h2>
            </div>
            <span style="font-size:9px;letter-spacing:.3em;color:var(--muted);text-transform:uppercase;">
                <i class='bx bx-purchase-tag' style="color:var(--gold);vertical-align:middle;"></i>
                {{ $promos->count() }} offer{{ $promos->count() > 1 ? 's' : '' }} available · Titanium only
            </span>
        </div>

        <div class="row g-4">
            @foreach($promos as $promo)
            @php
                $cat       = $promo->category ?? 'default';
                $promoImg  = !empty($promo->image_url) 
                             ? (str_starts_with($promo->image_url, 'http') ? $promo->image_url : asset('storage/'.$promo->image_url))
                             : ($promoCategoryImages[$cat] ?? $promoCategoryImages['default']);
                $promoIcon = $promoCategoryIcons[$cat] ?? $promoCategoryIcons['default'];
                $fallbackImg = $promoCategoryImages[$cat] ?? $promoCategoryImages['default'];
            @endphp
            <div class="col-md-6 col-lg-4" style="animation:fu .6s ease {{ $loop->index * .08 }}s both;">
                <div class="promo-card-vx" onclick="openPromoModal(
                    {{ json_encode($promo->title) }},
                    {{ json_encode($promo->description) }},
                    {{ $promo->discount_percent }},
                    {{ json_encode($promoImg) }},
                    {{ json_encode($cat) }},
                    {{ json_encode($promo->valid_until ? $promo->valid_until->format('M d, Y') : null) }}
                )">
                    <div class="promo-shine"></div>
                    <div class="promo-img-wrap-vx">
                        <img src="{{ $promoImg }}"
                             class="promo-img-vx"
                             onerror="this.src='{{ $fallbackImg }}'"
                             alt="{{ $promo->title }}">
                    </div>
                    <div class="promo-overlay-vx">
                        <div class="d-flex justify-content-between align-items-flex-start">
                            <span class="promo-cat-badge-vx">
                                <i class='bx {{ $promoIcon }}'></i> {{ $cat !== 'default' ? $cat : 'Exclusive' }}
                            </span>
                            <span class="promo-discount-pill-vx">
                                {{ $promo->discount_percent }}<small>%</small>
                            </span>
                        </div>
                        <div>
                            <h5 class="promo-title-vx">{{ $promo->title }}</h5>
                            <p class="promo-desc-vx">{{ Str::limit($promo->description, 80) }}</p>
                            <div class="promo-footer-vx">
                                <span class="promo-valid-vx">
                                    @if($promo->valid_until)
                                        <i class='bx bx-time' style="vertical-align:middle;font-size:10px;"></i>
                                        Valid until {{ $promo->valid_until->format('M d, Y') }}
                                    @else
                                        <i class='bx bx-infinite' style="vertical-align:middle;font-size:10px;"></i>
                                        No expiry
                                    @endif
                                </span>
                                <button class="promo-cta-vx">Claim Offer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
    {{-- ══ END PROMO SECTION ══ --}}

    @php
    $categories = [
        [
            'id'    => 'destinations', 'name' => 'Travel',
            'title' => 'Destinations', 'num'  => '01',
            'subs'  => ['Beach','Mountain','Resort','City'],
        ],
        [
            'id'    => 'vehicles', 'name' => 'Vehicle',
            'title' => 'Vehicles',  'num'  => '02',
            'subs'  => ['Sedan','SUV','Family Van','Motorcycle'],
        ],
        [
            'id'    => 'food', 'name' => 'Food',
            'title' => 'Private Cuisine', 'num' => '03',
            'subs'  => ['Fine Dining','Local Delicacy','Street Food','Cafe'],
        ],
    ];
    @endphp

    @foreach($categories as $cat)
    <section id="{{ $cat['id'] }}" class="luxury-section mb-5">

        <div class="section-head">
            <div>
                <span class="section-num">{{ $cat['num'] }}</span>
                <h2 class="section-title-vx">{{ $cat['title'] }}</h2>
            </div>
            <div class="sub-filter-group d-flex flex-wrap gap-1">
                <button class="sub-filter-btn active" onclick="filterSub('{{ $cat['id'] }}','all',this)">All</button>
                @foreach($cat['subs'] as $sub)
                <button class="sub-filter-btn" onclick="filterSub('{{ $cat['id'] }}','{{ $sub }}',this)">{{ $sub }}</button>
                @endforeach
            </div>
        </div>

        {{-- Sub-category picker cards --}}
        <div class="subcat-grid mb-4">
            @foreach($cat['subs'] as $sub)
            @php
                $meta  = $subMeta[$sub] ?? ['icon'=>'bx-star','color'=>'#c9a84c','label'=>$sub,'desc'=>''];
                $count = $items->where('category',$cat['name'])->where('sub_category',$sub)->count();
            @endphp
            <div class="subcat-picker-card" onclick="openSubPage('{{ $cat['name'] }}','{{ $sub }}')">
                <span class="spc-count">{{ $count }} {{ $count==1?'item':'items' }}</span>
                <i class='bx {{ $meta['icon'] }} spc-icon' style="color:{{ $meta['color'] }};"></i>
                <div class="spc-name">{{ $sub }}</div>
                <div class="spc-desc">{{ $meta['desc'] }}</div>
                <div class="spc-arrow"><i class='bx bx-right-arrow-alt'></i></div>
            </div>
            @endforeach
        </div>

        {{-- Card grid --}}
        <div class="row g-4" id="container-{{ $cat['id'] }}">
            @foreach($items->where('category',$cat['name']) as $item)
            <div class="col-md-6 col-lg-4 luxury-item-col"
                 data-sub="{{ $item->sub_category }}"
                 style="animation:fu .6s ease {{ $loop->index*.08 }}s both;">
                <div class="luxury-card" onclick='openDetailModal({!! json_encode($item) !!})'>
                    <div class="card-corner"></div>
                    <div class="img-viewport">
                        <img src="{{ getImagePath($item->image_url) }}" class="item-img"
                             onerror="this.src='https://placehold.co/600x800/06080d/c9a84c?text=VoidX'"
                             alt="{{ $item->name }}">
                        <div class="card-overlay">
                            <h5 class="item-name">{{ $item->name }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="item-price">₱{{ number_format($item->price) }}</span>
                                <span class="item-badge">{{ $item->sub_category ?? 'Exclusive' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach

</main>
</div>{{-- /#view-main --}}

{{-- ══════════════════════════════
     VIEW B: SUB-PAGE (drill-down)
══════════════════════════════ --}}
<div id="view-subpage">
<div class="container">

    <div class="subpage-header">
        <button class="back-btn" onclick="closeSubPage()">
            <i class='bx bx-left-arrow-alt'></i> Back to All
        </button>
        <p class="subpage-eyebrow" id="sp-eyebrow">VoidX Elite</p>
        <h1 class="subpage-title" id="sp-title">Loading...</h1>
        <p class="subpage-desc" id="sp-desc"></p>
    </div>

    <div class="subpage-filter-row" id="sp-filter-row"></div>
    <div class="row g-4" id="sp-cards-grid"></div>

    <div id="sp-empty" class="d-none" style="padding:60px 0;text-align:center;">
        <div style="font-size:3rem;color:var(--muted);margin-bottom:16px;"><i class='bx bx-ghost'></i></div>
        <p style="font-size:10px;letter-spacing:.3em;color:var(--muted);text-transform:uppercase;">No items in this category yet</p>
    </div>

</div>
</div>{{-- /#view-subpage --}}

{{-- ══ ITINERARY BAR ══ --}}
<div id="itinerary-bar" onclick="openBookingModal()">
    <div class="d-flex align-items-center gap-3">
        <div class="position-relative">
            <i class="fa fa-suitcase-rolling" style="font-size:20px;color:var(--gold);"></i>
            <span class="cart-badge" id="cart-count">0</span>
        </div>
        <div>
            <div class="itin-label">Itinerary</div>
            <div class="itin-count" id="cart-items-count">0 items selected</div>
        </div>
    </div>
    <div class="itin-total" id="running-total">₱0</div>
</div>

<footer class="vx-footer">Voidx Elite Selection · Traveller Portal · Terminal v2.0.4 · encrypted_link_active</footer>

</div>{{-- /.page-wrap --}}

{{-- ══ MODALS ══ --}}

{{-- ITEM DETAIL MODAL --}}
<div class="modal fade" id="itemDetailModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="row g-0">
                <div class="col-lg-6">
                    <img id="detail-img" src="" class="modal-luxury-img" alt="">
                </div>
                <div class="col-lg-6 modal-body-vx d-flex flex-column justify-content-center">
                    <p class="modal-eyebrow">VoidX Exclusive</p>
                    <h2 class="modal-title-vx" id="detail-title"></h2>
                    <p class="modal-desc" id="detail-desc"></p>
                    <div id="promo-discount-notice" class="d-none mb-3" style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.25);border-radius:10px;padding:10px 14px;">
                        <div style="font-size:8px;letter-spacing:.2em;color:var(--gold);text-transform:uppercase;margin-bottom:4px;">Active Promo Applied</div>
                        <div id="promo-discount-text" style="font-size:10px;color:#a1a1aa;"></div>
                    </div>
                    <div class="price-label">Total Investment</div>
                    <div class="price-big" id="detail-price"></div>
                    <div id="modal-qty-container" class="d-none mb-3">
                        <div class="price-label mb-2">Quantity</div>
                        <div class="qty-control">
                            <button class="qty-btn" id="m-qty-minus">−</button>
                            <span class="qty-val" id="m-qty-val">1</span>
                            <button class="qty-btn" id="m-qty-plus">+</button>
                        </div>
                    </div>
                    <button class="btn-vx-primary mb-0" id="confirm-btn"><span>Add to Itinerary</span></button>
                    <button class="btn-vx-ghost" data-bs-dismiss="modal">Go Back</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PROMO DETAIL MODAL --}}
<div class="modal fade" id="promoDetailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:480px;">
        <div class="modal-content" style="border-radius:24px!important;overflow:hidden;">
            <div style="position:relative;">
                <img id="promo-modal-img" src="" class="promo-modal-img" alt="">
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,8,13,.9) 0%,transparent 60%);"></div>
                <button onclick="document.getElementById('promoDetailModal').querySelector('[data-bs-dismiss]').click()"
                    style="position:absolute;top:16px;right:16px;width:32px;height:32px;background:rgba(0,0,0,.5);border:1px solid rgba(255,255,255,.15);border-radius:50%;color:white;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <i class="fa fa-times"></i>
                </button>
                <div style="position:absolute;bottom:20px;left:22px;right:22px;display:flex;justify-content:space-between;align-items:flex-end;">
                    <span id="promo-modal-cat-badge" class="promo-cat-badge-vx"></span>
                    <span id="promo-modal-discount" class="promo-discount-pill-vx" style="font-size:2.2rem;"></span>
                </div>
            </div>
            <div class="modal-body-vx" style="padding:28px 30px;">
                <h3 class="modal-title-vx" id="promo-modal-title" style="font-size:1.6rem;margin-bottom:10px;"></h3>
                <p class="modal-desc" id="promo-modal-desc" style="margin-bottom:20px;"></p>
                <div class="promo-applied-bar">
                    <div class="promo-applied-icon"><i class="fa fa-tag"></i></div>
                    <div>
                        <div class="promo-applied-text">Discount</div>
                        <div class="promo-applied-val" id="promo-modal-discount-val"></div>
                    </div>
                    <div style="margin-left:auto;text-align:right;">
                        <div class="promo-applied-text">Valid Until</div>
                        <div class="promo-applied-val" id="promo-modal-valid" style="font-size:.95rem;"></div>
                    </div>
                </div>
                <button class="btn-vx-primary" onclick="claimCurrentPromo()"><span><i class="fa fa-check me-2"></i>Claim This Offer</span></button>
                <button class="btn-vx-ghost" data-bs-dismiss="modal">Maybe Later</button>
            </div>
        </div>
    </div>
</div>

{{-- BOOKING MODAL --}}
<div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content" style="border-radius:24px!important;">
            <div class="modal-body-vx">
                <p class="modal-eyebrow text-center" style="color:var(--gold);">Booking Summary</p>
                <h4 style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:white;text-align:center;margin-bottom:20px;">
                    Your <em style="color:var(--gold);">Itinerary</em>
                </h4>
                <div id="modal-item-list" style="max-height:260px;overflow-y:auto;" class="mb-4"></div>
                {{-- Active promo indicator --}}
                <div id="booking-promo-row" class="d-none mb-3"
                     style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.25);border-radius:10px;padding:10px 14px;display:flex;justify-content:space-between;align-items:center;">
                    <div>
                        <div style="font-size:8px;letter-spacing:.2em;color:var(--gold);text-transform:uppercase;">Promo Applied</div>
                        <div id="booking-promo-name" style="font-size:10px;color:#a1a1aa;margin-top:2px;"></div>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span id="booking-promo-pct" style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:700;color:var(--gold);"></span>
                        <button onclick="removePromo()" style="background:none;border:none;color:#52525b;cursor:pointer;font-size:12px;" title="Remove promo"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <label class="vx-label">Travel Date</label>
                <input type="date" id="travel-date" class="vx-input mb-4" style="margin-bottom:16px!important;">
                <label class="vx-label">Contact Channels</label>
                <input type="email" id="booking-email" class="vx-input mb-2" value="{{ $user_email }}" placeholder="Email Address" style="margin-bottom:10px!important;">
                <input type="text" id="booking-phone" class="vx-input" value="{{ $user_phone }}" placeholder="Phone Number" style="margin-bottom:20px!important;">
                <div class="booking-total-bar mt-3">
                    <div>
                        <div class="booking-total-label">Estimated Total</div>
                        <div class="booking-total-val" id="modal-total-price">₱0</div>
                    </div>
                    <button class="btn-execute" onclick="finalBook()">Execute</button>
                </div>
                <button class="btn-vx-ghost" onclick="clearItinerary()" style="color:#f87171;">Clear All Selections</button>
            </div>
        </div>
    </div>
</div>

{{-- PROFILE MODAL --}}
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
        <div class="modal-content">
            <div class="modal-body-vx">
                <p class="modal-eyebrow text-center">Traveller Profile</p>
                <h4 style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:white;text-align:center;margin-bottom:24px;">
                    My <em style="color:var(--gold);">Account</em>
                </h4>
                <div class="text-center mb-4">
                    <div class="profile-avatar-wrap">
                        <img id="preview-avatar" src="{{ $profile_pic }}" class="profile-avatar" alt="avatar">
                        <label for="upload-avatar" class="avatar-upload-btn">
                            <i class="fa fa-camera" style="font-size:10px;"></i>
                        </label>
                        <input type="file" id="upload-avatar" hidden onchange="previewProfilePic(this)">
                    </div>
                </div>
                <label class="vx-label">Name on Portal</label>
                <input type="text" id="edit-fullname" class="vx-input mb-4" value="{{ $fullname }}" style="margin-bottom:20px!important;">
                <div style="height:1px;background:var(--border);margin:20px 0;"></div>
                <button class="btn-vx-primary" onclick="saveProfileChanges()"><span>Save Updates</span></button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ══ ALL ITEMS from PHP ══ */
const ALL_ITEMS = @json($items->values());

/* ══ SUB META ══ */
const SUB_META = @json($subMeta);

/* ══ CATEGORY MAP ══ */
const CAT_SUBS = {
    'Travel':  ['Beach','Mountain','Resort','City'],
    'Vehicle': ['Sedan','SUV','Family Van','Motorcycle'],
    'Food':    ['Fine Dining','Local Delicacy','Street Food','Cafe'],
};

/* ══ SECTION ID MAP ══ */
const CAT_SECTION_ID = {
    'Travel':  'destinations',
    'Vehicle': 'vehicles',
    'Food':    'food',
};

/* ══ STATE ══ */
let itinerary   = JSON.parse(localStorage.getItem('voidx_cart'))  || [];
let activePromo = JSON.parse(localStorage.getItem('voidx_promo')) || null;
let currentPromoForModal = null;
let currentCategory = null;

const bModal  = new bootstrap.Modal(document.getElementById('bookingModal'));
const pModal  = new bootstrap.Modal(document.getElementById('profileModal'));
const dModal  = new bootstrap.Modal(document.getElementById('itemDetailModal'));
const prModal = new bootstrap.Modal(document.getElementById('promoDetailModal'));

/* ══ UI UPDATE ══ */
function updateUI() {
    const rawTotal = itinerary.reduce((s,i) => s + (parseFloat(i.price) * (i.qty||1)), 0);
    const discount = activePromo ? activePromo.discount : 0;
    const total    = rawTotal * (1 - discount / 100);
    const count    = itinerary.length;

    document.getElementById('cart-count').innerText        = count;
    document.getElementById('cart-items-count').innerText  = count + (count===1 ? ' item selected' : ' items selected');
    document.getElementById('running-total').innerText     = '₱' + Math.round(total).toLocaleString();

    const bar = document.getElementById('itinerary-bar');
    if(count > 0){ bar.classList.add('active'); bar.style.display = 'flex'; }
    else { bar.classList.remove('active'); bar.style.display = 'none'; }
}

/* ══ SCROLL ══ */
window.onscroll = function(){
    document.getElementById('backToTop').style.display = document.documentElement.scrollTop > 300 ? 'flex' : 'none';
};

/* ══ NAV PILL ACTIVE ══ */
function setActivePill(pillId) {
    document.querySelectorAll('.btn-pill').forEach(b => b.classList.remove('active'));
    if(pillId){ const el = document.getElementById(pillId); if(el) el.classList.add('active'); }
}

/* ══ GO HOME ══ */
function goHome() {
    document.getElementById('view-main').style.display    = 'block';
    document.getElementById('view-subpage').style.display = 'none';
    document.getElementById('main-hero').style.display    = 'block';
    currentCategory = null;
    setActivePill('btn-all');
    window.scrollTo({top: 0, behavior: 'smooth'});
}

/* ══ NAV TO SECTION ══ */
function navToSection(sectionId, categoryName) {
    if(document.getElementById('view-subpage').style.display !== 'none') {
        document.getElementById('view-main').style.display    = 'block';
        document.getElementById('view-subpage').style.display = 'none';
        document.getElementById('main-hero').style.display    = 'block';
        currentCategory = null;
    }
    const pillMap = { 'destinations':'btn-destinations', 'vehicles':'btn-vehicles', 'food':'btn-food', 'promos':'btn-promos' };
    setActivePill(pillMap[sectionId] || 'btn-all');
    setTimeout(function(){
        const el = document.getElementById(sectionId);
        if(el) window.scrollTo({ top: el.offsetTop - 150, behavior: 'smooth' });
    }, 50);
}

function jumpTo(id){
    const el = document.getElementById(id);
    if(el) window.scrollTo({top: el.offsetTop - 150, behavior: 'smooth'});
}

/* ══ FILTERS ══ */
function filterSub(sectionId, subName, btn){
    const container = document.getElementById('container-' + sectionId);
    btn.parentElement.querySelectorAll('.sub-filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    container.querySelectorAll('.luxury-item-col').forEach(item => {
        item.style.display = (subName === 'all' || item.getAttribute('data-sub') === subName) ? 'block' : 'none';
    });
}

function executeSearch(){
    const q = document.getElementById('portal-search').value.toLowerCase();
    let has = false;
    if(document.getElementById('view-subpage').style.display !== 'none') {
        document.querySelectorAll('#sp-cards-grid [class*="col-"]').forEach(col => {
            const n = col.querySelector('.item-name');
            if(!n) return;
            const m = n.innerText.toLowerCase().includes(q);
            col.style.display = m ? 'block' : 'none';
            if(m) has = true;
        });
        return;
    }
    document.querySelectorAll('.luxury-item-col').forEach(item => {
        const n = item.querySelector('.item-name'); if(!n) return;
        const m = n.innerText.toLowerCase().includes(q);
        item.style.display = m ? 'block' : 'none';
        if(m) has = true;
    });
    document.getElementById('no-results').classList.toggle('d-none', has || q === '');
}

function resetSearch(){
    document.getElementById('portal-search').value = '';
    document.querySelectorAll('.luxury-item-col').forEach(i => i.style.display = 'block');
    document.getElementById('no-results').classList.add('d-none');
}

/* ══ SUB-PAGE ══ */
function openSubPage(category, subName) {
    const meta    = SUB_META[subName] || {icon:'bx-star', color:'#c9a84c', label:subName, desc:''};
    const items   = ALL_ITEMS.filter(i => i.category === category && i.sub_category === subName);
    const siblings = CAT_SUBS[category] || [];
    currentCategory = category;

    document.getElementById('sp-eyebrow').innerText  = category + ' · ' + items.length + ' Available';
    document.getElementById('sp-title').innerHTML    = '<em style="color:var(--gold);">' + subName + '</em>';
    document.getElementById('sp-desc').innerText     = meta.desc || '';

    const filterRow = document.getElementById('sp-filter-row');
    filterRow.innerHTML = siblings.map(s =>
        `<button class="sub-filter-btn ${s === subName ? 'active' : ''}" onclick="openSubPage('${category}','${s}')">${s}</button>`
    ).join('');

    renderSubPageCards(items);

    const sectionId = CAT_SECTION_ID[category];
    const pillMap   = { 'destinations':'btn-destinations', 'vehicles':'btn-vehicles', 'food':'btn-food' };
    setActivePill(pillMap[sectionId] || 'btn-all');

    document.getElementById('view-main').style.display     = 'none';
    document.getElementById('view-subpage').style.display  = 'block';
    document.getElementById('main-hero').style.display     = 'none';
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function renderSubPageCards(items) {
    const grid  = document.getElementById('sp-cards-grid');
    const empty = document.getElementById('sp-empty');
    if (!items || items.length === 0) {
        grid.innerHTML = '';
        empty.classList.remove('d-none');
        return;
    }
    empty.classList.add('d-none');
    grid.innerHTML = items.map((item, idx) => {
        const imgSrc = (item.image_url && item.image_url.startsWith('http'))
            ? item.image_url
            : '/storage/' + (item.image_url || '').replace('uploads/', '');
        return `
        <div class="col-md-6 col-lg-4" style="animation:fu .6s ease ${idx * .08}s both;">
            <div class="luxury-card" onclick='openDetailModal(${JSON.stringify(item)})'>
                <div class="card-corner"></div>
                <div class="img-viewport">
                    <img src="${imgSrc}" class="item-img"
                         onerror="this.src='https://placehold.co/600x800/06080d/c9a84c?text=VoidX'"
                         alt="${item.name}">
                    <div class="card-overlay">
                        <h5 class="item-name">${item.name}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="item-price">₱${parseInt(item.price).toLocaleString()}</span>
                            <span class="item-badge">${item.sub_category || 'Exclusive'}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }).join('');
}

function closeSubPage() {
    document.getElementById('view-main').style.display    = 'block';
    document.getElementById('view-subpage').style.display = 'none';
    document.getElementById('main-hero').style.display    = 'block';
    currentCategory = null;
    setActivePill('btn-all');
    window.scrollTo({top: 0, behavior: 'smooth'});
}

/* ══ PROMO MODAL ══ */
function openPromoModal(title, desc, discount, imgSrc, cat, validUntil) {
    currentPromoForModal = { title, discount };

    document.getElementById('promo-modal-img').src         = imgSrc;
    document.getElementById('promo-modal-title').innerText = title;
    document.getElementById('promo-modal-desc').innerText  = desc || 'Exclusive VoidX member offer.';
    document.getElementById('promo-modal-discount').innerHTML = discount + '<small>%</small>';
    document.getElementById('promo-modal-cat-badge').innerHTML = `<i class='bx bx-purchase-tag'></i> ${cat !== 'default' ? cat : 'Exclusive'}`;
    document.getElementById('promo-modal-discount-val').innerText = discount + '% OFF your booking total';
    document.getElementById('promo-modal-valid').innerText  = validUntil ? validUntil : 'No expiry';

    prModal.show();
}

function claimCurrentPromo() {
    if(!currentPromoForModal) return;
    activePromo = { title: currentPromoForModal.title, discount: currentPromoForModal.discount };
    localStorage.setItem('voidx_promo', JSON.stringify(activePromo));
    updateUI();
    prModal.hide();
    Swal.fire({
        title: 'Promo Claimed!',
        html: `<div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:#c9a84c;">${activePromo.title}</div>
               <div style="font-size:11px;color:#71717a;margin-top:6px;">${activePromo.discount}% discount applied to your next booking</div>`,
        icon: 'success',
        background: 'rgba(10,13,20,0.97)',
        color: '#e4e4e7',
        confirmButtonColor: '#c9a84c',
        iconColor: '#c9a84c',
    });
}

function removePromo() {
    activePromo = null;
    localStorage.removeItem('voidx_promo');
    updateUI();
    openBookingModal();
}

/* ══ DETAIL MODAL ══ */
function openDetailModal(item) {
    const imgSrc = (item.image_url && item.image_url.startsWith('http'))
        ? item.image_url
        : '/storage/' + (item.image_url || '').replace('uploads/', '');
    document.getElementById('detail-img').src            = imgSrc;
    document.getElementById('detail-title').innerText    = item.name;
    document.getElementById('detail-desc').innerText     = item.description || 'Curated exclusively for VoidX elite travellers.';

    // Show promo discount notice if active
    const notice   = document.getElementById('promo-discount-notice');
    const noticeT  = document.getElementById('promo-discount-text');
    if(activePromo) {
        const discounted = Math.round(parseFloat(item.price) * (1 - activePromo.discount / 100));
        noticeT.innerText  = `${activePromo.title} — ${activePromo.discount}% off → ₱${discounted.toLocaleString()}`;
        notice.classList.remove('d-none');
    } else {
        notice.classList.add('d-none');
    }

    document.getElementById('detail-price').innerText    = '₱' + parseInt(item.price).toLocaleString();
    const qtyCont = document.getElementById('modal-qty-container');
    document.getElementById('m-qty-val').innerText = '1';
    item.category === 'Food' ? qtyCont.classList.remove('d-none') : qtyCont.classList.add('d-none');
    document.getElementById('confirm-btn').onclick = () => {
        const qty = item.category === 'Food' ? parseInt(document.getElementById('m-qty-val').innerText) : 1;
        addToCart({...item, qty, uid: Date.now()});
        dModal.hide();
    };
    dModal.show();
}

document.getElementById('m-qty-minus').onclick = () => {
    const el = document.getElementById('m-qty-val');
    let v = parseInt(el.innerText); if(v > 1) el.innerText = v - 1;
};
document.getElementById('m-qty-plus').onclick = () => {
    const el = document.getElementById('m-qty-val');
    el.innerText = parseInt(el.innerText) + 1;
};

/* ══ CART ══ */
function addToCart(item) {
    itinerary.push(item);
    localStorage.setItem('voidx_cart', JSON.stringify(itinerary));
    updateUI();
    Swal.fire({toast:true, position:'top-end', icon:'success', title:'Added to itinerary', showConfirmButton:false, timer:1200, background:'rgba(10,13,20,0.97)', color:'#e4e4e7', iconColor:'#c9a84c', customClass:{popup:'rounded-4'}});
}

function openBookingModal() {
    const rawTotal  = itinerary.reduce((s,i) => s + (parseFloat(i.price) * (i.qty||1)), 0);
    const discount  = activePromo ? activePromo.discount : 0;
    const total     = rawTotal * (1 - discount / 100);

    const list = document.getElementById('modal-item-list');
    list.innerHTML = itinerary.map(item => {
        const imgSrc = (item.image_url && item.image_url.startsWith('http')) ? item.image_url : '/storage/' + (item.image_url || '').replace('uploads/','');
        return `<div class="booking-item">
            <img src="${imgSrc}" class="booking-item-img" onerror="this.src='https://placehold.co/48x48/06080d/c9a84c?text=V'">
            <div><div class="booking-item-name">${item.name}</div>
            <div class="booking-item-sub">${item.qty > 1 ? 'Qty: ' + item.qty + ' · ' : ''}₱${(parseFloat(item.price) * (item.qty||1)).toLocaleString()}</div></div>
            <button class="booking-remove" onclick="removeFromItinerary(${item.uid})"><i class="fa fa-times"></i></button>
        </div>`;
    }).join('');

    // Promo row
    const promoRow  = document.getElementById('booking-promo-row');
    if(activePromo) {
        document.getElementById('booking-promo-name').innerText = activePromo.title;
        document.getElementById('booking-promo-pct').innerText  = '-' + activePromo.discount + '%';
        promoRow.classList.remove('d-none');
        promoRow.style.display = 'flex';
    } else {
        promoRow.classList.add('d-none');
    }

    document.getElementById('modal-total-price').innerText = '₱' + Math.round(total).toLocaleString();
    bModal.show();
}

function removeFromItinerary(uid) {
    itinerary = itinerary.filter(i => i.uid !== uid);
    localStorage.setItem('voidx_cart', JSON.stringify(itinerary));
    updateUI();
    itinerary.length === 0 ? bModal.hide() : openBookingModal();
}

function finalBook() {
    const date = document.getElementById('travel-date').value;
    if(!date){
        Swal.fire({title:'Date Required', text:'Select your deployment date.', icon:'warning', background:'rgba(10,13,20,0.97)', color:'#e4e4e7', confirmButtonColor:'#c9a84c'});
        return;
    }
    bModal.hide();
    Swal.fire({title:'Processing...', background:'rgba(10,13,20,0.97)', color:'#e4e4e7', didOpen:() => Swal.showLoading()});

    const rawTotal = itinerary.reduce((s,i) => s + (parseFloat(i.price) * (i.qty||1)), 0);
    const discount = activePromo ? activePromo.discount : 0;

    fetch('{{ route("process.booking") }}', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body:JSON.stringify({
            travel_date:  date,
            items:        itinerary,
            promo_title:  activePromo ? activePromo.title   : null,
            promo_discount: activePromo ? activePromo.discount : 0,
            total_before: rawTotal,
            total_after:  Math.round(rawTotal * (1 - discount / 100)),
        })
    }).then(r => r.json()).then(data => {
        if(data.status === 'success'){
            Swal.fire({title:'Secured', text:'Journey logged.', icon:'success', background:'rgba(10,13,20,0.97)', color:'#e4e4e7', confirmButtonColor:'#c9a84c', iconColor:'#c9a84c'});
            itinerary   = []; localStorage.removeItem('voidx_cart');
            activePromo = null; localStorage.removeItem('voidx_promo');
            updateUI();
        } else {
            Swal.fire({title:'Error', text:data.message || 'Something went wrong.', icon:'error', background:'rgba(10,13,20,0.97)', color:'#e4e4e7', confirmButtonColor:'#c9a84c'});
        }
    }).catch(() => Swal.fire({title:'Connection Error', text:'Please try again.', icon:'error', background:'rgba(10,13,20,0.97)', color:'#e4e4e7', confirmButtonColor:'#c9a84c'}));
}

function clearItinerary(){
    itinerary   = []; localStorage.removeItem('voidx_cart');
    activePromo = null; localStorage.removeItem('voidx_promo');
    updateUI(); bModal.hide();
}

/* ══ PROFILE ══ */
function openProfile(){ pModal.show(); }
function previewProfilePic(input){
    if(input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-avatar').src = e.target.result;
            document.getElementById('nav-avatar').src     = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function saveProfileChanges(){
    const newName = document.getElementById('edit-fullname').value;
    document.getElementById('display-name').innerText = newName;
    pModal.hide();
    Swal.fire({toast:true, position:'top-end', icon:'success', title:'Profile updated', showConfirmButton:false, timer:1200, background:'rgba(10,13,20,0.97)', color:'#e4e4e7', iconColor:'#c9a84c'});
}

document.addEventListener('DOMContentLoaded', updateUI);
</script>
</body>
</html>
