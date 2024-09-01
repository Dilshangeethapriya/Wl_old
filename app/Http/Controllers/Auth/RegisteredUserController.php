<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'contact' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'houseNo' => ['required', 'string', 'max:50'],
            'streetName' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'postalCode' => ['required', 'string', 'max:20'],
            'image' => ['nullable', 'url'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
    
        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'gender' => $validated['gender'],
            'houseNo' => $validated['houseNo'],
            'streetName' => $validated['streetName'],
            'city' => $validated['city'],
            'postalCode' => $validated['postalCode'],
            'image' => $validated['image'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($customer));

        Auth::guard('customer')->login($customer);

        return redirect(route('dashboard', absolute: false));
    }
}
