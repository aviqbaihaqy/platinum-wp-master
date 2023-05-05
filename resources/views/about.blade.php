@extends('layouts.app')

@section('content')

<!-- BANNER TITLE -->
<div class="banner-top">
	<div class="container px-md-3 px-xl-6">
		<h2 class="title-a text-white">ABOUT US</h2>
	</div>
</div>
<!-- /BANNER TITLE -->


<!-- SECTION HISTORY -->
<div class="section-history">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-0">
				<img src="{{ asset('images/platinumwp-1.jpg') }}" width="100%" class="img-responsive">
			</div>

			<div class="col-xs-12 col-md-8 col-border-gray mt-lg-4">
				<h3 class="title-a text-black">Our Profile</h3>
				<h4 class="title-b text-black mt-3">CV Anugerah Pratama adalah perusahaan yang berdiri sejak 1 September 2018 dan bergerak di bidang distribusi dan manufaktur lampu khususnya yang berbasis LED ( Light Emitting Diode ).</h4>
				<p class="p-a text-black mt-3">
					Seiring dengan perkembangan teknologi dan inovasi dalam industri penerangan dunia, kami ingin menawarkan solusi untuk kebutuhan lampu indoor dan outdoor di Indonesia untuk menggantikan lampu yang lebih konvensional seperti CFL, Merkurius, Halogen, atau jenis pencahayaan lainnya.
				</p>

				<p class="p-a text-black mt-3">
					Produk-produk kami telah dilengkapi dengan fitur Low Heat Generation, Shock Proof, Long Life Time dan Very Low Power Consumption.
				</p>

				<p class="p-a text-black mt-3">
					Kami selalu berkomitmen untuk memberikan produk inovatif dengan teknologi yang terbaru dan kualitas terbaik. Produk yang beragam, waktu pengiriman yang cepat, rasio harga dan performa yang luar biasa menjadikan kami mitra ideal beberapa client kami.
				</p>
			</div>
		</div>
	</div>
</div>
<!-- /SECTION HISTORY -->


<!-- SECTION VISION MISION -->
<div class="section-vision-mision">
	<div class="container px-md-3 px-xl-6">
		<div class="row">
			<div class="col-md-6">
				<h3 class="title-a text-black">Vision</h3>
				<p class="p-a text-black mt-3">Menjadi perusahaan yang profesional, terkemuka, dan terdepan dalam industri lampu yang fokus kepada pengalaman konsumen dan berjuang untuk berinovasi menjadi yang terbaik, sehingga dapat menjadikan Indonesia sebagai manufaktur lampu terbesar di Asia Tenggara.</p>
			</div>

			<div class="col-md-6 mt-lg-4">
				<h3 class="title-a text-black">Mission</h3>
				<p class="p-a text-black mt-3">Maju sebagai perusahaan Indonesia yang menyediakan produk-produk berkualitas dengan nilai tambah dan harga terjangkau, serta mengutamakan kepuasan konsumen sebagai prioritas utama.</p>
			</div>
		</div>
	</div>
</div>
<!-- /SECTION VISION MISION -->

@endsection