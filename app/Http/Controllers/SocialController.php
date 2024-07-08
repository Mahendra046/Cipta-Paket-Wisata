<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class SocialController extends Controller
{
    const GOOGLE_TYPE = 'google';

    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'consent']) // Menggunakan 'consent' untuk memastikan dialog persetujuan muncul
            ->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            Log::info('Received OAuth ID: ' . $user->id);
        } catch (\Exception $e) {
            Log::error('Error during Google OAuth callback: ' . $e->getMessage());
            return redirect('/login')->withErrors(['message' => 'Error logging in with Google. Please try again.']);
        }

        $userExisted = User::where('email', $user->email)->first();

        if ($userExisted) {
            Auth::guard('user')->login($userExisted);
            Log::info('User existed, logged in.');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make($user->id),
            ]);

            Auth::guard('user')->login($newUser);
            Log::info('New user created, logged in.');
        }

        return $this->manageRedirect($userExisted);
    }

    public function manageRedirect($userExisted)
    {
        if ($userExisted) {
            return redirect('profil')->with('status', [
                'type' => 'success',
                'message' => 'Selamat datang kembali!'
            ]);
        } else {
            return redirect('profil')->with('status', [
                'type' => 'success',
                'message' => 'Selamat datang di CPW!'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Session::forget('google_access_token');

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
