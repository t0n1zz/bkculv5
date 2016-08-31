<?php
$title = "Detail Staf";
$kelas = "staf";
$imagepath = "images_staf/";
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
                        @foreach($riwayats2 as $riwayat2)
                                @if($riwayat2->sekarang == '1')
                                    <?php $date = new Date($riwayat2->mulai); $date2 = new Date($riwayat2->mulai); ?>
                                    {!! $riwayat2->keterangan. " ( " .$date->format('Y'). "- sekarang )<br/>"  !!}
                                @else
                                    <?php $date = new Date($riwayat2->mulai); $date2 = new Date($riwayat2->mulai); ?>
                                    {!! $riwayat2->keterangan. " ( " .$date->format('Y'). " - " .$date2->format('Y'). " )<br/>"  !!}
                                @endif
                        @endforeach
                    </p>
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
        </div><!-- /.col -->
        <div class="col-md-9">
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Informasi Umum</a></li>
                    <li><a href="#kegiatan_ikut" data-toggle="tab">Kegiatan sudah diikuti</a></li>
                    <li><a href="#kegiatan_belumikut" data-toggle="tab">Kegiatan belum diikuti</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <section id="informasi">
                            <h4 class="page-header">Informasi Umum</h4>
                            <div class="row">
                                <div class="col-lg-4">
                                    <b>No Identitas</b>: @if(!empty($data->noid)){{ $data->noid }}@else{{ "-" }}@endif
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
                                    <br/>
                                    <b>Jenis Kelamin</b>:
                                    @if(!empty($data->kelamin))
                                        {{ $data->kelamin }}
                                    @else
                                        {{ "-" }}
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <b>Status</b>: @if(!empty($data->status)){{ $data->status }}@else{{ "-" }}@endif
                                    <br/>
                                    <b>Agama</b>: @if(!empty($data->agama)){{ $data->agama }}@else{{ "-" }}@endif
                                    <br/><br/>
                                    <b>No. Telepon</b>: @if(!empty($data->telp)){{ $data->telp }}@else{{ "-" }}@endif
                                    <br/>
                                    <b>No. Handphone</b>: @if(!empty($data->hp)){{ $data->hp }}@else{{ "-" }}@endif
                                    <br/>
                                    <b>E-mail</b>: @if(!empty($data->email)){{ $data->email }}@else{{ "-" }}@endif
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
                            <hr/>
                        </section>
                        <section id="jabatan">
                            <br/>
                            <h4 class="page-header">Riwayat Pekerjaan</h4>
                            <table class="table table-hover table-bordered" id="dataTables-pekerjaan">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama Pekerjaan</th>
                                    <th>Tempat</th>
                                    <th>Tingkat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riwayats2 as $riwayat2)
                                    <tr>
                                        <td hidden>{{ $riwayat2->id }}</td>
                                        @if(!empty($riwayat2->name))
                                            <td>{{ $riwayat2->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->keterangan))
                                            <td>{{ $riwayat2->keterangan}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->keterangan2))
                                            <td>{{ $riwayat2->keterangan2}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->mulai ))
                                            <?php $date = new Date($riwayat2->mulai); ?>
                                            <td data-order="{{$riwayat2->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->selesai ))
                                            @if(!empty($riwayat2->sekarang) && $riwayat2->sekarang != '0')
                                                <td>Masih Aktif</td>
                                            @else
                                                <?php $date2 = new Date($riwayat2->selesai);  ?>
                                                <td data-order="{{$riwayat2->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr/>
                        </section>
                        <section id="pendidikan">
                            <br/>
                            <h4 class="page-header">Riwayat Pendidikan</h4>
                            <table class="table table-hover table-bordered" id="dataTables-pendidikan">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama Pendidikan</th>
                                    <th>Tempat</th>
                                    <th>Tipe</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riwayats1 as $riwayat1)
                                    <tr>
                                        <td hidden>{{ $riwayat1->id }}</td>
                                        @if(!empty($riwayat1->name))
                                            <td>{{ $riwayat1->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->keterangan))
                                            <td>{{ $riwayat1->keterangan }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->keterangan2))
                                            <td>{{ $riwayat1->keterangan2}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->mulai ))
                                            <?php $date = new Date($riwayat1->mulai); ?>
                                            <td data-order="{{$riwayat1->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat1->selesai ))
                                            @if(!empty($riwayat1->sekarang) && $riwayat1->sekarang != '0')
                                                <td data-order="Masih Aktif">Masih Aktif</td>
                                            @else
                                                <?php $date2 = new Date($riwayat1->selesai);  ?>
                                                <td data-order="{{$riwayat1->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr/>
                        </section>
                        <section id="organisasi">
                            <br/>
                            <h4 class="page-header">Riwayat Berorganisasi</h4>
                            <table class="table table-hover table-bordered" id="dataTables-organisasi">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama Organisasi</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riwayats3 as $riwayat3)
                                    <tr>
                                        <td hidden>{{ $riwayat3->id }}</td>
                                        @if(!empty($riwayat3->name))
                                            <td>{{ $riwayat3->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->keterangan))
                                            <td>{{ $riwayat3->keterangan }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->mulai ))
                                            <?php $date = new Date($riwayat3->mulai); ?>
                                            <td data-order="{{$riwayat3->mulai}}"> {{ $date->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat3->selesai ))
                                            @if(!empty($riwayat3->sekarang) && $riwayat3->sekarang != '0')
                                                <td>Masih Aktif</td>
                                            @else
                                                <?php $date2 = new Date($riwayat3->selesai);  ?>
                                                <td data-order="{{$riwayat3->selesai}}"> {{ $date2->format('d/m/Y') }}</td>
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr/>
                        </section>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="kegiatan_ikut">
                        <h1 class="text-center">Something Magical Happen Here <br/><small>Behold for new awesome feature coming to here...</small></h1>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane fade" id="kegiatan_belumikut">
                        <h1 class="text-center">Something Magical Happen Here <br/><small>Behold for new awesome feature coming to here...</small></h1>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

