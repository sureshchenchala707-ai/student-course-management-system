<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::where('status','!=','inactive')
            ->latest()
            ->take(6)
            ->get();

        // $courses = Course::where('status', '!=', 'inactive')->get();

        $categories = Category::withCount('courses')->get();

        return view('home', compact('courses', 'categories'));
    }

    public function about()
    {
        return view('about');
    }


    public function courseDetails($id)
    {
        $course = \App\Models\Course::with('category')
            ->findOrFail($id);

        $purchased = false;

        if (auth()->check()) {
            $purchased = \App\Models\Payment::where('user_id', auth()->id())
                ->where('course_id', $course->id)
                ->where('status', 'success')
                ->exists();
        }

        return view('course-details', compact('course', 'purchased'));
    }


}