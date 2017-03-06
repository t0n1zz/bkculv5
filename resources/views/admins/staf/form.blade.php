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
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!--nama-->
            <div class="col-lg-6">
                <div class="form-group">
                    <h4>No. Identitas</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('noid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                            'required','data-error' => 'Nomor identitas wajib di isi',
                            'autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                </div>
                <div class="form-group">
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staff',
                            'required','data-error' => 'Nama staf wajib diisi',
                            'autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                </div>
                <div class="row" id="pilihan" style="display: none;">
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
                <div class="form-group">
                    <h4>Gender</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="kelamin">
                            <option selected disabled>Silahkan pilih jenis kelamin</option>
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
                    {{ $errors->first('kelamin', '<p class="text-warning">:message</p>') }}
                </div>
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
                                <input type="text" name="bergabung" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                       data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h4>Agama</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="agama">
                            <option selected disabled>Silahkan pilih agama</option>
                            <option value="Khatolik"
                            @if(!empty($data))
                                @if($data->agama == "Khatolik")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Khatolik</option>
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
                <div class="form-group">
                    <h4>Status Pernikahan</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="status">
                            <option selected disabled>Silahkan pilih jenis status</option>
                            <option value="Menikah"
                            @if(!empty($data))
                                @if($data->status == "Menikah")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Menikah</option>
                            <option value="Belum Menikah"
                            @if(!empty($data))
                                @if($data->status == "Belum Menikah")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Belum Menikah</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Kontak</h4>
                    {{ Form::textarea('kontak',null,array('class' => 'form-control','rows' => '3')) }}
                </div>
            </div>
            <!--/nama-->
            <!--gambar-->
            <div class="col-lg-6">
                <div>
                    <h4>Foto</h4>
                    <div class="thumbnail" >
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
                <div class="form-group">
                    <h4>Alamat</h4>
                    {{ Form::textarea('content',null,array('class' => 'form-control','rows' => '3')) }}
                </div>
            </div>

            <div class="col-sm-12"><hr/></div>
        </div>
    </div>
    <div class="box-footer with-border">
        <div class="form-group">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
</div>