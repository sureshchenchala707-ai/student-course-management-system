
@extends('layouts.site')

@section('title', $course->title . ' - Course Details')

@section('content')

<main class="main course-details-page">

    <!-- Page Title -->
    <div class="page-title">

        <div class="heading">
            <div class="container">

                <div class="row justify-content-center text-center">

                    <div class="col-lg-8">

                        <h1 class="heading-title">Course Details</h1>

                        <p class="mb-0">
                            Explore the course, understand what you will learn
                            and take the next step in your learning journey.
                        </p>

                    </div>

                </div>

            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('courses') }}">Courses</a></li>
                    <li class="current">Course Details</li>
                </ol>

            </div>
        </nav>

    </div>
    <!-- End Page Title -->


    <!-- Course Details Section -->
    <section id="course-details" class="course-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">


            <!-- Course Banner -->
            <div class="course-banner"
                 data-aos="zoom-in"
                 data-aos-delay="150">

                @if($course->image)

                    <img
                        src="{{ asset('uploads/'.$course->image) }}"
                        alt="{{ $course->title }}"
                        class="img-fluid banner-img"
                    >

                @else

                    <img
                        src="{{ asset('academica/assets/img/education/courses-12.webp') }}"
                        alt="Course Preview"
                        class="img-fluid banner-img"
                    >

                @endif

                <div class="banner-overlay">

                    <div class="preview-label">
                        <i class="bi bi-mortarboard"></i>
                        Online Learning
                    </div>

                </div>

                <div class="banner-badges">

                    <span class="badge-category">
                        {{ $course->category->name ?? 'General' }}
                    </span>

                    <span class="badge-level">
                        {{ ucfirst(str_replace('_', ' ', $course->status)) }}
                    </span>

                </div>

            </div>
            <!-- End Course Banner -->


            <!-- Course Header -->
            <div class="course-header"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <h1>{{ $course->title }}</h1>

                        <!-- <p class="lead-text">
                            {{ $course->description }}
                        </p> -->

                        <div class="meta-row">

                            <div class="meta-item">

                                <i class="bi bi-book-fill"></i>

                                <span>Online Course</span>

                            </div>

                            <div class="meta-item">

                                <i class="bi bi-tag-fill"></i>

                                <span>
                                    {{ $course->category->name ?? 'General' }}
                                </span>

                            </div>

                            <div class="meta-item">

                                <i class="bi bi-check-circle-fill"></i>

                                <span>
                                    {{ ucfirst(str_replace('_', ' ', $course->status)) }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="instructor-badge">

                            <div class="instructor-photo d-flex align-items-center justify-content-center">

                                <i class="bi bi-mortarboard-fill"></i>

                            </div>

                            <div class="instructor-info">

                                <span class="instructor-label">
                                    Learning Platform
                                </span>

                                <h5>Student Courses</h5>

                                <span class="instructor-role">
                                    Online Education
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- End Course Header -->


            <div class="row">


                <!-- Sidebar -->
                <div class="col-lg-4 order-lg-2">


                    <!-- Pricing Card -->
                    <div class="pricing-card"
                         data-aos="fade-left"
                         data-aos-delay="200">

                        <div class="pricing-top">

                            <div class="price-tag">

                                <span class="price-now">
                                    ₹{{ number_format($course->price, 2) }}
                                </span>

                            </div>

                            <span class="savings-badge">
                                Course Price
                            </span>

                        </div>


                        <!-- Pricing Features -->
                        <div class="pricing-features">

                            <div class="feature-row">

                                <i class="bi bi-award"></i>

                                <span>Quality Learning</span>

                            </div>

                            <div class="feature-row">

                                <i class="bi bi-book"></i>

                                <span>Course Materials</span>

                            </div>

                            <div class="feature-row">

                                <i class="bi bi-laptop"></i>

                                <span>Online Learning</span>

                            </div>

                            <div class="feature-row">

                                <i class="bi bi-phone"></i>

                                <span>All Devices Supported</span>

                            </div>

                            <div class="feature-row">

                                <i class="bi bi-person-check"></i>

                                <span>Student Access</span>

                            </div>

                        </div>


                        <!-- Pricing Actions -->
                        <div class="pricing-actions">

                            @if($purchased)

                                <button class="btn-enroll" disabled>

                                    <i class="bi bi-check-circle"></i>
                                    Already Purchased

                                </button>

                            @elseif($course->status == 'active')

                                @auth

                                    <a href="{{ route('buy.course', $course->id) }}"
                                       class="btn-wishlist text-decoration-none">

                                        Enroll Now

                                    </a>

                                @else

                                    <a href="{{ route('student.login') }}"
                                       class="btn-wishlist text-decoration-none">

                                        Login to Enroll

                                    </a>

                                @endauth

                            @elseif($course->status == 'coming_soon')

                                <button class="btn-wishlist text-decoration-none" disabled>

                                    Coming Soon

                                </button>

                            @else

                                <button class="btn-wishlist text-decoration-none" disabled>

                                    Currently Unavailable

                                </button>

                            @endif

                            <br>
                            <a href="{{ route('courses') }}"
                               class="btn-wishlist text-decoration-none">

                                <i class="bi bi-arrow-left"></i>
                                Back to Courses

                            </a>

                        </div>


                        <div class="refund-note">

                            <i class="bi bi-shield-check"></i>

                            <span>Secure Course Enrollment</span>

                        </div>

                    </div>
                    <!-- End Pricing Card -->


                    <!-- Info Card -->
                    <div class="info-card"
                         data-aos="fade-left"
                         data-aos-delay="300">

                        <h4>Program Overview</h4>

                        <ul class="info-list">

                            <li>

                                <span class="info-label">Course</span>

                                <span class="info-value">
                                    {{ $course->title }}
                                </span>

                            </li>

                            <li>

                                <span class="info-label">Category</span>

                                <span class="info-value">
                                    {{ $course->category->name ?? 'General' }}
                                </span>

                            </li>

                            <li>

                                <span class="info-label">Price</span>

                                <span class="info-value">
                                    ₹{{ number_format($course->price, 2) }}
                                </span>

                            </li>

                            <li>

                                <span class="info-label">Status</span>

                                <span class="info-value">
                                    {{ ucfirst(str_replace('_', ' ', $course->status)) }}
                                </span>

                            </li>

                            <li>

                                <span class="info-label">Format</span>

                                <span class="info-value">Online</span>

                            </li>

                        </ul>

                    </div>
                    <!-- End Info Card -->


                    <!-- Social Card -->
                    <div class="social-card"
                         data-aos="fade-left"
                         data-aos-delay="400">

                        <h4>Spread the Word</h4>

                        <div class="social-row">

                            <a href="https://www.facebook.com/"
                               target="_blank"
                               class="social-btn sb-facebook"
                               aria-label="Facebook">

                                <i class="bi bi-facebook"></i>

                            </a>

                            <a href="https://twitter.com/"
                               target="_blank"
                               class="social-btn sb-twitter"
                               aria-label="Twitter">

                                <i class="bi bi-twitter-x"></i>

                            </a>

                            <a href="https://www.linkedin.com/"
                               target="_blank"
                               class="social-btn sb-linkedin"
                               aria-label="LinkedIn">

                                <i class="bi bi-linkedin"></i>

                            </a>

                            <a href="mailto:?subject={{ urlencode($course->title) }}&body={{ urlencode(url()->current()) }}"
                               class="social-btn sb-email"
                               aria-label="Email">

                                <i class="bi bi-envelope-fill"></i>

                            </a>

                        </div>

                    </div>
                    <!-- End Social Card -->


                </div>
                <!-- End Sidebar -->


                <!-- Main Content -->
                <div class="col-lg-8 order-lg-1">


                    <!-- Tabs Navigation -->
                    <div class="tabs-wrapper"
                         data-aos="fade-up"
                         data-aos-delay="250">

                        <ul class="nav nav-pills" role="tablist">

                            <li class="nav-item">

                                <button
                                    class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#course-details-tab-1"
                                    type="button"
                                    role="tab">

                                    <i class="bi bi-book"></i>
                                    Overview

                                </button>

                            </li>


                            <li class="nav-item">

                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#course-details-tab-2"
                                    type="button"
                                    role="tab">

                                    <i class="bi bi-journal-text"></i>
                                    Syllabus

                                </button>

                            </li>


                            <li class="nav-item">

                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#course-details-tab-3"
                                    type="button"
                                    role="tab">

                                    <i class="bi bi-chat-quote"></i>
                                    Feedback

                                </button>

                            </li>

                        </ul>


                        <div class="tab-content">


                            <!-- Overview Tab -->
                            <div
                                class="tab-pane fade show active"
                                id="course-details-tab-1"
                                role="tabpanel">


                                <div class="content-block">

                                    <h3>About This Course</h3>

                                    <p>
                                        {{ $course->description }}
                                    </p>

                                </div>




                                <div class="content-block">

                                    <h3>Who Can Enroll?</h3>

                                    <ul class="prereq-list">

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Students interested in learning new skills
                                        </li>

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Learners looking to improve their knowledge
                                        </li>

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Anyone interested in this course subject
                                        </li>

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Students with internet access

                                        </li>

                                    </ul>

                                </div>


                            </div>
                            <!-- End Overview Tab -->


                            <!-- Syllabus Tab -->
                            <div
                                class="tab-pane fade"
                                id="course-details-tab-2"
                                role="tabpanel">


                                <div class="content-block">

                                    <h3>Course Syllabus</h3>

                                    <p>
                                        Course syllabus and learning modules
                                        will be updated here.
                                    </p>

                                    <div class="competency-card">

                                        <div class="comp-icon">

                                            <i class="bi bi-journal-bookmark"></i>

                                        </div>

                                        <h5>{{ $course->title }}</h5>

                                        <p>
                                            {{ $course->description }}
                                        </p>

                                    </div>

                                </div>


                            </div>
                            <!-- End Syllabus Tab -->


                            <!-- Feedback Tab -->
                            <div
                                class="tab-pane fade"
                                id="course-details-tab-3"
                                role="tabpanel">


                                <div class="content-block text-center">

                                    <div class="comp-icon mx-auto mb-3">

                                        <i class="bi bi-chat-square-text"></i>

                                    </div>

                                    <h3>Student Feedback</h3>

                                    <p>
                                        Student reviews and ratings for this
                                        course will be available here.
                                    </p>

                                    <p class="text-muted">
                                        No feedback has been added yet.
                                    </p>

                                </div>


                            </div>
                            <!-- End Feedback Tab -->


                        </div>

                    </div>
                    <!-- End Tabs Wrapper -->


                </div>
                <!-- End Main Content -->


            </div>

        </div>

    </section>
    <!-- End Course Details Section -->

</main>

@endsection
