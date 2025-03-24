<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">

    <title>Amando Cope College</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
</head>

<body>

    <header class="main-header clearfix" role="header">
        <div class="logo">


            <!-- <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-image w-12 h-12 border rounded-full"> -->



            <a href="{{ route('home') }}"><em>Amando</em></a>

        </div>
        <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>

        @if (Route::currentRouteName() != 'login')
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <!-- Home Link -->
                <li>
                    <a class="mobile-nav"
                        href="{{ Route::currentRouteName() == 'home' ? '#section1' : route('home') }}">Home</a>
                </li>

                <!-- About Us Submenu -->
                <li class="has-submenu">


                    <a class="mobile-nav"
                        href="{{ Route::currentRouteName() == 'home' ? '#section2' : route('about') }}">About Us</a>

                    <ul class="sub-menu">
                        <li><a href="{{ Route::currentRouteName() == 'home' ? '#section2' : route('who_we_are') }}">Who
                                we are?</a></li>
                        <li><a href="{{ Route::currentRouteName() == 'home' ? '#section3' : route('what_we_do') }}">What
                                we do?</a></li>
                        <li>
                            <a href="https://www.facebook.com/amando.cope.9" target="_blank" rel="noopener noreferrer">
                                Learn More
                            </a>
                        </li>



                    </ul>
                </li>

                <!-- Other Links -->
                <li class="mobile-nav">
                    <a class=" mobile-nav"
                        href="{{ Route::currentRouteName() == 'home' ? '#section4' : route('courses') }}">Courses</a>
                </li>
                <li class="mobile-nav">
                    <a class="mobile-nav"
                        href="{{ Route::currentRouteName() == 'home' ? '#section6' : route('contact') }}">Contact</a>
                </li>

                <!-- Authentication Links -->
                @guest
                <!-- Login Link -->
                <li><a href="{{ route('login') }}" class="external">Login</a></li>
                <!-- Register under a Submenu -->

                <li><a href="{{ route('register') }}" class="external">Register</a></li>

                @endguest

                @auth
                <!-- Authenticated User Links -->
                <li><a href="{{ route('dashboard') }}" class="external">Dashboard</a></li>
                <li><a href="{{ route('logout') }}" class="external"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
            </ul>
        </nav>
        @endif
    </header>





    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/courses-video.mp4" type="video/mp4" />
        </video>

        <!-- <div class="video-overlay header-text">
          <div class="caption">
              <h6>Amando Cope College</h6>
              <h2><em>Your</em> Classroom</h2>
              <div class="main-button">
                  <div class="scroll-to-section"><a href="#section2">Discover more</a></div>
              </div>
          </div>
      </div> -->
    </section>
    <!-- ***** Main Banner Area End ***** -->


    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="features-post">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa fa-pencil"></i>College Courses</h4>
                            </div>
                            <div class="content-hide">


                                <h3>Courses</h3>
                                <ul>
                                    <li><strong>Business Administration</strong></li>
                                    <ul>
                                        <li>B.A. in Operation Management</li>
                                        <li>B.A. in Financial Management</li>
                                        <li>B.A. in Marketing Management</li>
                                    </ul>

                                    <li><strong>Tourism Management</strong></li>
                                    <li><strong>Secondary Education</strong></li>
                                    <ul>
                                        <li>B.A. in English</li>
                                        <li>B.A. in Science</li>
                                    </ul>

                                    <li><strong>Criminology</strong></li>
                                    <li><strong>Computer Science</strong></li>
                                    <li><strong>Nursing</strong></li>
                                </ul>




                                <div class="scroll-to-section"><a href="#section2">More Info.</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="features-post second-features">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa fa-graduation-cap"></i>SHS Strands</h4>
                            </div>
                            <div class="content-hide">
                                <p> Our specialized tracks and programs are designed to help you succeed in your chosen
                                    field.</p>
                                <p class="hidden-sm">Choose from Academic, Technical-Vocational-Livelihood (TVL),
                                    Sports, or Arts and Design tracks to shape your future.</p>
                                <div class="scroll-to-section"><a href="#section3">Learn More</a></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="features-post third-features">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa fa-book"></i>Classes</h4>
                            </div>
                            <div class="content-hide">

                                <p> Join a dynamic learning environment designed to help you excel academically and
                                    professionally.</p>





                                <div class="scroll-to-section"><a href="#section4">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section why-us" data-section="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Why choose Amando?</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id='tabs'>
                        <ul>
                            <li><a href='#tabs-1'>Best Education</a></li>
                            <li><a href='#tabs-2'>Top Management</a></li>
                            <li><a href='#tabs-3'>Academic Collaboration</a></li>
                        </ul>
                        <section class='tabs-content'>
                            <article id='tabs-1'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/2.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Best Education</h4>

                                        <p>Our college offers a comprehensive and accessible learning environment with
                                            cutting-edge programs and expert faculty. Whether you're pursuing your
                                            undergraduate degree, professional studies, or preparing for graduate
                                            school, we provide resources to support your success. Feel free to explore
                                            the wide range of academic and extracurricular opportunities available. We
                                            invite you to make a contribution to help us continue offering high-quality
                                            education, and don’t forget to share our mission with others. Thank you for
                                            your support!</p>

                                    </div>
                                </div>
                            </article>
                            <article id='tabs-2'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/1.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Top-Tier Programs</h4>
                                        <p>Our college provides an exceptional learning experience, with the flexibility
                                            to explore a wide range of academic programs and extracurricular activities.
                                            You can customize your academic journey by choosing from various
                                            disciplines, engaging with faculty, and participating in research projects
                                            and student organizations.</p>
                                        <p>With a focus on holistic development, we prepare you for success in both your
                                            career and life. Our curriculum is designed to foster critical thinking,
                                            creativity, and leadership skills, ensuring that you are ready to thrive in
                                            a rapidly evolving world.</p>

                                    </div>
                                </div>
                            </article>
                            <article id='tabs-3'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/3.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Academic Collaboration</h4>
                                        <p>We encourage students, faculty, and staff to collaborate on innovative
                                            projects, research, and academic events. Our college hosts regular meetings
                                            and conferences where you can engage with experts and peers in your field.
                                            For more information on upcoming academic events, feel free to <a
                                                rel="nofollow" href="https://www.facebook.com/amando.cope.9"
                                                target="_parent">contact our office</a> now.</p>
                                    </div>
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section coming-soon" data-section="section3">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-xs-12">
                    <div class="continer centerIt">
                        <div>
                            <h4>Take the next step in your education—enroll in <em>any course</em> today and invest in
                                your future with quality learning and expert guidance!</h4>







                            <div class="counter">

                                <div class="days">
                                    <div class="value">00</div>
                                    <span>Days</span>
                                </div>

                                <div class="hours">
                                    <div class="value">00</div>
                                    <span>Hours</span>
                                </div>

                                <div class="minutes">
                                    <div class="value">00</div>
                                    <span>Minutes</span>
                                </div>

                                <div class="seconds">
                                    <div class="value">00</div>
                                    <span>Seconds</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="right-content">
                        <div class="top-content">
                            <h6>Register your free account and <em>get immediate</em> access to online courses</h6>
                        </div>
                        <form id="contact" action="" method="get">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <input name="name" type="text" class="form-control" id="name"
                                            placeholder="Your Name" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email"
                                            placeholder="Your Email" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <input name="phone-number" type="text" class="form-control" id="phone-number"
                                            placeholder="Your Phone Number" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="button">Get it now</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section courses" data-section="section4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Choose Your Course</h2>
                    </div>
                </div>
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <img src="assets/images/course-1.jpg" alt="Course #1">
                        <div class="down-content">
                            <h4>Business Administration</h4>
                            <p>Master the fundamentals of business operations, strategy, and management to thrive in the
                                competitive corporate world.</p>
                            <div class="author-image">
                                <img src="assets/images/author-01.png" alt="Author 1">
                            </div>
                            <div class="text-button-pay">
                                <a href="#">Learn More <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/course-2.jpg" alt="Course #2">
                        <div class="down-content">
                            <h4>Tourism Management</h4>
                            <p>Gain expertise in the tourism industry, learning to manage tourism businesses,
                                destinations, and services effectively.</p>
                            <div class="author-image">
                                <img src="assets/images/author-02.png" alt="Author 2">
                            </div>
                            <div class="text-button-free">
                                <a href="#">Learn More <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/course-3.jpg" alt="Course #3">
                        <div class="down-content">
                            <h4>Secondary Education</h4>
                            <p>Prepare to teach secondary school students, focusing on curriculum design, pedagogy, and
                                educational theory.</p>
                            <div class="author-image">
                                <img src="assets/images/author-03.png" alt="Author 3">
                            </div>
                            <div class="text-button-pay">
                                <a href="#">Learn More <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/course-4.jpg" alt="Course #4">
                        <div class="down-content">
                            <h4>Criminology</h4>
                            <p>Study criminal law, criminology theories, and justice systems to pursue a career in law
                                enforcement and criminal justice.</p>
                            <div class="author-image">
                                <img src="assets/images/author-04.png" alt="Author 4">
                            </div>
                            <div class="text-button-free">
                                <a href="#">Learn More <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/course-5.jpg" alt="Course #5">
                        <div class="down-content">
                            <h4>Computer Science</h4>
                            <p>Develop essential programming skills, data analysis, and problem-solving techniques for a
                                successful career in software development.</p>
                            <div class="author-image">
                                <img src="assets/images/author-05.png" alt="Author 5">
                            </div>
                            <div class="text-button-pay">
                                <a href="#">Learn More <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/course-6.jpg" alt="Course #6">
                        <div class="down-content">
                            <h4>Nursing</h4>
                            <p>Prepare for a fulfilling healthcare career by learning nursing techniques, patient care,
                                and critical healthcare skills.</p>
                            <div class="author-image">
                                <img src="assets/images/author-01.png" alt="Author 1">
                            </div>
                            <div class="text-button-free">
                                <a href="#">Learn More<i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </div>
    </section>


    <section class="section video" data-section="section5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="left-content">
                        <span>Your Future Starts Here</span>
                        <span>Welcome to Our School</span>
                        <h4>Watch the video to learn more <em>about Our School</em></h4>
                        <p>At our school, we are committed to providing an exceptional learning experience. Our
                            dedicated teachers, diverse programs, and vibrant community make us a top choice for
                            students aiming for excellence.</p>
                        <p>Explore the many opportunities that await you, from academic programs to extracurricular
                            activities, designed to help you grow both academically and personally.</p>
                        <div class="main-button"><a rel="nofollow" href="https://www.facebook.com/amando.cope.9"
                                target="_parent">Visit Us</a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <article class="video-item">
                        <div class="video-caption">
                            <h4>Amando Cope College</h4>
                        </div>
                        <figure>
                            <a href="https://www.facebook.com/amando.cope.9/videos/1120214873107483" class="play"><img
                                    src="assets/images/video-thumb-03.jpg"></a>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section contact" data-section="section6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Let’s Keep In Touch</h2>
                    </div>
                </div>


                <div class="col-md-6">

                    <!-- Do you need a working HTML contact-form script?
                	
                    Please visit https://templatemo.com/contact page -->

                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Your Name" required="">
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <input name="email" type="text" class="form-control" id="email"
                                        placeholder="Your Email" required="">
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset>
                                    <textarea name="message" rows="6" class="form-control" id="message"
                                        placeholder="Your message..." required=""></textarea>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="button">Send Message Now</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>


                </div>

                <div class="col-md-6">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3881.9192070054037!2d123.72128428885495!3d13.355299700000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1adc91b728cb1%3A0x5b3e355634ab3779!2sAmando%20Cope%20College!5e0!3m2!1sen!2sph!4v1738855547113!5m2!1sen!2sph"
                            style="border:0;" width="100%" height="422px" frameborder="0" style="border:0"
                            allowfullscreen></iframe>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Copyright 2025 by Amando Cope

                        <<<<<<< HEAD <!-- | Design: <a href="https://templatemo.com" rel="sponsored" target="_parent">
                            TemplateMo</a>
                    </p> -->
                    =======
                    | Design: <a href="https://templatemo.com" rel="sponsored" target="_parent">TemplateMo</a></p>
                    >>>>>>> 708ea2503849bd71b73db9c9ec90afbcaec22128
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
    //according to loftblog tut
    $('.nav li:first').addClass('active');

    var showSection = function showSection(section, isAnimate) {
        var
            direction = section.replace(/#/, ''),
            reqSection = $('.section').filter('[data-section="' + direction + '"]'),
            reqSectionPos = reqSection.offset().top - 0;

        if (isAnimate) {
            $('body, html').animate({
                    scrollTop: reqSectionPos
                },
                800);
        } else {
            $('body, html').scrollTop(reqSectionPos);
        }

    };

    var checkSection = function checkSection() {
        $('.section').each(function() {
            var
                $this = $(this),
                topEdge = $this.offset().top - 80,
                bottomEdge = topEdge + $this.height(),
                wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
                var
                    currentId = $this.data('section'),
                    reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                reqLink.closest('li').addClass('active').
                siblings().removeClass('active');
            }
        });
    };

    $('.main-menu, .scroll-to-section').on('click', 'a', function(e) {
        if ($(e.target).hasClass('external')) {
            return;
        }
        e.preventDefault();
        $('#menu').removeClass('active');
        showSection($(this).attr('href'), true);
    });

    $(window).scroll(function() {
        checkSection();
    });
    </script>
</body>

</html>