<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.lib.meta')

</head>
<body>

<!--  BEGIN NAVBAR  -->
@include('backend.lib.navbar')
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
@include('backend.lib.page-intro')
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    @include('backend.include.sidebar')
    <!--  END SIDEBAR  -->
    <!--  BEGIN CONTENT AREA  -->
    @yield('content')
    <!--  END CONTENT AREA  -->

</div>


@include('backend.lib.footer-script')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>
