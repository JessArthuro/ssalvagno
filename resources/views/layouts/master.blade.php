<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico">
    <!-- Libs CSS -->
    <link href="./assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="./assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="./assets/libs/prismjs/themes/prism-okaidia.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.min.css">
    <link href="./assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <title>Homepage | Dash Ui - Bootstrap 5 Admin Dashboard Template</title>
</head>

<body class="bg-light">
    <div id="db-wrapper">
        <!-- Vertical navigation -->
        @include('layouts.partials.vertical-nav')

        <!-- Page content -->
        <div id="page-content">
            <!-- Header navigation -->
            @include('layouts.partials.header-nav')

            <div class="container-fluid px-6 py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="./assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="./assets/libs/prismjs/prism.js"></script>
    <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="./assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="./assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="./assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
    <!-- Theme JS -->
    <script src="./assets/js/theme.min.js"></script>
    <!-- dataTables -->
    <script src="./assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="./assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="./assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./assets/js/vendors/datatable.js"></script>
</body>

</html>
