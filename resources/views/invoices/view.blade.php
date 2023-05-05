@extends('layouts.app')

@section('content')

<script type="text/javascript">
	var invoice_id = '{{ $invoice->id }}'

	function checkMidtransPayment(order_id) {
		$.ajax({
            type: 'GET',
            url: '/member/payment/' + order_id + '/status',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var data = JSON.parse($.parseJSON(JSON.stringify(data)));

                var response = data.response
                var invoice = data.invoice

                console.log(response)

                // Change invoice status
                if(invoice.status == 'unpaid' || invoice.status == 'expired') {
                	var invoiceStatus = invoice.status;
	        		var status = 'success';

	        		if(invoiceStatus == 'unpaid' || invoiceStatus == 'expired')
	        			status = 'danger';
	        		else if(invoiceStatus == 'pending' || invoiceStatus == 'pending')
	        			status = 'warning';
	        		else if(invoiceStatus == 'paid')
	        			status = 'primary';

	        		invoiceStatus = invoiceStatus.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	    				return letter.toUpperCase();
					})

	        		$('#invoice-status').attr('class', 'label label-' + status)
	        		$('#invoice-status').text(invoiceStatus)
                }

        		// Populate modal
        		$('#midtransData').empty()
        		var divElements = ''
        		for(var element in response) {
        			divElements += '<div class="details-info">'
        				divElements += '<p>' + element + '</p>'
        				divElements += '<span>' + response[element] + '</span>'
        				divElements += '<div class="clearfix"></div>'
        			divElements += '</div>'
        		}
        		console.log(divElements)
        		$('#midtransData').append(divElements)

        		// For data has been inserted, we need no more back end
        		$('#showMidtransDataModal').removeAttr('onclick')
            }
        })
	}
