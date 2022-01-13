<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class userController extends Controller
{
    // login with google
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    
    // login with facebook
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    
    // login with linkedin
    public function redirectToLinkedin() {
        return Socialite::driver('linkedin')->redirect();
    }

    // register a new user    
    public function register(Request $request) {
        
        // validation of whether the password  belongs to an external validation
        if($request->password == 'externalAuth') {
            $response = [
                'success' => false,
                'message' => 'Contraseña no cumple con los requisitos'
            ];
            return response()->json($response);
        }

        // normal register
        try {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->avatar = 'default';
            $user->save();
            Auth::login($user);

            $success = true;
            $message = 'Registro de usuario exitoso';

        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response to client
        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }

    // login if user exists
    public function login(Request $request) {
        
        // validation of whether the password  belongs to an external validation
        if($request->password == 'externalAuth') {
            $response = [
                'success' => false,
                'message' => 'Usuario o contraseña incorrectos'
            ];
            return response()->json($response);
        }
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // normal validation
        if(Auth::attempt($credentials)) {
            $success = true;
            $message = 'Usuario autentificado correctamente';
        }else {
            $success = false;
            $message = 'Usuario o contraseña incorrectos';
        }

        // response to client
        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }

    // log out user
    public function logout() {

        try {
            Session::flush();
            $success = true;
            $message = 'Sesion cerrada correctamente';

        } catch (QueryException $ex) {

            $success = false;
            $message = $ex->getMessage();
        }

        // response to client
        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }
}
