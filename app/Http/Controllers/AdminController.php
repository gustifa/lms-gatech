<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogout(){
        Auth::guard('web')->logout();
        return redirect('/admin/login');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Admin Profile Update Succesfully',
            'alert-type' => 'success',
        );

        $data->save();

        return redirect()->back()->with($notification);
    }

    public function adminPassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_password', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Not Match',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Change Password Update Succesfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);




    }

    /* ------------------------Become Instructor ------------------------ */

    public function BecomeInstructor(){
        return view('frontend.instructor.reg_instructor');
    }

    public function BecomeInstructorRegister(Request $request){
        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'instructor',
            'status' => 0,

        ]);


        $notification = array(
            'message' => 'Inscructor Inserted Successfully',
            'alert-type' => 'success',


        );


        return redirect()->route('instructor.login')->with($notification);
    }


    public function AllInstructor(){
        $allInstructor = User::where('role', 'instructor')->latest()->get();
        return view('admin.backend.instructor.all_instructor', compact('allInstructor'));
    }/* End Method */

    public function UpdateUserStatus(Request $request){
        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0);
        $user = User::find($userId);
        if ($user) {
            $user->status =  $isChecked;
            $user->save();
        }
        return response()->json(['message', 'User Succesfully Update']);
    }
}
