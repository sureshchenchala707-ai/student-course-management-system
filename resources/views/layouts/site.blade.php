<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Student Courses</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}
.navbar{
    background:#0d6efd;
}
.navbar a{
    color:#fff !important;
}
.card{
    border:none;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,.08);
}
footer{
    background:#111;
    color:#fff;
    padding:20px;
    margin-top:40px;
}


.navbar-brand{
    font-size:1.4rem;
    font-weight:700;
}

.nav-link{
    color:#fff !important;
    margin-left:10px;
}

.nav-link:hover{
    opacity:.8;
}

@media(max-width:991px){

.navbar-nav{
    text-align:center;
    padding-top:15px;
}

.nav-link{
    margin-left:0;
    padding:10px;
}

}
.offcanvas{
    width:280px !important;
    background: linear-gradient(
    to bottom,
    #6EC6FF 0%,
    #A7E0FF 50%,
    #FFFFFF 100%
);
}

.offcanvas-header{
    background:#2563eb;
    color:white;
}

.offcanvas-body a{
    text-decoration:none;
    display:block;
    padding:5px;
    color:#111827;
    /* border-radius:8px; */
    border-bottom: 1px solid #ddd;

}

.offcanvas-body a:hover{
    background:#eff6ff;
}


.btn-primary{
    border-radius:30px;
    padding:10px 22px;
    font-weight:600;
}

.btn-success{
    border-radius:30px;
}

.btn-warning{
    border-radius:30px;
}
</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"> Student Courses </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a href="/" class="nav-link"> Home </a>
                </li>

                <li class="nav-item">
                    <a href="/about" class="nav-link"> About </a>
                </li>

                <li class="nav-item">
                    <a href="/courses" class="nav-link"> Courses </a>
                </li>

                <li class="nav-item">
                    <a href="/contact" class="nav-link"> Contact </a>
                </li>

                @guest

                <li class="nav-item">
                    <a href="/student/login" class="nav-link"> Student Login </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/login" class="nav-link btn"> Admin Login </a>
                </li>

                <li class="nav-item">
                    <a href="/register" class="btn btn-outline-primary "> Register </a>
                </li>

                @endguest @auth

                <li class="nav-item">
                    <a href="/student/dashboard" class="btn btn-light btn-sm ms-lg-2 mt-2 mt-lg-0"> Dashboard </a>
                </li>

                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <h5>Menu</h5>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <a href="/" class="d-block mb-3">Home</a>

        <a href="/about" class="d-block mb-3">About</a>

        <a href="/courses" class="d-block mb-3">Courses</a>

        <a href="/contact" class="d-block mb-3">Contact</a>

        @guest

        <a href="/student/login" class="d-block mb-3"> Student Login </a>

        <a href="/admin/login" class="d-block mb-3"> Admin Login </a>

        <a href="/register" class="d-block"> Register </a>

        @endguest @auth

        <a href="/student/dashboard" class="d-block"> Dashboard </a>

        @endauth
    </div>
</div>



<div class="container py-5">
@yield('content')
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">

<p class="mb-0">

© 2026 Student Courses.
All Rights Reserved.

</p>

</footer>
@if(session('success') || session('error'))

<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">

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
data-bs-dismiss="toast"></button>

</div>
</div>
</div>

@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toastEl = document.getElementById('liveToast');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, {
            delay: 3000
        });
        toast.show();
    }
});
</script>
</body>
</html>