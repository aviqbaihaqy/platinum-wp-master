@extends('layouts.app')

@section('content')


<!-- BANNER TITLE -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">CONTACT US</h2>
	</div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION CONTACT -->
<div class="section-contact">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-sm-7 col-md-6 animated wow fadeInLeft" data-wow-delay=".5s">
				<h3 class="title-a text-black">Leave us a message</h3>
				
				<!-- Contact Form -->
				<div class="containerform">
					<form action="{{ route('contact.post') }}" method="post">
					  	<div class="row">
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
					    	<div class="col-xs-12 col-sm-6">
					    		@csrf

					    		<label for="name">Name</label>
					    		<input type="text" id="name" name="name" class="form-control" required>
					  		</div>

					  		<div class="col-xs-12 col-sm-6">
					    		<label for="email">Email</label>
					    		<input type="text" id="email" name="email" class="form-control" required>
					  		</div>
					  	</div>

					  	<label for="messages">Feedback</label>
					  	<textarea id="messages" name="feedback" class="form-control" required style="height: 160px; background-color: #F2F2F2; border: none;"></textarea>

					  	<input id="submit" type="submit" value="Submit" onclick="myFunctionpopup()">
					</form>
				</div>
			</div>
			
			<div class="col-sm-5 col-md-5 col-md-offset-1 contact-info">
				<!-- Contact Information -->
				<h3 class="title-a text-black mt-lg-4">Contact Info</h3>
				<ul class="mt-4 mt-lg-3">
					<li><i class="fas fa-map-marker-alt mr-1 text-black"></i>Office Address
					<h5 class="title-b text-black mt-2">Jl. Raya Gondang KM 37 Cepiring<br>
					Kendal, Jawa Tengah
					</h5></li>

					<li class="foot-mid"><i class="fas fa-envelope mr-1 text-black"></i>Email
					<h5 class="title-b text-black mt-2"><a href="mailto:info@platinumwp.co.id">info@platinumwp.co.id</a></h5>
					</li>

					<li><i class="fas fa-phone mr-1 text-black"></i>Phone/Fax
					<h5 class="title-b text-black mt-2">(024) 762-7102</h5></li>
				</ul>
			</div>
			
			<div class="col-xs-12 mt-5">
				<!-- Maps -->
				<div class="map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3235.689619368146!2d110.13482899797765!3d-6.931499205244298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e704334161d269f%3A0x3d59524e9c950230!2sJl.+Raya+Gondang%2C+Gondang%2C+Cepiring%2C+Kabupaten+Kendal%2C+Jawa+Tengah!5e0!3m2!1sid!2sid!4v1550636169974" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /SECTION CONTACT -->


<!-- SECTION FAQ -->
<div class="section-faq">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="title-a text-black">Tanya Jawab</h3>
				<h5 class="title-b text-black mb-3">Pelajari lebih lanjut Kolom Tanya jawab kami, untuk mengatasi kendala anda.</h5>

				@foreach($faqs as $key => $faq)
				<details>
				  	<summary>
				    	<h4 class="title-a text-black">{{ $key + 1 }}: {{ $faq->question }}</h4>
				  	</summary>
				  	<p class="text-left">
				  		{{ $faq->answer }}
				  	</p>
				</details>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- /SECTION FAQ -->

@endsection