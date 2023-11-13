<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function loginForm(): Response
    {
        return Inertia::render('Login');
    }

    public function login(Request $request): Redirector|Response|RedirectResponse|Application
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/reports');
        }

        return Inertia::render('Login', [
            'errors' => ['email' => 'The provided credentials are incorrect.']
        ]);
    }

    public function logout(): Redirector|Application|RedirectResponse
    {
        auth('web')->logout();
        auth()->logout();

        return redirect('/login');
    }
}
