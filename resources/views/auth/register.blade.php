
@extends('layouts.site')

@section('title', 'Student Registration')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Student Registration</h1>
                        <p class="mb-0">
                            Create your student account and start learning with us.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Register</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Registration Section -->
    <section class="contact section">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">

                    <div class="form-card">

                        <div class="form-header text-center">
                            <span class="badge-label">Join Us</span>
                            <h3>Create Your Account</h3>
                            <p>Register to access our courses.</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row g-3">

                                <div class="col-12">
                                    <label for="name">Full Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        placeholder="Enter your full name"
                                        value="{{ old('name') }}">
                                </div>

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
                                        placeholder="Enter password | Minimum 8 characters">
                                </div>

                                <div class="col-12">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm your password">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn-send w-100">
                                        Register
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <p class="mb-0">
                                        Already registered?
                                        <a href="{{ route('student.login') }}">
                                            Login Here
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<!-- Live Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3"
     style="z-index: 1100;">

    @if(session('success'))
        <div id="liveToastSuccess"
             class="toast align-items-center text-bg-success border-0"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">

            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="liveToastError"
             class="toast align-items-center text-bg-danger border-0"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">

            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div id="liveToastValidation"
             class="toast align-items-center text-bg-danger border-0"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">

            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ $errors->first() }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const toastIds = [
        'liveToastSuccess',
        'liveToastError',
        'liveToastValidation'
    ];

    toastIds.forEach(function (id) {
        const toastElement = document.getElementById(id);

        if (toastElement) {
            const toast = new bootstrap.Toast(toastElement, {
                animation: true,
                autohide: true,
                delay: 4000
            });

            toast.show();
        }
    });

});
</script>

@endsection
