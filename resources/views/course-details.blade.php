@extends('layouts.site')

@section('content')

<div class="row align-items-center">

    <div class="col-md-6 mb-4">

        @if($course->image)
            <img src="/uploads/{{ $course->image }}"
                 class="img-fluid rounded shadow w-100">
        @else
            <img src="https://via.placeholder.com/600x400?text=Course+Image"
                 class="img-fluid rounded shadow w-100">
        @endif

    </div>

    <div class="col-md-6">

        <h2 class="mb-3">{{ $course->title }}</h2>

        <p class="text-muted mb-4">
            {{ $course->description }}
        </p>

        <h3 class="text-success mb-4">
            ₹{{ $course->price }}
        </h3>

        {{-- Active Course --}}
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

        <div class="mt-4">
            <a href="{{ route('courses') }}" class="btn btn-outline-dark">
                Back to Courses
            </a>
        </div>

    </div>

</div>

@endsection