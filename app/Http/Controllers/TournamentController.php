<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tournament;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::latest('start_date')->get();
        return view('tournaments', compact('tournaments'));
    }
}
