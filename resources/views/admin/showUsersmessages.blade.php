<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Messages</title>

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
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- multiple select row Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Users Messages</h4>
                    </div>
                    <div class="pb-20">
                        @if (session('status') == 'message-deleted')
                            <div class="alert alert-success" role="alert"
                                style="height: 50px; border-radius: 0; margin-bottom: 8px;">
                                <p style="text-align:center">message deleted successfully
                                </p>
                            </div>
                        @endif

                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User ID</th>
                                    <th>Subject</th>
                                    <th>message</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td class="table-plus">{{ $message->id }}</td>
                                        <td class="table-plus">{{ $message->name }}</td>
                                        <td class="table-plus">{{ $message->email }}</td>
                                        <td class="table-plus">{{ $message->user_id }}</td>
                                        <td class="table-plus">{{ $message->subject }}</td>
                                        <td class="table-plus processText" data-fulltext="{{ $message->message }}">
                                            {{ $message->message }}
                                        </td>
                                        <td class="table-plus">{{ date('d/ m/ Y', strtotime($message->created_at)) }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                                                    <form action="{{ route('delete-message', ['id' => $message->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"><i
                                                                class="dw dw-delete-3"></i> Delete</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-box" id="processes-container"></div>

        </div>
    </div>

    <script>
        const processTextElements = document.querySelectorAll('.processText');
    
        processTextElements.forEach(element => {
            element.addEventListener('click', () => {
                element.classList.toggle('full');
            });
        });
    </script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/core.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/script.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/process.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/layout-settings.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="{{ asset('Dashboard-assets') }}/src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('Dashboard-assets') }}/vendors/scripts/datatable-setting.js"></script>
</body>

</html>
