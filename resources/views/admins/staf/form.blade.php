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
        @include('admins.staf._components.form')
    </div>
    @if(!Request::is('admins/staf/create')) 
    <div class="box-footer with-border">
        <div class="form-group" style="margin-bottom: 0px;">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
    @endif
</div>

@if(Request::is('admins/staf/create')) 
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
@endif


@section('js')
@include('admins.staf._components.formjs')
@stop