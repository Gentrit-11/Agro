<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'stok' => 2000,
            'borxhFurnitore' => 1400,
            'borxhKliente' => 900,
            'shitjeSot' => 350,
        ]);
    }
}
