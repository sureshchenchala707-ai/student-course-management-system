<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
// use App\Models\Payment;

class PaymentController extends Controller
{
  
    public function payNow($id)
    {
        $course = Course::findOrFail($id);

        $alreadyPurchased = Payment::where(
                'user_id',
                auth()->id()
            )
            ->where(
                'course_id',
                $course->id
            )
            ->where(
                'status',
                'success'
            )
            ->exists();

        if($alreadyPurchased)
        {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'You already purchased this course'
                );
        }

        return view(
            'payment.pay',
            compact('course')
        );
    }



  
        public function paymentStore(Request $request)
        {
            $course = Course::findOrFail(
                $request->course_id
            );

            // Prevent Duplicate Purchase

            $alreadyPurchased = Payment::where(
                    'user_id',
                    auth()->id()
                )
                ->where(
                    'course_id',
                    $course->id
                )
                ->where(
                    'status',
                    'success'
                )
                ->exists();

            if($alreadyPurchased)
            {
                return redirect()
                    ->route('student.my.courses')
                    ->with(
                        'error',
                        'You already purchased this course'
                    );
            }

            // Save Payment

            Payment::create([

                'user_id' => auth()->id(),

                'course_id' => $course->id,

                'payment_id' =>
                    $request->razorpay_payment_id,

                'amount' =>
                    $request->amount,

                'status' => 'success'

            ]);

            // Admin Notification

            Notification::create([

                'title' => 'New Payment',

                'message' =>
                    auth()->user()->name.
                    ' purchased '.
                    $course->title,

                'link' => '/admin/payments'

            ]);

            return redirect()
                ->route('student.dashboard')
                ->with(
                    'success',
                    'Payment Successful'
                );
        }

        public function downloadInvoice($id)
        {
            $payment = Payment::with([
                'course',
                'user'
            ])->findOrFail($id);

            // Security

            if($payment->user_id != auth()->id())
            {
                abort(403);
            }

            $pdf = Pdf::loadView(
                'invoice',
                compact('payment')
            );

            return $pdf->download(
                'invoice-'.$payment->id.'.pdf'
            );
        }


    
}