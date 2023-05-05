
<!-- Modal Success Add to Cart -->
<div id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="cartModal" aria-hidden="true" class="modal fade">
    <div class="popup">
        <!-- Title -->
        <h2 class="text-success">Success added to cart <i class="fas fa-check-circle ml-1"></i></h2>
        <a class="close" data-dismiss="modal">&times;</a>
        <div class="popup-content mt-3">
            <p class="p-a">Thank you for shopping with us ! Enjoy it !</p>
            
            <!-- Products Status -->
            <ul class="shopping-cart-items">
                <li class="clearfix">
                    <img src="{{ asset('images/dummy-3.jpg') }}">
                    <span class="item-name">Flood Light 1</span>
                    <span class="item-price">150.000,00,00</span><br>
                    <span class="item-quantity">Quantity: 01</span>
                </li>
            </ul>

            <!-- Button Back to Shopping -->
            <a href="products/index" class="btn-d">Back to Shopping<i class="fas fa-cart-plus ml-2"></i></a>
            <!-- Button Checkout -->
            <a href="checkout" class="btn-d mt-sm-2">My Cart<i class="fas fa-shopping-bag ml-2"></i></a>
        </div>
    </div>
</div>


<!-- Modal Confirm Checkout -->
<div id="modal-confirm-checkout" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true" class="modal fade">
    <div class="popup">
        <h2 class="text-black">Are you sure want to checkout?</h2>
        <p class="p-a text-black mt-3">
            <i class="fa fa-cart-arrow-down mr-1"></i>
            Your cart lists will be destroyed and move to invoiced
        </p>
        <a class="close" data-dismiss="modal">&times;</a>
        <div class="pooup-content mt-3">
            <button form="checkoutForm" type="submit" class="btn btn-d">Yes, checkout anyway</button>
            <button class="btn btn-c" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>


<!-- Modal Delete -->
<div id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true" class="modal fade">
    <div class="popup">
        <h2 class="text-black">Are you sure want to remove?</h2>
        <a class="close" data-dismiss="modal">&times;</a>
        <div class="pooup-content mt-3">
            <form id="delete_form" method="POST" action="">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-d">Yes, remove</button>
                <button class="btn btn-c" data-dismiss="modal">No</button>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Profile -->
<div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Profile
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="edit_member_form" action="" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-6">
                                <!-- First Name -->
                                <label class="text-black">First Name</label>
                                <input id="edit_member_first_name" name="first_name" type="text" class="form-control" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <!-- Last Name -->
                                <label class="text-black">Last Name</label>
                                <input id="edit_member_last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-8 mt-3">
                                <!-- Address -->
                                <label class="text-black">Address</label>
                                <input id="edit_member_address" name="email" type="text" class="form-control" placeholder="Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Email Address -->
                                <label class="text-black">Email Address</label>
                                <input id="edit_member_email" name="address" type="text" class="form-control" placeholder="Email Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Phone Number -->
                                <label class="text-black">Country Code</label>
                                <select id="edit_member_country" name="country_code" type="text" class="form-control">
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Phone Number -->
                                <label class="text-black">Phone Number</label>
                                <input id="edit_member_phone" name="phone" type="text" class="form-control" placeholder="Phone Number">
                            </div>

                            <div class="col-xs-12 col-sm-8 mt-3">
                                <!-- Company-->
                                <label class="text-black">Company</label>
                                <p class="alert text-danger m-0 p-0">*Optional</p>
                                <input id="edit_member_company" name="company" type="text" class="form-control" placeholder="Company">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button onclick="$('#edit_member_form').submit()" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Profile Photo -->
