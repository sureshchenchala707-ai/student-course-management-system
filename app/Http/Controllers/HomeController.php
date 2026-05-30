<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::where('status','!=','inactive')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('courses'));
    }

    public function about()
    {
        return view('about');
    }
}