<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function count()
    {
        $count = Notification::where('is_read', 0)->count();

        return response()->json([
            'count' => $count
        ]);
    }
}
