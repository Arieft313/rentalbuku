<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $rent_logs = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();
        return view('profile', ['rent_logs' => $rent_logs]);
        
    }

    public function index()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view('user', ['users' => $users]);
    }

    public function registeredUser()
    {
        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registered-user', ['registeredUsers' => $registeredUsers]);
    }

    public function bannedUser()
    {
        $bannedUsers = User::where('status', 'banned')->where('role_id', 2)->get();
        return view('banned-user', ['bannedUsers' => $bannedUsers]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rent_logs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('user-detail', ['user' => $user, 'rent_logs' => $rent_logs]);
    }

    public function approve($slug){
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        
        return redirect('user-detail/'.$slug)->with('status', 'User is now Approved');
    }

    public function ban($slug){
        $user = User::where('slug', $slug)->first();
        $user->status = 'banned';
        $user->save();
        return redirect('user-detail/'.$slug)->with('status', 'User is now Banned');
    }
    public function unban($slug){
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('user-detail/'.$slug)->with('status', 'User is now Ubanned');
    }
}
