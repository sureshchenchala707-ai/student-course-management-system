<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Category;



class AdminController extends Controller
{
    public function dashboard()
    {
        $students = User::where('role','student')->count();
        $payments = Payment::count();

        $notifications = Notification::latest()->take(5)->get();
        $notifyCount = Notification::where('is_read',0)->count();

        return view('admin.dashboard', compact(
            'students',
            'payments',
            'notifications',
            'notifyCount'
        ));
    }

    public function students()
    {
        $students = User::where('role','student')
        ->latest()
        ->paginate(10);

        return view('admin.students', compact('students'));
    }

    public function payments()
    {
        $payments = Payment::with(['user','course'])
            ->latest()
            ->get();
            // $payments = Payment::latest()->paginate(10);

        return view('admin.payments', compact('payments'));
    }

    public function courses()
    {
        $categories = Category::all();

        $courses = Course::where(function($query) {
            $query->where('status', 'active')
                  ->orWhere('status', 'coming_soon');
        });

        if(request()->category)
        {
            $courses->where(
                'category_id',
                request()->category
            );
        }

        $courses = $courses->latest()->get();

        return view(
            'admin.courses',
            compact(
                'courses',
                'categories'
            )
        );
    }


  
public function createCourse()
{
    $categories = \App\Models\Category::all();

    return view('admin.create-course', compact('categories'));
}


public function storeCourse(Request $request)
{
    // Validation
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Create Course
    $course = new Course();

    $course->category_id = $validated['category_id'];
    $course->title = $validated['title'];
    $course->description = $validated['description'];
    $course->price = $validated['price'];
    $course->status = $validated['status'];

    // Image Upload
    if ($request->hasFile('image')) {

        $imageName = time().'_'.$request->image->getClientOriginalName();

        $request->image->move(public_path('uploads'), $imageName);

        $course->image = $imageName;
    }

    // Save Course
    $course->save();

    // Notify only students when course is active
    if ($course->status == 'active') {

        $students = User::where('role', 'student')->pluck('id');

        $notifications = [];

        foreach ($students as $studentId) {

            $notifications[] = [
                'user_id' => $studentId,
                'title' => 'New Course Added',
                'message' => $course->title.' is now available',
                'link' => route('course.details', $course->id),
                'is_read' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        if (!empty($notifications)) {
            Notification::insert($notifications);
        }
    }

    return redirect()
        ->route('admin.courses')
        ->with('success', 'Course Added Successfully!');
}




    public function deleteCourse($id)
    {
        Course::find($id)->delete();

        return back()->with('success','Course Deleted Successfully');
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);

        $categories = Category::all();

        return view(
            'admin.edit-course',
            compact('course','categories')
        );
    }

    
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $imageName = $course->image;

        if($request->hasFile('image'))
        {
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads'),
                $imageName
            );
        }

        $course->update([

            'category_id' => $request->category_id,

            'title' => $request->title,

            'description' => $request->description,

            'price' => $request->price,

            'status' => $request->status,

            'image' => $imageName,

        ]);

        return redirect()
            ->route('admin.courses')
            ->with('success','Course Updated Successfully');
    }



    public function toggleStatus($id)
    {
        $course = Course::findOrFail($id);

        if($course->status == 'active'){
            $course->status = 'coming_soon';
        }
        elseif($course->status == 'coming_soon'){
            $course->status = 'inactive';
        }
        else{
            $course->status = 'active';
        }

        $course->save();

        return back()->with('success','Course status updated');
    }

    public function updateStatus(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $course->status = $request->status;
        $course->save();

        return back()->with('success','Status Updated');
    }

    public function categories()
    {
        $categories = Category::latest()->get();

        return view('admin.categories',compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return back()->with('success','Category Added');
    }

   
        public function contacts()
        {
            $contacts = Contact::latest()
                ->paginate(10);

            return view(
                'admin.contacts',
                compact('contacts')
            );
        }


}