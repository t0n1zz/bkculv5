<?php
$title = "Diklat";
$kelas = "kegiatan";
$now = Date::now()->format('Y-m-d');
$cu = Auth::user()->getCU();
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Responsive/css/responsive.bootstrap.css')}}" >
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-suitcase"></i> {{ $title }}
        <small>Mengelola Data {{ $title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-suitcase"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_kegiatan" data-toggle="tab">Diklat</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="tab_kegiatan">
                <div class="col-sm-9" style="padding: .2em ;">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                    </div>
                </div>
                <div class="col-sm-3" style="padding: .2em ;">
                    <div class="input-group tabletools">
                        <div class="input-group-addon primary-color"><i class="fa fa-clock-o fa-fw"></i> Periode Diklat</div>
                        <select class="form-control"  id="">
                                <option value="">2017</option>
                        </select>
                    </div>
                </div>
                <table class="table table-hover" id="dataTables-example" cellspacing="0" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th hidden>id</th>
                        <th hidden>status</th>
                        <th data-priority="1" class="warptext">Nama </th>
                        <th>Kota</th>
                        <th class="warptext">Tempat</th>
                        <th class="sort" data-priority="4">Mulai</th>
                        <th data-priority="3">Selesai</th>
                        <th class="none warptext">Sasaran</th>
                        <th data-priority="2">Status</th>
                        <th class="none warptext">Prasyarat</th>
                        <th class="none">Durasi</th>
                        <th class="none">Min</th>
                        <th class="none">Maks</th>
                        <th class="none">Terdaftar</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <?php 
                            $date = new Date($data->tanggal);
                            $date2 = new Date($data->tanggal2);  

                            $mulai = new \Carbon\Carbon($data->tanggal);
                            $startTimeStamp = strtotime($mulai->subDays(1));
                            $endTimeStamp = strtotime($data->tanggal2);
                            $timeDiff = abs($endTimeStamp - $startTimeStamp);
                            $numberDays = $timeDiff/86400;
                            $numberDays = intval($numberDays);

                            $sasaran = '';
                            $prasyarat = '';

                            if(!empty($data->sasaranhub)){
                                foreach ($data->sasaranhub as $sr) {
                                    $sasaran .= '<a class="btn btn-info btn-xs nopointer marginbottom" >' . $sr->sasaran->name . '</a> ';
                                }
                            }

                            if(!empty($data->prasyarat)){
                                foreach ($data->prasyarat as $pr) {
                                    $prasyarat .= '<a class="btn btn-info btn-xs nopointer marginbottom">' . $pr->kegiatan->kode . ' - ' . $pr->kegiatan->name . '</a> ';
                                }
                            }

                            if($data->status == 1){
                                $status = '<a class="btn btn-default btn-sm nopointer"><i class="fa fa-pause"></i> <span class="hidden-xs">MENUNGGU</span></a>';
                            }elseif($data->status == 2){
                                $status = '<a class="btn btn-warning btn-sm nopointer"><i class="fa fa-circle-o"></i> <span class="hidden-xs">PENDAFTARAN TERBUKA</span></a>';
                            }elseif($data->status == 3){
                                $status = '<a class="btn btn-warning btn-sm disabled"><i class="fa fa-ban"></i> <span class="hidden-xs">PENDAFTARAN TERTUTUP</span></a>';
                            }elseif($data->status == 4){
                                $status = '<a class="btn btn-primary btn-sm disabled"><i class="fa fa-dot-circle-o"></i> <span class="hidden-xs">BERJALAN</span></a>';
                            }elseif($data->status == 5){
                                $status = '<a class="btn btn-primary btn-sm nopointer"><i class="fa fa-times"></i> <span class="hidden-xs">TERLAKSANA</span></a>';
                            }elseif($data->status == 6){
                                $status = '<a class="btn btn-danger btn-sm nopointer"><i class="fa fa-times"></i> <span class="hidden-xs">BATAL</span></a>';
                            }else{
                                $status = "-";
                            }
                        ?>
                        <tr>
                            <td hidden>{{ $data->id }}</td>
                            <td hidden>{{ $data->status }}</td>
                            
                            <td class="warptext">{{ $data->name }}</td>
                            @if(!empty($data->tempat))
                                <td>{{ $data->tempat->kota }}</td>
                                <td class="warptext">{{ $data->tempat->name }}</td>
                            @elseif(!empty($data->kota))
                                <td>{{ $data->kota }}</td>
                                <td>-</td>
                            @else
                                <td>-</td>
                                <td>-</td>
                            @endif

                            @if(!empty($data->tanggal))
                                <td data-order="{{ $data->tanggal }}"><i hidden="true">{{ $data->tanggal }}</i> {{  $date->format('d F Y') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->tanggal2))
                                <td data-order="{{ $data->tanggal2 }}"><i hidden="true">{{ $data->tanggal2 }}</i> {{ $date2->format('d F Y') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            <td class="warptext">{!! $sasaran !!}</td>

                            <td data-order="{{ $data->status }}">{!! $status !!}</td>

                            <td class="warptext">{!! $prasyarat !!}</td>
                            <td>{{ $numberDays }} Hari</td>
                            <td>{{ $data->min }} Orang</td>
                            <td>{{ $data->max }} Orang</td>
                            <td>{{ $data->total_peserta->count() }} Orang</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--content-->
</section>
<div class="modal fade" id="modalpending" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.restore'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Lanjutkan Pelatihan</h4>
            </div>
            <div class="modal-body">
                <h4>Lanjutkan pelatihan ini?</h4>
                <input type="text" name="id" value="" id="modalpending_id" hidden="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton">Iya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modaltidakdaftar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-yellow-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-warning fa-fw"></i> Oopss</h4>
            </div>
            <div class="modal-body">
                <h4>Pelatihan ini sudah terlaksana</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-check fa-fw"></i> ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalstatuskegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_status_kegiatan'))) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-square"></i> Ubah Status Diklat</h4>
            </div>
            <div class="modal-body">
                <h4>Status Diklat</h4>
                <input type="text" name="id"  id="idkegiatan" value="" hidden>
                <div class="table-responsive">
                    <table class="table table-condensed" style="margin-bottom: 0px;">
                        <tr>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="1" id="checkmenunggu" /> MENUNGGU</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="2" id="checkbuka" /> PENDAFTARAN TERBUKA</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="3" id="checktutup" /> PENDAFTARAN TERTUTUP</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="4" id="checkjalan" /> BERJALAN</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="5" id="checkterlaksana" /> TERLAKSANA</label>
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #f4f4f4">
                                <div class="checkbox">
                                    <label><input type="radio" name="radiostatus" value="6" id="checkbatal" /> BATAL</label>
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
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/datatable_responsive.js') }}"></script>
    <script>
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                @permission('create.'.$kelas.'_create')
                {
                    text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                    key: {
                        altKey: true,
                        key: 't'
                    },
                    action: function(){
                        window.location.href = "{{URL::to('admins/'.$kelas.'/create')}}";
                    }
                },
                @endpermission
                @permission('update.'.$kelas.'_update')
                {
                    text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var status = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            if(status == 'TERLAKSANA'){
                                $('#modalterlaksana').modal({show:true});
                            }else{
                                window.location.href =  kelas + "/" + id + "/edit";
                            }
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                {
                    text: '<i class="fa fa-check-square"></i> Ubah Status',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var status = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            $('#idkegiatan').val(id);
                            $('#modalstatuskegiatan').modal({show:true});
                            $('#checkmenunggu').prop('checked',false);
                            $('#checktutup').prop('checked',false);
                            $('#checkbuka').prop('checked',false);
                            $('#checkbatal').prop('checked',false);
                            if(status == "1"){
                                $('#checkmenunggu').prop('checked',true);
                            }else if(status == "2"){
                                $('#checktutup').prop('checked',true);
                            }else if(status == "3"){
                                $('#checkbuka').prop('checked',true);
                            }else if(status == "4"){
                                $('#checkjalan').prop('checked',true);
                            }else if(status == "5"){
                                $('#checkterlaksana').prop('checked',true);
                            }else if(status == "6"){
                                $('#checkbatal').prop('checked',true);
                            }
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('destroy.'.$kelas.'_destroy')
                {
                    text: '<i class="fa fa-trash"></i> Hapus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        var status = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            if(status == 'PENDING'){
                                $('#modalbatal').modal({show:true});
                                $('#modalbatal_id').attr('value',id);
                            }else{
                                $('#modalterlaksana').modal({show:true});
                            }
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                {
                    text: '<i class="fa fa-database"></i> Daftar',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/detail";
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop