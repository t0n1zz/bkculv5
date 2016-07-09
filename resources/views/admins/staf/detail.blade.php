<?php
$title = "Detail Staf";
$kelas = "staf";
$imagepath = "images_staf/";
?>
@extends('admins._layouts.layout')

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
                    <p class="text-muted text-center">{{ $data->jabatan }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p class="text-center">
                            @if(empty($data->cu))
                                {{ "Puskopdit BKCU Kalimantan" }}
                            @else
                                {{"CU " . $data->cuprimer->name}}
                            @endif
                            </p>
                        </li>
                        @if($data->tingkat == 1 || $data->tingkat == 2)
                            <li class="list-group-item">
                                <b>Periode</b> <a class="pull-right">{{ $data->periode1 . "-" . $data->periode2 }}</a>
                            </li>
                        @endif
                    </ul>
                    <a href="#" class="btn btn-warning btn-block"><i class="fa fa-check"></i> <b>Aktif</b></a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-4">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Kegiatan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                            <a href="#" class="small-box-footer">Total Kegiatan yang telah diikuti</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Kegiatan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <a href="#" class="small-box-footer">Kegiatan yang telah diikuti tahun 2016 </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Kegiatan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar-minus-o"></i>
                        </div>
                        <a href="#" class="small-box-footer">Kegiatan yang belum diikuti tahun 2016</a>
                    </div>
                </div>
            </div>
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info_1" data-toggle="tab">Info</a></li>
                    <li><a href="#info_2" data-toggle="tab">Riwayat</a></li>
                    <li><a href="#info_3" data-toggle="tab">Kegiatan sudah diikuti</a></li>
                    <li><a href="#info_4" data-toggle="tab">Kegiatan belum diikuti</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info_1">
                        <div class="row">
                            <div class="col-lg-4">
                                <b>No Identitas</b>: @if(!empty($data->no_id)){{ $data->no_id }}@else{{ "-" }}@endif
                                <br/>
                                <b>NIM</b>: @if(!empty($data->nim)){{ $data->nim }}@else{{ "-" }}@endif
                                <br/><br/>
                                <b>Tempat Lahir</b>: @if(!empty($data->tempat_lahir)){{ $data->tempat_lahir }}@else{{ "-" }}@endif
                                <br/>
                                <b>Tanggal Lahir</b>:
                                @if(!empty($data->tanggal_lahir) && $data->tanggal_lahir != "0000-00-00")
                                    <?php $date = new Date($data->tanggal2); ?>
                                    {{ $date->format('d-n-Y') }}
                                @else
                                    {{ "-" }}
                                @endif
                                <br/><br/>
                                <b>Jenis Kelamin</b>:
                                @if(!empty($data->kelamin))
                                    @if($data->kelamin == 1)
                                        {{ "Laki-laki" }}
                                    @else
                                        {{ "Wanita" }}
                                    @endif
                                @else
                                    {{ "-" }}
                                @endif
                                <br/>
                                <b>Status</b>: @if(!empty($data->status)){{ $data->status }}@else{{ "-" }}@endif
                                <br/>
                                <b>Agama</b>: @if(!empty($data->agama)){{ $data->agama }}@else{{ "-" }}@endif
                            </div>
                            <div class="col-lg-4">
                                <b>No. Telepon</b>: @if(!empty($data->telp)){{ $data->telp }}@else{{ "-" }}@endif
                                <br/>
                                <b>No. Handphone</b>: @if(!empty($data->hp)){{ $data->hp }}@else{{ "-" }}@endif
                                <br/>
                                <b>E-mail</b>: @if(!empty($data->email)){{ $data->email }}@else{{ "-" }}@endif
                                <br/><br/>
                                <b>Pendidikan Terakhir</b><br/>
                                @if(!empty($riwayats1->first()))
                                    <p>
                                        {{ $riwayats1->first()->name }}
                                        <br/>
                                        @if(!empty($riwayats1->first()->mulai))
                                            <?php $date = new Date($riwayats1->first()->mulai); ?>
                                            Mulai : {{ $date->format('d-n-Y')  }}
                                        @endif
                                        <br/>
                                        @if(!empty($riwayats1->first()->selesai))
                                            <?php $date2 = new Date($riwayats1->first()->selesai); ?>
                                            Selesai : {{ $date2->format('d-n-Y')  }}
                                        @endif
                                    </p>
                                @else
                                    <p>Belum terdapat data pendidikan</p>
                                @endif
                                <br/><br/>

                            </div>
                            <div class="col-lg-4">
                                <b>Kota</b>: @if(!empty($data->kota)){{ $data->kota }}@else{{ "-" }}@endif
                                <br/><br/>
                                <b>Alamat</b><br/>
                                @if(!empty($data->alamat))
                                    <?php $newarr = explode("\n",$data->alamat); ?>
                                    @foreach($newarr as $str)
                                        <p>{{ $str }}</p>
                                    @endforeach
                                @else
                                    <p>{{ "-" }}</p>
                                @endif
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="info_2">
                        <h4 class="text-center" style="font-weight: 600">PENDIDIKAN</h4>
                        <hr/>
                        <a href="#" class="btn btn-sm btn-primary modaltext1"
                           data-id="1"
                           data-tipe="Pendidikan"
                           data-text1="Lembaga Pendidikan"
                           data-target="#modaltext1"
                           data-toggle="modal" data-placement="top">
                            <i class="fa fa-plus"></i> Tambah Pendidikan
                        </a>
                        <br/><br/>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nama Lembaga Pendidikan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayats1 as $riwayat1)
                                <tr>
                                    @if(!empty($riwayat1->name))
                                        <td>{{ $riwayat1->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat1->mulai ))
                                        <?php $date = new Date($riwayat1->mulai); ?>
                                        <td><i hidden="true">{{$riwayat1->mulai}}</i> {{ $date->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat1->selesai ))
                                        <?php $date2 = new Date($riwayat1->selesai); ?>
                                        <td><i hidden="true">{{$riwayat1->selesai}}</i> {{ $date2->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td><a class="btn btn-primary modaltext2" href="#"
                                           data-id="1"
                                           data-tipe="Pendidikan"
                                           data-text1="{{ $riwayat1->name }}"
                                           data-text2="{{ $date->format('d-n-Y') }}"
                                           data-text3="{{ $date2->format('d-n-Y') }}"
                                           data-text4="{{ $riwayat1->id }}"
                                           data-target="#modaltext2"
                                           data-toggle="modal" data-placement="top">
                                            <i class="fa fa-pencil"></i></a></td>
                                    <td><button class="btn btn-danger modal1" name="{{ $riwayat1->id }}"
                                                title="{{ $data->id }}">
                                            <i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            @if($riwayats1->isEmpty())
                                <tr>
                                    <td colspan="4">Belum terdapat data riwayat pendidikan</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <hr/>
                        <h4 class="text-center" style="font-weight: 600">PEKERJAAN/JABATAN</h4>
                        <hr/>
                        <a href="#" class="btn btn-sm btn-primary modaltext1"
                           data-id="2"
                           data-tipe="Pekerjaan"
                           data-text1="Pekerjaan / Jabatan"
                           data-target="#modaltext1"
                           data-toggle="modal" data-placement="top">
                            <i class="fa fa-plus"></i> Tambah Pekerjaan
                        </a>
                        <br/><br/>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nama Pekerjaan/Jabatan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayats2 as $riwayat2)
                                <tr>
                                    @if(!empty($riwayat2->name))
                                        <td>{{ $riwayat2->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat2->mulai ))
                                        <?php $date = new Date($riwayat2->mulai); ?>
                                        <td><i hidden="true">{{$riwayat2->mulai}}</i> {{ $date->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat2->selesai ))
                                        <?php $date2 = new Date($riwayat2->selesai); ?>
                                        <td><i hidden="true">{{$riwayat2->selesai}}</i> {{ $date2->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td><a class="btn btn-primary modaltext2" href="#"
                                           data-id="2"
                                           data-tipe="Pekerjaan"
                                           data-text1="{{ $riwayat2->name }}"
                                           data-text2="{{ $date->format('d-n-Y') }}"
                                           data-text3="{{ $date2->format('d-n-Y') }}"
                                           data-text4="{{ $riwayat2->id }}"
                                           data-target="#modaltext2"
                                           data-toggle="modal" data-placement="top">
                                            <i class="fa fa-pencil"></i></a></td>
                                    <td><button class="btn btn-danger modal1" name="{{ $riwayat2->id }}"
                                                title="{{ $data->id }}">
                                            <i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            @if($riwayats2->isEmpty())
                                <tr>
                                    <td colspan="4">Belum terdapat data riwayat pekerjaan</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <hr/>
                        <h4 class="text-center" style="font-weight: 600">ORGANISASI</h4>
                        <hr/>
                        <a href="#" class="btn btn-sm btn-primary modaltext1"
                           data-id="3"
                           data-tipe="Organisasi"
                           data-text1="Organisasi"
                           data-target="#modaltext1"
                           data-toggle="modal" data-placement="top">
                            <i class="fa fa-plus"></i> Tambah Organisasi
                        </a>
                        <br/><br/>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nama Organisasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayats3 as $riwayat3)
                                <tr>
                                    @if(!empty($riwayat3->name))
                                        <td>{{ $riwayat3->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat3->mulai ))
                                        <?php $date = new Date($riwayat3->mulai); ?>
                                        <td><i hidden="true">{{$riwayat3->mulai}}</i> {{ $date->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat3->selesai ))
                                        <?php $date2 = new Date($riwayat3->selesai); ?>
                                        <td><i hidden="true">{{$riwayat3->selesai}}</i> {{ $date2->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td><a class="btn btn-primary modaltext2" href="#"
                                           data-id="2"
                                           data-tipe="Pekerjaan"
                                           data-text1="{{ $riwayat3->name }}"
                                           data-text2="{{ $date->format('d-n-Y') }}"
                                           data-text3="{{ $date2->format('d-n-Y') }}"
                                           data-text4="{{ $riwayat3->id }}"
                                           data-target="#modaltext2"
                                           data-toggle="modal" data-placement="top">
                                            <i class="fa fa-pencil"></i></a></td>
                                    <td><button class="btn btn-danger modal1" name="{{ $riwayat3->id }}"
                                                title="{{ $data->id }}">
                                            <i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            @if($riwayats3->isEmpty())
                                <tr>
                                    <td colspan="4">Belum terdapat data riwayat organisasi</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <hr/>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="info_3">
                        <h1 class="text-center">Something Magical Happen Here <br/><small>Behold for new awesome feature coming to here...</small></h1>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="info_4">
                        <h1 class="text-center">Something Magical Happen Here <br/><small>Behold for new awesome feature coming to here...</small></h1>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

<!-- tambah -->
<div class="modal fade" id="modaltext1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store_riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah <label class="modal-tipe"></label></h4>
            </div>
            <div class="modal-body">
                <input type="text" class="modal-id" name="tipe" value="" hidden>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <h4>Nama</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('name',null,array('class' => 'form-control',
                      'placeholder' => 'Silahkan masukkan nama','autocomplete'=>'off'))}}
                </div>
                <h4>Tanggal Mulai</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('mulai',null,array('class' => 'form-control',
                      'placeholder' => 'dd/mm/yyyy','autocomplete'=>'off'))}}
                </div>
                <h4>Tanggal Selesai</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('selesai',null,array('class' => 'form-control',
                      'placeholder' => 'dd/mm/yyyy','autocomplete'=>'off'))}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /tambah -->
<!-- edit -->
<div class="modal fade" id="modaltext2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah <label class="modal-tipe"></label></h4>
            </div>
            <div class="modal-body">
                <input type="text" class="modal-id" name="tipe" value="" hidden>
                <input type="text" class="modal-value4" name="id" value="" hidden>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <h4>Nama</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('name',null,array('class' => 'form-control modal-value1',
                      'placeholder' => 'Silahkan masukkan nama','autocomplete'=>'off'))}}
                </div>
                <h4>Tanggal Mulai</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('mulai',null,array('class' => 'form-control modal-value2',
                      'placeholder' => 'dd/mm/yyyy','autocomplete'=>'off'))}}
                </div>
                <h4>Tanggal Selesai</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('selesai',null,array('class' => 'form-control modal-value3',
                      'placeholder' => 'dd/mm/yyyy','autocomplete'=>'off'))}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /edit -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Riwayat</h4>
            </div>
            <div class="modal-body">
                <strong style="font-size: 16px">Menghapus riwayat ini?</strong>
                <input type="text" name="id" value="" id="modal1id" hidden>
                <input type="text" name="id_staf" value="" id="modal1id2" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Iya</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /Hapus -->
@stop