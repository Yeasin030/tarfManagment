<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MembershipPlan;

class MembershipPlanController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::latest()->paginate(15);
        return view('admin.memberships.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.memberships.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|string|max:50',
            'features' => 'required|string', // Expecting comma separated or newline separated string from form
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        // Convert features string to array
        $validated['features'] = array_map('trim', explode("\n", $validated['features']));
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');

        MembershipPlan::create($validated);

        return redirect()->route('admin.memberships.index')->with('success', 'Plan created successfully.');
    }

    public function edit(MembershipPlan $membership)
    {
        return view('admin.memberships.form', compact('membership'));
    }

    public function update(Request $request, MembershipPlan $membership)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|string|max:50',
            'features' => 'required|string',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['features'] = array_map('trim', explode("\n", $validated['features']));
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');

        $membership->update($validated);

        return redirect()->route('admin.memberships.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(MembershipPlan $membership)
    {
        $membership->delete();
        return redirect()->route('admin.memberships.index')->with('success', 'Plan deleted successfully.');
    }
}
