<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }

    public function UserProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.profile_user', compact('profileData'));
    }

    public function UserLogout(){
        Auth::guard('web')->logout();
        return redirect('/login');
    }
}
