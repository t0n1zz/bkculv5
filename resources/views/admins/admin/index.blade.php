<?php
$title = "Kelola Admin";
$kelas = "admin";
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
        <small>Mengelola Data Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-user"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-primary">
        <div class="box-header with-border">
            <a accesskey="t" class="btn btn-primary" href="{{ route('admins.'.$kelas.'.create') }}">
                <i class="fa fa-plus"></i> <u>T</u>ambah Admin</a>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th hidden></th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>CU</th>
                    <th>Login</th>
                    <th>Logout</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td hidden>{{ $data->id }}</td>
                        @if(!empty($data->username))
                            <td>{{ $data->username }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->name))
                            <td>{{ $data->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($data->cu == "0")
                            <td>BKCU</td>
                        @elseif($data->cu > 0)
                            <td>{{ $data->cuprimer->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($data->login != "0000-00-00 00:00:00")
                            <?php $date = new Date($data->login); ?>
                            <td><i hidden="true">{{$data->login}}</i> {{ $date->format('j F Y - H:i:s') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($data->logout != "0000-00-00 00:00:00")
                            <?php $date = new Date($data->logout); ?>
                            <td><i hidden="true">{{$data->logout}}</i> {{ $date->format('j F Y - H:i:s') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($data->status == 0)
                            <td><a href="#" class="btn btn-default" disabled>Tidak Aktif</a</td>
                        @elseif($data->status == 1)
                            <td><a href="#" class="btn btn-warning" disabled>Aktif</a></td>
                        @else
                            <td><a href="#" class="btn btn-default" disabled>-</a></td>";
                        @endif

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Admin</h4>
            </div>
            <div class="modal-body">
                <h4 style="font-size: 16px">Menghapus admin ini?</h4>
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
                            if(id != "1"){
                                $('#modal1show').modal({show:true});
                                $('#modal1id').attr('value',id);
                            }
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
                    text: 'Ubah Status',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            if(id != 1){
                                window.location.href =  kelas + "/update_status/" + id;
                            }
                        }
                    }
                },
                {
                    text: 'Ubah Password',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            if(id != "1"){
                                window.location.href =  kelas + "/edit_password/" + id;
                            }
                        }
                    }
                },
                {
                    text: 'Ubah Hak Akses',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            if(id != "1"){
                                window.location.href =  kelas + "/edit_akses/" + id;
                            }
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