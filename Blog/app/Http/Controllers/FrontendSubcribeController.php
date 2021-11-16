<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcribe;
use Brian2694\Toastr\Facades\Toastr;

class FrontendSubcribeController extends Controller
{
    public function store(Request $request)
    {
       $request->validate([
        'email' => 'required|unique:subcribes'
       ]);

         $subscriber = new Subcribe();

         $subscriber->email = $request->email;
         $subscriber->save();
        Toastr::success('You Successfully added to our subscriber list :)','Success');
        return redirect()->back();
    }
}
