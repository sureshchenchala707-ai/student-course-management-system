<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Models\Notification;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/about', [HomeController::class,'about'])->name('about');

Route::get('/courses', [CourseController::class,'index'])->name('courses');

Route::get('/course/{id}', [CourseController::class,'show'])
    ->name('course.details');

Route::get('/contact', [ContactController::class,'index'])
    ->name('contact');

Route::post('/contact-save', [ContactController::class,'store'])
    ->name('contact.save');

// Route::get('/course/{id}',
// [CourseController::class,'courseDetails'])
// ->name('course.details');

/*
|--------------------------------------------------------------------------
| Compatibility Login Route
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect('/student/login');
})->name('login');
/*
|--------------------------------------------------------------------------
| Separate Login Routes
|--------------------------------------------------------------------------
*/

Route::get('/student/login', [AuthController::class,'studentLoginForm'])
    ->name('student.login');

Route::post('/student/login', [AuthController::class,'studentLogin']);

Route::get('/admin/login', [AuthController::class,'adminLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class,'adminLogin']);

Route::get('/student/forgot-password',
[AuthController::class,'forgotPasswordForm'])
->name('student.forgot.password');

Route::post('/student/forgot-password',
[AuthController::class,'forgotPassword']);

Route::get(
    '/student/invoice/{id}',
    [PaymentController::class,'downloadInvoice']
)->name('invoice.download');


/*
|--------------------------------------------------------------------------
| Student Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['student'])->group(function () {

    Route::get('/student/dashboard', [StudentController::class,'dashboard'])
        ->name('student.dashboard');

    Route::get('/student/my-courses', [StudentController::class,'myCourses'])
        ->name('student.courses');

    Route::get('/student/payment-history', [StudentController::class,'payments'])
        ->name('student.payments');

    Route::get('/buy-course/{id}', [PaymentController::class,'payNow'])
        ->name('buy.course');

    Route::post('/razorpay-payment', [PaymentController::class,'paymentStore'])
        ->name('razorpay.payment');

     Route::get('/student/profile', [StudentController::class,'profile'])
    ->name('student.profile');

    Route::post('/student/profile/update', [StudentController::class,'updateProfile'])
    ->name('student.profile.update');   

    Route::post('/student/change-password',
    [StudentController::class,'changePassword'])
    ->name('student.password');


    // notification delete
    Route::get('/student/notification/delete/{id}', function($id){

        $note = \App\Models\Notification::find($id);

        if($note && $note->user_id == auth()->id()){

            $note->delete();
        }

        return back();

    })->name('student.notification.delete');

    Route::get('/student/notifications/clear', function(){

        \App\Models\Notification::where('user_id', auth()->id())
            ->delete();

        return back();

    })->name('student.notifications.clear');

});


/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/students', [AdminController::class,'students'])
        ->name('admin.students');

    Route::get('/admin/payments', [AdminController::class,'payments'])
        ->name('admin.payments');

    Route::get('/admin/courses', [AdminController::class,'courses'])
        ->name('admin.courses');

    Route::get('/admin/course/create', [AdminController::class,'createCourse'])
        ->name('admin.course.create');

    Route::post('/admin/course/store', [AdminController::class,'storeCourse'])
        ->name('admin.course.store');

    Route::get('/admin/course/edit/{id}', [AdminController::class,'editCourse'])
        ->name('admin.course.edit');

    Route::post('/admin/course/update/{id}', [AdminController::class,'updateCourse'])
        ->name('admin.course.update');

    Route::post('/admin/course/status/{id}', [AdminController::class,'updateStatus'])
        ->name('admin.course.status');

    Route::get('/admin/course/delete/{id}', [AdminController::class,'deleteCourse'])
        ->name('admin.course.delete');

        Route::get('/admin/categories',
        [AdminController::class,'categories'])
        ->name('admin.categories');

        Route::post('/admin/categories/store',
        [AdminController::class,'storeCategory'])
        ->name('admin.categories.store');
        });

    Route::get('/admin/contacts',[AdminController::class,'contacts'])->name('admin.contacts');
        


/*
|--------------------------------------------------------------------------
| Logout Routes
|--------------------------------------------------------------------------
*/

Route::post('/student/logout', function () {

    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/student/login');

})->name('student.logout');


Route::post('/admin/logout', function () {

    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/admin/login');

})->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Breeze Auth Routes
|--------------------------------------------------------------------------
*/


Route::get('/notification/read/{id}', function($id){

    $note = \App\Models\Notification::find($id);

    if($note && $note->user_id == auth()->id()){

        $note->is_read = 1;
        $note->save();

        return redirect()->to($note->link);
    }

    return back();

})->name('notification.read');


Route::get('/admin/notifications/read-all', function () {

    \App\Models\Notification::where('is_read',0)
        ->update(['is_read'=>1]);

    return back();

})->name('notifications.read.all');


Route::get('/admin/notifications/clear', function () {

    \App\Models\Notification::truncate();

    return back();

})->name('notifications.clear');

Route::get('/admin/notifications/data', function () {

    $notifications = \App\Models\Notification::latest()->take(5)->get();

    $count = \App\Models\Notification::where('is_read',0)->count();

    return response()->json([
        'notifications' => $notifications,
        'count' => $count
    ]);

})->middleware(['auth','admin']);

require __DIR__.'/auth.php';