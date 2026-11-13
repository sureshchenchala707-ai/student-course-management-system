
@extends('layouts.site')

@section('content')

@php
    $purchasedCourseIds = auth()->check()
        ? \App\Models\Payment::where('user_id', auth()->id())
            ->where('status', 'success')
            ->pluck('course_id')
            ->toArray()
        : [];
@endphp

{{-- HERO SECTION --}}
<section id="hero" class="hero section accent-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7 text-center">

                <div class="hero-intro">

                    <div class="hero-badge">
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>World-Class Online Education</span>
                    </div>

                    <h1 class="hero-headline">
                        Elevate Your Skills with
                        <em>Expert-Led</em> Online Courses
                    </h1>

                    <p class="hero-desc">
                        Learn new skills, improve your technical knowledge
                        and advance your career with our professional courses.
                        Learn at your own pace from anywhere.
                    </p>

                    <div class="hero-actions">

                        <a href="{{ url('/courses') }}" class="btn-main">
                            Explore Courses
                            <i class="bi bi-arrow-right-short"></i>
                        </a>

                        <a href="{{ route('student.login') }}" class="btn-watch">
                            <span class="play-ring">
                                <i class="bi bi-person"></i>
                            </span>
                            Student Login
                        </a>

                    </div>

                </div>
            </div>
        </div>

        {{-- Dynamic Statistics --}}
        <div class="hero-stats-bar">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">

                    <div class="stats-inner">

                        <div class="stat-block">
                            <div class="stat-value">
                                <span class="stat-num">
                                    {{ $courses->count() }}
                                </span>
                                <span class="stat-plus">+</span>
                            </div>
                            <span class="stat-lbl">Available Courses</span>
                        </div>

                        <div class="stat-sep"></div>

                        <div class="stat-block">
                            <div class="stat-value">
                                <span class="stat-num">
                                    {{ $courses->where('status', 'active')->count() }}
                                </span>
                                <span class="stat-plus">+</span>
                            </div>
                            <span class="stat-lbl">Active Courses</span>
                        </div>

                        <div class="stat-sep"></div>

                        <div class="stat-block">
                            <div class="stat-value">
                                <span class="stat-num">100</span>
                                <span class="stat-plus">%</span>
                            </div>
                            <span class="stat-lbl">Online Learning</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="hero-features-bar">
            <div class="row justify-content-center">
                <div class="col-auto">

                    <div class="features-row">

                        <div class="feat-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Quality Courses</span>
                        </div>

                        <div class="feat-dot"></div>

                        <div class="feat-item">
                            <i class="bi bi-infinity"></i>
                            <span>Learn At Your Pace</span>
                        </div>

                        <div class="feat-dot"></div>

                        <div class="feat-item">
                            <i class="bi bi-person-badge"></i>
                            <span>Expert Learning</span>
                        </div>

                        <div class="feat-dot"></div>

                        <div class="feat-item">
                            <i class="bi bi-laptop"></i>
                            <span>Learn Anywhere</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="hero-bg-decor">
        <div class="decor-blob decor-blob-1"></div>
        <div class="decor-blob decor-blob-2"></div>
        <div class="decor-dots"></div>
    </div>

</section>


