
@extends('layouts.site')

@section('content')

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow p-4">

<h3 class="text-center mb-4">
Forgot Password
</h3>

<form method="POST"
action="{{ route('student.forgot.password') }}">

@csrf

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<input type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input type="password"
name="password_confirmation"
class="form-control"
required>

</div>

<button type="submit"
class="btn btn-primary w-100">

Reset Password

</button>

</form>

</div>

</div>

</div>

</div>

@endsection

