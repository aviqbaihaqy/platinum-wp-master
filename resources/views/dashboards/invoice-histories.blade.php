@extends('layouts.dashboards-app.app')

@section('content')

<script type="text/javascript">
    function confirmDeleteInvoice(invoice_id) {
        var deleteUrl = '/dashboard/invoices/' + invoice_id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}');
    }

    function createInvoiceItem(invoice_id) {
        var storeUrl = '/dashboard/invoices/' + invoice_id + '/manually_add_invoice_item'
        console.log(storeUrl)
        $('#addSalesItemManuallyForm').attr('action', storeUrl)
    }

    function storeInvoiceItem() {
        var product_id = $('#addSalesItem_product_id').val()
        var amount = $('#addSalesItem_amount').val()
        var note = $('#addSalesItem_note').val()

        var storeUrl = $('#addSalesItemManuallyForm').attr('action')

        console.log(storeUrl)

        var displayMessage = ''

        $.ajax({
            type: 'POST',
            url: storeUrl,
            cache: false,
            data: {
                '_token': '{{ csrf_token() }}',
                'product_id': product_id,
                'amount': amount,
                'note': note,
            },
            dataType: 'JSON',
            success: function(data) {
                var response = JSON.parse($.parseJSON(JSON.stringify(data)))
                var status = response.status
                var message = response.message

                console.log(response.invoice_item)

                $('#addSalesItem_flashStatus').empty()
                if(status == 'error') {
                    displayMessage += '<div class="alert alert-danger">'
                        displayMessage += message
                    displayMessage += '</div><br/>'
                } else {
                    displayMessage += '<div class="alert alert-success">'
                        displayMessage += message
                    displayMessage += '</div><br/>'
                }
                console.log(displayMessage)
                $('#addSalesItem_flashStatus').append(displayMessage)

                $('#addSalesItem_amount').val('')
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#addSalesItem_flashStatus').empty()

                console.log(jqXHR.responseText)

                var response = JSON.parse($.parseJSON(JSON.stringify(jqXHR)))
                var errorText = response.responseText

                displayMessage += '<div class="alert alert-danger">'
                    displayMessage += errorText.message
                    displayMessage += errorText.file
                displayMessage += '</div><br/>'

                $('#addSalesItem_flashStatus').append(displayMessage)
            }
        })
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
                        divElement += '<span>' + attributes[loop].value.value + '</span>'
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
                // console.log(divElement)
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
            Invoice History
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- Card Box --}}
        @include('dashboards.widgets.card-box')

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                    	{{-- Title --}}
                        <h3 class="box-title text-black">
                            <i class="fa fa-file-invoice mr-2"></i>Invoice Histories
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
                        <div class="table-responsive no-border">

                            {{-- Button Add New --}}
                            <a class="btn btn-a mb-3" data-target="#modal-add-sales" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                                <i class="fa fa-plus mr-2"></i>Add New Invoice
                            </a>

                        	{{-- Table --}}
                            <table id="datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Invoice Code</th>
                                        <th>Shipping Code</th>
                                        <th>Courier Expedition</th>
                                        <th>Gross Total</th>
                                        <th>Discount</th>
                                        <th>Grand Total</th>
                                        <th>Client</th>
                                        <th>Sales</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($invoices as $key => $invoice)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            
                                            <td>
                                                {{ Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}
                                            
                                            </td>
                                            
                                            <td>
                                                <a onclick="getInvoiceDetails('{{ $invoice->id }}')" data-target="#modal-view-invoice" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                    {{ $invoice->invoice_code }}
                                                </a>
                                            </td>
                                            
                                            <td>
                                                {!! $invoice->shipping ? $invoice->shipping->shipping_code : '<b>PLEASE PROCESS THIS SALE!</b>' !!}
                                            </td>
                                            <td>
                                                {!! $invoice->shipping ? $invoice->shipping->courier : '<b>PLEASE PROCESS THIS SALE!</b>' !!}
                                            </td>

                                            <td>
                                                {{ number_format($invoice->grand_total + $invoice->discount) }}
                                            </td>

                                            <td>
                                                {{ number_format($invoice->discount) }}
                                            </td>

                                            <td>
                                                {{ number_format($invoice->grand_total) }}
                                            </td>
                                            
                                            <td>
                                                @if($invoice->client)
                                                    <a onclick="getUserInvoiceDetails('{{ $invoice->user_id }}')" data-target="#modal-view-client" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                        {{ $invoice->client->details->first_name }} {{ $invoice->client->details->last_name }}
                                                    </a>
                                                @else
                                                    {{ $invoice->client_name }}
                                                @endif
                                            </td>

                                            <td>
                                                {{ $invoice->sales_name }}
                                            </td>

                                            <td>
                                                <?php
                                                    $invoiceStatus = $invoice->status;
                                                    $status = 'success';

                                                    if($invoiceStatus == 'unpaid' || $invoiceStatus == 'expired')
                                                        $status = 'danger';
                                                    elseif($invoiceStatus == 'pending' || $invoiceStatus == 'pending')
                                                        $status = 'warning';
                                                    elseif($invoiceStatus == 'paid')
                                                        $status = 'primary';
                                                ?>
                                                <span class="label label-{{ $status }}">{{ ucfirst($invoiceStatus) }}</span>
                                            </td>
                                            
                                            <td>
                                                <!-- Button Add -->
                                                <a onclick="createInvoiceItem('{{ $invoice->id }}')" class="btn-action mr-1" data-target="#modal-add-product-sales" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add Product" style="cursor: pointer">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <!-- End Button Add -->

                                                <!-- Button Edit -->
                                                <a onclick="insertShippingCode('{{ $invoice->id }}')" class="btn-action mr-1" data-target="#modal-edit-sales" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- End Button Edit -->
                                                @if(Auth::user()->role == 'admin')
                                                    <a href="{{ route('members.viewInvoice', $invoice->id) }}" target="_blank" class="btn-action">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <!-- Button Remove -->
                                                    <a onclick="confirmDeleteInvoice('{{ $invoice->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <!-- End Button Remove -->
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.dashboards-app.modals.modal-sales')
@include('layouts.dashboards-app.modals.modal-invoice-details')

@endsection