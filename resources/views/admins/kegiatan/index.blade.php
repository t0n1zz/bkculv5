<?php
$title = "Kelola Kegiatan";
$kelas = "kegiatan";
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
                        <th data-sortable="false">#</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th>Nama </th>
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
                            <td class="bg-aqua disabled color-palette"></td>
                            <td hidden>{{ $data->id }}</td>
                            <td hidden>{{ $data->status }}</td>
                            
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
                                    <a class="btn btn-info btn-sm">{{ $datasasaran->sasaran->name }}</a>
                                @endforeach
                                </p></td>
                            @else
                                <td></td>    
                            @endif
                            
                            <td>{{ $data->min }} Orang</td>
                            <td>{{ $data->max }} Orang</td>
                            <td>{{ $data->total_peserta->count() }} Orang</td>

                            <td>
                                @if($data->status == "1")
                                    <a href="#" class="btn btn-warning btn-sm " data-toggle="tooltip" data-placement="left" title="Kegiatan sudah dilaksanakan"><i class="fa fa-check"></i></a>
                                @elseif($data->status == "2")
                                    <a href="#" class="btn btn-danger btn-sm " data-toggle="tooltip" data-placement="left" title="Kegiatan batal dilaksanakan"><i class="fa fa-times"></i></a>
                                @else
                                    <a href="#" class="btn btn-default btn-sm " data-toggle="tooltip" data-placement="left" title="Kegiatan belum dilaksanakan"><i class="fa fa-ban"></i></a>
                                @endif
                            </td>
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
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/edit";
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('destroy.'.$kelas.'_destroy')
                {
                    text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        var name = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            $('#modalhapus').modal({show:true});
                            $('#modalhapus_id').attr('value',id);
                            $('#modalhapus_judul').text('Hapus Kegiatan');
                            $('#modalhapus_detail').text('Yakin menghapus kegiatan "' + name + '" ?');
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
                            return item[1];
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