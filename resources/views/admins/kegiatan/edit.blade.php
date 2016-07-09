<?php
$title="Ubah Kegiatan";
$kelas="kegiatan";
?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-pencil-square-o"></i> {{ $title }}
        <small>Mengubah Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-calendar"></i> Kelola Kegiatan</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {{$title}}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
	{{ Form::model($data,array('route' => array('admins.'.$kelas.'.update',$data->id),'method' => 'put','files' => true,
	    'data-toggle' => 'validator','role' => 'form')) }}
		@include('admins.'.$kelas.'.form')
	{{ Form::close() }}
</section>
<!-- /Main content -->
@stop

