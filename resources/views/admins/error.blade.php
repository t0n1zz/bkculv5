<?php $title="Error" ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan Admin Site </title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('admin/css/bootstrap.min.css') }}

    <!-- MetisMenu CSS -->
    {{ HTML::style('admin/css/plugins/metisMenu/metisMenu.min.css') }}

    <!-- DataTables CSS -->
    {{ HTML::style('admin/css/plugins/dataTables.bootstrap.css') }}

    <!-- Custom CSS -->
    {{ HTML::style('admin/css/sb-admin-2.css') }}

    <!-- Custom Fonts -->
    {{ HTML::style('admin/font-awesome-4.1.0/css/font-awesome.min.css') }}

    <!-- Bootstrap extended form CSS -->
    {{ HTML::style('BootstrapFormHelper/css/bootstrap-formhelpers.min.css') }}



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default  navbar-static-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admins') }}">
                <img class="img-responsive pull-left"
                     src="{{ asset('images/logo.png') }}" width="23" height="23"
                     alt="Logo Puskopdit BKCU Kalimantan"> &nbsp Puskopdit BKCU Kalimantan
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- alert -->
            <?php
            if(Auth::check()) { $id = Auth::user()->getId();}
            $admin = Admin::find($id);
            $date = new Date($admin->logout);
            ?>
            <li class="dropdown">
                <a href="#" style="cursor: default">
                    <i class="fa fa-clock-o fa-fw"></i>  Terakhir login pada : {{ $date->format('d/n/Y, H:i') }}
                </a>
            </li>
            <!-- /alert -->
            <!-- user -->
            <li class="dropdown">
                <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Profil</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Pengaturan</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>-->

                <a href="{{ route('admins.logout') }}">
                    <i class="fa fa-sign-out fa-fw"></i>  Logout</i>
                </a>
            </li>
            <!-- /user -->
        </ul>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!-- search -->
                    <!--<li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </li>-->
                    <!-- /search -->
                    <!-- dashboard -->
                    <li>
                        <a @if($title == "Dashboard")
                            {{ "class='active'" }}
                                    @endif
                                    href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <!-- /dashboard -->
                    <!-- pengumuman -->
                    <li><a  @if($title == "Kelola Pengumuman")
                            {{ "class='active'" }}
                                    @endif
                                    href="{{ route('admins.pengumuman.index') }}"><i class="fa fa-comments-o fa-fw"></i> Pengumuman</a>
                    </li>
                    <!-- /pengumuman -->
                    <!-- info gerakan -->
                    <li>
                        <a  @if($title == "Informasi Gerakan")
                            {{ "class='active'" }}
                                    @endif
                                    href="{{ route('admins.infogerakan.edit',array(1)) }}"><i class="fa fa-exclamation-circle fa-fw"></i> Informasi Gerakan</a>
                    </li>
                    <!-- /info gerakan -->
                    <!-- artikel -->
                    <li @if($title == "Kelola Artikel" || $title == "Tambah Artikel" || $title == "Ubah Artikel" ||
                    $title == "Kelola Kategori Artikel")
                        {{ "class='active'" }}
                            @endif
                            ><a href="#"><i class="fa fa-book fa-fw"></i> Artikel<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  @if($title == "Tambah Artikel")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.artikel.create') }}"><i class="fa fa-plus"></i> Tambah Artikel</a>
                            </li>
                            <li>
                                <a  @if($title == "Kelola Artikel")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.artikel.index') }}"><i class="fa fa-archive"></i> Kelola Artikel</a>
                            </li>
                            <li>
                                <a  @if($title == "Kelola Kategori Artikel")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.kategoriartikel.index') }}"><i class="fa fa-archive"></i> Kelola Kategori Artikel</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /artikel -->
                    <!-- pelayanan -->
                    <li @if($title == "Kelola Pelayanan" || $title == "Tambah Pelayanan" || $title == "Ubah Pelayanan" ||
                    $title == "Tambah Kantor Pelayanan" || $title == "Kelola Kantor Pelayanan" || $title == "Ubah Informasi Kantor Pelayanan")
                        {{ "class='active'" }}
                            @endif
                            ><a href="#"><i class="fa fa-gift fa-fw"></i> Pelayanan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  @if($title == "Tambah Pelayanan")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.pelayanan.create') }}"><span class="fa fa-plus"></span> Tambah Pelayanan</a>
                            </li>
                            <li>
                                <a @if($title == "Tambah Kantor Pelayanan")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.kantorpelayanan.create') }}"><span class="fa fa-plus"></span> Tambah Kantor Pelayanan</a>
                            </li>
                            <li>
                                <a  @if($title == "Kelola Pelayanan")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.pelayanan.index') }}"><span class="fa fa-archive"></span> Kelola Pelayanan</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola Kantor Pelayanan")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.kantorpelayanan.index') }}"><span class="fa fa-archive"></span> Kelola Kantor Pelayanan</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /pelayanan -->
                    <!-- diklat -->
                    <li @if($title == "Kelola Kegiatan" || $title == "Tambah Kegiatan" || $title == "Ubah Kegiatan" )
                        {{ "class='active'" }}
                            @endif
                            ><a href="#"><i class="fa fa-calendar fa-fw"></i> Kegiatan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a @if($title == "Tambah Kegiatan")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.kegiatan.create') }}"><span class="fa fa-plus"></span> Tambah Kegiatan</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola Kegiatan")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.kegiatan.index') }}"><span class="fa fa-archive"></span> Kelola Kegiatan</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /diklat -->
                    <!-- cuprimer -->
                    <li @if($title == "Kelola CU" || $title == "Tambah CU" || $title == "Ubah CU" || $title == "Kelola Wilayah CU" ||
                    $title == "Kelola Staff CU" || $title == "Tambah Staff CU" || $title == "Ubah Staff CU")
                        {{ "class='active'" }}
                            @endif
                            >
                        <a href="#"><i class="fa fa-building-o fa-fw"></i> CU <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  @if($title == "Tambah CU")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.cuprimer.create') }}"><span class="fa fa-plus"></span> Tambah CU</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola CU")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.cuprimer.index') }}"><span class="fa fa-archive"></span> Kelola CU</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola Wilayah CU")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.wilayahcuprimer.index') }}"><span class="fa fa-archive"></span> Kelola Wilayah CU</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /cuprimer -->
                    <!-- staff -->
                    <li @if($title == "Kelola Staf" || $title == "Tambah Staf" || $title == "Ubah Staf" )
                        {{ "class='active'" }}
                            @endif
                            >
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Staf <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a @if($title == "Tambah Staf")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.staff.create') }}"><span class="fa fa-plus"></span> Tambah Staf</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola Staf")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.staff.index') }}"><span class="fa fa-archive"></span> Kelola staf</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /staff -->
                    <!-- download -->
                    <li @if($title == "Kelola File" || $title == "Tambah File" || $title == "Ubah File" )
                        {{ "class='active'" }}
                            @endif
                            >
                        <a href="#"><i class="fa fa-download fa-fw"></i> Download <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a @if($title == "Tambah File")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.download.create') }}"><span class="fa fa-plus"></span> Tambah File</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola File")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.download.index') }}"><span class="fa fa-archive"></span> Kelola File</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /download -->
                    <!-- admin -->
                    <li @if($title == "Kelola Admin" || $title == "Tambah Admin" || $title == "Ubah Admin" )
                        {{ "class='active'" }}
                            @endif
                            >
                        <a href="#"><i class="fa fa-user fa-fw"></i> Admin<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a @if($title == "Tambah Admin")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.admin.create') }}"><span class="fa fa-plus"></span> Tambah Admin</a>
                            </li>
                            <li>
                                <a @if($title == "Kelola Admin")
                                    {{ "class='active'" }}
                                            @endif
                                            href="{{ route('admins.admin.index') }}"><span class="fa fa-archive"></span> Kelola Admin</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><i class="fa fa-exclamation-circle"></i> {{$title}}</h1>
                    </div>
                </div>

                <div class="jumbotron">
                    <h1>Oops, Telah Terjadi Kesalahan</h1>
                    <p>Maaf, telah terjadi kesalahan, Halaman yang anda tuju tidak ada atau mengalami kerusakan.
                       Silahkan mencoba lagi! Apabila tetap terjadi kesalahan, silahkan hubungi :
                       <hr/>
                        <address>
                            <strong style="font-size: x-large">Tony</strong><br>
                            <i class="fa fa-phone-square"></i> (+62) 811 577 857 1 <br/>
                            <i class="fa fa-envelope"></i> <a href="mailto:t0n1zz@live.com">t0n1zz@live.com</a>
                        </address>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>


{{ HTML::script('admin/js/jquery-1.11.0.js') }}

<!-- Bootstrap Core JavaScript -->
{{ HTML::script('admin/js/bootstrap.min.js') }}

<!-- Metis Menu Plugin JavaScript -->
{{ HTML::script('admin/js/plugins/metisMenu/metisMenu.min.js') }}

<!-- DataTables JavaScript -->
{{ HTML::script('admin/js/plugins/dataTables/jquery.dataTables.js') }}
{{ HTML::script('admin/js/plugins/dataTables/dataTables.bootstrap.js') }}

<!-- Custom Theme JavaScript -->
{{ HTML::script('admin/js/sb-admin-2.js') }}

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
</script>

{{ HTML::script('BootstrapFormHelper/js/bootstrap-formhelpers.min.js') }}
{{ HTML::script('js/validator.min.js') }}
{{ HTML::script('js/myscript.js') }}

</body>
</html>