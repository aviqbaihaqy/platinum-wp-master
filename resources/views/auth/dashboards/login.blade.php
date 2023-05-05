@extends('layouts.dashboards-app.app-register-login')

@section('content')

<!-- LOGIN BOX -->
<div class="login-box">
	<!-- Logo -->
    <div class="login-logo">
        <img src="{{ asset('dashboard-assets/dist/img/Logo.png') }}" width="100%">
    </div>
    
    <div class="login-box-body">
    <!-- Title -->
    <p class="login-box-title">SIGN IN</p>
		
		<!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
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

        	<!-- Email -->
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="fa fa-envelope form-control-feedback"></span>
            </div>
            <!-- Password -->
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
                	<!-- Button Sign In -->
                    <button type="submit" class="btn btn-a btn-block">Sign In</button>
                </div>
                <div class="col-xs-8">
                	<!-- Checkbox Remember Account -->
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
            </div>
        </form>
		
		<!-- Link Forgot Password -->
        <a href="#">Forgot password</a><br>

        <!-- Go to Register Page -->
        <a href="register" class="text-center">Register new account</a>
    </div>
</div>
<!-- /LOGIN BOX-->

@endsection