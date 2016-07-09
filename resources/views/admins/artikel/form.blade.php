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
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-header with-border">
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
    <div class="box-body">
        <div class="row">
            <!--judul-->
            <div class="col-sm-8">
                <div class="form-group">
                    <h4>Judul Artikel *</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('judul',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan judul artikel',
                            'required','min-length' => '5','data-error' => 'Judul wajib diisi dan minimal 5 karakter',
                            'autocomplete'=>'off')) }}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('judul', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <!--/judul-->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Penulis Artikel</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('penulis',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama penulis artikel','autocomplete'=>'off')) }}
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <!--kategori-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kategori Artikel *</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" onChange="changeFunc(value);" name="kategori">
                            <option value="" selected disabled>Silahkan pilih kategori artikel</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->id }}"
                                @if(!empty($data))
                                    @if($data->kategori == $data2->id)
                                        {!! "selected" !!}
                                            @endif
                                        @endif
                                        >{!! $data2->name !!}</option>
                            @endforeach
                            <option value="tambah" >Tambah Kategori Baru</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--/kategori-->
            <!--status-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Terbitkan Artikel</h4>
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
                </div>
            </div>
            <!--/status-->
            <!--kategori baru-->
            <div class="row" id="pilihan" style="display: none;">
                <div class="col-sm-6">
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
                    <div class="well well-sm">
                        Ukuran maksimum file gambar adalah {!! $file_max. ' ' .$file_max_meassure_unit !!}
                    </div>
                    {!! $errors->first('gambar', '<p class="text-warning">:message</p>') !!}
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
                </div>
            </div>
            <!--/artikel pilihan-->
            <!--content-->
            <div class="col-sm-12">
                <h4>Isi Artikel *</h4>
                <textarea id="editor" name="content"
                    >@if(!empty($data->content)){{ $data->content }}@endif</textarea>
                {!! $errors->first('content', '<p class="text-warning">:message</p>') !!}
            </div>
            <!--/content-->
            <div class="col-lg-12">
                <hr />
                <div class="well well-sm">
                    * : Wajib untuk diisi.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content -->
