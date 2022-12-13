<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('backend.dashboard') }}" class="nav-link"><i class="fa fa-home"></i>&nbsp;@lang('Home')
            </a>
        </li>
        <li class="nav-item d-sm-inline-block">
            <a href="#" class="nav-link"><i class="icon ion-paper-airplane"></i>&nbsp;@lang('Send Message')</a>
        </li>
        <li class="nav-item d-sm-inline-block">
            <a href="#" class="nav-link"><i class="fas fa-users"></i>&nbsp;@lang('Send Group Message')</a>
        </li>
        <li class="nav-item d-sm-inline-block">
            <a href="#" class="nav-link"><i class="icon ion-plane"></i>&nbsp;@lang('Add Campaign')</a>
        </li>
        {{--        <li class="nav-item d-none d-sm-inline-block">--}}
        {{--            <a href="#" class="nav-link">Contact</a>--}}
        {{--        </li>--}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/loggout') }}" role="button">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
