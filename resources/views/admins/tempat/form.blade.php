<?php
$imagepath ='images_tempat/';
$kelas ='tempat';
$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
?>
<div class="row">
    <div class="col-sm-12">
        <h4>Foto</h4>
        <div class="thumbnail">
            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                {{ Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
            @else
                {{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
            @endif
            <div class="caption">
                {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
            </div>
        </div>
    </div>
    <!--judul-->
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>Name</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama tempat','autocomplete'=>'off','required')) }}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Nama tempat harus diisi.</div>
        </div>
    </div>
    <!--/judul-->
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>Kota</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('kota',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kota','autocomplete'=>'off','required')) }}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Kota harus diisi.</div>
        </div>
    </div>
    <!--/artikel pilihan-->
    <!--content-->
    <div class="col-sm-12">
        <h4>Keterangan *</h4>
        {{ Form::textarea('keterangan',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan keterangan berupa penjelasan tempat')) }}
    </div>
    <!--/content-->
</div>