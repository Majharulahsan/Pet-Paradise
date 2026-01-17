<?php

namespace App\Http\Controllers; // Essential: This tells Laravel where to find the class

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Function for the default services page (Grooming)
    public function index()
    {
        return view('services', ['activeTab' => 'grooming']);
    }

    // Function specifically for the Health route
    public function health()
    {
        return view('services', ['activeTab' => 'health']);
    }

    // Function specifically for the Vet route
    public function vet()
    {
        return view('services', ['activeTab' => 'vet']);
    }

    // Function specifically for the Daycare route
    public function daycare()
    {
        return view('services', ['activeTab' => 'daycare']);
    }
}