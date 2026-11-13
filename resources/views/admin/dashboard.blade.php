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

<div class="card mt-4 p-4">
    <h4 class="mb-3">Recent Notifications</h4>

    @forelse($notifications as $note)
        <div class="notification-item">
            <strong>{{ $note->title }}</strong>
            <p class="mb-1">{{ $note->message }}</p>
            <small class="text-muted">
                {{ $note->created_at->diffForHumans() }}
            </small>
        </div>
    @empty
        <p class="text-muted mb-0">No notifications yet.</p>
    @endforelse
</div>
</div>

</div>

@endsection