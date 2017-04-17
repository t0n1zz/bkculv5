<?php
$title = "Detail Staf";
$kelas = "staf";
$imagepath = "images_staf/";

if(!empty($data->tanggal_lahir) && $data->tanggal_lahir != "0000-00-00"){
    $date = new Date($data->tanggal_lahir);
}

$pekerjaan = array();
foreach ($riwayatpekerjaan as $j){
    $tempat = "";
    if($j->tipe == 1){
        foreach($culists as $cu){
            if($j->tempat == $cu->id){
                $tempat = "CU " .$cu->name;
            }
        }
    }elseif($j->tipe == 2){
        foreach($lembagas as $lembaga){
            if($j->tempat == $lembaga->id){
                $tempat = $lembaga->name;
            }
        }
    }elseif($j->tipe == 3){
        $tempat = "Puskopdit BKCU Kalimantan";
    }

    if(!empty($j->selesai)){
         $selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->selesai);
         $now =   \Carbon\Carbon::now();

        if($j->tingkat != 'Pengurus' && $j->tingkat != 'Pengawas'){
            if($j->sekarang == "1" || $selesai >= $now){
                $pekerjaan[] = '<b>'.$j->name.' '.$tempat.'</b>';
            }
        }else{
            if($selesai >= $now){
                $pekerjaan[] = '<b>'.$j->name.' '.$tempat.'</b><br/> periode '.$mulai.' - '.$selesai;
            }
        }
    }else{
        $pekerjaan[] = $j->name.' '.$tempat;
    }
}
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ $title }}
        <small>Informasi Detail Staf </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-sitemap"></i> Kelola Staf</a></li>
        <li class="active"><i class="fa fa-database"></i> {{ $title }}</li>
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
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset($imagepath.$data->gambar.'n.jpg') }}"
                             id="tampilgambar" alt="{{ asset($imagepath.$data->gambar."jpg") }}">
                        </div>
                    @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                        <div class="modalphotos" >
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset($imagepath.$data->gambar) }}"
                             id="tampilgambar" alt="{{ asset($imagepath.$data->gambar) }}">
                        </div>
                    @else
                        @if($data->kelamin == "Wanita")
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/no_image_woman.jpg') }}"
                                 id="tampilgambar" alt="Woman profile">
                        @else
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/no_image_man.jpg') }}"
                                 id="tampilgambar" alt="Man Profile">
                        @endif
                    @endif
                    <h3 class="profile-username text-center">{{ $data->name }}</h3>
                    <p class="text-muted text-center">
                         @if(!empty($pekerjaan))
                            @foreach($pekerjaan as $p)
                                {!! $p  !!} <br/>
                            @endforeach
                        @else
                            -
                        @endif
                    </p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item"><b>NIM</b> <a class="pull-right">{{ $data->nim }}</a></li>
                        <li class="list-group-item"><b>NID</b> <a class="pull-right">{{ $data->nid }}</a></li>
                        <li class="list-group-item"><b>Tempat Lahir</b> <a class="pull-right">{{ $data->tempat_lahir }}</a></li>
                        <li class="list-group-item"><b>Tanggal Lahir</b> <a class="pull-right">{{ $date->format('d F Y') }}</a></li>
                        <li class="list-group-item"><b>Status</b> <a class="pull-right">{{ $data->status }}</a></li>
                        <li class="list-group-item"><b>Agama</b> <a class="pull-right">{{ $data->agama }}</a></li>
                    </ul>
                    <button type="button" class="btn btn-default btn-block" onclick="func_identitas()" style="margin-bottom: .5em;"><i class="fa fa-pencil"></i> Ubah Identitas</button>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Kontak</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(!empty($data->kontak))
                        <?php $newarr = explode("\n",$data->kontak); ?>
                        @foreach($newarr as $str)
                            <p>{{ $str }}</p>
                        @endforeach
                    @else
                        <p>{{ "-" }}</p>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Alamat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(!empty($data->alamat))
                        <?php $newarr = explode("\n",$data->alamat); ?>
                        @foreach($newarr as $str)
                            <p>{{ $str }}</p>
                        @endforeach
                    @else
                        <p>{{ "-" }}</p>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
        </div><!-- /.col -->

        <div class="col-md-9">
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#riwayat" data-toggle="tab">Riwayat</a></li>
                    <li><a href="#kegiatan" data-toggle="tab">Kegiatan</a></li>
                    <li ><a href="#info" data-toggle="tab">Info Lain</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="riwayat">
                        <section id="riwayatpekerjaan">
                            <h4 class="page-header color1">Riwayat Pekerjaan</h4>
                            <table class="table table-hover " id="dataTables-pekerjaan">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th>Jabatan</th>
                                    <th>Tempat</th>
                                    <th>Tingkat</th>
                                    <th>Bidang</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riwayatpekerjaan as $riwayat2)
                                    <?php $bidangs = App\StafBidangHub::with('bidang')->where('id_pekerjaan',$riwayat2->id)->get(); ?>
                                    <tr
                                    @if(!empty($riwayat2->sekarang) && $riwayat2->sekarang != '0')
                                        {!! 'class="highlight"'  !!}
                                    @endif>
                                        <td hidden>{{ $riwayat2->id }}</td>
                                        <td hidden>{{ $riwayat2->tipe }}</td>
                                        <td hidden>{{ $riwayat2->tempat }}</td>
                                        @if(!empty($riwayat2->name))
                                            <td>{{ $riwayat2->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->tempat))
                                            @if($riwayat2->tipe == 1)
                                                @foreach($culists as $cu)
                                                    @if($riwayat2->tempat == $cu->no_ba)
                                                        <td>CU {{ $cu->name }}</td>   
                                                    @endif
                                                @endforeach
                                            @elseif($riwayat2->tipe == 2)
                                                @foreach($lembagas as $lembaga)
                                                    @if($riwayat2->tempat == $lembaga->id)
                                                        <td>{{ $lembaga->name }}</td> 
                                                    @endif
                                                @endforeach
                                            @elseif($riwayat2->tipe == 3)
                                                <td>Puskopdit BKCU Kalimantan</td> 
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif

                                        <td>{{ $riwayat2->tingkat }}</td>
                                        
                                        <td>
                                            @foreach($bidangs as $bidang)
                                                <code>{{ $bidang->bidang->name }}</code>
                                            @endforeach
                                        </td>

                                        @if(!empty($riwayat2->mulai ))
                                            <?php $date = new Date($riwayat2->mulai); ?>
                                            <td data-order="{{$riwayat2->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->sekarang) && $riwayat2->sekarang != '0')
                                            <td data-order="Masih Bekerja">Masih Bekerja</td>
                                        @else
                                            @if(!empty($riwayat2->selesai))
                                                <?php $date2 = new Date($riwayat2->selesai);  ?>
                                                <td data-order="{{$riwayat2->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="riwayatpendidikan">
                            <br/><br/>
                            <h4 class="page-header color1">Riwayat Pendidikan</h4>
                            <table class="table table-hover " id="dataTables-pendidikan">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Tingkat</th>
                                    <th>Jurusan/Bidang</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riwayatpendidikan as $riwayat1)
                                    <tr>
                                        <td hidden>{{ $riwayat1->id }}</td>
                                        @if(!empty($riwayat1->tingkat))
                                            <td>{{ $riwayat1->tingkat }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->name))
                                            <td>{{ $riwayat1->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->tempat))
                                            <td>{{ $riwayat1->tempat}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->mulai ))
                                            <?php $date = new Date($riwayat1->mulai); ?>
                                            <td data-order="{{$riwayat1->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->sekarang) && $riwayat1->sekarang != '0')
                                            <td data-order="Masih Belajar">Masih Belajar</td>
                                        @else
                                            @if(!empty($riwayat1->selesai))
                                                <?php $date2 = new Date($riwayat1->selesai);  ?>
                                                <td data-order="{{$riwayat1->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="riwayatorganisasi">
                            <br/><br/>
                            <h4 class="page-header color1">Riwayat Berorganisasi</h4>
                            <table class="table table-hover " id="dataTables-organisasi">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama Organisasi</th>
                                    <th>Jabatan</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riwayatorganisasi as $riwayat3)
                                    <tr>
                                        <td hidden>{{ $riwayat3->id }}</td>
                                        @if(!empty($riwayat3->name))
                                            <td>{{ $riwayat3->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->jabatan))
                                            <td>{{ $riwayat3->jabatan }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->tempat))
                                            <td>{{ $riwayat3->tempat }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->mulai ))
                                            <?php $date = new Date($riwayat3->mulai); ?>
                                            <td data-order="{{$riwayat3->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->sekarang) && $riwayat3->sekarang != '0')
                                            <td data-order="Masih Aktif">Masih Aktif</td>
                                        @else
                                            @if(!empty($riwayat3->selesai))
                                                <?php $date2 = new Date($riwayat3->selesai);  ?>
                                                <td data-order="{{$riwayat3->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="kegiatan">
                        @if(!empty($diklatbkcus))
                            <section id="diklatbkcu">
                                <h4 class="page-header color1">Diklat Puskopdit BKCU Kalimantan</h4>
                                <table class="table table-hover " id="dataTables-diklatbkcu">
                                    <thead>
                                    <tr class="bg-light-blue-active color-palette">
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($diklatbkcus as $diklatbkcu)
                                        <?php 
                                            if($diklatbkcu->status == 1){
                                                $diklatbkcustatus = "Sudah diikuti";
                                            }elseif($diklatbkcu->status == 2){
                                                $diklatbkcustatus = "Batal diikuti";
                                            }else{
                                                $diklatbkcustatus = "Belum dilaksanakan";
                                            }
                                        ?>
                                        <tr>
                                        @if(!empty($diklatbkcu->kegiatan))
                                            <td>{{ $diklatbkcu->kegiatan->name }}</td>
                                            @if(!empty($diklatbkcu->kegiatan->tempat))
                                                <td>{{ $diklatbkcu->kegiatan->tempat->name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td data-order="{{ $diklatbkcu->kegiatan->mulai }}">@if(!empty($diklatbkcu->kegiatan->mulai )){{ $diklatbkcu->kegiatan->mulai ->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                            <td data-order="{{ $diklatbkcu->kegiatan->selesai }}">@if(!empty($diklatbkcu->kegiatan->selesai )){{ $diklatbkcu->kegiatan->selesai ->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                            <td>{{ $diklatbkcustatus }}</td>
                                            <td class="warptext">{{ $diklatbkcu->keterangan }}</td>
                                        @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </section>
                        @endif
                        @if(!empty($diklatlembaga))
                            <section id="diklatlembaga">
                                <h4 class="page-header color1">Diklat Lembaga Lain</h4>
                                <table class="table table-hover " id="dataTables-diklatlembaga">
                                    <thead>
                                    <tr class="bg-light-blue-active color-palette">
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($diklatlembagas as $diklatlembaga)
                                        <?php 
                                            if($diklatlembaga->status == 1){
                                                $diklatlembagastatus = "Sudah diikuti";
                                            }elseif($diklatlembaga->status == 2){
                                                $diklatlembagastatus = "Batal diikuti";
                                            }else{
                                                $diklatlembagastatus = "Belum dilaksanakan";
                                            }
                                        ?>
                                        <tr>
                                        @if(!empty($diklatlembaga->kegiatan))
                                            <td>{{ $diklatlembaga->kegiatan->name }}</td>
                                            @if(!empty($diklatlembaga->kegiatan->tempat))
                                                <td>{{ $diklatlembaga->kegiatan->tempat->name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td data-order="{{ $diklatlembaga->kegiatan->mulai }}">@if(!empty($diklatlembaga->kegiatan->mulai )){{ $diklatlembaga->kegiatan->mulai ->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                            <td data-order="{{ $diklatlembaga->kegiatan->selesai }}">@if(!empty($diklatlembaga->kegiatan->selesai )){{ $diklatlembaga->kegiatan->selesai ->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                            <td>{{ $diklatlembagastatus }}</td>
                                            <td class="warptext">{{ $diklatlembaga->keterangan }}</td>
                                        @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </section>
                        @endif
                        @if(!empty($rapat))
                            <section id="rapat">
                                <h4 class="page-header color1">Diklat Puskopdit BKCU Kalimantan</h4>
                                <table class="table table-hover " id="dataTables-rapat">
                                    <thead>
                                    <tr class="bg-light-blue-active color-palette">
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rapats as $rapat)
                                        <?php 
                                            if($rapat->status == 1){
                                                $rapatstatus = "Sudah diikuti";
                                            }elseif($rapat->status == 2){
                                                $rapatstatus = "Batal diikuti";
                                            }else{
                                                $rapatstatus = "Belum dilaksanakan";
                                            }
                                        ?>
                                        <tr>
                                        @if(!empty($rapat->kegiatan))
                                            <td>{{ $rapat->kegiatan->name }}</td>
                                            @if(!empty($rapat->kegiatan->tempat))
                                                <td>{{ $rapat->kegiatan->tempat->name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td data-order="{{ $rapat->kegiatan->mulai }}">@if(!empty($rapat->kegiatan->mulai )){{ $rapat->kegiatan->mulai ->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                            <td data-order="{{ $rapat->kegiatan->selesai }}">@if(!empty($rapat->kegiatan->selesai )){{ $rapat->kegiatan->selesai ->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                            <td>{{ $rapatstatus }}</td>
                                            <td class="warptext">{{ $rapat->keterangan }}</td>
                                        @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </section>
                        @endif
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="info">
                        <section id="keluarga">
                            <h4 class="page-header color1">Keluarga</h4>
                            <table class="table table-hover " id="dataTables-keluarga">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama</th>
                                    <th>Sebagai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keluargas as $keluarga)
                                    <tr>
                                        <td hidden>{{ $keluarga->id }}</td>
                                        <td>{{ $keluarga->name }}</td>
                                        <td>{{ $keluarga->tipe }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="anggotacu">
                            <br/><br/>
                            <h4 class="page-header color1">Keanggotaan di CU</h4>
                            <table class="table table-hover " id="dataTables-anggotacu">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama</th>
                                    <th>No. BA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($anggotacus as $anggotacu)
                                    <tr>
                                        <td hidden>{{ $anggotacu->id }}</td>
                                        <td>{{ $anggotacu->name }}</td>
                                        <td>{{ $anggotacu->no_ba }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div><!-- /.tab-pane --> 
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

{{-- ubahidentitas --}}
<div class="modal fade" id="modalidentitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($data,array('route' => array('admins.'.$kelas.'.update',$data->id),'method' => 'put', 'files' => true,
        'data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Ubah Identitas</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="route" value="{{ Route::currentRouteName() }}" hidden>
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Foto</h4>
                        <div class="thumbnail">
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                {{ Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                            @else
                                {{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                            @endif
                            <div class="caption">
                                {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Nama</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staf',
                                            'required','autocomplete'=>'off'))}}
                                    </div>
                                    <div class="help-block">Nama harus diisi.</div>
                                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <h4>Tempat & Tanggal Lahir</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                {{ Form::text('tempat_lahir',null,array('class' => 'form-control', 'placeholder' => 'Tempat'))}}
                                                {{ $errors->first('tempat_lahir', '<p class="text-warning">:message</p>') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <?php
                                                if(!empty($data->tanggal_lahir)){
                                                    $timestamp = strtotime($data->tanggal_lahir);
                                                    $tanggal = date('d/m/Y',$timestamp);
                                                }
                                                ?>
                                                <input type="text" name="tanggal_lahir" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                                       data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <h4>Gender</h4>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                        <select class="form-control" name="kelamin">
                                            <option selected disabled>Jenis kelamin</option>
                                            <option value="Pria"
                                            @if(!empty($data))
                                                @if($data->kelamin == "Pria")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                                    >Pria</option>
                                            <option value="Wanita"
                                            @if(!empty($staff))
                                                @if($staff->kelamin == "Wanita")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                                    >Wanita</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <h4>Agama</h4>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                        <select class="form-control" name="agama">
                                            <option selected disabled>Agama</option>
                                            <option value="Khatolik"
                                            @if(!empty($data))
                                                @if($data->agama == "Khatolik")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                            >Katolik</option>
                                            <option value="Protestan"
                                            @if(!empty($data))
                                                @if($data->agama == "Protestan")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                            >Protestan</option>
                                            <option value="Kong Hu Cu"
                                            @if(!empty($data))
                                                @if($data->agama == "Kong Hu Cu")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                            >Kong Hu Cu</option>
                                            <option value="Buddha"
                                            @if(!empty($data))
                                                @if($data->agama == "Buddha")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                            >Buddha</option>
                                            <option value="Hindu"
                                            @if(!empty($data))
                                                @if($data->agama == "Hindu")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                            >Hindu</option>
                                            <option value="Islam"
                                            @if(!empty($data))
                                                @if($data->agama == "Islam")
                                                    {{ "selected" }}
                                                        @endif
                                                    @endif
                                            >Islam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <h4>Kontak</h4>
                                    {{ Form::textarea('kontak',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan informasi kontak anda yang bisa dihubungi')) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <h4>Alamat</h4>
                                    {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder' => 'Silahkan masukkan alamat tempat tinggal anda saat ini')) }}
                                </div>
                            </div>
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
{{-- ubahidentitas --}}
{{-- modalkeluarga --}}
<div class="modal fade" id="modalkeluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.save_keluarga'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i id="iconkeluarga"></i> <span  id="judulkeluarga"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="id_keluarga" id="id_keluarga" value="" hidden>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Nama</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                {{ Form::text('namekeluarga',null,array('class' => 'form-control','id'=>'namekeluarga', 'placeholder' => 'Silahkan masukkan nama keluarga','required','autocomplete'=>'off'))}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Sebagai</h4>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                <select class="form-control" name="tipekeluarga" id="tipekeluarga">
                                    <option selected disabled>Sebagai</option>
                                    <option value="Ayah">Ayah</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Pasangan">Pasangan</option>
                                    <option value="Anak">Anak</option>
                                </select>
                            </div>
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
{{-- modalkeluarga --}}
{{-- modalanggotacu --}}
<div class="modal fade" id="modalanggotacu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.save_anggotacu'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i id="iconanggotacu"></i> <span  id="judulanggotacu"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="id_anggotacu" id="id_anggotacu" value="" hidden>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <input type="text" class="form-control"  name="namecu" id="namecu" placeholder="Silahkan masukkan nama CU" />
                        <span class="input-group-addon">0-9</span>
                        <input type="text" class="form-control" name="no_ba" id="no_ba" placeholder="Silahkan masukkan no anggota CU" />
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
{{-- modalanggotacu --}}
<!-- modalriwayat -->
<div class="modal fade" id="modalriwayatpekerjaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.save_riwayat'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i id="iconpekerjaan"></i> <span  id="judulpekerjaan"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="id_pekerjaan" id="id_pekerjaan" value="" hidden>
                @include('admins.staf._components.pekerjaan')
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalriwayatpendidikan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.save_riwayat'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i id="iconpendidikan"></i> <span  id="judulpendidikan"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="id_pendidikan" id="id_pendidikan" value="" hidden>
                @include('admins.staf._components.pendidikan')
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalriwayatorganisasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.save_riwayat'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog modal-full">
        <div class="modal-content modal-full">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i id="iconorganisasi"></i> <span  id="judulorganisasi"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="id_organisasi" id="id_organisasi" value="" hidden>
                @include('admins.staf._components.organisasi')
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /modalriwayat -->
<!-- Hapus -->
<div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> <span id="judulhapus"></span></h4>
            </div>
            <div class="modal-body">
                <h4>Menghapus <span id="namahapus"></span> ini?</h4>
                <input type="text" name="tipehapus" id="tipehapus" value="" hidden>
                <input type="text" name="id"  id="idhapus" value="" hidden>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalhapuskeluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_keluarga'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Keluarga</h4>
            </div>
            <div class="modal-body">
                <h4>Menghapus keluarga ini?</h4>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="idhapuskeluarga"  id="idhapuskeluarga" value="" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalhapusanggotacu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_anggotacu'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Keanggotaan di CU</h4>
            </div>
            <div class="modal-body">
                <h4>Menghapus keanggota di CU ini?</h4>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="idhapusanggotacu"  id="idhapusanggotacu" value="" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /Hapus -->
@stop

@section('js')
@include('admins.staf._components.formjs')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
<script>
    $(document).ready(function() {
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        } );
    } );

    function func_identitas(){
        $('#modalidentitas').modal({show:true});
    }
</script>
{{--table pekerjaan--}}
<script>
    var tablepekerjaan = $('#dataTables-pekerjaan').DataTable({
        dom: 'Bft',
        select: true,
        scrollY : '50vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [],
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
    new $.fn.dataTable.Buttons(tablepekerjaan,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalriwayatpekerjaan').modal({show:true});
                    $('#judulpekerjaan').text('Tambah Pekerjaan');
                    $('#iconpekerjaan').attr('class','fa fa-plus');

                    $('#id_pekerjaan').val('');
                    $('#tipepekerjaan').val('');
                    $('#namapekerjaan').val('');
                    $('#sekarangpekerjaan').val('0');
                    $('#mulaipekerjaan').val('');
                    $('#selesaipekerjaan').val('');

                    $('#jabatan').hide();
                    $('#waktupekerjaan').hide();
                    $('#lembagabaru').hide();
                    $('#tingkatcu').hide();
                    $('#tingkatlembaga').hide();
                    $('#bidang').hide();

                    $("#radiocu").prop("checked", false);
                    $("#radiolembaga").prop("checked", false);

                    $('#selectcu').prop('disabled',true);
                    $('#selectlembaga').prop('disabled',true);

                    $('#selectcu').val($('#selectcu option:first').val());
                    $('#selectlembaga').val($('#selectlembaga option:first').val());
                    $('#selecttingkatcu').val($('#selecttingkatcu option:first').val());
                    $('#selecttingkatlembaga').val($('#selecttingkatlembaga option:first').val());

                    $('#masihpekerjaan').hide();
                    $('#groupselesaipekerjaan').show();
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var tipe = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var tempat = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var name = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var tingkat = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[5];
                    });
                    var bidang = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[6];
                    });
                    var mulai = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[7].display;;
                    });
                    var selesai = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[8].display;;
                    });

                    if(id != ""){
                        $('#modalriwayatpekerjaan').modal({show:true});
                        $('#judulpekerjaan').text('Ubah Pekerjaan');
                        $('#iconpekerjaan').attr('class','fa fa-pencil');

                        $('#jabatan').show();
                        $('#waktupekerjaan').show();
                        $('#lembagabaru').hide();

                        $('#id_pekerjaan').val(id);
                        $('#tipepekerjaan').val(tipe);
                        $('#namapekerjaan').val(name);

                        if(tipe == "1" || tipe == "3"){ //cu
                            $('#tingkatcu').show();
                            $('#tingkatlembaga').hide();

                            $('#selecttingkatcu').val(tingkat);
                            
                            if(tingkat == "Senior Manajer" ||tingkat == "Pengawas" || tingkat == "Komite"){
                                $('#bidang').hide();
                            }else{
                                $('#bidang').show();
                            }

                            $("#radiocu").prop("checked", true);
                            $('#selectcu').prop('disabled',false);
                            $('#selectcu').val(tempat);

                            $("#radiolembaga").prop("checked", false);
                            $('#selectlembaga').prop('disabled',true);
                            $('#selectlembaga').val($('#selectlembaga option:first').val());
                        }else{ //lembaga
                            $('#tingkatlembaga').show();
                            $('#selecttingkatlembaga').val(tingkat);

                            $("#radiocu").prop("checked", false);
                            $('#selectcu').prop('disabled',true);
                            $('#selectcu').val($('#selectcu option:first').val());

                            $("#radiolembaga").prop("checked", true);
                            $('#selectlembaga').prop('disabled',false);
                            $('#selectlembaga').val(tempat);
                        }

                        $('#mulaipekerjaan').val(mulai);

                        if(selesai == "Masih Bekerja"){
                            $('#sekarangpekerjaan').val('1');
                            $('#masihpekerjaan').show();
                            $('#groupselesaipekerjaan').hide();
                        }else{
                            $('#sekarangpekerjaan').val('0');
                            $('#masihpekerjaan').hide();
                            $('#groupselesaipekerjaan').show();
                            $('#selesaipekerjaan').val(selesai);
                        }
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function(){
                    var id = $.map(tablepekerjaan.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapus').modal({show:true});
                        $('#judulhapus').text('Pekerjaan');
                        $('#namahapus').text('Hapus Pekerjaan');

                        $('#tipehapus').val('Pekerjaan');
                        $('#idhapus').val(id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });
    tablepekerjaan.buttons( 0, null ).container().prependTo(
            tablepekerjaan.table().container()
    );
</script>
{{--table pendidikan--}}
<script>
    var tablependidikan = $('#dataTables-pendidikan').DataTable({
        dom: 'Bft',
        select: true,
        scrollY : '50vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [],
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

    new $.fn.dataTable.Buttons(tablependidikan,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalriwayatpendidikan').modal({show:true});
                    $('#judulpendidikan').text('Tambah Pendidikan');
                    $('#iconpendidikan').attr('class','fa fa-plus');

                    $('#selectpendidikan').val($('#selectpendidikan option:first').val());
                    $('#jurusan').hide();
                    $('#pendidikangroup').hide();

                    $('#masihpendidikan').hide();
                    $('#groupselesaipendidikan').show();
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var tingkat = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var jurusan = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var tempat = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var mulai = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[4].display;
                    });
                    var selesai = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[5].display;
                    });
                    if(id != ""){
                        $('#modalriwayatpendidikan').modal({show:true});
                        $('#judulpendidikan').text('Ubah Pendidikan');
                        $('#iconpendidikan').attr('class','fa fa-pencil');
                        $('#pendidikangroup').show();

                        if(tingkat == "SD" || tingkat =="SMP"){
                            $('#jurusan').hide();
                            $('#namapendidikan').val('');
                        }else{
                            $('#jurusan').show();
                            $('#namapendidikan').val(jurusan);
                        }
                        
                        $("#id_pendidikan").val(id);
                        $("#mulaipendidikan").val(mulai);
                        $('#selectpendidikan').val(tingkat);
                        $('#tempatpendidikan').val(tempat);

                        if(selesai == "Masih Belajar"){
                            $('#sekarangpendidikan').val('1');
                            $('#masihpendidikan').show();
                            $('#groupselesaipendidikan').hide();
                        }else{
                            $('#sekarangpendidikan').val('0');
                            $('#masihpendidikan').hide();
                            $('#groupselesaipendidikan').show();
                            $('#selesaipendidikan').val(selesai);
                        }
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function(){
                    var id = $.map(tablependidikan.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapus').modal({show:true});
                        $('#judulhapus').text('Pendidikan');
                        $('#namahapus').text('Hapus Pendidikan');

                        $('#tipehapus').val('Pendidikan');
                        $('#idhapus').val(id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });
    tablependidikan.buttons( 0, null ).container().prependTo(
            tablependidikan.table().container()
    );
</script>
{{--table organisasi--}}
<script>
    var tableorganisasi = $('#dataTables-organisasi').DataTable({
        dom: 'Bft',
        select: true,
        scrollY : '50vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [],
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

    var tipeid_organisasi = '2';
    new $.fn.dataTable.Buttons(tableorganisasi,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalriwayatorganisasi').modal({show:true});
                    $('#id_organisasi').val('');
                    $('#namaorganisasi').val('');
                    $('#jabatanorganisasi').val('');
                    $('#tempatorganisasi').val('');
                    $('#mulaiorganisasi').val('');
                    $('#selesaiorganisasi').val('');

                    $('#masihorganisasin').hide();
                    $('#groupselesaiorganisasi').show();
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var nama = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var jabatan = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var tempat = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var mulai = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[4].display;
                    });
                    var selesai = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[5].display;
                    });
                    if(id != ""){
                        $('#modalriwayatorganisasi').modal({show:true});
                        $('#id_organisasi').val(id);
                        $('#namaorganisasi').val(nama);
                        $('#jabatanorganisasi').val(jabatan);
                        $('#tempatorganisasi').val(tempat);
                        $('#mulaiorganisasi').val(mulai);

                        if(selesai == "Masih Aktif"){
                            $('#sekarangorganisasi').val('1');
                            $('#masihorganisasi').show();
                            $('#groupselesaiorganisasi').hide();
                        }else{
                            $('#sekarangorganisasi').val('0');
                            $('#masihorganisasi').hide();
                            $('#groupselesaiorganisasi').show();
                            $('#selesaiorganisasi').val(selesai);
                        }
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function(){
                    var id = $.map(tableorganisasi.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapus').modal({show:true});
                        $('#judulhapus').text('Organisasi');
                        $('#namahapus').text('Hapus Organisasi');

                        $('#tipehapus').val('Organisasi');
                        $('#idhapus').val(id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });
    tableorganisasi.buttons( 0, null ).container().prependTo(
            tableorganisasi.table().container()
    );
</script>
{{-- table keluarga --}}
<script>
    var tablekeluarga = $('#dataTables-keluarga').DataTable({
        dom: 'Bft',
        select: true,
        scrollY : '50vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [],
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
    new $.fn.dataTable.Buttons(tablekeluarga,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalkeluarga').modal({show:true});
                    $('#judulkeluarga').text('Tambah Keluarga');
                    $('#iconkeluarga').attr('class','fa fa-plus');

                    $('#namekeluarga').val('');
                    $('#selectkeluarga').val($('#selectkeluarga option:first').val());
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tablekeluarga.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var name = $.map(tablekeluarga.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var sebagai = $.map(tablekeluarga.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });

                    if(id != ""){
                        $('#modalkeluarga').modal({show:true});
                        $('#judulkeluarga').text('Ubah Keluarga');
                        $('#iconkeluarga').attr('class','fa fa-pencil');

                        $('#namekeluarga').val(name);
                        $('#selectkeluarga').val(sebagai);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function(){
                    var id = $.map(tablekeluarga.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapuskeluarga').modal({show:true});
                        $('#idhapuskeluarga').val(id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });
    tablekeluarga.buttons( 0, null ).container().prependTo(
            tablekeluarga.table().container()
    );
</script>
{{-- table anggota cu --}}
<script>
    var tableanggotacu = $('#dataTables-anggotacu').DataTable({
        dom: 'Bft',
        select: true,
        scrollY : '50vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [],
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

    new $.fn.dataTable.Buttons(tableanggotacu,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalanggotacu').modal({show:true});
                    $('#judulanggotacu').text('Tambah Keanggotaan di CU');
                    $('#iconanggotacu').attr('class','fa fa-plus');

                    $('#namecu').val(''); 
                    $('#no_ba').val('');
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tableanggotacu.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var name = $.map(tableanggotacu.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var no = $.map(tableanggotacu.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });

                    if(id != ""){
                        $('#modalanggotacu').modal({show:true});
                        $('#judulanggotacu').text('Ubah Keanggotaan di CU');
                        $('#iconanggotacu').attr('class','fa fa-pencil');

                        $('#namecu').val(name);
                        $('#no_ba').val(no);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function(){
                    var id = $.map(tableanggotacu.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modalhapusanggotacu').modal({show:true});
                        $('#idhapusanggotacu').val(id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });

    tableanggotacu.buttons( 0, null ).container().prependTo(
            tableanggotacu.table().container()
    );
</script>
@stop