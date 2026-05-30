@extends('layouts.site')

@section('content')

<div class="row justify-content-center">
<div class="col-md-5">

<div class="card p-4">

<h2 class="mb-4 text-center">Student Login</h2>

<form method="POST" action="/student/login">
@csrf

<input type="email" name="email" class="form-control mb-3" placeholder="Email">

<input type="password" name="password" class="form-control mb-3" placeholder="Password">

<button class="btn btn-primary w-100">Login</button>

<a href="{{ route('student.forgot.password') }}" class="d-block mt-3 text-center">
    Forgot Password?
</a>

</form>

</div>
</div>
</div>

@endsection