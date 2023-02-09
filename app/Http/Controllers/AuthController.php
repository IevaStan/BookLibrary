<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function show(): View
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        // if (Auth::attempt($data, 1)) 
        if (Auth::attempt($data, $request->get('remember'))) {
            $request->session()->regenerate();

            return redirect(route('profile')); //vartotojo profilis
        }

        // return redirect('/');
        return back()->withErrors(['email' => 'Invalid data provided']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //TODO change to homepage url
        return redirect('categories');
    }

}
