<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">

        <li class="treeview">

        <a href="#">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Overview</a></li>
            </ul>

        </li>

        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('superadmin'))
        <li class="treeview">
            <a href="#">
            <i class="fa fa-user"></i>
            <span>Manage Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="{{ url('/view-users') }}"><i class="fa fa-users"></i>View Users</a></li>

                <li>
                    <a href="{{ url('/view-users/create') }}"><i class="fa fa-plus">
                        </i> Add User</a>
                </li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('landlord') || Auth::user()->hasRole('administrator'))
        <li class="treeview">

            <a href="#">
            <i class="fa fa-home"></i>
            <span>Manage Property</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">

            @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('director') || Auth::user()->hasRole('administrator'))
            <li>
                <a href="{{ url('/view/properties') }}"><i class="fa fa-circle-o">
                    </i>All Properties</a>
            </li>
            @endif

            <li>
                <a href="{{ url('/view/properties/create') }}"><i class="fa fa-plus">
                    </i> Add Property</a>
            </li>
                </ul>

        </li>

        <li class="treeview">

            <a href="#">
            <i class="fa fa-users"></i>
            <span>Manage Tenant</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">

            @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('director') || Auth::user()->hasRole('administrator'))
            <li>
                <a href="{{ url('/view/tenants') }}"><i class="fa fa-users">
                    </i> All Tenants</a>
            </li>
            @endif

            <li>
                <a href="{{ url('/view/overdue') }}"><i class="fa fa-registered">
                    </i> All Overdue</a>
            </li>

            <li>
                <a href="{{ url('/view/expiresoon') }}"><i class="fa fa-registered">
                    </i> All ExpireSoon</a>
            </li>

            <li>
                <a href="{{ url('/view/tenants/create') }}"><i class="fa fa-plus">
                    </i> Add Tenant</a>
            </li>
                </ul>

        </li>

        @endif


        {{-- @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('director') )
        <li class="treeview">

        <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Log Activity Lists</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                    <a href="{{ url('/view/all/activities') }}"><i class="fa fa-circle-o">
                        </i> All Activity Logs</a>
            </li>
        </ul>
        </li>

        @endif --}}


        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('superadmin'))

        <li class="treeview">
            <a href="#">
            <i class="fa fa-universal-access"></i> <span>Manage Permissions</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">

            <li>
            <a href="{{ url('/settings/manage_users/permissions') }}"><i class="fa fa-circle-o"></i> View Permission</a>
            </li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('superadmin'))
        <li class="treeview">

            <a href="#">
            <i class="fa fa-check"></i> <span>Manage Roles</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">

            <li>
            <a href="{{ url('/settings/manage_users/roles') }}"><i class="fa fa-circle-o"></i> View Roles</a>
            </li>

            </ul>

        </li>
        @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
