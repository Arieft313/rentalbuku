<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if(Auth::user()->status == 'inactive'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                Session::flash('status', 'failed');
                Session::flash('message','Your account is not active yet. Please contact the admin first.');
                return redirect('/login');
            }elseif(Auth::user()->status == 'banned'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                Session::flash('status', 'failed');
                Session::flash('message',"Your account is banned from website. Contact admin to restore your account");
                return redirect('/login');
            }else{
                $request->session()->regenerate();
                if(Auth::user()->role_id == 1) {
                    return redirect('dashboard');
                }

                if(Auth::user()->role_id == 2) {
                    return redirect('/');
                }
            }
            
        }

        Session::flash('status', 'failed');
        Session::flash('message','Login invalid.');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone' => 'max:255',
            'address' => 'required',
        ]);

        $request['password'] = Hash::make($request->password); 
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Registration Success. Please wait admin approval.');
        return redirect('register');
    }
}
