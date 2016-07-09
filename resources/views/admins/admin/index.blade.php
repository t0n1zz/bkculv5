<?php
$title = "Kelola Admin";
$kelas = "admin";
?>

@extends('admins._layouts.layout')

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
                    <th></th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>CU</th>
                    <th>Login</th>
                    <th>Logout</th>
                    <th>Status</th>
                    <th>Ubah Password</th>
                    <th>Ubah Hak Akses</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td></td>
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

                        @if($data->id > 1)
                            @if($data->status == 0)
                                <td><a href="{{route('admins.'.$kelas.'.update_status',array($data->id))}}" class="btn btn-default"
                                       name="{{$data->id}}">Tidak Aktif</a</td>
                            @elseif($data->status == 1)
                                <td><a href="{{route('admins.'.$kelas.'.update_status',array($data->id))}}" class="btn btn-warning "
                                       name="{{$data->id}}">Aktif</a></td>
                            @else
                                <td><a href="{{route('admins.'.$kelas.'.update_status',array($data->id))}}" class="btn btn-default"
                                       name="{{$data->id}}">-</a></td>";
                            @endif
                        @else
                            <td><a href="#" class="btn btn-warning" disabled>Aktif</a></td>
                        @endif

                        @if($data->id > 1)
                            <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit_password',
                                array($data->id))}}">
                                    <i class="fa fa-pencil"></i></a></td>
                        @else
                            <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit_password',
                                array($data->id))}}" disabled>
                                    <i class="fa fa-pencil"></i></a></td>
                        @endif

                        @if($data->id > 1)
                            <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit_akses',
                                array($data->id))}}">
                                    <i class="fa fa-pencil"></i></a></td>
                        @else
                            <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit_akses',
                                array($data->id))}}" disabled>
                                    <i class="fa fa-pencil"></i></a></td>
                        @endif

                        <td><button class="btn btn-danger modal1" name="{{ $data->id }}">
                                <i class="fa fa-trash"></i></button></td>
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
                <strong style="font-size: 16px">Menghapus admin ini?</strong>
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
