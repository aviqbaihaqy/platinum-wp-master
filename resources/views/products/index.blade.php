@extends('layouts.app')

@section('content')

<!-- BANNER TITLE -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">OUR PRODUCTS</h2>
	</div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION PRODUCTS -->
<div class="section-product">
	<div class="container px-md-3 px-xl-6">
		<!-- Breadcrumbs -->
		<ul class="breadcrumb">
		  	<li><a href="{{ route('index') }}">Home</a></li>
		  	<li><a href="{{ route('products.index') }}">Products</a></li>
		  	<li>{{ $subcategory ? $subcategory->name : 'All Products' }}</li>
		</ul>
		<!-- /Breadcrumbs -->

		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-0">
				<!-- Product Categories -->
				<div class="categories pb-5">
					<h3>Categories</h3>
					@foreach($categories as $key => $category)
						<details class="category">
							<summary class="category text-left">
								{{ $category->name }}
							</summary>
							<p>
								<ul>
									@foreach($category->subcategories as $key => $_subcategory)
										<li>
											<a href="/products/?subcategory={{ $_subcategory->name }}">{{ $_subcategory->name }}</a> <span>({{ count($_subcategory->products) ? count($_subcategory->products) : 0 }})</span>
										</li>
									@endforeach
								</ul>
							</p>
						</details>
					@endforeach
				</div>
	
				<!-- Price Option -->
				<div class="price pb-5">
					<h3>Price Range</h3>
					<div class="price-head">
						<form id="configForm" method="GET" action="">
							<div class="col-lg-12 price-head1">
								<h4 class="title-a text-black mt-0">Minimum</h4>
	                            <div class="price-top1">
	                                <span class="price-top">Rp</span>
	                                <input name="lowestPrice" type="text"  value="{{ isset($_GET['lowestPrice']) ? $_GET['lowestPrice'] : 0 }}">
	                            </div>
	                        </div>
							<div class="col-lg-12 price-head2">
								<h4 class="title-a text-black">Maximum</h4>
	                            <div class="price-top1">
	                                <span class="price-top">Rp</span>
	                                <input name="highestPrice" type="text"  value="{{ isset($_GET['highestPrice']) ? $_GET['highestPrice'] : 0 }}">
	                            </div>
	                        </div>
	                        <div class="col-lg-12 pl-0">
								<button type="submit" class="btn btn-d">Apply</button>
	                        </div>
						</form>
                	</div>
            	</div>
 			</div>

			
			<!-- Products Menu -->
			<div class="col-xs-12 col-md-9 px-6 px-md-3 pt-lg-4">
				<!-- Sort Option -->
				<div class="mens-toolbar">
					<p class="mr-3">Showing 1–6 of 12 results</p>
					<p>
			            <select form="configForm" name="perPage">
			                <option value="6" <?php if($perPage == 6) echo 'selected' ?>>6</option>
			                <option value="9" <?php if($perPage == 9) echo 'selected' ?>>9</option>
			                <option value="12" <?php if($perPage == 12) echo 'selected' ?>>12</option>
			            </select>
			        </p>
                	<p>
					<form class="mt-3">
						<input class="search" type="text" name="search" placeholder="Search.." id="search-item">
					</form>
					</p>	
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

		        @foreach($products as $key => $product)
				<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 simpleCart_shelfItem">
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
</div>			
<!-- /SECTION PRODUCTS -->

@endsection