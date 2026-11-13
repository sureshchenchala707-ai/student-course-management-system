
@extends('layouts.site')

@section('title', 'Main Admin Login')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Main Admin Login</h1>
                        <p class="mb-0">
                            Login to access the administration dashboard.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Admin Login</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Admin Login Section -->
    <section class="contact section">

        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-8">

                    <div class="form-card">

                        <div class="form-header text-center">
                            <span class="badge-label">Administration</span>
                            <h3>Main Admin Login</h3>
                            <p>
                                Enter your admin credentials to continue.
                            </p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="/admin/login">

                            @csrf

                            <div class="row g-3">

                                <!-- Email -->
                                <div class="col-12">
                                    <label for="email">Email Address</label>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        placeholder="Enter admin email"
                                        value="{{ old('email') }}">
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <label for="password">Password</label>

                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Enter password">
                                </div>

                                <!-- Login Button -->
                                <div class="col-12">
                                    <button type="submit"
                                            class="btn-send w-100">
                                        Admin Login
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

<!-- Live Toast Notifications -->
<div class="toast-container position-fixed top-0 end-0 p-3"
     style="z-index: 1100;">

    @if(session('success'))
        <div id="adminSuccessToast"
             class="toast align-items-center text-bg-success border-0"
             role="alert" aria-live="assertive" aria-atomic="true">

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
        <div id="adminErrorToast"
             class="toast align-items-center text-bg-danger border-0"
             role="alert" aria-live="assertive" aria-atomic="true">

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
        <div id="adminValidationToast"
             class="toast align-items-center text-bg-danger border-0"
             role="alert" aria-live="assertive" aria-atomic="true">

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
        'adminSuccessToast',
        'adminErrorToast',
        'adminValidationToast'
    ];

    toastIds.forEach(function (id) {
        const element = document.getElementById(id);

        if (element) {
            const toast = new bootstrap.Toast(element, {
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
