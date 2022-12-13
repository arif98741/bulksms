<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - Bulksms</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    @include('backend.include.header-css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Navbar -->
@include('backend.include.navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('backend.include.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    @include('backend.include.footer')

</div>


<!-- jQuery -->
@include('backend.include.footer-js')
</body>
</html>
