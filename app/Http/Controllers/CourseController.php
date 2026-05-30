<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;

class CourseController extends Controller
{
    // Courses Page
  
    public function index()
    {
        $categories = Category::all();

        $courses = Course::where('status','!=','inactive');

        // Category Filter
        if(request()->category)
        {
            $courses->where(
                'category_id',
                request()->category
            );
        }

        // Search Filter
        if(request()->search)
        {
            $courses->where(
                'title',
                'LIKE',
                '%'.request()->search.'%'
            );
        }

        $courses = $courses->latest()->get();

        return view(
            'courses',
            compact(
                'courses',
                'categories'
            )
        );
    }



    // Course Details Page
    public function show($id)
    {
        $course = Course::findOrFail($id);

        if($course->status == 'inactive')
        {
            abort(404);
        }

        return view(
            'course-details',
            compact('course')
        );
    }
}

