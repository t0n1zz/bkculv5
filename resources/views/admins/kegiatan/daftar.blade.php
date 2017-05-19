<?php
$title="Daftar " .$data->name;
$kelas="kegiatan";
$batal_route = route('admins.'.$kelas.'.detail',array($data->id));
$imagepath2 = "images_staf/";
$pekerjaan = '';

foreach($data_staf->pekerjaan as $p){
    if($p->tipe == "1"){
        $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
    }elseif($p->tipe == "2"){
        $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
    }elseif($p->tipe == "3"){
        $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
    }
}


?>
@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-plus"></i> {{ $title }}
        <small>Daftar Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-suitcase"></i> Kelola Diklat</a></li>
        <li><a href="{{ $batal_route }}"><i class="fa fa-sitemap"></i> {{ $data->name }}</a></li>
        <li class="active"><i class="fa fa-plus"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
@if($tipe_kegiatan == 1)
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store_panitia'), 'data-toggle' => 'validator','role' => 'form')) }}
@elseif($tipe_kegiatan == 2)
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store_peserta'), 'data-toggle' => 'validator','role' => 'form')) }}
@endif
@include('admins._layouts.alert')
{{-- kegiatan --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Kegiatan</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12" id="widgetpeserta">
                <div class="box box-widget widget-user-2"">
                   <div class="widget-user-header bg-aqua">
                        <div class="widget-user-image">
                            @if(!empty($data_staf->staf->gambar) && is_file($imagepath2.$data_staf->gambar."n.jpg"))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image($imagepath2.$data_staf->gambar.'n.jpg',asset($imagepath2.$data_staf->gambar."jpg"),
                                         array('class' => 'img-thumbnail',
                                        'id' => 'tampilgambar', 'width' => '40px')) }}
                                    </div></td>
                            @else
                                @if($data_staf->kelamin == "Wanita")
                                    <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-thumbnail',
                                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                @else
                                    <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-thumbnail',
                                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                @endif
                            @endif
                        </div>
                        <input type="text" name="id_kegiatan" style="display:none;" value="{{ $data->id }}"/>
                        @if($tipe_kegiatan == 1)
                            <input type="text" name="panitia" style="display:none;" value="{{ $data_staf->id }}"/>
                        @elseif($tipe_kegiatan == 2)
                            <input type="text" name="peserta[]" style="display:none;" value="{{ $data_staf->id }}"/>
                        @endif
                        <h3 class="widget-user-username">{{ $data_staf->name }}</h3>
                        <h5 class="widget-user-desc">{{ $pekerjaan }}</h5> 
                    </div>           
                </div>             
            </div>
            <div class="col-sm-12">
                @if($tipe_kegiatan == 1)
                    <div class="form-group">
                        <h4>Pada Kegiatan Bertugas Sebagai?</h4>
                        <div class="input-group">
                            <div class="input-group-addon primary-color">Sebagai</div>
                            <select class="form-control" name="selecttugas">
                                <option value="0" hidden>Silahkan pilih tugas</option>
                                <option value="Fasilitator">Fasilitator</option>
                                <option value="Co-Fasilitator">Co-Fasilitator</option>
                                <option value="Trainee">Trainee</option>
                                <option value="Panitia">Panitia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Keterangan</h4>
                        {{ Form::textarea('keterangan',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan keterangan')) }}
                    </div>
                @endif
            </div>
        </div>    
    </div>
    <div class="box-footer">
        <div class="form-group" style="margin-bottom: 0px;">
            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan</button>   
            <a href="{{ $batal_route }}" name="batal" class="btn btn-danger">
                <i class="fa fa-times"></i> Batal</a>
        </div>
    </div>
</div>
{{ Form::close() }}
</section>
<!-- /Main content -->
@stop

@section('js')

@stop