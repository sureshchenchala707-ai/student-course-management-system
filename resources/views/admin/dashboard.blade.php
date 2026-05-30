@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Dashboard Overview</h2>

<div class="row g-4">

<div class="col-md-6">
<div class="card-box">
<h2>{{ $students }}</h2>
<p>Total Students</p>
</div>
</div>

<div class="col-md-6">
<div class="card-box">
<h2>{{ $payments }}</h2>
<p>Total Payments</p>
</div>

<div class="card bg-white p-4 mt-4">

<h4>Recent Notifications</h4>

@forelse($notifications as $note)

<div class="border-bottom py-2">
<strong>{{ $note->title }}</strong><br>
{{ $note->message }}

<small class="text-muted d-block">
{{ $note->created_at->diffForHumans() }}
</small>
</div>

@empty
<p>No notifications yet</p>
@endforelse

</div>
</div>

</div>

@endsection