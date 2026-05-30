<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{

public function boot(): void
{
    // Admin Notifications
    View::composer('layouts.admin', function ($view) {

    $notifications = Notification::whereNull('user_id')
        ->where(function($q){
            $q->where('title','New Student Registered')
              ->orWhere('title','New Payment');
        })
        ->latest()
        ->take(5)
        ->get();

    $notifyCount = Notification::whereNull('user_id')
        ->where(function($q){
            $q->where('title','New Student Registered')
              ->orWhere('title','New Payment');
        })
        ->where('is_read',0)
        ->count();

    $view->with([
        'notifications' => $notifications,
        'notifyCount' => $notifyCount
    ]);
});


    // Student Notifications
    View::composer('layouts.student', function ($view) {

        if(auth()->check()){

            $notifications = Notification::where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->get();

            $notifyCount = Notification::where('user_id', auth()->id())
                ->where('is_read',0)
                ->count();

            $view->with([
                'notifications' => $notifications,
                'notifyCount' => $notifyCount
            ]);
        }
    });
}



}
