<?php
$title = "Profil CU";
$kelas = "cuprimer";
$imagepath = "images_cu/";

if(!empty($data->do)){
    if($data->do == "1"){
        $do ="Barat";
    }else if($data->do == "2"){
        $do ="Tengah";
    }else if($data->do == "3"){
        $do ="Timur";
    }else{
        $do ='-';
    }
}else{
    $do = '-';
}

$dateultah = new Date($data->ultah);
$datejoin = new Date($data->bergabung);
$cu = Auth::user()->getCU();
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-building"></i> {{ $title }}
        <small>Informasi {{ $title }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        @if($cu == 0)
            <li><a href="{{ route('admins.cuprimer.index') }}"><i class="fa fa-building"></i> Kelola CU</li></a>
        @endif
        <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                        <div class="modalphotos" >
                            <img class="img-responsive"  width="100%" src="{{ asset($imagepath.$data->gambar.'n.jpg') }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->gambar."jpg") }}">
                        </div>
                    @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                        <div class="modalphotos" >
                            <img class="img-responsive" width="100% src="{{ asset($imagepath.$data->gambar) }}"
                                 id="tampilgambar" alt="{{ asset($imagepath.$data->gambar) }}">
                        </div>
                    @else
                        <img class="img-responsive" width="100%"" src="{{ asset('images/image-cu.jpg') }}"
                             id="tampilgambar" alt="cu profile">
                    @endif
                    <br/>
                    <h3 class="profile-username text-center">{{ $data->name }}</h3>
                    <p class="text-muted text-center">{{ $data->wilayahcuprimer->name }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>No. BA</b> <a class="pull-right">{{ $data->no_ba }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>District Office</b> <a class="pull-right">{{ $do }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl. Berdiri</b> <a class="pull-right">{{ $dateultah->format('j F Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl. Bergabung</b> <a class="pull-right">{{ $datejoin->format('j F Y') }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('admins.cuprimer.edit', array($id)) }}" class="btn btn-default btn-block">
                        <i class="fa fa-pencil"></i> Ubah</a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="small-box bg-aqua">
                <?php $total_pengumuman = App\TpCU::where('cu','=',$data->no_ba)->count(); $route = route('admins.tpcu.index_cu',array($data->no_ba)); ?>
                <div class="inner">
                    <a href="{{ $route }}" style="color:white"> 
                        <h3>{{ $total_pengumuman }}</h3>
                        <p>TP CU</p>
                    </a>
                </div>
                <div class="icon">
                   <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                        <i class="fa fa-home"></i>
                   </a>
                </div>
                <a href="{{ $route }}"
                   class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- /.col -->

        <div class="col-md-9">
            <!-- Alert -->
            @include('admins._layouts.alert')
            <!-- /Alert -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Informasi Umum</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <section id="informasi">
                            <div class="row">
                                <div class="col-lg-6">
                                    <b>No. Badan Hukum:</b> {{ $data->badan_hukum }}
                                    <br/>
                                    <b>No.Telepon:</b> {{ $data->telp }}
                                    <br/>
                                    <b>No. Handphone:</b> {{ $data->hp }}
                                    <br/><br/>
                                    <b>Email:</b> {{ $data->email }}
                                    <br/>
                                    <b>Website:</b> {{ $data->website }}
                                    <br/>
                                    <b>Aplikasi Komputerisasi:</b> {{ $data->app }}
                                </div>
                                <div class="col-lg-4">
                                    <b>Kode Pos:</b> {{ $data->pos }}
                                    <br/><br/>
                                    <b>Alamat</b><br/>
                                    {{ $data->alamat }}
                                </div>
                            </div>
                            <hr/>
                        </section>
                        <section id="deskripsi">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(empty($data->deskripsi))
                                        <div class="callout callout-info">
                                          <h1>Ayo! Isi profil CU anda...</h1>
                                          <p>Silahkan tambahkan misi, visi, nilai-nilai inti dan slogan serta profil singkat CU.</p>
                                        </div>
                                        {{ Form::model($data,array('route' => array('admins.'.$kelas.'.update_deskripsi',$data->id),'method' => 'put','role' => 'form')) }}
                                            <textarea id="summernote" name="deskripsi"></textarea>
                                            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan">
                                                <i class="fa fa-save"></i> <u>S</u>impan
                                            </button>
                                        {{ Form::close() }}
                                    @else
                                        {!! $data->deskripsi !!}
                                    @endif
                                </div>      
                            </div>
                        </section>    
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

@section('js')
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-ext-addclass.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-cleaner.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#summernote').summernote({
            minHeight: 300,
            dialogsFade: true,
            placeholder: 'Silahkan isi disini...',
            addclass: {
                debug: false,
                classTags: [{title:"Button",value:"btn btn-success"},"jumbotron", "lead","img-rounded","img-circle", "img-responsive","btn", "btn btn-success","btn btn-danger","text-muted", "text-primary", "text-warning", "text-danger", "text-success", "table-bordered", "table-responsive", "alert", "alert alert-success", "alert alert-info", "alert alert-warning", "alert alert-danger", "visible-sm", "hidden-xs", "hidden-md", "hidden-lg", "hidden-print"]
            },
            cleaner:{
                notTime:2400, // Time to display Notifications.
                action:'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline:'<br>', // Summernote's default is to use '<p><br></p>'
                notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
                icon:'<i class="note-icon">Clean Word Format</i>'
            },
            toolbar: [
                ['cleaner',['cleaner']],
                ['para',['style']],
                ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
                ['font', ['strikethrough', 'superscript', 'subscript','clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol']],
                ['paragraph',['paragraph']],
                ['table',['table']],
                ['height', ['height']],
                ['misc',['fullscreen']],
                ['misc2',['undo','redo']]
            ]
        });
    });    
</script>
@stop

@stop

