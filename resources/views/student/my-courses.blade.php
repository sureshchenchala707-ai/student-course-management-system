@extends('layouts.student')

@section('content')

<h2 class="mb-4">My Courses</h2>

<table class="table bg-white">

<tr>
<th>Course Name</th>
<th>Price</th>
<th>Purchased On</th>
<th>Status</th>
</tr>

@foreach($courses as $item)

<tr>
<td>{{ $item->course->title ?? 'Deleted Course' }}</td>
<td>₹{{ $item->amount }}</td>
<td>{{ $item->created_at->format('d M Y') }}</td>
<td><span class="badge bg-success">Purchased</span></td>
</tr>

@endforeach

</table>

@endsection