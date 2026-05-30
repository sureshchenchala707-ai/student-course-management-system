<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Student Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial,sans-serif;
}

/* Sidebar */

.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:purple;
    padding-top:20px;
    overflow:auto;
}

.sidebar h3{
    color:white;
    text-align:center;
    margin-bottom:35px;
    font-weight:bold;
}

.sidebar a{
    display:block;
    color:#d1d5db;
    text-decoration:none;
    padding:14px 25px;
    transition:.3s;
    font-size:15px;
}

.sidebar a:hover{
    background:#1e293b;
    color:white;
}

.sidebar a i{
    margin-right:10px;
}

/* Main */

.main{
    margin-left:250px;
    padding:30px;
}

/* Topbar */

.topbar{
    background:white;
    padding:18px 25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
    margin-bottom:25px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* Cards */

.card-box{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 20px rgba(0,0,0,.05);
}

/* Notification */

.notification-btn{
    width:50px;
    height:50px;
    border-radius:12px;
    border:none;
    background:#f3f4f6;
    position:relative;
}

.notification-badge{
    position:absolute;
    top:-5px;
    right:-5px;
}

.notification-dropdown{
    width:350px;
    border:none;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
    padding:10px;
}

.notification-item{
    border-bottom:1px solid #eee;
    padding:12px 10px;
}

.notification-item:last-child{
    border:none;
}

.notification-item:hover{
    background:#f8fafc;
}

.notification-title{
    font-weight:bold;
    color:#111827;
}

.notification-message{
    font-size:14px;
    color:#6b7280;
}

.notification-time{
    font-size:12px;
    color:#9ca3af;
}

/* Responsive */

@media(max-width:768px){

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
    }

    .main{
        margin-left:0;
    }
}

</style>

</head>
<body>

<!-- Sidebar -->

<div class="sidebar">

<h3>Student Panel</h3>

<a href="/student/dashboard">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="/student/my-courses">
<i class="fa fa-book"></i>
My Courses
</a>

<a href="/student/payment-history">
<i class="fa fa-credit-card"></i>
Payment History
</a>

<a href="/student/profile">
<i class="fa fa-user"></i>
Profile
</a>

<a href="/">
<i class="fa fa-globe"></i>
Visit Website
</a>

<form method="POST"
action="{{ route('student.logout') }}"
class="px-3 mt-4">

@csrf

<button class="btn btn-danger w-100">
<i class="fa fa-sign-out-alt"></i>
Logout
</button>

</form>

</div>

<!-- Main -->

<div class="main">

<!-- Topbar -->

<div class="topbar">

<div>
<h5 class="mb-0">
Welcome {{ Auth::user()->name }}
</h5>
</div>

<!-- Notifications -->

<div class="dropdown">

<button id="notificationBtn"
class="notification-btn"
data-bs-toggle="dropdown">

<i class="fa fa-bell"></i>

@if($notifyCount > 0)

<span id="notifyCount"
class="badge bg-danger notification-badge">

{{ $notifyCount }}

</span>

@endif

</button>

<div class="dropdown-menu dropdown-menu-end notification-dropdown">

<!-- Header -->

<div class="d-flex justify-content-between align-items-center mb-2">

<h6 class="mb-0">Notifications</h6>

<a href="{{ route('student.notifications.clear') }}"
class="btn btn-sm btn-danger">

<i class="fa fa-trash"></i>

</a>

</div>

<!-- Notification List -->

<div id="notificationList">

@forelse($notifications as $note)

<div class="notification-item">

<a href="{{ route('notification.read',$note->id) }}"
class="text-decoration-none">

<div class="notification-title">
{{ $note->title }}
</div>

<div class="notification-message">
{{ $note->message }}
</div>

<div class="notification-time">
{{ $note->created_at->diffForHumans() }}
</div>

</a>

<div class="text-end mt-2">

<a href="{{ route('student.notification.delete',$note->id) }}"
class="btn btn-sm btn-outline-danger">

Delete

</a>

</div>

</div>

@empty

<p class="text-center text-muted m-3">
No Notifications
</p>

@endforelse

</div>

</div>

</div>

</div>

<!-- Page Content -->

@yield('content')

</div>

<!-- Toast Alerts -->

@if(session('success') || session('error'))

<div class="toast-container position-fixed top-0 end-0 p-3"
style="z-index:9999;">

<div id="liveToast"
class="toast align-items-center text-white border-0
{{ session('success') ? 'bg-success' : 'bg-danger' }}"
role="alert">

<div class="d-flex">

<div class="toast-body">

{{ session('success') ?? session('error') }}

</div>

<button type="button"
class="btn-close btn-close-white me-2 m-auto"
data-bs-dismiss="toast">
</button>

</div>

</div>

</div>

@endif

<!-- Sound -->

<audio id="notifySound"
src="/sounds/notify.mp3"
preload="auto">
</audio>

<!-- JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

// Toast

document.addEventListener("DOMContentLoaded", function () {

    const toastEl = document.getElementById('liveToast');

    if (toastEl) {

        const toast = new bootstrap.Toast(toastEl, {
            delay:3000
        });

        toast.show();
    }

});

// Notification Sound + Count

let lastCount = {{ $notifyCount ?? 0 }};

function updateCount(){

    fetch('/student/notifications/count')

    .then(res => res.json())

    .then(data => {

        let badge = document.getElementById('notifyCount');

        if(badge){
            badge.innerText = data.count;
        }

        if(data.count > lastCount){

            let audio = document.getElementById('notifySound');

            if(audio){
                audio.play();
            }
        }

        lastCount = data.count;

    });

}

// Every 5 sec

setInterval(updateCount,5000);

</script>

</body>
</html>

