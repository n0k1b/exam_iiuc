<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class OtpController extends Controller
{
    //

    public function otp()
    {
       // file_put_contents('test.txt',Auth::user()->id);
        return view('auth.otp');
    }

    public function submit_otp(Request $request)
    {
        $otp = Auth::user()->confirmation_code;
     //   file_put_contents('test.txt',$request->otp);
        if($otp == $request->otp)
        {
            if(Auth::user()->role == "S")
            return redirect()->route('home');
            if(Auth::user()->role == "T")
            return redirect()->route('teacher');
        }
        else
        {
            return redirect()->back()->with('error','OTP NOT MATCHED');
        }
    }
}
