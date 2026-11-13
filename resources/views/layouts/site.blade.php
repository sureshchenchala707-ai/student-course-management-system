
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Student Course Management System')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Template Vendor CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

    <!-- Academica Main CSS -->
    <link href="{{ asset('academica/assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')

</head>

<body class="index-page">

    <!-- Header -->
    <header id="header" class="header d-flex align-items-center fixed-top">

        <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">Academica</h1>
            </a>

            <!-- Navigation -->
            <nav id="navmenu" class="navmenu">

                <ul>

                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>

                    <li>
                        <a href="{{ url('/about') }}">About</a>
                    </li>

                    <li>
                        <a href="{{ url('/courses') }}">Courses</a>
                    </li>

                    <li>
                        <a href="{{ url('/contact') }}">Contact</a>
                    </li>

                    @guest

                        <li>
                            <a href="{{ url('/student/login') }}">Student Login</a>
                        </li>

                        <!-- <li>
                            <a href="{{ url('/admin/login') }}">Admin Login</a>
                        </li> -->

                        <li>
                            <a href="{{ url('/register') }}">Register</a>
                        </li>

                    @endguest

                    @auth

                        <li>
                            <a href="{{ url('/student/dashboard') }}">Dashboard</a>
                        </li>

                    @endauth

                </ul>

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

            </nav>

            <!-- Get Started Button -->
            @guest
                <a class="btn-getstarted" href="{{ url('/register') }}">
                    Get Started
                </a>
            @endguest

            @auth
                <a class="btn-getstarted" href="{{ url('/student/dashboard') }}">
                    Dashboard
                </a>
            @endauth

        </div>

    </header>
    <!-- End Header -->


    <!-- Main Content -->
    <main class="main">

        @yield('content')

    </main>
    <!-- End Main Content -->


    <!-- Footer -->
    <footer id="footer" class="footer accent-background">

        <div class="container footer-top">

            <div class="row gy-4">

                <!-- About -->
                <div class="col-lg-5 col-md-12 footer-about">

                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <span class="sitename">Academica</span>
                    </a>

                    <p>
                        Welcome to Student Course Management System.
                        Explore courses, improve your skills and
                        build your future with expert learning.
                    </p>

                    <div class="social-links d-flex mt-4">

                        <a href="#"><i class="bi bi-facebook"></i></a>

                        <a href="#"><i class="bi bi-instagram"></i></a>

                        <a href="#"><i class="bi bi-linkedin"></i></a>

                    </div>

                </div>


                <!-- Useful Links -->
                <div class="col-lg-2 col-6 footer-links">

                    <h4>Useful Links</h4>

                    <ul>

                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li><a href="{{ url('/about') }}">About</a></li>

                        <li><a href="{{ url('/courses') }}">Courses</a></li>

                        <li><a href="{{ url('/contact') }}">Contact</a></li>

                    </ul>

                </div>


                <!-- Student Links -->
                <div class="col-lg-2 col-6 footer-links">

                    <h4>Student Links</h4>

                    <ul>

                        <li><a href="{{ url('/student/login') }}">Student Login</a></li>

                        <li><a href="{{ url('/register') }}">Register</a></li>

                        <li><a href="{{ url('/student/dashboard') }}">Dashboard</a></li>

                    </ul>

                </div>


                <!-- Contact -->
                <div class="col-lg-3 col-md-12 footer-contact">

                    <h4>Contact Us</h4>

                    <p>Student Course Management System</p>

                    <p class="mt-4">
                        <strong>Email:</strong>
                        <span>support@example.com</span>
                    </p>

                </div>

            </div>

        </div>


        <!-- Copyright -->
        <div class="container copyright text-center mt-4">

            <p>
                © 2026
                <strong class="px-1 sitename">Academica</strong>
                All Rights Reserved
            </p>

            <div class="credits">
                Student Course Management System
            </div>

        </div>

    </footer>
    <!-- End Footer -->


    <!-- Scroll Top -->
    <a href="#"
       id="scroll-top"
       class="scroll-top d-flex align-items-center justify-content-center">

        <i class="bi bi-arrow-up-short"></i>

    </a>


    <!-- Success / Error Toast -->
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


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendor JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.5.0/dist/purecounter_vanilla.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Academica Main JS -->
    <script src="{{ asset('academica/assets/js/main.js') }}"></script>


    <!-- Toast Script -->
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

    @stack('scripts')

</body>
</html>
