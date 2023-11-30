
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}}" class="brand-link">
        <img src="{{asset('favicon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">ZULARICH ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <img src="{{url('user_profile/default.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{session('admin')->firstname}} {{session('admin')->lastname}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('admin')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Realtors
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('receipts.admin')}}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                             Transactions
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('commissions.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                             Commissions
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('properties.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Properties
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('settings')}}" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                         Settings

                        </p>
                    </a>

                </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
