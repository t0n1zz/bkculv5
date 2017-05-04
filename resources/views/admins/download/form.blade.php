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
{{-- tombol --}}
@include('admins._components.tombol')
{{-- tombol --}}
<div class="box box-primary">
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
{{-- tombol --}}
@include('admins._components.tombol')
{{-- tombol --}}
