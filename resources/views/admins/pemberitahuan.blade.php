<?php 
    $title="Pemberitahuan";
    $user = Auth::user();
 ?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-bell-o"></i> {{ $title }}
        <small>Semua Pemberitahuan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-bell-o"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_pemberitahuan" data-toggle="tab">Pemberitahuan</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="tab_pemberitahuan" style="a:color:black;">
                @if(!empty($user->notifications) && count($user->notifications) > 0 )
                        @foreach($user->notifications as $i => $notification)
                            <?php 
                                if ($i > 25) break;
                                $username = App\User::where('id',$notification->data['user'])->select('name')->first(); 
                            ?>
                            @if(strtolower($notification->data['tipe']) == 'menambah laporancu')
                                <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;color: black;">
                                <i class="fa fa-line-chart text-aqua"></i><b class="text-aqua">
                            @elseif(strtolower($notification->data['tipe']) == 'mengubah laporancu')  
                                <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;color: black;">
                                <i class="fa fa-line-chart text-warning"></i><b class="text-warning">
                            @elseif(strtolower($notification->data['tipe']) == 'menghapus laporancu')  
                                <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;color: black;">
                                <i class="fa fa-line-chart text-danger"></i><b class="text-danger">     
                            @elseif(strtolower($notification->data['tipe']) == 'menulis diskusilaporan') 
                                <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;color: black;">
                                <i class="fa fa-commenting-o text-aqua"></i><b class="text-aqua">
                            @elseif(strtolower($notification->data['tipe']) == 'mengubah diskusilaporan') 
                                <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;color: black;">
                                <i class="fa fa-commenting-o text-warning"></i><b class="text-warning">
                            @elseif(strtolower($notification->data['tipe']) == 'menghapus diskusilaporan') 
                                <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;color: black;">
                                <i class="fa fa-commenting-o text-danger"></i><b class="text-danger">        
                            @endif
                            {{ $username->name }} [{{ $notification->data['cu'] }}]</b> 
                            <?php $date = new Date($notification->created_at); ?>
                            {{ $notification->data['message'] }}<br/>

                            @if(!empty($notification->data['message2']))
                                <div class="well well-sm" style="margin-bottom: 0px;color: black;">{{ $notification->data['message2']}}</div>
                            @endif

                            <small class="text-muted">{{ $date->format('d F') }} - {{ $date->format('H:i') }}</small> 
                            </a>
                            <hr style="margin-top: 5px;" />
                        @endforeach
                @else
                    Kamu memiliki tidak memiliki pemberitahuan.
                    <hr style="margin-top: 5px;"/>
                @endif    
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
@stop