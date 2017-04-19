<?php

use App\pekerjaan;
$title = "Detail Kegiatan";
$kelas = "kegiatan";
$imagepath = "images_tempat/";
$cu = Auth::user()->getCU();
$now = Date::now()->format('Y-m-d');

if($data->tanggal2 <= $now && empty($data->deleted_at)){
    $statuskegiatan = 'terlaksana';
}elseif(!empty($data->deleted_at)){
    $statuskegiatan = 'batal';
}else{
    $statuskegiatan = "";
}

?>
@extends('admins._layouts.layout')

@section('css')
@include('admins._components.datatable_CSS')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Responsive/css/responsive.bootstrap.min.css')}}" >
@stop

@section('content')

<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ $title }}
        <small>Informasi Detail Kegiatan </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('admins/kegiatan') }}"><i class="fa fa-calendar"></i> Kegiatan</a></li>
        <li class="active"><i class="fa fa-database"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">

    <div class="row">
        
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h2 class="profile-username text-center">{{ $data->name }}</h2>
                    <p class="text-muted text-center">{{ $data->kode }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            @if(!empty($data->tanggal))
                                <?php $date = new Date($data->tanggal); ?>
                                <b>Tanggal Mulai</b> <a class="pull-right">{{  $date->format('d-n-Y') }}</a>
                            @else
                                <b>Tanggal Mulai</b> <a class="pull-right">-</a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            @if(!empty($data->tanggal))
                                <?php $date2 = new Date($data->tanggal2); ?>
                                <b>Tanggal Selesai</b> <a class="pull-right">{{  $date2->format('d-n-Y') }}</a>
                            @else
                                <b>Tanggal Selesai</b> <a class="pull-right">-</a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Periode Kegiatan</b> <a class="pull-right">{{ $data->periode }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Peserta Minimal</b> <a class="pull-right">{{ $data->min }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Peserta Maximal</b> <a class="pull-right">{{ $data->max }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Peserta Terdaftar</b> <a class="pull-right">{{ $datapeserta->count() }}</a>
                        </li>
                    </ul>
                    @if($statuskegiatan != "terlaksana" && $statuskegiatan != "batal")
                        <a href="{{ route('admins.'.$kelas.'.edit',array($data->id)) }}" class="btn btn-default btn-block"><i class="fa fa-pencil"></i> Ubah Data Kegiatan</a>   
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sasaran</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p>
                    @foreach($data->sasaranhub as $sr)
                       <a href="#" class="btn btn-info btn-sm nopointer marginbottom">{{ $sr->sasaran->name }}</a>
                    @endforeach
                    </p>
                </div>
                <!-- /.box-body -->
            </div>
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Prasyarat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p>
                    @foreach($data->prasyarat as $pr)
                       <a href="#" class="btn btn-info btn-sm nopointer marginbottom">{{ $pr->kegiatan->kode . ' - ' . $pr->kegiatan->name }}</a>
                    @endforeach
                    </p>
                </div>
                <!-- /.box-body -->
            </div>
            @if(!empty($data->tempat))
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tempat</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(!empty($data->tempat->gambar) && is_file($imagepath.$data->tempat->gambar."n.jpg"))
                            <div class="modalphotos">
                            <img class="img-responsive " src="{{ asset($imagepath.$data->tempat->gambar.'n.jpg') }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->tempat->gambar."jpg") }}">
                            </div>
                        @endif
                        <h4>{{ $data->tempat->name }}</h4>
                        <p class="text-muted">{{ $data->tempat->keterangan }}</p>
                    </div>
                    <!-- /.box-body -->
                </div>
            @elseif(!empty($data->kota)) 
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h4>Tempat : {{ $data->kota }}</h4>
                    </div>
                    <!-- /.box-body -->
                </div>   
            @endif
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div>
                @if($statuskegiatan == 'terlaksana')
                    <div class="callout callout-info ">
                        <h3 style="margin-top: 5px;"><i class="icon fa fa-check"></i> Kegiatan ini sudah dilaksanakan</h3>
                        @if(!empty($data->keterangan))
                            <p>{{ $data->keterangan }}</p>
                        @endif    
                    </div>
                @elseif($statuskegiatan == 'batal')
                    <div class="callout callout-danger">
                        <h3 style="margin-top: 5px;"><i class="icon fa fa-times"></i> Kegiatan ini tidak terlaksana</h3>
                        @if(!empty($data->keterangan))
                            <p>{{ $data->keterangan }}</p>
                        @endif  
                    </div>
                @else
                    @if($data->selesai >= $now)
                        <div class="callout callout-warning ">
                            <h3 style="margin-top: 5px;"><i class="icon fa fa-check"></i> Kegiatan ini sudah dilaksanakan?</h3>
                            <btn class="btn btn-default" data-toggle="modal" data-target="#modalpulih"><i class="fa fa-check"></i> Sudah Dilaksanakan</btn>
                            <btn class="btn btn-default" data-toggle="modal" data-target="#modalpulih"><i class="fa fa-check"></i> Batal Dilaksanakan</btn>  
                        </div>
                    @endif    
                @endif 
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="{{ $tabname == 'informasi' ? 'active' : '' }}"><a href="#informasi" data-toggle="tab">Informasi</a></li>
                    <li class="{{ $tabname == 'pendaftaran' ? 'active' : '' }}"><a href="#pendaftaran" data-toggle="tab">Pendaftaran</a></li>
                </ul>
                <div class="tab-content">
                    <div class="fade tab-pane {{ $tabname == 'informasi' ? 'in active' : '' }}" id="informasi">
                        @if(!empty($data->deskripsi))
                            <section id="deskripsi">
                                <h4 class="page-header color1">Deskripsi</h4>
                                <div class="pre-scrollable">
                                    {!! $data->deskripsi !!}
                                </div>    
                                <br/>
                            </section>
                        @endif
                        @if(!empty($data->peserta))
                            <section id="peserta">
                                <h4 class="page-header color1">Peserta</h4>
                                <div class="pre-scrollable">
                                    {!! $data->peserta !!}
                                </div>    
                                <br/>
                            </section>
                        @endif
                        @if(!empty($data->tujuan))
                            <section id="tujuan">
                                <h4 class="page-header color1">Tujuan</h4>
                                <div class="pre-scrollable">
                                    {!! $data->tujuan !!}
                                </div>
                                <br/>
                            </section>
                        @endif
                        @if(!empty($data->ruang))
                            <section id="ruang">
                                <h4 class="page-header color1">Ruang Lingkup</h4>
                                <div class="pre-scrollable">
                                    {!! $data->ruang !!}
                                </div>
                                <br/>
                            </section>
                        @endif
                        @if(!empty($data->informasi))
                            <section id="informasi">
                                <h4 class="page-header color1">Informasi Tambahan</h4>
                                <div class="pre-scrollable">
                                    {!! $data->informasi !!}
                                </div>    
                            </section> 
                            </div>
                        @endif    
                    </div>
                    <!-- /.tab-pane -->
                    <div class="fade tab-pane {{ $tabname == 'pendaftaran' ? 'in active' : '' }}" id="pendaftaran">
                        @if($cu == '0')
                            <section id="panitia">
                                <h4 class="page-header color1">Fasilitator & Panitia</h4>
                                <table class="table table-hover dt-responsive nowarp" id="datatablepanitia" cellspacing="0" width="100%">
                                    <thead class="bg-light-blue-active color-palette">
                                    <tr> 
                                        <th hidden></th>
                                        <th hidden></th>
                                        <th data-sortable="false">Foto</th>
                                        <th class="sort" data-priority="1">Nama</th>
                                        <th>Lembaga</th>
                                        <th>Keterangan</th>
                                        <th data-priority="2">Tugas</th>
                                        <th class="none">NIM</tH>
                                        <th class="none">Jabatan</th>
                                        <th>Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datapanitia as $datap)
                                        <?php
                                            $tempat ="";
                                            $pekerjaan = ""; 
                                            $i = 0; 
                                            if(!empty($datap->staf->pekerjaan_aktif)){
                                                foreach($datap->staf->pekerjaan_aktif as $p){
                                                    $i++;
                                                    if($p->tipe == "1"){
                                                        $tempat .= 'CU ' . $p->cuprimer->name ;
                                                        $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                                    }elseif($p->tipe == "2"){
                                                        $tempat .= $p->lembaga->name;
                                                        $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                                    }elseif($p->tipe == "3"){
                                                        $tempat .= 'Puskopdit BKCU Kalimantan';
                                                        $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                                                    }
                                                    if($i < $datap->staf->pekerjaan_aktif->count()){
                                                        $tempat .= ', ';
                                                        $pekerjaan .= ', ';
                                                    }
                                                }
                                            }
                                        ?>
                                        <tr>
                                            <td hidden>{{ $datap->id }}</td>
                                            <td hidden>{{ $datap->staf->id }}</td>
                                            @if(!empty($datap->staf->gambar) && is_file($imagepath.$datap->staf->gambar."n.jpg"))
                                                <td style="white-space: nowrap"><div class="modalphotos" >
                                                        {{ Html::image($imagepath.$datap->staf->gambar.'n.jpg',asset($imagepath.$datap->staf->gambar."jpg"),
                                                         array('class' => 'img-responsive',
                                                        'id' => 'tampilgambar', 'width' => '40px')) }}
                                                    </div></td>
                                            @else
                                                @if($datap->staf->kelamin == "Wanita")
                                                    <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                                @else
                                                    <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                                @endif
                                            @endif
                                            <td>{{ $datap->staf->name }}</td>
                                            <td class="warptext"> {!! $tempat !!}</td>
                                            <td class="warptext">{{ $datap->keterangan }}</td>
                                            <td>{{ $datap->tugas }}</td>
                                            <td>{{ $datap->staf->nim }}</td>
                                            <td class="warptext"> {!! $pekerjaan !!}</td>
                                            <td></td>
                                        </tr>   
                                    @endforeach
                                    </tbody>
                                </table>
                            </section>
                        @endif
                        <section id="peserta">
                             <br/><br/>
                            <h4 class="page-header color1">Peserta</h4>
                            <table class="table table-hover dt-responsive" id="datatablepeserta" cellspacing="0" width="100%">
                                <thead class="bg-light-blue-active color-palette">
                                <tr >
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th data-sortable="false">Foto</th>
                                    <th class="sort" data-priority="1">Nama</th>
                                    <th>Lembaga</th>
                                    <th>Keterangan</th>
                                    <th>Tgl. Daftar</th>
                                    <th data-priority="2">Status</th>
                                    <th class="none">NIM</th>
                                    <th class="none">Jabatan</th>
                                    <th>Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datapeserta as $datap)
                                    <tr>
                                        <?php
                                            $tempat ="";
                                            $pekerjaan = ""; 
                                            $i = 0; 
                                            if(!empty($datap->staf->pekerjaan_aktif)){
                                                foreach($datap->staf->pekerjaan_aktif as $p){
                                                    $i++;
                                                    if($p->tipe == "1"){
                                                        $tempat .= 'CU ' . $p->cuprimer->name ;
                                                        $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                                    }elseif($p->tipe == "2"){
                                                        $tempat .= $p->lembaga->name;
                                                        $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                                    }elseif($p->tipe == "3"){
                                                        $tempat .= 'Puskopdit BKCU Kalimantan';
                                                        $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                                                    }
                                                    if($i < $datap->staf->pekerjaan_aktif->count()){
                                                        $tempat .= ', ';
                                                        $pekerjaan .= ', ';
                                                    }
                                                }
                                            }
                                        ?>
                                        <td hidden>{{ $datap->id }}</td>
                                        <td hidden>{{ $datap->staf->id }}</td>
                                        <td hidden>{{ $datap->status }}</td>
                                        @if(!empty($datap->staf->gambar) && is_file($imagepath.$datap->staf->gambar."n.jpg"))
                                            <td style="white-space: nowrap"><div class="modalphotos" >
                                                    {{ Html::image($imagepath.$datap->staf->gambar.'n.jpg',asset($imagepath.$datap->staf->gambar."jpg"),
                                                     array('class' => 'img-responsive',
                                                    'id' => 'tampilgambar', 'width' => '40px')) }}
                                                </div></td>
                                        @else
                                            @if($datap->staf->kelamin == "Wanita")
                                                <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                                    'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                            @else
                                                <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                                    'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                            @endif
                                        @endif
                                        <td>{{ $datap->staf->name }}</td>
                                        <td class="warptext">{!! $tempat !!}</td>
                                        <td class="warptext">{{ $datap->keterangan }}</td>
                                        <td data-order="{{ $datap->created_at }}">@if(!empty($datap->created_at)){{ $datap->created_at->format('d F Y') }}@else{{ '-' }}@endif</td>
                                        <td data-order="{{ $datap->status }}">
                                            @if($datap->status == "1")
                                                <a href="#" class="btn btn-default btn-sm nopointer">PENDING</a>
                                            @elseif($datap->status == "2")
                                                <a href="#" class="btn btn-info btn-sm nopointer">TERDAFTAR</a>
                                            @elseif($datap->status == "3")
                                                <a href="#" class="btn btn-danger btn-sm nopointer">BATAL</a>
                                            @endif    
                                        </td>
                                        <td>{{ $datap->staf->nim }}</td>
                                        <td class="warptext">{!! $pekerjaan !!}</td>
                                        <td></td>
                                    </tr>   
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
</section>
@if($cu == '0')
    <div class="modal fade" id="modalpanitia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::open(array('route' => array('admins.'.$kelas.'.store_panitia'),'role' => 'form')) }}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light-blue-active color-palette">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 clasas="modal-title"><i class="fa fa-plus"></i> Tambah Panitia</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                    <div class="row">
                        <div id="areapanitia"></div>
                        <div class="col-sm-12" id="tugaspanitia" style="display: none;">
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
                            <br/>
                            <div class="form-group">
                                <h4>Keterangan</h4>
                                {{ Form::textarea('keterangan',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan keterangan')) }}
                            </div> 
                        </div>
                        <div class="col-sm-12"><hr/></div>
                        <div class="col-sm-12">
                            <div class="input-group tabletools">
                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                <input type="text" id="searchpanitia" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                            </div>
                            <table class="table table-hover dt-responsive nowarp" id="datatabletambahpanitia" cellspacing="0" width="100%">
                                <thead class="bg-light-blue-active color-palette">
                                <tr>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th data-sortable="false">Foto</th>
                                    <th class="sort" data-priority="1">Nama</th>
                                    <th>Lembaga</th>
                                    <th>Jabatan</th>
                                    <th class="none">NIM</th>
                                    <th class="none">NID</th>
                                    <th class="none">Pendidikan</th>
                                    <th class="none">Agama</th>
                                    <th class="none">Status</th>
                                    <th class="none">Tgl. Lahir</th>
                                    <th class="none">Umur</th>
                                    <th class="none">Alamat</th>
                                    <th class="none">Kontak</th>
                                    <th>Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datastaf as $dataf)
                                    <?php
                                        $date = new Date($dataf->tanggal_lahir);
                                        $tempat ="";
                                        $pekerjaan = "";
                                        $pendidikan ="";
                                        $i = 0; 
                                        if(!empty($dataf->staf->pekerjaan_aktif)){
                                            foreach($dataf->staf->pekerjaan_aktif as $p){
                                                $i++;
                                                if($p->tipe == "1"){
                                                    $tempat .= 'CU ' . $p->cuprimer->name ;
                                                    $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                                }elseif($p->tipe == "2"){
                                                    $tempat .= $p->lembaga->name;
                                                    $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                                }elseif($p->tipe == "3"){
                                                    $tempat .= 'Puskopdit BKCU Kalimantan';
                                                    $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                                                }
                                                if($i < $dataf->staf->pekerjaan_aktif->count()){
                                                    $tempat .= ', ';
                                                    $pekerjaan .= ', ';
                                                }
                                            }
                                        }
                                        if(!empty($dataf->staf->pendidikan)){
                                            $pendidikan = $dataf->staf->pendidikan->first();
                                        }
                                        if($dataf->staf->status == 1){
                                            $status = "Menikah";
                                        }elseif($dataf->staf->status == 2){
                                            $status = "Belum Menikah";
                                        }elseif($dataf->staf->status == 3){
                                            $status = "Duda/Janda";
                                        }else{
                                            $status = "";
                                        }
                                        $newarr = explode("\n",$dataf->staf->alamat);
                                        foreach($newarr as $str){
                                            $alamat = $str;
                                        }

                                        $newarr2 = explode("\n",$dataf->staf->kontak);
                                        foreach($newarr2 as $str2){
                                            $kontak = $str2;
                                        }
                                        ?>
                                    <tr>
                                        <td hidden>{{ $dataf->id_staf }}</td>
                                        @if(!empty($dataf->staf->gambar) && is_file($imagepath.$dataf->staf->gambar."n.jpg"))
                                            <td hidden>{{ asset($imagepath.$dataf->staf->gambar.'n.jpg') }}</td>
                                            <td style="white-space: nowrap"><div class="modalphotos" >
                                                    {{ Html::image($imagepath.$dataf->staf->gambar.'n.jpg',asset($imagepath.$dataf->staf->gambar."jpg"),
                                                     array('class' => 'img-responsive',
                                                    'id' => 'tampilgambar', 'width' => '40px')) }}
                                                </div></td>
                                        @else
                                            @if($dataf->staf->kelamin == "Wanita")
                                                <td hidden>{{ asset('images/no_image_woman.jpg') }}</td>
                                                <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                                    'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                            @else
                                                <td hidden>{{ asset('images/no_image_man.jpg') }}</td>
                                                <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                                    'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                            @endif
                                        @endif
                                        <td>{{ $dataf->staf->name }}</td>
                                        <td class="warptext">{!! $tempat !!}</td>
                                        <td class="warptext">{!! $pekerjaan !!}</td>
                                        <td>{{ $dataf->staf->nim }}</td>
                                        <td>{{ $dataf->staf->nid }}</td>
                                        @if(!empty($pendidikan))
                                            <td>{{ $pendidikan->tingkat . ' ' . $pendidikan->name . ' di ' . $pendidikan->tempat}}</td>
                                        @else
                                            <td></td>    
                                        @endif
                                        <td>{{ $dataf->staf->agama }}</td>
                                        <td>{{ $status }}</td>
                                        <td data-order="{{ $dataf->tanggal_lahir }}">{{ $date->format('d F Y') }}</td>
                                        <td>{{ $dataf->staf->age }} Tahun</td>
                                        <td>{{ $alamat }}</td>
                                        <td>{{ $kontak }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                     </div>   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        {{ Form::close() }}
    </div>
    <div class="modal fade" id="modaltugaspanitia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::open(array('route' => array('admins.'.$kelas.'.update_tugas_panitia'))) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light-blue-active color-palette">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-id-badge"></i> Ubah Tugas Panitia</h4>
                </div>
                <div class="modal-body">
                    <h4>Tugas Panitia</h4>
                    <input type="text" name="id"  id="idtugaspanitia" value="" hidden>
                    <input type="text" name="id_tugas"  id="idtugas" value="" hidden>
                    <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                    <div class="table-responsive">
                        <table class="table table-condensed" style="margin-bottom: 0px;">
                            <tr>
                                <td style="border-bottom: 1px solid #f4f4f4">
                                    <div class="checkbox">
                                        <label><input type="radio" name="radiotugas" value="Fasilitator" id="checkfasilitator" /> Fasilitator</label>
                                    </div>
                                </td>
                                <td style="border-bottom: 1px solid #f4f4f4">
                                    <div class="checkbox">
                                        <label><input type="radio" name="radiotugas" value="Co-Fasilitator" id="checkcofasilitator" /> Co-Fasilitator</label>
                                    </div>
                                </td>
                                <td style="border-bottom: 1px solid #f4f4f4">
                                    <div class="checkbox">
                                        <label><input type="radio" name="radiotugas" value="Trainee" id="checktrainee" /> Trainee</label>
                                    </div>
                                </td>
                                <td style="border-bottom: 1px solid #f4f4f4">
                                    <div class="checkbox">
                                        <label><input type="radio" name="radiotugas" value="Panitia" id="checkpanitia" /> Panitia</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        {{ Form::close() }}
    </div>
    <div class="modal fade" id="modalketpanitia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::open(array('route' => array('admins.'.$kelas.'.update_ket_panitia'))) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light-blue-active color-palette">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-sticky-note-o"></i> Ubah Keterangan Panitia</h4>
                </div>
                <div class="modal-body">
                    <h4>Keterangan</h4>
                    <input type="text" name="id"  id="idketpanitia" value="" hidden>
                    <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                    <textarea class="form-control" name="ketpanitia" id="ketpanitia" placeholder="Silahkan isikan keterangan"></textarea> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        {{ Form::close() }}
    </div>
    <div class="modal fade" id="modalhapuspanitia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_panitia'))) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-red-active color-palette">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Panitia</h4>
                </div>
                <div class="modal-body">
                    <h4>Menghapus panitia ini dari pelatihan?</h4>
                    <input type="text" name="id"  id="idhapuspanitia" value="" hidden>
                    <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        {{ Form::close() }}
    </div>
@endif
<div class="modal fade" id="modalpeserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store_peserta'),'role' => 'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 clasas="modal-title"><i class="fa fa-plus"></i> Tambah Peserta</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                <div class="row">
                    <div id="areapeserta"></div> 
                    <div class="col-sm-12"><hr/></div>
                    <div class="col-sm-12">
                        <div class="input-group tabletools">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" id="searchstaf" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                        </div>
                        <table class="table table-hover" id="datatabletambahpeserta" cellspacing="0" width="100%">
                            <thead class="bg-light-blue-active color-palette">
                                <tr>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th data-sortable="false">Foto</th>
                                    <th class="sort" data-priority="1">Nama</th>
                                    <th>Lembaga</th>
                                    <th>Jabatan</th>
                                    <th class="none">NIM</th>
                                    <th class="none">NID</th>
                                    <th class="none">Pendidikan</th>
                                    <th class="none">Agama</th>
                                    <th class="none">Status</th>
                                    <th class="none">Tgl. Lahir</th>
                                    <th class="none">Umur</th>
                                    <th class="none">Alamat</th>
                                    <th class="none">Kontak</th>
                                    <th>Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datastaf as $dataf)
                                    <?php
                                        $date = new Date($dataf->tanggal_lahir);
                                        $tempat ="";
                                        $pekerjaan = "";
                                        $pendidikan ="";
                                        $i = 0; 
                                        if(!empty($dataf->staf->pekerjaan_aktif)){
                                            foreach($dataf->staf->pekerjaan_aktif as $p){
                                                $i++;
                                                if($p->tipe == "1"){
                                                    $tempat .= 'CU ' . $p->cuprimer->name ;
                                                    $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                                }elseif($p->tipe == "2"){
                                                    $tempat .= $p->lembaga->name;
                                                    $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                                }elseif($p->tipe == "3"){
                                                    $tempat .= 'Puskopdit BKCU Kalimantan';
                                                    $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                                                }
                                                if($i < $dataf->staf->pekerjaan_aktif->count()){
                                                    $tempat .= ', ';
                                                    $pekerjaan .= ', ';
                                                }
                                            }
                                        }
                                        if(!empty($dataf->staf->pendidikan)){
                                            $pendidikan = $dataf->staf->pendidikan->first();
                                        }
                                        if($dataf->staf->status == 1){
                                            $status = "Menikah";
                                        }elseif($dataf->staf->status == 2){
                                            $status = "Belum Menikah";
                                        }elseif($dataf->staf->status == 3){
                                            $status = "Duda/Janda";
                                        }else{
                                            $status = "";
                                        }
                                        $newarr = explode("\n",$dataf->staf->alamat);
                                        foreach($newarr as $str){
                                            $alamat = $str;
                                        }

                                        $newarr2 = explode("\n",$dataf->staf->kontak);
                                        foreach($newarr2 as $str2){
                                            $kontak = $str2;
                                        }
                                        ?>
                                    <tr>
                                        <td hidden>{{ $dataf->id_staf }}</td>
                                        @if(!empty($dataf->staf->gambar) && is_file($imagepath.$dataf->staf->gambar."n.jpg"))
                                            <td hidden>{{ asset($imagepath.$dataf->staf->gambar.'n.jpg') }}</td>
                                            <td style="white-space: nowrap"><div class="modalphotos" >
                                                    {{ Html::image($imagepath.$dataf->staf->gambar.'n.jpg',asset($imagepath.$dataf->staf->gambar."jpg"),
                                                     array('class' => 'img-responsive',
                                                    'id' => 'tampilgambar', 'width' => '40px')) }}
                                                </div></td>
                                        @else
                                            @if($dataf->staf->kelamin == "Wanita")
                                                <td hidden>{{ asset('images/no_image_woman.jpg') }}</td>
                                                <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                                    'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                            @else
                                                <td hidden>{{ asset('images/no_image_man.jpg') }}</td>
                                                <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                                    'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                            @endif
                                        @endif
                                        <td>{{ $dataf->staf->name }}</td>
                                        <td class="warptext">{!! $tempat !!}</td>
                                        <td class="warptext">{!! $pekerjaan !!}</td>
                                        <td>{{ $dataf->staf->nim }}</td>
                                        <td>{{ $dataf->staf->nid }}</td>
                                        @if(!empty($pendidikan))
                                            <td>{{ $pendidikan->tingkat . ' ' . $pendidikan->name . ' di ' . $pendidikan->tempat}}</td>
                                        @else
                                            <td></td>    
                                        @endif
                                        <td>{{ $dataf->staf->agama }}</td>
                                        <td>{{ $status }}</td>
                                        <td data-order="{{ $dataf->tanggal_lahir }}">{{ $date->format('d F Y') }}</td>
                                        <td>{{ $dataf->staf->age }} Tahun</td>
                                        <td>{{ $alamat }}</td>
                                        <td>{{ $kontak }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                 </div>   
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalketpeserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_ket_peserta'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-sticky-note-o"></i> Ubah Keterangan Peserta</h4>
            </div>
            <div class="modal-body">
                <h4>Keterangan</h4>
                <input type="text" name="id"  id="idketpeserta" value="" hidden>
                <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                <textarea class="form-control" name="ketpeserta" id="ketpeserta" placeholder="Silahkan isikan keterangan"></textarea> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalstatuspeserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_status_peserta'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-square"></i> Ubah Status Peserta</h4>
            </div>
            <div class="modal-body">
                <h4>Status Peserta</h4>
                <input type="text" name="id"  id="idstatuspeserta" value="" hidden>
                <input type="text" name="id_status"  id="idstatus" value="" hidden>
                <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                <div class="table-responsive">
                    <table class="table table-condensed" style="margin-bottom: 0px;">
                        <tr>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="1" id="checkpending" /> PENDING</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="2" id="checkterdaftar" /> TERDAFTAR</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="3" id="checkbatal" /> BATAL</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalhapuspeserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_peserta'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Peserta</h4>
            </div>
            <div class="modal-body">
                <h4>Menghapus peserta ini dari pelatihan?</h4>
                <input type="text" name="id"  id="idhapuspeserta" value="" hidden>
                <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        } );
    });
</script>
{{-- panitia --}}
@if($cu == '0')
<script>
    var tablepanitia = $('#datatablepanitia').DataTable({
        dom: 'Bfti',
        paging : false,
        stateSave : false,
        scrollY: '50vh',
        autoWidth: true,
        scrollCollapse : true,
        select: {
            style:    'os',
            selector: 'td:not(:last-child)'
        },
        responsive:{
            details:{
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        }],
        buttons: [
        @if($statuskegiatan != "terlaksana" && $statuskegiatan != "batal")
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function () {
                    $('#modalpanitia').modal({show:true});
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function () {
                    var id = $.map(tablepanitia.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapuspanitia').modal({show:true});
                        $('#idhapuspanitia').attr('value',id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-sticky-note-o"></i> Keterangan',
                action: function () {
                    var id = $.map(tablepanitia.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var keterangan = $.map(tablepanitia.rows({ selected: true }).data(),function(item){
                        return item[5];
                    });
                    if(id != ""){
                        $('#modalketpanitia').modal({show:true});
                        $('#idketpanitia').attr('value',id);
                        $('#ketpanitia').text(keterangan);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-id-badge"></i> Tugas',
                action: function () {
                    var id = $.map(tablepanitia.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var tugas = $.map(tablepanitia.rows({ selected: true }).data(),function(item){
                        return item[6];
                    });
                    if(id != ""){
                        $('#modaltugaspanitia').modal({show:true});
                        $('#idtugaspanitia').attr('value',id);
                        $('#idtugas').attr('value',tugas);
                        if(tugas == "Fasilitator"){
                            $('#checkfasilitator').prop('checked',true);
                            $('#checkcofasilitator').prop('checked',false);
                            $('#checktrainee').prop('checked',false);
                            $('#checkpanitia').prop('checked',false);
                        }else if(tugas == "Co-Fasilitator"){
                            $('#checkfasilitator').prop('checked',false);
                            $('#checkcofasilitator').prop('checked',true);
                            $('#checktrainee').prop('checked',false);
                            $('#checkpanitia').prop('checked',false);
                        }else if(tugas == "Trainee"){
                            $('#checkfasilitator').prop('checked',false);
                            $('#checkcofasilitator').prop('checked',false);
                            $('#checktrainee').prop('checked',true);
                            $('#checkpanitia').prop('checked',false);
                        }else if(tugas == "Panitia"){
                            $('#checkfasilitator').prop('checked',false);
                            $('#checkcofasilitator').prop('checked',false);
                            $('#checktrainee').prop('checked',false);
                            $('#checkpanitia').prop('checked',true);
                        }
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
        @endif
        {
            text: '<i class="fa fa-database"></i> Profil',
            action: function(){
                var id = $.map(tablepanitia.rows({ selected: true }).data(),function(item){
                    return item[1];
                });
                if(id != ""){
                    window.location.href = "/admins/staf/detail/"+ id ;
                }else{
                    $('#modalwarning').modal({show:true});
                }
            }
        }    
        ],
        language: {
            buttons : {},
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "sProcessing":   "Sedang proses...",
            "sLengthMenu":   "Tampilan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
        }
    });

    tablepanitia.columns('.sort').order('asc').draw();

    tablepanitia.on( 'order.dt search.dt', function () {
        tablepanitia.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    var areapanitia = $('#areapanitia');

    var tabletambahpanitia = $('#datatabletambahpanitia').DataTable({
        dom: 'tip',
        autoWidth: true,
        paging : true,
        stateSave : false ,
        select: {
            style:    'os',
            selector: 'td:not(:last-child)'
        },
        responsive:{
            details:{
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        }],
        language: {
            buttons : {},
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "sProcessing":   "Sedang proses...",
            "sLengthMenu":   "Tampilan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
        }
    });

    tabletambahpanitia.columns('.sort').order('asc').draw();

    tabletambahpanitia.on( 'order.dt search.dt', function () {
        tabletambahpanitia.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#searchpanitia').keyup(function(){
        tabletambahpanitia.search($(this).val()).draw() ;
    });

    tabletambahpanitia
        .on( 'select', function ( e, dt, type, indexes ) {
            var id = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
            var foto = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
            var name = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
            var tempat = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[4];
                    });
            var htmlpanitia = '<div class="col-sm-12" id="widgetpeserta">';
                htmlpanitia += '<div class="box box-widget widget-user-2"">';
                    htmlpanitia += '<div class="widget-user-header bg-aqua">' ;
                        htmlpanitia += '<div class="widget-user-image">';
                            htmlpanitia += '<img class="img-thumbnail" src="'+foto+'" alt="User Image">';
                        htmlpanitia += '</div>';
                        htmlpanitia += '<input type="text" name="panitia" style="display:none;" value="'+id+'"/>'
                        htmlpanitia += '<h3 class="widget-user-username">'+name+'</h3>';
                        htmlpanitia += '<h5 class="widget-user-desc">'+tempat+'</h5>';  
                    htmlpanitia += '</div>';            
                htmlpanitia += '</div>';                
                htmlpanitia += '</div>';

            areapanitia.prepend(htmlpanitia);
            $('#tugaspanitia').show();
        } )
        .on('deselect',function(e, dt, type, indexes){
            $('#widgetpeserta').remove();
            $('#tugaspanitia').hide();
        });
</script>
@endif
{{-- peserta --}}
<script>
    var tablepeserta = $('#datatablepeserta').DataTable({
        dom: 'Bfti',
        paging : false,
        stateSave : false,
        scrollY: '50vh',
        autoWidth: true,
        scrollCollapse : true,
        select: {
            style:    'os',
            selector: 'td:not(:last-child)'
        },
        responsive:{
            details:{
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        }],
        buttons: [
        @if($statuskegiatan != "terlaksana" && $statuskegiatan != "batal")
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function () {
                    $('#modalpeserta').modal({show:true});
                    $('#modal2id').attr('value',"{{ $data->id }}");
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function () {
                    var id = $.map(tablepeserta.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapuspeserta').modal({show:true});
                        $('#idhapuspeserta').attr('value',id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-sticky-note-o"></i> Keterangan',
                action: function () {
                    var id = $.map(tablepeserta.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var keterangan = $.map(tablepeserta.rows({ selected: true }).data(),function(item){
                        return item[6];
                    });
                    if(id != ""){
                        $('#modalketpeserta').modal({show:true});
                        $('#idketpeserta').attr('value',id);
                        $('#ketpeserta').text(keterangan);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-check-square"></i> Status',
                action: function () {
                    var id = $.map(tablepeserta.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var status = $.map(tablepeserta.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    if(id != ""){
                        $('#modalstatuspeserta').modal({show:true});
                        $('#idstatuspeserta').attr('value',id);
                        $('#idstatus').attr('value',status);
                        if(status == "1"){
                            $('#checkpending').prop('checked',true);
                            $('#checkterdaftar').prop('checked',false);
                            $('#checkbatal').prop('checked',false);
                        }else if(status == "2"){
                            $('#checkterdaftar').prop('checked',true);
                            $('#checkpending').prop('checked',false);
                            $('#checkbatal').prop('checked',false);
                        }else if(status == "3"){
                            $('#checkbatal').prop('checked',true);
                            $('#checkterdaftar').prop('checked',false);
                            $('#checkpending').prop('checked',false);
                        }
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
        @endif
        {
            text: '<i class="fa fa-database"></i> Profil',
            action: function(){
                var id = $.map(tablepeserta.rows({ selected: true }).data(),function(item){
                    return item[1];
                });
                if(id != ""){
                    window.location.href = "/admins/staf/detail/"+ id ;
                }else{
                    $('#modalwarning').modal({show:true});
                }
            }
        }     
        ],
        language: {
            buttons : {},
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "sProcessing":   "Sedang proses...",
            "sLengthMenu":   "Tampilan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
        }
    });

    tablepeserta.columns('.sort').order('asc').draw();

    tablepeserta.on( 'order.dt search.dt', function () {
        tablepeserta.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw(); 

    var areapeserta = $('#areapeserta');
    var counterpeserta = 0;

    var tabletambahpeserta = $('#datatabletambahpeserta').DataTable({
        dom: 'tip',
        autoWidth: true,
        paging : true,
        stateSave : false ,
        select: {
            style:    'os',
            selector: 'td:not(:last-child)'
        },
        responsive:{
            details:{
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        },
        { 
            width: '5px',
            orderable: false, 
            targets: 0 
        }],
        language: {
            buttons : {},
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "sProcessing":   "Sedang proses...",
            "sLengthMenu":   "Tampilan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
        }
    });

    tabletambahpeserta.columns('.sort').order('asc').draw();

    tabletambahpeserta.on( 'order.dt search.dt', function () {
        tabletambahpeserta.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#searchpeserta').keyup(function(){
        tabletambahpeserta.search($(this).val()).draw() ;
    });

    tabletambahpeserta
        .on( 'select', function ( e, dt, type, indexes ) {
            var id = $.map(tabletambahpeserta.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
            var foto = $.map(tabletambahpeserta.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
            var name = $.map(tabletambahpeserta.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
            var tempat = $.map(tabletambahpeserta.rows({ selected: true }).data(),function(item){
                        return item[4];
                    }); 
            var htmlpeserta = '<div class="col-sm-4" id="widgetpeserta'+counterpeserta+'">';
                htmlpeserta += '<div class="box box-widget">';
                    htmlpeserta += '<div class="box-header with-border">' ;
                        htmlpeserta += '<div class="user-block">';
                            htmlpeserta += '<img class="img-circle" src="'+foto+'" alt="User Image">';
                            htmlpeserta += '<input type="text" name="peserta[]" style="display:none;" value="'+id+'"/>'
                            htmlpeserta += '<span class="username"><a href="#">'+name+'</a></span>';
                            htmlpeserta += '<span class="description"><small>'+tempat+'</small></span>';
                        htmlpeserta += '</div>';
                        htmlpeserta += '<div class="box-tools">';   
                            htmlpeserta += '<button type="button" class="btn btn-box-tool" onclick="func_pesertakurang()"><i class="fa fa-times"></i></button>';
                        htmlpeserta += '</div>';          
                    htmlpeserta += '</div>';            
                htmlpeserta += '</div>';                
                htmlpeserta += '</div>';

            areapeserta.prepend(htmlpeserta);
            counterpeserta++;
        } );

        function func_pesertakurang()
        {
            counterpeserta--;
            $('#widgetpeserta'+counterpeserta).remove();
        }
</script>
@stop