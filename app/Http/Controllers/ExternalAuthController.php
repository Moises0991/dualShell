<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ExternalAuth;
use App\Models\User;
use Exception;

class ExternalAuthController extends Controller {

    // validation or user creation with google
    public function callbackFromGoogle() {

        $externalUser = Socialite::driver('google')->user();
        // dd($externalUser);
        
        // socialite data cleanup
        $externalUser->avatar = $externalUser->avatar ?: 'default';
        $externalUser->id = strval($externalUser->id);

        // get user if found, with external email 
        $user = User::where('email', $externalUser->email)->select('*')->first();
        
        // get user if found
        $user_auth = User::join("external_auths", "external_auths.user_id", "=", "users.id")
            ->select('*')
            ->where('provider_id', $externalUser->id)
            ->where('email', $externalUser->email)
            ->select('users.*')->get();
        // end of query

        try {
            // login if user exist
            $credencials = list($id, $email, $password, $name, $avatar) = $user_auth[0];
            Auth::login($credencials);

        } catch (Exception $ex) {

            if(!$user) {
                // register if user doesn't exist
                $newUser = User::create([
                    'email' => $externalUser->email,
                    'password' => Hash::make('externalAuth'),
                    'name' => $externalUser->name,
                    'avatar' => $externalUser->avatar,
                ]);

            } else {
                $newUser = $user;
            }

            $newExternalAuth = ExternalAuth::create([
                'user_id' => $newUser->id,
                'token' => $externalUser->token,
                'provider' => 'google',
                'provider_id' => $externalUser->id
            ]);
            Auth::login($newUser);
        }
    }

    // validation or user creation with linkedin
    public function callbackFromLinkedin() {

        $externalUser = Socialite::driver('linkedin')->user();
        
        // socialite data cleanup
        $externalUser->avatar = $externalUser->avatar ?: 'default';
        $externalUser->id = strval($externalUser->id);
        
        // get user if found, with external email 
        $user = User::where('email', $externalUser->email)->select('*')->first();

        // get user if found, with external email and id
        $user_auth = User::join("external_auths", "external_auths.user_id", "=", "users.id")
            ->select('*')
            ->where('provider_id', $externalUser->id)
            ->where('email', $externalUser->email)
            ->select('users.*')
        ->get();

        try {
            // login if user exist
            $credencials = list($id, $email, $password, $name, $avatar) = $user_auth[0];
            Auth::login($credencials);

        } catch (Exception $ex) {

            if(!$user) {

                // register if user doesn't exist
                $newUser = User::create([
                    'email' => $externalUser->email,
                    'password' => Hash::make('externalAuth'),
                    'name' => $externalUser->name,
                    'avatar' => $externalUser->avatar,
                ]);

            } else {
                $newUser = $user;
            }

            $newExternalAuth = ExternalAuth::create([
                'user_id' => $newUser->id,
                'token' => $externalUser->token,
                'provider' => 'linkedin',
                'provider_id' => $externalUser->id
            ]);
            Auth::login($newUser);
        }
    }

    // validation or user creation with facebook
     public function callbackFromFacebook() {

        $externalUser = Socialite::driver('facebook')->user();
        
        // socialite data cleanup
        $externalUser->avatar = $externalUser->avatar ?: 'default';
        $externalUser->id = strval($externalUser->id);

        // get user if found, with external email 
        $user = User::where('email', $externalUser->email)->select('*')->first();
        
        // get user if found
        $user_auth = User::join("external_auths", "external_auths.user_id", "=", "users.id")
            ->select('*')
            ->where('provider_id', $externalUser->id)
            ->where('email', $externalUser->email)
            ->select('users.*')->get();
        // end of query

        try {
            // login if user exist
            $credencials = list($id, $email, $password, $name, $avatar) = $user_auth[0];
            Auth::login($credencials);

        } catch (Exception $ex) {

            if(!$user) {
                // register if user doesn't exist
                $newUser = User::create([
                    'email' => $externalUser->email,
                    'password' => Hash::make('externalAuth'),
                    'name' => $externalUser->name,
                    'avatar' => $externalUser->avatar,
                ]);

            } else {
                $newUser = $user;
            }

            $newExternalAuth = ExternalAuth::create([
                'user_id' => $newUser->id,
                'token' => $externalUser->token,
                'provider' => 'facebook',
                'provider_id' => $externalUser->id
            ]);
            Auth::login($newUser);
        }
    }
}
