
@extends('layouts.admin')

@section('content')

<h2 class="mb-4">

Contact Messages

</h2>

<div class="card p-4">
<div class="table-responsive">

    <table class="table table-bordered">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Subject</th>

<th>Action</th>

<th>Date</th>

</tr>

@foreach($contacts as $contact)

<tr>

<td>{{ $contact->id }}</td>

<td>{{ $contact->name }}</td>

<td>{{ $contact->email }}</td>

<td>{{ $contact->subject }}</td>

<td>

<button
class="btn btn-primary btn-sm"
data-bs-toggle="modal"
data-bs-target="#contactModal{{ $contact->id }}">

View

</button>

</td>

<td>{{ $contact->created_at->format('d M Y') }}</td>

</tr>
<!-- modal -->
 <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Message</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    <strong>Name:</strong>
                    {{ $contact->name }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $contact->email }}
                </p>

                <p>
                    <strong>Subject:</strong>
                    {{ $contact->subject }}
                </p>

                <hr />

                <p>{{ $contact->message }}</p>
            </div>

            <div class="modal-footer">
                <a href="mailto:{{ $contact->email }}" class="btn btn-success">Reply</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>

@endforeach

</table>


</div>

<div class="mt-3">

{{ $contacts->links() }}

</div>

</div>

@endsection

