<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ExternalAuthController extends Controller
{

    // validation or user creation with google
    // public function callbackFromGoogle() {

    //     $externalUser = Socialite::driver('google')->user();
    //     return $externalUser->name;

        // $externalUser->avatar = $externalUser->avatar ?: 'default';

        // $avatar =  $externalUser->avatar;

        // $isUser = User::where('external_id', $user->id)->where('external_auth', 'google')->first();
        // $isUser = User::where('external_id', $user->id)->first();

        // $user = User::join('external_auths', 'user_id', '=', 'id')->select('email', 'name', 'password as external_id')->get();

        // return  $externalAuth;

        // function index_front() {
        // $externalAuth = User::with('externalAuth')->get();
        // return json_encode($externalAuth);
        // }

        // if($user) {
        //     Auth::login($user);
        // }
        // } else {
            // $newUser = User::create([
            //     'email' => $externalUser->email,
            //     'password' => Hash::make('externalAuth'),
            //     'name' => $externalUser->name,
            //     'avatar' => $externalUser->avatar,
            // ]);

            // $newExternalAuth = ExternalAuth::create([
            //     // 'user_id' => $externalUser->id,
            //     'user_id' => '1',
            //     'token' => $externalUser->token,
            //     'provider' => 'google'
            // ]);
            // Auth::login($newUser);
        //     return 'esta madre entro en el else';
        // }

        // return redirect(route('home'));
    // }


    // validation or user creation with facebook
    //  public function callbackFromFacebook() {

    //     $user = Socialite::driver('facebook')->user();
    //     $isUser = User::where('external_id', $user->id)->where('external_auth', 'facebook')->first();
    
    //     if($isUser){
    //         Auth::login($isUser);
    //     }else{
    //         $userNew = User::create([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             // 'avatar' => $user->avatar,
    //             'external_id' => $user->id,
    //             'external_auth' => 'facebook',
    //             // 'password' => encrypt('admin@123'),
    //         ]);
            
    //         Auth::login($userNew);
    //     }
    //     return redirect(route('home'));
    // }


    // validation or user creation with linkedin
    // public function callbackFromLinkedin() {

    //     $user = Socialite::driver('linkedin')->user();
    //     $isUser = User::where('external_id', $user->id)->where('external_auth', 'linkedin')->first();


    //     if($isUser) {
    //         Auth::login($isUser);
    //     } else {
    //         $userNew = User::create([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'avatar' => $user->avatar,
    //             'external_id' => $user->id,
    //             'external_auth' => 'linkedin'
    //         ]);

    //         Auth::login($userNew);
    //     }

    //     return redirect(route('home'));
    // }
}
