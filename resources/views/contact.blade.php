
@extends('layouts.site')

@section('title', 'Contact Us')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Contact Us</h1>
                        <p class="mb-0">
                            Have questions about our courses?
                            Send us a message. We are happy to help you.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Contact</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade-up">

            <div class="row g-4">

                <!-- Contact Form -->
                <div class="col-lg-7" data-aos="fade-right">

                    <div class="form-card">

                        <div class="form-header">
                            <span class="badge-label">Reach Out</span>
                            <h3>Send Us a Message</h3>
                            <p>
                                Feel free to contact us for any course-related
                                questions or support.
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.save') }}"
                              method="POST">

                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label for="contact-name">Your Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="contact-name"
                                        placeholder="Your Name"
                                        value="{{ old('name') }}"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="contact-email">Email Address</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        id="contact-email"
                                        placeholder="Email Address"
                                        value="{{ old('email') }}"
                                        required>
                                </div>

                                <div class="col-12">
                                    <label for="contact-subject">Subject</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="subject"
                                        id="contact-subject"
                                        placeholder="Subject"
                                        value="{{ old('subject') }}"
                                        required>
                                </div>

                                <div class="col-12">
                                    <label for="contact-message">Your Message</label>
                                    <textarea
                                        class="form-control"
                                        name="message"
                                        id="contact-message"
                                        rows="5"
                                        placeholder="Write your message..."
                                        required>{{ old('message') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn-send">
                                        Send Message
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-lg-5" data-aos="fade-left">

                    <div class="sidebar-info">

                        <div class="info-tile">
                            <div class="tile-icon">
                                <i class="bi bi-envelope-at"></i>
                            </div>

                            <div class="tile-text">
                                <h5>Email Us</h5>
                                <p>Contact us for course-related queries.</p>
                            </div>
                        </div>

                        <div class="info-tile">
                            <div class="tile-icon">
                                <i class="bi bi-headset"></i>
                            </div>

                            <div class="tile-text">
                                <h5>Student Support</h5>
                                <p>We are here to help you with your learning journey.</p>
                            </div>
                        </div>

                        <div class="info-tile">
                            <div class="tile-icon">
                                <i class="bi bi-clock"></i>
                            </div>

                            <div class="tile-text">
                                <h5>Working Hours</h5>
                                <p>Monday – Friday</p>
                                <p>9:00 AM – 5:00 PM</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</main>

@endsection
