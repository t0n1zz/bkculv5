<?php
$title = "Kelola Kegiatan";
$kelas = "kegiatan";
$now = Date::now()->format('Y-m-d');
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
        <i class="fa fa-suitcase"></i> {{ $title }}
        <small>Mengelola Data Kegiatan</small>
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
            <li class="active"><a href="#tab_kegiatan" data-toggle="tab">Kegiatan</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="tab_kegiatan">
                <div class="col-sm-9" style="padding: .2em ;">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                </div>
                <div class="col-sm-3" style="padding: .2em ;">
                    <div class="input-group tabletools">
                        <div class="input-group-addon primary-color"><i class="fa fa-clock-o fa-fw"></i> Periode Kegiatan</div>
                        <select class="form-control"  id="">
                                <option value="">2017</option>
                        </select>
                    </div>
                </div>
                <table class="table table-hover dt-responsive nowarp" id="dataTables-example" cellspacing="0" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th hidden></th>
                        <th hidden></th>
                        <th class="sort" data-priority="1">Nama </th>
                        <th>Kota</th>
                        <th>Tempat</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th class="none">Durasi</th>
                        <th>Sasaran</th>
                        <th class="none">Min</th>
                        <th class="none">Maks</th>
                        <th class="none">Total</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <?php 
                            $date = new Date($data->tanggal);
                            $date2 = new Date($data->tanggal2);  

                            $startTimeStamp = strtotime($data->tanggal);
                            $endTimeStamp = strtotime($data->tanggal2);
                            $timeDiff = abs($endTimeStamp - $startTimeStamp);
                            $numberDays = $timeDiff/86400;
                            $numberDays = intval($numberDays);
                        ?>
                        <tr>
                            <td hidden>{{ $data->id }}</td>
                            @if($data->tanggal2 <= $now)
                                <td hidden>TERLAKSANA</td>
                            @elseif(!empty($data->deleted_at))
                                <td hidden>BATAL</td>
                            @else
                                <td hidden>PENDING</td>
                            @endif
                            
                            <td class="warptext">{{ $data->name }}</td>
                            @if(!empty($data->tempat))
                                <td>{{ $data->tempat->kota }}</td>
                                <td>{{ $data->tempat->name }}</td>
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
                            
                            <td>{{ $numberDays }} Hari</td>

                            @if(!empty($data->sasaranhub))
                                <td><p>
                                @foreach($data->sasaranhub as $datasasaran)
                                    <a class="btn btn-info btn-sm nopointer">{{ $datasasaran->sasaran->name }}</a>
                                @endforeach
                                </p></td>
                            @else
                                <td></td>    
                            @endif
                            
                            <td>{{ $data->min }} Orang</td>
                            <td>{{ $data->max }} Orang</td>
                            <td>{{ $data->total_peserta->count() }} Orang</td>
                            @if($data->tanggal2 <= $now && empty($data->deleted_at))
                                <td data-order="TERLAKSANA"><a href="#" class="btn btn-info btn-sm nopointer">TERLAKSANA</a></td>
                            @elseif(!empty($data->deleted_at))
                                <td data-order="BATAL"><a href="#" class="btn btn-danger btn-sm nopointer">BATAL</a></td>
                            @else
                                <td data-order="PENDING"><a href="#" class="btn btn-default btn-sm nopointer">PENDING</a></td>
                            @endif
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
<div class="modal fade" id="modalbatal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas,array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-times fa-fw"></i> Batalkan Pelatihan</h4>
            </div>
            <div class="modal-body">
                <h4>Batalkan pelatihan ini?</h4>
                <input type="text" name="id" value="" id="modalbatal_id" hidden="">
                <p class="text-muted">Silahkan isikan alasan pembatalan pelatihan ini</p>
                <textarea class="form-control" name="keterangan" rows="3" id="keterangan" placeholder="Alasan pembatalan"></textarea> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton">Iya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
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
<div class="modal fade" id="modalterlaksana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                @endpermission
                @permission('destroy.'.$kelas.'_destroy')
                {
                    text: '<i class="fa fa-check-square"></i> Ubah Status',
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
                            }else if(status == 'BATAL'){
                                $('#modalpending').modal({show:true});
                                $('#modalpending_id').attr('value',id);
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
                    text: '<i class="fa fa-database"></i> Detail',
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