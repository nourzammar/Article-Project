<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function forgot()
    {
        return view('auth.forgotPassword');
    }
    public function creat_user(Request $request)
    {
        request()->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required'
        ]);
        $user= new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('login')->with('success', "Your Account Register successfuly");
    }
    public function auth_login(Request $request)
    {
          
        $remember= !empty($request->remember) ? true:false;
        
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password ], $remember))
       { 
        if(Auth::user()->is_admin ==1)
        {
            return redirect('panel/dashboard');
        }
        if(Auth::user()->is_admin ==0)
        {
            return redirect('home');
        }
        
        }
        else
        {
            return redirect()->back()->with('error' , 'please enter curect email and password');
        }
        
}
    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
}
}
