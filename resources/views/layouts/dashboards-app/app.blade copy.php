<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Platinum Wira Persadha | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Icon Logo -->
    <link rel="shortcut icon" href="{{ asset('dashboard-assets/dist/img/Logo-icon.png') }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/regular.css" integrity="sha384-IG162Tfx2WTn//TRUi9ahZHsz47lNKzYOp0b6Vv8qltVlPkub2yj9TVwzNck6GEF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/bower_components/Ionicons/css/ionicons.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Morris charts -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/bower_components/morris.js/morris.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/dist/css/main-dashboard.css') }}">
    <!-- Skins -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/dist/css/skins/_all-skins.css') }}">
    <!-- Editors-->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-black sidebar-mini fixed">
    
    {{-- HEADER NAVBAR --}}
    @include('layouts.dashboards-app.navbars.header-navbar')
    {{-- /HEADER NAVBAR --}}

    
    {{-- SIDEBAR --}}
    @include('layouts.dashboards-app.sidebars.sidebar')
    {{-- /SIDEBAR --}}


    {{-- CONTENT --}}
    @yield('content')
    {{-- /CONTENT --}}
    
    
    {{-- MODAL BOX --}}
    @include('layouts.dashboards-app.modals.modal-product-lists')
    @include('layouts.dashboards-app.modals.modal-delete')
    {{-- /MODAL BOX --}}


    {{-- FOOTER --}}
    @include('layouts.dashboards-app.footers.footer')
    @include('layouts.dashboards-app.modals.modal-users-management')
    {{-- /FOOTER --}}


    {{-- JS --}}
    @include('layouts.dashboards-app.scripts.script')
    {{-- /JS --}}
</body>
</html>