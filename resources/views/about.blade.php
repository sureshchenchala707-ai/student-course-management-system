
@extends('layouts.site')

@section('title', 'About Us - Student Course Management System')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">

        <div class="heading">

            <div class="container">

                <div class="row d-flex justify-content-center text-center">

                    <div class="col-lg-8">

                        <h1 class="heading-title">About</h1>

                        <p class="mb-0">
                            Odio et unde deleniti. Deserunt numquam exercitationem.
                            Officiis quo odio sint voluptas consequatur ut a odio
                            voluptatem. Sit dolorum debitis veritatis natus dolores.
                            Quasi ratione sint. Sit quaerat ipsum dolorem.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <nav class="breadcrumbs">

            <div class="container">

                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">About</li>
                </ol>

            </div>

        </nav>

    </div>
    <!-- End Page Title -->


    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center gy-5">

                <!-- Image -->
                <div class="col-lg-6 order-lg-2"
                     data-aos="fade-left"
                     data-aos-delay="200">

                    <div class="hero-image-wrapper">

                        <img
                            src="{{ asset('academica/assets/img/education/education-square-7.webp') }}"
                            alt="About Our Academy"
                            class="img-fluid main-img"
                        >

                        <div class="floating-badge"
                             data-aos="zoom-in"
                             data-aos-delay="400">

                            <span class="badge-number">18+</span>

                            <span class="badge-label">
                                Years of Excellence
                            </span>

                        </div>

                        <div class="floating-shape"></div>

                    </div>

                </div>


                <!-- About Content -->
                <div class="col-lg-6 order-lg-1"
                     data-aos="fade-right"
                     data-aos-delay="300">

                    <div class="intro-content">

                        <span class="section-label">
                            <i class="bi bi-mortarboard"></i>
                            Who We Are
                        </span>

                        <h2>
                            Shaping Tomorrow's Innovators With World-Class Learning
                        </h2>

                        <p>
                            Pellentesque habitant morbi tristique senectus et
                            netus et malesuada fames ac turpis egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies
                            eget, tempor sit amet, ante.
                        </p>


                        <!-- Statistics -->
                        <div class="row g-4 stats-grid">

                            <div class="col-4">

                                <div class="stat-box">

                                    <span class="number">18</span>

                                    <span class="label">
                                        Years Active
                                    </span>

                                </div>

                            </div>


                            <div class="col-4">

                                <div class="stat-box">

                                    <span class="number">350+</span>

                                    <span class="label">
                                        Skilled Mentors
                                    </span>

                                </div>

                            </div>


                            <div class="col-4">

                                <div class="stat-box">

                                    <span class="number">75k+</span>

                                    <span class="label">
                                        Learners Enrolled
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Mission, Vision and Values -->
            <div class="row g-4 mt-5 pt-5 pillars-row">


                <!-- Mission -->
                <div class="col-lg-4"
                     data-aos="fade-up"
                     data-aos-delay="100">

                    <div class="pillar-card pillar-mission">

                        <div class="pillar-icon">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>

                        <div class="pillar-body">

                            <h3>Our Mission</h3>

                            <p>
                                Donec pede justo, fringilla vel aliquet nec,
                                vulputate eget arcu. In enim justo, rhoncus ut
                                imperdiet a, venenatis vitae justo.
                            </p>

                        </div>

                        <div class="pillar-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </div>


                <!-- Vision -->
                <div class="col-lg-4"
                     data-aos="fade-up"
                     data-aos-delay="200">

                    <div class="pillar-card pillar-vision">

                        <div class="pillar-icon">
                            <i class="bi bi-binoculars"></i>
                        </div>

                        <div class="pillar-body">

                            <h3>Our Vision</h3>

                            <p>
                                Cras dapibus vivamus elementum semper nisi.
                                Aenean vulputate eleifend tellus aenean leo
                                ligula porttitor eu consequat.
                            </p>

                        </div>

                        <div class="pillar-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </div>


                <!-- Values -->
                <div class="col-lg-4"
                     data-aos="fade-up"
                     data-aos-delay="300">

                    <div class="pillar-card pillar-values">

                        <div class="pillar-icon">
                            <i class="bi bi-gem"></i>
                        </div>

                        <div class="pillar-body">

                            <h3>Our Values</h3>

                            <p>
                                Etiam ultricies nisi vel augue. Curabitur
                                ullamcorper ultricies nisi nam eget dui.
                                Etiam rhoncus maecenas tempus.
                            </p>

                        </div>

                        <div class="pillar-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Advantages Section -->
            <div class="row g-5 mt-5 pt-5 align-items-center reasons-block">


                <!-- Image Gallery -->
                <div class="col-lg-5"
                     data-aos="fade-up"
                     data-aos-delay="100">

                    <div class="gallery-mosaic">

                        <div class="mosaic-main">

                            <img
                                src="{{ asset('academica/assets/img/education/campus-4.webp') }}"
                                alt="Modern Campus"
                                class="img-fluid"
                            >

                        </div>


                        <div class="mosaic-secondary">

                            <img
                                src="{{ asset('academica/assets/img/education/students-7.webp') }}"
                                alt="Student Community"
                                class="img-fluid"
                            >

                        </div>


                        <div class="mosaic-tertiary">

                            <img
                                src="{{ asset('academica/assets/img/education/education-5.webp') }}"
                                alt="Learning Environment"
                                class="img-fluid"
                            >

                        </div>

                    </div>

                </div>


                <!-- Advantages Content -->
                <div class="col-lg-7"
                     data-aos="fade-up"
                     data-aos-delay="200">

                    <div class="reasons-content">

                        <span class="section-label">
                            <i class="bi bi-star"></i>
                            Our Advantages
                        </span>

                        <h2>
                            Redefining Learning Experiences for the Digital Age
                        </h2>

                        <p>
                            Maecenas nec odio et ante tincidunt tempus.
                            Donec vitae sapien ut libero venenatis faucibus
                            nullam quis ante.
                        </p>


                        <div class="row g-4 reasons-grid">


                            <!-- Reason 1 -->
                            <div class="col-sm-6"
                                 data-aos="fade-up"
                                 data-aos-delay="250">

                                <div class="reason-item">

                                    <div class="reason-icon">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>

                                    <h4>Adaptive Scheduling</h4>

                                    <p>
                                        Customizable learning paths that fit
                                        your routine
                                    </p>

                                </div>

                            </div>


                            <!-- Reason 2 -->
                            <div class="col-sm-6"
                                 data-aos="fade-up"
                                 data-aos-delay="300">

                                <div class="reason-item">

                                    <div class="reason-icon">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <h4>Expert-Led Courses</h4>

                                    <p>
                                        Mentors with real-world professional
                                        backgrounds
                                    </p>

                                </div>

                            </div>


                            <!-- Reason 3 -->
                            <div class="col-sm-6"
                                 data-aos="fade-up"
                                 data-aos-delay="350">

                                <div class="reason-item">

                                    <div class="reason-icon">
                                        <i class="bi bi-play-circle"></i>
                                    </div>

                                    <h4>Immersive Content</h4>

                                    <p>
                                        Hands-on projects and interactive
                                        modules
                                    </p>

                                </div>

                            </div>


                            <!-- Reason 4 -->
                            <div class="col-sm-6"
                                 data-aos="fade-up"
                                 data-aos-delay="400">

                                <div class="reason-item">

                                    <div class="reason-icon">
                                        <i class="bi bi-briefcase"></i>
                                    </div>

                                    <h4>Career Launchpad</h4>

                                    <p>
                                        Dedicated placement and mentorship
                                        programs
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- Explore Programs -->
                        <a href="{{ route('courses') }}" class="btn-discover">

                            Explore Programs
                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- End About Section -->

</main>

@endsection
