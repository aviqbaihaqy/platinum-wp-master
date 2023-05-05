@extends('layouts.app')

@section('content')

<!-- SECTION PROFILE -->
<div class="section-profile">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-xs-12">
				<!-- Form Group -->
	            <div class="form-group">
	            	<h3 class="title-b text-black text-center mb-3">
	            		<i class="fa fa-key mr-2"></i>Change Password
	            	</h3>
	                <div class="row">
	                    <form action="{{ route('members.updatePassword', $user->id) }}" method="POST">
	                    	@csrf
	                    	@method('PATCH')

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
	                                {!! session()->get('success') !!}  
	                            </div><br/>
	                        @elseif(session()->get('error'))
	                            <div class="alert alert-danger">
	                                {!! session()->get('error') !!}
	                            </div><br/>
	                        @endif
							
							<div class="col-xs-12 col-md-6 col-md-offset-3">
								<div class="row">
			                        <div class="col-xs-12">
			                            <!-- Old Password -->
			                            <label class="text-black">Old Password</label>
			                            <input name="oldPassword" type="password" class="form-control" placeholder="Old Password" required>
			                        </div>

			                        <div class="col-xs-12">
			                            <!-- New Password -->
			                            <label class="text-black">New Password</label>
			                            <input name="newPassword" type="password" class="form-control" placeholder="New Password" required>
			                        </div>

			                        <div class="col-xs-12">
			                            <!-- Confirm New Password -->
			                            <label class="text-black">Confirm New Password</label>
			                            <input name="confirmNewPassword" type="password" class="form-control" placeholder="Confirm New Password" required>
			                        </div>
									
									<div class="col-xs-12 col-sm-6 mt-3">
				                        <!-- Button Save -->
			                			<button type="submit" class="btn btn-d">Save</button>
			                		</div>
			                	</div>
			                </div>
	                    </form>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>
<!-- /SECTION PROFILE -->

@endsection