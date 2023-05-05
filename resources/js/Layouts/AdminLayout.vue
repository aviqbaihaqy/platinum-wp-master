<template>
    <header class="main-header">

        <!-- Logo -->
        <a class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
                <!-- <img src=" asset('dashboard-assets/dist/img/Logo-platinum.png') " class="logo"> -->
            </span>

            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <!-- <img src=" asset('dashboard-assets/dist/img/Logo.png') " class="logo"> -->
            </span>
        </a>

        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fas fa-stream"></i>
            </a>
            <!-- Navbar Right Menu -->
            <div id="notification_link" class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown notifications-menu">
                        <a id="viewNotification" onclick="readNotifications()" href="#" class="dropdown-toggle"
                            data-toggle="dropdown">
                            <i class="far fa-bell"></i>
                            <span class="label label-danger">count($notifications)</span>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header">You have count($notifications) notifications</li>
                            <li>
                                <ul class="menu">
                                    @foreach($notifications as $notification)
                                    <li>
                                        @if($notification->type == 'user')
                                        <i class="fa fa-users"></i>
                                        @elseif($notification->type == 'product')
                                        <i class="fa fa-shopping-cart"></i>
                                        @elseif($notification->type == 'profile')
                                        <i class="fa fa-user"></i>
                                        @elseif($notification->type == 'payment')
                                        <i class="fa fa-money"></i>
                                        @else
                                        <i class="fa fa-exclamation-circle"></i>
                                        @endif

                                        {!! $notification->message !!}
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src=" asset($auth->details->profile_photo) " class="user-image" alt="User Image">
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src=" asset($auth->details->profile_photo) " class="img-circle" alt="User Image">
                                <p>
                                    $auth -> details -> first_name. ' '.$auth -> details -> last_name
                                    <small> ucfirst($auth -> role) </small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href=" route('dashboard.users.profile', $auth->id) " class="btn btn-a">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" onclick="document.getElementById('logoutForm').submit()"
                                        class="btn btn-a">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- <slot></slot> -->


    <!-- <div class="content-wrapper">
        <section class="content-header pt-3">
            <h1 class="text-black">Main Dashboard </h1>
        </section>

        <section class="content">
            <slot></slot>
        </section>
    </div> -->
</template>

<script>
export default {

}
</script>
