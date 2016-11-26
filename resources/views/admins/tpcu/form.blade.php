<?php
$kelas ='tpcu';
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!--nama credit union-->
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Credit Union</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="cu" required>
                            <option hidden="">Silahkan pilih Credit Union</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->id }}"
                                @if(!empty($data))
                                    @if($data->cu == $data2->id)
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
            <!-- ultah -->
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
                        <input type="text" name="ultah" value="@if(!empty($ultah)){{$ultah}}@endif" class="form-control"
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
            <a href="{{ route('admins.'.$kelas.'.index' )}}" name="batal" accesskey="b" class="btn btn-danger" value="batal">
                <i class="fa fa-times"></i> <u>B</u>atal
            </a>
        </div>
    </div>
</div>
<!-- content -->

