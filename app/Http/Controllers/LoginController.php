<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required',
                'password' => 'required',
            ]);

            if($validateUser->fails()){
                return redirect()->back()->with('status', 'Something Went Wrong!');
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return redirect()->back()->with('status', 'Wrong Username or Password!');
            }

            $user = User::where('email', $request->email)->first();

            $request->session()->regenerate();

            $user->createToken('API TOKEN')->plainTextToken;

            return redirect('/products');
    }

    public function logout()
    {
        
        $user = User::find(Auth::user()->id);

        session()->invalidate();
     
        session()->regenerateToken();

        $user->tokens()->delete();

        Auth::logout();
     
        return redirect('/');
    }
}
