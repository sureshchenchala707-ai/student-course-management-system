@extends('layouts.admin')

@section('content')

<div class="card bg-white p-4">

<h2 class="mb-4">Edit Course</h2>

<form method="POST"
action="{{ route('admin.course.update',$course->id) }}"
enctype="multipart/form-data">

@csrf

<label>Course Title</label>
<input type="text"
name="title"
value="{{ $course->title }}"
class="form-control mb-3">

<label>Description</label>
<textarea name="description"
class="form-control mb-3">{{ $course->description }}</textarea>

<div class="mb-3">

<label class="form-label">
Category
</label>

<select name="category_id"
class="form-control">

@foreach($categories as $cat)

<option value="{{ $cat->id }}"
{{ $course->category_id == $cat->id ? 'selected' : '' }}>

{{ $cat->name }}

</option>

@endforeach

</select>

</div>

<label>Price</label>
<input type="number"
name="price"
value="{{ $course->price }}"
class="form-control mb-3">

<label>Status</label>
<select name="status" class="form-control mb-3">

<option value="active"
{{ $course->status=='active' ? 'selected':'' }}>
Enroll Now
</option>

<option value="coming_soon"
{{ $course->status=='coming_soon' ? 'selected':'' }}>
Coming Soon
</option>

<option value="inactive"
{{ $course->status=='inactive' ? 'selected':'' }}>
Inactive
</option>

</select>

<label>Current Image</label><br>

@if($course->image)
<img src="/uploads/{{ $course->image }}"
width="120"
class="mb-3">
@endif

<label>Change Image</label>
<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-success">
Update Course
</button>

</form>

</div>

@endsection