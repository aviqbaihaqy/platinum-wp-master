@extends('layouts.dashboards-app.app')

@section('content')

<script type="text/javascript">
    function confirmDeleteInvoice(invoice_id) {
        var deleteUrl = '/dashboard/invoices/' + invoice_id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}');
    }

    function insertShippingCode(invoice_id) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/invoices/' + invoice_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var invoice = JSON.parse($.parseJSON(JSON.stringify(data)))

                console.log(invoice)

                $('#invoiceDate').val(invoice.created_at)
                $('#invoiceCode').val(invoice.invoice_code)
                $('#clientId').attr('value', invoice.user_id)
                $('#invoiceStatus').val(invoice.status)

                var url = '/dashboard/invoices/' + invoice.id + '/update_shipping'
                $('#insertShipping').attr('action', url)

                console.log(url)
            }
        })
    }

    function getProductData(productId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + productId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)))
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
                $('#viewProductAttributes').append(divElement) // fill with new items
            }
        })
    }

    function getInvoiceDetails(invoice_id) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/invoices/' + invoice_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var invoice = JSON.parse($.parseJSON(JSON.stringify(data)));
                var invoiceItems = invoice.items

                console.log(invoice)

                var divElement = ''
                $('#invoiceDetailsBody').empty() // empty the div
                for(var loop = 0; loop < invoiceItems.length; loop++) {
                    var item = invoiceItems[loop]
                    var shippingCode = invoice.shipping
                    if(!shippingCode) 
                        shippingCode = 'NOT INPUTTED'
                    else
                        shippingCode = shippingCode.shipping_code
                    var product = item.product
                    var subcategory = product.subcategory
                    var category = product.category

                    divElement += '<tr>'
                        // Index
                        divElement += '<td>' + (loop + 1) + '</td>'

                        // Shipping Code
                        divElement += '<td>' + shippingCode + '</td>'
                        
                        // Product Code
                        divElement += '<td>'
                            divElement += `<a onclick="getProductData('` + product.id + `')" data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">`
                                divElement += product.product_code
                            divElement += '</a>'
                        divElement += '</td>'

                        // Product Name
                        divElement += '<td>'
                            divElement += `<a onclick="getProductData('` + product.id + `')" data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">`
                                divElement += product.name
                            divElement += '</a>'
                        divElement += '</td>'

                        // Subcategory Name
                        divElement += '<td>'
                            divElement += subcategory.name
                        divElement += '</td>'

                        // Category Name
                        divElement += '<td>'
                            divElement += category.name
                        divElement += '</td>'

                        // Quantity
                        divElement += '<td>' + item.amount + '</td>'

                        // Total
                        divElement += '<td class="rp-content">' + item.total + '</td>'
                    divElement += '</tr>'
                }
                console.log(divElement)
                $('#invoiceDetailsBody').append(divElement) // fill with new items
            }
        })
    }

    function getUserInvoiceDetails(user_id) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/user/' + user_id + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var result = JSON.parse($.parseJSON(JSON.stringify(data)));

                var user = result.selectedUser
                var profile = user.profile

                console.log(user)

                $('#clientName').text(profile.first_name + ' ' + profile.last_name)
                $('#clientAddress').text(profile.address)
                $('#clientEmail').text(user.email)
                $('#clientPhone').text(profile.phone)
                $('#clientCompany').text(profile.company)
            }
        })
    }
</script>

<div class="content-wrapper">
    <section class="content-header pt-3">
    	{{-- Title --}}
        <h1 class="text-black">
            Sales History
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- Card Box --}}
        @include('dashboards.widgets.card-box')

        <div class="row ">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                    	{{-- Title --}}
                        <h3 class="box-title text-black">
                            <i class="fa fa-clock mr-2"></i>Sales History
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        <!-- <a class="btn btn-a mb-3" data-target="#modal-add-sales" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fa fa-plus mr-2"></i>Place New Order
                        </a> -->
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-2">
                            	{{-- Sorting Dropdown --}}
                                <div id="toolbar">
                                    <select class="form-control">
                                        <option value="all">All</option>
                                        <option value="week">Week</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive no-border" id="printableSection">
                            <a id="export-link" style="display:none;"></a>
                            {{-- Table --}}
                            <table id="datatables" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Invoice Code</th>
                                        <th>Shipping Code</th>
                                        <th>Client</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($sales as $key => $sale)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d M Y') }}</td>
                                            <td>
                                                <a onclick="getInvoiceDetails('{{ $sale->id }}')" data-target="#modal-view-invoice" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                {{ $sale->invoice_code }}
                                                </a>
                                            </td>
                                            <td>{{ $sale->shipping ? $sale->shipping->shipping_code : null }}</td>
                                            <td>
                                                <a onclick="getUserInvoiceDetails('{{ $sale->user_id }}')" data-target="#modal-view-client" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                    @if($sale->client)
                                                        {{ $sale->client->details->first_name }} {{ $sale->client->details->last_name }}
                                                    @else
                                                        {{ $sale->client_name }}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <!-- Button Edit -->
                                                <a onclick="insertShippingCode('{{ $sale->id }}')" class="btn-action mr-1" data-target="#modal-edit-sales" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- End Button Edit -->
                                                
                                                @if(Auth::user()->role == 'admin')
                                                    <!-- Button Remove -->
                                                    <a onclick="confirmDeleteInvoice('{{ $sale->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <!-- End Button Remove -->
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <!-- Export to Excel Button -->
                            <button type="button" class="btn btn-a mr-2" onclick="tableToExcel('datatables', 'name', 'saleshistory.xls')">
                                <i class="fa fa-file-export mr-2"></i>Export
                            </button>

                            <!-- Print Report Button -->
                            <button type="button" class="btn btn-a" onclick="printDiv()">
                                <i class="fa fa-print mr-2"></i>Print Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <!-- LINE CHART -->
                <div class="box">
                    <div class="box-header with-border">
                    	{{-- Title --}}
                        <h3 class="box-title">Sales Line Chart</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                    	{{-- Box Line Chart --}}
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.dashboards-app.modals.modal-sales')
@endsection