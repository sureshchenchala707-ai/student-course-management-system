@extends('layouts.admin')

@section('content')

<h2 class="mb-4">All Payments</h2>
<div class="table-responsive">

    <table class="table bg-white table-bordered">
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Email</th>
        <th>Course</th>
        <th>Payment ID</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

    @foreach($payments as $pay)

    <tr>
        <td>{{ $pay->id }}</td>
        <td>{{ $pay->user->name ?? '-' }}</td>
        <td>{{ $pay->user->email ?? '-' }}</td>
        <td>{{ $pay->course->title ?? 'Deleted Course' }}</td>
        <td>{{ $pay->payment_id }}</td>
        <td>₹{{ $pay->amount }}</td>
        <td>
            <span class="badge bg-success"> {{ ucfirst($pay->status) }} </span>
        </td>
        <td>{{ $pay->created_at->format('d M Y') }}</td>
    </tr>

    @endforeach
</table>


</div>

@endsection