<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>My Profile</title>

    <!-- Site favicon -->
    <link href="{{ asset('Home-page-assets') }}/img/favicon.png" rel="icon">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Dashboard-assets') }}/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('Dashboard-assets') }}/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/cropperjs/dist/cropper.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('Dashboard-assets') }}/vendors/styles/style.css">

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

<body>

    <div class="mobile-menu-overlay"></div>

    <div class="profile-page-c">

        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Profile</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown">
                                    {{ $user->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('home') }}"><i class="dw dw-home"></i>Home</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="dw dw-user-1"></i>Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="dw dw-logout"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">

                                <img src="{{ isset($user->photo) ? asset('Images/UserImages/' . $user->photo) : 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name= ' . $user->name }}"
                                    class="avatar-photo" alt="">

                            </div>
                            <h5 class="text-center h5 mb-0">{{ $user->name }}</h5>
                            <p class="text-center text-muted font-18">
                                {{ isset($user->jop_title) ? $user->jop_title : 'N/A' }}</p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                <ul>
                                    <li>
                                        <span>Email Address:</span>
                                        {{ $user->email }}
                                    </li>
                                    <li>
                                        <span>Phone Number:</span>
                                        @if (isset($user->phone_number))
                                            {{ $user->phone_number }}
                                        @else
                                            N/A
                                        @endif
                                    </li>
                                    <li>
                                        <span>Data Of Birth:</span>
                                        @if (isset($user->data_of_birth))
                                            {{ $user->data_of_birth }}
                                        @else
                                            N/A
                                        @endif
                                    </li>
                                    <li>
                                        <span>Gender:</span>
                                        @if (isset($user->gender))
                                            @if ($user->gender === 'f')
                                                Female
                                            @else
                                                Male
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </li>
                                    <li>
                                        <span>Address:</span>
                                        @if (isset($user->address))
                                            {{ $user->address }}
                                        @else
                                            N/A
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-social">
                                <h5 class="mb-20 h5 text-blue">Social Links</h5>
                                <ul class="clearfix">
                                    <li><a href="{{ isset($social_media->facebook) ? $social_media->facebook : '#' }}"
                                            class="btn" data-bgcolor="#3b5998" data-color="#ffffff"
                                            target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ isset($social_media->twitter) ? $social_media->twitter : '#' }}"
                                            class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                                            target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ isset($social_media->linkedin) ? $social_media->linkedin : '#' }}"
                                            class="btn" data-bgcolor="#007bb5" data-color="#ffffff"
                                            target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="{{ isset($social_media->github) ? $social_media->github : '#' }}"
                                            class="btn" data-bgcolor="#000000" data-color="#ffffff"
                                            target="_blank"><i class="fa fa-github"></i></a></li>
                                    <li><a href="{{ isset($social_media->instagram) ? $social_media->instagram : '#' }}"
                                            class="btn" data-bgcolor="#ff4d4d" data-color="#ffffff"
                                            target="_blank"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist" id="MyTaps">
                                        <li class="nav-item">

                                            {{-- {{ old('tab') == 'updateInformation' ? 'active' : null }} --}}

                                            <a class="nav-link {{ session('status') == 'information-updated' ? 'active' : null }}
                                                {{ session('status') == null ? 'active' : null }}"
                                                data-toggle="tab" href="#updateInformation" role="tab">Update
                                                Information</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ session('status') == 'password-updated' ? 'active' : null }}"
                                                data-toggle="tab" href="#updatePassword" role="tab">Update
                                                Password</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ old('tab') == 'twoFactorAuth' ? 'active' : null }}
                                                {{ session('status') == 'two-factor-authentication-disabled' ? 'active' : null }}
                                                {{ session('status') == 'two-factor-authentication-enabled' ? 'active' : null }}"
                                                data-toggle="tab" href="#twoFactorAuth" role="tab">2F
                                                Authentication</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="nav-tab">
                                        <!-- Setting Tab start -->
                                        <div class="tab-pane fade height-100-p {{ session('status') == 'information-updated' ? 'show active' : null }}
                                            {{ session('status') == null ? 'show active' : null }}"
                                            id="updateInformation" role="tabpanel">

                                            <div class="profile-setting">
                                                <form method="POST" action="{{ route('update.information') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    @if (session('status') == 'information-updated')
                                                        <div class="alert alert-success" role="alert"
                                                            style="height: 50px; border-radius: 0; margin-bottom: 0;">
                                                            <p style="text-align:center">Your information is updated
                                                                successfully
                                                            </p>
                                                        </div>
                                                    @endif

                                                    <ul class="profile-edit-list row">
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">Edit Your Personal Setting
                                                            </h4>
                                                            <div class="form-group">
                                                                <label for="name">Full Name</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                                    id="name" name="name"
                                                                    value="{{ $user->name }}"
                                                                    onclick="this.select()">

                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email"
                                                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                                    id="email" name="email"
                                                                    value="{{ $user->email }}"
                                                                    onclick="this.select()">

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="jop_title">Jop Title</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('jop_title') is-invalid @enderror"
                                                                    id="jop_title" name="jop_title"
                                                                    value="{{ isset($user->jop_title) ? $user->jop_title : '' }}"
                                                                    onclick="this.select()">

                                                                @error('jop_title')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="data_of_birth">Date of birth</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg date-picker @error('data_of_birth') is-invalid @enderror"
                                                                    id="data_of_birth" name="data_of_birth"
                                                                    value="{{ isset($user->data_of_birth) ? $user->data_of_birth : '' }}"
                                                                    onclick="this.select()">

                                                                @error('data_of_birth')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Gender</label>
                                                                <div class="d-flex">
                                                                    <div
                                                                        class="custom-control custom-radio mb-5 mr-20">
                                                                        <input type="radio" id="male"
                                                                            name="gender"
                                                                            class="custom-control-input"
                                                                            value="m"
                                                                            @if ($user->gender === 'm') @checked(true) @endif>
                                                                        <label class="custom-control-label weight-400"
                                                                            for="male">Male</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-5">
                                                                        <input type="radio" id="female"
                                                                            name="gender"
                                                                            class="custom-control-input"
                                                                            value="f"
                                                                            @if ($user->gender === 'f') @checked(true) @endif>
                                                                        <label class="custom-control-label weight-400"
                                                                            for="female">Female</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone_number">Phone Number</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                                                                    id="phone_number" name="phone_number"
                                                                    value="{{ isset($user->phone_number) ? $user->phone_number : '' }}"
                                                                    onclick="this.select()">

                                                                @error('phone_number')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                                    onclick="this.select()">
                                                                    {{ isset($user->address) ? $user->address : '' }}
                                                                </textarea>

                                                                @error('address')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </li>

                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
                                                            <div class="form-group">
                                                                <label for="facebook">Facebook URL:</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('facebook') is-invalid @enderror"
                                                                    id="facebook" name="facebook"
                                                                    value="{{ isset($social_media->facebook) ? $social_media->facebook : '' }}"
                                                                    placeholder="Paste your link here"
                                                                    onclick="this.select()">

                                                                @error('facebook')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="twitter">Twitter URL:</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('twitter') is-invalid @enderror"
                                                                    id="twitter" name="twitter"
                                                                    value="{{ isset($social_media->twitter) ? $social_media->twitter : '' }}"
                                                                    placeholder="Paste your link here"
                                                                    onclick="this.select()">

                                                                @error('twitter')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="linkedin">Linkedin URL:</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('linkedin') is-invalid @enderror"
                                                                    id="linkedin" name="linkedin"
                                                                    value="{{ isset($social_media->linkedin) ? $social_media->linkedin : '' }}"
                                                                    placeholder="Paste your link here"
                                                                    onclick="this.select()">

                                                                @error('linkedin')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="github">Github URL:</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('github') is-invalid @enderror"
                                                                    id="github" name="github"
                                                                    value="{{ isset($social_media->github) ? $social_media->github : '' }}"
                                                                    placeholder="Paste your link here"
                                                                    onclick="this.select()">

                                                                @error('github')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="instagram">Instagram URL:</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('instagram') is-invalid @enderror"
                                                                    id="instagram" name="instagram"
                                                                    value="{{ isset($social_media->instagram) ? $social_media->instagram : '' }}"
                                                                    placeholder="Paste your link here"
                                                                    onclick="this.select()">

                                                                @error('instagram')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="skype">Skype URL:</label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg @error('skype') is-invalid @enderror"
                                                                    id="skype" name="skype"
                                                                    value="{{ isset($social_media->skype) ? $social_media->skype : '' }}"
                                                                    placeholder="Paste your link here"
                                                                    onclick="this.select()">

                                                                @error('skype')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="photo">Profile Pecture:</label>
                                                                <input type="file"
                                                                    class="form-control form-control-lg @error('photo') is-invalid @enderror"
                                                                    id="photo" name="photo">

                                                                @error('photo')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Update Information">
                                                            </div>

                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Setting Tab End -->
                                        <!-- Update password start -->

                                        {{-- {{ old('tab') == 'updatePassword' ? 'show active' : null }} --}}

                                        <div class="tab-pane fade
                                            {{ session('status') == 'password-updated' ? 'show active' : null }}"
                                            id="updatePassword" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="profile-update-password">
                                                    <form method="POST" action="{{ route('update-password') }}">
                                                        @csrf

                                                        @if (session('status') == 'password-updated')
                                                            <div class="alert alert-success" role="alert"
                                                                style="height: 50px; border-radius: 0; margin-bottom: 0;">
                                                                <p style="text-align:center">
                                                                    Your password has been updated
                                                                </p>
                                                            </div>
                                                        @endif

                                                        <h4 class="text-blue h5 mb-20">Update Password
                                                        </h4>
                                                        <div class="form-group">
                                                            <label for="password">Current Password</label>
                                                            <input type="password"
                                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                                id="password" name="password" autofocus>

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="newPassword">New Password</label>
                                                            <input type="password"
                                                                class="form-control form-control-lg @error('newPassword') is-invalid @enderror"
                                                                id="newPassword" name="newPassword">

                                                            @error('newPassword')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <small><?php echo $message; ?></small>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="confirmPassword">Confirm New Password</label>
                                                            <input type="password"
                                                                class="form-control form-control-lg @error('confirmPassword') is-invalid @enderror"
                                                                id="confirmPassword" name="confirmPassword">

                                                            @error('confirmPassword')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <small><?php echo $message; ?></small>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary"
                                                                value="Update Password">
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Update Password Tab End -->

                                        <!-- Two factor Auth start -->
                                        <div class="tab-pane fade
                                            {{ session('status') == 'two-factor-authentication-disabled' ? 'show active' : null }}
                                            {{ session('status') == 'two-factor-authentication-enabled' ? 'show active' : null }}"
                                            id="twoFactorAuth" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <div class="profile-two-factor pb-30">
                                                        <form method="POST" action="/user/two-factor-authentication">
                                                            @csrf

                                                            @if (session('status') == 'two-factor-authentication-disabled')
                                                                <div class="alert alert-success" role="alert"
                                                                    style="height: 50px; border-radius: 0; margin-bottom: 0;">
                                                                    <p style="text-align:center">
                                                                        Two Factor Authentication Disabled
                                                                    </p>
                                                                </div>
                                                            @endif

                                                            @if (session('status') == 'two-factor-authentication-enabled')
                                                                <div class="alert alert-success" role="alert"
                                                                    style="height: 50px; border-radius: 0; margin-bottom: 0;">
                                                                    <p style="text-align:center">
                                                                        Two Factor Authentication Enabled
                                                                    </p>
                                                                </div>
                                                            @endif

                                                            <h4 class="text-blue h5 mb-20">Two Factor Authentication
                                                            </h4>
                                                            <div class="form-group">
                                                                @if (auth()->user()->two_factor_secret)
                                                                    <h5 style="margin-bottom: 10px;">Please scane this
                                                                        QR code with any Authentication App</h5>

                                                                    @method('DELETE')

                                                                    <div style="padding: 5px; margin: 15px 10px;">
                                                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                                                    </div>

                                                                    <div>
                                                                        <h5 style="margin: 15px 0;">Recovery Codes:
                                                                        </h5>
                                                                        <ul>
                                                                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                                                                <li
                                                                                    style="list-style: circle; margin: 5px 20px">
                                                                                    {{ $code }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>

                                                                    <div class="form-group mb-0">
                                                                        <input type="submit" class="btn btn-danger"
                                                                            value="Disable">
                                                                    </div>
                                                                @else
                                                                    <h5 style="margin-bottom: 10px;">Two factor
                                                                        Authentication not enabled</h5>

                                                                    <div class="form-group mb-0">
                                                                        <input type="submit" class="btn btn-primary"
                                                                            value="Enable">
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Two factor Auth End -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/cropperjs/dist/cropper.js"></script>
</body>

</html>