{{-- FEATURED COURSES SECTION --}}
<section id="featured-courses" class="featured-courses section">

    <div class="container section-title" data-aos="fade-up">

        <h2>Featured Courses</h2>

        <p>
            Explore our courses and start learning new skills today.
        </p>

    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

            @forelse($courses as $course)

                <div class="col-lg-6" data-aos="fade-up">

                    <div class="program-card">

                        <div class="row g-0">

                            {{-- Course Image --}}
                            <div class="col-md-5">

                                <div class="program-thumbnail">

                                    @if($course->image)
                                        <img
                                            src="{{ asset('uploads/'.$course->image) }}"
                                            alt="{{ $course->title }}"
                                            class="img-fluid">
                                    @else
                                        <img
                                            src="{{ asset('academica/assets/img/education/courses-3.webp') }}"
                                            alt="{{ $course->title }}"
                                            class="img-fluid">
                                    @endif

                                    <span class="tag highlighted">
                                        {{ $course->status == 'active' ? 'Available' : 'Coming Soon' }}
                                    </span>

                                </div>

                            </div>

                            {{-- Course Details --}}
                            <div class="col-md-7">

                                <div class="program-body">

                                    <div class="program-tags">

                                        <span class="tier">
                                            <i class="bi bi-book"></i>
                                            Online Course
                                        </span>

                                        <span class="weeks">
                                            <i class="bi bi-clock"></i>
                                            Self Paced
                                        </span>

                                    </div>

                                    <h3>
                                        <a href="{{ route('course.details', $course->id) }}">
                                            {{ $course->title }}
                                        </a>
                                    </h3>

                                    <p>
                                        {{ Str::limit($course->description, 110) }}
                                    </p>

                                    <div class="program-footer">

                                        <div class="score">
                                            <i class="bi bi-mortarboard-fill"></i>
                                            <span>Student Course</span>
                                        </div>

                                        <div class="learners">
                                            <i class="bi bi-currency-rupee"></i>
                                            Course Fee
                                        </div>

                                    </div>

                                    <div class="program-action">

                                        @if(in_array($course->id, $purchasedCourseIds))

                                            <a href="{{ route('course.details', $course->id) }}"
                                               class="btn-join">
                                                Purchased
                                                <i class="bi bi-check-circle"></i>
                                            </a>

                                        @elseif($course->status == 'active')

                                            @auth
                                                <a href="{{ route('buy.course', $course->id) }}"
                                                   class="btn-join">
                                                    Enroll Now
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('student.login') }}"
                                                   class="btn-join">
                                                    Enroll Now
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>
                                            @endauth

                                        @elseif($course->status == 'coming_soon')

                                            <span class="btn-join">
                                                Coming Soon
                                            </span>

                                        @endif

                                        <span class="cost">
                                            ₹{{ number_format($course->price, 2) }}
                                        </span>

                                    </div>

                                    <div class="mt-3">

                                        <a href="{{ route('course.details', $course->id) }}"
                                           class="btn btn-outline-success btn-sm w-100">
                                            View Details
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center">
                    <h4>No Courses Available</h4>
                    <p>Please check again later.</p>
                </div>

            @endforelse

        </div>

        <div class="browse-all text-center mt-5">

            <a href="{{ url('/courses') }}" class="btn-browse">
                Explore All Programs
                <i class="bi bi-arrow-right-circle"></i>
            </a>

        </div>

    </div>

</section>




{{-- COURSE CATEGORIES SECTION --}}

<section id="categories" class="course-categories section">

    <div class="container">

        <div class="category-heading text-center">

            <h2>Course Categories</h2>

            <div class="heading-line"></div>

            <p>
                Explore our wide range of courses and find the
                perfect learning path for your career.
            </p>

        </div>

        <div class="row g-4">

            @php
                $categoryIcons = [
                    'computer science' => 'bi bi-laptop',
                    'business' => 'bi bi-briefcase',
                    'design' => 'bi bi-palette',
                    'health & medical' => 'bi bi-heart-pulse',
                    'languages' => 'bi bi-translate',
                    'science' => 'bi bi-flask',
                    'marketing' => 'bi bi-megaphone',
                    'finance' => 'bi bi-cash-stack',
                    'photography' => 'bi bi-camera',
                ];

                $categoryColors = [
                    'blue',
                    'green',
                    'purple',
                    'red',
                    'orange',
                    'cyan',
                    'pink',
                    'green',
                    'slate'
                ];
            @endphp

            @forelse($categories as $index => $category)

                @php
                    $categoryName = strtolower(trim($category->name));

                    $icon = $categoryIcons[$categoryName] ?? 'bi bi-book';

                    $color = $categoryColors[$index % count($categoryColors)];
                @endphp

                <div class="col-lg-4 col-md-6 col-12">

                    <a href="{{ route('courses') }}?category={{ $category->id }}"
                       class="category-box category-{{ $color }}">

                        <div class="category-icon">
                            <i class="{{ $icon }}"></i>
                        </div>

                        <div class="category-info">

                            <h4>{{ $category->name }}</h4>

                            <span>
                                {{ $category->courses_count }}
                                {{ $category->courses_count == 1 ? 'COURSE' : 'COURSES' }}
                            </span>

                        </div>

                        <div class="category-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12 text-center">
                    <p>No categories available.</p>
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- TESTIMONIALS SECTION --}}

<section id="testimonials" class="testimonials section">

    <div class="container section-title" data-aos="fade-up">

        <h2>What Our Students Say</h2>

        <p>Experiences from our learning community.</p>

    </div>

    <div class="container">

        <div class="row gy-4">

            @php
                $testimonials = [
                    [
                        'name' => 'Rahul Kumar',
                        'role' => 'Web Development Student',
                        'review' => 'The courses helped me understand web development concepts and improve my practical skills.',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Priya Sharma',
                        'role' => 'Programming Student',
                        'review' => 'A simple and useful platform to explore courses and learn new technical skills.',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Arjun Reddy',
                        'role' => 'Computer Science Student',
                        'review' => 'The course details and learning experience made it easier to choose the right course.',
                        'rating' => 4
                    ]
                ];
            @endphp

            @foreach($testimonials as $testimonial)

                <div class="col-lg-4 col-md-6">

                    <div class="testimonial-card h-100 p-4">

                        <div class="stars mb-3">

                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill"
                                   style="color: {{ $i <= $testimonial['rating'] ? '#f5a623' : '#ddd' }}">
                                </i>
                            @endfor

                        </div>

                        <p>
                            "{{ $testimonial['review'] }}"
                        </p>

                        <div class="testimonial-author mt-4">

                            <div class="author-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>

                            <div>
                                <h5>{{ $testimonial['name'] }}</h5>
                                <small>{{ $testimonial['role'] }}</small>
                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>



