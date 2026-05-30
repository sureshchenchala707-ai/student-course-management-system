<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function adminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function studentLoginForm()
    {
        return view('auth.student-login');
    }

    public function adminLogin(Request $request)
    {
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'admin'
        ]))
        {
            return redirect('/admin/dashboard');
        }

        return back()->with('error','Invalid Admin Login');
    }

    public function studentLogin(Request $request)
    {
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'student'
        ]))
        {
            return redirect('/student/dashboard');
        }

        return back()->with('error','Invalid Student Login');
    }

    // public function forgotPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6|confirmed'
    //     ]);

    //     $user = User::where('email',$request->email)
    //         ->where('role','student')
    //         ->first();

    //     if(!$user){
    //         return back()->with(
    //             'error',
    //             'Student not found'
    //         );
    //     }

    //     $user->password =
    //         Hash::make($request->password);

    //     $user->save();

    //     return redirect()
    //         ->route('student.login')
    //         ->with(
    //             'success',
    //             'Password Updated Successfully'
    //         );
    // }

    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'student')
            ->first();

        if(!$user)
        {
            return back()->with(
                'error',
                'Student not found'
            );
        }

        $user->password = Hash::make(
            $request->password
        );

        $user->save();

        return redirect()
            ->route('student.login')
            ->with(
                'success',
                'Password Updated Successfully'
            );
    }
}