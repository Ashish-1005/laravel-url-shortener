<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    /**
     * Store new short URL (Admin & Member only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $user = Auth::user();

        // Prevent SuperAdmin from generating URLs
        if ($user->hasRole('SuperAdmin')) {
            return back()->with('error', 'SuperAdmin is not allowed to generate URLs.');
        }

        $shortCode = Str::random(6);

        $url = Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'user_id' => $user->id,
            'company_id' => $user->company_id,
        ]);

        return back()->with('success', 'Short URL created: ' . url($shortCode));
    }

    /**
     * Show dashboard URLs based on role
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('SuperAdmin')) {
            $urls = Url::with('user.company')->latest()->get();
            return view('dashboard.superadmin', compact('urls'));
        } elseif ($user->hasRole('Admin')) {
            $urls = Url::where('company_id', $user->company_id)
                       ->with('user')
                       ->latest()
                       ->get();
            return view('dashboard.admin', compact('urls'));
        } else {
            $urls = Url::where('user_id', $user->id)->latest()->get();
            return view('dashboard.member', compact('urls'));
        }
    }

    /**
     * Redirect short code to original URL (public)
     */
    public function resolve($short_code)
    {
        $url = Url::where('short_code', $short_code)->firstOrFail();
        $url->increment('clicks');
        return redirect($url->original_url);
    }
}
