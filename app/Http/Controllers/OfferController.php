<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('is_active', true)->latest()->get();
        return view('offers', compact('offers'));
    }
}
