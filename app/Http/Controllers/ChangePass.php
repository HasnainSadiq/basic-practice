<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function Cpassword()
    {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'password is change successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password is invalid');
        }
    }

    public function PUpdate()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }



    public function UserProfileUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        // $old_image = $user->profile_photo_path;
        $user_image = $request->file('profile_photo_path');
        if ($user_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($user_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/profile-photos/';
            $last_img = $up_location . $img_name;
            $user_image->move($up_location, $img_name);
            $user=User::find(Auth::user()->id);
            $user->name= $request->name;
            $user->email=$request->email;
            $user->profile_photo_path=$last_img;

            $user->save();

            return redirect()->back()->with('success', 'User Profile Update Successfully');
        } else {
            User::find(Auth::user()->id)->Update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return redirect()->back()->with('success', 'user profile Update Succesfully');
        }
    }

    // public function UserProfileUpdate(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     if($user){
    //         $user->name = $request['name'];
    //         $user->email = $request['email'];
    //         $user->profile_photo_path = $request['profile_photo_path'];

    //         $user->save();
    //         return redirect()->back()->with('success','User Profile Update Successfully');
    //     }else{
    //         return redirect()->back();

    //     }
    // }
}




    // public function UserProfileUpdate(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     if($user){
    //         $user->name = $request['name'];
    //         $user->email = $request['email'];
    //         $user->profile_photo_path = $request['profile_photo_path'];

    //         $user->save();
    //         return redirect()->back()->with('success','User Profile Update Successfully');
    //     }else{
    //         return redirect()->back();

    //     }
    // }
