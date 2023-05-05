@extends('layouts.dashboards-app.app')

@section('content')

<script type="text/javascript">
    function editProduct(product_id = '{{ $product->id }}') {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + product_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));

                console.log(product)

                $('#editProductForm_product_code').val(product.product_code)
                $('#editProductForm_name').val(product.name)
                $('#editProductForm_buying_price').val(product.buying_price)
                $('#editProductForm_selling_price').val(product.price)
                $('#editProductForm_amount').val(product.stock.amount)
                $('#editProductForm_status').val(product.status)

                // change url value
                var url = '/dashboard/products/' + product.id
                $('#editProductForm').attr('action', url)
            }
        })
    }

    function deleteProduct(product_id = '{{ $product->id }}') {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + product_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));

                var deleteUrl = '/dashboard/products/' + product.id + '/deleteAndRedirect'

                console.log(deleteUrl)

                $('#delete_form').attr('action', deleteUrl)
                $('#csrf_delete').val('{{ csrf_token() }}');
            }
        })
    }

    function addPhoto(product_id = '{{ $product->id }}') {
        var uploadUrl = '/dashboard/products/' + product_id + '/upload_photos'

        console.log(uploadUrl)

        $('#addMassivePhoto').attr('action', uploadUrl)
    }

    function changePhoto(photo_id) {
        var uploadUrl = '/dashboard/products/photo/' + photo_id + '/update'

        console.log(uploadUrl)

        $('#updateProductPhotoForm').attr('action', uploadUrl)
    }

    function removePhoto(photo_id) {
        var deleteUrl = '/dashboard/products/photo/' + photo_id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}')
    }

    function editDescription(product_id = '{{ $product->id }}') {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + product_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));

                console.log(product)

                $('#productEditDescription').val(product.description)

                // change url value
                var url = '/dashboard/products/' + product.id + '/update_description'
                $('#productEditDescriptionForm').attr('action', url)
            }
        })
    }

    function editAttribute(attribute_id) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/attribute/' + attribute_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var attribute = JSON.parse($.parseJSON(JSON.stringify(data)));

                console.log(attribute)

                $('#editAttributeName').val(attribute.attribute_name)
                $('#editAttributeValue').val(attribute.value)

                // change url value
                var url = '/dashboard/products/attribute/' + attribute.id + '/update_attribute'
                $('#editAttributeForm').attr('action', url)
            }
        })
    }

    function deleteAttribute(attribute_id) {
        var deleteUrl = '/dashboard/products/attribute/' + attribute_id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}')
    }

    function addDimensionPhoto(product_id = '{{ $product->id }}') {
        var uploadUrl = '/dashboard/products/' + product_id + '/add_dimension'

        console.log(uploadUrl)

        $('#addDimensionPhoto').attr('action', uploadUrl)
    }

    function editDimensionPhoto(dimension_id) {
        var uploadUrl = '/dashboard/products/dimension/' + dimension_id + '/update'

        console.log(uploadUrl)

        $('#updateDimensionPhoto').attr('action', uploadUrl)
    }

    function deleteDimensionPhoto(dimension_id) {
        var deleteUrl = '/dashboard/products/dimension/' + dimension_id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}')
    }

    function editWarranty(product_id = '{{ $product->id }}') {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/term/' + product_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var term = JSON.parse($.parseJSON(JSON.stringify(data)));

                console.log(term)

                $('#warrantyUnit').val(term.warranty_unit)
                // $('#warrantyTerms').val(term.warranty_terms)
                $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(term.warranty_terms)
            }
        })

        var actionUrl = '/dashboard/products/' + product_id + '/editorupdatewarranty'
        $('#editProductWarrantyForm').attr('action', actionUrl)

        console.log(actionUrl)
    }

    function updateOrCreateBanner(product_id = '{{ $product->id }}') {
        var uploadUrl = '/dashboard/products/banner/' + product_id + '/updateOrCreateBanner'

        console.log(uploadUrl)

        $('#updateOrCreateBannerForm').attr('action', uploadUrl)
    }
</script>

