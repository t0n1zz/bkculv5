<?php
$title = "Detail Laporan CU ";
$kelas = "laporancu";
$kelas2 = "laporancudiskusi";
$imagepath = 'images_user/';
$iduser = \Auth::user()->getId();
$cu = \Auth::user()->getCU();

$dataperiode = App\laporancu::where('no_ba','=',$data->cuprimer_all->no_ba)->orderBy('periode','DESC')->get(['id','periode']);
$pilihperiode = $dataperiode->groupBy('periode');

$pilihperiodes = collect([]);
foreach ($pilihperiode as $dataperiode){
    $pilihperiodes->push($dataperiode->first());
}
?>
@extends('admins._layouts.layout')

@section('content')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ $title }}
        <small>CU {{  $data->cuprimer_all->name }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('admins/laporancu/index_cu/'.$data->cuprimer_all->no_ba) }}"><i class="fa fa-line-chart"></i> Laporan CU {{ $data->cuprimer_all->name }}</a></li>
        <li class="active"><i class="fa fa-database"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    @if($data->deleted_at != null)
        <?php $deleted_date = new Date($data->deleted_at); ?>
        <div class="callout callout-danger ">
            <h3 style="margin-top: 5px;"><i class="icon fa fa-trash"></i> Laporan ini telah dihapus!</h3>
            <ul style="margin-left: -3vh;">
                <li>Laporan ini telah dihapus pada tanggal <b>{{ $deleted_date->format('d F Y') }}</b> pukul <b>{{ $deleted_date->format('H:i') }}</b> dan <b>TIDAK MASUK</b> dalam laporan perkembangan dan laporan konsolidasi.</li>
                <li>Apabila anda merasa laporan ini tidak seharusnya dihapus atau karena kesalahan dalam menghapus laporan,
                    @if($cu != 0)
                        maka silahkan hubungi staf bagian litbang PUSKOPDIT BKCU Kalimantan untuk memulihkan laporan ini.
                    @else
                        maka silahkan menekan tombol <b>[<i class="fa fa-check"></i> Pulihkan]</b> untuk memulihkan laporan ini.
                    @endif
                </li>
            </ul>
            @if($cu == 0)
                <btn class="btn btn-default" data-toggle="modal" data-target="#modalpulih"><i class="fa fa-check"></i> Pulihkan</btn>
            @endif
        </div>
    @endif

    <div class="box box-solid">
        <div class="box-body">
            <div class="col-sm-12" style="padding: .2em ;">
                <div class="input-group">
                    <div class="input-group-addon primary-color"><i class="fa fa-clock-o fa-fw"></i> Periode Laporan</div>
                    <select class="form-control" id="dynamic_select2">
                        @if($data->deleted_at != null)
                            <?php $selected_date = new Date($data->periode); ?>
                            <option selected="">{{ $selected_date->format('F Y') }}</option>
                        @endif
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
            <li class="active"><a href="#tab_diskusi" data-toggle="tab">Diskusi
                @if(!empty($datas2) && count($datas2) > 0 )
                    <small><span class="label label-primary">{{ count($datas2 ) }}</span></small>
                @endif
            </a></li>
            <li><a href="#tab_revisi" data-toggle="tab">Revisi
                @if(!empty($datahistories) && count($datahistories) > 0 )
                    <small><span class="label label-primary" >{{ count($datahistories ) }}</span></small>
                @endif
            </a></li>
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
                                        @if(!empty($data2->user->gambar) && is_file($imagepath.$data2->user->gambar.".jpg"))
                                                <img src="{!! asset($imagepath.$data2->user->gambar.".jpg") !!}" alt="user image" class="online" />
                                        @else
                                                <img src="{!! asset($imagepath."user.jpg") !!}" alt="user image" class="online" />
                                        @endif
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
                                            <span style="font-size: larger;">{{ $data2->user->name }}</span>
                                          </span>
                                          <br/><br/>
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
                        {{ Form::model($datas2,array('route' => array('admins.'.$kelas2.'.store'),'method' => 'post','data-toggle' => 'validator','role' => 'form')) }}
                            <input type="text" name="id_laporan" value="{{ $data->id }}" hidden>
                            <input type="text" name="route" value="{{ Request::path() }}" hidden>
                            <input type="text" name="no_ba" value="{{ $data->no_ba }}" hidden>
                            <textarea id="summernote" name="content"></textarea>
                            <div class="input-group-btn">
                              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-send"></i></button>
                          </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_revisi">
                @if(!empty($datahistories) && count($datahistories) > 0 )
                    @foreach($datahistories as $datahistory)
                        <div class="well well-sm">
                            <?php 
                                  $user = App\User::find($datahistory->user_id);
                                  $cuprimer = App\Cuprimer::where('no_ba',$user->cu)->first();
                                  $date = new Date($datahistory->created_at); 
                              ?>
                            <i class="fa fa-caret-right text-muted"></i><b> {{ $user->name }} -
                            @if($user->cu > 0)
                                {{ $cuprimer->name }}
                            @else
                                BKCU
                            @endif
                            </b> telah mengubah nilai 
                            <b>[
                            <?php
                                switch($datahistory->key){
                                    case "l_biasa":
                                        echo "Anggota Lelaki Biasa";
                                        break;
                                    case "l_lbiasa":
                                        echo "Anggota Lelaki Luar Biasa";
                                        break;
                                    case "p_biasa":
                                        echo "Anggota Perempuan Biasa";
                                        break;
                                    case "p_lbiasa":
                                        echo "Anggota Perempuan Luar Biasa";
                                        break;
                                    case "totalanggota_lalu":
                                        echo "Total Anggota Tahun Lalu";
                                        break;
                                    case "aset":
                                        echo "Aset";
                                        break;
                                    case "aset_lalu":
                                        echo "Aset Tahun Lalu";
                                        break;
                                    case "aset_masalah":
                                        echo "Aset Masalah";
                                        break;
                                    case "aset_tidak_menghasilkan":
                                        echo "Aset Tidak Menghasilkan";
                                        break;
                                    case "aset_likuid_tidak_menghasilkan":
                                        echo "Aset Likuid Tidak Menghasilkan";
                                        break;
                                    case "aktivalancar":
                                        echo "Aktiva Lancar";
                                        break;
                                    case "simpanansaham":
                                        echo "Simpanan Saham";
                                        break;
                                    case "simpanansaham_lalu":
                                        echo "Simpanan Saham Tahun Lalu";
                                        break;
                                    case "simpanansaham_des":
                                        echo "Simpanan Saham Tahun Lalu Bulan Desember";
                                        break;
                                    case "nonsaham_unggulan":
                                        echo "Simpanan Non Saham Unggulan";
                                        break;
                                    case "nonsaham_harian":
                                        echo "Simpanan Non Saham Harian";
                                        break;
                                    case "hutangspd":
                                        echo "Hutang SPD";
                                        break;
                                    case "hutang_tidak_berbiaya_30hari":
                                        echo "Hutang Tidak Berbiaya Lebih Dari 30 Hari";
                                        break;
                                    case "piutangberedar":
                                        echo "Piutang Beredar";
                                        break;
                                    case "piutanganggota":
                                        echo "Piutang Anggota";
                                        break;
                                    case "piutanglalai_1bulan":
                                        echo "Piutang Lalai 1-12 Bulan";
                                        break;
                                    case "piutanglalai_12bulan":
                                        echo "Piutang Lalai > 12 Bulan";
                                        break;
                                    case "dcr":
                                        echo "DCR";
                                        break;
                                    case "dcu":
                                        echo "DCU";
                                        break;
                                    case "totalhutang_pihak3":
                                        echo "Total Hutang Pihak Ke-3";
                                        break;
                                    case "iuran_gedung":
                                        echo "Iuran Gedung";
                                        break;
                                    case "donasi":
                                        echo "Donasi";
                                        break;
                                    case "bjs_saham":
                                        echo "BJS Saham";
                                        break;
                                    case "beban_penyisihandcr":
                                        echo "Beban Penyisihan DCR";
                                        break;
                                    case "investasi_likuid":
                                        echo "Investasi Likuid";
                                        break;
                                    case "totalpendapatan":
                                        echo "Total Pendapatan";
                                        break;
                                    case "totalbiaya":
                                        echo "Total Biaya";
                                        break;
                                    case "shu":
                                        echo "SHU";
                                        break;
                                    case "shu_lalu":
                                        echo "SHU Tahun Lalu";
                                        break;
                                    case "lajuinflasi":
                                        echo "Laju Inflasi";
                                        break;
                                    case "hargapasar":
                                        echo "Harga Pasar";
                                        break;
                                }
                            ?>
                            ]</b>   
                            dari <b>[{{ number_format($datahistory->old_value,"0",",",".") }}]</b> menjadi <b>[{{ number_format($datahistory->new_value,"0",",",".") }}]</b> pada <small class="text-muted">{{ $date->format('d F') }} - {{ $date->format('H:i') }}</small>
                        </div>
                    @endforeach
                @else
                    <div class="well well-sm">
                        Tidak terdapat revisi.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--content-->
