
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('favicon.png')}}" alt="ZULARICH" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">ZULARICH PORTAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(session('user') && session('user')->avatar)
                    <img src="{{ url('user_profile/' . session('user')->avatar) }}"class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ url('user_profile/default.png') }}"class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="" class="d-block">{{session('user')->firstname}} {{session('user')->lastname}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item ">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('referrals')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            My Team
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('receipts.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            My Transactions
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('viewcommission')}}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            My Commissions
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('properties.list')}}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Properties
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profileshare',session('user')->username)}}" class="nav-link">
                        <i class="nav-icon fas fa-share-alt"></i>
                        <p>
                            Share Property
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profile')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            My Profile
                        </p>
                    </a>
                </li>






            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
