<?php

use App\pekerjaan;
$title = "Detail Diklat";
$kelas = "kegiatan";
$imagepath = "images_tempat/";
$imagepath2 = "images_staf/";
$cu = Auth::user()->getCU();
$now = Date::now()->format('Y-m-d');

if($data->tanggal2 <= $now && empty($data->deleted_at)){
    $statuskegiatan = 'terlaksana';
}elseif(!empty($data->deleted_at)){
    $statuskegiatan = 'batal';
}else{
    $statuskegiatan = "";
}

if($data->status == 1){
    $status = '<a class="btn btn-default btn-sm nopointer btn-block">MENUNGGU</a>';
}elseif($data->status == 2){
    $status = '<a class="btn btn-warning btn-sm nopointer btn-block">PENDAFTARAN TERBUKA</a>';
}elseif($data->status == 3){
    $status = '<a class="btn btn-warning btn-sm disabled btn-block">PENDAFTARAN TERTUTUP</a>';
}elseif($data->status == 4){
    $status = '<a class="btn btn-danger btn-sm nopointer btn-block"><i class="fa fa-times"></i> BATAL</a>';
}else{
    $status = "-";
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
        <li><a href="{{ URL::to('admins/kegiatan') }}"><i class="fa fa-suitcase"></i> Kegiatan</a></li>
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
                    {!! $status !!}
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
            @if(!empty($data->prasyarat))
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
            @endif
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
                    @if(!empty($data->deskripsi) && !empty($data->peserta) && !empty($data->tujuan) && !empty($data->ruang) && !empty($data->informasi))
                        <li class="{{ $tabname == 'informasi' ? 'active' : '' }}"><a href="#informasi" data-toggle="tab">Informasi</a></li>
                    @else 
                        <?php $tabname = 'pendaftaran'; ?>    
                    @endif
                    <li class="{{ $tabname == 'pendaftaran' ? 'active' : '' }}"><a href="#pendaftaran" data-toggle="tab">Pendaftaran</a></li>
                </ul>
                <div class="tab-content">
                    @if(!empty($data->deskripsi) && !empty($data->peserta) && !empty($data->tujuan) && !empty($data->ruang) && !empty($data->informasi))
                        <div class="fade tab-pane {{ $tabname == 'informasi' ? 'in active' : '' }}" id="informasi">
                            @if(!empty($data->deskripsi))
                                <section id="deskripsi">
                                    <h4 class="page-header color1">Deskripsi</h4>
                                        {!! $data->deskripsi !!}
                                    <br/>
                                </section>
                            @endif
                            @if(!empty($data->peserta))
                                <section id="peserta">
                                    <h4 class="page-header color1">Peserta</h4>
                                        {!! $data->peserta !!}
                                    <br/>
                                </section>
                            @endif
                            @if(!empty($data->tujuan))
                                <section id="tujuan">
                                    <h4 class="page-header color1">Tujuan</h4>
                                        {!! $data->tujuan !!}
                                    <br/>
                                </section>
                            @endif
                            @if(!empty($data->ruang))
                                <section id="ruang">
                                    <h4 class="page-header color1">Ruang Lingkup</h4>
                                        {!! $data->ruang !!}
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
                    @endif    
                    <!-- /.tab-pane -->
                    <div class="fade tab-pane {{ $tabname == 'pendaftaran' ? 'in active' : '' }}" id="pendaftaran">
                        @if($cu == '0')
                            <section id="panitia">
                                <h4 class="page-header color1">Fasilitator & Panitia</h4>
                                <table class="table table-hover dt-responsive" id="datatablepanitia" cellspacing="0" width="100%">
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
                                        <th>&nbsp;</th>
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
                                                        if(!empty($p->cuprimer)){
                                                            $tempat .= 'CU ' . $p->cuprimer->name ;
                                                            $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                                        }
                                                    }elseif($p->tipe == "2"){
                                                        if(!empty($p->lembaga)){
                                                            $tempat .= $p->lembaga->name;
                                                            $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                                        }
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
                                            @if(!empty($datap->staf->gambar) && is_file($imagepath2.$datap->staf->gambar."n.jpg"))
                                                <td style="white-space: nowrap"><div class="modalphotos" >
                                                        {{ Html::image($imagepath2.$datap->staf->gambar.'n.jpg',asset($imagepath2.$datap->staf->gambar."jpg"),
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
                                <br/><br/>
                            </section>
                        @endif
                        <section id="peserta">
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
                                    <th>&nbsp;</th>
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
                                                        if(!empty($p->cuprimer)){
                                                            $tempat .= 'CU ' . $p->cuprimer->name ;
                                                            $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                                        }
                                                    }elseif($p->tipe == "2"){
                                                        if(!empty($p->lembaga)){
                                                            $tempat .= $p->lembaga->name;
                                                            $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                                        }
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
                                        @if(!empty($datap->staf->gambar) && is_file($imagepath2.$datap->staf->gambar."n.jpg"))
                                            <td style="white-space: nowrap"><div class="modalphotos" >
                                                    {{ Html::image($imagepath2.$datap->staf->gambar.'n.jpg',asset($imagepath2.$datap->staf->gambar."jpg"),
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
        {{ Form::open(array('route' => array('admins.'.$kelas.'.store_panitia'),'role' => 'form','id'=>'form_panitia')) }}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light-blue-active color-palette">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 clasas="modal-title"><i class="fa fa-plus"></i> Tambah Panitia</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="id_kegiatan" value="{{ $data->id }}" hidden>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_pilih_panitia" data-toggle="tab" id='nav_pilih_panitia' data-target="#tab_pilih_panitia">Pilih</a></li>
                            <li><a href="#tab_baru_panitia" data-toggle="tab" id='nav_baru_panitia' data-target="#tab_baru_panitia">Buat Baru</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab_pilih_panitia">
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
                                        <table class="table table-hover dt-responsive" id="datatabletambahpanitia" cellspacing="0" width="100%">
                                            @include('admins.kegiatan._component.tambahtable')
                                        </table>
                                    </div>
                                 </div>   
                            </div>
                            <div class="tab-pane" id="tab_baru_panitia">
                                <a href="{{ route('admins.staf.create')}}" class="btn btn-default btn-block"><i class="fa fa-plus"></i> Tambah Staf</a>
                            </div>
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
                        <table class="table table-condensed dt-responsive" style="margin-bottom: 0px;">
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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_pilih_peserta" data-toggle="tab" id='nav_pilih_peserta' data-target="#tab_pilih_peserta">Pilih</a></li>
                        <li><a href="#tab_baru_peserta" data-toggle="tab" id='nav_baru' data-target="#tab_baru_peserta">Buat Baru</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_pilih_peserta">
                            <div class="row">
                                <div id="areapeserta"></div>
                                <div class="col-sm-12"><button type="button" id="warningpeserta" class="btn btn-danger nopointer btn-block" style="display: none;"> </button></div>
                                <div class="col-sm-12"><hr/></div>
                                <div class="col-sm-12">
                                    <div class="input-group tabletools">
                                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                        <input type="text" id="searchpeserta" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                                    </div>
                                    <table class="table table-hover dt-responsive" id="datatabletambahpeserta" cellspacing="0" width="100%">
                                        @include('admins.kegiatan._component.tambahtable')
                                    </table>
                                </div>
                             </div>   
                        </div>
                        <div class="tab-pane fade" id="tab_baru_peserta">
                            <a href="{{ route('admins.staf.create')}}" class="btn btn-default btn-block"><i class="fa fa-plus"></i> Tambah Staf</a>
                        </div>
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
                                    <label><input type="radio" name="radiostatus" value="1" id="checkpending" /> MENUNGGU</label>
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
{{-- panitia --}}
@if($cu == '0')
<script>
    $('#nav_pilih').on('click',function(e){
        e.preventDefault();
        $('#form_panitia').attr('action',"{{ route('admins.'.$kelas.'.store_panitia') }}");
    })
    $('#nav_baru').on('click',function(e){
        e.preventDefault();
        $('#form_panitia').attr('action', "{{ route('admins.staf.store_panitia_new') }}");
    })

    var tablepanitia = $('#datatablepanitia').DataTable({
        dom: 'Bti',
        scrollY: '70vh',
        autoWidth: true,
        scrollCollapse : true,
        paging : false,
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
        buttons: [
        @if($data->status == 2)
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

    var areapanitia = $('#areapanitia');

    var tabletambahpanitia = $('#datatabletambahpanitia').DataTable({
        dom: 'tip',
        autoWidth: true,
        paging : true,
        pagingType: 'full_numbers',
        stateSave : false ,
        select: {
            style:    'multiple',
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
            "paginate": {
              "previous": "&lt;",
              "next": "&gt;",
              "first": "&lt;&lt;",
              "last": "&gt;&gt;"
            }
        }
    });

    tabletambahpanitia.columns('.sort').order('asc').draw();

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
        dom: 'Bti',
        scrollY: '70vh',
        autoWidth: true,
        scrollCollapse : true,
        paging : false,
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
        buttons: [
        @if($data->status == 2)
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

    var areapeserta = $('#areapeserta');

    var tabletambahpeserta = $('#datatabletambahpeserta').DataTable({
        dom: 'tip',
        autoWidth: true,
        paging : true,
        pagingType: 'full_numbers',
        stateSave : false ,
        select: {
            style:    'single',
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
            "paginate": {
              "previous": "&lt;",
              "next": "&gt;",
              "first": "&lt;&lt;",
              "last": "&gt;&gt;"
            }
        }
    });

    tabletambahpeserta.columns('.sort').order('asc').draw();


    $('#searchpeserta').keyup(function(){
        tabletambahpeserta.search($(this).val()).draw() ;
    });

    var counterpeserta = [];
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
            var htmlpeserta = '<div class="col-sm-4" id="widgetpeserta'+id+'">';
                htmlpeserta += '<div class="box box-widget">';
                    htmlpeserta += '<div class="box-header with-border">' ;
                        htmlpeserta += '<div class="user-block">';
                            htmlpeserta += '<img class="img-circle" src="'+foto+'" alt="User Image">';
                            htmlpeserta += '<input type="text" name="peserta[]" style="display:none;" value="'+id+'"/>'
                            htmlpeserta += '<span class="username"><a href="#">'+name+'</a></span>';
                            htmlpeserta += '<span class="description"><small>'+tempat+'</small></span>';
                        htmlpeserta += '</div>';
                        htmlpeserta += '<div class="box-tools">';   
                            htmlpeserta += '<button type="button" class="btn btn-box-tool" onclick="func_pesertakurang('+id+')"><i class="fa fa-times"></i></button>';
                        htmlpeserta += '</div>';          
                    htmlpeserta += '</div>';            
                htmlpeserta += '</div>';                
                htmlpeserta += '</div>';

                ids = id + "";
                
                if(jQuery.inArray(ids, counterpeserta) == -1){
                    areapeserta.prepend(htmlpeserta);
                    counterpeserta.push(ids);
                    $('#warningpeserta').hide();
                }else{
                    $('#warningpeserta').show();
                    $('#warningpeserta').text('Peserta bernama ' + name + ' sudah dipilih');
                }
        } );

        function func_pesertakurang(value)
        {   
            counterpeserta.splice($.inArray(value,counterpeserta),1);
            $('#widgetpeserta'+value).remove();
        }
</script>
@stop