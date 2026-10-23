<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wanderlust Travel | Premium Travel Experiences</title>
    <meta name="description"
        content="Discover unforgettable travel experiences with Wanderlust Travel. Luxury packages, expert guides, and personalized service.">

    <!-- Local Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Local Font Awesome -->
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <!-- Preload Font Files -->
    <link href="{{ asset('assets/fonts/fa-solid-900.woff2') }}" rel="preload" as="font" type="font/woff2"
        crossorigin>
    <link href="{{ asset('assets/fonts/fa-solid-900.ttf') }}" rel="preload" as="font" type="font/ttf" crossorigin>


    <!-- Local Google Fonts -->
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #2A6B84;
            --secondary: #F8B400;
            --accent: #34A853;
            --dark: #1A535C;
            --light: #F7F9FC;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            min-height: 700px;
            overflow: hidden;
            color: white;
            padding: 0;
        }

        .hero-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            transform: scale(1.1);
            animation: zoomOut 8s ease-in-out infinite;
        }

        .hero-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(42, 107, 132, 0.7), rgba(42, 107, 132, 0.8));
        }

        .hero-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        @keyframes zoomOut {
            0% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-title,
        .hero-subtitle {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slider-controls {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            z-index: 3;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: white;
            transform: scale(1.2);
        }

        .slider-dot:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .slider-arrows {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .slider-arrow {
            width: 50px;
            height: 50px;
            border: 2px solid white;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .slider-arrow:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                height: 80vh;
                min-height: 600px;
            }

            .slider-arrow {
                width: 40px;
                height: 40px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }
        }

        /* About Section Styles */
        .about-content {
            padding-right: 2rem;
        }

        .about-image {
            position: relative;
        }

        .experience-badge {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background: var(--secondary);
            color: #000;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .experience-content {
            text-align: center;
        }

        .years {
            display: block;
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1;
        }

        .experience-content .label {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .feature-icon-sm {
            width: 50px;
            height: 50px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .stat-item {
            padding: 2rem 1rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-weight: 600;
            color: var(--dark);
        }

        .team-card {
            padding: 2rem 1rem;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .team-image {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 1rem 0.5rem 0.5rem;
            border-radius: 0 0 75px 75px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .team-image:hover .team-overlay {
            opacity: 1;
        }

        .team-experience {
            color: white;
            font-size: 0.8rem;
            text-align: center;
        }

        .value-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2rem;
            color: var(--primary);
        }

        /* Responsive adjustments for about section */
        @media (max-width: 768px) {
            .about-content {
                padding-right: 0;
                margin-bottom: 3rem;
            }

            .experience-badge {
                position: relative;
                bottom: auto;
                right: auto;
                margin: -30px auto 0;
                width: 100px;
                height: 100px;
            }

            .years {
                font-size: 1.5rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .team-image {
                width: 120px;
                height: 120px;
            }
        }

        .section {
            padding: 100px 0;
        }

        .section-light {
            background-color: var(--light);
        }

        .navbar {
            transition: all 0.4s ease;
            padding: 20px 0;
        }

        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            padding: 10px 0;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--dark);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--secondary);
            border: none;
            color: #000;
            padding: 12px 30px;
            font-weight: 500;
        }

        .destination-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .destination-image {
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .price-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--secondary);
            color: #000;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        .rating {
            color: var(--secondary);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: var(--primary);
        }

        .stats-section {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 15px;
        }

        .testimonial-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .newsletter-section {
            background: linear-gradient(rgba(42, 107, 132, 0.9), rgba(42, 107, 132, 0.9)), url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .form-control {
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(42, 107, 132, 0.25);
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#home" style="color: var(--primary);">
                <i class="fas fa-compass me-2"></i>Wanderlust
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#packages">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <!-- Auth Links -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" id="userDropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" id="userDropdownMenu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('bookings.my') }}">
                                        <i class="fas fa-suitcase me-2"></i>My Bookings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('reviews.my') }}">
                                        <i class="fas fa-star me-2"></i>My Reviews
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item border-0 bg-transparent w-100 text-start">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- User is NOT logged in - show login button --}}
                        <li class="nav-item">
                            <button class="nav-link btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal"
                                style="border: none; background: none; color: inherit;">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </button>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Image Slider -->
    <section id="home" class="hero-section">
        <!-- Image Slider -->
        <div class="hero-slider">
            @foreach ($heroImages as $index => $image)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                    style="background-image: url('{{ $image['url'] }}')" data-title="{{ $image['title'] }}"
                    data-subtitle="{{ $image['subtitle'] }}">
                </div>
            @endforeach
        </div>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-3 fw-bold mb-4 hero-title">{{ $heroImages[0]['title'] }}</h1>
                        <p class="lead mb-5 fs-4 hero-subtitle">{{ $heroImages[0]['subtitle'] }}</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="#destinations" class="btn btn-secondary btn-lg">Explore Destinations</a>
                            <a href="#contact" class="btn btn-outline-light btn-lg">Custom Quote</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <div class="slider-controls">
            <div class="container">
                <div class="slider-dots">
                    @foreach ($heroImages as $index => $image)
                        <button class="slider-dot {{ $index === 0 ? 'active' : '' }}"
                            data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
                <div class="slider-arrows">
                    <button class="slider-arrow prev-arrow">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="slider-arrow next-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="display-5 fw-bold mb-4">{{ $aboutData['title'] }}</h2>
                        <h5 class="text-primary mb-4">{{ $aboutData['subtitle'] }}</h5>
                        <p class="lead mb-4">{{ $aboutData['description'] }}</p>
                        <p class="mb-5">We believe that travel should be transformative, not just transactional. Our
                            team of experienced travel consultants works closely with you to understand your
                            preferences, dreams, and expectations, crafting journeys that create lifelong memories.</p>

                        <div class="row">
                            @foreach ($aboutData['features'] as $feature)
                                <div class="col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <div class="feature-icon-sm me-3">
                                            <i class="{{ $feature['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $feature['title'] }}</h6>
                                            <p class="text-muted mb-0">{{ $feature['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Our Travel Team" class="img-fluid rounded-3 shadow-lg">
                        <div class="experience-badge">
                            <div class="experience-content">
                                <span class="years">12+</span>
                                <span class="label">Years<br>Experience</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="row mt-5 pt-5">
                <div class="col-12 text-center mb-5">
                    <h3 class="fw-bold">Why Choose Wanderlust?</h3>
                </div>
                @foreach ($aboutData['stats'] as $stat)
                    <div class="col-lg-3 col-md-6 text-center mb-4">
                        <div class="stat-item">
                            <div class="stat-number text-primary">{{ $stat['number'] }}</div>
                            <div class="stat-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Team Section -->
            <div class="row mt-5 pt-5">
                <div class="col-12 text-center mb-5">
                    <h3 class="fw-bold">Meet Our Travel Experts</h3>
                    <p class="lead">Our dedicated team ensures every journey is perfect</p>
                </div>
                @foreach ($aboutData['team'] as $member)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-card text-center">
                            <div class="team-image mb-3">
                                <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}"
                                    class="img-fluid rounded-circle">
                                <div class="team-overlay">
                                    <div class="team-experience">
                                        <i class="fas fa-star me-1"></i>
                                        {{ $member['experience'] }}
                                    </div>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-1">{{ $member['name'] }}</h5>
                            <p class="text-primary mb-2">{{ $member['position'] }}</p>
                            <p class="text-muted small">{{ $member['experience'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Values Section -->
            <div class="row mt-5 pt-5">
                <div class="col-12 text-center mb-5">
                    <h3 class="fw-bold">Our Values</h3>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="value-card text-center p-4">
                        <div class="value-icon mb-3">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5>Passion for Travel</h5>
                        <p class="text-muted">We live and breathe travel, and our enthusiasm is infectious. We're not
                            just booking trips; we're creating experiences.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="value-card text-center p-4">
                        <div class="value-icon mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Trust & Reliability</h5>
                        <p class="text-muted">Your safety and satisfaction are our top priorities. We partner with
                            trusted providers and maintain the highest standards.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="value-card text-center p-4">
                        <div class="value-icon mb-3">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h5>Innovation</h5>
                        <p class="text-muted">We continuously explore new destinations and experiences to keep your
                            travels fresh, exciting, and unforgettable.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="section section-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-4">Featured Destinations</h2>
                    <p class="lead">Explore our handpicked selection of the world's most breathtaking destinations
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($destinations as $destination)
                    <div class="col-lg-3 col-md-6">
                        <div class="destination-card card">
                            <div class="destination-image"
                                style="background-image: url('https://images.unsplash.com/photo-1539367628448-4bc5c9d171c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                                <div class="price-tag">${{ number_format($destination['price']) }}</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $destination['name'] }}</h5>
                                <p class="card-text">
                                    <i class="fas fa-calendar-alt me-2"></i>{{ $destination['duration'] }}
                                    <br>
                                    <span class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star{{ $i <= floor($destination['rating']) ? '' : '-half-alt' }}"></i>
                                        @endfor
                                        ({{ $destination['rating'] }})
                                    </span>
                                </p>
                                <button class="btn btn-primary w-100"
                                    onclick="showInquiryModal('{{ $destination['name'] }}')">Inquire Now</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-4">Travel Packages</h2>
                    <p class="lead">Tailored experiences for every type of traveler</p>
                </div>
            </div>
            <div class="row">
                @foreach ($packages as $package)
                    <div class="col-lg-3 col-md-6 text-center mb-4">
                        <div class="feature-icon">
                            <i class="{{ $package['icon'] }}"></i>
                        </div>
                        <h5>{{ $package['name'] }}</h5>
                        <p class="text-muted">{{ $package['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="section section-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-4">What Our Travelers Say</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                alt="Sarah Johnson" class="testimonial-image me-3">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Bali Vacation</small>
                            </div>
                        </div>
                        <p class="mb-0">"Absolutely incredible experience! The attention to detail and personalized
                            service made our trip unforgettable."</p>
                        <div class="rating mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                alt="Mike Chen" class="testimonial-image me-3">
                            <div>
                                <h6 class="mb-0">Mike Chen</h6>
                                <small class="text-muted">European Tour</small>
                            </div>
                        </div>
                        <p class="mb-0">"Professional from start to finish. Every accommodation and activity was
                            perfectly planned. Highly recommended!"</p>
                        <div class="rating mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                alt="Emily Davis" class="testimonial-image me-3">
                            <div>
                                <h6 class="mb-0">Emily Davis</h6>
                                <small class="text-muted">Family Vacation</small>
                            </div>
                        </div>
                        <p class="mb-0">"Our family had the best vacation ever! The kids loved the activities and we
                            appreciated the seamless planning."</p>
                        <div class="rating mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold text-center mb-5">Plan Your Journey</h2>
                    <form id="inquiryForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="travelers" class="form-label">Number of Travelers *</label>
                                <select class="form-control" id="travelers" name="travelers" required>
                                    <option value="">Select...</option>
                                    <option value="1">1 Traveler</option>
                                    <option value="2">2 Travelers</option>
                                    <option value="3">3 Travelers</option>
                                    <option value="4">4 Travelers</option>
                                    <option value="5+">5+ Travelers</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destination Interest *</label>
                                <input type="text" class="form-control" id="destination" name="destination"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="travel_date" class="form-label">Preferred Travel Date *</label>
                                <input type="date" class="form-control" id="travel_date" name="travel_date"
                                    required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label">Special Requests *</label>
                            <textarea class="form-control" id="message" name="message" rows="4"
                                placeholder="Tell us about your dream vacation..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <span id="submitText">Submit Inquiry</span>
                            <div id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </form>
                    <div id="formMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h3 class="mb-3">Get Travel Inspiration</h3>
                    <p class="mb-4">Subscribe to our newsletter for exclusive deals and travel tips</p>
                    <form id="newsletterForm" class="d-flex gap-2">
                        @csrf
                        <input type="email" class="form-control" placeholder="Enter your email" name="email"
                            required>
                        <button type="submit" class="btn btn-secondary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Auth Modals -->
    @include('login_modal')
    @include('register_modal')
    @include('forgot_pw_modal')

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3"><i class="fas fa-compass me-2"></i>Wanderlust Travel</h5>
                    <p>Creating unforgettable travel experiences since 2012. Your journey to extraordinary destinations
                        starts here.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="mb-3">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#about" class="text-light text-decoration-none">About Us</a>
                        </li>
                        <li class="mb-2"><a href="#contact" class="text-light text-decoration-none">Contact</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Careers</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Booking Info</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Privacy
                                Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Terms</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="mb-3">Contact Info</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@wanderlust.com</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>123 Travel Street, Adventure City
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p>© 2026 Wanderlust Travel. Images sourced from the internet and belong to their respective owners.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>IATA Certified Travel Agency</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Hero Slider Class
            function HeroSlider() {
                this.slides = $('.hero-slide');
                this.dots = $('.slider-dot');
                this.prevBtn = $('.prev-arrow');
                this.nextBtn = $('.next-arrow');
                this.currentSlide = 0;
                this.slideInterval = null;
                this.slideDuration = 5000;

                this.init();
            }

            HeroSlider.prototype.init = function() {
                this.startAutoSlide();
                this.prevBtn.on('click', () => this.prevSlide());
                this.nextBtn.on('click', () => this.nextSlide());

                this.dots.each((index, dot) => {
                    $(dot).on('click', () => this.goToSlide(index));
                });

                const heroSection = $('.hero-section');
                heroSection.on('mouseenter', () => this.stopAutoSlide());
                heroSection.on('mouseleave', () => this.startAutoSlide());
            };

            HeroSlider.prototype.startAutoSlide = function() {
                this.slideInterval = setInterval(() => {
                    this.nextSlide();
                }, this.slideDuration);
            };

            HeroSlider.prototype.stopAutoSlide = function() {
                if (this.slideInterval) {
                    clearInterval(this.slideInterval);
                    this.slideInterval = null;
                }
            };

            HeroSlider.prototype.nextSlide = function() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                this.updateSlider();
            };

            HeroSlider.prototype.prevSlide = function() {
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                this.updateSlider();
            };

            HeroSlider.prototype.goToSlide = function(index) {
                this.currentSlide = index;
                this.updateSlider();
            };

            HeroSlider.prototype.updateSlider = function() {
                this.slides.each((index, slide) => {
                    $(slide).toggleClass('active', index === this.currentSlide);
                });

                this.dots.each((index, dot) => {
                    $(dot).toggleClass('active', index === this.currentSlide);
                });

                this.updateHeroContent();
            };

            HeroSlider.prototype.updateHeroContent = function() {
                const activeSlide = $(this.slides[this.currentSlide]);
                const title = activeSlide.attr('data-title');
                const subtitle = activeSlide.attr('data-subtitle');

                const heroTitle = $('.hero-title');
                const heroSubtitle = $('.hero-subtitle');

                heroTitle.css('animation', 'fadeOut 0.5s ease-out forwards');
                heroSubtitle.css('animation', 'fadeOut 0.5s ease-out forwards');

                setTimeout(() => {
                    heroTitle.text(title);
                    heroSubtitle.text(subtitle);
                    heroTitle.css('animation', 'fadeInUp 0.5s ease-out forwards');
                    heroSubtitle.css('animation', 'fadeInUp 0.5s ease-out forwards');
                }, 500);
            };

            // Initialize hero slider
            new HeroSlider();

            // Navbar scroll effect
            $(window).on('scroll', function() {
                const navbar = $('#navbar');
                if ($(window).scrollTop() > 100) {
                    navbar.addClass('navbar-scrolled');
                } else {
                    navbar.removeClass('navbar-scrolled');
                }
            });

            // FIX: Smooth scrolling - exclude dropdown toggles
            $('a[href^="#"]').not('.dropdown-toggle, [data-bs-toggle="dropdown"], [href="#"]').on('click', function(
                e) {
                e.preventDefault();
                const href = $(this).attr('href');
                // Check if href is not just "#"
                if (href !== '#') {
                    const target = $(href);
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 800);
                    }
                }
            });

            // Fix for modal switching
            $('[data-bs-toggle="modal"]').not('.dropdown-toggle, [data-bs-toggle="dropdown"]').on('click', function(
                e) {
                const targetModal = $(this).data('bs-target');
                const currentModal = $(this).closest('.modal.show');

                if (currentModal.length) {
                    const currentBsModal = bootstrap.Modal.getInstance(currentModal[0]);
                    if (currentBsModal) {
                        currentBsModal.hide();
                    }

                    currentModal.on('hidden.bs.modal', function() {
                        const targetBsModal = new bootstrap.Modal(document.querySelector(
                            targetModal));
                        targetBsModal.show();
                        currentModal.off('hidden.bs.modal');
                    });
                }
            });

            // Booking Modal Handler
            const bookingModal = $('#bookingModal');
            if (bookingModal.length) {
                bookingModal.on('show.bs.modal', function(event) {
                    const button = $(event.relatedTarget);
                    const destination = button.attr('data-destination');
                    $('#bookingDestination').val(destination);
                    $('#destinationDisplay').val(destination);
                });
            }

            // Contact Form Handler
            const inquiryForm = $('#inquiryForm');
            if (inquiryForm.length) {
                inquiryForm.on('submit', function(e) {
                    e.preventDefault();
                    const submitBtn = $(this).find('button[type="submit"]');
                    const submitText = $('#submitText');
                    const loadingSpinner = $('#loadingSpinner');

                    submitText.hide();
                    loadingSpinner.removeClass('d-none');
                    submitBtn.prop('disabled', true);

                    const formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            $('#formMessage')
                                .removeClass('alert-danger')
                                .addClass('alert alert-success')
                                .text(
                                    'Thank you! Your inquiry has been submitted successfully. We will contact you soon.'
                                )
                                .show();
                            inquiryForm[0].reset();
                        },
                        error: function(xhr) {
                            $('#formMessage')
                                .removeClass('alert-success')
                                .addClass('alert alert-danger')
                                .text(
                                    'Sorry, there was an error submitting your inquiry. Please try again.'
                                )
                                .show();
                        },
                        complete: function() {
                            submitText.show();
                            loadingSpinner.addClass('d-none');
                            submitBtn.prop('disabled', false);
                        }
                    });
                });
            }

            // Newsletter Form Handler
            const newsletterForm = $('#newsletterForm');
            if (newsletterForm.length) {
                newsletterForm.on('submit', function(e) {
                    e.preventDefault();
                    const submitBtn = $(this).find('button[type="submit"]');
                    const originalText = submitBtn.html();

                    submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...');
                    submitBtn.prop('disabled', true);

                    const formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            alert('Thank you for subscribing to our newsletter!');
                            newsletterForm[0].reset();
                        },
                        error: function(xhr) {
                            alert('Sorry, there was an error subscribing. Please try again.');
                        },
                        complete: function() {
                            submitBtn.html(originalText);
                            submitBtn.prop('disabled', false);
                        }
                    });
                });
            }

            // *** REMOVED DUPLICATE BOOTSTRAP DROPDOWN INITIALIZATION ***
            // Keep only jQuery dropdown handling

            $('#userDropdown').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const dropdownMenu = $(this).next('.dropdown-menu');

                // Close other dropdowns
                $('.dropdown-menu').not(dropdownMenu).removeClass('show');

                // Toggle this dropdown
                dropdownMenu.toggleClass('show');
            });

            // Close dropdown when clicking elsewhere
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });

            // Keep dropdown open when clicking inside it
            $('.dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });

            // Destination inquiry modal function
            window.showInquiryModal = function(destinationName) {
                $('#destination').val(destinationName);
                $('html, body').animate({
                    scrollTop: $('#contact').offset().top
                }, 800);
            };

        });
    </script>

</body>

</html>
