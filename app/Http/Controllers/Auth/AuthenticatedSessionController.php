<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validasi dan login pengguna
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Menyimpan role ke session
            $request->session()->put('role', Auth::user()->role);
    
            // Cek role dan alihkan ke route yang sesuai
            if (Auth::user()->role == 'user') {
                return redirect()->route('user.items.index'); // Redirect untuk user
            } elseif (Auth::user()->role == 'guest') {
                return redirect()->route('guest.items.index'); // Redirect untuk guest
            } elseif (Auth::user()->role == 'fat') {
                return redirect()->route('fat.items.index'); // Redirect untuk FAT
            } elseif (Auth::user()->role == 'procurement') {
                return redirect()->route('procurement.items.index'); // Redirect untuk procurement
            } elseif (Auth::user()->role == 'logistik') {
                return redirect()->route('logistik.items.index'); // Redirect untuk logistik
            }
    
            // Default redirect jika role tidak terdeteksi
            return redirect()->route('guest.item.index'); // Ganti dengan route yang sesuai jika role tidak terdeteksi
        }
    
        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
