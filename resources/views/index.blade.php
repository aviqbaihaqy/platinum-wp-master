@extends('layouts.app')

@section('content')

<!-- BANNER SLIDE -->
<div class="banner">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="item item-1 active">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                        <div class="captiontext animated wow zoomIn py-sm-3 py-lg-4" data-wow-delay=".10s">
                            {{-- <h3 class="title-b text-white" style="text-transform: uppercase; letter-spacing: 2px">
                                lorem ipsum dolor sit amet consectetur adipiscing elit
                            </h3> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="item item-2">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                        <div class="captiontext animated wow zoomIn py-sm-3 py-lg-4" data-wow-delay=".10s">
                            {{-- <h3 class="title-b text-white" style="text-transform: uppercase; letter-spacing: 2px">
                                lorem ipsum dolor sit amet consectetur adipiscing elit
                            </h3> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" style="position:relative;left:-0.75em;"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" style="position:relative;right:-0.75em;"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!-- /BANNER SLIDE -->


<!-- SECTION FAVORITE PRODUCTS -->
<div class="section-favorites pb-5">
    <div class="container px-md-3 px-xl-6">
        <div class="row">
            @foreach($latestProducts->take(3) as $key => $__product)
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0">
                    <!-- Favorites Item 1 -->
                    <div class="col-favorites text-center animated wow fadeInUp py-sm-3 py-lg-4" data-wow-delay=".3s">
                        <div class="grid-pro">
                            <div class="grid-product">
                                <a href="{{ route('products.showByUri', $__product->uri) }}">
                                <div class="containerfade">
                                    <!-- Product Img -->
                                    <div class="imgHolder">
                                        <img src="{{ asset($__product->photo->directory) }}" class="img-responsive" alt="">
                                    </div>
                                    <!-- Product Img Anim -->
                                    <div class="middle">
                                        <div class="textfade">
                                            <div class="imgHolder">
                                                <img src="{{ asset($__product->photo->directory) }}" class="img-responsive" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                        <!-- Product Title -->
                        <h3 class="title-c text-black pt-3" style="border-top:3px solid #F2F2F2; height: 70px;">
                            {{ $__product->name }}
                        </h3>

                        <!-- Product Top Features -->
                        @foreach($__product->attributes->take(3) as $key => $attribute)
                            <h5 class="title-b text-gray mt-3">
                                {{ $attribute->attribute_name }}:
                                    @foreach($attribute->values as $valueKey => $value)
                                        {{ $value->value }}
                                        {{-- {{dd($valueKey + 1, $attribute->values)}} --}}

                                        @if(isset($attribute->values[$valueKey + 1]))
                                        ,
                                        @endif
                                    @endforeach
                            </h5>
                        @endforeach

                        <!-- Product Price -->
                        <div class="featured-product-shop">
                            <p class="product-price mt-3">Rp. {{ number_format($__product->price) }}</p>

                            <a href="{{ route('products.showByUri', $__product->uri) }}" class="btn-b item_add">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- /SECTION FAVORITE PRODUCTS -->


<!-- SECTION COMPANY VALUES -->
<div class="section-value">
    <div class="container px-md-3 px-xl-6">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-3 col-md-offset-0 text-center mt-lg-4">
                <img src="{{ asset('images/thumbs-up.png') }}" width="60px">
                <h5 class="title-b text-black mt-3">Highly Qualified Material</h5>
                <p class="p-a text-gray">Kami adalah perusahaan yang berkomitmen menggunakan material yang terbaik untuk setiap produk-produk yang kami tawarkan.</p>
            </div>

            <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-3 col-md-offset-0 text-center mt-lg-4">
                <img src="{{ asset('images/safely-packing.png') }}" width="60px">
                <h5 class="title-b text-black mt-3">Safety & Compliance</h5>
                <p class="p-a text-gray">Untuk memastikan performa dan keamanan produk kami, Platinum Lighting telah memenuhi standar sertifikasi SNI.</p>
            </div>

            <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-3 col-md-offset-0 text-center mt-lg-4">
                <img src="{{ asset('images/secure-payment.png') }}" width="60px">
                <h5 class="title-b text-black mt-3">Secure Payment</h5>
                <p class="p-a text-gray">Lebih hemat energy dengan memakai  LED yang tahan lama, serta dapat mengurangi penggunaan biaya listrik anda.</p>
            </div>

            <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-3 col-md-offset-0 text-center mt-lg-4">
                <img src="{{ asset('images/quality.png') }}" width="60px">
                <h5 class="title-b text-black mt-3">LED Performance</h5>
                <p class="p-a text-gray">Dengan menggunakan LED berkualitas kami memaksimalkan jumlah cahaya yang dihasilkan sehingga dapat mencapai tingkat kecerahan yang ideal.</p>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION COMPANY VALUES -->


<!-- SECTION ADVERTISEMENT BANNER -->
<div class="section-advertisement">
    <div class="container px-md-3 px-xl-6">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="title-a text-white">Inspired by Natural <br/>
                Daylight</h2>
                <h3 class="title-a text-white mt-0 max-width-a">Optimalkan pencahayaan pada ruangan anda dengan intensitas cahaya dan daya yang pas.</h3>
                <p class="p-a text-white max-width-a mt-4"><i>Produk kami selalu memberikan pencahayaan dengan intensitas yang tetap, menyebar secara merata, tidak berkedip, tidak menyilaukan, dan  tentu saja nyaman untuk mata. Dengan penggunaan daya yang sedikit dapat menghasilkan cahaya yang lebih banyak, sehingga  dapat menghemat tagihan listrik anda.</i></p>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION ADVERTISEMENT BANNER -->


<!-- BOX MENU LATEST CATEGORIES -->
<div class="container-fluid">
    <div class="col-12 animated wow fadeIn" data-wow-delay=".1s">
        <div class="row">
            <!-- Show Products By Category -->
            @foreach($categories as $key => $category)
                <div class="col-sm-4 p-0">
                    <div class="grid">
                        <figure class="effect-bubba">
                            <img src="{{ asset($category->background_image) }}" class="img-responsive" alt="">
                            <figcaption>
                                <h2>{{ $category->name }}</h2>
                                <a href="{{ route('products.showByCategory', $category->name) }}"></a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- /BOX MENU LATEST CATEGORIES -->


<!-- CONTENT NEW PRODUCT -->
<div class="container section-products px-xl-6">
    <h2 class="title-b text-black text-center mt-4">LATEST PRODUCTS</h2>
    <div class="row py-5">
        @foreach($latestProducts->take(8) as $key => $___product)
            <div class="col-xs-6 col-md-4 col-lg-3">
                <!-- Product 1 -->
                <div class="grid-pro">
                    <div class="grid-product">
                        <a href="{{ route('products.showByUri', $___product->uri) }}">
                        <div class="containerfade">
                            <!-- Product Img -->
                            <div class="imgHolder">
                                <img src="{{ asset($___product->photo->directory) }}" class="img-responsive" alt="">
                            </div>
                            <!-- Product Img Anim -->
                            <div class="middle">
                                <div class="textfade">
                                    <div class="imgHolder">
                                        <img src="{{ asset($___product->photo->directory) }}" class="img-responsive" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- Product Price -->
                    <div class="featured-product-shop">
                        <h6 style="height: 50px;">
                            <a href="{{ route('products.showByUri', $___product->uri) }}">{{ $___product->name }}</a>
                        </h6>

                        <p class="product-price">Rp. {{ number_format($___product->price) }}</p>

                        <form id="addToCart-{{ $___product->id }}" action="{{ route('cart.addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $___product->id }}">

                            <!-- Quantity Box -->
                            <div class="button-container mb-3">
                                <button class="value-button cart-qty-minus" type="button" value="-">-</button>

                                    <input form="addToCart-{{ $___product->id }}" type="number" id="number" name="amount" class="qty" min="1" max="{{ $__product->stock->amount }}" class="input-text qty" value="1" />

                                <button class="value-button cart-qty-plus" type="button" value="+">+</button>
                            </div>
                        </form>

                        <!-- Button Cart -->
                        <div class="cart-button mt-2">
                            {{-- <a data-toggle="modal" data-target="#modal-cart" class="btn-a item_add">Add To Cart</a> --}}
                            <a class="btn-a item_add" onclick="$('#addToCart-{{ $___product->id }}').submit()">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="clearfix"></div>
</div>
<!-- /CONTENT NEW PRODUCT -->


<!-- SECTION ABOUT -->
<div class="section-about">
    <div class="container px-md-3 px-xl-6">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <h1 class="title-a text-black text-left">CV ANUGERAH PRATAMA</h1>
                <hr class="hr-a">
                <h3 class="title-a text-black mt-2">About Us</h3>
                <h4 class="title-b text-black mt-3" style="line-height: 1.25em">CV Anugerah Pratama adalah perusahaan yang berdiri sejak 1 September 2018 dan bergerak di bidang distribusi dan manufaktur lampu khususnya yang berbasis LED ( Light Emitting Diode ).</h4>
                <p class="p-a text-black mt-2" style="word-spacing: 0.2em">
                    Seiring dengan perkembangan teknologi dan inovasi dalam industri penerangan dunia, kami ingin menawarkan solusi untuk kebutuhan lampu indoor dan outdoor di Indonesia untuk menggantikan lampu yang lebih konvensional seperti CFL, Merkurius, Halogen, atau jenis pencahayaan lainnya.
                </p>
                <a href="about" class="btn-d mt-2">View More</a>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION ABOUT -->


<!-- SECTION BRANDS -->
<div class="section-brand">
    <div class="container px-md-3 px-xl-6">
        <h2 class="title-b text-black text-center">OUR PARTNERS</h2>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-0">
                <img src="{{ asset('images/logo-1.png') }}" class="img-responsive" alt="" />
            </div>
            <div class="col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-0">
                <img src="{{ asset('images/logo-2.png') }}" class="img-responsive" alt="" />
            </div>
            <div class="col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-0">
                <img src="{{ asset('images/logo-3.png') }}" class="img-responsive" alt="" />
            </div>
            <div class="col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-0">
                <img src="{{ asset('images/logo-4.png') }}" class="img-responsive" alt="" />
            </div>
        </div>
    </div>
</div>
<!-- /SECTION BRANDS -->

@endsection
