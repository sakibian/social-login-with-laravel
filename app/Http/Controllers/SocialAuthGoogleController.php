<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialGoogleAccountService;
class SocialAuthGoogleController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        return redirect()->to('/home');
    }

    // public function redirectToProvider()
    // {
    //     return Socialite::driver('google')->redirect();
    // }


    // public function handleProviderCallback()
    // {
    //     try {
    //         $user = Socialite::driver('google')->user();
    //     } catch (\Exception $e) {
    //         return redirect('/login');
    //     }
    //     // only allow people with @company.com to login
    //     if(explode("@", $user->email)[1] !== ''){
    //         return redirect()->to('/');
    //     }
    //     // check if they're an existing user
    //     $existingUser = User::where('email', $user->email)->first();
    //     if($existingUser){
    //         // log them in
    //         auth()->login($existingUser, true);
    //     } else {
    //         // create a new user
    //         $newUser                  = new User;
    //         $newUser->name            = $user->name;
    //         $newUser->email           = $user->email;
    //         $newUser->google_id       = $user->id;
    //         $newUser->avatar          = $user->avatar;
    //         $newUser->avatar_original = $user->avatar_original;
    //         $newUser->save();
    //         auth()->login($newUser, true);
    //     }
    //     return redirect()->to('/home');
    // }
}
