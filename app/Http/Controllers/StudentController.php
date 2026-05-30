<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Models\Payment;
use App\Models\User;
// use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function payments()
    {
        $payments = Payment::with('course')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('student.payments', compact('payments'));
    }

    public function myCourses()
    {
        $courses = Payment::with('course')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('student.my-courses', compact('courses'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required|digits:10',
        'address' => 'required',
    ]);

    $user = Auth::user();

    $photoName = $user->photo;

    if($request->hasFile('photo'))
    {
        $photoName = time().'.'.$request->photo->extension();

        $request->photo->move(
            public_path('profiles'),
            $photoName
        );
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'photo' => $photoName,
    ]);

    return back()->with('success','Profile Updated');
}

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        $user = Auth::user();

        if(!Hash::check($request->current_password, $user->password))
        {
            return back()->with('error','Current password wrong');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success','Password Changed');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email',$request->email)
            ->where('role','student')
            ->first();

        if(!$user){
            return back()->with(
                'error',
                'Student not found'
            );
        }

        $user->password =
            Hash::make($request->password);

        $user->save();

        return redirect()
            ->route('student.login')
            ->with(
                'success',
                'Password Updated Successfully'
            );
    }


}