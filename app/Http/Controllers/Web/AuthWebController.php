<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthWebController extends Controller
{
    public function showRegisterForm()
    {
        $roles = Role::pluck('name');
        return view('auth.register', compact('roles'));
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $user->assignRole($request->role);

        // Auth::login($user);

        // return $this->redirectUserBasedOnRole($user);
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');

    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return $this->redirectUserBasedOnRole($user);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function redirectUserBasedOnRole($user)
    {
        // if ($user->hasRole('SuperAdmin')) {
        //     return redirect()->route('dashboard.superadmin');
        // } elseif ($user->hasRole('Admin')) {
        //     return redirect()->route('dashboard.admin');
        // } elseif ($user->hasRole('Member')) {
        //     return redirect()->route('dashboard.member');
        // }

        // return redirect('/');
         return redirect()->route('dashboard');
    }
}
