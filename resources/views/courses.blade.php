
@extends('layouts.site')

@section('title', 'Courses - Student Courses')

@section('content')

<main class="main courses-page">

    <!-- Page Title -->
    <div class="page-title">

        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">

                        <h1 class="heading-title">Courses</h1>

                        <p class="mb-0">
                            Explore our professional courses, improve your
                            technical skills and take the next step towards
                            your career.
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Courses</li>
                </ol>
            </div>
        </nav>

    </div>
    <!-- End Page Title -->


    <!-- Courses Section -->
    <section id="courses-2" class="courses-2 section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- Toolbar -->
            <div class="toolbar" data-aos="fade-down">

                <div class="row align-items-center gy-3">

                    <!-- Search -->
                    <div class="col-lg-6">

                        <div class="search-field">
                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                id="courseSearch"
                                placeholder="Find your next course..."
                            >
                        </div>

                    </div>


                    <!-- Category Filter -->
                    <div class="col-lg-3 col-md-6">

                        <div class="filter-select">

                            <select id="categoryFilter">

                                <option value="all">All Categories</option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    <!-- Sort -->
                    <div class="col-lg-3 col-md-6">

                        <div class="filter-select">

                            <select id="courseSort">

                                <option value="default">Sort: Default</option>
                                <option value="low">Price: Low to High</option>
                                <option value="high">Price: High to Low</option>
                                <option value="az">Name: A to Z</option>
                                <option value="za">Name: Z to A</option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>
            <!-- End Toolbar -->


            <!-- Filter Tags -->
            <div class="filter-tags" data-aos="fade-up">

                <button class="tag-btn active category-tag"
                        data-category="all">
                    All Courses
                </button>

                @foreach($categories as $category)

                    <button class="tag-btn category-tag"
                            data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>

                @endforeach

            </div>
            <!-- End Filter Tags -->


            <!-- Dynamic Courses Grid -->
            <div class="row gy-4 gx-4"
                 id="coursesGrid"
                 data-aos="fade-up"
                 data-aos-delay="200">

                @forelse($courses as $course)

                    @php

                        $purchased = false;

                        if(auth()->check()) {

                            $purchased = \App\Models\Payment::where(
                                'user_id',
                                auth()->id()
                            )
                            ->where('course_id', $course->id)
                            ->where('status', 'success')
                            ->exists();

                        }

                        $categoryId = $course->category_id ?? '';

                    @endphp


                    <div class="col-xl-4 col-md-6 course-item"

                         data-title="{{ strtolower($course->title) }}"

                         data-category="{{ $categoryId }}"

                         data-price="{{ $course->price }}">

                        <article class="program-card">

                            <!-- Course Image -->
                            <div class="card-img">

                                @if($course->image)

                                    <img
                                        src="{{ asset('uploads/'.$course->image) }}"
                                        alt="{{ $course->title }}"
                                        class="img-fluid"
                                        loading="lazy"
                                    >

                                @else

                                    <img
                                        src="{{ asset('academica/assets/img/education/courses-3.webp') }}"
                                        alt="Course"
                                        class="img-fluid"
                                        loading="lazy"
                                    >

                                @endif


                                @if($purchased)

                                    <span class="ribbon">
                                        Purchased
                                    </span>

                                @elseif($course->status == 'coming_soon')

                                    <span class="ribbon fresh">
                                        Coming Soon
                                    </span>

                                @elseif($course->status == 'active')

                                    <span class="ribbon free">
                                        Available
                                    </span>

                                @endif


                                <span class="cost">
                                    ₹{{ number_format($course->price, 2) }}
                                </span>

                            </div>


                            <!-- Card Body -->
                            <div class="card-body">

                                <div class="tags">

                                    <span class="tag-category">

                                        {{ $course->category->name ?? 'General' }}

                                    </span>

                                    <span class="tag-level">

                                        <i class="bi bi-book"></i>

                                        Online Course

                                    </span>

                                </div>


                                <h3>{{ $course->title }}</h3>


                                <p>
                                    {{ \Illuminate\Support\Str::limit(
                                        $course->description,
                                        110
                                    ) }}
                                </p>


                                <!-- Course Information -->
                                <div class="metrics">

                                    <div class="metric-item">

                                        <i class="bi bi-mortarboard"></i>

                                        <span>Online Learning</span>

                                    </div>

                                    <div class="metric-item">

                                        <i class="bi bi-tag"></i>

                                        <span>
                                            {{ ucfirst($course->status) }}
                                        </span>

                                    </div>

                                </div>


                                <!-- Card Footer -->
                                <div class="card-footer">

                                    <div class="tutor">

                                        <span>
                                            <i class="bi bi-book-half"></i>
                                            Student Courses
                                        </span>

                                    </div>


                                    <div class="d-flex flex-column gap-2">

                                        <!-- Purchased -->
                                        @if($purchased)

                                            <button class="enroll-btn"
                                                    disabled>

                                                <i class="bi bi-check-circle"></i>
                                                Purchased

                                            </button>


                                        <!-- Active Course -->
                                        @elseif($course->status == 'active')

                                            @auth

                                                <a href="{{ route('buy.course', $course->id) }}"
                                                   class="enroll-btn">

                                                    Enroll Now
                                                    <i class="bi bi-arrow-right"></i>

                                                </a>

                                            @else

                                                <a href="{{ route('student.login') }}"
                                                   class="enroll-btn">

                                                    Login to Enroll
                                                    <i class="bi bi-arrow-right"></i>

                                                </a>

                                            @endauth


                                        <!-- Coming Soon -->
                                        @elseif($course->status == 'coming_soon')

                                            <button class="enroll-btn" disabled>

                                                Coming Soon

                                            </button>

                                        @endif


                                        <!-- Course Details -->
                                        <a href="{{ route('course.details', $course->id) }}"
                                           class="btn btn-outline-success btn-sm">

                                            View Details

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="col-12 text-center">

                        <h4>No Courses Available</h4>

                        <p>New courses will be added soon.</p>

                    </div>

                @endforelse

            </div>
            <!-- End Courses Grid -->


            <!-- No Search Results -->
            <div id="noCourses" class="text-center mt-5"
                 style="display:none;">

                <h4>No matching courses found.</h4>

                <p>Try another search or category.</p>

            </div>


            <!-- Load More -->
            <div class="load-more-wrapper"
                 id="loadMoreWrapper"
                 data-aos="zoom-in">

                <button type="button"
                        id="loadMoreBtn"
                        class="load-more-btn">

                    Load More Courses
                    <i class="bi bi-arrow-down-circle"></i>

                </button>

                <p class="results-count" id="resultsCount"></p>

            </div>

        </div>

    </section>
    <!-- End Courses Section -->

