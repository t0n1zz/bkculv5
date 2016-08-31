<?php
$title="Ubah TP CU";
$kelas="tpcu";
?>
@extends('admins._layouts.layout')

@section('content')
    <!-- header -->
    <section class="content-header">
        <h1>
            <i class="fa fa-pencil"></i> {{ $title }}
            <small>Mengubah Data TP CU</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-book"></i> Kelola TP CU</a></li>
            <li class="active"><i class="fa fa-pencil-square-o"></i> {{$title}}</li>
        </ol>
    </section>
    <!-- /header -->
    <!-- Main content -->
    <section class="content">
        {{ Form::model($data,array('route' => array('admins.'.$kelas.'.update',$data->id),'method' => 'put', 'files' => true,
            'data-toggle' => 'validator','role' => 'form')) }}
        {{ Form::text('penulis',null,array('hidden'))}}
        @include('admins.'.$kelas.'.form')
        {{ Form::close() }}
    </section>
    <!-- /Main content -->
@stop