@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function confirmCartDelete(cartId) {
        var deleteUrl = '/member/cart/' + cartId + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}');
    }
</script>   

<!-- BANNER -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">MY CART</h2>
		<hr class="hr-b mt-0">
		<h4 class="title-a text-white mt-3 max-width-a" style="line-height:1.5em;">Phasellus quis volutpat enim, non semper ex. Nulla et malesuada arcu. Aenean laoreet lorem vel placerat tristique.</h4>
	</div>
</div>
<!-- /BANNER -->


<!-- SECTION CHECKOUT -->
<div class="section-checkout">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-xs-12">
				<img src="{{ asset('images/Logo.png') }}" width="300px">
				<!-- Breadcrumbs -->
				<ul class="breadcrumb-b mt-3">
				  	<li><a href="products">All Products</a></li>
				  	<li>My Cart</li>
				</ul>
				<!-- /Breadcrumbs -->
				
				<!-- Checkout Form -->
				<div class="row mt-4 py-4">
					<div class="col-xs-12">
						<!-- Cart Header -->
						<div class="shopping-cart-header-checkout">
					      	<i class="fas fa-cart-arrow-down cart-icon-checkout"></i>My Cart
					    </div>

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

                        @if($carts->first())
						    <form id="checkoutForm" action="{{ route('members.checkoutCart', $carts->first()->user_id) }}" method="POST">
						    	@csrf
						    </form>
							
							<!-- Cart Lists -->
							@foreach($carts as $key => $cart)
							    <ul class="shopping-cart-items-checkout">
							      	<li class="clearfix">
							      		<div class="row">
							      			<div class="col-xs-12 col-sm-6">
								      			<div class="row pull-left">
								      				<div class="col-xs-6">
										        		<img src="{{ asset($cart->product->photo->directory) }}" />
													</div>
													
													<div class="col-xs-6">
											        	<span class="item-name">
											        		{{ $cart->product->name }}
											        	</span>
											        	<br>
											        	<span class="item-price mt-3">
											        		{{ number_format($cart->product->price) }}
											        	</span>
											        	<br>
											        	<span class="item-quantity">
											        		<div class="product-quantity mt-2 mb-4">
											        			{{ $cart->amount }}
															</div>
											        	</span>
										        	</div>
										    	</div>
										    </div>
										    
											<div class="col-xs-12 col-sm-6">
										        <div class="pull-right">
										        	<h3 class="title-c text-black mt-sm-3 my-0">Total :
														<span class="item-price-lg pull-right">
															{{ number_format($cart->total) }}
														</span>
														<br>
										        	</h3>
										        	<br/>
										        	<span class="item-notes">
														<textarea form="checkoutForm" placeholder="Notes" name="notes[{{ $cart->id }}]" style="background-color: white;border:2px solid #F2F2F2"></textarea>
										        	</span>
													<a onclick="confirmCartDelete('{{ $cart->id }}')" data-toggle="modal" data-target="#modal-delete" class="remove-cart mt-3 pull-right">
								        				<i class="fas fa-trash"></i>
								      				</a>
										        </div>
										    </div>
									    </div>
							      	</li>
							    </ul>
						    @endforeach
							
						    <div class="shopping-cart-header-checkout mb-3">
						    	<!-- Cart Total -->
						      	<div class="shopping-cart-total">
						        	<span>Grand Total:</span>
						        	<span class="total-payment">
						        		{{ number_format($carts->grandTotal) }}
						        	</span>
						      	</div>
						    </div>
							
							<!-- Button Checkout -->
						    <a href="#" data-target="#modal-confirm-checkout" data-toggle="modal" aria-hidden="true" style="color:white; font-size: 14px;  padding: 8px 12px; margin:0;" class="btn-checkout">
						    	<i class="fas fa-shopping-bag mr-2"></i>Checkout</a>
							</div>
						@else
							{{-- If empty cart --}}
							<div class="row mt-4">
								<div class="col-xs-12 col-sm-8 col-sm-offset-2">
		                        	<!-- Empty Cart -->
		                            <div class="text-center">
		                                <h3 class="title-a mb-3 text-black">
		                                    <i class="fas fa-cart-arrow-down mr-2"></i>Empty Cart
		                                </h3>

		                                 <a href="{{ route('products.index') }}" style="color:white; font-size: 14px;  padding: 8px 12px; margin: 1em 0 0;" class="btn-checkout">
		                                    <i class="fas fa-shopping-bag mr-2"></i>Go to Shopping
		                                </a>
		                            </div>
		                            <!-- Empty Cart -->
		                       	</div>
		                    </div>
						@endif
					</div>
				</div>
			</div>

			<!-- Shopping Cart Column -->
			{{-- <div class="col-xs-12 col-md-5 col-md-offset-1 col-shipping mt-lg-4">
				
			</div> --}}
		</div>
	</div>
</div>
<!-- SECTION CHECKOUT -->

@endsection