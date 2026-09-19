<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MembershipPlan;

class MembershipController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::where('is_active', true)->orderBy('price')->get();
        return view('membership', compact('plans'));
    }
}
