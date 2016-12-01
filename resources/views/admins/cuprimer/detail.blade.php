<?php

$title = "Profil CU";
$kelas = "cuprimer";
$imagepath = "images_cu/";

if($data->do == "1"){
    $do ="Barat";
}else if($data->do == "2"){
    $do ="Tengah";
}else if($data->do == "3"){
    $do ="Timur";
}else{
    $do ='-';
}

$dateultah = new Date($data->ultah);
$datejoin = new Date($data->bergabung);
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-building"></i> {{ $title }}
        <small>Informasi {{ $title }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                        <div class="modalphotos" >
                            <img class="img-responsive"  width="100%" src="{{ asset($imagepath.$data->gambar.'n.jpg') }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->gambar."jpg") }}">
                        </div>
                    @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                        <div class="modalphotos" >
                            <img class="img-responsive" width="100% src="{{ asset($imagepath.$data->gambar) }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->gambar) }}">
                        </div>
                    @else
                        <img class="img-responsive" width="100%"" src="{{ asset('images/image-cu.jpg') }}"
                             id="tampilgambar" alt="cu profile">
                    @endif
                    <br/>
                    <h3 class="profile-username text-center">{{ $data->name }}</h3>
                    <p class="text-muted text-center">{{ $data->wilayahcuprimer->name }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>District Office</b> <a class="pull-right">{{ $do }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl. Berdiri</b> <a class="pull-right">{{ $dateultah->format('j F Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl. Bergabung</b> <a class="pull-right">{{ $datejoin->format('j F Y') }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('admins.cuprimer.edit', array($id)) }}" class="btn btn-default btn-block">
                        <i class="fa fa-pencil"></i> Ubah</a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-9">
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Informasi Umum</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <section id="informasi">
                            <div class="row">
                                <div class="col-lg-6">
                                    <b>No. Badan Hukum:</b> {{ $data->badan_hukum }}
                                    <br/>
                                    <b>No.Telepon:</b> {{ $data->telp }}
                                    <br/>
                                    <b>No. Handphone:</b> {{ $data->hp }}
                                    <br/><br/>
                                    <b>Email:</b> {{ $data->email }}
                                    <br/>
                                    <b>Website:</b> {{ $data->website }}
                                    <br/>
                                    <b>Aplikasi Komputerisasi:</b> {{ $data->app }}
                                </div>
                                <div class="col-lg-4">
                                    <b>Kode Pos:</b> {{ $data->pos }}
                                    <br/><br/>
                                    <b>Alamat</b><br/>
                                    {{ $data->alamat }}
                                </div>
                            </div>
                            <hr/>
                        </section>
                        @if(!empty($data->deskripsi))
                            <section id="deskripsi">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>{{ $data->deskripsi }}</p>
                                    </div>
                                </div>
                            </section>
                        @else
                            <section id="deskripsi">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="callout callout-info">
                                          <h1>Ayo! Isi profil CU anda...</h1>
                                          <p>Silahkan tambahkan misi, visi, nilai-nilai inti dan slogan serta profil singkat CU dengan menekan tombol [ <b><i class="fa fa-pencil"></i> Ubah</b> ]</p>
                                        </div>
                                    </div>
                                </div>
                            </section>    
                        @endif
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

@stop