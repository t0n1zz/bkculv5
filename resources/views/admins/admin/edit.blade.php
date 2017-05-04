<?php
$title="Ubah Tipe Admin";
$kelas="admin";
$batal_route = route('admins.'.$kelas.'.index');
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-pencil-square-o"></i> {{ $title }}
        <small>Mengubah Tipe Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ $batal_route }}"><i class="fa fa-user"></i> Kelola Admin</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {{$title}}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
{{ Form::model($data,array('route' => array('admins.'.$kelas.'.update'))) }}
    @include('admins._layouts.alert')
    <div class="box box-primary">
        <div class="box-body">
            @include('admins.'.$kelas.'.form')
        </div>
    </div>        
    @include('admins._components.tombol')
{{ Form::close() }}
</section>
@stop