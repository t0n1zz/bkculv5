<?php $title="Statistik Pengunjung Website"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-road"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ip </th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($statistiks as $statistik)
            <tr>

                @if(!empty($statistik->ip))
                    <td>{{ $statistik->ip }}</td>
                @else
                    <td>-</td>
                @endif

                @if(!empty($statistik->tanggal))
                    <?php $tanggal = new Date($statistik->tanggal); ?>
                     <td>{{ $tanggal->format('j F Y '); }}</td>
                @else
                    <td>-</td>
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <!-- pagination -->
        <div class="row">
            <div class="col-md-12 col-sm-12 pagination-wrapper">
                @if(!empty($key))
                    {{ $statistiks->appends(array('q' => $key))->links() }}
                @else
                    {{ $statistiks->links() }}
                @endif
            </div>
        </div>
        <!-- /pagination -->
    </div>
</div>
@stop