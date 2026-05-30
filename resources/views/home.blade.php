@extends('layouts.site')

@section('content')

<h1 class="mb-4 text-center">Welcome to Student Courses</h1>

<div class="row">

@foreach($courses as $course)

<div class="col-md-4 mb-4">
<div class="card p-4">

@if($course->image)
<img src="/uploads/{{ $course->image }}" class="img-fluid mb-3">
@endif

<h4>{{ $course->title }}</h4>

<p>{{ $course->description }}</p>

<h5 class="mb-3">₹{{ $course->price }}</h5>

 {{-- Active Course --}}
       @auth

@php

$purchased = \App\Models\Payment::where(
    'user_id',
    auth()->id()
)->where(
    'course_id',
    $course->id
)->where(
    'status',
    'success'
)->exists();

@endphp

@if($purchased)

<button class="btn btn-success">

✓ Purchased

</button>

@elseif($course->status == 'active')

<a href="{{ route('buy.course',$course->id) }}"
class="btn btn-primary">

Enroll Now

</a>

@elseif($course->status == 'coming_soon')

<button class="btn btn-warning">

Coming Soon

</button>

@endif

@else

@if($course->status == 'active')

<a href="{{ route('student.login') }}"
class="btn btn-primary">

Enroll Now

</a>

@elseif($course->status == 'coming_soon')

<button class="btn btn-warning">

Coming Soon

</button>

@endif

@endauth

<a href="{{ route('course.details',$course->id) }}"
class="btn btn-outline-primary w-100 mb-2 mt-1">
View Details
</a>

</div>
</div>

@endforeach

</div>

@endsection


<!-- ************* -->

<style>
    
.course-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.course-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.course-card img{
    height:220px;
    object-fit:cover;
}

.course-card .price{
    color:#2563eb;
    font-size:24px;
    font-weight:700;
}


</style>
