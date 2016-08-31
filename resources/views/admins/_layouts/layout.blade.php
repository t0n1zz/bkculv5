<!DOCTYPE Html>
<Html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" >

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/AdminLTE.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin-blue.min.css')}}" >

    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" >

    @yield('css')

    <link rel="stylesheet" type="text/css" href="{{asset('admin/mystyle.css')}}" >
    <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/Html5shiv/3.7.0/Html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sidebar-collapse hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Header -->
    @include('admins._layouts.header')
            <!-- /Header -->

    <!-- sidebar -->
    @include('admins._layouts.sidebar')
            <!-- /sidebar -->

    <!-- content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /content -->

    <!-- footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0.1
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date("Y") ?> <a href="#">Puskopdit BKCU Kalimantan</a>.</strong> All rights reserved.
    </footer>
    <!-- /footer -->
</div>

<!--modal photos-->
<div class="modal fade" id="modalphotoshow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img class="pointer img-responsive img-rounded center-block" src="" id="modalimage"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                        >Kembali <i class="fa fa-fw fa-chevron-right"></i> </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('admin/jQuery/jQuery-1.9.1.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script>
    var AdminLTEOptions = {
        sidebarExpandOnHover : true,
        sidebarSlimScroll: true
    };
</script>
<script type="text/javascript" src="{{ URL::asset('admin/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/app.min.js') }}"></script>

<!-- fastclick for touch browser -->
<script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>

<!-- form helper -->
<script type="text/javascript" src="{{ URL::asset('plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }}"></script>


@yield('js')
<script>
$(document).ready(function() {
    $(":input").inputmask();
});
</script>

<script type="text/javascript" src="{{ URL::asset('admin/myscript.js') }}"></script>
</body>
</Html>

