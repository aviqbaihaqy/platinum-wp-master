@extends('layouts.dashboards-app.app-register-login')

@section('content')

<!-- REGISTER BOX -->
<div class="register-box">
    <!-- Logo -->
    <div class="login-logo">
        <img src="{{ asset('dashboard-assets/dist/img/Logo.png') }}" width="100%">
    </div>

    <div class="register-box-body">
    <!-- Title-->
    <p class="login-box-title">REGISTER ACCOUNT</p>
        
        <!-- Register Form -->
        <form action="../../index.html" method="post">
            <!-- Full Name -->
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full name">
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <!-- Email -->
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email">
                <span class="fa fa-envelope form-control-feedback"></span>
            </div>
            <!-- Password -->
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>
            <!-- Repeated Password -->
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password">
                <span class="fa fa-sign-in-alt form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
                    <!-- Button Register -->
                    <button type="submit" class="btn btn-a btn-block">Register</button>
                </div>
                <div class="col-xs-8">
                    <!-- Checkbox Agreement -->
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the terms
                        </label>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Go to Login Page -->
        <a href="login-dashboard.html" class="text-center">Already have an account</a>
    </div>
</div>
<!-- /REGISTER BOX -->

@endsection