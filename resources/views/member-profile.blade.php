@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function populate() {
        $('#edit_member_email').val('{{ $user->email }}')

        $('#edit_member_form').attr('action', '{{ route('profile.update', $user->id) }}')

        $('#edit_member_first_name').val('{{ $profile->first_name }}')
        $('#edit_member_last_name').val('{{ $profile->last_name }}')
        $('#edit_member_address').val('{{ $profile->address }}')
        $('#edit_member_phone').val('{{ $profile->phone }}')
        $('#edit_member_company').val('{{ $profile->company }}')

        console.log('populated')
    }

    function populateToEdit(addressId, first_name, last_name, address, city, postal_code, country_code, phone) {
        var updateUrl = '/member/shipping_address/' + addressId
        $('#editShippingDataForm').attr('action', updateUrl)

        console.log(updateUrl)

        $('#edit_sa_first_name').val(first_name)
        $('#edit_sa_last_name').val(last_name)
        $('#edit_sa_address').val(address)
        $('#edit_sa_city').val(city)
        $('#edit_sa_postal_code').val(postal_code)
        $('#edit_sa_country_code').val(country_code)
        $('#edit_sa_phone').val(phone)
    }

    function editPhoto(user_id) {
        var uploadUrl = '/member/profile/' + user_id + '/profile_photo/update'
        $('#updateProfilePhoto').attr('action', uploadUrl)

        console.log(uploadUrl)
    }

    function confirmDeleteAddress(address_id) {
        var deleteUrl = '/member/shipping_address/' + address_id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}');
    }
</script>

<!-- BANNER TITLE -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">PROFILE</h2>
		<hr class="hr-b mt-0">
		<h4 class="title-a text-white mt-3 max-width-a" style="line-height:1.5em;">Phasellus quis volutpat enim, non semper ex. Nulla et malesuada arcu. Aenean laoreet lorem vel placerat tristique.</h4>
	</div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION PROFILE -->
<div class="section-profile">
	<div class="container px-md-3 px-xl-6">
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

			<div class="col-xs-10 col-xs-offset-1 col-md-3 col-md-offset-0 text-center">
                <!-- Profile Image -->
                <img class="profile-user-img img-responsive img-circle mb-2" src="{{ asset($profile->profile_photo) }}">

                <!-- Button Edit Photo-->
                <a onclick="editPhoto('{{ $user->id }}')" class="link-b" data-target="#modal-edit-photo" data-toggle="modal" aria-hidden="true" style="cursor: pointer">
                    <i class="fa fa-edit mr-2"></i>Edit Photo
                </a>
				
                <!-- Position -->
                <p class="text-black mt-3">Member since {{ Carbon\Carbon::parse($user->created_at)->format('M Y') }}</p>

                <!-- Button Edit Profile -->
                <button onclick="populate();" type="button" class="btn btn-d mr-2" data-target="#modal-edit-profile" data-toggle="modal" aria-hidden="true">
                	<i class="fas fa-edit mr-1"></i>
                    Edit Profile
                </button>
				
				<!-- Button Cart -->
                <a href="{{ route('members.carts', Auth::user()->id) }}">
                    <button type="button" class="btn btn-d mr-2">
                        <i class="fas fa-cart-plus mr-1"></i>
                        My Cart
                    </button>
                </a>
        	</div>
			
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-9 col-md-offset-0 mt-sm-3">
				<!-- Profile Details -->
				<div class="details">
                    <div class="details-info">
                        <p>Full Name</p>
                        <span>{{ $profile->first_name }} {{ $profile->last_name }}</span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="details-info">
                        <p>E-Mail Address</p>
                        <span>{{ $user->email }}</span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="details-info">
                        <p>Address</p>
                        <span>{{ $profile->address }}</span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="details-info">
                        <p>Phone Number</p>
                        <span>{{ $profile->phone }}</span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="details-info">
                        <p>Company</p>
                        <span>{{ $profile->company }}</span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>       
		</div>

        <div class="row">
            <div class="col-xs-12 mt-4">
                <h4 class="text-black">
                    <i class="fa fa-shipping-fast mr-2"></i>Shipping Data
                </h4>

                <!-- Form Group -->
                <div class="row">
                    <div class="col-xs-12 mt-3">
                        <button class="btn btn-d mt-sm-3" data-target="#modal-add-shipping-data" data-toggle="modal" aria-hidden="true">
                            <i class="fa fa-plus mr-2"></i>Add Shipping Address
                        </button>
                    </div>

                    <!-- DEFAULT ADDRESS: GENERATED DARI PROFILE -->
                    <div class="">
                        <div class="col-xs-12">
                            <h3 class="title-a text-black">Default Address</h3>
                        </div>
                        <div class="col-xs-12">
                            <div class="details-shipping">
                                <p>First Name</p>
                                <span>{{ $profile->first_name }}</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-shipping">
                                <p>Last Name</p>
                                <span>{{ $profile->last_name }}</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-shipping">
                                <p>Address</p>
                                <span>{{ $profile->address }}</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-shipping">
                                <p>City</p>
                                <span>{{ $profile->city }}</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-shipping">
                                <p>Postal Code</p>
                                <span>{{ $profile->postal_code }}</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-shipping">
                                <p>Country Code</p>
                                <span>{{ $profile->country_code }}</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-shipping">
                                <p>Phone Number</p>
                                <span>{{ $profile->phonr }}</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END DEFAULT ADDRESS: GENERATED DARI PROFILE -->

                    @foreach($shippingAddresses as $key => $address)
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="title-a text-black">{{ $address->address }}</h3>
                            </div>
                            <div class="col-xs-12">
                                <div class="details-shipping">
                                    <p>First Name</p>
                                    <span>{{ $address->first_name }}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="details-shipping">
                                    <p>Last Name</p>
                                    <span>{{ $address->last_name }}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="details-shipping">
                                    <p>Address</p>
                                    <span>{{ $address->address }}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="details-shipping">
                                    <p>City</p>
                                    <span>{{ $address->city }}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="details-shipping">
                                    <p>Postal Code</p>
                                    <span>{{ $address->postal_code }}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="details-shipping">
                                    <p>Country Code</p>
                                    <span>{{ $address->country_code }}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="details-shipping">
                                    <p>Phone Number</p>
                                    <span>{{ $address->phone }}</span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <!-- Edit Button -->
                            <div class="col-xs-12 mt-3">
                                <button onclick="populateToEdit(
                                        '{{ $address->id }}', 
                                        '{{ $address->first_name }}', 
                                        '{{ $address->last_name }}', 
                                        '{{ $address->address }}', 
                                        '{{ $address->city }}', 
                                        '{{ $address->postal_code }}', 
                                        '{{ $address->country_code }}', 
                                        '{{ $address->phone }}'
                                    )" 
                                    class="btn btn-d mr-2" 
                                    data-target="#modal-edit-shipping-data" 
                                    data-toggle="modal" 
                                    aria-hidden="true">
                                    <i class="fa fa-edit mr-2"></i>Edit Shipping Address
                                </button>
                            </div>
                            <!-- End Edit Button -->

                            <!-- Delete Button -->
                            <div class="col-xs-12 mt-3">
                                <button onclick="confirmDeleteAddress('{{ $address->id }}')" 
                                    class="btn btn-d mr-2" 
                                    data-target="#modal-delete" 
                                    data-toggle="modal" 
                                    aria-hidden="true">
                                    <i class="fa fa-trash mr-2"></i>Delete Shipping Address
                                </button>
                            </div>
                            <!-- End Delete Button -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
	</div>
</div>
<!-- /SECTION PROFILE -->

@endsection