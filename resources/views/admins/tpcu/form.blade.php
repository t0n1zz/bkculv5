<?php
$kelas ='tpcu';
$imagepath = 'images_tpcu/';
$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
$cu = \Auth::user()->getCU();
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Foto TP</h4>
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
            @if($cu  == '0')
            <!--nama credit union-->
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Credit Union</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="cu" required>
                            <option hidden="">Silahkan pilih Credit Union</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->no_ba }}"
                                @if(!empty($data))
                                    @if($data->cu == $data2->no_ba)
                                        {!! "selected" !!}
                                            @endif
                                        @endif
                                >{!! $data2->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="help-block">Credit Union harus dipilih.</div>
                </div>
            </div>
            <!--/nama credit union-->
            @else
                <input type="text" value="{{ $cu }}" name="cu" hidden readonly>
            @endif
            <!--nama tp-->
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Nama </h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama TP',
                            'required','min-length' => '5','autocomplete'=>'off')) }}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>    
                    </div>
                    <div class="help-block">Nama TP harus diisi dan minimal 5 karakter.</div>
                </div>
            </div>
            <!--/nama tp-->
            <!--nama tp-->
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>No. TP </h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('no_tp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan no TP',
                            'required','autocomplete'=>'off')) }}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>    
                    </div>
                    <div class="help-block">No TP harus diisi .</div>
                </div>
            </div>
            <!--/nama tp-->
            <!-- ultah -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tanggal Berdiri</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                            if(!empty($data)){
                                $timestamp = strtotime($data->ultah);
                                $tanggal = date('d/m/Y',$timestamp);
                            }
                        ?>
                        <input type="text" name="ultah" value="@if(!empty($data)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" required />
                    </div>
                    <div class="help-block">Tanggal berdiri TP harus diisi.</div>
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
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Alamat</h4>
                    {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan alamat')) }}
                    <div class="help-block">Silahkan masukkan alamat.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <div class="form-group">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan">
                <i class="fa fa-save"></i> <u>S</u>impan
            </button>
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" value="simpan">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru
            </button>
            @if($cu == '0')  
                <a href="{{ route('admins.'.$kelas.'.index' )}}" name="batal" accesskey="b" class="btn btn-danger" value="batal">
                    <i class="fa fa-times"></i> <u>B</u>atal
                </a>
            @else
                <a href="{{ route('admins.'.$kelas.'.index_cu',array($cu) )}}" name="batal" accesskey="b" class="btn btn-danger" value="batal">
                    <i class="fa fa-times"></i> <u>B</u>atal
                </a>
            @endif
        </div>
    </div>
</div>
<!-- content -->

