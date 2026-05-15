<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Booking;
use App\Models\User;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        $items      = Travel::latest()->get();
        $myBookings = Booking::where('user_id', Auth::id())->latest()->get();

        $promos = Promo::where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('valid_until')
                          ->orWhere('valid_until', '>=', Carbon::now()->startOfDay());
                    })
                    ->latest()->get();

        return view('dashboard', compact('items', 'myBookings', 'promos'));
    }

    public function processBooking(Request $request)
    {
        if (!$request->has('items') || empty($request->input('items'))) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Itinerary is empty.'
            ], 400);
        }

        try {
            $request->validate([
                'travel_date'   => 'required|date',
                'items'         => 'required|array',
                'items.*.name'  => 'required|string',
                'items.*.price' => 'required|numeric',
            ]);

            foreach ($request->items as $item) {
                Booking::create([
                    'user_id'     => Auth::id(),
                    'travel_id'   => $item['id'] ?? null,
                    'item_name'   => $item['name'],
                    'price'       => floatval($item['price']),
                    'qty'         => intval($item['qty'] ?? 1),
                    'travel_date' => $request->travel_date,
                    'status'      => 'pending',
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'VoidX: Deployment Successful. Your itinerary is now secured.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed: ' . implode(', ', array_merge(...array_values($e->errors())))
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'System Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->has('fullname') && !empty($request->fullname)) {
            $user->name = $request->fullname;
        }

        if ($request->hasFile('avatar')) {
            if ($user->profile_pic) {
                Storage::disk('public')->delete($user->profile_pic);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->profile_pic = $path;
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'name'   => $user->name,
            'avatar' => $user->profile_pic ? asset('storage/' . $user->profile_pic) : null,
        ]);
    }

    public function adminIndex(): View
    {
        $recentTravels = Travel::latest()->take(50)->get();
        $totalHistory  = Travel::count();
        $userCount     = User::count();
        $totalIncome   = Booking::sum(DB::raw('price * qty'));

        return view('admin.dashboard', compact('recentTravels', 'totalHistory', 'userCount', 'totalIncome'));
    }

    public function income(): View
    {
        $income = Booking::sum(DB::raw('price * qty'));
        return view('admin.income', compact('income'));
    }

    public function manageUsers(): View
    {
        $users = User::orderBy('role')->orderBy('name')->get();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $request->validate([
            'role' => 'required|in:user,admin,high_admin,owner'
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', "Role updated: {$user->name} is now {$request->role}.");
    }

    public function storePromo(Request $request): RedirectResponse
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'discount_percent' => 'nullable|integer|min:1|max:100',
            'valid_until'      => 'nullable|date',
            'is_active'        => 'required|in:0,1',
            'category'         => 'nullable|string|max:255',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($file && $file->isValid()) {
                    $imageUrls[$index] = $file->store('promos', 'public');
                }
            }
        }

        Promo::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'discount_percent' => $request->discount_percent,
            'valid_until'      => $request->valid_until ?: null,
            'is_active'        => (bool) $request->is_active,
            'category'         => $request->category,
            'image_urls'       => !empty($imageUrls) ? array_values($imageUrls) : null,
        ]);

        return back()->with('success', 'Promo deployed successfully!');
    }

    public function updatePromo(Request $request, $id): RedirectResponse
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'discount_percent' => 'nullable|integer|min:1|max:100',
            'valid_until'      => 'nullable|date',
            'is_active'        => 'required|in:0,1',
            'category'         => 'nullable|string|max:255',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $existingImages = $promo->image_urls ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($file && $file->isValid()) {
                    if (isset($existingImages[$index]) && !str_starts_with($existingImages[$index], 'http')) {
                        Storage::disk('public')->delete($existingImages[$index]);
                    }
                    $existingImages[$index] = $file->store('promos', 'public');
                }
            }
        }

        $cats        = array_values(array_filter(array_map('trim', explode(',', $request->category ?? ''))));
        $finalImages = [];
        foreach ($cats as $i => $cat) {
            if (isset($existingImages[$i])) {
                $finalImages[] = $existingImages[$i];
            }
        }

        $promo->update([
            'title'            => $request->title,
            'description'      => $request->description,
            'discount_percent' => $request->discount_percent,
            'valid_until'      => $request->valid_until ?: null,
            'is_active'        => (bool) $request->is_active,
            'category'         => $request->category,
            'image_urls'       => !empty($finalImages) ? $finalImages : null,
        ]);

        return back()->with('success', 'Promo updated successfully!');
    }

    public function destroyPromo($id): RedirectResponse
    {
        $promo = Promo::findOrFail($id);

        if ($promo->image_urls) {
            foreach ($promo->image_urls as $path) {
                if (!str_starts_with($path, 'http')) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $promo->delete();

        return back()->with('success', 'Promo terminated.');
    }
}