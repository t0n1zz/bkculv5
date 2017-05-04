<?php
$title="Ubah Identitas Staf";
$kelas="staf";
$batal_route = route('admins.'.$kelas.'.index');
?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-pencil-square-o"></i> {{ $title }}
        <small>Mengubah Identitas Staf</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ $batal_route }}"><i class="fa fa-sitemap"></i> Kelola Staf</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {{$title}}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
{{ Form::model($data,array('route' => array('admins.'.$kelas.'.update',$data->id),'method' => 'put', 'files' => true,'data-toggle' => 'validator','role' => 'form')) }}
@include('admins._layouts.alert')
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title ">Identitas</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.identitas')
    </div>
</div>       
@include('admins._components.tombol')
{{ Form::close() }}
</section>
<!-- /Main content -->
@stop