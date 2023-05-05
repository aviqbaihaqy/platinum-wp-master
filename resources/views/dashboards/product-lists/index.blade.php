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
            {{ $subcategory === 'All' ? $subcategory : $subcategory->name }} Product List
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
                            <i class="fa fa-lightbulb mr-2"></i>{{ $subcategory === 'All' ? $subcategory : $subcategory->name }} Product List
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
                        
                    	{{-- Button Add New --}}
                        <a class="btn btn-a mb-3" data-target="#modal-add-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fa fa-plus mr-2"></i>Add New Product
                        </a>

                        <div class="row mt-3">
                            @foreach($products as $key => $product)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="col-product mt-4">
                                    <img src="{{ asset($product->photo->directory) }}" class="img-product-lg mb-2" alt="User Image">
                                    <h4 class="text-black">{{ $product->name }} - {{ $product->product_code }}</h4>

                                    @if(Auth::user()->role == 'admin')
                                        <!-- Button Remove -->
                                        <a onclick="confirmProductDelete('{{ $product->id }}')" class="btn-action pull-right" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <!-- End Button Remove -->
                                    @endif

                                    <!-- Button Edit -->
                                    <a onclick="getProductData('{{ $product->id }}')" class="btn-action pull-right mr-1" data-target="#modal-edit-inventory" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- End Button Edit -->
									
									{{-- Status Stock --}}
                                    <span class="label label-success">{{ ucfirst($product->status) }}</span>

                                    {{-- Product Details --}}
                                    <div class="details">
                                        @foreach($product->attributes as $key => $attribute)
                                            <div class="details-info">
                                                <p>{{ $attribute->attribute_name }}</p>
                                                
                                                <span>
                                                    @foreach($attribute->values as $key => $value)
                                                        {{ $value->value }} 
                                                    @endforeach
                                                </span>
                                                
                                                <div class="clearfix"></div>
                                            </div>
                                        @endforeach
                                    
                                        <!-- Button View Details -->
                                        {{-- <a class="btn btn-a mt-2" data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View">
                                            <i class="fa fa-plus mr-2"></i>View Details
                                        </a> --}}

                                        <a href="{{ route('dashboard.products.showDetail', $product->id) }}" class="btn btn-a mt-2" data-toggle="tooltip" data-placement="bottom" title="View">
                                            <i class="fa fa-plus mr-2"></i>View Details
                                        </a>
                                        <!-- Button View Details -->
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="col-xs-12 pl-0">
                                <div class="pagination">
                                    {{ $products->links('layouts.Pagination.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.dashboards-app.modals.modal-inventories')

@endsection