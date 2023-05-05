@extends('layouts.app')

@section('content')

<!-- BANNER TITLE -->
<div class="banner-top">
    <div class="container px-md-3 px-xl-6">
        <h2 class="title-a text-white">OUR PRODUCTS</h2>
    </div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION PRODUCT -->
<div class="section-product">
    <div class="container px-md-3 px-xl-6">
        <!-- Breadcrumbs -->
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('index') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('products.index') }}">All Products</a>
            </li>
            <li>{{ $product->name }}</li>
        </ul>
        <!-- /Breadcrumbs -->
        
        <!-- Single Product Detail -->
        <div class="row">
            <div class="col-xs-12 animated wow fadeInLeft pb-3 pt-lg-4" data-wow-delay=".5s">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-5 col-md-offset-0 grid-im">
                        <!-- Img Grid Bottom -->
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="{{ asset($product->photo->directory) }}">
                                    <div class="thumb-image">
                                        <img src="{{ asset($product->photo->directory) }}" data-imagezoom="true" class="img-responsive"> 
                                    </div>
                                </li>
                                <!-- LOOPING PHOTOS -->
                                @foreach($product->photos as $key => $photo)
                                    @if($photo->directory != $product->photo->directory)
                                        <li data-thumb="{{ asset($photo->directory) }}">
                                            <div class="thumb-image">
                                                <img src="{{ asset($photo->directory) }}" data-imagezoom="true" class="img-responsive"> 
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                                <!-- LOOPING PHOTOS -->
                            </ul>
                        </div>
                    </div>
            
                    <div class="col-md-7">
                        <!-- Product Detail -->
                        <div class="span_2_of_a1 simpleCart_shelfItem">
                            <!-- Title -->
                            <h3 style="float: left; text-transform: none;font-weight: 400;">{{ $product->name }}</h3>
                            <div class="clearfix"></div>

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

                            <!-- Desc -->
                            <p class="in-para">{{ $product->description }}.</p>
                            <!-- Price -->
                            <div class="price_single">
                                <span class="reducedfrom item_price">Rp. {{ number_format($product->price) }}</span>

                                <form id="addToCart" action="{{ route('cart.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <br/>
                                    <!-- Quantity Box -->
                                    <div class="button-container mt-3">
                                        <button class="value-button cart-qty-minus" type="button" value="-">-</button>

                                        <input form="addToCart" type="number" id="number" name="amount" class="qty" maxlength="12" class="input-text qty" value="1" />

                                        <button class="value-button cart-qty-plus" type="button" value="+">+</button>
                                    </div>
                                </form>

                                <!-- Button Cart -->
                                <div class="cart-button mt-2">
                                    {{-- <a data-toggle="modal" data-target="#modal-cart" class="btn-a item_add">Add To Cart</a> --}}
                                    <a class="btn-a item_add" onclick="$('#addToCart').submit()">Add To Cart</a>
                                </div>            

                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <!-- Tabs Menu -->
                        <div class="sap_tabs">  
                            <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                <ul class="resp-tabs-list">
                                    <li class="resp-tab-item " aria-controls="tab_item-0" role="tab"><span>Specification</span></li>
                                    <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Dimension</span></li>
                                    <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Terms & Warranty</span></li>
                                    <div class="clearfix"></div>
                                </ul>            
                                <div class="resp-tabs-container">
                                    <!-- Tab Specs -->
                                    <div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                                        <div class="details">
                                            @foreach($product->attributes as $key => $attribute)
                                            <div class="details-info">
                                                <p>
                                                    {{ $attribute->attribute_name }}
                                                </p>

                                                <span>
                                                    @if ($attribute->values->first())
                                                        {{ $attribute->values->first()->value }}
                                                    @endif
                                                </span>
                                                
                                                <div class="clearfix"></div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                     
                                     <!-- Tab Dimension Image -->
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                                        <div class="details">
                                            <h3 class="title-a text-black mb-3">Dimension :</h3>
                                                @foreach($product->dimensions as $key => $dimension)
                                                    <img src="{{ asset($dimension->directory) }}" width="100%" class="img-responsive">
                                                @endforeach
                                        </div>
                                    </div>
                                    
                                    <!-- Tab Warranty Info -->
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                                        <div class="details">
                                            <div class="details">
                                                @if ($product->term)
                                                    <div class="details-info"><p>Warranty</p>
                                                        <span>
                                                            {{ $product->term->warranty_unit }}
                                                        </span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="details-info">
                                                        <p>Terms</p>
                                                        <span>
                                                            <ul>
                                                                <li>{{ $product->term->warranty_terms }}</li>
                                                            </ul>
                                                        </span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Features Label -->
                <!--<div class="row mt-4">-->
                <!--    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offfset-2 col-md-6 col-md-offset-3">-->
                <!--        <div class="row">-->
                <!--            <div class="col-xs-4 mt-md-3">-->
                <!--                <img src="{{ asset('images/warranty.png') }}" width="100%" class="img-responsive center-block">-->
                <!--            </div>-->
                <!--            <div class="col-xs-4 mt-md-3">-->
                <!--                <img src="{{ asset('images/surge-protection.jpg') }}" width="100%" class="img-responsive center-block">-->
                <!--            </div>-->
                <!--            <div class="col-xs-4 mt-md-3">-->
                <!--                <img src="{{ asset('images/energy-saving.png') }}" width="100%" class="img-responsive center-block">-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!-- SECTION PRODUCT -->


