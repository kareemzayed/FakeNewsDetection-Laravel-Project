<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // Go to landing page
    public function landingPage() {
        return redirect()->route('home');
    }

    // Go to home page
    public function home () {
        return view('home');
    }
}
