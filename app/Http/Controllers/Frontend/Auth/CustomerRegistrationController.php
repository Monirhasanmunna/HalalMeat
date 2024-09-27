<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerRegistrationController extends Controller
{
    public function register()
    {
        return Inertia::render('Frontend/Auth/Registration');
    }

    public function store(Request $request)
    {
        //
    }
}
