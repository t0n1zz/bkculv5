<?php
$kelas ='download';
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
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger"">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <!--nama-->
            <div class="col-lg-10">
                <h4>Nama File</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama file',
                        'required','min-length' => '5','max-length' => '100',
                        'data-error' => 'Nama wajib diisi dan minimal 5 karakter dengan maksimal 100 karakter',
                        'autocomplete'=>'off'))}}
                </div>
                <div class="help-block with-errors"></div>
                {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
            </div>
            <!--/nama-->
            <!--upload-->
            <div class="col-lg-5">
                <h4>Upload File</h4>
                {{ Form::file('upload') }}
            </div>
            <!--/upload-->
        </div>
    </div>
</div>

