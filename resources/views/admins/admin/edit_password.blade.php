<?php
$title="Ubah Password Admin";
$kelas="admin";
?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-pencil-square-o"></i> {{ $title }}
        <small>Mengubah Password Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-user"></i> Kelola Admin</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {{$title}}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
{{ Form::model($data,array('route' => array('admins.'.$kelas.'.update_password',$data->id), 'files' => true,
    'data-toggle' => 'validator','role' => 'form')) }}
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!-- content -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-group">
                <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                    <i class="fa fa-save"></i> <u>S</u>impan</button>
                <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
                    <i class="fa fa-times"></i> <u>B</u>atal</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <!--username-->
                <div class="col-lg-12">
                    <h4>Username</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan username',
                            'autocomplete'=>'off','readonly'))}}
                        {{ $errors->first('username', '<p class="text-warning">:message</p>') }}
                    </div>
                </div>
                <!--/username-->
                <!--password 1-->
                <div class="col-lg-6">
                    <h4>Password</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password admin'))}}
                        {{ $errors->first('password', '<p class="text-warning">:message</p>') }}
                    </div>
                </div>
                <br/>
                <!--/password 1-->
                <!--password 2-->
                <div class="col-lg-6">
                    <h4>Konfirmasi Password</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::password('password2',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password admin sekali lagi'))}}
                        {{ $errors->first('password2', '<p class="text-warning">:message</p>') }}
                    </div>
                </div>
                <!--/password 2-->
            </div>
        </div>
    </div>
{{ Form::close() }}
</section>
<!-- /Main content -->
@stop