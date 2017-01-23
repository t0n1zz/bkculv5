<?php
$kelas ='laporancu';
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
                <!--nama credit union-->
                @if(Auth::user()->getCU() == '0')
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Nama Credit Union</h4>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                <select class="form-control" name="no_ba" required data-error="Nama Credit Union wajib dipilih"
                                    @if(!empty($data)) {!! "disabled" !!} @endif>
                                    <option selected disabled>Silahkan pilih Credit Union</option>
                                    <option disabled>-------CU Aktif-------</option>   
                                    @foreach($culists as $culist)
                                        <option value="{{ $culist->no_ba }}"
                                        @if(!empty($data))
                                            @if($data->no_ba == $culist->no_ba)
                                                {!! "selected" !!}
                                            @endif
                                        @endif
                                        >{!! $culist->name !!}</option>
                                    @endforeach
                                    <option disabled>-------CU Non-Aktif-------</option>
                                    @foreach($culists_non as $culist)
                                        <option value="{{ $culist->no_ba }}"
                                        @if(!empty($data))
                                            @if($data->no_ba == $culist->no_ba)
                                                {!! "selected" !!}
                                            @endif
                                        @endif
                                        >{!! $culist->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
                <!--/nama credit union-->
                <!-- dataper -->
                @if(Auth::user()->getCU() == '0')
                    <div class="col-sm-6">
                @else
                    <div class="col-sm-12">
                @endif
                    <div class="form-group">
                        <h4>Periode Laporan</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php
                            if(!empty($data->periode)){
                                $timestamp = strtotime($data->periode);
                                $tanggal = date('d/m/Y',$timestamp);
                            }
                            ?>
                            <input type="text" name="periode" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                   data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        </div>
                    </div>
                </div>
                <!-- /data per-->
                <div class="col-sm-12">
                    <hr/>
                </div>
            <!--jumlah anggota-->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Laki-laki Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l.biasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Laki-laki Luar Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l.lbiasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Perempuan Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p.biasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Perempuan Luar Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p.lbiasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Anggota Tahun Lalu</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalanggota_lalu',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!--/jumlah anggota-->
            <!-- kekayaan -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Kekayaan (ASET)</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                           {{ Form::text('aset',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Kekayaan (ASET) Tahun Lalu</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_lalu',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Kekayaan (ASET) Masalah</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_masalah',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Kekayaan (ASET) Tidak Menghasilkan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_tidak_menghasilkan',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Kekayaan (ASET) Likuid Tidak Menghasilkan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_likuid_tidak_menghasilkan',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /kekayaan -->
            <!-- aktiva lancar -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aktiva Lancar</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aktivalancar',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /aktiva lancar -->
            <!-- simpanan saham -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simpanan Saham (SP+SW)</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('simpanansaham',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /simpanan saham -->
            <!-- unggulan -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simp. Non Saham Unggulan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nonsaham_unggulan',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /unggulan -->
            <!-- harian -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simp. Non Saham Harian & Deposito</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nonsaham_harian',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /harian -->
             <div class="col-sm-12">
                <hr/>
            </div>
            <!-- hutang -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Hutang SPD</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hutangspd',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Hutang Tidak Berbiaya < 30hari</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hutang_tidak_berbiaya_30hari',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Hutang Pihak Ke-3</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalhutang_pihak3',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /hutang -->
            <!-- piutang  -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Beredar</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutangberedar',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Anggota</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanganggota',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Lalai 1-12 Bulan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanglalai_1bulan',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Lalai > 12 Bulan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanglalai_12bulan',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /piutang-->
                        <!-- dcu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>DCU</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('dcu',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /dcu -->
            <!-- dcr -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>DCR</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('dcr',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /dcr -->
            <!-- iuran -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Iuran Gedung</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('iuran_gedung',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /iuran -->
            <!-- donasi -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Donasi</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('donasi',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /donasi -->
            <!-- bjs saham -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>BJS Saham</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('bjs_saham',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /bjs saham -->
            <!-- beban -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Beban Operasional</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('beban_operasional',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /beban -->
            <!-- investasi -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Investasi Likuid</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('investasi_likuid',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /investasi -->
            <div class="col-sm-12">
                <hr/>
            </div>
            <!-- total pendapatan -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Pendapatan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalpendapatan',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /total pendapatan-->
            <!-- total biaya -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Biaya</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalbiaya',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /total biaya-->
            <!-- shu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>SHU</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('shu',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /shu-->
            <!-- shu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>SHU Tahun Lalu</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('shu_lalu',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /shu-->
            <!-- inflasi -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Laju Inflasi</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('lajuinflasi',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /inflasi-->
            <!-- hargapasar -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Harga Pasar</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hargapasar',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                </div>
            </div>
            <!-- /hargapasar-->
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
            <a 
            <?php $cu = Auth::user()->getCU(); ?>
            @if($cu == 0)
                href="{{ route('admins.'.$kelas.'.index' )}}"
            @else
                href="{{ route('admins.'.$kelas.'.index_cu',array($cu) )}}"           
            @endif
            name="batal" accesskey="b" class="btn btn-danger" value="batal">
                <i class="fa fa-times"></i> <u>B</u>atal
            </a>
        </div>
    </div>
</div>
<!-- content -->