<!-- tambah -->
<div class="modal fade" id="modalriwayat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-plus"></i> <span id="modaljudul"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="id" value="" hidden>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="tipe" id="idtipe" value="" hidden>
                <input type="text" name="sekarang" id="sekarang" value="" hidden>

                <div class="form-group">
                    <h4>Nama </h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'name',
                          'placeholder' => 'Silahkan masukkan nama','autocomplete'=>'off'))}}
                    </div>
                </div>

                <div class="form-group" id="tempat">
                    <h4>Tempat</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="tempat" id="radiocu" onclick="radiocu()">
                        </span>
                                <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
                                <select class="form-control placeholder" name="cu" id="cu" disabled>
                                    <option>Credit Union</option>
                                    <option value="0">BKCU</option>
                                        @foreach($culists as $culist)
                                            <option value="{{ $culist->id }}">{{ $culist->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="tempat" id="radiolembaga" onclick="radiolembaga()">
                        </span>
                                <input type="text" class="form-control" name="lembaga" id="lembaga" placeholder="Bukan Credit Union" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="tingkat">
                    <h4>Tingkatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control placeholder" name="selecttingkat">
                            <option>Silahkan pilih tingkat</option>
                            <option value="Manajemen">Manajemen</option>
                            <option value="Pengurus">Pengurus</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="keterangan">
                    <h4 id="judulketerangan"></h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('keterangan',null,array('class' => 'form-control','id'=>'textketerangan',
                            'autocomplete'=>'off'))}}
                    </div>
                </div>

                <div class="form-group" id="tipependidikan">
                    <h4>Tipe</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="tipependidikan" id="selecttipe">
                            <option value="0" hidden>Silahkan pilih tipe pendidikan</option>
                            <option value="Utama">Utama</option>
                            <option value="Tambahan">Tambahan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <h4>Tanggal Mulai</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="mulai" id="mulai"  value="" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                </div>

                <div class="form-group">
                    <h4>Tanggal Selesai</h4>
                    <div class="input-group" id="groupselesai">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="selesai" id="selesai" value="" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="masihaktif()" >Masih Aktif</button>
                        </div>
                    </div>
                    <div class="input-group" id="masihbekerja" style="display: none;">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="Masih Aktif" readonly class="form-control" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="nonaktif()" ><i class="fa fa-times"></i></button>
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
<!-- /tambah -->
<!-- edit -->
<div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-pencil"></i> Ubah <span id="ubah-modal"></span></h4>
            </div>
            <div class="modal-body">
                <input type="text" name="tipe" id="ubah-idtipe" value="" hidden>
                <input type="text" name="id"  id="ubah-id" value="" hidden>
                <input type="text" name="id_staf" value="{{ $data->id }}" hidden>
                <input type="text" name="sekarang" id="ubah-sekarang" value="" hidden>

                <div class="form-group">
                    <h4>Nama </h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'ubah-name',
                          'placeholder' => 'Silahkan masukkan nama','autocomplete'=>'off'))}}
                    </div>
                </div>

                <div class="form-group" id="ubah-tempat">
                    <h4>Tempat</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="tempat" id="ubah-radiocu" onclick="ubahradiocu()">
                        </span>
                                <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
                                <select class="form-control" name="cu" id="ubah-cu" disabled>
                                    <option disabled>Credit Union</option>
                                    <option value="0">BKCU</option>
                                    @foreach($culists as $culist)
                                        <option value="{{ $culist->id }}">{{ $culist->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="tempat" id="ubah-radiolembaga" onclick="ubahradiolembaga()">
                        </span>
                                <input type="text" class="form-control" name="lembaga" id="ubah-lembaga" placeholder="Bukan Credit Union" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="ubah-tingkat">
                    <h4>Tingkatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="ubah-selecttingkat">
                            <option disabled>Silahkan pilih tingkat</option>
                            <option value="Manajemen">Manajemen</option>
                            <option value="Pengurus">Pengurus</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="ubah-keterangan">
                    <h4 id="ubah-judulketerangan"></h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('keterangan',null,array('class' => 'form-control','id'=>'ubah-textketerangan',
                            'autocomplete'=>'off'))}}
                    </div>
                </div>

                <div class="form-group" id="ubah-tipe">
                    <h4>Tipe</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="ubah-selecttipe">
                            <option disabled>Silahkan pilih tipe pendidikan</option>
                            <option value="Utama">Utama</option>
                            <option value="Tambahan">Tambahan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <h4>Tanggal Mulai</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="mulai"  value="" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                </div>

                <div class="form-group">
                    <h4>Tanggal Selesai</h4>
                    <div class="input-group" id="ubah-groupselesai">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="selesai" id="ubah-selesai" value="" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="ubahsekarang()" >Masih Aktif</button>
                        </div>
                    </div>
                    <div class="input-group" id="ubah-masihbekerja" style="display: none;">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="Masih Aktif" readonly class="form-control" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="ubahcancel()" ><i class="fa fa-times"></i></button>
                        </div>
                    </div>
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
<div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy_riwayat'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus <span id="hapus-modal"></span></h4>
            </div>
            <div class="modal-body">
                <h4>Menghapus <span id="hapus-nama"></span> ini?</h4>
                <input type="text" name="tipe" id="hapus-idtipe" value="" hidden>
                <input type="text" name="id"  id="hapus-id" value="" hidden>
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
<!-- /Hapus -->
<!-- warning -->
<div class="modal fade" id="modalwarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-yellow-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> Oopss</h4>
            </div>
            <div class="modal-body">
                <h4>Silahkan pilih data terlebih dahulu di tabel</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-check"></i> ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /warning -->