<div class="modal fade" id="modal-edit-photo">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Profile Photo
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="updateProfilePhoto" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
                                <!-- Form Upload -->
                                <input form="updateProfilePhoto" type="file" name="photo" required />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="updateProfilePhoto" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@if(Auth::check())
    @if(Route::is('members.viewInvoice'))
        <script type="text/javascript"
                    src="https://app.midtrans.com/snap/snap.js"
                    data-client-key="SB-Mid-client-L2uQQtDigAi6HA8u"></script>
        <form method="POST" action="{{ route('members.finishPayment') }}" id="midtransForm">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <input type="hidden" name="result_type" id="result-type" value=""></div>
            <input type="hidden" name="result_data" id="result-data" value=""></div>
        </form>

        <!-- Modal Shipping Data -->
        <div class="modal fade" id="modal-shipping-data" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content-b">
                    <div class="modal-header">
                        <!-- Button Close -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- Modal Title -->
                        <h4 class="text-black">
                            <i class="fa fa-shipping-fast mr-2"></i>Shipping Data
                        </h4>
                    </div>
                    <div class="modal-body">
                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 text-center mb-4">
                                    <img src="{{ asset('images/midtrans-logo.png') }}" width="200px;">
                                    <h4 class="title-a">Complete purchase with Midtrans</h4>
                                </div>

                                <div class="col-xs-12 col-sm-8 mb-3">
                                    <label class="text-black">Address Option</label>
                                    <select id="shippingAddressDropdown" onchange="fillAddressData(this)" name="shipping_address_id">
                                        <option>Please Select</option>
                                        @foreach(Auth::user()->shippingAddresses as $key => $address)
                                            <option value="{{ $address->id }}">{{ $address->address }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <form id="shippingDataForm" action="" method="POST">
                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">First Name</label>
                                        <input id="pay_first_name" value="{{ Auth::user()->details->first_name }}" name="first_name" type="text" class="form-control" id="" placeholder="First Name" readonly>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">Last Name</label>
                                        <input id="pay_last_name" value="{{ Auth::user()->details->last_name }}" name="last_name" type="text" class="form-control" id="" placeholder="Last Name" readonly>
                                    </div>

                                    <div class="col-xs-12">
                                        <label class="text-black">Address</label>
                                        <input id="pay_address" value="{{ Auth::user()->details->address }}" name="address" type="text" class="form-control" id="" placeholder="Address" readonly>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">City</label>
                                        <input id="pay_city" value="{{ Auth::user()->details->city }}" name="city" type="text" class="form-control" id="" placeholder="City" readonly>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">Postal Code</label>
                                        <input id="pay_postal_code" value="{{ Auth::user()->details->postal_code }}" name="postal_code" type="text" class="form-control" id="" placeholder="Postal Code" readonly>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">Country Code</label>
                                        <input id="pay_country_code" value="{{ Auth::user()->details->country_code }}" name="country_code" type="text" class="form-control" id="" placeholder="Country Code" readonly>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">Phone Number</label>
                                        <input id="pay_phone" value="{{ Auth::user()->details->phone }}" name="phone" type="text" class="form-control" id="" placeholder="Phone Number" readonly>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Button Save -->
                        <button id="pay-button" onclick="" type="submit" class="btn btn-d">Pay</button>
                        <!-- Button Cancel -->
                        <button class="btn btn-c" data-dismiss="modal">Cancel</button>
                    </div>

                    <script type="text/javascript">
                        function fillAddressData(select) {
                            var address_id = select.value

                            if(!select) {
                                $('#pay_first_name').val('{{ Auth::user()->details->first_name }}')
                                $('#pay_last_name').val('{{ Auth::user()->details->last_name }}')
                                $('#pay_address').val('{{ Auth::user()->details->address }}')
                                $('#pay_city').val('{{ Auth::user()->details->city }}')
                                $('#pay_postal_code').val('{{ Auth::user()->details->postal_code }}')
                                $('#pay_country_code').val('{{ Auth::user()->details->country_code }}')
                                $('#pay_phone').val('{{ Auth::user()->details->phone }}')
                            } else {
                                $.ajax({
                                    type: 'GET',
                                    url: '/member/shipping_address/' + address_id + '/get_details',
                                    cache: false,
                                    dataType: 'JSON',
                                    success: function(data) {
                                        var address = JSON.parse($.parseJSON(JSON.stringify(data)));

                                        console.log(address)
                                        
                                        $('#pay_first_name').val(address.first_name)
                                        $('#pay_last_name').val(address.last_name)
                                        $('#pay_address').val(address.address)
                                        $('#pay_city').val(address.city)
                                        $('#pay_postal_code').val(address.postal_code)
                                        $('#pay_country_code').val(address.country_code)
                                        $('#pay_phone').val(address.phone)

                                        // change url value
                                        var url = ''
                                        $('#shippingDataForm').attr('action', url)
                                    }
                                })
                            }
                        }
                    </script>

                    <script type="text/javascript">
                        $('#pay-button').on('click', function (event) {
                            event.preventDefault();
                            var shipping_address_id = $('#shippingAddressDropdown').val()

                            $.ajax({
                                url: '{{ route('members.pay') }}',
                                cache: false,
                                data: {
                                    invoice_id: invoice_id,
                                    shipping_address_id: shipping_address_id,
                                },
                                success: function(data) {
                                    //location = data;
                                    console.log('token = ' + data)

                                    var resultType = document.getElementById('result-type')
                                    var resultData = document.getElementById('result-data')

                                    function changeResult(type, data) {
                                        $("#result-type").val(type)
                                        $("#result-data").val(JSON.stringify(data))
                                        
                                        resultType.innerHTML = type
                                        resultData.innerHTML = JSON.stringify(data)
                                    }
                                    snap.pay(data, {
                                        onSuccess: function(result) {
                                            changeResult('success', result)
                                            
                                            console.log(result.status_message)
                                            console.log(result)
                                            
                                            $('#midtransForm').submit();
                                        },
                                        onPending: function(result) {
                                            changeResult('pending', result)
                                            
                                            console.log(result.status_message)
                                            $('#midtransForm').submit()
                                        },
                                        onError: function(result){
                                            changeResult('error', result)
                                            
                                            console.log(result.status_message)
                                            $('#midtransForm').submit()
                                        }
                                    })
                                }
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    @endif

<!-- Modal Add Shipping Data -->
<div class="modal fade" id="modal-add-shipping-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add New Shipping Data
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="addShippingDataForm" action="{{ route('members.addShippingAddress', Auth::user()->id) }}" method="POST">
                            @csrf

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">First Name</label>
                                <input value="" name="first_name" type="text" class="form-control" id="" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Last Name</label>
                                <input value="" name="last_name" type="text" class="form-control" id="" placeholder="Last Name" required>
                            </div>

                            <div class="col-xs-12">
                                <label class="text-black">Address</label>
                                <input value="" name="address" type="text" class="form-control" id="" placeholder="Address" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">City</label>
                                <input value="" name="city" type="text" class="form-control" id="" placeholder="City" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Postal Code</label>
                                <input value="" name="postal_code" type="text" class="form-control" id="" placeholder="Postal Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Country Code</label>
                                <select name="country_code" type="text" class="form-control" style="background-color: #F2F2F2; box-shadow: none; border:none">
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Phone Number</label>
                                <input value="" name="phone" type="text" class="form-control" id="" placeholder="Phone Number" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button onclick="$('#addShippingDataForm').submit()" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endif


<!-- Modal Edit Shipping Data -->
<div class="modal fade" id="modal-edit-shipping-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Shipping Data
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="editShippingDataForm" action="" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">First Name</label>
                                <input id="edit_sa_first_name" value="" name="first_name" type="text" class="form-control" id="" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Last Name</label>
                                <input id="edit_sa_last_name" value="" name="last_name" type="text" class="form-control" id="" placeholder="Last Name" required>
                            </div>

                            <div class="col-xs-12">
                                <label class="text-black">Address</label>
                                <input id="edit_sa_address" value="" name="address" type="text" class="form-control" id="" placeholder="Address" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">City</label>
                                <input id="edit_sa_city" value="" name="city" type="text" class="form-control" id="" placeholder="City" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Postal Code</label>
                                <input id="edit_sa_postal_code" value="" name="postal_code" type="text" class="form-control" id="" placeholder="Postal Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Country Code</label>
                                <select id="edit_sa_country_code" name="country_code" type="text" class="form-control">
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label class="text-black">Phone Number</label>
                                <input id="edit_sa_phone" value="" name="phone" type="text" class="form-control" id="" placeholder="Phone Number" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button onclick="$('#editShippingDataForm').submit()" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Transaction Details -->
<div class="modal fade" id="modal-transaction-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-file-invoice mr-2"></i>Transaction Details
                </h4>
            </div>
            <div class="modal-body">
                <div id="midtransData" class="details">
                    <div class="details-info">
                        <p>Loading...</p>
                        <span>Loading...</span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="details-info">
                        <p>Loading...</p>
                        <span>Loading...</span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="details-info">
                        <p>Loading...</p>
                        <span>Loading...</span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="details-info">
                        <p>Loading...</p>
                        <span>Loading...</span>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="details-info">
                        <p>Loading...</p>
                        <span>Loading...</span>
                        <div class="clearfix"></div>
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>