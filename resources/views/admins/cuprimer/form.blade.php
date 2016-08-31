<?php
$imagepath ='images_cu/';
$kelas ='cuprimer';
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
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Foto CU</h4>
                    <div class="thumbnail" >
                        @if(!empty($data->gambar))
                            {{ Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                        @else
                            {{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                        @endif
                        <div class="caption">
                            {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                        </div>
                    </div>
                    <div class="well well-sm">
                        Ukuran maksimum file gambar adalah {!! $file_max. ' ' .$file_max_meassure_unit !!}
                    </div>
                </div>
                {{ $errors->first('gambar', '<p class="text-warning">:message</p>') }}
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama cu',
                            'required','min-length' => '5','data-error' => 'Nama wajib diisi dan minimal 5 karakter','autocomplete'=>'off'))}}
                        <div class="help-block with-errors"></div>
                        {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. BA</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('no_ba',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor anggota',
                            'onKeyPress' => 'return isNumberKey(event)','data-error' => 'No. Anggota wajib diisi',
                            'autocomplete'=>'off'))}}
                        <div class="help-block with-errors"></div>
                        {!! $errors->first('no_ba', '<p class="text-warning">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Wilayah</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" onChange="changeFunc(value);" name="wilayah">
                            <option value="" selected disabled>Silahkan pilih Wilayah</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->id }}"
                                @if(!empty($data->wilayah))
                                    @if($data->wilayah == $data2->id)
                                        {!! "selected" !!}
                                            @endif
                                        @endif
                                >{{ $data2->name }}</option>
                            @endforeach
                            <option value="tambah" >Tambah Wilayah Baru</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="pilihan" style="display:none;">
                <div class="col-sm-12" >
                    <div class="form-group">
                        <h4>Wilayah Baru</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                            {{ Form::text('wilayah_baru',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan wilayah baru',
                                'autocomplete'=>'off'))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Badan Hukum</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('badan_hukum',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor badan hukum',
                            'autocomplete'=>'off'))}}
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Telepon</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor telepon',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Handphone</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor handphone',
                                'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kode Pos</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos',
                                'onKeyPress' => 'return isNumberKey(event)'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tanggal Berdiri</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->ultah)){
                            $timestamp = strtotime($data->ultah);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="ultah" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tanggal Bergabung</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->bergabung)){
                            $timestamp = strtotime($data->bergabung);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="bergabung" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Website</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('website',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat website',
                            'autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>E-mail</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email',
                            'data-error' => 'Alamat email anda salah','autocomplete'=>'off'))}}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Aplikasi Komputerisasi</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('app',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama aplikasi komputerisasi',
                            'autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Alamat Kantor Pusat</h4>
                    {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan alamat')) }}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan">
            <i class="fa fa-save"></i> <u>S</u>impan</button>
        <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" value="simpan">
            <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
        <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger" value="batal">
            <i class="fa fa-times"></i> <u>B</u>atal</a>
    </div>
</div>
