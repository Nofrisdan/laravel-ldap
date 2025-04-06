<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    // login form
    public function login()
    {
        return view("auth.login");
    }


    // authenticate 
    public function authenticate(Request $request)
    {

        $request->validate([
            "username" => "required|string",
            "password" => "required|string"
        ]);

        $username = $request->username;
        $password = $request->password;
        // return $password;


        // check user in LDAP 
        $user = Adldap::search()->where("uid", $username)->first();

        // proses authentication
        if ($user && Adldap::auth()->attempt($user->getDn(), $password)) { // cek userDn dan password user sudah sesuai atau belum 

            // saving to db 
            $userModel =
                User::updateOrCreate(
                    ['username' => $user->getAttribute('uid')[0]], // Cek berdasarkan username
                    [
                        'name'  => $user->getAttribute('cn')[0] ?? 'Unknown',
                        'email' => $user->getAttribute('mail')[0] ?? null,
                    ]
                );
            // authenticate
            Auth::guard("web")->login($userModel);



            // $request->session()->regenerate();
            // return redirect()->intended("/");

            if (Auth::check()) {
                $request->session()->regenerate();
                // dd(Auth::check(), Auth::user(), session()->all());
                return redirect()->intended("/");
            } else {
                // // invalid password 
                return redirect()->back()->withErrors([
                    "message1" => "Invalid Username / Password"
                ]);
            }
        }


        // // invalid password 
        return redirect()->back()->withErrors([
            "message1" => "Invalid Username / Password"
        ]);
    }



    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect("/login");
    }
}