</main>


<!-- Search, Filter and Sorting -->
<script>

document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById('courseSearch');

    const categoryFilter = document.getElementById('categoryFilter');

    const sortSelect = document.getElementById('courseSort');

    const grid = document.getElementById('coursesGrid');

    const noCourses = document.getElementById('noCourses');

    const loadMoreBtn = document.getElementById('loadMoreBtn');

    const loadMoreWrapper = document.getElementById('loadMoreWrapper');

    const resultsCount = document.getElementById('resultsCount');

    const tags = document.querySelectorAll('.category-tag');

    let visibleLimit = 6;

    let filteredCourses = [];


    function filterCourses() {

        const search = searchInput.value.toLowerCase();

        const category = categoryFilter.value;

        const sort = sortSelect.value;

        const items = Array.from(
            grid.querySelectorAll('.course-item')
        );


        filteredCourses = items.filter(item => {

            const title = item.dataset.title;

            const itemCategory = item.dataset.category;

            const matchesSearch = title.includes(search);

            const matchesCategory =
                category === 'all' || itemCategory === category;

            return matchesSearch && matchesCategory;

        });


        // Sorting
        if(sort === 'low') {

            filteredCourses.sort((a,b) =>
                Number(a.dataset.price) - Number(b.dataset.price)
            );

        }

        else if(sort === 'high') {

            filteredCourses.sort((a,b) =>
                Number(b.dataset.price) - Number(a.dataset.price)
            );

        }

        else if(sort === 'az') {

            filteredCourses.sort((a,b) =>
                a.dataset.title.localeCompare(b.dataset.title)
            );

        }

        else if(sort === 'za') {

            filteredCourses.sort((a,b) =>
                b.dataset.title.localeCompare(a.dataset.title)
            );

        }


        // Hide all courses first
        items.forEach(item => {

            item.style.display = 'none';

        });


        // Display filtered courses
        filteredCourses.forEach((item,index) => {

            if(index < visibleLimit) {

                item.style.display = '';

                grid.appendChild(item);

            }

        });


        // Empty result
        noCourses.style.display =
            filteredCourses.length === 0 ? 'block' : 'none';


        // Load More
        loadMoreWrapper.style.display =
            filteredCourses.length > visibleLimit ? 'block' : 'none';


        loadMoreBtn.style.display =
            filteredCourses.length > visibleLimit ? 'inline-block' : 'none';


        // Count
        resultsCount.innerText =
            'Showing ' +
            Math.min(visibleLimit, filteredCourses.length) +
            ' of ' + filteredCourses.length + ' courses';

    }


    // Search
    searchInput.addEventListener('input', function () {

        visibleLimit = 6;

        filterCourses();

    });


    // Category dropdown
    categoryFilter.addEventListener('change', function () {

        visibleLimit = 6;

        tags.forEach(tag => {

            tag.classList.toggle(
                'active',
                tag.dataset.category === categoryFilter.value
            );

        });

        filterCourses();

    });


    // Sorting
    sortSelect.addEventListener('change', function () {

        filterCourses();

    });


    // Category buttons
    tags.forEach(tag => {

        tag.addEventListener('click', function () {

            tags.forEach(t => t.classList.remove('active'));

            this.classList.add('active');

            categoryFilter.value = this.dataset.category;

            visibleLimit = 6;

            filterCourses();

        });

    });


    // Load More
    loadMoreBtn.addEventListener('click', function () {

        visibleLimit += 6;

        filterCourses();

    });


    // Initial Load
    filterCourses();

});

</script>

@endsection