@if($product->banner)
    <!-- SECTION FEATURES BANNER -->
    <div class="section-features">
        <div class="content">
            <div class="container px-md-3 px-xl-6">
                <div class="row py-5">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <img src="{{ asset($product->banner->directory) }}" class="img-responsive center-block img-features animated wow fadeIn" data-delay=".5s" alt="">
                    </div>
                </div>
                {{-- <div class="gradient-border"></div> --}}
            </div>
        </div>
    </div>
    <!-- SECTION FEATURES BANNER -->
@endif


<!-- SECTION RELATED -->
<div class="section-related">
    <div class="container px-md-3 px-xl-6">
        <h3 class="title-b text-black mb-3">Related Products</h3>
        <div class="row">
            <div id="owl-demo" class="owl-carousel">
                @foreach($relatedProducts as $key => $rProduct)
                    <div class="item">
                        <!-- Product 1 -->
                        <div class="grid-pro">
                            <div class="grid-product">
                                <a href="{{ route('products.showByUri', $rProduct->uri) }}">
                                    <div class="containerfade">
                                        <!-- Product Img -->
                                        <div class="imgHolder">
                                            <img src="{{ asset($rProduct->photo->directory) }}" class="img-responsive" alt="">
                                        </div>
                                        <!-- Product Img Anim -->
                                        <div class="middle">
                                            <div class="textfade">
                                                <div class="imgHolder">
                                                    <img src="{{ asset($rProduct->photo->directory) }}" class="img-responsive" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Product Price -->
                            <div class="featured-product-shop">
                                <h6>
                                    <a href="{{ route('products.showByUri', $rProduct->uri) }}">{{ $rProduct->name }}</a>
                                </h6>

                                <p class="product-price">Rp. {{ number_format($rProduct->price) }}</p>

                                <form id="addToCart-{{ $rProduct->id }}" action="{{ route('cart.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $rProduct->id }}">

                                    <!-- Quantity Box -->
                                    <div class="button-container">
                                        <button class="value-button cart-qty-minus" type="button" value="-">-</button>

                                            <input form="addToCart-{{ $rProduct->id }}" type="number" id="number" name="amount" class="qty" maxlength="12" class="input-text qty" value="1" />
                                        <button class="value-button cart-qty-plus" type="button" value="+">+</button>
                                    </div>
                                </form>

                                <!-- Button Cart -->
                                <div class="cart-button mt-2">
                                    {{-- <a data-toggle="modal" data-target="#modal-cart" class="btn-a item_add">Add To Cart</a> --}}
                                    <a class="btn-a item_add" onclick="$('#addToCart-{{ $rProduct->id }}').submit()">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    </div>
</div>
<!-- /SECTION RELATED -->

@endsection