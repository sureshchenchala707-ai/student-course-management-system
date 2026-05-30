@extends('layouts.site')

@section('content')

<h2 class="mb-4 text-center">All Courses</h2>
<form method="GET" action="{{ route('courses') }}" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search Course..."
            value="{{ request('search') }}"
        />

        <button class="btn btn-primary">Search</button>
    </div>
</form>
<!-- <input type="text" id="courseSearch" class="form-control mb-4" placeholder="🔍 Search Courses..."> -->


<div class="mb-4 d-flex flex-wrap gap-2">
    <a href="{{ route('courses') }}" class="btn {{ request('category') ? 'btn-outline-primary' : 'btn-primary' }}">
        All
    </a>

    @foreach($categories as $cat)

    <a
        href="{{ route('courses',['category'=>$cat->id]) }}"
        class="btn {{ request('category') == $cat->id ? 'btn-primary' : 'btn-outline-secondary' }}"
    >
        {{ $cat->name }}
    </a>

    @endforeach
</div>


<div class="row">

@foreach($courses as $course)

<div class="col-md-4 mb-4">

<div class="card p-3 h-100 shadow-sm border-0">

{{-- Course Image --}}
@if($course->image)

<img src="{{ asset('uploads/'.$course->image) }}"
class="img-fluid rounded mb-3"
style="height:220px; width:100%; object-fit:cover;">

@else

<img src="https://via.placeholder.com/400x220?text=No+Image"
class="img-fluid rounded mb-3">

@endif
<span class="badge bg-primary mb-2">

{{ $course->category->name ?? 'General' }}

</span>

<h4>{{ $course->title }}</h4>

<p class="text-muted">
{{ Str::limit($course->description,80) }}
</p>

<h5 class="text-success mb-3">
₹{{ $course->price }}
</h5>

<a href="{{ route('course.details',$course->id) }}"
class="btn btn-outline-primary w-100 mb-2">
View Details
</a>

@auth

    @php
        $purchased = \App\Models\Payment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('status', 'success')
            ->exists();
    @endphp

    @if($purchased)

        <button class="btn btn-success">
            ✓ Purchased
        </button>

    @elseif($course->status == 'active')

        <a href="{{ route('buy.course', $course->id) }}"
           class="btn btn-primary">
            Enroll Now
        </a>

    @elseif($course->status == 'coming_soon')

        <button class="btn btn-warning">
            Coming Soon
        </button>

    @endif

@else

    {{-- Guest Users --}}
    
    @if($course->status == 'active')

        <a href="{{ route('login') }}"
           class="btn btn-primary">
            Login to Enroll
        </a>

    @elseif($course->status == 'coming_soon')

        <button class="btn btn-warning">
            Coming Soon
        </button>

    @endif

@endauth
</div>

</div>

@endforeach

@if($courses->count()==0)

<div class="alert alert-warning">

No courses found.

</div>

@endif

</div>

@endsection
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
