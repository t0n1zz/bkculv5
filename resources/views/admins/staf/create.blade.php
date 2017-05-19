<?php
$title="Tambah Staf";
$kelas="staf";
$batal_route = route('admins.'.$kelas.'.index');
?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-plus"></i> {{ $title }}
        <small>Menambah Staf Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ $batal_route }}"><i class="fa fa-sitemap"></i> Kelola Staf</a></li>
        <li class="active"><i class="fa fa-plus"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
{{ Form::open(array('route' => array('admins.'.$kelas.'.store'), 'files' => true, 'data-toggle' => 'validator','role' => 'form')) }}
@if(!empty($tipe_kegiatan))
    <input type="text" name="tipe_kegiatan" value="{{$tipe_kegiatan}}" hidden>
    <input type="text" name="id_kegiatan" value="{{$id_kegiatan}}" hidden>
    <?php $no_simpan2 = 1; ?>
@endif
@include('admins._layouts.alert')
{{-- identitias --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title ">Identitas</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.identitas')
    </div>
</div>
{{-- keluarga --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Keluarga</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.keluarga')
    </div>
</div>
{{-- anggota cu --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Keanggotaan Di CU</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.anggotacu')
    </div>
</div>
{{-- pekerjaan --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Pekerjaan</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.pekerjaan')
    </div>
</div>
{{-- pendidikan --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Pendidikan Terakhir</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.pendidikan')
    </div>
</div>
{{-- organisasi --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Organisasi Yang Di ikuti</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.organisasi')
    </div>
</div> 
{{-- kegiatan --}} 
@include('admins._components.tombol')
{{ Form::close() }}
</section>
<!-- /Main content -->
@stop

@section('js')
@include('admins.staf._components.formjs')
@stop