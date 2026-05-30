@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Students List</h2>

<div class="card bg-white p-3 shadow-sm">

<div class="table-responsive">
    <table class="table table-bordered align-middle">
    <tr class="table-light">
        <th>#</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Joined</th>
    </tr>

    @foreach($students as $key => $student)

    <tr>
        <td>{{ $key + 1 }}</td>

        <td>
            @if($student->photo)
            <img
                src="{{ asset('profiles/'.$student->photo) }}"
                width="55"
                height="55"
                style="object-fit: cover; border-radius: 50%"
            />
            @else
            <img src="https://via.placeholder.com/55" style="border-radius: 50%" />
            @endif
        </td>

        <td>{{ $student->name }}</td>

        <td>{{ $student->email }}</td>

        <td>{{ $student->phone ?: '-' }}</td>

        <td>{{ $student->address ?: '-' }}</td>

        <td>{{ $student->created_at->format('d M Y') }}</td>
    </tr>

    @endforeach
</table>

</div>


<div class="mt-3">
    {{ $students->links() }}
</div>
</div>

@endsection

<style>
    svg{
        width: 20px;
    }
</style>