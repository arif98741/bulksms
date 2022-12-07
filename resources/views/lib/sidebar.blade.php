<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories ps ps--active-y" id="accordionExample">
            <li class="menu">
                <a href="{{ route('backend.admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle"
                   @if(route_exist_in_sidebar(['backend.admin.dashboard'])) data-active="true" @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                @php
                    $catalogueRoutes = [
                        'admin.category.index',
                        'admin.category.create',
                        'admin.category.edit',
                    ];
                @endphp
                <a href="#catalougeMenu" data-toggle="collapse"
                   aria-expanded="@if(route_exist_in_sidebar($catalogueRoutes)) true @else false @endif"
                   @if(route_exist_in_sidebar($catalogueRoutes)) data-active="true" @endif
                   class="dropdown-toggle @if(!route_exist_in_sidebar($catalogueRoutes))collapsed @endif">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <span>Catalogue</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(route_exist_in_sidebar($catalogueRoutes)) show @endif"
                    id="catalougeMenu" data-parent="#accordionExample">


                    <li><a href="#">Category</a></li>

                </ul>
            </li>

            <li class="menu">
                @php
                    $catalogueRoutes = [
                        'backend.service.index',
                        'backend.service.create',
                        'backend.service.edit',
                    ];
                @endphp
                <a href="#frontServiceMenu" data-toggle="collapse"
                   aria-expanded="@if(route_exist_in_sidebar($catalogueRoutes) && request()->get('service_type') =='long') true @else false @endif"
                   @if(route_exist_in_sidebar($catalogueRoutes)) data-active="true" @endif
                   class="dropdown-toggle @if(!route_exist_in_sidebar($catalogueRoutes))collapsed @endif">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <span>Long Service</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(route_exist_in_sidebar($catalogueRoutes) && request()->get('service_type') =='long') show @endif"
                    id="frontServiceMenu" data-parent="#accordionExample">


                    <li><a href="{{ route('backend.service.create',['service_type'=>'long']) }}">Add Long Service</a>
                    </li>
                    <li><a href="{{ route('backend.service.index',['service_type'=>'long']) }}">Long Service List</a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                @php

                    $catalogueRoutes = [
                        'backend.service.index',
                        'backend.service.create',
                        'backend.service.edit',
                    ];
                @endphp
                <a href="#onDemandServiceMenu" data-toggle="collapse"
                   aria-expanded="@if(route_exist_in_sidebar($catalogueRoutes) && request()->get('service_type') =='short') true @else false @endif"
                   @if(route_exist_in_sidebar($catalogueRoutes)) data-active="true" @endif
                   class="dropdown-toggle @if(!route_exist_in_sidebar($catalogueRoutes))collapsed @endif">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <span>On Demand Service</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(route_exist_in_sidebar($catalogueRoutes) && request()->get('service_type') =='short') show @endif"
                    id="onDemandServiceMenu" data-parent="#accordionExample">


                    <li><a href="{{ route('backend.service.create',['service_type'=>'short']) }}">Add On Demand
                            Service</a>
                    </li>
                    <li><a href="{{ route('backend.service.index',['service_type'=>'short']) }}">On Demand Service
                            List</a>
                    </li>

                </ul>
            </li>

            <li class="menu">
                @php
                    $catalogueRoutes = [
                        'backend.long-term-service.service-request.create',
                        'backend.long-term-service.service-request.index',
                        'backend.long-term-service.service-request.edit',

                    ];
                @endphp
                <a href="#longTermServiceProcess" data-toggle="collapse"
                   aria-expanded="@if(route_exist_in_sidebar($catalogueRoutes)) true @else false @endif"
                   @if(route_exist_in_sidebar($catalogueRoutes)) data-active="true" @endif
                   class="dropdown-toggle @if(!route_exist_in_sidebar($catalogueRoutes))collapsed @endif">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <span>Long Service Process</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(route_exist_in_sidebar($catalogueRoutes)) show @endif"
                    id="longTermServiceProcess" data-parent="#accordionExample">


                    <li>
                        <a href="{{ route('backend.long-term-service.service-request.index',['service_type'=>'long']) }}">Service
                            Request</a>
                    </li>

                </ul>
            </li>

            <li class="menu">
                @php
                    $customerRoutes = [
                        'backend.customer.create',
                        'backend.customer.edit',
                        'backend.customer.store',
                        'backend.customer.index',

                    ];
                @endphp
                <a href="#customerMenu" data-toggle="collapse"
                   aria-expanded="@if(route_exist_in_sidebar($customerRoutes)) true @else false @endif"
                   @if(route_exist_in_sidebar($customerRoutes)) data-active="true" @endif
                   class="dropdown-toggle @if(!route_exist_in_sidebar($customerRoutes))collapsed @endif">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Customers</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(route_exist_in_sidebar($customerRoutes)) show @endif"
                    id="customerMenu" data-parent="#accordionExample">


                    <li>
                        <a href="{{ route('backend.customer.index') }}">Customers</a>
                    </li>

                </ul>
            </li>


            @can(['add role','edit role'])
                <li class="menu">

                    @php
                        $permissionRoutes = [
                            'admin.role.create',
                            'admin.role.index',
                            'admin.role.show',
                             'admin.permission.create',
                            'admin.permission.index',
                            'admin.permission.show',
                        ];
                    @endphp

                    <a href="#permissionMenu" data-toggle="collapse"
                       aria-expanded="@if(route_exist_in_sidebar($permissionRoutes)) true @else false @endif"
                       @if(route_exist_in_sidebar($permissionRoutes)) data-active="true" @endif
                       class="dropdown-toggle @if(!route_exist_in_sidebar($permissionRoutes))collapsed @endif">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-shield">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            <span>Role and Permission</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled @if(route_exist_in_sidebar($permissionRoutes)) show @endif"
                        id="permissionMenu" data-parent="#accordionExample">
                        <li><a href="{{ route('admin.role.index') }}">Role List</a></li>
                        <li><a href="{{ route('admin.role.create') }}"> Add Role</a></li>
                        <li><a href="{{ route('admin.permission.index') }}"> Permission List</a></li>
                        <li><a href="{{ route('admin.permission.create') }}"> Add Permission</a></li>
                    </ul>
                </li>
            @endcan


            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; height: 518px; right: -4px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 239px;"></div>
            </div>
        </ul>

    </nav>

</div>
