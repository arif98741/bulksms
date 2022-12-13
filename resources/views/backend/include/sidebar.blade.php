<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('backend.dashboard') }}" class="brand-link">
        <img src="#" alt=""
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('SMS Panel') <sup><i class="icon ion-usb"></i>&nbsp;v0.0.1-beta</sup></span>

    </a>
{{--ionicons cheatsheet  https://ionic.io/ionicons/v2/cheatsheet.html--}}
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                @php

                    $dashboardRoutes = [
                      'admin.dashboard',
                    ];

                @endphp

                <li class="nav-item @if(route_exist_in_sidebar($dashboardRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="{{ route('backend.dashboard') }}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('Dashboard')

                        </p>
                    </a>
                </li>
                @php

                    $postRoutes = [
                      'admin.media.create',
                      'admin.media.edit',
                      'admin.media.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($postRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="icon ion-paper-airplane"></i>
                        <p>
                            @lang('Send Message')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($postRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon ion-android-send"></i>&nbsp;
                                <p>@lang('Single  Message')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users"></i>&nbsp;
                                <p>@lang('Group Message')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon ion-android-plane"></i>&nbsp;
                                <p>@lang('Campaign Message')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon ion-android-upload"></i>&nbsp;
                                <p>@lang('CSV/Excel Message')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon ion-android-time"></i>&nbsp;
                                <p>@lang('Routine/Schedule Message')</p>

                            </a>
                        </li>
                    </ul>
                </li>
                @php

                    $postRoutes = [
                      'admin.media.create',
                      'admin.media.edit',
                      'admin.media.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($postRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            @lang('Contact Groups')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($postRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>@lang('Add')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('List')</p>

                            </a>
                        </li>
                    </ul>
                </li>
                @php

                    $postRoutes = [
                      'admin.post.create',
                      'admin.post.edit',
                      'admin.post.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($postRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            @lang('Contacts')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($postRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>@lang('Add')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('List')</p>

                            </a>
                        </li>
                    </ul>
                </li>

                @php

                    $categoryRoutes = [
                      'admin.category.create',
                      'admin.category.edit',
                      'admin.category.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($categoryRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            @lang('Categories')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($categoryRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Add Categories')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Category List')</p>

                            </a>
                        </li>
                    </ul>
                </li>
                @php

                    $tagRoutes = [
                      'admin.tag.create',
                      'admin.tag.edit',
                      'admin.tag.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($tagRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="icon ion-android-chat"></i>&nbsp;
                        <p>
                            @lang('Sms Template')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($tagRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Add Tag')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Tag List')</p>

                            </a>
                        </li>
                    </ul>
                </li>
                @php

                    $reportRoutes = [
                      'admin.tag.create',
                      'admin.tag.edit',
                      'admin.tag.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($reportRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="icon ion-arrow-graph-down-left"></i>&nbsp;
                        <p>
                            @lang('Reports')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($reportRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Add Tag')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Tag List')</p>

                            </a>
                        </li>
                    </ul>
                </li>

                @php

                    $userRoutes = [
                      'admin.tag.create',
                      'admin.tag.edit',
                      'admin.tag.index',
                    ];

                @endphp
                <li class="nav-item @if(route_exist_in_sidebar($userRoutes)) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="ion-android-people"></i>&nbsp;
                        <p>
                            @lang('Users')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        @if(route_exist_in_sidebar($userRoutes)) style="display: block" @else @endif>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('Add User')</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus nav-icon"></i>
                                <p>@lang('User List')</p>

                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item @if(route_exist_in_sidebar([])) menu-is-opening menu-open @else @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('Setting')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(route_exist_in_sidebar([])) style="display: block" @else @endif>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon ion-planet"></i>&nbsp;
                                <p>@lang('Gateways')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cog"></i>&nbsp;
                                <p>@lang('General Setting')</p>

                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/loggout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            @lang('Logout')
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
