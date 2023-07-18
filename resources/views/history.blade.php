<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>History</title>

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
    <div class="mobile-menu-overlay"></div>

    <div class="">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>History</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">History</li>
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
                                    <a class="dropdown-item" href="{{ route('home') }}"><i
                                            class="dw dw-home"></i>Home</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i
                                            class="dw dw-user-1"></i>Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i
                                            class="dw dw-logout"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- multiple select row Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Processes History</h4>
                    </div>
                    <div class="pb-20">
                        @if (session('status') == 'process-deleted')
                            <div class="alert alert-success" role="alert"
                                style="height: 50px; border-radius: 0; margin-bottom: 8px;">
                                <p style="text-align:center">Process deleted successfully
                                </p>
                            </div>
                        @endif
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Process Text</th>
                                    <th>Result</th>
                                    <th>Start Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->processes as $process)
                                    <tr>
                                        <td class="table-plus">{{ $process->id }}</td>
                                        <td class="processText" data-fulltext="{{ $process->processText }}">
                                            {{ $process->processText }}</td>
                                        <td>
                                            @if ($process->result === 1)
                                                <span class="badge badge-success">REAL</span>
                                            @else
                                                <span class="badge badge-danger">FAKE</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d/ m/ Y', strtotime($process->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                                                    <form
                                                        action="{{ route('user-delete-process', ['id' => $process->id]) }}"
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
                <!-- multiple select row Datatable End -->
            </div>
        </div>
    </div>
    <!-- js -->

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
