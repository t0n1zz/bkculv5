<?php
$title="Tambah CU";
$kelas="cuprimer";
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
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-building"></i> Kelola CU Primer</a></li>
        <li class="active"><i class="fa fa-plus"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store'),'files' => true,
    'data-toggle' => 'validator','role' => 'form')) }}
    @include('admins.'.$kelas.'.form')
    {{ Form::close() }}
</section>

@stop