<?php
$imagepath ='images_staf';
$kelas ='staf';
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
{{-- identitias --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title ">Identitas</h3>
    </div>
    <div class="box-body">
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>No. Identitas</h4>
                            <div class="input-group">
                                <span class="input-group-addon">0-9</span>
                                {{ Form::text('nid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                                    'required','autocomplete'=>'off'))}}
                            </div>
                            <div class="help-block">No. Identitas harus diisi.</div>
                            {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Nama</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staf',
                                    'required','autocomplete'=>'off'))}}
                            </div>
                            <div class="help-block">Nama harus diisi.</div>
                            {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Tempat & Tanggal Lahir</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                        {{ Form::text('tempat_lahir',null,array('class' => 'form-control', 'placeholder' => 'Tempat'))}}
                                        {{ $errors->first('tempat_lahir', '<p class="text-warning">:message</p>') }}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <?php
                                        if(!empty($data->tanggal_lahir)){
                                            $timestamp = strtotime($data->tanggal_lahir);
                                            $tanggal = date('d/m/Y',$timestamp);
                                        }
                                        ?>
                                        <input type="text" name="tanggal_lahir" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <h4>Gender</h4>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                <select class="form-control" name="kelamin">
                                    <option selected disabled>Jenis kelamin</option>
                                    <option value="Pria"
                                    @if(!empty($data))
                                        @if($data->kelamin == "Pria")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                            >Pria</option>
                                    <option value="Wanita"
                                    @if(!empty($staff))
                                        @if($staff->kelamin == "Wanita")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                            >Wanita</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <h4>Agama</h4>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                <select class="form-control" name="agama">
                                    <option selected disabled>Agama</option>
                                    <option value="Khatolik"
                                    @if(!empty($data))
                                        @if($data->agama == "Khatolik")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                    >Katolik</option>
                                    <option value="Protestan"
                                    @if(!empty($data))
                                        @if($data->agama == "Protestan")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                    >Protestan</option>
                                    <option value="Kong Hu Cu"
                                    @if(!empty($data))
                                        @if($data->agama == "Kong Hu Cu")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                    >Kong Hu Cu</option>
                                    <option value="Buddha"
                                    @if(!empty($data))
                                        @if($data->agama == "Buddha")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                    >Buddha</option>
                                    <option value="Hindu"
                                    @if(!empty($data))
                                        @if($data->agama == "Hindu")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                    >Hindu</option>
                                    <option value="Islam"
                                    @if(!empty($data))
                                        @if($data->agama == "Islam")
                                            {{ "selected" }}
                                                @endif
                                            @endif
                                    >Islam</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Kontak</h4>
                            {{ Form::textarea('kontak',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan informasi kontak anda yang bisa dihubungi')) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Alamat</h4>
                            {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder' => 'Silahkan masukkan alamat tempat tinggal anda saat ini')) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- keluarga --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Keluarga</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama Ayah</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('nameayah',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama ayah','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama Ibu</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('nameibu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama ibu','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Status Pernikahan</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="status" onChange="func_selectstatus(value);">
                            <option selected disabled>Status</option>
                            <option value="Menikah"
                            @if(!empty($data))
                                @if($data->status == "1")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Menikah</option>
                            <option value="Belum Menikah"
                            @if(!empty($data))
                                @if($data->status == "2")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Belum Menikah</option>
                            <option value="Duda/Janda"
                            @if(!empty($data))
                                @if($data->status == "3")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Duda/Janda</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" id="pasangan" style="display: none;">
                <div class="form-group">
                    <h4>Nama Pasangan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('namepasangan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama pasangan','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12" id="anak" style="display: none;">
                <button type="button" class="btn btn-default btn-block" id="anaktambah" onclick="func_anaktambah()">Punya Anak</button>
            </div>
        </div> 
    </div>
</div>
{{-- keluarga --}}
{{-- keanggotaan --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Keanggotaan Di CU</h3>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" class="btn btn-default btn-block" id="cutambah" onclick="func_cutambah()">Punya keanggotaan di CU</button>
        </div>
    </div> 
    </div>
</div>
{{-- keanggotaan --}}
{{-- pekerjaan --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Pekerjaan</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.pekerjaan')
    </div>
</div>
{{-- pendidikan --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Pendidikan Terakhir</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.pendidikan')
    </div>
</div>
{{-- organisasi --}}
<div class="box box-solid">
    <div class="box-header bg-light-blue-active color-palette  with-border">
        <h3 class="box-title">Organisasi Yang Di ikuti</h3>
    </div>
    <div class="box-body">
        @include('admins.staf._components.organisasi')
    </div>
</div>
{{-- tombol --}}
<div class="box box-solid">
    <div class="box-body">
        <div class="form-group" style="margin-bottom: 0px;">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
</div>

@section('js')
@include('admins.staf._components.formjs')
@stop