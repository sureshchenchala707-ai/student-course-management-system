
@extends('layouts.site')

@section('title', 'Student Login')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Student Login</h1>
                        <p class="mb-0">
                            Login to your account and continue your learning journey.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Student Login</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Login Section -->
    <section class="contact section">

        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">

                    <div class="form-card">

                        <div class="form-header text-center">
                            <span class="badge-label">Welcome Back</span>
                            <h3>Student Login</h3>
                            <p>Login to access your student account.</p>
                        </div>

                        <!-- Success Alert -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Error Alert -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Please check the following:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="/student/login">

                            @csrf

                            <div class="row g-3">

                                <div class="col-12">
                                    <label for="email">Email Address</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}">
                                </div>

                                <div class="col-12">
                                    <label for="password">Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Enter your password">
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('student.forgot.password') }}">
                                        Forgot Password?
                                    </a>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn-send w-100">
                                        Login
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </section>

</main>

@endsection
