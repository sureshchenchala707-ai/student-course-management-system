@extends('layouts.student')

@section('content')

<h2 class="mb-4">Payment History</h2>

<table class="table bg-white">

<tr>
<th>Payment ID</th>
<th>Course Name</th>
<th>Amount</th>
<th>Status</th>
<th>Date</th>
<th>Invoice</th>
</tr>

@foreach($payments as $pay)

<tr>
<td>{{ $pay->payment_id }}</td>
<td>{{ $pay->course->title ?? 'Deleted Course' }}</td>
<td>₹{{ $pay->amount }}</td>
<td>{{ ucfirst($pay->status) }}</td>
<td>{{ $pay->created_at->format('d M Y') }}</td>
<td>
    <a href="{{ route('invoice.download',$pay->id) }}">
PDF Invoice
</a>
</td>
</tr>

@endforeach

</table>

@endsection