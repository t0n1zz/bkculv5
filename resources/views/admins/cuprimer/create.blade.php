<?php
$title="Tambah CU";
$kelas="cuprimer";
$batal_route = route('admins.'.$kelas.'.index');
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-plus"></i> {{ $title }}
        <small>Menambah CU Primer Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ $batal_route }}"><i class="fa fa-building"></i> Kelola CU Primer</a></li>
        <li class="active"><i class="fa fa-plus"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
{{ Form::open(array('route' => array('admins.'.$kelas.'.store'),'files' => true,'data-toggle' => 'validator','role' => 'form')) }}
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