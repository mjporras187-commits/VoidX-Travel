<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Store a new promo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'discount_percent' => 'nullable|numeric|min:1|max:100',
            'valid_until'      => 'nullable|date',
            'is_active'        => 'boolean',
            'category'         => 'nullable|string',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $imageUrls = $this->handleImageUploads($request);

        Promo::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'discount_percent' => $request->discount_percent,
            'valid_until'      => $request->valid_until ?: null,
            'is_active'        => $request->boolean('is_active', true),
            'category'         => $request->category,
            'image_urls'       => !empty($imageUrls) ? $imageUrls : null,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Promo deployed successfully.');
    }

    /**
     * Update an existing promo.
     */
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'discount_percent' => 'nullable|numeric|min:1|max:100',
            'valid_until'      => 'nullable|date',
            'is_active'        => 'boolean',
            'category'         => 'nullable|string',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        // Handle new images — merge with existing where no new upload provided
        $existingImages = $promo->image_urls ?? [];
        $newImages      = $this->handleImageUploads($request);

        // Merge: new upload overrides slot, existing kept if no new upload
        $cats    = array_filter(array_map('trim', explode(',', $request->category ?? '')));
        $merged  = [];
        foreach ($cats as $i => $cat) {
            if (isset($newImages[$i])) {
                $merged[$i] = $newImages[$i];
            } elseif (isset($existingImages[$i])) {
                $merged[$i] = $existingImages[$i];
            }
        }
        $finalImages = array_values($merged);

        $promo->update([
            'title'            => $request->title,
            'description'      => $request->description,
            'discount_percent' => $request->discount_percent,
            'valid_until'      => $request->valid_until ?: null,
            'is_active'        => $request->boolean('is_active', true),
            'category'         => $request->category,
            'image_urls'       => !empty($finalImages) ? $finalImages : null,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Promo updated successfully.');
    }

    /**
     * Delete a promo.
     */
    public function destroy(Promo $promo)
    {
        // Optionally delete stored images
        if ($promo->image_urls) {
            foreach ($promo->image_urls as $path) {
                if (!str_starts_with($path, 'http')) {
                    \Storage::disk('public')->delete($path);
                }
            }
        }

        $promo->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Promo deleted.');
    }

    /**
     * Handle the images[] array upload from request.
     * Returns indexed array of stored paths.
     */
    private function handleImageUploads(Request $request): array
    {
        $urls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('promos', 'public');
                    $urls[$index] = $path;
                }
            }
        }
        return $urls;
    }
}