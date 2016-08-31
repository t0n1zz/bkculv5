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
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama Credit Union *</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="cu" required data-error="Nama Credit Union wajib dipilih">
                            <option selected disabled>Silahkan pilih Credit Union</option>
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
                </div>
            </div>
            <!--/nama credit union-->
            <!--nama tp-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama TP *</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama TP',
                            'required','min-length' => '5','data-error' => 'Nama TP wajib diisi dan minimal 5 karakter',
                            'autocomplete'=>'off')) }}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('judul', '<p class="text-warning">:message</p>') !!}
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
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                </div>
            </div>
            <!-- /ultah-->
            <div class="col-sm-12">
                <hr/>
            </div>
            <!--jumlah anggota-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Lelaki Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l_biasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ','")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Lelaki Luar Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l_lbiasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ','")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Perempuan Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p_biasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ','")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Perempuan Luar Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p_lbiasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ','")) }}
                    </div>
                </div>
            </div>
            <!--/jumlah anggota-->
            <div class="col-sm-12">
                <hr/>
            </div>
            <!-- staf -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Staf Lelaki</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l_staf',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ','")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Staf Perempuam</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p_staf',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ','")) }}
                    </div>
                </div>
            </div>
            <!-- /staf -->
            <div class="col-sm-12">
                <hr/>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Alamat</h4>
                    {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan alamat')) }}
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

