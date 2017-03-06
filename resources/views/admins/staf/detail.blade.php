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
                    <ul class="list-group list-group-unbordered">
                        <?php 
                            $pekerjaan = array();
                            foreach ($riwayats2 as $j){
                                if($j->keterangan2 == 'Manajemen'){
                                    if($j->sekarang == "1"){
                                        $pekerjaan[] = '<b>'.$j->name.' '.$j->keterangan.'</b>';
                                    }
                                }else{
                                    $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->mulai)->format('Y');
                                    $selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->selesai)->format('Y');
                                    $now =   \Carbon\Carbon::now()->format('Y');
                                    if($selesai >= $now){
                                        $pekerjaan[] = '<b>'.$j->name.' '.$j->keterangan.'</b><br/> periode '.$mulai.' - '.$selesai;
                                    }
                                }
                            }
                        ?> 
                        @if(!empty($pekerjaan))
                            @foreach($pekerjaan as $p)
                            <li class="list-group-item">
                                <p class="text-center">{!! $p  !!}</p>
                            </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                <p class="text-center">-</p>
                            </li>
                        @endif
                    </ul>
                    <a href="#" class="btn btn-warning btn-block"><i class="fa fa-check"></i> <b>Aktif</b></a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>0</h3>
                    <p>Kegiatan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
                <a href="#" class="small-box-footer">Kegiatan yang telah diikuti</a>
            </div>
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>0</h3>
                    <p>Kegiatan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar-minus-o"></i>
                </div>
                <a href="#" class="small-box-footer">Kegiatan yang belum diikuti</a>
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
                            <h4 class="page-header color1">Biodata</h4>
                            <div class="row">
                                <div class="col-lg-4">
                                    <b>No. Identitas</b>: @if(!empty($data->noid)){{ $data->noid }}@else{{ "-" }}@endif
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
                            <h4 class="page-header color1">Riwayat Pekerjaan</h4>
                            <table class="table table-hover " id="dataTables-pekerjaan">
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
                                    <tr
                                    @if(!empty($riwayat2->sekarang) && $riwayat2->sekarang != '0')
                                        {!! 'class="highlight"'  !!}
                                    @endif>
                                        <td hidden>{{ $riwayat2->id }}</td>
                                        @if(!empty($riwayat2->name))
                                            <td>{{ $riwayat2->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if(!empty($riwayat2->keterangan))
                                            @if($riwayat2->keterangan == "bkcu")
                                                <td>PUSKOPDIT BKCU Kalimantan</td>
                                            @else
                                                @if(!empty($riwayat2->cuprimer))
                                                    <td>{{ $riwayat2->cuprimer->name}}</td>
                                                @else
                                                    <td>{{ $riwayat2->keterangan }}</td>
                                                @endif
                                            @endif
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
                                                <td data-order="Masih Aktif">Masih Aktif</td>
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
                            <h4 class="page-header color1">Riwayat Pendidikan</h4>
                            <table class="table table-hover " id="dataTables-pendidikan">
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
                            <h4 class="page-header color1">Riwayat Berorganisasi</h4>
                            <table class="table table-hover " id="dataTables-organisasi">
                                <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th hidden></th>
                                    <th>Nama Organisasi</th>
                                    <th>Jabatan</th>
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

<!-- modalriwayat -->
<div class="modal fade" id="modalriwayat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.riwayat'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog modal-lg">
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
                <input type="text" name="tiperadio" id="tiperadio" value="" hidden>

                <div class="form-group">
                    <h4 id="judulnama"></h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'textnama',
                          'placeholder' => 'Silahkan masukkan nama','autocomplete'=>'off', 'required'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>  
                    </div>
                    <div class="help-block">Harus diisi.</div>
                </div>

                <div class="form-group" id="tempat">
                    <h4>Tempat</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="radiotempat" id="radiocu" onclick="func_radiocu()" value="true">
                        </span>
                                <?php $culists = App\Cuprimer::orderBy('name','asc')->get(); ?>
                                <select class="form-control placeholder" name="selectcu" id="selectcu" disabled>
                                    <option hidden>Credit Union</option>
                                    <option value="PUSKOPDIT BKCU Kalimantan">PUSKOPDIT BKCU Kalimantan</option>
                                        @foreach($culists as $culist)
                                            <option value="{{ $culist->id }}">{{ $culist->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="radiotempat" id="radiolembaga" onclick="func_radiolembaga()" value="true">
                                </span>
                                {{ Form::text('textlembaga',null,array('class' => 'form-control','id'=>'textlembaga',
                                    'placeholder' => 'Bukan Credit Union','autocomplete'=>'off','disabled'))}}
                                <span class=""></span>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="tingkat">
                    <h4>Tingkatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control placeholder" name="selecttingkat" id="selecttingkat">
                            <option value="0" hidden>Silahkan pilih tingkat</option>
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
                        {{ Form::text('mulai',null,array('class' => 'form-control','id'=>'mulai',
                            'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                    </div>
                </div>

                <div class="form-group">
                    <h4>Tanggal Selesai</h4>
                    <div class="input-group" id="groupselesai">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        {{ Form::text('selesai',null,array('class' => 'form-control','id'=>'selesai',
                            'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
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
<!-- /modalriwayat -->
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
    function func_radiocu(){
        $('#selectcu').prop('disabled',false);
        $('#textlembaga').prop('disabled',true);
        $('#textlembaga').val('');
        $('#tingkat').show();
        $('#tiperadio').val('1');
    }
    function func_radiolembaga(){
        $('#selectcu').prop('disabled',true);
        $('#selectcu').val($('#selectcu option:first').val());
        $('#textlembaga').prop('disabled',false);
        $('#textlembaga').focus();
        $('#tingkat').hide();
        $('#tiperadio').val('2');
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
    var tipeid_pekerjaan = '3';
    new $.fn.dataTable.Buttons(tablepekerjaan,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalriwayat').modal({show:true});

                    $('#groupmasihbekerja').hide();
                    $('#groupselesai').show();
                    $('#tempat').show();
                    $('#tingkat').hide();
                    $('#tipependidikan').hide();
                    $('#keterangan').hide();
                    $('#masihbekerja').hide();
                    $('#groupselesai').show();

                    $('#modaljudul').text('Tambah Pekerjaan');
                    $('#judulketerangan').text('Tempat');
                    $('#judulnama').text('Nama Jabatan');
                    $('#textketerangan').attr('placeholder','Silahkan masukkan tempat bekerja');
                    $('#textnama').attr('placeholder','Silahkan masukkan nama jabatan');
                    $('#idtipe').val(tipeid_pekerjaan);
                    $('#sekarang').val('0');
                    $('#id').val('');
                    $('#textnama').val('');
                    $('#textketerangan').val('');
                    $('#selecttipe').val('0');
                    $('#mulai').val('');
                    $('#selesai').val('');
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
                    var tempat = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[2];
                    });
                    var tingkat = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var mulai = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[4].display;
                    });
                    var selesai = $.map(tablepekerjaan.rows({ selected: true }).data(),function(item){
                        return item[5].display;
                    });
                    if(id != ""){
                        $('#modalriwayat').modal({show:true});

                        $('#tipependidikan').hide();
                        $('#keterangan').hide();
                        $('#tempat').show();

                        $('#modaljudul').text('Ubah Pekerjaan');
                        $('#judulnama').text('Nama Jabatan');
                        $('#textnama').attr('placeholder','Silahkan masukkan nama jabatan');

                        $('#idtipe').val(tipeid_pekerjaan);
                        $('#mulai').val(mulai);
                        $('#id').val(id);
                        $('#textnama').val(nama);

                        if(tingkat == "-"){
                            $('#tingkat').hide();

                            $("#radiolembaga").prop("checked", true);
                            $("#radiocu").prop("checked", false);
                            $('#selectcu').prop('disabled',true);
                            $('#selectcu').val($('#selectcu option:first').val());
                            $('#textlembaga').prop('disabled',false);
                            $('#textlembaga').focus();
                            
                            $('#textlembaga').val(tempat);
                            $('#tiperadio').val('2');
                        }else{
                            $('#tingkat').show();

                            $("#radiolembaga").prop("checked", false);
                            $("#radiocu").prop("checked", true);
                            $('#selectcu').prop('disabled',false);
                            $('#textlembaga').prop('disabled',true);
                            $('#textlembaga').val('');

                            $('#selectcu').val(tempat);
                            $('#selecttingkat').val(tingkat);
                            $('#tiperadio').val('1');
                        }

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
                        $('#hapus-tipe').text('Hapus Pekerjaan');
                        $('#hapus-nama').text('Hapus Pekerjaan');
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
                    $('#judulnama').text('Nama Tingkat Pendidikan');
                    $('#textketerangan').attr('placeholder','Silahkan masukkan tempat bekerja');
                    $('#textnama').attr('placeholder','Silahkan masukkan nama tingkat pendidikan');
                    $('#idtipe').val(tipeid_pendidikan);
                    $('#sekarang').val('0');
                    $('#id').val('');
                    $('#textnama').val('');
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
                        $('#judulnama').text('Nama Jabatan');
                        $('#textketerangan').attr('placeholder','Silahkan masukkan tempat pendidikan');
                        $('#textnama').attr('placeholder','Silahkan masukkan nama jabatan');
                        $('#idtipe').val(tipeid_pendidikan);
                        $('#mulai').val(mulai);
                        $('#id').val(id);
                        $('#textnama').val(nama);
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

    var tipeid_organisasi = '2';
    new $.fn.dataTable.Buttons(tableorganisasi,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function(){
                    $('#modalriwayat').modal({show:true});

                    $('#groupmasihbekerja').hide();
                    $('#groupselesai').show();
                    $('#tempat').hide();
                    $('#tingkat').hide();
                    $('#tipependidikan').hide();
                    $('#keterangan').show();
                    $('#masihbekerja').hide();
                    $('#groupselesai').show();

                    $('#modaljudul').text('Tambah Organisasi');
                    $('#judulketerangan').text('Jabatan');
                    $('#judulnama').text('Nama Organisasi');
                    $('#textketerangan').attr('placeholder','Silahkan masukkan keterangan');
                    $('#textnama').attr('placeholder','Silahkan masukkan nama organisasi');
                    $('#idtipe').val(tipeid_organisasi);
                    $('#sekarang').val('0');
                    $('#id').val('');
                    $('#textnama').val('');
                    $('#textketerangan').val('');
                    $('#selecttipe').val('0');
                    $('#mulai').val('');
                    $('#selesai').val('');
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
                        $('#modalriwayat').modal({show:true});

                        $('#tempat').hide();
                        $('#tingkat').hide();
                        $('#tipependidikan').hide();
                        $('#keterangan').show();

                        $('#modaljudul').text('Ubah Organisasi');
                        $('#judulketerangan').text('Keterangan');
                        $('#judulnama').text('Nama Organisasi');
                        $('#textketerangan').attr('placeholder','Silahkan masukkan keterangan');
                        $('#textnama').attr('placeholder','Silahkan masukkan nama organisasi');
                        $('#idtipe').val(tipeid_organisasi);
                        $('#mulai').val(mulai);
                        $('#id').val(id);
                        $('#textnama').val(nama);
                        $('#textketerangan').val(keterangan);

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
                        $('#hapus-tipe').text('Hapus Organisasi');
                        $('#hapus-nama').text('Hapus Organisasi');
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