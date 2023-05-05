<!-- SIDEBAR -->
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset($auth->details->profile_photo) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $auth->details->first_name . ' ' . $auth->details->last_name }}</p>
                <small>{{ ucfirst($auth->role) }}</small>
            </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>

            <!-- main dashboard -->
            <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.index')) echo 'active' ?>">
                <a href="{{ route('dashboard.index') }}">
                    <i class="far fa-chart-bar"></i>
                    <span>Main Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <!-- product list -->
                <li class="treeview <?php if(starts_with(Route::currentRouteName(), 'dashboard.products.lists')) echo 'active' ?>">
                    <a href="#">
                        <i class="fa fa-lightbulb"></i><span>Product List</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if(starts_with(Route::currentRouteName(), 'dashboard.products.lists') && $subcategory == 'All') echo 'class="active"' ?>>
                            <a href="{{ route('dashboard.products.lists', 'all') }}">
                                <i class="fa fa-circle-o"></i>All Products ({{ $stockAmount }})
                            </a>
                        </li>

                        @foreach($subcategories as $key => $_subcategory)
                            <li <?php if($subcategory == $_subcategory) echo 'class="active"' ?>>
                                <a href="{{ route('dashboard.products.lists', $_subcategory->name) }}">
                                    <i class="fa fa-circle-o"></i>{{ $_subcategory->name }} Products ({{ count($_subcategory->products) }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- member carts -->
                <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.carts')) echo 'active' ?>">
                    <a href="{{ route('dashboard.carts') }}">
                        <i class="fa fa-tags"></i>
                        <span>Member Carts</span>
                    </a>
                </li>
            @endif

            <!-- sales history -->
            <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.sales')) echo 'active' ?>">
                <a href="{{ route('dashboard.sales') }}">
                    <i class="fa fa-clock"></i>
                    <span>Sales History</span>
                </a>
            </li>

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <!-- inventories -->
                <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.stocks')) echo 'active' ?>">
                    <a href="{{ route('dashboard.stocks') }}">
                        <i class="fa fa-box"></i>
                        <span>Inventories</span>
                    </a>
                </li>
                <!-- invoice history -->
                <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.invoices')) echo 'active' ?>">
                    <a href="{{ route('dashboard.invoices') }}">
                        <i class="fa fa-file-invoice"></i>
                        <span>Invoice Lists</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role == 'admin')
                <!-- user management -->
                <li class="treeview <?php if(starts_with(Route::currentRouteName(), 'dashboard.users.')) echo 'active menu-open' ?>">
                    <a href="#">
                        <i class="fa fa-user"></i><span>User Managements</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.users.staffs')) echo 'active' ?>">
                            <a href="{{ route('dashboard.users.staffs') }}">
                                <i class="fa fa-circle-o"></i>Staff List
                            </a>
                        </li>
                        <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.users.members')) echo 'active' ?>">
                            <a href="{{ route('dashboard.users.members') }}">
                                <i class="fa fa-circle-o"></i>Member List
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <!-- Feedback -->
                <li class="<?php if(starts_with(Route::currentRouteName(), 'dashboard.feedbacks')) echo 'active' ?>">
                    <a href="{{ route('dashboard.feedbacks') }}">
                        <i class="fa fa-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- /SIDEBAR -->