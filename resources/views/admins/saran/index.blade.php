<?php
$title = "Kelola Saran atau Kritik";
$kelas = "saran"
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-paper-plane-o"></i> {{ $title }}
        <small>Mengelola Data Saran atau Kritik</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-paper-plane-o"></i> {{ $title }}</li>
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
            <li class="active"><a href="#tab_saran" data-toggle="tab">Saran Atau Kritik</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_saran">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr >
                        <th data-sortable="false">#</th>
                        <th hidden></th>
                        <th>Nama </th>
                        <th>Saran dan Kritik</th>
                        <th>Tanggal</th>
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
                            @if(!empty($data->content))
                                <td class="warptext">{{{ $data->content }}}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->created_at ))
                                <?php $date = new Date($data->created_at); ?>
                                <td><i hidden="true">{{$data->created_at}}</i> {{  $date->format('d/n/Y') }}</td>
                            @else
                                <td>-</td>
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
                        if(id != ""){
                            if(id != "1"){
                                $('#modalhapus').modal({show:true});
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Admin');
                                $('#modalhapus_detail').text('Yakin menghapus saran ini?');
                            }
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