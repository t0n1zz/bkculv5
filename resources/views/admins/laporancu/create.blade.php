<?php
$title="Tambah Laporan CU";
$kelas="laporancu";
?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-plus"></i> {{ $title }}
        <small>Menambah Data Laporan CU</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-line-chart"></i> Kelola Laporan CU</a></li>
        <li class="active"><i class="fa fa-plus"></i> {!! $title !!}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
    {!! Form::open(array('route' => array('admins.'.$kelas.'.store'), 'files' => true, 'data-toggle' => 'validator','role' => 'form')) !!}
    <?php if(Auth::check()) { $id = Auth::user()->getId();} ?>
    @include('admins.'.$kelas.'.form')
    {!! Form::close() !!}
</section>
<!-- /Main content -->
@stop