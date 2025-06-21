<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\InviteUserMail;




class InvitationController extends Controller
{
    public function showInviteForm()
    {
        $canCreateCompany = Auth::user()->hasRole('SuperAdmin');
        return view('invitation.form', compact('canCreateCompany'));
    }

    public function sendInvite(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Member',
            'company_name' => 'nullable|required_if:creator,superadmin'
        ]);

        $token = Str::uuid();
        $user = Auth::user();

        // Determine company
        if ($user->hasRole('SuperAdmin')) {
            $company = Company::create(['name' => $request->company_name]);
        } else {
            $company = $user->company;
        }

        $invite = Invitation::create([
            'email' => $request->email,
            'role' => $request->role,
            'company_id' => $company->id,
            'token' => $token,
            'accepted' => false,
        ]);

        $link = route('invite.accept', $token);
        Mail::to($invite->email)->send(new InviteUserMail($link));

        return back()->with('success', 'Invitation sent to ' . $invite->email);
    }

    public function acceptInviteForm($token)
    {
        $invite = Invitation::where('token', $token)->where('accepted', false)->firstOrFail();
        return view('invitation.accept', compact('invite'));
    }

    public function registerFromInvite(Request $request, $token)
    {
        $invite = Invitation::where('token', $token)->where('accepted', false)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $invite->email,
            'password' => Hash::make($request->password),
            'company_id' => $invite->company_id,
            'role' => $invite->role,
        ]);

        $user->assignRole($invite->role);
        $invite->update(['accepted' => true]);

        Auth::login($user);
        return redirect()->route('dashboard.' . strtolower($invite->role));
    }
}
