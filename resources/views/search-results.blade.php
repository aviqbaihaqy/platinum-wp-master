@extends('layouts.app')

@section('content')

<!-- BANNER TITLE -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">SEARCH RESULTS</h2>
		<hr class="hr-b mt-0">
	</div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION SEARCH RESULTS -->
<div class="section-results">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			@foreach($products as $key => $product)
				<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 py-4">
					<!-- Product 1 -->
					<div class="grid-pro">
						<div class="grid-product">
							<a href="{{ route('products.showByUri', $product->uri) }}">
								<div class="containerfade">
									<!-- Product Img -->
							     	<div class="imgHolder">
							      		<img src="{{ asset($product->photo->directory) }}" class="img-responsive" alt="">
							      	</div>
							    </div>
							</a>
						</div>
						<!-- Product Price -->
						<div class="featured-product-shop">
							<h6>
								<a href="{{ route('products.showByUri', $product->uri) }}">{{ $product->name }}</a>
							</h6>

							<p class="product-price">Rp. {{ number_format($product->price) }}</p>

							<form id="addToCart-{{ $product->id }}" action="{{ route('cart.addToCart') }}" method="POST">
								@csrf
								<input type="hidden" name="product_id" value="{{ $product->id }}">

								<!-- Quantity Box -->
								<div class="button-container mb-3">
									<button class="value-button cart-qty-minus" type="button" value="-">-</button>

		  								<input form="addToCart-{{ $product->id }}" type="number" id="number" name="amount" class="qty" maxlength="12" class="input-text qty" value="1" />

		  							<button class="value-button cart-qty-plus" type="button" value="+">+</button>
	  							</div>
							</form>

								<!-- Button Cart -->
								<div class="cart-button mt-2">
								<a class="btn-a item_add" onclick="$('#addToCart-{{ $product->id }}').submit()">Add To Cart</a>
							</div>
						</div>
					</div>
				</div>
			@endforeach

			<!-- Pagination -->
			<div class="col-xs-12 mt-4">
				<div class="pagination">
				  	{{ $products->links('layouts/Pagination/pagination') }}
				</div>
			</div>
		</div>
	</div>
</div>


@endsection