<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Fake News Detector</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('Home-page-assets') }}/img/favicon.png" rel="icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('Home-page-assets') }}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('Home-page-assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('Home-page-assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('Home-page-assets') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="{{ route('home') }}">Fake News Detector</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="{{ route('home') }}">Home</a></li>
                    @auth
                        <li><a class="nav-link scrollto" href="{{ route('history') }}">History</a></li>
                    @endauth
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    @auth
                        @if (auth()->user()->admin)
                            <li><a class="nav-link scrollto" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif
                    @endauth
                    @if (!auth()->check())
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
                    @endif
                    <li class="dropdown"><a class="getstarted" href="{{ auth()->check() ? '#' : route('register') }}">
                            <span>
                                @auth
                                    {{ Auth()->user()->name }}
                                @else
                                    Sign up
                                @endauth
                            </span>
                            @auth
                                <i class="bi bi-chevron-down"></i>
                            @endauth
                        </a>
                        @auth
                            <ul>
                                <li><a href="{{ route('profile') }}"><i class="bi bi-person"></i>My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-left"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endauth
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>The best way to solve the problem of the spread of fake news</h1>
                    <h2>We help you to know the validity of the news is it real or fake?</h2>

                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#classify" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('Home-page-assets') }}/img/hero-img.png" class="img-fluid animated"
                        alt="">
                </div>
            </div>
        </div>
    </section><!-- End Hero -->
    <main id="main">
        <!-- ======= Classify Section ======= -->
        <section id="classify" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Classify News</h2>
                    <p>You can copy the text of the news and then paste it in this text area, or <a
                            href="#calssifyByURL"> click here </a>to copy the link
                        of the
                        news site and then paste it in the space designated for it.</p>
                </div>
                <div class="row">
                    <div>
                        <form action="{{ route('predict.news') }}" method="post" role="form"
                            class="news-text-form">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <textarea class="form-control" name="news" rows="10" placeholder="paste news text here .." required></textarea>
                                </div>
                                <div class="text-center"><button type="submit">Predict</button></div>
                                <div class="prediction-alter">
                                    @if (Session::has('successPrediction'))
                                        @if (Session::get('successPrediction') == "['REAL']")
                                            <div class="alert alert-success" role="alert">
                                                Looking Real News
                                            </div>
                                        @else
                                            <div class="alert alert-danger" role="alert">
                                                Looking Fake News
                                            </div>
                                        @endif
                                    @endif
                                    @if (Session::has('ErrorPrediction'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('ErrorPrediction') }}
                                        </div>
                                    @endif
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Classify Section -->

        <!--- Calssify By URL ---->
        <section id="calssifyByURL">
            <div class="classify-by-url">

                <div class="section-title">
                    <h2>Classify News By URL</h2>
                    <p>You can copy the URL of the news web page and then paste it in this text area.</p>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <p>You must enter a valid URL</p>
                            <form action="{{ route('predict.url') }}" method="post">
                                @csrf
                                <input type="text" name="newsURL"
                                    class="form-control form-control-lg @error('newsURL') is-invalid @enderror"
                                    value="{{ old('newsURL') }}" pattern="https?://.+" required>
                                <input type="submit" value="Classify">
                            </form>
                            @if ($errors->has('newsURL'))
                                <script>
                                    window.location.hash = 'calssifyByURL';
                                </script>
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        @if (Session::has('successPredictionWithURL'))
                            @if (Session::get('successPredictionWithURL') == "['REAL']")
                                <div class="alert alert-success" role="alert"
                                    style="margin-top: 20px; width: 300px;">
                                    Looking Real News
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert"
                                    style="margin-top: 20px; width: 300px;">
                                    Looking Fake News
                                </div>
                            @endif
                        @endif
                    </div>

                </div>
                @if (Session::has('ErrorPredictionWithURL'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('ErrorPredictionWithURL') }}
                    </div>
                @endif
            </div>
        </section>
        <!--End classify by URL -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">
                <div class="row">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>Contact Us</h3>
                        <p> Send a message to the admin with your inquiry about the matter, and they will reply to you
                            as soon as possible. The admin opens the messages daily to reply to your inquiries.</p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" href="#contact">Contact Us</a>
                    </div>
                </div>
            </div>
        </section><!-- End Cta Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Please leave your inquiries here, and we will respond to you as soon as possible.</p>
                </div>
                <div class="row">
                    @if (session('status') == 'Message-sent')
                        <div class="alert alert-success" role="alert"
                            style="height: 50px; border-radius: 0; margin-bottom: 8px;">
                            <p style="text-align:center">Message sent successfully
                            </p>
                        </div>
                    @endif
                    <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form action="{{ route('send-message') }}" method="post" role="form"
                            class="news-text-form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        {{ auth()->check() ? 'value=' . auth()->user()->name : '' }} required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Your Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email"
                                        {{ auth()->check() ? 'value=' . auth()->user()->email : '' }} required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    name="subject" id="subject" required>
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="10"
                                    required></textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->
    </main><!-- End #main -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('Home-page-assets') }}/vendor/aos/aos.js"></script>
    <script src="{{ asset('Home-page-assets') }}/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('Home-page-assets') }}/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('Home-page-assets') }}/js/main.js"></script>
</body>

</html>
