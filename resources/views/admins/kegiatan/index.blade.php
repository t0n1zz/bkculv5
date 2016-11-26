<?php
$title = "Kelola Kegiatan";
$kelas = "kegiatan";
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
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
            <div class="tab-pane fade in active" id="tab_kegiatan">
                <div class="col-sm-9" style="padding: .2em ;">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                </div>
                <div class="col-sm-3" style="padding: .2em ;">
                    <?php
                        $data = App\Models\Kegiatan::orderBy('tanggal','DESC')->groupBy('tanggal')->get(['tanggal']);
                        $dataperiode = $data->groupBy('tanggal');

                        $dataperiode1 = collect([]);
                        foreach ($dataperiode as $data){
                            $dataperiode1->push($data->first());
                        }
                        $periodes = array_column($dataperiode1->toArray(),'tanggal');
                    ?>
                    <div class="input-group tabletools">
                        <div class="input-group-addon primary-color"><i class="fa fa-clock-o fa-fw"></i> Periode Kegiatan</div>
                        <select class="form-control"  id="">
                            @foreach($periodes as $periode)
                                <?php $date = new Date($periode); ?>
                                <option value="">{{ $date->format('Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th data-sortable="false">#</th>
                        <th hidden></th>
                        <th>Nama </th>
                        <th>Wilayah</th>
                        <th>Tempat</th>
                        <th>Sasaran</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Lama</th>
                        <th>Terlaksana</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td class="bg-aqua disabled color-palette"></td>
                            <td hidden>{{ $data->id }}</td>
                            @if(!empty($data->name))
                                <td class="warptext">{{ $data->name }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->wilayah))
                                <td>{{ $data->wilayah }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->tempat))
                                <td>{{ $data->tempat }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->sasaran))
                                <td class="warptext">{{ $data->sasaran }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->tanggal))
                                <?php $date = new Date($data->tanggal); ?>
                                <td><i hidden="true">{{ $data->tanggal }}</i> {{  $date->format('d/n/Y') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->tanggal2))
                                <?php $date2 = new Date($data->tanggal2); ?>
                                <td><i hidden="true">{{ $data->tanggal2 }}</i> {{ $date2->format('d/n/Y') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            <td>
                                <?php
                                    $startTimeStamp = strtotime($data->tanggal);
                                    $endTimeStamp = strtotime($data->tanggal2);
                                    $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                    $numberDays = $timeDiff/86400;
                                    $numberDays = intval($numberDays);
                                ?>
                                {{ $numberDays }} Hari
                            </td>

                            @if($data->status == "0")
                                <td>Belum</td>
                            @else
                                <td>Sudah</td>
                            @endif
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
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
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
                }
                @endpermission
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );

        new $.fn.dataTable.Buttons(table,{
            buttons: [
                @permission('view.kegaitandetail_view')
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
                @endpermission
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop