<?php
$title="Tambah Kegiatan";
$kelas="kegiatan";
?>
@extends('admins._layouts.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-plus"></i> {{ $title }}
        <small>Menambah Kegiatan Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-calendar"></i> Kelola Kegiatan</a></li>
        <li class="active"><i class="fa fa-plus"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
	{{ Form::open(array('route' => array('admins.'.$kelas.'.store'), 'files' => true,
	    'data-toggle' => 'validator','role' => 'form')) }}
        <?php if(Auth::check()) { $id = Auth::user()->getId();} ?>
		@include('admins.'.$kelas.'.form')
	{{ Form::close() }}
</section>
<!-- /Main content -->
@stop

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/form.js') }}"></script>
@stop