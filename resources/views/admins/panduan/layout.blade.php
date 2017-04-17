<!DOCTYPE Html>
<Html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIMO - Panduan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- icon-->
    <link rel="icon" href="{{asset('images/logo.png')}}" sizes="16x16">
    <link rel="icon" href="{{asset('images/logo.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('images/logo.png')}}"/>
    <link rel="apple-touch-icon" href="{{asset('images/logo.png')}}" sizes="76x76" />
    <link rel="apple-touch-icon" href="{{asset('images/logo.png')}}" sizes="120x120" />
    <link rel="apple-touch-icon" href="{{asset('images/logo.png')}}" sizes="152x152" />
    <link rel="apple-touch-icon" href="{{asset('images/logo.png')}}" sizes="180x180" />
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" >
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/AdminLTE.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin-blue.css')}}" >
    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/panduan/style.css')}}" >
    @yield('css')
    <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/Html5shiv/3.7.0/Html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
<div class="wrapper">
    <?php $versi = "2.1.2"; ?>
    <!-- Header -->
    <header class="main-header">
        <!-- Logo -->
        <!-- Logo -->
        <a class="logo" href="{!! route('panduan') !!}" >
            <span class="logo-mini"><img src="{!! asset('images/logo.png') !!}" width="30" alt="logo"></span>
            <span class="logo-lg"><b>SIMO</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href="#" onclick="printfunc()"><i class="fa fa-print"></i> Print/Cetak</a></li>
            </ul>
          </div>
        </nav>
      </header>
    <!-- /Header -->

    <!-- sidebar -->
    @include('admins.panduan.sidebar')
    <!-- /sidebar -->

    <!-- content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
            Panduan <b>SIMO</b>
            <small>Versi {{ $versi }}</small>
          </h1>
        </div>
        <div class="content body">
            @yield('content')
        </div>    
    </div>
    <!-- /content -->

    <!-- footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <a href="{{ route('admins.version') }}"><b>SIMO</b> {{ $versi }}</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date("Y") }} <a href="#">Puskopdit BKCU Kalimantan</a>.</strong> All rights reserved.
    </footer>
    <!-- /footer -->
</div>

<!-- jquery -->
<script type="text/javascript" src="{{ URL::asset('plugins/jQuery/jquery-1.9.1.min.js') }}"></script>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
<!-- fastclick for touch browser -->
<script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
<!-- APP -->
<script type="text/javascript" src="{{ URL::asset('admin/app.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script>
    function printfunc() {
        window.print();
    }
</script>
@yield('js')
<!-- custom script -->
<script type="text/javascript" src="{{ URL::asset('plugins/panduan/script.js') }}"></script>
</body>
</Html>
