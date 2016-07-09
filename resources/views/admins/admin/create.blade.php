<?php
$title="Tambah Admin";
$kelas="admin";
?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-plus"></i> {{ $title }}
        <small>Menambah Admin Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-user"></i> Kelola Admin</a></li>
        <li class="active"><i class="fa fa-plus"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
{{ Form::open(array('route' => array('admins.'.$kelas.'.store'), 'files' => true, 'data-toggle' => 'validator','role' => 'form')) }}
@include('admins.'.$kelas.'.form')
{{ Form::close() }}
</section>
<!-- /Main content -->
@stop