<?php
$title = "Admin";
$kelas = "admin";
$imagepath = "images_cu/";


$datelogin = new Date($data->login);
$datelogout= new Date($data->logout);
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-user-circle-o"></i> {{ $title }}
        <small>Informasi {{ $title }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        @if($cu == 0)
            <li><a href="{{ route('admins.admin.index') }}"><i class="fa fa-user-circle-o"></i> Kelola Admin</li></a>
        @endif    
        <li class="active"><i class="fa fa-user-circle-o"></i> {{ $title }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                        <div class="modalphotos" >
                            <img class="profile-user-img img-responsive img-circle"  width="100%" src="{{ asset($imagepath.$data->gambar.'n.jpg') }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->gambar."jpg") }}">
                        </div>
                    @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                        <div class="modalphotos" >
                            <img class="profile-user-img img-responsive img-circle" width="100% src="{{ asset($imagepath.$data->gambar) }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->gambar) }}">
                        </div>
                    @else
                        <img class="profile-user-img img-responsive img-circle" width="100%"" src="{{ asset('images/user.png') }}"
                             id="tampilgambar" alt="cu profile">
                    @endif
                    <br/>
                    <h3 class="profile-username text-center">{{ $data->name }}</h3>
                    <p class="text-muted text-center">{{ $data->cuprimer->name }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Username</b> <a class="pull-right">{{ $data->username }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Terakhir Login</b> <a class="pull-right">{{ $datelogin->format('j F Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>&nbsp</b><a class="pull-right">{{ $datelogin->format('H:i:s') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Terakhir Logout</b> <a class="pull-right">{{ $datelogout->format('j F Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>&nbsp</b><a class="pull-right">{{ $datelogout->format('H:i:s') }}</a>
                        </li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>    

        <div class="col-md-9">
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#password" data-toggle="tab">Ubah Password</a></li>
                    <li><a href="#akses" data-toggle="tab">Hak Akses</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="password">
                        <section id="password">
                            {{ Form::open(array('route' => array('admins.'.$kelas.'.update_password'))) }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h5>Password Baru</h5>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                            <input type="password" name="password" class="form-control" id="password"
                                                   placeholder="Silahkan masukkan password baru" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Ulangi Password</h5>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                            <input type="password" name="password2" class="form-control" id="password2"
                                                   placeholder="Silahkan ulangi password baru" autocomplete="off">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </section>  
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->
@stop

