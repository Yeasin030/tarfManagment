<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turf;

class TurfController extends Controller
{
    public function show($slug)
    {
        $turf = Turf::where('slug', $slug)->with(['images'])->firstOrFail();
        return view('turf-show', compact('turf'));
    }
}
