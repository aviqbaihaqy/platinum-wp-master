@extends('layouts.app')

@section('content')

<!-- BANNER TITLE -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">INVOICES</h2>
		<hr class="hr-b mt-0">
	</div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION INVOICES -->
<div class="section-invoice">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-xs-12">
                <!-- Cart Header -->
				<div class="shopping-cart-header-checkout">
			      	<i class="fa fa-file-invoice mr-2"></i>My Invoices
			    </div>
				
				<div class="table-responsive no-border">
					<!-- Cart Lists -->
					<table id="datatables" class="table">
	                    <thead>
	                        <tr>
	                            <th>
	                            	<h4 class="title-b">No</h4>
	                            </th>
	                            <th>
	                            	<h4 class="title-b">Date</h4>
	                            </th>
	                            <th>
	                            	<h4 class="title-b">Invoice Code</h4>
	                            </th>
	                            <th>
	                            	<h4 class="title-b">Status</h4>
	                            </th>
	                        </tr>
	                    </thead>

	                    <tbody>
	                        @foreach($invoices as $key => $invoice)
	                            <tr>
	                                <td>
	                                	<h5 class="title-a">{{ $key + 1 }}</h5>
	                                </td>
	                                
	                                <td>
	                                    <h5 class="title-a">
	                                		<i class="fa fa-file-invoice mr-1"></i> {{ Carbon\Carbon::parse($invoice->created_at)->format('d M Y H:i:s') }}
	                                	</h5>
	                                </td>
	                                
	                                <td>
	                                    <h5 class="title-a">{{ $invoice->invoice_code }}</h5>
	                                </td>
	                                
	                                <td>
	                                	<?php
	                                		$invoiceStatus = $invoice->status;
	                                		$status = 'success'; // if shipped

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
										<a href="{{ route('members.viewInvoice', $invoice->id) }}" class="btn btn-d">Details</a>
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
<!-- /SECTION INVOICES -->

@endsection