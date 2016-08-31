<?php
$title = "Detail Kegiatan";
$kelas = "kegiatan";
?>
@extends('admins._layouts.layout')

@section('css')
@include('admins._components.datatable_CSS')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select/dist/css/select2.min.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select/dist/css/select2-bootstrap.min.css')}}" >
@stop

@section('content')

<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ $title }}
        <small>Informasi Detail Kegiatan </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('admins/kegiatan') }}"><i class="fa fa-calendar"></i> Kegiatan</a></li>
        <li class="active"><i class="fa fa-database"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h2 class="profile-username text-center">{{ $data->name }}</h2>
                    @if(!empty($data->wilayah))
                        <p class="text-muted text-center">{{ $data->wilayah }}</p>
                    @else
                        <p class="text-muted text-center">-</p>
                    @endif

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            @if(!empty($data->tanggal))
                                <?php $date = new Date($data->tanggal); ?>
                                <b>Tanggal Mulai</b> <a class="pull-right">{{  $date->format('d-n-Y') }}</a>
                            @else
                                <b>Tanggal Mulai</b> <a class="pull-right">-</a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            @if(!empty($data->tanggal))
                                <?php $date2 = new Date($data->tanggal2); ?>
                                <b>Tanggal Selesai</b> <a class="pull-right">{{  $date2->format('d-n-Y') }}</a>
                            @else
                                <b>Tanggal Selesai</b> <a class="pull-right">-</a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Periode Kegiatan</b> <a class="pull-right">2016</a>
                        </li>
                    </ul>
                    @if($data->status == "0")
                        <a href="#" class="btn btn-default btn-block"><b><i class="fa fa-ban"></i> Belum Dilaksanakan</b></a>
                    @else
                        <a href="#" class="btn btn-warning btn-block"><b><i class="fa fa-check"></i> Sudah Terlaksana</b></a>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>44</h3>

                    <p>Peserta Terdaftar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#2" data-toggle="tab" class="small-box-footer">
                    Detail <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-map-marker margin-r-5"></i> Tempat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong></strong>
                    <p class="text-muted">{{ $data->tempat }}</p>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#1" data-toggle="tab">Tujuan & Pokok Bahasan</a></li>
                    <li><a href="#2" data-toggle="tab">Peserta, Fasilitator & Panitia</a></li>
                    <li><a href="#3" data-toggle="tab">Biaya</a></li>
                    <li><a href="#4" data-toggle="tab">Evaluasi & Saran</a></li>
                </ul>
                <div class="tab-content">
                    <div class="fade in active tab-pane" id="1">
                        <div class="post">
                            <h3>Tujuan
                                <small>
                                    @if(!empty($data->tujuan))
                                        <a href="#" id="edittujuan" onclick="edit_tujuan()"><i class="fa fa-pencil-square-o"></i></a>
                                    @else
                                        <a href="#" style="display: none" id="edittujuan2" onclick="edit_tujuan2()"><i class="fa fa-pencil-square-o"></i></a>
                                    @endif
                                </small>
                            </h3>
                            <form id="tujuan" action="#">
                            @if(!empty($data->tujuan))
                                <div class="texttujuan">
                                    {!! $data->tujuan !!}
                                </div>
                                <button id="savetujuan" data-loading-text="Menyimpan..." style="display: none" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Simpan</button>
                                <button id="bataltujuan" style="display: none" onclick="batal_tujuan()" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Batal</button>
                            @else
                                <div class="texttujuan2"></div>
                                <button id="savetujuan2" style="display: inline" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Simpan</button>
                                <button id="bataltujuan2" style="display: none" onclick="batal_tujuan()" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Batal</button>
                            @endif
                            </form>
                        </div>
                        <div class="post">
                            <h3>Pokok Bahasan
                                <small>
                                    @if(!empty($data->pokok))
                                        <a href="#" id="editpokok" onclick="edit_pokok()"><i class="fa fa-pencil-square-o"></i></a>
                                    @else
                                        <a href="#" style="display: none" id="editpokok2" onclick="edit_pokok2()"><i class="fa fa-pencil-square-o"></i></a>
                                    @endif
                                </small>
                            </h3>
                            <form id="pokok" action="#">
                                @if(!empty($data->pokok))
                                    <div class="textpokok">
                                        {!! $data->pokok !!}
                                    </div>
                                    <button id="savepokok" style="display: none" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Simpan</button>
                                    <button id="batalpokok" style="display: none" onclick="batal_pokok()" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Batal</button>
                                @else
                                    <div class="textpokok2"></div>
                                    <button id="savepokok2" style="display: inline" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Simpan</button>
                                    <button id="batalpokok2" style="display: none" onclick="batal_pokok2()" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Batal</button>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="fade tab-pane" id="2">
                        <div class="post">
                            <h3>Fasilitator & Panitia</h3>
                            <table class="table table-striped table-hover" id="datatablepanitia">
                                <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tugas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datapanitia as $data)
                                    <tr>
                                        <td hidden>{{ $data->id }}</td>
                                        @if(!empty($data->staf->nama))<td>{{ $data->staf->nama }}</td>@else<td>-</td>@endif
                                        @if(!empty($data->staf->kelamin))<td>{{ $data->staf->kelamin }}</td>@else<td>-</td>@endif
                                        @if(!empty($data->tugas))<td>{{ $data->tugas }}</td>@else<td>-</td>@endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="post">
                            <h3>Peserta</h3>
                            <table class="table table-striped table-hover dataTables" >
                                <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal CU</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datapeserta as $data)
                                    <tr>
                                        <td hidden>{{ $data->id }}</td>
                                        @if(!empty($data->staf->nama))<td>{{ $data->staf->nama }}</td>@else<td>-</td>@endif
                                        @if(!empty($data->staf->kelamin))<td>{{ $data->staf->kelamin }}</td>@else<td>-</td>@endif
                                        @if(!empty($data->staf->cu))<td>{{ $data->staf->cu }}</td>@else<td>-</td>@endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="fade tab-pane" id="3">
                    </div>
                    <!-- /.tab-pane -->
                    <div class="fade tab-pane" id="4">
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
</section>
<div class="clearfix"></div>
<div class="modal modal-wide fade" id="modal2show"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="pokok" action="#">
    <div class="modal-dialog">
        <div class="modal-content large">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 clasas="modal-title"><i class="fa fa-plus"></i> Tambah Fasilitator atau Panitia</h4>
            </div>
            <div class="modal-body">
                <h4>Fasilitator atau Panitia</h4>
                <input type="text" name="id" value="" id="modal2id" hidden>
                <select class="form-control select2" name="fasilitator" id="selectdata" style="width: 100%">
                    <option disabled selected>Pilih fasilitator atau panitia</option>
                </select>
                <h4>Tugas</h4>
                <select class="form-control" name="tugas">
                    <option value="1">Fasilitator</option>
                    <option value="2">Co-Fasilitator</option>
                    <option value="3">Trainee</option>
                    <option value="4">Panitia</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Iya</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div>
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 clasas="modal-title"><i class="fa fa-trash"></i> Hapus Fasilitator Atau Panitia</h4>
            </div>
            <div class="modal-body">
                <strong>Menghapus fasilitator atau panitia ini ?</strong>
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
@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/select/dist/js/select2.full.min.js') }}"></script>
<script>
    // tujuan1
    var edit_tujuan = function () {
        $('.texttujuan').summernote({
            focus:true,
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        document.getElementById('bataltujuan').style.display='inline';
        document.getElementById('savetujuan').style.display='inline';
        document.getElementById('edittujuan').style.display='none';
    };
    var batal_tujuan = function(){
        $('.texttujuan').summernote('destroy');
        document.getElementById('bataltujuan').style.display='none';
        document.getElementById('savetujuan').style.display='none';
        document.getElementById('edittujuan').style.display='inline';
    };
    $("#savetujuan").click(function (e) {
        var $btn = $(this).button('loading');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var id= "{{ $data->id }}";
        var markup = $('.texttujuan').summernote('code');
        var datastring ={
            id: id,
            markup: markup
        };

        $.ajax({
            type: "POST",
            url: "/admins/kegiatan/update_tujuan" ,
            data: datastring,
            dataType:'json',
            success: function(response){
                console.log(response);
            }
        });

        $btn.button('reset');
        $('.texttujuan').summernote('destroy');
        document.getElementById('bataltujuan').style.display='none';
        document.getElementById('savetujuan').style.display='none';
        document.getElementById('edittujuan').style.display='inline';
    });
    //tujuan2
    $('.texttujuan2').summernote({
        placeholder:'Silahkan paparkan tujuan dilaksanakannya kegiatan ini...',
        minHeight: 100,
        toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol']]
        ],
        callbacks: {
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        }
    });
    var edit_tujuan2 = function () {
        $('.texttujuan2').summernote({
            focus:true,
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        document.getElementById('bataltujuan2').style.display='inline';
        document.getElementById('savetujuan2').style.display='inline';
        document.getElementById('edittujuan2').style.display='none';
    };
    var batal_tujuan2 = function(){
        $('.texttujuan2').summernote('destroy');
        document.getElementById('bataltujuan2').style.display='none';
        document.getElementById('savetujuan2').style.display='none';
        document.getElementById('edittujuan2').style.display='inline';
    };
    $("#savetujuan2").click(function (e) {
        var $btn = $(this).button('loading');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var id= "{{ $data->id }}";
        var markup = $('.texttujuan2').summernote('code');
        var datastring ={
            id: id,
            markup: markup
        };

        $.ajax({
            type: "POST",
            url: "/admins/kegiatan/update_tujuan" ,
            data: datastring,
            dataType:'json',
            success: function(response){
                console.log(response);
            }
        });

        $btn.button('reset');
        $('.texttujuan2').summernote('destroy');
        document.getElementById('bataltujuan2').style.display='none';
        document.getElementById('savetujuan2').style.display='none';
        document.getElementById('edittujuan2').style.display='inline';
    });
    // pokok1
    var edit_pokok = function () {
        $('.textpokok').summernote({
            focus:true,
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        document.getElementById('batalpokok').style.display='inline';
        document.getElementById('savepokok').style.display='inline';
        document.getElementById('editpokok').style.display='none';
    };
    var batal_pokok = function(){
        $('.textpokok').summernote('destroy');
        document.getElementById('batalpokok').style.display='none';
        document.getElementById('savepokok').style.display='none';
        document.getElementById('editpokok').style.display='inline';
    };
    $("#savepokok").click(function (e) {
        var $btn = $(this).button('loading');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();

        var id= "{{ $data->id }}";
        var markup = $('.textpokok').summernote('code');
        var datastring ={
            id: id,
            markup: markup
        };

        $.ajax({
            type: "POST",
            url: "/admins/kegiatan/update_pokok" ,
            data: datastring,
            dataType:'json',
            success: function(response){
                console.log(response);
            }
        });

        $btn.button('reset');
        $('.textpokok').summernote('destroy');
        document.getElementById('batalpokok').style.display='none';
        document.getElementById('savepokok').style.display='none';
        document.getElementById('editpokok').style.display='inline';
    });
    //pokok2
    $('.textpokok2').summernote({
        placeholder:'Silahkan paparkan pokok pembahasan kegiatan ini...',
        minHeight: 100,
        toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol']]
        ],
        callbacks: {
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        }
    });
    var edit_pokok2 = function () {
        $('.textpokok2').summernote({
            focus:true,
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        document.getElementById('batalpokok2').style.display='inline';
        document.getElementById('savepokok2').style.display='inline';
        document.getElementById('editpokok2').style.display='none';
    };
    var batal_pokok2 = function(){
        $('.textpokok2').summernote('destroy');
        document.getElementById('batalpokok2').style.display='none';
        document.getElementById('savepokok2').style.display='none';
        document.getElementById('editpokok2').style.display='inline';
    };
    $("#savepokok2").click(function (e) {
        var $btn = $(this).button('loading');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();

        var id= "{{ $data->id }}";
        var markup = $('.textpokok2').summernote('code');
        var datastring ={
            id: id,
            markup: markup
        };

        $.ajax({
            type: "POST",
            url: "/admins/kegiatan/update_pokok" ,
            data: datastring,
            dataType:'json',
            success: function(response){
                console.log(response);
            }
        });
        $btn.button('reset');
        $('.textpokok2').summernote('destroy');
        document.getElementById('batalpokok2').style.display='none';
        document.getElementById('savepokok2').style.display='none';
        document.getElementById('editpokok2').style.display='inline';
    });
    //select fasilitator
    $('#selectdata').select2({
        theme: "bootstrap",
        ajax: {
            url: "/admins/kegiatan/getselect2",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return{
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function (data,params) {
                params.page = params.page || 1;
                return{
                    results: data,
                    pagination:{
                        more: (params.page * 30) < data.total_count
                    }
                };

            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 1,
        placeholder: function(){
            $(this).data('placeholder');
        },
        templateResult: formatTemplate,
        templateSelection: selectionTemplate
    });

    function formatTemplate(data) {
        if(data.loading) return data.text;

        var markup = "<div class='media'>";

        if(data.gambar) {
            markup += "<div class='media-left'><img class='media-object'  width='50px'  src=/images_staf/'" + data.gambar + "' /></div>";
        }else{
            if(data.kelamin = "Pria"){
                markup += "<div class='media-left'><img class='media-object' width='50px' src='/images/no_image_man.jpg' /></div>";
            }else{
                markup += "<div class='media-left'><img class='media-object' width='50px'   src='/images/no_image_woman.jpg' /></div>";
            }
        }
        markup += "<div class='media-body'><b style='font-size: medium'>" + data.name + "</b> <br/>";

        if(data.cu == '0'){
            markup += "<small ><i class='fa fa-building'></i> PUSKOPDIT BKCU KALIMANTAN</small>" ;
        }else{
            markup += "<small ><i class='fa fa-building'></i> CU " + data.cuprimer.name + "</small>";
        }

        markup += "</div></div>";

        console.log(data);
        return markup;

    }

    function selectionTemplate(data) {
        return data.name || data.text; // I think its either text or label, not sure.
    }
    //table fasiliator dan panitia
    var table = $('#datatablepanitia').DataTable({
        dom: 'Bf',
        select: true,
        scrollY: '50vh',
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : true,
        order : [[ 1, "asc" ]],
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Tambah',
                action: function () {
                    $('#modal2show').modal({show:true});
                    $('#modal2id').attr('value',"{{ $data->id }}");
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> Ubah',
                action: function () {
                    var id = $.map(table.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modal2show').modal({show:true});
                        $('#modal2id').attr('value',id);
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> Hapus',
                action: function () {
                    var id = $.map(table.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
                    if(id != ""){
                        $('#modal1show').modal({show:true});
                        $('#modal1id').attr('value',id);
                    }
                }
            }
        ],
        language: {
            buttons : {
                colvis: "<i class='fa fa-columns'></i> Kolom",
            },
            select:{
                rows:{
                    _: "",
                    0: "",
                    1: ""
                }
            },
            "emptyTable": "Tidak terdapat data di tabel",
            "info": "",
            "infoEmpty": "",
            "infoFiltered":   "",
            "search": "<i class='fa fa-search'></i> Cari:",
            "paginate": {
                "next":       ">",
                "previous":   "<"
            },
            "zeroRecords": "Tidak ditemukan data yang sesuai",
        }
    });

</script>
@stop