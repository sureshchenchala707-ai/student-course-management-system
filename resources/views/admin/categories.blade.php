
@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Course Categories</h2>

<div class="card p-4 mb-4">

<form method="POST"
action="{{ route('admin.categories.store') }}">

@csrf

<div class="row">

<div class="col-md-10">

<input type="text"
name="name"
class="form-control mb-3"
placeholder="Enter Category Name">

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">
Add
</button>

</div>

</div>

</form>

</div>

<div class="card p-4">
<div class="table-responsive">
    <table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
</tr>

@foreach($categories as $cat)

<tr>
<td>{{ $cat->id }}</td>
<td>{{ $cat->name }}</td>
</tr>

@endforeach

</table>
</div>


</div>

@endsection

