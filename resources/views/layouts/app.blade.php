<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- SEO -->
    {!! SEO::generate(true) !!}
    <!-- SEO -->

    <!-- Icon Logo -->
    <link rel="shortcut icon" href="{{ asset('images/Logo-icon.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/regular.css" integrity="sha384-IG162Tfx2WTn//TRUi9ahZHsz47lNKzYOp0b6Vv8qltVlPkub2yj9TVwzNck6GEF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/brand.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">
    
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/section.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hover-effect-b.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fadein-load.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contact-form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/collapsible.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flexslider.css') }}" rel="stylesheet">
    <!-- /CSS --> 
</head>

<!-- BODY -->
<body class="fade-in one">

    {{-- NAVBAR --}}
    @include('layouts.navbars.navbar')
    {{-- /NAVBAR --}}

    
    {{-- CONTENT --}}
    @yield('content')
    {{-- /CONTENT --}}
    
    
    {{-- MODAL BOX --}}
    @include('layouts.modals.modal-box')
    {{-- /MODAL BOX --}}


    {{-- FOOTER --}}
    @include('layouts.footers.footer')
    {{-- /FOOTER --}}


    {{-- JS --}}
    @include('layouts.scripts.script')
    {{-- /JS --}}
</body>
<!-- /BODY -->
</html>
