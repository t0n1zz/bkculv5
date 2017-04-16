<?php
$title = "Detail Kegiatan";
$kelas = "kegiatan";
$imagepath = "images_tempat/";
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
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h2 class="profile-username text-center">{{ $data->name }}</h2>
                    @if(!empty($datatempat->kota))
                        <p class="text-muted text-center">{{ $datatempat->kota }}</p>
                    @endif        
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
                    @if($data->status == "1")
                        <a href="#" class="btn btn-warning btn-block"><b><i class="fa fa-check"></i> Sudah Terlaksana</b></a>
                    @elseif($data->status == "2")
                        <a href="#" class="btn btn-danger btn-block"><b><i class="fa fa-times"></i> Tidak Terlaksana</b></a>
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
                    @foreach($datasasaran as $key)
                       <span class="label label-info" style="font-size: 100%;">{{ $key->sasaran->name }}</span>
                    @endforeach
                    </p>
                </div>
                <!-- /.box-body -->
            </div>
            @if(!empty($datatempat))
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tempat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(!empty($datatempat->gambar) && is_file($imagepath.$datatempat->gambar."n.jpg"))
                        <div class="modalphotos">
                        <img class="img-responsive " src="{{ asset($imagepath.$datatempat->gambar.'n.jpg') }}"
                             id="tampilgambar" alt="{{ asset($imagepath.$datatempat->gambar."jpg") }}">
                        </div>
                    @endif
                    <h4>{{ $datatempat->name }}</h4>
                    <p class="text-muted">{{ $datatempat->keterangan }}</p>
                </div>
                <!-- /.box-body -->
            </div>
            @endif
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#peserta" data-toggle="tab">Panitia & Peserta</a></li>
                    <li><a href="#tujuan" data-toggle="tab">Informasi Umum</a></li>
                </ul>
                <div class="tab-content">
                    <div class="fade in active  tab-pane" id="peserta">
                        <section id="panitia">
                            <h4 class="page-header color1">Fasilitator & Panitia</h4>
                            <table class="table table-hover dt-responsive nowarp" id="datatablepanitia" cellspacing="0" width="100%">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th data-sortable="false">#</th>
                                    <th hidden></th>
                                    <th data-sortable="false"><i class="fa fa-picture-o"></i></th>
                                    <th>Nama </th>
                                    <th class="none">NIM</tH>
                                    <th class="none">NID</tH>
                                    <th>Lembaga</th>
                                    <th>Jabatan</th>
                                    <th>Tugas</th>
                                    <th>Tgl. Daftar</th>
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
                                @foreach($datapanitia as $datap)
                                    <?php
                                        $date = new Date($data->tanggal_lahir);

                                        $datapekerjaan = App\StafPekerjaan::where('id_staf',$datap->id_peserta);
                                        $newarr = explode("\n",$datap->staf->alamat);
                                        foreach($newarr as $str){
                                            $alamat = $str;
                                        }

                                        $newarr2 = explode("\n",$datap->staf->kontak);
                                        foreach($newarr2 as $str2){
                                            $kontak = $str2;
                                        }

                                        if($datap->staf->status == 1){
                                            $status = "Menikah";
                                        }elseif($datap->staf->status == 2){
                                            $status = "Belum Menikah";
                                        }elseif($datap->staf->status == 3){
                                            $status = "Duda/Janda";
                                        }else{
                                            $status = "";
                                        }

                                        if(!empty($datapekerjaan->tipe))
                                        {
                                            if($datapekerjaan->tipe == 1){
                                                $tempat = App\Cuprimer::where('no_ba',$datapekerjaan->tempat)->first();
                                                $tempat = 'CU ' .$tempat->name;
                                            }elseif($datapekerjaan->tipe == 2){
                                                $tempat = App\Lembaga::where('id',$datapekerjaan->tempat)->first();
                                                $tempat = $tempat->name;
                                            }elseif($datapekerjaan->tipe == 3){
                                                $tempat = "Puskopdit BKCU Kalimantan";
                                            }
                                        }else{
                                            $tempat = '';
                                        }
                                        

                                        $pendidikan = App\StafPendidikan::where('id_staf',$datap->id_peserta)->first();
                                    ?>
                                    <tr>
                                        <td class="bg-aqua disabled color-palette"></td>
                                        <td hidden>{{ $datap->id }}</td>
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
                                        <td>{{ $datap->staf->nim }}</td>
                                        <td>{{ $datap->staf->nid }}</td>
                                        <td> {{ $tempat }}</td>
                                        @if(!empty($datapekerjaan->name))
                                            <td>{{ $datapekerjaan->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $datap->tugas }}</td>
                                        @if(!empty($pendidikan))
                                            <td>{{ $pendidikan->tingkat }} di {{ $pendidikan->tempat }}</td>
                                        @else
                                            <td></td>    
                                        @endif
                                        <td data-order="{{ $datap->created_at }}">@if(!empty($datap->created_at)){{ $datap->created_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                        <td>{{ $status }}</td>
                                        <td>{{ $datap->staf->agama }}</td>
                                        <td data-order="{{ $data->tanggal_lahir }}">{{ $date->format('d M Y') }}</td>
                                        <td>{{ $datap->staf->age }} Tahun</td>
                                        <td>{{ $alamat }}</td>
                                        <td>{{ $kontak }}</td>
                                        <td></td>
                                    </tr>   
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="peserta">
                             <br/><br/>
                            <h4 class="page-header color1">Peserta</h4>
                            <table class="table table-hover dt-responsive nowarp" id="datatablepeserta" cellspacing="0" width="100%">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th data-sortable="false">#</th>
                                    <th hidden></th>
                                    <th data-sortable="false"><i class="fa fa-picture-o"></i></th>
                                    <th>Nama </th>
                                    <th class="none">NIM</tH>
                                    <th class="none">NID</tH>
                                    <th>Lembaga</th>
                                    <th>Jabatan</th>
                                    <th>Tgl. Daftar</th>
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
                                @foreach($datapeserta as $datap)
                                    <?php
                                        $date = new Date($data->tanggal_lahir);

                                        $datapekerjaan = App\StafPekerjaan::where('id_staf',$datap->id_peserta);
                                        $newarr = explode("\n",$datap->staf->alamat);
                                        foreach($newarr as $str){
                                            $alamat = $str;
                                        }

                                        $newarr2 = explode("\n",$datap->staf->kontak);
                                        foreach($newarr2 as $str2){
                                            $kontak = $str2;
                                        }

                                        if($datap->staf->status == 1){
                                            $status = "Menikah";
                                        }elseif($datap->staf->status == 2){
                                            $status = "Belum Menikah";
                                        }elseif($datap->staf->status == 3){
                                            $status = "Duda/Janda";
                                        }else{
                                            $status = "";
                                        }

                                        if(!empty($datapekerjaan->tipe))
                                        {
                                            if($datapekerjaan->tipe == 1){
                                                $tempat = App\Cuprimer::where('no_ba',$datapekerjaan->tempat)->first();
                                                $tempat = 'CU ' .$tempat->name;
                                            }elseif($datapekerjaan->tipe == 2){
                                                $tempat = App\Lembaga::where('id',$datapekerjaan->tempat)->first();
                                                $tempat = $tempat->name;
                                            }elseif($datapekerjaan->tipe == 3){
                                                $tempat = "Puskopdit BKCU Kalimantan";
                                            }
                                        }else{
                                            $tempat = '';
                                        }
                                        

                                        $pendidikan = App\StafPendidikan::where('id_staf',$datap->id_peserta)->first();
                                    ?>
                                    <tr>
                                        <td class="bg-aqua disabled color-palette"></td>
                                        <td hidden>{{ $datap->id }}</td>
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
                                        <td>{{ $datap->staf->nim }}</td>
                                        <td>{{ $datap->staf->nid }}</td>
                                        <td> {{ $tempat }}</td>
                                        @if(!empty($datapekerjaan->name))
                                            <td>{{ $datapekerjaan->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td data-order="{{ $datap->created_at }}">@if(!empty($datap->created_at)){{ $datap->created_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                        @if(!empty($pendidikan))
                                            <td>{{ $pendidikan->tingkat }} di {{ $pendidikan->tempat }}</td>
                                        @else
                                            <td></td>    
                                        @endif
                                        <td>{{ $status }}</td>
                                        <td>{{ $datap->staf->agama }}</td>
                                        <td data-order="{{ $data->tanggal_lahir }}">{{ $date->format('d M Y') }}</td>
                                        <td>{{ $datap->staf->age }} Tahun</td>
                                        <td>{{ $alamat }}</td>
                                        <td>{{ $kontak }}</td>
                                        <td></td>
                                    </tr>   
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="fade tab-pane" id="tujuan">
                        @if(!empty($data->tujuan))
                            <section id="tujuan">
                                <h4 class="page-header color1">Tujuan</h4>
                                {!! $data->tujuan !!}
                                 <br/>
                            </section>
                        @endif
                        @if(!empty($data->pokok))
                            <section id="pokok">
                                <h4 class="page-header color1">Pokok Bahasan</h4>
                                {!! $data->pokok !!}
                                 <br/>
                            </section>
                        @endif
                        @if(!empty($data->keterangan))
                            <section id="informasi">
                                <h4 class="page-header color1">Informasi Tambahan</h4>
                                {!! $data->keterangan !!}
                                 <br/>
                            </section> 
                            </div>
                        @endif    
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
                    </div>
                    <div class="col-sm-12"><hr/></div>
                    <div class="col-sm-12">
                        <div class="input-group tabletools">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" id="searchpanitia" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                        </div>
                        <table class="table table-hover dt-responsive nowarp" id="datatabletambahpanitia" cellspacing="0" width="100%">
                            <thead>
                            <tr class="bg-light-blue-active color-palette">
                                <th data-sortable="false">#</th>
                                <th hidden></th>
                                <th data-sortable="false"></th>
                                <th hidden></th>
                                <th data-sortable="false"><i class="fa fa-picture-o"></i></th>
                                <th>Nama </th>
                                <th class="none">NIM</tH>
                                <th class="none">NID</tH>
                                <th>Lembaga</th>
                                <th>Jabatan</th>
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

                                    $newarr = explode("\n",$dataf->staf->alamat);
                                    foreach($newarr as $str){
                                        $alamat = $str;
                                    }

                                    $newarr2 = explode("\n",$dataf->staf->kontak);
                                    foreach($newarr2 as $str2){
                                        $kontak = $str2;
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

                                    if($dataf->tipe == 1){
                                        $tempat = App\Cuprimer::where('no_ba',$dataf->tempat)->first();
                                        $tempat = 'CU ' .$tempat->name;
                                    }elseif($dataf->tipe == 2){
                                        $tempat = App\Lembaga::where('id',$dataf->tempat)->first();
                                        $tempat = $tempat->name;
                                    }elseif($dataf->tipe == 3){
                                        $tempat = "Puskopdit BKCU Kalimantan";
                                    }

                                    $pendidikan = App\StafPendidikan::where('id_staf',$dataf->id_staf)->first();

                                    $date = new Date($dataf->mulai); 
                                    $date2 = new Date($dataf->selesai); 
                                ?>
                                <tr>
                                    <td class="bg-aqua disabled color-palette"></td>
                                    <td hidden>{{ $dataf->id_staf }}</td>
                                    <td></td>
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
                                    <td>{{ $dataf->staf->nim }}</td>
                                    <td>{{ $dataf->staf->nid }}</td>
                                    <td> {{ $tempat }}</td>
                                    @if(!empty($datapekerjaan->name))
                                        <td>{{ $datapekerjaan->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(!empty($pendidikan))
                                        <td>{{ $pendidikan->tingkat }} di {{ $pendidikan->tempat }}</td>
                                    @else
                                        <td></td>    
                                    @endif
                                    <td>{{ $status }}</td>
                                    <td>{{ $dataf->staf->agama }}</td>
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
                        <table class="table table-hover dt-responsive nowarp" id="datatabletambahstaf" cellspacing="0" width="100%">
                            <thead>
                            <tr class="bg-light-blue-active color-palette">
                                <th data-sortable="false">#</th>
                                <th hidden></th>
                                <th data-sortable="false"></th>
                                <th hidden></th>
                                <th data-sortable="false"><i class="fa fa-picture-o"></i></th>
                                <th>Nama </th>
                                <th class="none">NIM</tH>
                                <th class="none">NID</tH>
                                <th>Lembaga</th>
                                <th>Jabatan</th>
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
                                    
                                    $newarr = explode("\n",$dataf->staf->alamat);
                                    foreach($newarr as $str){
                                        $alamat = $str;
                                    }

                                    $newarr2 = explode("\n",$dataf->staf->kontak);
                                    foreach($newarr2 as $str2){
                                        $kontak = $str2;
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

                                    if($dataf->tipe == 1){
                                        $tempat = App\Cuprimer::where('no_ba',$dataf->tempat)->first();
                                        $tempat = 'CU ' .$tempat->name;
                                    }elseif($dataf->tipe == 2){
                                        $tempat = App\Lembaga::where('id',$dataf->tempat)->first();
                                        $tempat = $tempat->name;
                                    }elseif($dataf->tipe == 3){
                                        $tempat = "Puskopdit BKCU Kalimantan";
                                    }

                                    $pendidikan = App\StafPendidikan::where('id_staf',$dataf->id_staf)->first();

                                    $date = new Date($dataf->mulai); 
                                    $date2 = new Date($dataf->selesai); 
                                ?>
                                <tr>
                                    <td class="bg-aqua disabled color-palette"></td>
                                    <td hidden>{{ $dataf->id_staf }}</td>
                                    <td></td>
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
                                    <td>{{ $dataf->staf->nim }}</td>
                                    <td>{{ $dataf->staf->nid }}</td>
                                    <td> {{ $tempat }}</td>
                                    @if(!empty($datapekerjaan->name))
                                        <td>{{ $datapekerjaan->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(!empty($pendidikan))
                                        <td>{{ $pendidikan->tingkat }} di {{ $pendidikan->tempat }}</td>
                                    @else
                                        <td></td>    
                                    @endif
                                    <td>{{ $status }}</td>
                                    <td>{{ $dataf->staf->agama }}</td>
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
{{-- panitia dan peserta --}}
<script>
    var tablepanitia = $('#datatablepanitia').DataTable({
        dom: 'Bft',
        select: true,
        scrollY: '50vh',
        autoWidth: true,
        scrollCollapse : true,
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
        } ],
        paging : false,
        stateSave : true,
        order : [[ 1, "asc" ]],
        buttons: [
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
                        $('#modal1show').modal({show:true});
                        $('#modal1id').attr('value',id);
                    }
                }
            }
        ],
        language: {
            buttons : {
                colvis: "<i class='fa fa-columns'></i> Kolom",
            },
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "emptyTable": "Tidak terdapat data di tabel",
            "info": "",
            "infoEmpty": "",
            "infoFiltered":   "",
            "search": "<i class='fa fa-search'></i> Cari:",
            "paginate": {
                "next":       ">",
                "previous":   "<"
            },
            "zeroRecords": "Tidak ditemukan data yang sesuai",
        }
    });
    tablepanitia.on( 'order.dt search.dt', function () {
        tablepanitia.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw(); 
    //table peserta
    var tablepeserta = $('#datatablepeserta').DataTable({
        dom: 'Bft',
        select: true,
        scrollY: '50vh',
        autoWidth: true,
        scrollCollapse : true,
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
        } ],
        paging : false,
        stateSave : false,
        buttons: [
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
                        $('#modal1show').modal({show:true});
                        $('#modal1id').attr('value',id);
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
    tablepeserta.on( 'order.dt search.dt', function () {
        tablepeserta.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw(); 
</script>
{{-- daftar panitia --}}
<script>
    var areapanitia = $('#areapanitia');

    var tabletambahpanitia = $('#datatabletambahpanitia').DataTable({
        dom: 't',
        select: {
            style:    'os',
            selector: 'td:nth-child(3)'
        },
        scrollY: '50vh',
        autoWidth: true,
        scrollCollapse : true,
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
            orderable: false,
            className: 'select-checkbox',
            targets:   2
        } ],
        paging : false,
        stateSave : false ,
        language: {
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "emptyTable": "Tidak terdapat data di tabel",
            "info": "",
            "infoEmpty": "",
            "infoFiltered":   "",
            "search": "<i class='fa fa-search'></i> Cari:",
            "paginate": {
                "next":       ">",
                "previous":   "<"
            },
            "zeroRecords": "Tidak ditemukan data yang sesuai",
        }
    });
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
                        return item[1];
                    });
            var foto = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
            var name = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[5];
                    });
            var tempat = $.map(tabletambahpanitia.rows({ selected: true }).data(),function(item){
                        return item[8];
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
{{-- daftar peserta --}}
<script>
    var areapeserta = $('#areapeserta');
    var counterpeserta = 0;

    var tabletambahstaf = $('#datatabletambahstaf').DataTable({
        dom: 't',
        select: {
            style:    'os',
            selector: 'td:nth-child(3)'
        },
        scrollY: '50vh',
        autoWidth: true,
        scrollCollapse : true,
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
            orderable: false,
            className: 'select-checkbox',
            targets:   2
        } ],
        paging : false,
        stateSave : false ,
        language: {
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "emptyTable": "Tidak terdapat data di tabel",
            "info": "",
            "infoEmpty": "",
            "infoFiltered":   "",
            "search": "<i class='fa fa-search'></i> Cari:",
            "paginate": {
                "next":       ">",
                "previous":   "<"
            },
            "zeroRecords": "Tidak ditemukan data yang sesuai",
        }
    });
    tabletambahstaf.on( 'order.dt search.dt', function () {
        tabletambahstaf.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw(); 

    $('#searchstaf').keyup(function(){
        tabletambahstaf.search($(this).val()).draw() ;
    });

    tabletambahstaf
        .on( 'select', function ( e, dt, type, indexes ) {
            var id = $.map(tabletambahstaf.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
            var foto = $.map(tabletambahstaf.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
            var name = $.map(tabletambahstaf.rows({ selected: true }).data(),function(item){
                        return item[5];
                    });
            var tempat = $.map(tabletambahstaf.rows({ selected: true }).data(),function(item){
                        return item[8];
                    }); 
            var htmlstaf = '<div class="col-sm-4" id="widgetpeserta'+counterpeserta+'">';
                htmlstaf += '<div class="box box-widget">';
                    htmlstaf += '<div class="box-header with-border">' ;
                        htmlstaf += '<div class="user-block">';
                            htmlstaf += '<img class="img-circle" src="'+foto+'" alt="User Image">';
                            htmlstaf += '<input type="text" name="peserta[]" style="display:none;" value="'+id+'"/>'
                            htmlstaf += '<span class="username"><a href="#">'+name+'</a></span>';
                            htmlstaf += '<span class="description"><small>'+tempat+'</small></span>';
                        htmlstaf += '</div>';
                        htmlstaf += '<div class="box-tools">';   
                            htmlstaf += '<button type="button" class="btn btn-box-tool" onclick="func_pesertakurang()"><i class="fa fa-times"></i></button>';
                        htmlstaf += '</div>';          
                    htmlstaf += '</div>';            
                htmlstaf += '</div>';                
                htmlstaf += '</div>';

            areapeserta.prepend(htmlstaf);
            counterpeserta++;
        } );

        function func_pesertakurang()
        {
            counterpeserta--;
            $('#widgetpeserta'+counterpeserta).remove();
        }
</script>
@stop