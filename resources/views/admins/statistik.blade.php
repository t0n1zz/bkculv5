<?php 
    $title="Statistik";
    $kelas="statistik";
 ?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-road"></i> {{ $title }}
        <small>Mengelola Data Pengujung Website</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-road"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_statistik" data-toggle="tab">Statistik Website</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane fade in active" id="tab_statistik">
                <table class="table table-hover order-column" id="dataTables-example" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th hidden>#</th>
                                <th>Ip </th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statistiks as $statistik)
                            <tr>
                                <td class="bg-aqua disabled color-palette" hidden></td>
                                @if(!empty($statistik->ip))
                                    <td>{{ $statistik->ip }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($statistik->tanggal))
                                    <?php $tanggal = new Date($statistik->tanggal); ?>
                                     <td>{{ $tanggal->format('j F Y ') }}</td>
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
</section>
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
@stop