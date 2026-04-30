@extends('layouts.app')

@section('content')

        <!-- Hero section  -->
        <section id="bookingSection" class="hero-main">
            <div class="swiper-wrapper">
                <!-- Single Slide -->
                <div class="swiper-slide">
                    <div class="hero-content-wrapper">
                        <div class="home-hero-content">

                            <h1 class="hero-title">{{ $data['hero']['title'] ?? '' }}</h1>
                            <p>{{ $data['hero']['subtitle'] ?? '' }}</p>

                            <div style="margin-bottom: 30px; text-align: left;">
                                <h3 style="color: #FC9118; font-weight: 600; margin-bottom: 14px;">
                                    Google Reviews
                                </h3>

                                <div>

                                    <div style="display: flex; align-items: center; gap: 18px; margin: 12px 0;">

                                        <!-- Google Logo -->
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <img src="https://www.google.com/favicon.ico" alt="Google" style="height: 26px;">
                                            <span style="font-size: 20px; font-weight: 700; color:#111;">4.9</span>
                                            <span style="color: #555; font-size: 15px;">/ 5</span>
                                        </div>

                                        <!-- Pipe Divider -->
                                        <span style="color:#ccc;">|</span>

                                        <!-- Stars -->
                                        <div style="display: flex; gap: 4px;">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                                <path
                                                    d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                            </svg>
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                                <path
                                                    d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                            </svg>
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                                <path
                                                    d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                            </svg>
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                                <path
                                                    d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                            </svg>
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                                <path
                                                    d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                            </svg>
                                        </div>

                                    </div>


                                    <p style="font-size: 14px; color: #444; line-height: 1.5; margin-bottom: 14px;">
                                        Trusted by 150+ students on Google for expert guidance and smooth study-abroad
                                        processing.
                                    </p>
                                    <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal"
                                    style="text-decoration: none;">
                                    Book Free Consultation
                                </a>


                                </div>
                            </div>

                        </div>

                        <div class="hero-form">
                            @include('./components/landing-page-registration-study-abroad')
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="stats" class="stats-section">
            <div class="stats-container">
                <div class="stat-box" data-target="7500">
                    <div class="icon-box">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div class="stat-number-box">
                        <span class="stat-number">0</span><span class="plus">+</span>
                    </div>
                    <p>Happy & Satisfied Students</p>
                </div>

                <div class="stat-box" data-target="850">
                    <div class="icon-box">
                        <i class="fa-solid fa-university"></i>
                    </div>
                    <div class="stat-number-box">
                        <span class="stat-number">0</span><span class="plus">+</span>
                    </div>
                    <p>Top-Ranked Universities</p>
                </div>

                <div class="stat-box" data-target="400">
                    <div class="icon-box">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-number-box">
                        <span class="stat-number">0</span><span class="plus">+</span>
                    </div>
                    <p>Experienced Education Consultants</p>
                </div>

                <div class="stat-box" data-target="12">
                    <div class="icon-box">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="stat-number-box">
                        <span class="stat-number">0</span><span class="plus">+</span>
                    </div>
                    <p>Years of Proven Expertise</p>
                </div>
            </div>
        </section>

        <!-- New Journey  -->
        <section class="new-journey-wrapper">
            <div class="new-journey-header">
                <h2 class="new-section-title">{{ $data['introduction']['title'] ?? '' }}</h2>
                <!-- <p>{{ $data['introduction']['subtitle'] ?? '' }}</p> -->
                <p>{!! $data['introduction']['subtitle'] ?? '' !!}</p>
            </div>
        </section>


        <!-- Our Services  -->
        <section class="sop-samples">
            <div class="heading-wrapper">
                <h2 class="new-section-title">What We Offer as Your Dubai Education Consultants in {{$cityName}}</h2>
            </div>

            <div class="sample-container">
                <div class="sample-card">
                    <h3>1. Career Counselling</h3>
                    <p>We help students identify the right course and destination based on academic background, interests,
                        long-term goals and global job opportunities.</p>
                </div>

                <div class="sample-card">
                    <h3>2. Loan & Visa Assistance</h3>
                    <p>Our experts guide students through complete visa documentation, financial planning and education loan
                        support for a smooth approval process.</p>
                </div>

                <div class="sample-card">
                    <h3>3. Statement of Purpose & Scholarships</h3>
                    <p>We assist in drafting personalised SOPs, LORs and scholarship applications that strengthen your
                        university profile and funding chances.</p>
                </div>

                <div class="sample-card">
                    <h3>4. Accommodation & Pre-Departure Assistance</h3>
                    <p>From securing safe housing to providing travel guidance, packing lists and arrival tips, we prepare you
                        for a smooth relocation.</p>
                </div>

                <div class="sample-card">
                    <h3>5. Test Preparation</h3>
                    <p>Training support for IELTS, PTE, TOEFL, GRE, GMAT and SAT to help students achieve required scores for
                        top universities.</p>
                </div>

                <div class="sample-card">
                    <h3>6. Course & University Selection</h3>
                    <p>We shortlist courses and universities based on your academic scores, career goals, budget and visa
                        success probability.</p>
                </div>
            </div>

        </section>

        <!-- Top UK Universities Section -->
        <section class="sop-samples">
            <div class="heading-wrapper">
                <h2 class="new-section-title">
                    Top Universities in Dubai for {{$cityName}} Students
                </h2>

                <p class="section-subtext">
                    Explore world-class education opportunities in Dubai and take a confident step toward your global career goals. Our Study in Dubai Consultants in {{$cityName}} help you identify the right universities, explore popular programs, and secure admissions in leading Dubai institutions.
                </p>
            </div>

            <div class="universities-grid">
                @php
    $universities = [
        'University of Dubai',
        'Dubai International Academic City (DIAC) universities',
        'Canadian University Dubai',
        'Middlesex University Dubai',
        'Heriot-Watt University Dubai',
        'Murdoch University Dubai',
        'American University in Dubai (AUD)',
        'University of Wollongong in Dubai (UOWD)',
        'Manipal Academy of Higher Education Dubai',
        'University of Birmingham Dubai',
    ];
                @endphp

                @foreach($universities as $university)
                    <div class="university-card">
                        <i class="fa-solid fa-building-columns"></i>
                        <span>{{ $university }}</span>
                    </div>
                @endforeach
            </div>

            <style>
                .section-subtext {
                    margin-bottom: 2rem;
                    text-align: start;
                }

                .universities-grid {
                    max-width: 1200px;
                    margin: 0 auto;
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 20px;
                }

                .university-card {
                    background: #fff;
                    border-radius: 14px;
                    padding: 18px 16px;
                    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    justify-content: center;
                    font-weight: 500;
                    color: #1c2c59;
                    transition: all 0.35s ease;
                }

                .university-card i {
                    color: var(--primary-color);
                    font-size: 20px;
                }

                .university-card:hover {
                    transform: translateY(-6px);
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                }
            </style>
        </section>


        <!-- Why Students in city Choose WTS   -->
        <section class="sop-samples">
            <div class="heading-wrapper">
                <h2 class="new-section-title">Why WTS is a Leading Dubai Education Consultant in {{ $cityName }}</h2>
            </div>

            <div class="sample-container">
                <div class="sample-card">
                    <div class="sample-card-icon"><i class="fa-solid fa-user-check"></i></div>
                    <h3>Personalized Attention</h3>
                    <p>We treat you as an individual, understanding your goals to build the right pathway for your success
                        abroad.</p>
                </div>

                <div class="sample-card">
                    <div class="sample-card-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <h3>End-to-End Guidance</h3>
                    <p>From course selection to post-arrival services, we’re with you at every stage of your journey.</p>
                </div>

                <div class="sample-card">
                    <div class="sample-card-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Transparent & Ethical</h3>
                    <p>No hidden fees, no false promises -just honest and reliable guidance.</p>
                </div>

                <div class="sample-card">
                    <div class="sample-card-icon"><i class="fa-solid fa-thumbs-up"></i></div>
                    <h3>Rejection to Approval</h3>
                    <p>Our team specializes in turning weak or rejected applications into success stories.</p>
                </div>

                <div class="sample-card">
                    <div class="sample-card-icon"><i class="fa-solid fa-globe"></i></div>
                    <h3>Global Network</h3>
                    <p>We connect you to top institutions worldwide while providing personalized local support in India.</p>
                </div>

                <div class="sample-card">
                    <div class="sample-card-icon"><i class="fa-solid fa-trophy"></i></div>
                    <h3>Success-Oriented Approach</h3>
                    <p>Our goal isn’t just visa approval -it’s helping you achieve long-term global success.</p>
                </div>
            </div>
        </section>

        <!-- Popular Study Abroad Courses -->
        <section class="student-support">
            <div class="container">
                <h2 class="new-section-title" style="color: black;">
                    Popular Dubai Courses Chosen by Indian Students
                </h2>

                <p style="padding-bottom: 1rem;">Selecting the right course is the initial step in developing a successful
                    international career. Here are the top fields that students from India choose, along with popular
                    specializations.</p>

                <div class="support-grid-1">
                    <div class="support-item">
                        <h3 class="support-heading"><span class="number-badge">01.</span> MBA</h3>
                        <ul class="support-text">
                            <li>Finance</li>
                            <li>Marketing</li>
                            <li>International Trade</li>
                            <li>HR</li>
                            <li>Business Analytics</li>
                        </ul>
                    </div>

                    <div class="support-item">
                        <h3 class="support-heading"><span class="number-badge">02.</span>Engineering</h3>
                        <ul class="support-text">
                            <li>Mechanical</li>
                            <li>Electrical</li>
                            <li>Civil</li>
                            <li>Aerospace</li>
                            <li>Biomedical</li>
                        </ul>
                    </div>

                    <div class="support-item">
                        <h3 class="support-heading"><span class="number-badge">03.</span>Computer Science & IT</h3>
                        <ul class="support-text">
                            <li>Artificial Intelligence</li>
                            <li>Cloud Computing</li>
                            <li>Data Science</li>
                            <li>Cyber Security</li>
                            <li>Software Engineering</li>
                        </ul>
                    </div>

                    <div class="support-item">
                        <h3 class="support-heading"><span class="number-badge">04.</span>Health & Life Sciences</h3>
                        <ul class="support-text">
                            <li>Nursing</li>
                            <li>Pharmacy</li>
                            <li>Biotechnology</li>
                            <li>Public Health</li>
                        </ul>
                    </div>

                    <div class="support-item">
                        <h3 class="support-heading"><span class="number-badge">05.</span>Hospitality & Tourism</h3>
                        <ul class="support-text">
                            <li>Hotel Management</li>
                            <li>Travel Operations</li>
                            <li>Event Management</li>
                        </ul>
                    </div>

                    <div class="support-item">
                        <h3 class="support-heading"><span class="number-badge">06.</span>Arts & Humanities</h3>
                        <ul class="support-text">
                            <li>Psychology</li>
                            <li>Sociology</li>
                            <li>Media & Communication</li>
                        </ul>
                    </div>
                </div>
            </div>

        </section>

        <!-- Step-by-Step Process Section -->
        <section class="process-flow-section">
            <div class="heading-wrapper">
                <h2 class="new-section-title">Simple Step-by-Step Process to Study Abroad</h2>
            </div>
            <div class="process-flow-container">

                <!-- Desktop Image -->
                <img src="/images/city/process-desktop.png" alt="Study Abroad Step-by-Step Process"
                    class="process-img desktop-process-img">

                <!-- Mobile Image -->
                <img src="/images/city/process-mobile.png" alt="Study Abroad Step-by-Step Process Mobile"
                    class="process-img mobile-process-img">

            </div>
        </section>

        <!-- Client Testimonials  -->
        <section class="video-gallery-section">
            <div class="container">
                <h2 class="new-section-title">What Students Say About Us</h2>

                <!-- Swiper -->
                <div class="swiper video-swiper">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $index => $video)
                            @php
        $videoId = Str::afterLast($video->url, '/');
        $loadingAttr = $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"';
                            @endphp
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-wrapper">
                                        <div class="youtube-facade" data-video-id="{{ $videoId }}"
                                            data-image="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                            onclick="loadYoutube(this)">
                                            <img src="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                                {!! $loadingAttr !!} alt="{{ $video->title }}">

                                            <!-- Play Button -->
                                            <button class="video-play-btn" aria-label="Play testimonial video"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Custom Navigation -->
                    <button class="custom-swiper-prev"><img src="/new-home-images/svg-icons/right-arrow.svg"
                            style="transform: rotate(180deg); height: 20px;" alt="left-arrow"></button>
                    <button class="custom-swiper-next"><img src="/new-home-images/svg-icons/right-arrow.svg"
                            style="height: 20px;" alt="right-arrow"></button>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="new-faq-section">
            <div class="new-faq-container">
                <div class="new-faq-left">
                    <h3 class="new-section-title">FAQ About Dubai Education Consultants in {{$cityName}}</h3>
                    <p class="new-faq-text">
                        Have a question? Our experts are here to guide you - just reach out.
                    </p>
                    <div class="new-faq-graphic">
                        <img src="/new-home-images/faq-image2.jpeg"
                            style="border-top-right-radius: 20px; border-top-left-radius: 20px; border-bottom-left-radius: 50%; border-bottom-right-radius: 50%;"
                            alt="FAQ Graphic" />
                    </div>
                </div>

                <div class="new-faq-right">
                    <div class="new-faq-accordion">
                        <div class="new-faq-item">
                            <button class="new-faq-btn">
                                Why should students from {{$cityName}} choose Dubai for higher education?
                                <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">
                                Dubai offers globally recognised degrees, modern universities, industry-focused programs, and a multicultural learning environment. Students from {{$cityName}} prefer Dubai for its strong academic–industry connections, international exposure, and excellent quality of education.
                            </div>
                        </div>
                        <div class="new-faq-item">
                            <button class="new-faq-btn">
                                How can Dubai Education Consultants in {{$cityName}} help students?
                                <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">
                                Dubai Education Consultants in {{$cityName}} provide personalised counselling, assist in choosing the right university and course, guide students through applications, offer SOP support, and help with documentation for a smooth admission process.
                            </div>
                        </div>
                        <div class="new-faq-item">
                            <button class="new-faq-btn">
                                What are the popular courses to study in Dubai?
                                <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">
                                Popular courses in Dubai include Business Management, Engineering, Computer Science, Data Science, Artificial Intelligence, Finance, Hospitality Management, Media Studies, Architecture, and International Business.
                            </div>
                        </div>

                        <div class="new-faq-item">
                            <button class="new-faq-btn">
                                Are there English-taught programs available in Dubai?
                                <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">
                                Yes, most universities in Dubai offer a wide range of English-taught programs, making it an ideal destination for international students.
                            </div>
                        </div>
                        <div class="new-faq-item">
                            <button class="new-faq-btn">
                                What is the cost of studying in Dubai for {{$cityName}} students?
                                <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">
                                The cost of studying in Dubai varies depending on the university and program. Many institutions offer flexible fee structures and scholarship opportunities for international students.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <script>
            const statBoxes = document.querySelectorAll(".stat-box");
            const speed = 120;

            const animateCounter = (counter, target) => {
                let count = 0;
                const increment = target / speed;

                const update = () => {
                    count += increment;
                    if (count < target) {
                        counter.textContent = Math.ceil(count);
                        requestAnimationFrame(update);
                    } else {
                        counter.textContent = target;
                    }
                };

                update();
            };

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const box = entry.target;
                        const target = +box.dataset.target;
                        const counter = box.querySelector(".stat-number");

                        animateCounter(counter, target);
                        observer.unobserve(box);
                    }
                });
            }, { threshold: 0.4 });

            statBoxes.forEach(box => observer.observe(box));
        </script>

@endsection