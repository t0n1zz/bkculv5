<?php
$kelas ='perkembangancu';
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-header with-border">
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
    <div class="box-body">
        <div class="row">
            <!--nama credit union-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama Credit Union</h4>
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
           <!-- dataper -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Data Per</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->dataper)){
                            $timestamp = strtotime($data->dataper);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="dataper" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                </div>
            </div>
            <!-- /data per-->
            <div class="col-sm-12">
                <hr/>
            </div>
            <!--jumlah anggota-->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Laki-laki Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l.biasa',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah anggota laki-laki biasa',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Laki-laki Luar Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l.lbiasa',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah anggota lelaki luar biasa',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Perempuan Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p.biasa',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah anggota perempuan biasa',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Anggota Perempuan Luar Biasa</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p.lbiasa',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah anggota perempuan luar biasa',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!--/jumlah anggota-->
            <div class="col-sm-12">
                <hr/>
            </div>
            <!-- kekayaan -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kekayaan (ASET)</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('kekayaan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah kekayaan (ASET)',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /kekayaan -->
            <!-- aktiva lancar -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Aktiva Lancar</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aktivalancar',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah aktiva lancar',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /aktiva lancar -->
             <div class="col-sm-12">
                <hr/>
            </div>
            <!-- simpanan saham -->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Simpanan Saham (SP+SW)</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('simpanansaham',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah simpanan saham (SP+SW)',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /simpanan saham -->
            <!-- unggulan -->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Simp. Non Saham Unggulan</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nonsaham_unggulan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah Simp. Non Saham Unggulan',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /unggulan -->
            <!-- harian -->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Simp. Non Saham Harian & Deposito</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nonsaham_harian',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah Simp. Non Saham Harian & Deposito',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /harian -->
             <div class="col-sm-12">
                <hr/>
            </div>
            <!-- hutang spd -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Dana Cadangan DCU</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('dcu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah DCU',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /hutang spd -->
            <!-- piutang beredar -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Dana Cadangan DCR</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('dcr',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah DCR',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /piutang beredar -->
             <div class="col-sm-12">
                <hr/>
            </div>
            <!-- hutang spd -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Hutang SPD</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hutangspd',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah Hutang SPD',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /hutang spd -->
            <!-- piutang beredar -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Piutang Beredar</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutangberedar',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah piutang beredar',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /piutang beredar -->
             <div class="col-sm-12">
                <hr/>
            </div>
            <!-- piutang lalai 1 -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Piutang Lalai 1-12 Bulan</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanglalai_1bulan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah piutang lalai 1-12 bulan',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /piutang lalai 1 -->
            <!-- piutang lalai 12 -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Piutang Lalai > 12 Bulan</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanglalai_12bulan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah piutang lalai > 12 bulan',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /piutang lalai 12-->
             <div class="col-sm-12">
                <hr/>
            </div>
            <!-- total pendapatan -->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Total Pendapatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalpendapatan',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah total pendapatan',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /total pendapatan-->
            <!-- total biaya -->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Total Biaya</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalbiaya',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah total biaya',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /total biaya-->
            <!-- shu -->
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>SHU</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('shu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah SHU',
                           'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off')) }}
                    </div>
                </div>
            </div>
            <!-- /shu-->
        </div>
    </div>
</div>
<!-- content -->
