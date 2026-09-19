<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turf;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Turf::with('images')->where('is_active', true);

        if ($request->filled('location')) {
            $query->where('address', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type') && $request->type !== 'Any') {
            $query->where('turf_type', $request->type);
        }

        $turfs = $query->get();

        return view('search-results', compact('turfs'));
    }
}
