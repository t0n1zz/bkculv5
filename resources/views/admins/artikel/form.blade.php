<?php
$imagepath ='images_artikel/';
$kelas ='artikel';
$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
?>
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!--judul-->
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Judul</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('judul',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan judul artikel',
                            'autocomplete'=>'off','required','data-minlength' => '5')) }}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Judul artikel harus diisi dan minimal 5 karakter.</div>
                </div>
            </div>
            <!--/judul-->
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Penulis</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('penulis',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama penulis artikel','autocomplete'=>'off','required')) }}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Penulis artikel harus diisi.</div>
                </div>
            </div>
            <!--kategori-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kategori</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" onChange="changeFunc(value);" name="kategori" required>
                            <option hidden>Silahkan pilih kategori artikel</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->id }}"
                                @if(!empty($data))
                                    @if($data->kategori == $data2->id)
                                        {!! "selected" !!}
                                            @endif
                                        @endif
                                        >{!! $data2->name !!}</option>
                            @endforeach
                            @permission('create.kategoriartikel_create')
                                <option disabled>--------------</option> 
                                <option value="tambah" >Tambah Kategori Baru</option>
                            @endpermission    
                        </select>
                    </div>
                    <div class="help-block">Kategori artikel harus dipilih.</div>
                </div>
            </div>
            <!--/kategori-->
            <!--status-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Terbitkan</h4>
                    <div class="input-group">
                        <span class="input-group-addon">
                            @if(!empty($data->pilihan))
                                {!! Form::checkbox('status','1',true,array('id' => 'terbitkanartikel')) !!}
                            @else
                                {!! Form::checkbox('status','1',false,array('id' => 'terbitkanartikel')) !!}
                            @endif
                        </span>
                        @if(!empty($data))
                            @if($data->status == 0)
                                {!! Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'statustext' ,'disabled' => 'true')) !!}
                            @else
                                {!! Form::text('null','Iya, artikel akan di terbitkan',array('class' => 'form-control', 'id' => 'statustext' ,
                                   'disabled' => 'true')) !!}
                            @endif
                        @else
                            {!! Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'statustext' ,'disabled' => 'true')) !!}
                        @endif
                    </div>
                    <div class="help-block">Silahkan pilih apabila ingin menerbitkan artikel.</div>
                </div>
            </div>
            <!--/status-->
            <!--kategori baru-->
            <div id="pilihan" style="display: none;">
                <div class="col-sm-12">
                    <div class="form-group">
                        <h4>Kategori Baru</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('kategori_baru',null,array('class' => 'form-control',
                                'placeholder' => 'Silahkan masukkan kategori baru',
                                'autocomplete'=>'off','maxlength' => '50'))}}
                        </div>
                    </div>
                </div>
            </div>
            <!--/kategori baru-->
            <!--gambar utama-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Gambar Utama</h4>
                    <div class="input-group">
                        <span class="input-group-addon">
                            @if(!empty($data->gambar))
                                {!! Form::checkbox('gambarutama','1',true,array('id' => 'tampilinputgambar')) !!}
                            @else
                                {!! Form::checkbox('gambarutama','1',false,array('id' => 'tampilinputgambar')) !!}
                            @endif
                        </span>
                        @if(!empty($data->gambar))
                            {!! Form::text('null','Iya, gambar akan muncul di list artikel dan view artikel',array('class' =>
                               'form-control', 'id' => 'gambartext' ,'disabled' => 'true')) !!}
                        @else
                            {!! Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'gambartext' ,'disabled' => 'true')) !!}
                        @endif
                    </div>
                    <div class="help-block">Silahkan pilih apabila ingin menampilkan gambar utama pada artikel.</div>
                </div>
                <div id="inputgambar"
                    @if(empty($data->gambar))
                        {!! "style='display:none;'" !!}
                    @endif >
                    <div class="thumbnail" >
                        @if(!empty($data->gambar))
                            {!! Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) !!}
                        @else
                            {!! Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) !!}
                        @endif
                        <div class="caption">
                            {!! Form::file('gambar', array('onChange' => 'readURL(this)','accept' => 'image/*')) !!}
                        </div>
                    </div>
                    <div class="help-block">Ukuran maksimum file gambar adalah {!! $file_max. ' ' .$file_max_meassure_unit !!}.</div>
                </div>
            </div>
            <!--/gambar utama-->
            <!--artikel pilihan-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Artikel Pilihan</h4>
                    <div class="input-group">
                        <span class="input-group-addon">
                            @if(!empty($data->pilihan))
                                {!! Form::checkbox('pilihan','1',true,array('id' => 'artikelpilihan')) !!}
                            @else
                                {!! Form::checkbox('pilihan','1',false,array('id' => 'artikelpilihan')) !!}
                            @endif
                        </span>
                        @if(!empty($data))
                            @if($data->pilihan == 0)
                                {!! Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'artikeltext' ,'disabled' => 'true')) !!}
                            @else
                                {!! Form::text('null','Iya, artikel akan muncul di slideshow',array('class' => 'form-control', 'id' => 'artikeltext' ,
                                   'disabled' => 'true')) !!}
                            @endif
                        @else
                            {!! Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'artikeltext' ,'disabled' => 'true')) !!}
                        @endif
                    </div>
                    <div class="help-block">Silahkan pilih apabila ingin menampilkan artikel pada slideshow.</div>
                </div>
            </div>
            <!--/artikel pilihan-->
            <!--content-->
            <div class="col-sm-12">
                <h4>Isi Artikel *</h4>
                <textarea id="summernote" name="content"
                    >@if(!empty($data->content)){{ $data->content }}@endif</textarea>
                {!! $errors->first('content', '<p class="text-warning">:message</p>') !!}
            </div>
            <!--/content-->
        </div>
    </div>
    <div class="box-footer with-border">
        <div class="form-group">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan">
                <i class="fa fa-save"></i> <u>S</u>impan
            </button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" value="simpan">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru
            </button>
            <a href="{{ route('admins.'.$kelas.'.index' )}}" name="batal" accesskey="b" class="btn btn-danger" value="batal">
                <i class="fa fa-times"></i> <u>B</u>atal
            </a>
        </div>
    </div>
</div>
<!-- content -->

@section('js')
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-ext-addclass.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-cleaner.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-floats-bs.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-image-attributes.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#summernote').summernote({
            minHeight: 300,
            maximumImageFileSize: 1242880,
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
            popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    /* ['float', ['floatLeft', 'floatRight', 'floatNone']], */
                    /* Those are the old regular float buttons */
                    ['floatBS', ['floatBSLeft', 'floatBSNone', 'floatBSRight']],
                    /* Those come from the BS plugin, in any order, you can even keep both! */
                    ['custom', ['imageAttributes', 'imageShape']],
                    ['remove', ['removeMedia']],
                ],
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
                ['insert',['link','picture','video']] ,
                ['misc',['fullscreen','codeview']],
                ['misc2',['undo','redo']]
            ]
        });
    });    
</script>
@stop