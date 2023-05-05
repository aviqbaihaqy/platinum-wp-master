@extends('layouts.app')

@section('content')

 <!-- BANNER TITLE -->
<div class="banner-top">
    <div class="container px-md-3 px-xl-6">
        <h2 class="title-a text-white">REGISTER</h2>
        <hr class="hr-b mt-0">
        <h4 class="title-a text-white mt-3 max-width-a" style="line-height:1.5em;">Phasellus quis volutpat enim, non semper ex. Nulla et malesuada arcu. Aenean laoreet lorem vel placerat tristique.</h4>
    </div>
</div>
<!-- /BANNER TITLE -->


<!-- REGISTER/LOGIN -->
<div class="login">
    <div class="container px-md-3 px-xl-6">
        <form method="POST" action="/register">
            @csrf

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

            <div class="row">
                <div class="col-md-7 col-border-gray animated wow fadeInLeft" data-wow-delay=".5s">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="login-mail">
                                <input value="" name="first_name" type="name" id="" placeholder="First Name" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="login-mail">
                                <input value="" name="last_name" type="name" id="" placeholder="Last Name" required>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fas fa-envelope mr-2 text-gray"></i>
                                <input type="email" name="email" placeholder="Email" required="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="login-mail">
                                <i class="fas fa-lock mr-2 text-gray"></i>
                                <input type="password" name="password" placeholder="Password" required="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="login-mail">
                                <i class="fas fa-lock mr-2 text-gray"></i>
                                <input type="password" name="password_confirmation" placeholder="Repeated password" required="">
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fas fa-map-marker-alt mr-2 text-gray"></i>
                                <input type="address" name="address" placeholder="Address" required="">
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fa fa-building mr-2 text-gray"></i>
                                <input type="city" name="city" placeholder="City" required="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 mb-3">
                            <label class="text-black mt-0">Country Code</label>
                            <select name="country_code" type="text">
                                @foreach($countries as $key => $country)
                                    <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fa fa-mail-bulk mr-2 text-gray"></i>
                                <input type="postcode" name="postal_code" placeholder="Postal Code" required="">
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="login-mail">
                                <i class="fas fa-phone mr-2 text-gray"></i>
                                <input name="phone" type="phone" placeholder="Phone Number" required="">
                            </div>
                        </div>
                    </div>
                    <a class="news-letter" href="#">
                        <label class="checkbox1"><input type="checkbox" name="checkbox" ><i></i>I agree with the terms</label>
                    </a>
                    <!-- Button Register -->
                    <button class="register-btn mt-3" type="submit" value="Submit">Sign Up</button>
                </div>


                <div class="col-md-5 pt-3 animated wow fadeIn mt-lg-4" data-wow-delay=".5s">
                    <h4 class="title-a text-black mb-3 mt-0">Already register? Click the button below</h4>
                    <!-- Button Login -->
                    <a href="{{ route('login') }}" class="login-btn">Login</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /REGISTER/LOGIN -->

@endsection