<div class="content-wrapper">
    <section class="content-header pt-3">
    	{{-- Title --}}
        <h1 class="text-black">
            Indoor Product List
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- Card Box --}}
        @include('dashboards.widgets.card-box')
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    	{{-- Title --}}
                        <h3 class="box-title text-black">
                            <i class="fa fa-lightbulb mr-2"></i>{{ $product->subcategory->name }} Product
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
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
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                @if($product->photo)
                                    <img src="{{ asset($product->photo->directory) }}" class="img-product-lg mb-2">
                                    <!-- Button Edit -->
                                    <a onclick="changePhoto('{{ $product->photo->id }}')" class="btn-action ml-2 mr-1" data-target="#modal-edit-product-photo" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- End Button Edit -->
                                @endif

                                <div class="row mt-3">
                                    @foreach($product->photos as $key => $photo)
                                        <div class="col-xs-6 col-lg-4 py-1">
                                            <img src="{{ asset($photo->directory) }}" class="img-product-lg mb-2">

                                            <!-- Button Edit -->
                                            <a onclick="changePhoto('{{ $photo->id }}')" class="btn-action ml-2 mr-1" data-target="#modal-edit-product-photo" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->

                                            <!-- Button Remove -->
                                            <a onclick="removePhoto('{{ $photo->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <!-- End Button Remove -->
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row mt-3">
                                     <div class="col-xs-12">
                                        {{-- Button Add New --}}
                                        <a onclick="addPhoto()" class="btn btn-a mb-3" data-target="#modal-add-product-photo" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                                            <i class="fa fa-plus mr-2"></i>Add New Photos
                                        </a>
                                    </div>


                                    <div class="col-xs-12">
                                        {{-- Button Add New --}}
                                        <a onclick="updateOrCreateBanner()" class="btn btn-a mb-3" data-target="#modal-add-product-banner" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                                            <i class="fa fa-plus mr-2"></i>Add Product Banner
                                        </a>
                                    </div>
                                </div>
                             </div>
                        
                            <div class="col-xs-12 col-md-8 grid-im">
                                <h4 class="text-black">{{ $product->name }} - {{ $product->product_code }}</h4>
                                <h5 class="text-black rp-content">
                                    {{ number_format($product->price) }}
                                </h5>
                                <h5 class="text-black">Stock : {{ $product->stock->amount }}</h5>
                                @if($product->status == 'available')
                                    <span class="label label-success">Available</span>
                                @else
                                    <span class="label label-danger">Unavailable</span>
                                @endif

                                <!-- Button Edit -->
                                <a onclick="editProduct()" class="btn-action ml-2 mr-1" data-target="#modal-edit-price-qty" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <!-- End Button Edit -->

                                @if(Auth::user()->role == 'admin')
                                    <!-- Button Remove -->
                                    <a onclick="deleteProduct()" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <!-- End Button Remove -->
                                @endif

                                <!-- Product Detail -->
                                <div class="span_2_of_a1 simpleCart_shelfItem">
                                    <!-- Desc -->
                                    <p class="in-para">{{ $product->description }}.
                                        <!-- Button Edit -->
                                        <a onclick="editDescription()" class="btn-action ml-2 mr-1" data-target="#modal-edit-desc" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- End Button Edit -->
                                    </p>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <!-- Tabs Menu -->
                                <div class="sap_tabs">  
                                    <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                        <ul class="resp-tabs-list">
                                            <li class="resp-tab-item" aria-controls="tab_item-0" role="tab">
                                                <span>Specification</span>
                                            </li>
                                            <li class="resp-tab-item" aria-controls="tab_item-1" role="tab">
                                                <span>Dimension</span>
                                            </li>
                                            <li class="resp-tab-item" aria-controls="tab_item-2" role="tab">
                                                <span>Terms & Warranty</span>
                                            </li>
                                            <div class="clearfix"></div>
                                        </ul>            
                                        <div class="resp-tabs-container">
                                            <!-- Tab Specs -->
                                            <div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                                                <div class="details">
                                                    @foreach($product->attributes as $key => $attribute)
                                                        <div class="details-info mb-2">
                                                            <p>
                                                                {{ $attribute->attribute_name }}
                                                            </p>

                                                            <span>
                                                                @if ($attribute->values->first())
                                                                    {{ $attribute->values->first()->value }}
                                                                @endif
                                                            </span>

                                                            <div class="clearfix"></div>

                                                            <!-- Button Edit -->
                                                            <a onclick="editAttribute('{{ $attribute->id }}')" class="btn-action mr-1" data-target="#modal-edit-attributes" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <!-- End Button Edit -->

                                                            @if(Auth::user()->role == 'admin')
                                                                <!-- Button Remove -->
                                                                <a onclick="deleteAttribute('{{ $attribute->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                <!-- End Button Remove -->
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="details">
                                                    <form action="{{ route('dashboard.products.attribute.store') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                        <input class="form-control mb-2" type="text" name="attribute_name" placeholder="Attribute Name">

                                                        <input class="form-control" type="text" name="value" placeholder="Attribute Value">

                                                        <button class="btn btn-a mt-2">Add Attribute</button>
                                                    </form>
                                                </div>
                                            </div>
                                             
                                             <!-- Tab Dimension Image -->
                                            <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                                                <div class="details">
                                                    <h3 class="title-a text-black mb-2">Dimension :</h3>
                                                    @foreach($product->dimensions as $key => $dimension)
                                                        <img src="{{ asset($dimension->directory) }}" width="100%" class="img-responsive mb-3">

                                                        <!-- Button Edit -->
                                                        <a onclick="editDimensionPhoto('{{ $dimension->id }}')" class="btn-action mr-1" data-target="#modal-edit-dimension-photo" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <!-- End Button Edit -->

                                                        @if(Auth::user()->role == 'admin')
                                                            <!-- Button Remove -->
                                                            <a onclick="deleteDimensionPhoto('{{ $dimension->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <!-- End Button Remove -->
                                                        @endif
                                                    @endforeach

                                                    <br/>
                                                    {{-- Button Add New --}}
                                                    <a onclick="addDimensionPhoto()" class="btn btn-a mt-3" data-target="#modal-add-dimension-photo" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                                                        <i class="fa fa-plus mr-2"></i>Add New Photos
                                                    </a>     
                                                </div>
                                            </div>
                                            
                                            <!-- Tab Warranty Info -->
                                            <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                                                <div class="details">
                                                    <div class="details">
                                                        @if($product->term)
                                                            <div class="details-info"><p>Warranty</p>
                                                                <span>
                                                                    {{ $product->term->warranty_unit }}
                                                                </span>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="details-info">
                                                                <p>Terms</p>
                                                                <span>
                                                                    {!! $product->term->warranty_terms !!}
                                                                </span>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        @endif

                                                        <!-- Button Edit -->
                                                        <a onclick="editWarranty()" class="btn-action mr-1" data-target="#modal-edit-warranty-terms" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <!-- End Button Edit -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="details">
                                    <div class="details-info"><p>Attributes</p>
                                        <span>
                                            <!-- Button Edit -->
                                            <a onclick="getProductData('{{ $product->id }}')" class="btn-action ml-2 mr-1" data-target="#modal-edit-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->

                                            <!-- Button Remove -->
                                            <a onclick="confirmProductDelete('{{ $product->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <!-- End Button Remove -->
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="details-info">
                                        <p>Dimensions</p>
                                        <span>
                                            <!-- Form Upload -->
                                            <input type="file" name="photo" required />
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="details-info">
                                        <p>Terms and Condition</p>
                                        <span>
                                            <!-- Form Upload -->
                                            <textarea style="height: 100px; width: 400px"></textarea>
                                            <br/>
                                            <button type="submit" class="btn btn-a">Add</button>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="details-info">
                                        <p>Warranty Year</p>
                                        <span>
                                            5 Years
                                            <!-- Button Edit -->
                                            <a onclick="getProductData('{{ $product->id }}')" class="btn-action ml-2 mr-1" data-target="#modal-edit-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->

                                            <!-- Button Remove -->
                                            <a onclick="confirmProductDelete('{{ $product->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <!-- End Button Remove -->
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="details-info">
                                        <p>Quantity</p>
                                        <span>
                                            50

                                            <!-- Button Edit -->
                                            <a onclick="getProductData('{{ $product->id }}')" class="btn-action ml-2 mr-1" data-target="#modal-edit-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->

                                            <!-- Button Remove -->
                                            <a onclick="confirmProductDelete('{{ $product->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <!-- End Button Remove -->
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="details-info">
                                        <p>Price/pcs</p>
                                        <span class="rp-content">
                                            75.000

                                            <!-- Button Edit -->
                                            <a onclick="getProductData('{{ $product->id }}')" class="btn-action ml-2 mr-1" data-target="#modal-edit-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->

                                            <!-- Button Remove -->
                                            <a onclick="confirmProductDelete('{{ $product->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <!-- End Button Remove -->
                                        </span>
                                        <div class="clearfix"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@include('layouts.dashboards-app.modals.modal-edit-attributes')

@endsection