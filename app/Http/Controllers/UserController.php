<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(): View|RedirectResponse
    {
        //pakeistas middlewaru routuose
        // if (!Auth::user()) {
        //     // abort(404);
        //     return redirect(route('login'));
        // }

        return view('user/show', ['user' => Auth::user()]);
    }

    public function register(): View
    {
        return view('user/register');
    }

    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate(
            [
                'email' => 'required|unique:users,email',
                'name' => 'required|max:256',
                'role' => 'required',
                'password' => ['required', Password::min(8)->numbers()],
            ]
        );
        $requestData['password'] = Hash::make($requestData['password']);
        $requestData['email_verified_at'] = new \DateTime();
        User::create($requestData);

        return redirect('profile')
            ->with('success', 'User created successfully!');
    }
}
