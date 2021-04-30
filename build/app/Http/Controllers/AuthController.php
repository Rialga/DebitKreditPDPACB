<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        // dd($request->email);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if(Auth::attempt($login)){

            return redirect('home');
        }
        else{

            return redirect()->back();
        }

    }

    public function register(Request $request){

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = 1;
        $user->password = Hash::make($request->password) ;
        $user->save();

        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){

            return redirect('home');
        }
        else{
            dd('dumbass');
        }

    }


    public function logout(){

        Auth::logout();
        return redirect('/');
    }
}
