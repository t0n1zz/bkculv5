<?php 
$style = Auth::user()->getStyle();;
?>
<!DOCTYPE Html>
<Html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIMO</title>
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
    <!-- pace -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('plugins/pace/pace.css')}}" > --}}
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

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <!-- Header -->
    @if($style == "0")
        @include('admins._layouts.header-top')
    @else
        @include('admins._layouts.header')
    @endif
    <!-- /Header -->

    <!-- sidebar -->
    @if($style != "0")
        @include('admins._layouts.sidebar')
    @endif
    <!-- /sidebar -->

    <!-- content -->
    <div class="content-wrapper">
        <br/>
        @yield('content')
    </div>
    <!-- /content -->

    <!-- footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <a href="{{ route('admins.version') }}"><b>SIMO</b> 2.1.2</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date("Y") }} <a href="#">Puskopdit BKCU Kalimantan</a>.</strong> All rights reserved.
    </footer>
    <!-- /footer -->
</div>

@if(!Request::is('admins'))
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
<!--modal photos-->
<!-- Hapus -->
@if(!empty($datas))
<div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas,array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash fa-fw"></i> <span id="modalhapus_judul"></span></h4>
            </div>
            <div class="modal-body">
                <h4 style="font-size: 16px" id="modalhapus_detail"></h4>
                <input type="text" name="id" value="" id="modalhapus_id" hidden="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash fa-fw"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
@endif
<!-- /Hapus -->
<!-- warning -->
<div class="modal fade" id="modalwarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-yellow-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-warning fa-fw"></i> Oopss</h4>
            </div>
            <div class="modal-body">
                <h4>Silahkan pilih data terlebih dahulu di tabel</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-check fa-fw"></i> ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /warning -->
@endif
<!-- signout -->
<div class="modal fade" id="modalsignout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-aqua-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-sign-out fa-fw"></i> Sign Out</h4>
            </div>
            <div class="modal-body">
                <h4>Anda yakin ingin keluar / menutup aplikasi ini?</h4>
            </div>
            <div class="modal-footer">
                <a href="{{ route('admins.logout') }}" class="btn btn-info" ><i class="fa fa-check fa-fw"></i> Ya</a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tidak</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /signout -->
<!-- check -->
<div class="modal fade" id="modalcheckpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.admin.check_password'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-aqua-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-warning fa-fw"></i> Password</h4>
            </div>
            <div class="modal-body">
                <h4>Mohon masukkan kembali password anda</h4>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::password('password_now',array('class' => 'form-control','id'=>'password_now', 'placeholder' => 'Password','required','data-minlength'=>'5'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tidak</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /check -->
<!-- jquery -->
<script type="text/javascript" src="{{ URL::asset('plugins/jQuery/jquery-1.9.1.min.js') }}"></script>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
<!-- fastclick for touch browser -->
<script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
<!-- pace -->
{{-- <script type="text/javascript" src="{{ URL::asset('plugins/pace/pace.min.js') }}"></script> --}}
<!-- APP -->
<script type="text/javascript" src="{{ URL::asset('admin/app.js') }}"></script>
<!-- form helper -->
<script type="text/javascript" src="{{ URL::asset('plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/validator/validator.min.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script>
   {{--  $(document).ready(
        function() {
            $("html").niceScroll({
                cursorwidth : 7,
                cursorcolor : '#3c8dbc'
            });
        }
    ); --}}
    {{-- var AdminLTEOptions = {
        sidebarExpandOnHover : true,
        sidebarSlimScroll: true
    }; --}}
    // To make Pace works on Ajax calls
   {{--  $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    }); --}}
    // input mask
    $(":input").inputmask();

    //modal autofocus
    $('#modalcheckpass').on('shown.bs.modal', function () {
       $('#password_now').focus();
    })
</script>
@yield('js')
@yield('js2')
@yield('jsnotif')
<!-- custom script -->
<script type="text/javascript" src="{{ URL::asset('admin/myscript.js') }}"></script>
</body>
</Html>