</section>
<div class="modal fade" id="modalpulih" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($data,array('route' => array('admins.'.$kelas.'.restore'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-check"></i> Pulihkan Laporan</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="{{ $data->id }}" id="modalpulih_id" hidden>
                <h4>Memulihkan laporan ini?</h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Pulihkan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas2.'.update',$kelas2), 'method' => 'put','data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-pencil"></i> Ubah Diskusi</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalubah_id" hidden>
                <input type="text" name="route" value="{{ Request::path() }}" hidden>
                <input type="text" name="no_ba" value="{{ $data->no_ba }}" hidden>
                <div class="form-group">
                    <h4>Mengubah diskusi</h4>
                    <textarea name="content" id="modalubah_content"></textarea>
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
    {{ Form::model($datas2,array('route' => array('admins.'.$kelas2.'.destroy',$kelas2), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash fa-fw"></i> Hapus Diskusi</h4>
            </div>
            <div class="modal-body">
                <h4 style="font-size: 16px" id="modalhapus_detail">Hapus Diskusi</h4>
                <input type="text" name="id" value="" id="modalhapus_id" hidden>
                <input type="text" name="route" value="{{ Request::path() }}" hidden>
                <input type="text" name="no_ba" value="{{ $data->no_ba }}" hidden>
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
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-cleaner.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#summernote').summernote({
            minHeight: 300,
            dialogsFade: true,
            placeholder: 'Silahkan isi disini...',
            cleaner:{
                notTime:2400, // Time to display Notifications.
                action:'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline:'<br>', // Summernote's default is to use '<p><br></p>'
                notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
                icon:'<i class="note-icon">Clean Word Format</i>'
            },
            toolbar: [
                ['cleaner',['cleaner']],
                ['para',['style']],
                ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
                ['font', ['strikethrough', 'superscript', 'subscript','clear']],
                ['fontsize', ['fontname','fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol']],
                ['paragraph',['paragraph']],
                ['table',['table']],
                ['height', ['height']],
                ['misc',['fullscreen']],
                ['misc2',['undo','redo']]
            ]
        });
        $('#modalubah_content').summernote({
            minHeight: 300,
            dialogsFade: true,
            placeholder: 'Silahkan isi disini...',
            cleaner:{
                notTime:2400, // Time to display Notifications.
                action:'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline:'<br>', // Summernote's default is to use '<p><br></p>'
                notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
                icon:'<i class="note-icon">Clean Word Format</i>'
            },
            toolbar: [
                ['cleaner',['cleaner']],
                ['para',['style']],
                ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
                ['font', ['strikethrough', 'superscript', 'subscript','clear']],
                ['fontsize', ['fontname','fontsize']],
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
         $('#modalubah_content').summernote('code',content);
    });     
</script>
@stop

@stop

