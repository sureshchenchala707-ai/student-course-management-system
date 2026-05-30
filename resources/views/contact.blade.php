@extends('layouts.site')

@section('content')

<div class="card p-4">

<h2>Contact Us</h2>

<form method="POST" action="{{ route('contact.save') }}">
@csrf

<input type="text" name="name" class="form-control mb-3" placeholder="Your Name">

<input type="email" name="email" class="form-control mb-3" placeholder="Email">

<input type="text" name="subject" class="form-control mb-3" placeholder="Subject">

<textarea name="message" class="form-control mb-3" placeholder="Message"></textarea>

<button class="btn btn-primary">Send Message</button>

</form>

</div>

@endsection