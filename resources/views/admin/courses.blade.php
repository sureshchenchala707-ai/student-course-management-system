@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Manage Courses</h2>

<a href="{{ route('admin.course.create') }}" class="btn btn-primary mb-3">
+ Add Course
</a>
<div class="table-responsive">

    <table class="table bg-white table-bordered">
    <tr>
        <th>Photo</th>
        <th>Title</th>
        <th>Price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    @foreach($courses as $course)

    <tr>
        <td>
            @if($course->image)
            <img src="/uploads/{{ $course->image }}" width="70" />
            @endif
        </td>

        <td>{{ $course->title }}</td>

        <td>₹{{ $course->price }}</td>

        <td>
            <form method="POST" action="{{ route('admin.course.status',$course->id) }}">
                @csrf

                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="active" {{ $course->status=='active' ? 'selected' : '' }}> Enroll Now</option>

                    <option value="coming_soon" {{ $course->
                        status=='coming_soon' ? 'selected' : '' }}> Coming Soon
                    </option>

                    <option value="inactive" {{ $course->status=='inactive' ? 'selected' : '' }}> Inactive</option>
                </select>
            </form>
        </td>

        <td>
            <a href="{{ route('admin.course.edit',$course->id) }}" class="btn btn-warning btn-sm"> Edit </a>

            <a
                href="{{ route('admin.course.delete',$course->id) }}"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Delete this course?')"
            >
                Delete
            </a>
        </td>
    </tr>

    @endforeach
</table>


</div>


@endsection