@extends('layouts.dashboards-app.app')

@section('content')

<script type="text/javascript">
    function getProductData(productId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + productId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));

                console.log(product)

                // $('#edit_product_photo').val()
                
                $('#edit_product_code').val(product.product_code)
                $('#edit_product_name').val(product.name)
                $('#edit_product_subcategory_id select').val(product.subcategory_id)
                $('#edit_product_buying_price').val(product.buying_price)
                $('#edit_product_price').val(product.price)
                $('#edit_product_amount').val(product.stock.amount)
                $('#edit_product_status').val(product.status)
                $('#edit_product_description').val(product.description)

                // change url value
                var url = '/dashboard/products/' + product.id
                $('#productUpdateForm').attr('action', url)
            }
        })
    }

    function viewProduct(productId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + productId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));
                var photo = product.photo
                var attributes = product.attributes

                console.log(product)

                $('#viewProductImage').attr('src', '/' + photo.directory)
                $('#viewProductTitle').text(product.name + ' - ' + product.product_code)
                $('#viewProductBuyingPrice').text(product.buying_price)
                $('#viewProductPrice').text(product.price)
                $('#viewProductProfit').text(product.price - product.buying_price)

                $('#viewProductStatus').val(product.status)
                if(product.status == 'available')
                    $('#viewProductStatus').attr('class', 'label label-success')
                else
                    $('#viewProductStatus').attr('class', 'label label-danger')

                var divElement = ''
                $('#viewProductAttributes').empty() // empty the div
                for(var loop = 0; loop < attributes.length; loop++) {
                    divElement += '<div class="details-info"><p>' + attributes[loop].attribute_name + '</p>'
                        divElement += '<span>' + attributes[loop].values[0].value + '</span>'
                        divElement += '<div class="clearfix"></div>'
                    divElement += '</div>'
                }
                $('#viewProductAttributes').append(divElement)
            }
        })
    }

    function confirmProductDelete(productId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + productId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));

                var deleteUrl = '/dashboard/products/' + product.id

                console.log(deleteUrl)

                $('#delete_form').attr('action', deleteUrl)
                $('#csrf_delete').val('{{ csrf_token() }}');
            }
        })
    }
</script>

<div class="content-wrapper">
    <section class="content-header pt-3">
    	{{-- Title --}}
        <h1 class="text-black">
            Inventories
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
                            <i class="fa fa-box mr-2"></i>Inventories
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                    	{{-- Button Add New --}}
                        <a class="btn btn-a mb-3" data-target="#modal-add-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fa fa-plus mr-2"></i>Add New Inventory
                        </a>

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

                        <div class="table-responsive no-border" id="printableSection">
                        	{{-- Table --}}
                            <table id="datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Price/pcs (Modal)</th>
                                        <th>Price/pcs (Sales)</th>
                                        <th>Profit</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a onclick="viewProduct('{{ $product->id }}')" data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer;">
                                            {{ $product->product_code }}
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="viewProduct('{{ $product->id }}')" data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer;">
                                            {{ $product->name }}
                                            </a>
                                            <br/>
                                            @if($product->photo)
                                                <img src="{{ asset($product->photo->directory) }}" class="img-product-sm mb-2" alt="User Image">
                                            @endif
                                        </td>

                                        <td class="rp-content">Rp. {{ number_format($product->buying_price) }}</td>
                                        <td class="rp-content">Rp. {{ number_format($product->price) }}</td>
                                        <td class="rp-content">Rp. {{ number_format($product->price - $product->buying_price) }}</td>

                                        <td>
                                            @if($product->stock)
                                                {{ $product->stock->amount }}
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($product->status == 'available')
                                                <span class="label label-success">Available</span>
                                            @else
                                                <span class="label label-danger">Unavailable</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Button Edit -->
                                            <a class="btn-action mr-1" data-target="#modal-edit-inventory" onclick="getProductData('{{ $product->id }}')" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->
                                            
                                            @if(Auth::user()->role == 'admin')
                                                <!-- Button Remove -->
                                                <a onclick="confirmProductDelete('{{ $product->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <!-- End Button Remove -->
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Print Report Button -->
                            <button type="button" class="btn btn-a" onclick="printDiv()">
                                <i class="fa fa-print mr-2"></i>Print Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@include('layouts.dashboards-app.modals.modal-inventories')

@endsection