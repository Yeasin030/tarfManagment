<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->paginate(15);
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('admin.offers.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'code' => 'nullable|string|max:50',
            'badge_text' => 'nullable|string|max:50',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        Offer::create($validated);

        return redirect()->route('admin.offers.index')->with('success', 'Offer created successfully.');
    }

    public function edit(Offer $offer)
    {
        return view('admin.offers.form', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'code' => 'nullable|string|max:50',
            'badge_text' => 'nullable|string|max:50',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $offer->update($validated);

        return redirect()->route('admin.offers.index')->with('success', 'Offer updated successfully.');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('admin.offers.index')->with('success', 'Offer deleted successfully.');
    }
}