</script>

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
			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<div id="invoice" class="effect2" id="printableSection">
					<!-- Invoice Header -->
		    		<div id="invoice-top">
				      	<div class="logo">
				      		<img src="{{ asset('images/Logo.png') }}" width="150px" class="mb-3">
				      	</div>
			      		<div class="company-info pull-left">
			      			<h6 class="title-a"><b>HEAD OFFICE</b></h6>
			        		<p class="p-a">Jl. Gatot Subroto Blok 27 no 3C
			        		<br/>
			        		Kawasan Industri Candi
			        		<br/>
			        		Semarang, Jawa Tengah
			        		</p>

			        		<h6 class="title-a mt-3"><b>DUKUNGAN PELANGGAN</b></h6>
			        		<p class="p-a">Hubungi kami melalui whatsapp
			        		<br/>
			        		0823 3320 1320
			        		<br/>
			        		<b>Email</b>: info@platinumwp.co.id
			        		<br/>
			        		<b>www.platinumwp.co.id</b>
			        		</p>
			      		</div>

			      		<div class="company-info  pull-right">
			        		<h6 class="title-a my-0">
					        	<b>To :</b>
					        </h6> 
					        <p class="p-a text-black my-0">
					        	@if($client)
					        		{{ $client->details->first_name }} {{ $client->details->last_name }}
					        	@else
					        		{{ $invoice->client_name }}
					        	@endif	
					        </p>
					        <p class="p-a text-black mt-0">
								Full Address 1
					        </p>

					        @if($client)
						        <p class="p-a">
						        	{{ $client->email }}
						        	</br>
						        	{{ $client->details->phone }}
						        </p>
					        @endif
							

							<h6 class="title-a my-0">
					        	<b>Sales :</b>
					        </h6> 
					        <p class="p-a">
								@if($invoice->inputter)
									{{ $invoice->inputter->details->nip }} - {{ $invoice->inputter->details->first_name }} {{ $invoice->inputter->details->last_name }}
								@else
									-
								@endif
					        </p>

					        <p class="p-a my-0"><b>Invoice Status</b> :
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
                                <span id="invoice-status" class="label label-{{ $status }}">{{ ucfirst($invoiceStatus) }}</span>
								<p class="p-a">
				           			*Payment Due: {{ \Carbon\Carbon::parse($invoice->payment_due)->format('d M Y') }} at<br>
				           			{{ \Carbon\Carbon::parse($invoice->payment_due)->format('H:i') }}
				        		</p>
							</p>
			      		</div>
				    </div>
					
		    		<div id="invoice-bot">
		    			 <div class="client-info pull-right">
							<div class="invoice-title">
				        		<h5 class="title-a mt-4"><b>Invoice</b> {{ $invoice->invoice_code }}</h5>
				      		</div>
				      	</div>
			      		<div class="table-responsive" id="table">
					        <table>
					          	<tr class="bg-gray">
					            	<td class="td-checkout">
					            		<h4 class="title-a">Item Description</h4>
					            	</td>
					            	<td class="td-checkout">
					            		<h4 class="title-a">Price/pcs</h4>
					            	</td>
					            	<td class="td-checkout">
					            		<h4 class="title-a">Qty</h4>
					            	</td>
					            	<td class="td-checkout">
					            		<h4 class="title-a">Notes</h4>
					            	</td>
					            	<td class="td-checkout">
					            		<h4 class="title-a">Total Price</h4>
					            	</td>
					          	</tr>
					          	
					          	@foreach($invoice->items->sortBy('created_at') as $key => $item)
						          	<tr>
						            	<td class="td-checkout">
						            		<p class="p-a">{{ $item->product->name }}</p>
						            	</td>
						            	<td class="td-checkout">
						            		<p class="p-a rp-content">
						            			{{ number_format($item->product->price) }}
						            		</p>
						            	</td>
						            	<td class="td-checkout">
						            		<p class="p-a">{{ $item->amount }}</p>
						            	</td>
						            	<td class="td-checkout">
						            		<p class="p-a">{{ $item->note }}</p>
						            	</td>
						            	<td class="td-checkout">
						            		<p class="p-a rp-content">{{ number_format($item->total) }}</p>
						            	</td>
						          	</tr>
					          	@endforeach

			          			<tr class="tabletitle">
			            			<td></td>
			            			<td></td>
			            			<td></td>
			            			<td>
			            				<h4 class="title-a">Total</h4>
			            			</td>
			            			<td >
			            				<h4 class="title-a rp-content">{{ number_format($invoice->grand_total) }}</h4>
			            			</td>
			          			</tr>

			          			<tr class="tabletitle">
			            			<td>
			            				<h4 class="title-a px-3">Discount</h4>
			            			</td>
			            			<td></td>
			            			<td></td>
			            			<td></td>
			            			<td>
			            				<h4 class="title-a rp-content">{{-- Discount di sini --}}</h4>
			            			</td>
			          			</tr>

			          			<tr class="tabletitle">
			            			<td></td>
			            			<td></td>
			            			<td></td>
			            			<td>
			            				<h4 class="title-a" style="border-bottom: 2px solid #F2F2F2">Grand Total</h4>
			            			</td>
			            			<td >
			            				<h4 class="title-a rp-content">{{ number_format($invoice->grand_total) }}</h4>
			            			</td>
			          			</tr>
			        		</table>
			      		</div>
						
						<div class="row mt-3">
				      		<div class="col-12 col-md-3"> 
								<p class="p-a text-black" style="border: 1px solid black; padding: 10px">
		        					<b>PERHATIAN</b>
		        					<br/>
		        					Barang yang sudah dikirim tidak dapat dikembalikan tanpa adanya perjanjian.
		        				</p>
				      		</div>

				      		<div class="col-12 col-md-3"> 
								<p class="p-a text-black">
		        					<b>Tanda Terima</b>
		        				</p>
				      		</div>

				      		<div class="col-12 col-md-3"> 
								<p class="p-a text-black">
		        					<b>Hormat Kami,</b>
		        				</p>
				      		</div>

				      		<div class="col-12 col-md-3"> 
								<p class="p-a text-black">
		        					Rekening Bank Mandiri
		        					<br/>
		        					<b>PT PLATINUM WIRA PERSADHA</b>
		        					<br/>
		        					No.Rek. 1360032155555
		        				</p>
				      		</div>
				      	</div>
			      		
			      		@if(!$invoice->transaction)
				      		<button class="btn btn-b pull-right mt-3" data-target="#modal-shipping-data" data-toggle="modal">Pay with Midtrans</button>

				      		<button class="btn btn-b pull-right mt-3 mr-2" onclick="printDiv()">
				      			<i class="fa fa-print mr-2"></i>Print
				      		</button>
				      	@elseif($invoice->transaction->payment_method == 'midtrans')
				      		<!-- UPDATE PAYMENT -->
				      			<!-- BUKA MODAL BUAT LIHAT SEMUA STATUS PAYMENT -->
				      			<button id="showMidtransDataModal" onclick="checkMidtransPayment('{{ $invoice->id }}')" class="btn btn-b pull-right mt-3" data-target="#modal-transaction-details" data-toggle="modal">See Transaction Details</button>
				      		<!-- UPDATE PAYMENT -->
				      	@endif	    
					</div>
			    </div>
			</div>
		</div>
	</div>
</div>
<!-- /SECTION INVOICES -->

@endsection