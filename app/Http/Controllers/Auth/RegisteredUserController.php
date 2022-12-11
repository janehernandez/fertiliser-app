<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'name'  => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
        ]);

        $user->assignRole('customer');
        Auth::login($user);

        event(new Registered($user));

        return redirect(RouteServiceProvider::CUSTOMER_HOME);
    }
}
