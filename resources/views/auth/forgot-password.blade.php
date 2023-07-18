<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Fake News Detector | Forgot Password</title>
    <!-- Favicon -->
    <link href="{{ asset('Home-page-assets') }}/img/favicon.png" rel="icon">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Dashboard-assets') }}/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('Dashboard-assets') }}/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('Dashboard-assets') }}/vendors/styles/style.css">
    <link href="{{ asset('Home-page-assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ route('home') }}">
                    <p>Fake News Detector</p>
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{ route('landing-page') }}">Home</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('Dashboard-assets') }}/vendors/images/forgot-password.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Reset Password</h2>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-group custom">
                                <input id="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                                @if (!$errors->any())
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="already-have-account"><a class="btn btn-link" style="font-size: 15px" href="{{ route('login') }}">Back to login</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/core.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/script.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/process.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/layout-settings.js"></script>
</body>

</html>