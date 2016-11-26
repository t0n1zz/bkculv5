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
                    <div class="help-block">Ukuran maksimum file gambar adalah {!! $file_max. ' ' .$file_max_meassure_unit !!}.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama cu',
                            'required','min-length' => '5','autocomplete'=>'off'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Nama CU harus diisi dan minimal 5 karakter.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>No. BA</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::number('no_ba',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor anggota',
                            'onKeyPress' => 'return isNumberKey(event)','required','autocomplete'=>'off'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">No. BA harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Wilayah</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" onChange="changeFunc(value);" name="wilayah" required>
                            <option hidden>Silahkan pilih Wilayah</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->id }}"
                                @if(!empty($data->wilayah))
                                    @if($data->wilayah == $data2->id)
                                        {!! "selected" !!}
                                            @endif
                                        @endif
                                >{{ $data2->name }}</option>
                            @endforeach
                            
                            @permission('create.wilayahcuprimer_create')
                                <option disabled>--------------</option> 
                                <option value="tambah">Tambah Wilayah Baru</option>
                            @endpermission 
                        </select>
                    </div>
                    <div class="help-block">Wilayah harus dipilih.</div>
                </div>
            </div>
            @permission('create.wilayahcuprimer_create')
            <div class="row" id="pilihan" style="display:none;">
                <div class="col-sm-12" >
                    <div class="form-group">
                        <h4>Wilayah Baru</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('wilayah_baru',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan wilayah baru',
                                'autocomplete'=>'off'))}}
                        </div>
                    </div>
                </div>
            </div>
            @endpermission 
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Badan Hukum</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('badan_hukum',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor badan hukum',
                            'autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Silahkan masukkan nomor badan hukum.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Telepon</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::number('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor telepon','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Silahkan masukkan nomor telepon.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Handphone</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::number('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor handphone','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Silahkan masukkan nomor handphone.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kode Pos</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::number('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos'))}}
                    </div>
                    <div class="help-block">Silahkan masukkan kode pos.</div>
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
                    <div class="help-block">Tanggal berdiri CU harud diisi.</div>
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
                    <div class="help-block">Tanggal bergabung CU harud diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Website</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('website',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat website'))}}
                    </div>
                    <div class="help-block">Silahkan masukkan alamat website.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>E-mail</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email','autocomplete'=>'off'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Silahkan masukkan alamat email.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Aplikasi Komputerisasi</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('app',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama aplikasi komputerisasi keuangan',
                            'autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Silahkan masukkan nama aplikasi komputerisasi keuangan.</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Alamat Kantor Pusat</h4>
                    {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan alamat')) }}
                    <div class="help-block">Silahkan masukkan alamat.</div>
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
