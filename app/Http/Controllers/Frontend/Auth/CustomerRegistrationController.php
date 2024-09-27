<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerRegistrationController extends Controller
{
    public function register()
    {
        return Inertia::render('Frontend/Auth/Registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'number' => 'required|min:10|max:10|unique:customers',
            'address' => 'required',
            'gender' => 'required',
        ]);


        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);

        if($customer){
            Auth::guard('customer')->login($customer);
            return to_route('customer.dashboard');
        }

        return to_route('customer.register');
    }
}
