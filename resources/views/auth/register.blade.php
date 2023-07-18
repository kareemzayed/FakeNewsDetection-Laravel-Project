 <!DOCTYPE html>
 <html>

 <head>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
     <meta charset="utf-8">
     <title>Fake News Detector | Register</title>
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
    <!-- Vendor CSS Files -->
    
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
                     <img src="{{ asset('Dashboard-assets') }}/vendors/images/register-page-img.png" alt="">
                 </div>
                 <div class="col-md-6 col-lg-5">
                     <div class="login-box register bg-white box-shadow border-radius-10">
                         <div class="login-title register-title">
                             <h2 class="text-center text-primary">Register</h2>
                         </div>
                         <form method="POST" action="{{ route('register') }}">
                             @csrf

                             <label for="name" style="color:darkslategrey; font-size:17px;">User Name</label>
                             <div class="input-group register custom">
                                 <input id="name" type="text"
                                     class="form-control @error('name') is-invalid @enderror" name="name"
                                     value="{{ old('name') }}" required autocomplete="name" autofocus>

                                 @error('name')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror

                                 @if (!$errors->any())
                                     <div class="input-group-append custom">
                                         <span class="input-group-text"><i class="bi bi-person"></i></span>
                                     </div>
                                 @endif
                             </div>
                             <label for="name" style="color:darkslategrey; font-size:17px;">Email</label>
                             <div class="input-group register custom">
                                 <input id="email" type="email"
                                     class="form-control @error('email') is-invalid @enderror" name="email"
                                     value="{{ old('email') }}" required autocomplete="email">
                                 @error('email')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror

                                 @if (!$errors->any())
                                     <div class="input-group-append custom">
                                         <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                                     </div>
                                 @endif

                             </div>
                             <label for="name" style="color:darkslategrey; font-size:17px;">Password</label>
                             <div class="input-group register custom">
                                 <input id="password" type="password"
                                     class="form-control @error('password') is-invalid @enderror" name="password"
                                     required placeholder="**********">
                                     
                                 @error('password')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror

                                 @if (!$errors->any())
                                     <div class="input-group-append custom">
                                         <span class="input-group-text"><i class="bi bi-eye" id="passwordEye"></i></span>
                                     </div>
                                 @endif
                             </div>

                             <label for="name" style="color:darkslategrey; font-size:17px;">Confirm Password</label>
                             <div class="input-group register custom">
                                 <input id="password-confirm" type="password" class="form-control"
                                     name="password_confirmation" required placeholder="**********">
                                     <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="bi bi-eye" id="ConfirmpasswordEye"></i></span>
                                    </div>
                             </div>
                             <div class="row">
                                 <div class="col-sm-12">
                                     <div class="input-group mb-0">
                                         <button type="submit" class="btn btn-primary btn-lg btn-block">
                                             Register
                                         </button>
                                     </div>
                                 </div>
                             </div>
							<div class="already-have-account"><a class="btn btn-link" style="font-size: 15px" href="{{ route('login') }}">already have account? login</a></div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- js -->
     <script>
        let passwordEye = document.getElementById("passwordEye");
        let password = document.getElementById("password");
        let ConfirmpasswordEye = document.getElementById('ConfirmpasswordEye');
        let ConfirmPassword = document.getElementById("password-confirm");

        passwordEye.onclick = function() {
            if(password.type == "password") {
                password.type = "text";
                passwordEye.className  = "bi bi-eye-slash";
            }
            else {
                password.type = "password";
                passwordEye.className  = "bi bi-eye";
            }
        }

        ConfirmpasswordEye.onclick = function() {
            if(ConfirmPassword.type == "password") {
                ConfirmPassword.type = "text";
                ConfirmpasswordEye.className  = "bi bi-eye-slash";
            }
            else {
                ConfirmPassword.type = "password";
                ConfirmpasswordEye.className  = "bi bi-eye";
            }
        }
     </script>
     <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/core.js"></script>
     <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/script.min.js"></script>
     <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/process.js"></script>
     <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/layout-settings.js"></script>
 </body>

 </html>
