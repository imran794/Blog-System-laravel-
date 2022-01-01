<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\carbon;
use Auth;
use Image;
use Hash;


class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $user = User::findOrFail(Auth::id());

        if (isset($image)) {
            
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
      

       if (!Storage::disk('public')->exists('profile')) {
           Storage::disk('public')->makeDirectory('profile');
       }
       if (Storage::disk('public')->exists('profile/'.$user->image)) {
                Storage::disk('public')->delete('profile/'.$user->image);
            }


        Image::make($image)->resize(500, 500)->save(storage_path('app/public/profile').'/'.$imagename); 

     }
     else{
        $imagename = $user->image;
     }

     $user->name = $request->name;
     $user->email = $request->email;
     $user->image = $imagename;
     $user->about = $request->about;
     $user->save();

      Toastr::success('Profile Successfully Updated :)','Success');
        return redirect()->back();
    }

    public function ChangePassword(Request $request)
    {
        $request->validate([
            'old_password'  => 'required',
            'password'  => 'required|confirmed'
        ]);


        $hashedpassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedpassword)) {
            if (!Hash::check($request->password, $hashedpassword)) {
                
              $user =   User::find(Auth::id());
              $user->password = Hash::make($request->password);
              $user->save();
               Toastr::success('Password Successfully Changed :)','Success');
               Auth::logout();
               return redirect()->back();

            }
            else{
                Toastr::error('New Password Cannot the same as old Password','Error');
                return redirect()->back();

            }
        }
        else{
            Toastr::error('Current Password Not Match','Error');
             return redirect()->back();
        }
    }
}
