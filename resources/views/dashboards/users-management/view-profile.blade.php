@extends('layouts.dashboards-app.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header pt-3">
    	{{-- Title --}}
        <h1 class="text-black">
            User Profile
        </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <!-- Profile Image -->
                <div class="box">
                    <div class="box-body box-profile py-4">
                        <div class="row">
                            <div class="col-md-4 text-center">
                            	{{-- Profile Picture --}}
                                <img class="profile-user-img img-responsive img-circle mb-2" src="{{ asset($userDetail->profile_photo) }}">

                                <!-- Button Edit Photo-->
                                <a class="btn-action" data-target="#modal-edit-photo" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                    <i class="fa fa-edit mr-2"></i>Edit Photo
                                </a>
                                <!-- End Button Edit Photo -->
								
								{{-- Name --}}
                                <h3 class="profile-username text-center mt-2">{{ $userDetail->first_name }} {{ $userDetail->last_name }}</h3>
                                {{-- Position --}}
                                <p class="text-muted text-center">{{ ucfirst($user->role) }}</p>
                                
                                <!-- Button Edit Profile -->
                                <button type="button" class="btn btn-a" data-target="#modal-edit-profile" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit Profile">
                                    Edit Profile
                                </button>

                                <!-- Button Change Password -->
                                <button type="button" class="btn btn-a mt-2" data-target="#modal-change-password" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit Profile">
                                    <i class="fa fa-key mr-2"></i>Change Password
                                </button>
                            </div>

                            <div class="col-md-8">
                            	{{-- Profile Details --}}

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
                                
                                <div class="details">
                                    <div class="details-info"><p>NIP</p>
                                        <span>
                                            {{ $userDetail->nip }}
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="details-info">
                                        <p>Full Name</p>
                                        <span>{{ $userDetail->first_name }} {{ $userDetail->last_name }}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="details-info">
                                        <p>Position</p>
                                        <span>{{ ucfirst($user->role) }}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="details-info">
                                        <p>E-Mail Address</p>
                                        <span>{{ $user->email }}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="details-info">
                                        <p>Phone Number</p>
                                        <span>{{ $userDetail->phone }}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="details-info">
                                        <p>Status</p>
                                        <span>{{ ucfirst($user->status) }}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.dashboards-app.modals.modal-edit-profile')
@include('layouts.dashboards-app.modals.modal-change-password')

@endsection