@extends('layouts.app')

@section('content')

 <!-- BANNER TITLE-->
<div class="banner-top">
    <div class="container px-md-3 px-xl-6">
        <h2 class="title-a text-white">LOGIN</h2>
        <hr class="hr-b mt-0">
        <h4 class="title-a text-white mt-3 max-width-a" style="line-height:1.5em;">Phasellus quis volutpat enim, non semper ex. Nulla et malesuada arcu. Aenean laoreet lorem vel placerat tristique.</h4>
    </div>
</div>
<!-- /BANNER TITLE-->


<!-- REGISTER/LOGIN -->
<div class="login">
    <div class="container px-md-3 px-xl-6">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-7 col-border-gray animated wow fadeInLeft" data-wow-delay=".5s">
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger first">
                                @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                                @endforeach
                            </div>

                            <br />
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}  
                            </div><br/>
                        @elseif(session()->get('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div><br/>
                        @endif

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fas fa-envelope mr-2 text-gray"></i>
                                <input name="email" type="email" placeholder="Email" required="">
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fas fa-lock mr-2 text-gray"></i>
                                <input name="password" type="password" placeholder="Password" required="">
                            </div>
                        </div>
                    </div>
                    <!-- Link Forgot Password -->
                    <a class="news-letter" href="#">
                        Forgot Password?
                    </a>
                    <!-- Button Login -->
                    <button class="login-btn mt-2" type="submit" value="Submit">Sign In</button>
                </div>


                <div class="col-md-5 animated wow fadeIn mt-lg-4 pt-3" data-wow-delay=".5s">
                    <h4 class="title-a text-black mb-3 mt-0">Don't have an account? Click the button below</h4>
                    <!-- Button Register -->
                    <a href="{{ route('register') }}" class="register-btn">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /REGISTER/LOGIN -->

@endsection
