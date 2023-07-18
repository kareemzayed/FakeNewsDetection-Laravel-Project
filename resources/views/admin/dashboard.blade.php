<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Dashboard</title>

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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Dashboard-assets') }}/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Dashboard-assets') }}/src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Animate count for users widget
            $({
                countNum: 0
            }).animate({
                countNum: {{ $countOfUsers }}
            }, {
                duration: 1000,
                easing: 'linear',
                step: function() {
                    $('.users-widget .count').text(Math.floor(this.countNum));
                },
                complete: function() {
                    $('.users-widget .count').text(this.countNum);
                }
            });

            // Animate count for news widget
            $({
                countNum: 0
            }).animate({
                countNum: {{ $countOfNews }}
            }, {
                duration: 1000,
                easing: 'linear',
                step: function() {
                    $('.news-widget .count').text(Math.floor(this.countNum));
                },
                complete: function() {
                    $('.news-widget .count').text(this.countNum);
                }
            });

            // Animate count for fake news widget
            $({
                countNum: 0
            }).animate({
                countNum: {{ $countOfFakeNews }}
            }, {
                duration: 1000,
                easing: 'linear',
                step: function() {
                    $('.fake-news-widget .count').text(Math.floor(this.countNum));
                },
                complete: function() {
                    $('.fake-news-widget .count').text(this.countNum);
                }
            });

            // Animate count for true news widget
            $({
                countNum: 0
            }).animate({
                countNum: {{ $countOfTrueNews }}
            }, {
                duration: 1000,
                easing: 'linear',
                step: function() {
                    $('.true-news-widget .count').text(Math.floor(this.countNum));
                },
                complete: function() {
                    $('.true-news-widget .count').text(this.countNum);
                }
            });
        });
    </script>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ isset(auth()->user()->photo) ? asset('Images/UserImages/' . auth()->user()->photo) : 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name= ' . auth()->user()->name }}"
                                alt="">
                        </span>
                        <span class="user-name">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="{{ route('home') }}"><i class="dw dw-home"></i>Home</a>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="dw dw-user1"></i>Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i
                                class="dw dw-logout"></i>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <h1 class="dashboard-logo me-auto"><a href="{{ route('dashboard') }}">Fake News Detector</a></h1>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-bar-chart-1"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('home') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('view-users') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-user-1"></span><span class="mtext">Users</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('show-users-messages') }}" class="dropdown-toggle no-arrow">
                            <span
                                class="micon dw dw-message-1 {{ App\Http\Controllers\Admin\MainController::hasUnreadMessages() ? 'has-notification' : '' }}"></span><span
                                class="mtext">Messages</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-newspaper"></span><span class="mtext">Processes</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('show-all-processes') }}">All Processes</a></li>
                            <li><a href="{{ route('show-fake-news') }}">Fake News</a></li>
                            <li><a href="{{ route('show-real-news') }}">True News</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('Dashboard-assets') }}/vendors/images/banner-img.png" alt="">
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Welcome back <div class="weight-600 font-30 text-blue">{{ auth()->user()->name }}</div>
                        </h4>
                        <p class="font-18 max-width-600">From here, you can see all the operations that have been
                            performed on the system, view both true and fake news, view users and their allowed data,
                            add operations to them, and you can also control everything.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1 users-widget">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="widget-data">

                                <div class="h4 mb-0 text-blue"><span class="count">0</span></div>
                                <div class="weight-600 font-14">Users</div>
                                <div class="show-details"><a href="{{ route('view-users') }}">Show details ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1 news-widget">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="widget-data">

                                <div class="h4 mb-0 text-blue"><span class="count">0</span></div>
                                <div class="weight-600 font-14">Processes</div>
                                <div class="show-details"><a href="{{ route('show-all-processes') }}">Show details ></a></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1 fake-news-widget">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="widget-data">

                                <div class="h4 mb-0 text-blue"><span class="count">0</span></div>
                                <div class="weight-600 font-14">Fake News</div>
                                <div class="show-details"><a href="{{ route('show-fake-news') }}">Show details ></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1 true-news-widget">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="widget-data">

                                <div class="h4 mb-0 text-blue"><span class="count">0</span></div>
                                <div class="weight-600 font-14">True News</div>
                                <div class="show-details"><a href="{{ route('show-real-news') }}">Show details ></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h2 class="h4 mb-20">Activity</h2>
                        <div id="chart5">

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h2 class="h4 mb-20">Fake News Perecentage</h2>
                        <div id="chart6">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/core.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/script.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/process.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/layout-settings.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/dashboard.js"></script>
</body>

</html>
