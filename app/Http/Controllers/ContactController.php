<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }


        public function store(Request $request)
        {
            $request->validate([

                'name' => 'required',

                'email' => 'required|email',

                'subject' => 'required',

                'message' => 'required'

            ]);

            Contact::create([

                'name' => $request->name,

                'email' => $request->email,

                'subject' => $request->subject,

                'message' => $request->message

            ]);

            Notification::create([

                'title' => 'New Contact Message',

                'message' => $request->name.' sent a message',

                'link' => '/admin/contacts'

            ]);

            return back()
                ->with(
                    'success',
                    'Message Sent Successfully'
                );
        }


}