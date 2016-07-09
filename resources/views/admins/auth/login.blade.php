
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
    <link rel="stylesheet" type="text/css" href="{{asset('admin/AdminLTE.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin-blue.min.css')}}" >

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

            {{ Form::open(array('route' => array('admins.login.post'), 'files' => true)) }}
            {!! csrf_field() !!}
            <fieldset>
                <div class="form-group has-feedback">
                    {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus'))}}
                    <span class="fa fa-user form-control-feedback"></span>
                    {{ $errors->first('username', '<p class="text-warning"><i>:message</i></p>') }}
                </div>
                <div class="form-group has-feedback">
                    {{ Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password'))}}
                    <span class="fa fa-lock form-control-feedback"></span>
                    {{ $errors->first('password', '<p class="text-warning"><i>:message</i></p>') }}
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <div class="row">
                    <div class="col-xs-6">
                        <a href="http://www.puskopditbkcukalimantan.org" class="btn btn-warning btn-block btn-flat"
                           target="_blank"><i class="fa fa-globe"></i> Public Site</a>
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            <i class="fa fa-sign-in"></i> Login</button>
                    </div><!-- /.col -->
                </div>
            </fieldset>
            {{ Form::close() }}
        </div>
    </div>

    <script type="text/javascript" src="{{ URL::asset('admin/jQuery/jQuery-2.1.3.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('admin/app.min.js') }}"></script>

    <!-- fastclick for touch browser -->
    <script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('plugins/BootstrapFormHelper/js/bootstrap-formhelpers.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/myscript.js') }}"></script>

</Html>
