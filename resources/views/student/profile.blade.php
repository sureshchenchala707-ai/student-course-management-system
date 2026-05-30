@extends('layouts.student')

@section('content')

<style>
.profile-card{
    border:none;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.avatar{
    width:140px;
    height:140px;
    object-fit:cover;
    border-radius:50%;
    border:5px solid #f1f1f1;
}

.info-box{
    background:#f8f9fa;
    border-radius:12px;
    padding:15px;
    margin-bottom:15px;
}

.tab-btn{
    border:none;
    background:#e9ecef;
    padding:10px 18px;
    border-radius:10px;
    margin-right:10px;
    font-weight:600;
}

.tab-btn.active{
    background:#0d6efd;
    color:white;
}
</style>

<div class="card profile-card p-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="mb-0">My Profile</h2>

<div>
<button class="tab-btn active"
id="profileBtn"
onclick="showTab('profileTab',this)">
Profile
</button>

<button class="tab-btn"
id="passwordBtn"
onclick="showTab('passwordTab',this)">
Password
</button>
</div>

</div>

{{-- Profile Tab --}}
<div id="profileTab">

<div class="row align-items-center">

<div class="col-md-3 text-center mb-4">

@if($user->photo)
<img src="/profiles/{{ $user->photo }}" class="avatar">
@else
<img src="https://via.placeholder.com/140"
class="avatar">
@endif

</div>

<div class="col-md-9">

<div class="row">

<div class="col-md-6">
<div class="info-box">
<strong>Name</strong><br>
{{ $user->name }}
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<strong>Email</strong><br>
{{ $user->email }}
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<strong>Mobile</strong><br>
{{ $user->phone ?: 'Not Added' }}
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<strong>Address</strong><br>
{{ $user->address ?: 'Not Added' }}
</div>
</div>

</div>

<button class="btn btn-primary mt-2"
onclick="toggleEdit()">
Edit Profile
</button>

</div>

</div>

{{-- Edit Form --}}
<div id="editForm"
style="display:none;"
class="mt-4 border-top pt-4">

<h4 class="mb-3">Update Profile</h4>

<form method="POST"
action="{{ route('student.profile.update') }}"
enctype="multipart/form-data">

@csrf

<div class="row">

<div class="col-md-6">
<input type="text"
name="name"
value="{{ $user->name }}"
class="form-control mb-3"
placeholder="Name">
</div>

<div class="col-md-6">
<input type="email"
name="email"
value="{{ $user->email }}"
class="form-control mb-3"
placeholder="Email">
</div>

<div class="col-md-6">
<input type="text"
name="phone"
value="{{ $user->phone }}"
class="form-control mb-3"
placeholder="Mobile Number">
</div>

<div class="col-md-6">
<input type="file"
name="photo"
class="form-control mb-3">
</div>

<div class="col-md-12">
<textarea name="address"
class="form-control mb-3"
placeholder="Address">{{ $user->address }}</textarea>
</div>

</div>

<button class="btn btn-success">
Save Changes
</button>

</form>

</div>

</div>

{{-- Password Tab --}}
<div id="passwordTab" style="display:none;">

<div class="row justify-content-center">
<div class="col-md-6">

<div class="card p-4 border-0 shadow-sm">

<h4 class="mb-3">Change Password</h4>

<form method="POST"
action="{{ route('student.password') }}">

@csrf

<input type="password"
name="current_password"
class="form-control mb-3"
placeholder="Current Password">

<input type="password"
name="new_password"
class="form-control mb-3"
placeholder="New Password">

<button class="btn btn-danger w-100">
Update Password
</button>

</form>

</div>

</div>
</div>

</div>

</div>

<script>
function toggleEdit(){
    let form = document.getElementById('editForm');

    if(form.style.display == 'none'){
        form.style.display = 'block';
    }else{
        form.style.display = 'none';
    }
}

function showTab(tab,btn){

    document.getElementById('profileTab').style.display='none';
    document.getElementById('passwordTab').style.display='none';

    document.getElementById(tab).style.display='block';

    document.getElementById('profileBtn').classList.remove('active');
    document.getElementById('passwordBtn').classList.remove('active');

    btn.classList.add('active');
}
</script>

@endsection