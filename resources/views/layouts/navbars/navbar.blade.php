<!-- HEADER NAVBAR -->
<form id="logoutForm" action="{{ route('logout') }}" method="POST">
    @csrf
</form>

<?php
    $cartItems = \Session::get('cartItems');
?>

<div class="header">
    <div class="header-grid">
        <div class="container px-md-3 px-xl-6">
            <!-- Header Top -->
            <div class="header-top">
                <!-- Header Left -->
                <div class="header-left">
                    <!-- Navbar Logo -->
                    <div class="navbar-brand logo-nav-left">
                        <a href="/"><img src="{{ asset('images/Logo.png') }}" class="logo"></a>
                    </div>
                </div>
                
                <!-- Header Right -->
                <div class="header-right">
                    <ul class="dropdown">
                        <!-- Form Search -->
                        <li>
                            <form id="searchNavbarForm" method="GET" class="search hidden-xs visible-sm visible-md visible-lg" action="{{ route('products.searchNavbar') }}">
                                @csrf

                                <input form="searchNavbarForm" type="text" placeholder="Search.." name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : null}}">

                                <button form="searchNavbarForm" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>

                        <!-- User Menu -->
                        <li>
                            <a href="#" class="dropdown-toggle visible-sm visible-md visible-lg" data-toggle="dropdown">
                            <div class="access">
                                <i class="fas fa-user"></i></a>
                                <ul class="dropdown-menu user wow fadeIn" data-wow-duration=".3s">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <ul class="multi-column-dropdown">
                                                @if(!Auth::check())
                                                    <li>
                                                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt text-black mr-1"></i>
                                                        Login</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('register') }}"><i class="fas fa-user-edit text-black"></i>
                                                        Register</a>
                                                    </li>
                                                @elseif(Auth::check())
                                                    <li>
                                                        <a href="{{ route('profile', Auth::user()->id) }}"><i class="fas fa-user text-black mr-2"></i>
                                                        Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('members.privacy', Auth::user()->id) }}">
                                                            <i class="fa fa-key text-black mr-1"></i>
                                                            Privacy
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('members.invoices', Auth::user()->id) }}">
                                                            <i class="fas fa-file-invoice text-black mr-2"></i>
                                                        Invoices
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('members.carts', Auth::user()->id) }}"><i class="fas fa-cart-plus text-black mr-1"></i>
                                                        My Cart</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="document.getElementById('logoutForm').submit();">
                                                            <i class="fas fa-sign-out-alt text-black mr-1"></i>
                                                            Logout
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </li>
                        
                        <!-- Cart Menu -->
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="access">
                                    <!-- Cart Total Badge -->
                                    <h3>
                                        <div class="total">
                                            <i class="fas fa-shopping-bag ml-1"></i>
                                            <span class="badge">
                                                {{ $cartItems ? count($cartItems) : 0 }}
                                            </span>
                                        </div>
                                    </h3>
                                </div>
                            </a>

                            <ul class="dropdown-menu cart wow fadeIn" data-wow-duration=".3s">
                                <div class="row">
                                    <div class="col-xs-12">
                                        @if(!$cartItems)
                                            <!-- Empty Cart -->
                                            <div class="text-center">
                                                <h5 class="title-b mb-3 text-black">
                                                    <i class="fas fa-cart-arrow-down mr-2"></i>Empty Cart
                                                </h5>

                                                 <a href="{{ route('products.index') }}" style="color:white; font-size: 14px;  padding: 8px 12px; margin: 1em 0 0;" class="btn-checkout">
                                                    <i class="fas fa-shopping-bag mr-2"></i>Go to Shopping
                                                </a>
                                            </div>
                                            <!-- Empty Cart -->
                                        @else
                                            <!-- Cart Header -->
                                            <div class="shopping-cart-header">
                                                <i class="fas fa-cart-arrow-down cart-icon text-black"></i>My Cart
                                                <div class="shopping-cart-total">
                                                    <span>Total:</span>
                                                    <span class="total-payment">
                                                        @if($cartItems)
                                                            {{ number_format(collect($cartItems)->sum('total')) }}
                                                        @else
                                                            0
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        
                                            <!-- Cart Content -->
                                            <ul class="shopping-cart-items">
                                                @foreach($cartItems as $key => $cartItem)
                                                    <?php
                                                        // bug fix for SESSION that has DELETED product
                                                        $cartProductDetails = $_products->where('id', $cartItem->product_id)->first();
                                                        if(!$cartProductDetails) {
                                                            $cartController = new \App\Http\Controllers\CartController();
                                                            $cartController->pluckItem($key);
                                                            header('Refresh:0');
                                                        }
                                                    ?>
                                                    <li class="clearfix">
                                                        <img src="{{ asset($cartProductDetails->photo->directory) }}">

                                                        <span class="item-name">
                                                            {{ $cartProductDetails->name }}
                                                        </span>
                                                        <span class="item-price">
                                                            {{ number_format($cartProductDetails->price) }}
                                                        </span>

                                                        <br>

                                                        <span class="item-quantity">
                                                            Quantity: {{ $cartItem->amount }}
                                                        </span>

                                                        <!-- button delete -->
                                                        <a href="{{ route('cart.pluckItem', $key) }}" class="remove-cart">
                                                            <i class="fas fa-trash" style="float: right"></i>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            
                                            <!-- Button Checkout -->
                                            @if(Auth::check())
                                                <a href="{{ route('members.carts', Auth::user()->id) }}" style="color:white; font-size: 14px;  padding: 8px 12px; margin: 1em 0 0;" class="btn-checkout">
                                                    <i class="fas fa-cart-arrow-down mr-2"></i>Checkout
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}" style="color:white; font-size: 14px;  padding: 8px 12px; margin: 1em 0 0;" class="btn-checkout">
                                                    <i class="fas fa-cart-arrow-down mr-2"></i>Checkout
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>  
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


