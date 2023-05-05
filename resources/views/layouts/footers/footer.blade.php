<!-- FOOTER -->
<div class="footer">
    <div class="container px-md-3 px-xl-6">
        <div class="footer-top">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="title-a text-white mt-0">Memiliki Pertanyaan Tentang Produk Kami?</h3>
                    <p class="p-a text-white">Sedang mencari jawaban, ingin mendapatkan solusi, atau hanya sekedar memberikan masukan atas kinerja kami? Kami disini untuk membantu anda. Silahkan menghubungi kami melalui jalur komunikasi berikut.</p>
                    <a href="{{ route('contact') }}" class="btn-c mt-2">Contact Us</a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="footer-grid">
            <div class="row">
                <div class="col-md-4 footer-grid">
                    <h3>Contact Info</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Raya Gondang KM 37 Cepiring<br>
                        Kendal, Jawa Tengah</li>
                        <li class="foot-mid"><i class="fas fa-envelope mr-2"></i><a href="mailto:info@platinumwp.co.id">info@platinumwp.co.id</a></li>
                        <li><i class="fas fa-phone mr-2"></i>(024) 762-7102</li>
                        <li>Whatsapp : 0823-3320-1320</li>
                    </ul>
                </div>

                <div class="col-md-3 footer-grid">
                    <h3>Other Links</h3>
                    <ul>
                        <li class="pb-2"><a href="{{ route('contact') }}" class="link-b">FAQ</a></li>
                        <li class="pb-2"><a href="{{ route('terms') }}" class="link-b">Terms and Conditions</a></li>
                        <li class="pb-2"><a href="{{ route('terms') }}" class="link-b">Payment</a></li>
                    </ul>
                </div>

                {{-- <div class="col-md-3 footer-grid">
                    <h3>Visitors</h3>
                    <ul>
                        <li class="pb-2">Visitors Count: {{ count($visitors) }}</li>
                        <li class="pb-2">Visitors Hits: {{ $visitors->sum('hits') }}</li>
                    </ul>
                </div> --}}
                
                <div class="col-md-5 footer-grid">
                <h3>Maps</h3>
                     <iframe class="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3235.689619368146!2d110.13482899797765!3d-6.931499205244298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e704334161d269f%3A0x3d59524e9c950230!2sJl.+Raya+Gondang%2C+Gondang%2C+Cepiring%2C+Kabupaten+Kendal%2C+Jawa+Tengah!5e0!3m2!1sid!2sid!4v1550636169974" frameborder="0" style="border:0" allowfullscreen></iframe>

                     <p><a id="back2Top" title="Back to Top" href="#"><i class="fas fa-arrow-circle-up mr-2"></i>Back to top</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        
        <div class="copy-right" data-wow-delay=".5s">
            <p>&copy 2019 Platinum Wira Persadha</p>
            {{-- <h6 class="title-a text-white text-center mt-5">Designed by <a class="link-a" href="https://decodesmedia.com" target="_blank">Decode's Media</a></h6> --}}
        </div>
    </div>
</div>
<!-- /FOOTER -->