
<!DOCTYPE Html>
<Html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan Admin Site -- Login</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" >

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/AdminLTE.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin-blue.css')}}" >

    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" >

    <link rel="stylesheet" type="text/css" href="{{asset('admin/mystyle.css')}}" >
    <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/Html5shiv/3.7.0/Html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        body{
            background: url(../admin/img/boxed-bg.jpg) repeat fixed;
            background-image: url(../admin/img/boxed-bg.jpg) repeat;
        }
    </style>
</head>

<body >
    <div class="login-box">
        <!-- Alert -->
        @include('admins._layouts.alert')
        <!-- /Alert -->
        <div class="login-box-body">
            <div class="login-logo">
                <img src="{{ asset('images/logo.png') }}" width="30%" alt="logo" >
            </div>
            <p class="login-box-msg">
                <b>PUSKOPDIT BKCU KALIMANTAN ADMIN SITE</b>
            </p>

            {{ Form::open(array('route' => array('admins.login.post'), 'data-toggle'=>'validator','role'=>'form')) }}
            {!! csrf_field() !!}
            <fieldset>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus','required','data-minlength'=>'5'))}}
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        {{ Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password','required','data-minlength'=>'5'))}}
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            <i class="fa fa-sign-in"></i> Login</button>
                    </div><!-- /.col -->
                </div>
            </fieldset>
            {{ Form::close() }}
        </div>
    </div>
    <!-- jquery -->
    <script type="text/javascript" src="{{ URL::asset('plugins/jQuery/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/BootstrapFormHelper/js/bootstrap-formhelpers.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ URL::asset('js/myscript.js') }}"></script> --}}

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- fastclick for touch browser -->
    <script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- perfect scroll -->
    <script type="text/javascript" src="{{ URL::asset('plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- nice scroll -->
    <script type="text/javascript" src="{{ URL::asset('plugins/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <!-- APP -->
    <script type="text/javascript" src="{{ URL::asset('admin/app.js') }}"></script>
    <!-- form helper -->
    <script type="text/javascript" src="{{ URL::asset('plugins/validator/validator.min.js') }}"></script>

</Html>
