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
                            foreach ($riwayatpekerjaan as $j){
                                $tempat = "";
                                if($j->tipe == 1){
                                    foreach($culists as $cu){
                                        if($j->tempat == $cu->id){
                                            $tempat = "CU " .$cu->name;
                                        }
                                    }
                                }else{
                                    foreach($lembagas as $lembaga){
                                        if($j->tempat == $lembaga->id){
                                            $tempat = $lembaga->name;
                                        }
                                    }
                                }
                                if($j->tingkat != 'Pengurus' && $j->tingkat != 'Pengawas'){
                                    if($j->sekarang == "1"){
                                        $pekerjaan[] = '<b>'.$j->name.' '.$tempat.'</b>';
                                    }
                                }else{
                                    if(!empty($j->mulai))
                                        $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->mulai)->format('Y');
                                    if(!empty($j->selesai)){
                                        $selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->selesai)->format('Y');
                                        $now =   \Carbon\Carbon::now()->format('Y');
                                        if($selesai >= $now){
                                            $pekerjaan[] = '<b>'.$j->name.' '.$tempat.'</b><br/> periode '.$mulai.' - '.$selesai;
                                        }
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
                    <li class="active"><a href="#info" data-toggle="tab">Biodata</a></li>
                    <li><a href="#kegiatan_ikut" data-toggle="tab">Kegiatan sudah diikuti</a></li>
                    <li><a href="#kegiatan_belumikut" data-toggle="tab">Kegiatan belum diikuti</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <section id="informasi">
                            <h4 class="page-header color1">Identitas</h4>
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
                                    <b>Kontak</b><br/>
                                    @if(!empty($data->kontak))
                                        <?php $newarr = explode("\n",$data->kontak); ?>
                                        @foreach($newarr as $str)
                                            <p>{{ $str }}</p>
                                        @endforeach
                                    @else
                                        <p>{{ "-" }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-4">
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
                        <section id="riwayatpekerjaan">
                            <br/>
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
                                                @if($riwayat2->tempat == "bkcu")
                                                <td>PUSKOPDIT BKCU Kalimantan</td>
                                                @else
                                                    @foreach($culists as $cu)
                                                        @if($riwayat2->tempat == $cu->id)
                                                            <td>CU {{ $cu->name }}</td>   
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                @foreach($lembagas as $lembaga)
                                                    @if($riwayat2->tempat == $lembaga->id)
                                                        <td>{{ $lembaga->name }}</td> 
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif

                                        <td>{{ $riwayat2->tingkat }}</td>

                                        <td>{{ $riwayat2->bidang }}</td>

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
                            <hr/>
                        </section>
                        <section id="riwayatpendidikan">
                            <br/>
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
                            <hr/>
                        </section>
                        <section id="riwayatorganisasi">
                            <br/>
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
                                            <td data-order="Masih Organisasi">Masih Organisasi</td>
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
<!-- /Hapus -->
@stop

@section('js')
@include('admins.staf._components.formjs')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
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
                    $('#selectbidangcu').val($('#selectbidangcu option:first').val());

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

                        if(tipe == "1"){ //cu
                            $('#tingkatcu').show();
                            $('#tingkatlembaga').hide();
                            $('#selecttingkatcu').val(tingkat);

                            if(tingkat == "Pengurus" ||tingkat == "Pengawas" || tingkat == "Komite"){
                                $('#bidang').hide();
                            }else{
                                $('#bidang').show();
                                
                                $('#selectbidangcu').val(bidang);
                            }

                            $("#radiocu").prop("checked", true);
                            $('#selectcu').prop('disabled',false);
                            $('#selectcu').val(tempat);

                            $("#radiolembaga").prop("checked", false);
                            $('#selectlembaga').prop('disabled',false);
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
                            $("#namapendidikan").prop('required',false); 
                        }else{
                            $('#jurusan').show();
                            $('#namapendidikan').val(jurusan);
                            $("#namapendidikan").prop('required',true); 
                        }

                        $("#tempatpendidikan").prop('required',true);
                        
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
@stop