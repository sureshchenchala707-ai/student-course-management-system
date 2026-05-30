@extends('layouts.site')

@section('content')

<div class="row justify-content-center">
<div class="col-md-6">

<div class="card p-4 text-center">

<h2>{{ $course->title }}</h2>

<p>{{ $course->description }}</p>

<h3 class="mb-4">₹{{ $course->price }}</h3>

<button id="rzp-button1" class="btn btn-success btn-lg">
Pay Now
</button>

</div>
</div>
</div>

<form action="{{ route('razorpay.payment') }}" method="POST" id="payment-form">
@csrf

<input type="hidden" name="course_id" value="{{ $course->id }}">
<input type="hidden" name="amount" value="{{ $course->price }}">
<input type="hidden" name="razorpay_payment_id" id="payment_id">

</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": "{{ $course->price * 100 }}",
    "currency": "INR",
    "name": "Student Courses",
    "description": "Course Purchase",
    "handler": function (response){

        document.getElementById('payment_id').value =
            response.razorpay_payment_id;

        document.getElementById('payment-form').submit();
    },

    "theme": {
        "color": "#0d6efd"
    }
};

var rzp1 = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

@endsection