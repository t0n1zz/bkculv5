<?php
$kelas ='kegiatan';
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<div class="box box-primary">
    <div class="box-header with-border">
        <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan"><i
                    class="fa fa-save"></i> <u>S</u>impan</button>
        <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary"
                value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
        <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger"
           value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <h4>Nama Kegiatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kegiatan',
                          'required','min-length' => '5','data-error' => 'Nama kegiatan wajib diisi dan minimal 5 karakter'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                    <h4>Tanggal Kegiatan Dimulai</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->tanggal)){
                            $timestamp = strtotime($data->tanggal);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="tanggal" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                    {!! $errors->first('tanggal', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                    <h4>Tanggal Kegiatan Selesai</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->tanggal2)){
                            $timestamp = strtotime($data->tanggal2);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="tanggal2" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                    {!! $errors->first('tanggal2', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <h4>Wilayah / District Office</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="wilayah" required data-error="Wilayah wajib dipilih">
                            <option value="" selected disabled>Silahkan pilih wilayah pelatihan</option>
                            <option value="Barat"
                            @if(!empty($data))
                                @if($data->wilayah == "Barat")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                                    >Barat</option>
                            <option value="Tengah"
                            @if(!empty($data))
                                @if($data->wilayah == "Tengah")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                                    >Tengah</option>
                            <option value="Timur"
                            @if(!empty($data))
                                @if($data->wilayah == "Timur")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                                    >Timur</option>
                            <option value="Bersama"
                            @if(!empty($data))
                                @if($data->wilayah == "Bersama")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                                    >Bersama</option>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('wilayah', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <h4>Tempat</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('tempat',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan tempat kegiatan',
                          'required','data-error' => 'Tempat wajib diisi','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('tempat', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <h4>Sasaran</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('sasaran',null,array('class' => 'form-control','placeholder' => 'Silahkan masukkan sasaran kegiatan',
                          'required','data-error' => 'Sasaran wajib diisi','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('sasaran', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <h4>Fasilitator</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('fasilitator',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama fasilitator',
                          'autocomplete'=>'off'))}}
                    </div>
                    {!! $errors->first('fasilitator', '<p class="text-warning"><i>:message</i></p>') !!}
                </div>
            </div>
        </div>
    </div>
</div>