@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
<script>
    $('#modalriwayat').on('shown.bs.modal', function () {
        $('#name').focus();
    });

    function masihaktif(){
        $('#sekarang').val('1');
        $('#masihbekerja').show();
        $('#groupselesai').hide();
    }
    function nonaktif() {
        $('#sekarang').val('0');
        $('#masihbekerja').hide();
        $('#groupselesai').show();
    }
    function radiocu(){
        $('#cu').prop('disabled',false);
        $('#lembaga').prop('disabled',true);
        $('#lembaga').val('');
        $('#tingkat').show();
    }
    function radiolembaga(){
        $('#cu').prop('disabled',true);
        $('#cu').val($('#cu option:first').val());
        $('#lembaga').prop('disabled',false);
        $('#lembaga').focus();
        $('#tingkat').hide();
    }
</script>
{{--table pekerjaan--}}
<script>
    var tablepekerjaan = $('#dataTables-pekerjaan').DataTable({
        dom: 'Bt',
        select: true,
        scrollY : '80vh',
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
    var namatipe_pekerjaan = 'Pekerjaan';
    var tipeid_pekerjaan = '3';
    new $.fn.dataTable.Buttons(tablepekerjaan,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modaltambah').modal({show:true});

                    $('#tambah-groupmasihbekerja').hide();
                    $('#tambah-groupselesai').show();

                    $('#tambah-tipe').text(namatipe_pekerjaan);
                    $('#tambah-nama').text(namatipe_pekerjaan);
                    $('#tambah-idtipe').attr('value',tipeid_pekerjaan);
                    $('#tambah-sekarang').attr('value','0');
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var nama = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var tingkat = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var jabatan = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var mulai = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[4].display;
                    });
                    var selesai = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[5].display;
                    });
                    if(id != ""){
                        $('#modalubah').modal({show:true});

                        $('#ubah-tipe').text(namatipe_pekerjaan);
                        $('#ubah-nama').text(namatipe_pekerjaan);
                        $('#ubah-keterangan').text(jabatan);
                        $('#ubah-judulketerangan').text('Jabatan');
                        $('#ubah-keterangan').attr('placeholder','Silahkan masukkan jabatan');
                        $('#ubah-id').attr('value',id);
                        $('#ubah-idtipe').attr('value',tipeid_pekerjaan);
                        $('#ubah-nama2').attr('value',nama);
                        $('#ubah-keterangan2').attr('value',tingkat);
                        $('#ubah-mulai').val(mulai);

                        if(selesai == "Masih Aktif"){
                            $('#ubah-sekarang').attr('value','1');
                            $('#ubah-masihbekerja').show();
                            $('#ubah-groupselesai').hide();
                        }else{
                            $('#ubah-sekarang').attr('value','0');
                            $('#ubah-masihbekerja').hide();
                            $('#ubah-groupselesai').show();
                            $('#ubah-selesai').val(selesai);
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
                        $('#hapus-tipe').text(namatipe_pekerjaan);
                        $('#hapus-nama').text(namatipe_pekerjaan);
                        $('#hapus-id').attr('value',id);
                        $('#hapus-idtipe').attr('value',tipeid_pekerjaan);
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
    var tipeid_pendidikan = '1';

    var tablependidikan = $('#dataTables-pendidikan').DataTable({
        dom: 'Bt',
        select: true,
        scrollY : '80vh',
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
                    $('#modalriwayat').modal({show:true});

                    $('#groupmasihbekerja').hide();
                    $('#groupselesai').show();
                    $('#tempat').hide();
                    $('#tingkat').hide();
                    $('#tipependidikan').show();
                    $('#keterangan').show();
                    $('#masihbekerja').hide();
                    $('#groupselesai').show();

                    $('#modaljudul').text('Tambah Pendidikan');
                    $('#judulketerangan').text('Tempat');
                    $('#textketerangan').attr('placeholder','Silahkan masukkan tempat');
                    $('#idtipe').val(tipeid_pendidikan);
                    $('#sekarang').val('0');
                    $('#id').val('');
                    $('#name').val('');
                    $('#textketerangan').val('');
                    $('#selecttipe').val('0');
                    $('#mulai').val('');
                    $('#selesai').val('');
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function(){
                    var id = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    var nama = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var keterangan = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var tipe = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var mulai = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[4].display;
                    });
                    var selesai = $.map(tablependidikan.rows({ selected: true }).data(),function(item){
                        return item[5].display;
                    });
                    if(id != ""){
                        $('#modalriwayat').modal({show:true});

                        $('#tempat').hide();
                        $('#tingkat').hide();
                        $('#tipependidikan').show();
                        $('#keterangan').show();

                        $('#modaljudul').text('Ubah Pendidikan');
                        $('#judulketerangan').text('Tempat');
                        $('#textketerangan').attr('placeholder','Silahkan masukkan tempat');
                        $('#idtipe').val(tipeid_pendidikan);
                        $('#mulai').val(mulai);
                        $('#id').val(id);
                        $('#name').val(nama);
                        $('#textketerangan').val(keterangan);
                        $('#selecttipe').val(tipe);

                        if(selesai == "Masih Aktif"){
                            $('#sekarang').val('1');
                            $('#masihbekerja').show();
                            $('#groupselesai').hide();
                        }else{
                            $('#sekarang').val('0');
                            $('#masihbekerja').hide();
                            $('#groupselesai').show();
                            $('#selesai').val(selesai);
                        }
                        console.log(selesai);
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
                        $('#hapus-tipe').text('Hapus Pendidikan');
                        $('#hapus-nama').text('Pendidikan');
                        $('#hapus-id').val(id);
                        $('#hapus-idtipe').val(tipeid_pendidikan);
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
        dom: 'Bt',
        select: true,
        scrollY : '80vh',
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

    var namatipe_organisasi = 'Organisasi';
    var tipeid_organisasi = '2';
    new $.fn.dataTable.Buttons(tableorganisasi,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modaltambah').modal({show:true});

                    $('#tambah-tipe').text(namatipe_organisasi);
                    $('#tambah-nama').text(namatipe_organisasi);

                    $('#tambah-sekarang').attr('value','0');
                    $('#tambah-idtipe').attr('value',tipeid_organisasi);

                    $('#tambah-groupmasihbekerja').hide();
                    $('#tambah-groupselesai').show();
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
                    var keterangan = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var mulai = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[3].display;
                    });
                    var selesai = $.map(tableorganisasi.rows({ selected: true }).data(),function(item){
                        return item[4].display;
                    });
                    if(id != ""){
                        $('#modalubah').modal({show:true});

                        $('#ubah-tipe').text(namatipe_organisasi);
                        $('#ubah-nama').text(namatipe_organisasi);
                        $('#ubah-judulketerangan').text('Keterangan');
                        $('#ubah-keterangan').attr('placeholder','Silahkan masukkan keterangan');
                        $('#ubah-id').attr('value',id);
                        $('#ubah-idtipe').attr('value',tipeid_organisasi);
                        $('#ubah-nama2').attr('value',nama);
                        $('#ubah-keterangan').text(keterangan);
                        $('#ubah-mulai').val(mulai);

                        if(selesai == "Masih Aktif"){
                            $('#ubah-sekarang').attr('value','1');
                            $('#ubah-masihbekerja').show();
                            $('#ubah-groupselesai').hide();
                        }else{
                            $('#ubah-sekarang').attr('value','0');
                            $('#ubah-masihbekerja').hide();
                            $('#ubah-groupselesai').show();
                            $('#ubah-selesai').val(selesai);
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
                        $('#hapus-tipe').text(namatipe_organisasi);
                        $('#hapus-nama').text(namatipe_organisasi);
                        $('#hapus-id').attr('value',id);
                        $('#hapus-idtipe').attr('value',tipeid_organisasi);
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
@stop