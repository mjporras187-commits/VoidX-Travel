<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
{
    /**
     * User-facing list
     */
    public function index(): View
    {
        $items = Travel::latest()->get();
        return view('dashboard', compact('items'));
    }

    /**
     * ADMIN: Manage page
     */
    public function manage(): View
    {
        $travels = Travel::latest()->get();
        return view('admin.travel.manage', compact('travels'));
    }

    /**
     * ADMIN: Show edit form
     */
    public function edit($id): View
    {
        $travel = Travel::findOrFail($id);
        return view('admin.travel.edit', compact('travel'));
    }

    /**
     * ADMIN: Store new travel/vehicle/food item
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string|in:Travel,Vehicle,Food',
            'sub_category' => 'required|string',
            'price'        => 'required|numeric|min:0',
            'description'  => 'required|string',
            'image'        => 'required|image|mimes:jpg,png,jpeg,webp|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('assets', 'public');
        }

        Travel::create([
            'name'         => $request->name,
            'category'     => $request->category,
            'sub_category' => $request->sub_category,
            'price'        => $request->price,
            'description'  => $request->description,
            'image_url'    => $path,
            'destination'  => $request->sub_category,
            'location'     => $request->name,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Asset secured and deployed successfully!');
    }

    /**
     * ADMIN: Update existing travel item
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $travel = Travel::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string|in:Travel,Vehicle,Food',
            'sub_category' => 'required|string',
            'price'        => 'required|numeric|min:0',
            'description'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
        ]);

        // Update image if new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($travel->image_url) {
                Storage::disk('public')->delete($travel->image_url);
            }
            $travel->image_url = $request->file('image')->store('assets', 'public');
        }

        $travel->update([
            'name'         => $request->name,
            'category'     => $request->category,
            'sub_category' => $request->sub_category,
            'price'        => $request->price,
            'description'  => $request->description,
            'destination'  => $request->sub_category,
            'location'     => $request->name,
            'image_url'    => $travel->image_url,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Asset updated successfully!');
    }

    /**
     * ADMIN: Delete travel item
     */
    public function destroy($id): RedirectResponse
    {
        $travel = Travel::findOrFail($id);

        if ($travel->image_url) {
            Storage::disk('public')->delete($travel->image_url);
        }

        $travel->delete();

        return back()->with('success', 'Asset has been terminated from the mainframe.');
    }
}