<!-- Header Bottom -->
<div class="header-grid-b">
    <div class="container px-md-3 px-xl-6"> 
        <nav class="navbar navbar-default">
            <div class="logo-nav">
                <!-- Toggle Nav -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                
                <!-- Navbar Menu -->
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav">
                        <li <?php if(Route::is('index')) echo 'class="active"' ?>><a href="{{ route('index') }}" class="act">Home</a></li>

                        <!-- Mega Menu -->
                        <li class="dropdown <?php if(starts_with(Route::currentRouteName(), 'products.index')) echo 'active' ?>">
                            <a href="{{ route('products.index') }}" class="dropdown-toggle" data-toggle="dropdown">Products</a>
                            <ul class="dropdown-menu multi animated wow fadeIn" data-wow-duration=".3s">
                                <div class="row">
                                    @foreach($categories as $key => $category)
                                    <div class="col-sm-6">
                                        <ul class="multi-column-dropdown">
                                            <h4>{{ $category->name }}</h4>
                                            @foreach($category->subcategories as $key => $__subcategory)
                                                <li>
                                                    <a href="/products/?subcategory={{ $__subcategory->name }}">
                                                        {{ $__subcategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach

                                    <div class="col-xs-12">
                                        <ul class="multi-column-dropdown-all">
                                            <a href="{{ route('products.index') }}"><h4>All Products</h4></a>
                                        </ul>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="{{ route('products.index') }}" style="padding: 0;margin: 0;">
                                                    <img src="{{ asset('images/dummy-3.jpg') }}" width="100%">
                                                </a>
                                            </div>
                                            <div class="col-sm-6 mt-sm-3">
                                                <a href="{{ route('products.index') }}" style="padding: 0;margin: 0;">
                                                    <img src="{{ asset('images/dummy-2.jpg') }}" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </ul>
                        </li>

                        <li <?php if(Route::is('about')) echo 'class="active"' ?>><a href="{{ route('about') }}">About</a></li>
                        <li <?php if(Route::is('contact')) echo 'class="active"' ?>><a href="{{ route('contact') }}">Contact</a></li>
                        
                        <!-- User Menu on Small Screen -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle visible-xs hidden-sm hidden-md hidden-lg" data-toggle="dropdown"><i class="fas fa-user"></i>
                            <b class="caret"></b></a>
                            <ul class="dropdown-menu user wow fadeIn" data-wow-duration=".3s">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul class="multi-column-dropdown">
                                            @if(!Auth::check())
                                            <li>
                                                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt text-black mr-1"></i>
                                                Login</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('register') }}"><i class="fas fa-user-edit text-black"></i>
                                                Register</a>
                                            </li>
                                            @endif

                                            @if(Auth::check())
                                            <li>
                                                <a href="{{ route('profile', Auth::user()->id) }}">
                                                    <i class="fas fa-user text-black mr-2"></i>
                                                Profile</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('members.privacy', Auth::user()->id) }}">
                                                    <i class="fa fa-key text-black mr-1"></i>
                                                    Privacy
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('members.invoices', Auth::user()->id) }}">
                                                    <i class="fas fa-file-invoice text-black mr-2"></i>
                                                Invoices
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('members.carts', Auth::user()->id) }}">
                                                    <i class="fas fa-cart-plus text-black mr-1"></i>
                                                My Cart</a>
                                            </li>
                                            <li>
                                                <a href="#" onclick="document.getElementById('logoutForm').submit();">
                                                    <i class="fas fa-sign-out-alt text-black mr-1"></i>
                                                    Logout
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        
                        <!-- Form Search in Small Screen -->
                        <li>
                            <form class="search visible-xs hidden-sm hidden-md hidden-lg py-2" action="">
                                <input type="text" placeholder="Search.." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>          
    </div>
</div>
<!-- /HEADER NAVBAR -->