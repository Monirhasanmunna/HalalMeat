<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerAuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::guard('customer')->user();
        return Inertia::render('Frontend/Auth/Login', [
            'auth' => $auth
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric|exists:customers,number',
        ]);

        $customer = Customer::where('number', $request->number)->first();

        if($customer){
            Auth::guard('customer')->login($customer);
            return to_route('customer.dashboard');
        }

        return to_route('customer.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard()
    {
        return to_route('customer.login');
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        Auth::guard('customer')->logout();

        return to_route('customer.login');
    }

}