{{-- CALL TO ACTION --}}
<section id="cta" class="cta section light-background">

    <div class="container" data-aos="fade-up">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="cta-content">

                    <div class="section-badge">
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>Start Learning Today</span>
                    </div>

                    <h2>
                        Transform Your Future With Professional Courses
                    </h2>

                    <p>
                        Join our student learning platform and improve
                        your knowledge with practical courses.
                    </p>

                    <div class="cta-buttons">

                        <a href="{{ url('/courses') }}" class="btn-solid">
                            Browse Courses
                            <i class="bi bi-arrow-right"></i>
                        </a>

                        <a href="{{ route('student.login') }}" class="btn-ghost">
                            Student Login
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="cta-visual">

                    <div class="image-frame">

                        <img
                            src="{{ asset('academica/assets/img/education/courses-2.webp') }}"
                            alt="Online Learning"
                            class="img-fluid">

                        <div class="overlay-badge">
                            <i class="bi bi-award-fill"></i>
                            <span>Quality Learning</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<style>
    .category-card,
.testimonial-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eee;
    box-shadow: 0 5px 20px rgba(0,0,0,.05);
    transition: .3s;
}

.category-card:hover,
.testimonial-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,.1);
}

.category-icon {
    font-size: 38px;
    color: #198754;
}

.category-card h4 {
    font-size: 18px;
    font-weight: 700;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 12px;
}

.author-icon {
    font-size: 38px;
    color: #198754;
}

.testimonial-author h5 {
    font-size: 16px;
    margin: 0;
    font-weight: 700;
}

.testimonial-author small {
    color: #777;
}


/* COURSE CATEGORIES */

.course-categories {
    background: #f0f6f3;
    padding: 65px 0;
}

.category-heading {
    margin-bottom: 55px;
}

.category-heading h2 {
    font-size: 32px;
    font-weight: 700;
    color: #17202a;
    margin-bottom: 16px;
}

.heading-line {
    width: 50px;
    height: 3px;
    background: #198754;
    margin: 0 auto 22px;
}

.category-heading p {
    color: #555;
    font-size: 15px;
    margin-bottom: 0;
}

/* Category Card */

.category-box {
    display: flex;
    align-items: center;
    gap: 16px;
    position: relative;
    min-height: 104px;
    padding: 22px 25px;
    background: #fff;
    border-radius: 16px;
    text-decoration: none;
    color: #111;
    box-shadow: 0 8px 25px rgba(0,0,0,.05);
    transition: all .3s ease;
    overflow: hidden;
    border-left: 4px solid transparent;
}

.category-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,.10);
    color: #111;
}

.category-icon {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 25px;
}

.category-info {
    flex: 1;
    min-width: 0;
}

.category-info h4 {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 9px;
    color: #111;
}

.category-info span {
    font-size: 11px;
    letter-spacing: 1px;
    color: #64748b;
    font-weight: 600;
}

.category-arrow {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e7efff;
    color: #2563eb;
    opacity: 0;
    transition: .3s;
}

.category-box:hover .category-arrow {
    opacity: 1;
}

/* Category Colors */

.category-blue .category-icon {
    background: linear-gradient(135deg,#3980ff,#2451d8);
}

.category-green .category-icon {
    background: linear-gradient(135deg,#10b981,#047857);
}

.category-purple .category-icon {
    background: linear-gradient(135deg,#9254ff,#6826d9);
}

.category-red .category-icon {
    background: linear-gradient(135deg,#ff4545,#df2020);
}

.category-orange .category-icon {
    background: linear-gradient(135deg,#ff781c,#ed5200);
}

.category-cyan .category-icon {
    background: linear-gradient(135deg,#06b6d4,#0795b5);
}

.category-pink .category-icon {
    background: linear-gradient(135deg,#ec4899,#db2777);
}

.category-slate .category-icon {
    background: linear-gradient(135deg,#64748b,#475569);
}

/* Active Category */

.category-box:active {
    transform: scale(.98);
}

/* Responsive */

@media(max-width:767px) {

    .course-categories {
        padding: 45px 0;
    }

    .category-heading {
        margin-bottom: 30px;
    }

    .category-heading h2 {
        font-size: 26px;
    }

    .category-box {
        min-height: 90px;
        padding: 16px;
        gap: 13px;
    }

    .category-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        font-size: 22px;
    }

    .category-info h4 {
        font-size: 14px;
    }

    .category-arrow {
        display: none;
    }

}

</style>
@endsection
