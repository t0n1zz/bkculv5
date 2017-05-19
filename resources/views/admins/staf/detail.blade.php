<?php
$title = "Detail Staf";
$kelas = "staf";
$imagepath = "images_staf/";

if(!empty($data->tanggal_lahir) && $data->tanggal_lahir != "0000-00-00"){
    $date = new Date($data->tanggal_lahir);
}
$i = 0;
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Responsive/css/responsive.bootstrap.css')}}" >
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
                        @foreach($data->pekerjaan_aktif as $paktif)
                            <?php $i++; ?>
                            {{ $paktif->name }}
                            @if($i < $data->pekerjaan_aktif->count())
                               {{ ', ' }}
                            @endif
                        @endforeach
                    </p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item"><b>NIM</b> <a class="pull-right">{{ $data->nim }}</a></li>
                        <li class="list-group-item"><b>NID</b> <a class="pull-right">{{ $data->nid }}</a></li>
                        <li class="list-group-item"><b>Tempat Lahir</b> <a class="pull-right">{{ $data->tempat_lahir }}</a></li>
                        <li class="list-group-item"><b>Tanggal Lahir</b> <a class="pull-right">{{ $date->format('d F Y') }}</a></li>
                        <li class="list-group-item"><b>Status</b> <a class="pull-right">{{ $data->status }}</a></li>
                        <li class="list-group-item"><b>Agama</b> <a class="pull-right">{{ $data->agama }}</a></li>
                    </ul>
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
                    <li class="active"><a href="#riwayat" role="tab" data-toggle="tab" data-target="#riwayat">Riwayat</a></li>
                    @if(!empty($data->kegiatanpeserta))
                        <li><a href="#kegiatan" role="tab" data-toggle="tab" data-target="#kegiatan">Kegiatan</a></li>
                    @endif    
                    <li ><a href="#info" role="tab" data-toggle="tab" data-target="#info">Info Lain</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="riwayat">
                        <section id="riwayatpekerjaan">
                            <h4 class="page-header color1">Pekerjaan</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-pekerjaan" cellspacing="0" width="100%">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th data-priority="1">Jabatan</th>
                                    <th>Tempat</th>
                                    <th>Tingkat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->pekerjaan as $pekerjaan)
                                    <tr
                                    @if(!empty($pekerjaan->sekarang) && $pekerjaan->sekarang != '0')
                                        {!! 'class="highlight"'  !!}
                                    @endif>
                                        <td hidden>{{ $pekerjaan->id }}</td>
                                        <td hidden>{{ $pekerjaan->tipe }}</td>
                                        <td hidden>{{ $pekerjaan->id_tempat }}</td>
                                        <td>{{ $pekerjaan->name }}</td>

                                        @if($pekerjaan->tipe == 1)
                                            <td>{{ 'CU ' . $pekerjaan->cuprimer->name }}</td>
                                        @elseif($pekerjaan->tipe == 2)
                                            <td>{{ $pekerjaan->lembaga->name }}</td>
                                        @elseif($pekerjaan->tipe == 3)
                                            <td>Puskopdit BKCU Kalimantan</td> 
                                         @else
                                            <td>-</td>
                                        @endif
                                   
                                        <td>{{ $pekerjaan->tingkat }}</td>

                                        @if(!empty($pekerjaan->mulai ))
                                            <?php $date = new Date($pekerjaan->mulai); ?>
                                            <td data-order="{{$pekerjaan->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($pekerjaan->sekarang) && $pekerjaan->sekarang != '0')
                                            <td data-order="Masih Bekerja">Masih Bekerja</td>
                                        @else
                                            @if(!empty($pekerjaan->selesai))
                                                <?php $date2 = new Date($pekerjaan->selesai);  ?>
                                                <td data-order="{{$pekerjaan->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="riwayatpendidikan">
                            <br/><br/>
                            <h4 class="page-header color1">Pendidikan</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-pendidikan">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th class="sort" data-priority="1">Tingkat</th>
                                    <th>Jurusan/Bidang</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->pendidikan as $pendidikan)
                                    <?php 
                                        if($pendidikan->tingkat == 1){
                                            $tingkat = "SD";
                                        }elseif($pendidikan->tingkat == 2){
                                            $tingkat = "SMP";
                                        }elseif($pendidikan->tingkat == 3){
                                            $tingkat = "SMA/SMK";
                                        }elseif($pendidikan->tingkat == 4){
                                            $tingkat = "D1";
                                        }elseif($pendidikan->tingkat == 5){
                                            $tingkat = "D2";
                                        }elseif($pendidikan->tingkat == 6){
                                            $tingkat = "D3";
                                        }elseif($pendidikan->tingkat == 7){
                                            $tingkat = "D4";
                                        }elseif($pendidikan->tingkat == 8){
                                            $tingkat = "S1";
                                        }elseif($pendidikan->tingkat == 9){
                                            $tingkat = "S2";
                                        }elseif($pendidikan->tingkat == 10){
                                            $tingkat = "S3";
                                        }else{
                                            $tingkat = "Lain-lain";
                                        }
                                    ?>
                                    <tr>
                                        <td hidden>{{ $pendidikan->id }}</td>
                                        <td hidden>{{ $pendidikan->tingkat }}</td>
                                        <td data-order="{{ $pendidikan->tingkat }}">{{ $tingkat }}</td>
                                        @if(!empty($pendidikan->name))
                                            <td>{{ $pendidikan->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($pendidikan->tempat))
                                            <td>{{ $pendidikan->tempat}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($pendidikan->mulai ))
                                            <?php $date = new Date($pendidikan->mulai); ?>
                                            <td data-order="{{$pendidikan->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($pendidikan->sekarang) && $pendidikan->sekarang != '0')
                                            <td data-order="Masih Belajar">Masih Belajar</td>
                                        @else
                                            @if(!empty($pendidikan->selesai))
                                                <?php $date2 = new Date($pendidikan->selesai);  ?>
                                                <td data-order="{{$pendidikan->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="riwayatorganisasi">
                            <br/><br/>
                            <h4 class="page-header color1">Berorganisasi</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-organisasi">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th class="sort" data-priority="1">Nama Organisasi</th>
                                    <th>Jabatan</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->organisasi as $organisasi)
                                    <tr>
                                        <td hidden>{{ $organisasi->id }}</td>
                                        @if(!empty($organisasi->name))
                                            <td>{{ $organisasi->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($organisasi->jabatan))
                                            <td>{{ $organisasi->jabatan }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($organisasi->tempat))
                                            <td>{{ $organisasi->tempat }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($organisasi->mulai ))
                                            <?php $date = new Date($organisasi->mulai); ?>
                                            <td data-order="{{$organisasi->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($organisasi->sekarang) && $organisasi->sekarang != '0')
                                            <td data-order="Masih Aktif">Masih Aktif</td>
                                        @else
                                            @if(!empty($organisasi->selesai))
                                                <?php $date2 = new Date($organisasi->selesai);  ?>
                                                <td data-order="{{$organisasi->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="kegiatan">
                        @if(!empty($data->kegiatanpeserta))
                        <section id="peserta">
                            <h4 class="page-header color1">Peserta</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-diklat">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th class="sort" data-priority="1">Nama Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Penyelenggara</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th data-priority="2">Status</th>
                                    <th>Keterangan</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->kegiatanpeserta as $b)
                                    @if(!empty($b->kegiatan))
                                    <tr>
                                        <?php 
                                            if($b->status == 1){
                                                $diklatbkcustatus = '<a class="btn btn-default btn-sm nopointer"> MENUNGGU</a>';
                                            }elseif($b->status == 2){
                                                $diklatbkcustatus = '<a class="btn btn-danger btn-sm nopointer">TERDAFTAR </a>';
                                            }else if($b->status == 3){
                                                $diklatbkcustatus = '<a class="btn btn-info btn-sm nopointer"> BATAL</a>';
                                            }
                                        ?>
                                        <td hidden>{{ $b->kegiatan->id }}</td>
                                        <td>{{ $b->kegiatan->name }}</td>
                                        @if(!empty($b->kegiatan->tempat))
                                            <td>{{ $b->kegiatan->tempat->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>Puskopdit BKCU Kalimantan</td>
                                        <td data-order="{{ $b->kegiatan->mulai }}">@if(!empty($b->kegiatan->mulai )){{ $b->kegiatan->mulai ->format('d F Y') }}@else{{ '-' }}@endif</td>
                                        <td data-order="{{ $b->kegiatan->selesai }}">@if(!empty($b->kegiatan->selesai )){{ $b->kegiatan->selesai ->format('d F Y') }}@else{{ '-' }}@endif</td>
                                        <td>{!! $diklatbkcustatus !!}</td>
                                        <td class="warptext">{{ $b->keterangan }}</td>
                                        <td></td>
                                    </tr>
                                     @endif
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        @endif
                        @if(!empty($data->kegiatanpanitia))
                        <section id="panitia">
                            <br/><br/>
                            <h4 class="page-header color1">Panitia</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-diklat2">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th class="sort" data-priority="1">Nama Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Penyelenggara</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th data-priority="1">Status</th>
                                    <th>Keterangan</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->kegiatanpanitia as $b)
                                    @if(!empty($b->kegiatan))
                                    <tr>
                                        <?php 
                                            if($b->status == 1){
                                                $diklatbkcustatus = '<a class="btn btn-info btn-sm nopointer"> Sudah diikuti </a>';
                                            }elseif($b->status == 2){
                                                $diklatbkcustatus = '<a class="btn btn-danger btn-sm nopointer"> Batal diikuti </a>';
                                            }else{
                                                $diklatbkcustatus = '<a class="btn btn-default btn-sm nopointer"> Belum dilaksanakan </a>';
                                            }
                                        ?>
                                        <td hidden>{{ $b->kegiatan->id }}</td>
                                        <td>{{ $b->kegiatan->name }}</td>
                                        @if(!empty($b->kegiatan->tempat))
                                            <td>{{ $b->kegiatan->tempat->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>Puskopdit BKCU Kalimantan</td>
                                        <td data-order="{{ $b->kegiatan->mulai }}">@if(!empty($b->kegiatan->mulai )){{ $b->kegiatan->mulai ->format('d F Y') }}@else{{ '-' }}@endif</td>
                                        <td data-order="{{ $b->kegiatan->selesai }}">@if(!empty($b->kegiatan->selesai )){{ $b->kegiatan->selesai ->format('d F Y') }}@else{{ '-' }}@endif</td>
                                        <td>{!! $diklatbkcustatus !!}</td>
                                        <td class="warptext">{{ $b->keterangan }}</td>
                                        <td></td>
                                    </tr>
                                     @endif
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        @endif
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="info">
                        <section id="keluarga">
                            <h4 class="page-header color1">Keluarga</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-keluarga">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama</th>
                                    <th>Sebagai</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->keluarga as $keluarga)
                                    <tr>
                                        <td hidden>{{ $keluarga->id }}</td>
                                        <td>{{ $keluarga->name }}</td>
                                        <td>{{ $keluarga->tipe }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section id="anggotacu">
                            <br/><br/>
                            <h4 class="page-header color1">Keanggotaan di CU</h4>
                            <table class="table table-hover dt-responsive" id="dataTables-anggotacu">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama</th>
                                    <th>No. BA</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->anggotacu as $anggotacu)
                                    <tr>
                                        <td hidden>{{ $anggotacu->id }}</td>
                                        <td>{{ $anggotacu->name }}</td>
                                        <td>{{ $anggotacu->no_ba }}</td>
                                        <td></td>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
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
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
{{--table pekerjaan--}}
<script>
    var tablepekerjaan = $('#dataTables-pekerjaan').DataTable({
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

    tablepekerjaan.columns('.sort').order('asc').draw();

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

                            if(tipe == "1")
                                $('#selectcu').val(tempat);
                            else
                                $('#selectcu').val($('#selectcu option:eq(1)').val());

                            $("#radiolembaga").prop("checked", false);
                            $('#selectlembaga').prop('disabled',true);
                            $('#selectlembaga').val($('#selectlembaga option:first').val());
                        }else if(tipe == "2"){ //lembaga
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

    tablependidikan.columns('.sort').order('asc').draw();

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
                        return item[3];
                    });
                    var tempat = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[4];
                    });
                    var mulai = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[5].display;
                    });
                    var selesai = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[6].display;
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

    tableorganisasi.columns('.sort').order('asc').draw();

    var tipeid_organisasi = '2';
    new $.fn.dataTable.Buttons(tableorganisasi,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalriwayatorganisasi').modal({show:true});
                    $('#judulorganisasi').text('Tambah Organisasi');
                    $('#iconorganisasi').attr('class','fa fa-plus');

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
                        $('#judulorganisasi').text('Ubah Organisasi');
                        $('#iconorganisasi').attr('class','fa fa-pencil');

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

    tablekeluarga.columns('.sort').order('asc').draw();

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

    tableanggotacu.columns('.sort').order('asc').draw();

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
{{-- diklat --}}
<script>
    var tablediklat = $('#dataTables-diklat').DataTable({
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

    tablediklat.columns('.sort').order('asc').draw();

    new $.fn.dataTable.Buttons(tablediklat,{
        buttons: [
            {
                text: '<i class="fa fa-database"></i> Detail Kegiatan',
                action: function(){
                    var id = $.map(tablediklat.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        window.location.href =  "/admins/kegiatan/" + id + "/detail";
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });

    tablediklat.buttons( 0, null ).container().prependTo(
            tablediklat.table().container()
    );
</script>

<script>
    var tablediklat2 = $('#dataTables-diklat2').DataTable({
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

    tablediklat2.columns('.sort').order('asc').draw();

    new $.fn.dataTable.Buttons(tablediklat2,{
        buttons: [
            {
                text: '<i class="fa fa-database"></i> Detail Kegiatan',
                action: function(){
                    var id = $.map(tablediklat2.rows({ selected:true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        window.location.href =  "/admins/kegiatan/" + id + "/detail";
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });

    tablediklat2.buttons( 0, null ).container().prependTo(
            tablediklat2.table().container()
    );
</script>
@stop