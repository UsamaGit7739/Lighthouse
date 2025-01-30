<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('password') // Not used, just required
            ]
        );

        Auth::login($user);


        $token = $user->createToken('authToken')->plainTextToken;
        return redirect()->to("http://localhost:5173?token=$token");

        // return response()->json(['token' => $token, 'user' => $user]);
        } catch (\Exception $e) {
        return redirect()->to("http://localhost:5173?error=1");
    }
    }
}
