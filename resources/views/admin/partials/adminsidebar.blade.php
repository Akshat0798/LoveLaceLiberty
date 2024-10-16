        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!--<i class="fas fa-laugh-wink"></i>-->

                </div>
                <img src="{{ asset('public/assetss/images/logo.svg') }}" width="100px" />
                {{-- <div class="sidebar-brand-text mx-3">Be Here</div> --}}
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li
                class="nav-item {{ Request::is('admin/dashboard') || Request::is('admin/dashboard/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

          


            <li class="nav-item {{ Request::is('admin/user') || Request::is('admin/user/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ routeUser('user.index') }}">
                    {{-- <i class="fas fa-users"></i> --}}
                <img src="{{asset('admin_assets/admin_icons/Client.png')}}" alt="" width="18px">
                    <span>{{ __('Client') }}</span></a>
            </li>
            
            <li
                class="nav-item {{ Request::is('admin/category') || Request::is('admin/category/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ routeUser('category.index') }}">
                    {{-- <i class="fas fa-users"></i> --}}
                <img src="{{asset('admin_assets/admin_icons/category.png')}}" alt="" width="18px">
                    <span>{{ __('admin_lang.category') }}</span></a>
            </li>

             <li class="nav-item {{ Request::is('admin/subCategory') || Request::is('admin/subCategory/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ routeUser('subCategory.index') }}">
                <i class="fas fa-users"></i>
                <span>{{ __('admin_lang.sub')}}</span></a>
            </li>

            <li class="nav-item {{ Request::is('admin/candidate') || Request::is('admin/candidate/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ routeUser('candidate.index') }}">
                <i class="fas fa-users"></i>
                <span>Candidate</span></a>
            </li>

           
            {{-- <li class="nav-item {{Request::is('admin/transaction') || Request::is('admin/transaction/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ routeUser('transaction.index') }}">
                <img src="{{asset('admin_assets/admin_icons/transaction.png')}}" alt="" width="18px">
                <span>{{ __('admin_lang.transaction')}}</span></a>
            </li> --}}

          



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
