<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Note the change in the unique rule
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'reg_no' => ['required', 'string', 'max:255', 'unique:users,reg_no'],
            'id_no' => ['required', 'string', 'max:255', 'unique:users,id_no'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'campus' => ['required', 'string', 'max:255'],
            'current_programme' => ['nullable', 'string', 'max:255'],
            'attempted_units' => ['nullable', 'integer'],
            'registered_units' => ['nullable', 'integer'],
            'total_billed' => ['nullable', 'numeric'],
            'total_paid' => ['nullable', 'numeric'],
            'fee_balance' => ['nullable', 'numeric'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'reg_no' => $request->reg_no,
            'id_no' => $request->id_no,
            'gender' => $request->gender,
            'address' => $request->address,
            'dob' => $request->dob,
            'campus' => $request->campus,
            'current_programme' => $request->current_programme,
            'attempted_units' => $request->attempted_units,
            'registered_units' => $request->registered_units,
            'total_billed' => $request->total_billed,
            'total_paid' => $request->total_paid,
            'fee_balance' => $request->fee_balance,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}
