
@extends('layouts.site')

@section('title', 'Course Payment')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Course Payment</h1>
                        <p class="mb-0">
                            Complete your payment and get access to your course.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('courses') }}">Courses</a></li>
                    <li class="current">Payment</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Payment Section -->
    <section class="contact section">

        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">

                <div class="col-lg-7 col-md-9">

                    <div class="form-card">

                        <div class="form-header text-center">
                            <span class="badge-label">Secure Checkout</span>
                            <h3>Confirm Your Course</h3>
                            <p>
                                Review your course details before proceeding
                                with payment.
                            </p>
                        </div>

                        <!-- Course Details -->
                        <div class="info-card mb-4">

                            @if($course->image)
                                <img
                                    src="{{ asset('uploads/'.$course->image) }}"
                                    alt="{{ $course->title }}"
                                    class="img-fluid w-100 rounded mb-3"
                                    style="max-height:250px; object-fit:cover;">
                            @endif

                            <h4>{{ $course->title }}</h4>

                            <p class="text-muted">
                                {{ $course->description }}
                            </p>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Course Price</strong>

                                <h3 class="text-success mb-0">
                                    ₹{{ number_format($course->price, 2) }}
                                </h3>
                            </div>

                        </div>

                        <!-- Payment Button -->
                        <div class="pricing-actions">

                            <button
                                type="button"
                                id="rzp-button1"
                                class="btn-send w-100">

                                <i class="bi bi-shield-lock me-2"></i>
                                Pay ₹{{ number_format($course->price, 2) }}

                            </button>

                            <a href="{{ route('course.details', $course->id) }}"
                               class="btn btn-outline-secondary w-100 mt-3">
                                Back to Course
                            </a>

                        </div>

                        <p class="text-center text-muted mt-4 mb-0">
                            <i class="bi bi-lock-fill"></i>
                            Secure payment powered by Razorpay.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

</main>

<!-- Payment Form -->
<form action="{{ route('razorpay.payment') }}"
      method="POST"
      id="payment-form">

    @csrf

    <input type="hidden" name="course_id" value="{{ $course->id }}">

    <input type="hidden" name="amount" value="{{ $course->price }}">

    <input type="hidden"
           name="razorpay_payment_id"
           id="payment_id">

</form>

<!-- Razorpay Checkout -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var options = {
        "key": "{{ config('services.razorpay.key') ?? env('RAZORPAY_KEY') }}",
        "amount": "{{ $course->price * 100 }}",
        "currency": "INR",
        "name": "Student Courses",
        "description": "{{ $course->title }}",

        "handler": function (response) {

            document.getElementById('payment_id').value =
                response.razorpay_payment_id;

            document.getElementById('payment-form').submit();
        },

        "modal": {
            "ondismiss": function () {
                console.log('Payment popup closed by user.');
            }
        },

        "theme": {
            "color": "#0d6efd"
        }
    };

    var rzp1 = new Razorpay(options);

    document.getElementById('rzp-button1').onclick = function (e) {
        e.preventDefault();
        rzp1.open();
    };

});
</script>

@endsection
