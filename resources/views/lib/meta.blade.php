<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>@yield('title') - Admin</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon-takecare.png') }}" />
<link href="{{ asset('backend/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('backend/assets/js/loader.js') }}"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{ asset('backend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('backend/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('backend/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" />
<link href="{{ asset('backend/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/custom-backend.css') }}" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@stack('css')
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
