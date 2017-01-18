<?php
$title = "Detail Laporan CU ";
$kelas = "laporancu";
$iduser = \Auth::user()->getId();
$culists = App\Models\Cuprimer::orderBy('name','asc')->where('status','=','1')->get();
$culists_non = App\Models\Cuprimer::orderBy('name','asc')->where('status','=','0')->get();

$dataperiode = App\Models\laporancu::where('no_ba','=',$data->cuprimer->no_ba)->orderBy('periode','DESC')->groupBy('periode')->get(['id','periode']);
$pilihperiode = $dataperiode->groupBy('periode');

$pilihperiodes = collect([]);
foreach ($pilihperiode as $dataperiode){
    $pilihperiodes->push($dataperiode->first());
}
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ $title }}
        <small>CU {{  $data->cuprimer->name }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('admins/laporancu') }}"><i class="fa fa-line-chart"></i> Laporan CU</a></li>
        <li class="active"><i class="fa fa-database"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-solid">
        <div class="box-body">
            <div class="col-sm-12" style="padding: .2em ;">
                <div class="input-group">
                    <div class="input-group-addon primary-color"><i class="fa fa-clock-o fa-fw"></i> Periode Laporan</div>
                    <select class="form-control" id="dynamic_select2">
                        @foreach($pilihperiodes as $pilihperiode)
                            <?php $date = new Date($pilihperiode->periode); ?>
                            <option {{ Request::is('admins/laporancu/detail/'.$pilihperiode->id) ? 'selected' : '' }}
                                    value="/admins/laporancu/detail/{{$pilihperiode->id}}">{{ $date->format('F Y') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @include('admins._components.laporancu')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_diskusi" data-toggle="tab">Diskusi</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_diskusi">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="chat" id="chat-box"
                            @if($datas2->count() <= 3)
                                style="padding-right: 5px;" 
                            @endif
                        >
                            @foreach($datas2 as $data2)
                                <div class="well well-sm ">
                                    <div class="item">
                                        <img src="" alt="user image" class="online">
                                        <p class="message">
                                          <span class="name">
                                            <?php $date = new Date($data2->created_at); ?>
                                            @if($data2->id_user == $iduser)
                                                <a data-toggle="modal" data-id="{{ $data2->id }}" id="btnmodalhapus" href="#modalhapus"><small class="text-muted pull-right">&nbsp <i class="fa fa-trash"></i> &nbsp</small></a>
                                                <small class="text-muted pull-right">&nbsp | &nbsp</small>
                                                <a data-toggle="modal" data-id="{{ $data2->id }}" data-content="{{$data2->content}}" id="btnmodalubah" href="#modalubah"><small class="text-muted pull-right">&nbsp <i class="fa fa-pencil"></i> &nbsp</small></a>
                                                <small class="text-muted pull-right">&nbsp | &nbsp</small>
                                            @endif
                                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $date->format('j F Y, H:i')  }} &nbsp</small>
                                            {{ $data2->user->name }}
                                          </span>
                                          {!! $data2->content !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12">
                        @if($datas2->count() > 3)
                            <hr style="margin-top: 10px;" />
                        @endif
                        {{ Form::model($datas2,array('route' => array('admins.diskusi.store'),'method' => 'post','data-toggle' => 'validator','role' => 'form')) }}
                            <input type="text" name="id_laporan" value="{{ $data->id }}" hidden>
                            <div class="input-group">
                                <input class="form-control" name="content" placeholder="Tuliskan pesan...." required="true" data-minlength="5">
                                <div class="input-group-btn">
                                  <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
                                </div>
                          </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--content-->
</section>
<div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_diskusi',$kelas), 'method' => 'put','data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-pencil"></i> Ubah Diskusi</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalubah_id" hidden>
                <div class="form-group">
                    <h4>Mengubah diskusi</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('content',null,array('class' => 'form-control','id'=>'modalubah_content',
                        'placeholder' => 'Silahkan masukkan pengumuman','autocomplete'=>'off','required','data-minlength'=>'5'))}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas2,array('route' => array('admins.'.$kelas.'.destroy_diskusi',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash fa-fw"></i> Hapus Diskusi</h4>
            </div>
            <div class="modal-body">
                <h4 style="font-size: 16px" id="modalhapus_detail">Hapus Diskusi</h4>
                <input type="text" name="id" value="" id="modalhapus_id" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash fa-fw"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>

@section('js')
    <script type="text/javascript" src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script type="text/javascript">
        @if(!empty($datas2))
            @if($datas2->count() > 3)
                $('#chat-box').slimScroll({
                    height: '50vh'
                });
            @endif    
        @endif
        $(function(){
            // bind change event to select
            $('#dynamic_select2').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location.href = url; // redirect
                }
                return false;
            });
        });
        // function hapusdiskusi(){
        //     var id = $(this).data('id');
        //      $('#modalhapus').modal({show:true});
        //      $('#modalhapus_judul').text('Hapus Diskusi Laporan CU');
        //      $('#modalhapus_detail').text('Hapus Diskusi Laporan CU');
        //      $('#modalhapus_id').attr('value',id);
        // }
        $(document).on("click", "#btnmodalhapus", function () {
             var id = $(this).data('id');
             $('#modalhapus_id').attr('value',id);
        });
        $(document).on("click", "#btnmodalubah", function () {
             var id = $(this).data('id');
             var content = $(this).data('content');
             $('#modalubah_id').attr('value',id);
             $('#modalubah_content').attr('value',content);
        });     
    </script>
@stop

@stop

