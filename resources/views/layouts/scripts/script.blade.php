<!-- SCRIPTS -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/simpleCart.min.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script>
 new WOW().init();
</script>
<script type="text/javascript">
    $(window).load(function() {
    $("#featured").featured({
            visibleItems: 1,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 5000,            
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: { 
                portrait: { 
                    changePoint:480,
                    visibleItems: 1
                }, 
                landscape: { 
                    changePoint:640,
                    visibleItems: 1
                },
                tablet: { 
                    changePoint:768,
                    visibleItems: 1
                }
            }
        });
    });
</script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        items : 3,
        lazyLoad : false,
        autoPlay : true,
        navigation : false,
        navigationText :  true,
        pagination : false,
      });
    });
</script>
<script src="{{ asset('js/jquery.flexslider.js') }}"></script>
<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
<script src="{{ asset('js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function () {
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion           
        width: 'auto', //auto or any width like 600px
        fit: true   // 100% fit in a container
    });
});
</script>
<script type="text/javascript" src="{{ asset('js/imagezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.featured.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/backtotop-button.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/quantity-box.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/printable.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- /SCRIPTS -->

