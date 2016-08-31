<?php
$title = "Kelola CU";
$kelas = 'cuprimer';
?>

@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data CU Primer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!-- content -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover order-column" id="dataTables-example">
                <thead>
                <tr>
                    <th hidden></th>
                    <th>No. BA</th>
                    <th>Nama </th>
                    <th>Wilayah</th>
                    <th>Tanggal <br/> Berdiri</th>
                    <th>Tanggal <br/> Bergabung</th>
                    <th>TP</th>
                    <th>Staf</th>
                    <th>Aplikasi</th>
                    <th>Badan Hukum</th>
                    <th>Telepon</th>
                    <th>Handphone</th>
                    <th>Kode Pos</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Website</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td hidden>{{ $data->id }}</td>
                         @if(!empty($data->no_ba))
                            <td>{{ $data->no_ba }}</td>
                        @else
                            <td>-</td>
                        @endif
                        @if(!empty($data->name))
                            <td>{{ $data->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->wilayahcuprimer->name))
                            <td>{{ $data->wilayahcuprimer->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->ultah))
                            <?php $date = new Date($data->ultah); ?>
                            <td data-order="{{ $data->ultah }}">{{ $date->format('d/m/Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->bergabung))
                            <?php $date2 = new Date($data->bergabung); ?>
                            <td data-order="{{ $data->bergabung }}">{{ $date2->format('d/m/Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tp))
                            <td>{{ $data->tp }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->staf))
                            <td>{{ $data->staf }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->app))
                            <td>{{ $data->app }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->badan_hukum))
                            <td>{{ $data->badan_hukum }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->telp))
                            <td>{{ $data->telp }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->hp))
                            <td>{{ $data->hp }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->pos))
                            <td>{{ $data->pos }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->email))
                            <td>{{ $data->email }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->alamat))
                            <td>{{ $data->alamat }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->website))
                            <td><a href="http://{{$data->website}}" class="facebook" target="_blank"> {{ $data->website }} </a></td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- content -->
</section>

<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus CU</h4>
            </div>
            <div class="modal-body">
                <h4>Menghapus CU ini?</h4>
                <input type="text" name="id" value="" id="modal1id" hidden>
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
<!-- /.modal -->

@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
    <script>
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    extend:'colvis',
                    text: '<i class="fa fa-table"></i>'
                },
                {
                    extend:'colvisRestore',
                    text: '<i class="fa fa-refresh"></i>'
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
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
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/edit";
                        }
                    }
                },
                {
                    text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        if(id != ""){
                            $('#modal1show').modal({show:true});
                            $('#modal1id').attr('value',id);
                        }
                    }
                },
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-line-chart"></i> Perkembangan',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        if(id != ""){
                            window.location.href =  "/admins/perkembangancu/index_cu/" + id;
                        }
                    }
                },
                {
                    text: '<i class="fa fa-home"></i> TP',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        if(id != ""){
                            window.location.href =  "/admins/tpcu/index_cu/" + id;
                        }
                    }
                },
                {
                    text: '<i class="fa fa-sitemap"></i> Staf',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        if(id != ""){
                            window.location.href =  "/admins/staf/index_cu/" + id;
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/detail";
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    extend:'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend:'print',
                    text: '<i class="fa fa-print"></i> Print',
                    exportOptions: {
                        stripHtml: false,
                        columns: ':visible'
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop