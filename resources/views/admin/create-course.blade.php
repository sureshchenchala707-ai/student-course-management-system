@extends('layouts.admin')

@section('content')

@php
$categories = \App\Models\Category::all();
@endphp

<div class="card bg-white p-4">

<h2>Add Course</h2>

<form method="POST"
action="{{ route('admin.course.store') }}"
enctype="multipart/form-data">

@csrf

<label>Course Title</label>
<input type="text" name="title" class="form-control mb-3">

<div class="mb-3">

<label>Category</label>

<select name="category_id"
class="form-control">

<option value="">Select Category</option>

@foreach($categories as $cat)

<option value="{{ $cat->id }}">
{{ $cat->name }}
</option>

@endforeach

</select>

</div>

<label>Description</label>
<textarea name="description" class="form-control mb-3"></textarea>

<label>Price</label>
<input type="number" name="price" class="form-control mb-3">

<label>Photo</label>
<input type="file" name="image" class="form-control mb-3">

<label>Status</label>
<select name="status" class="form-control mb-3">
<option value="active">Enroll Now</option>
<option value="coming_soon">Coming Soon</option>
<option value="inactive">Inactive</option>
</select>

<button type="submit"
id="submitBtn"
class="btn btn-primary">

Add Course

</button>

</form>

</div>

@endsection

<script>

document.querySelector("form")
.addEventListener("submit", function(){

    let btn = document.getElementById("submitBtn");

    btn.disabled = true;

    btn.innerText = "Please Wait...";

});

</script>