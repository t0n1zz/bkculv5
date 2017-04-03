<?php
$kelas ='laporancu';
$culists = App\Cuprimer::orderBy('name','asc')->get();
$culists_non = App\Cuprimer::onlyTrashed()->orderBy('name','asc')->get();
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
                            <h4>Credit Union</h4>
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
                            <div class="help-block">Credit union harus diisi.</div>
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
                                   data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" required />
                        </div>
                        <div class="help-block">Periode laporan harus diisi.</div>
                    </div>
                </div>
                <!-- /data per-->
            <div class="col-sm-12"><hr/></div>
            <!--jumlah anggota-->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Laki-laki Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l_biasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Laki-laki Luar Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('l_lbiasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Perempuan Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p_biasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Anggota Perempuan Luar Biasa</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('p_lbiasa',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Anggota Tahun Lalu <i class="fa fa-question-circle-o" data-toggle="tooltip" title="Anggota tahun lalu dari bulan yang sama"></i></h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalanggota_lalu',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Total Anggota Tahun Lalu harus diisi.</div>
                </div>
            </div>
            <!--/jumlah anggota-->
            <div class="col-sm-12"><hr/></div>
            <!-- kekayaan -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aset</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                           {{ Form::text('aset',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Aset harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aset Tahun Lalu <i class="fa fa-question-circle-o" data-toggle="tooltip" title="Aset tahun lalu dari bulan yang sama"></i></h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_lalu',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Aset Tahun Lalu harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aset Masalah</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_masalah',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aset Tidak Menghasilkan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_tidak_menghasilkan',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Aset tidak menghasilkan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aset Likuid Tidak Menghasilkan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aset_likuid_tidak_menghasilkan',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Aset likuid tidak menghasilkan harus diisi.</div>
                </div>
            </div>
            <!-- investasi -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Investasi Likuid</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('investasi_likuid',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <!-- /investasi -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Aset Lancar</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('aktivalancar',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Aset lancar harus diisi.</div>
                </div>
            </div>
            <!-- /kekayaan -->
            <div class="col-sm-12"><hr/></div>
            <!-- simpanan saham -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simpanan Saham</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('simpanansaham',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Simpanan saham harus diisi.</div>
                </div>
            </div>
            <!-- /simpanan saham -->
            <!-- unggulan -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simp. Non Saham (Unggulan)</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nonsaham_unggulan',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Simp. Non Saham (Unggulan) harus diisi.</div>
                </div>
            </div>
            <!-- /unggulan -->
            <!-- harian -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simp. Non Saham (Harian & Deposito) <i class="fa fa-question-circle-o" data-toggle="tooltip" title="Seluruh simpanan non-saham (Harian & Deposito) kecuali simpanan unggulan"></i></h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nonsaham_harian',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Simp. Non Saham (Harian & Deposito) harus diisi.</div>
                </div>
            </div>
            <!-- /harian -->
            <!-- bulan lalu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simpanan Saham Tahun Lalu <i class="fa fa-question-circle-o" data-toggle="tooltip" title="Simpanan saham tahun lalu dari bulan yang sama/bulan ini"></i></h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('simpanansaham_lalu',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Simpanan saham tahun lalu bulan ini harus diisi.</div>
                </div>
            </div>
            <!-- /bulan lalu -->
            <!-- bulan lalu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Simpanan Saham Tahun Lalu Bulan Desember <i class="fa fa-question-circle-o" data-toggle="tooltip" title="Simpanan saham bulan desember tahun lalu"></i></h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('simpanansaham_des',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Simpanan saham tahun lalu bulan desember harus diisi.</div>
                </div>
            </div>
            <!-- /bulan lalu -->
            <div class="col-sm-12"><hr/></div>
            <!-- hutang -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Hutang SPD</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hutangspd',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Hutang Pihak Ke-3 <i class="fa fa-question-circle-o" data-toggle="tooltip" title="Hutang di Puskopdit BKCU Kalimantan dan lembaga lain"></i></h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalhutang_pihak3',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Hutang Tidak Berbiaya < 30 hari</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hutang_tidak_berbiaya_30hari',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Hutang tidak berbiaya < 30 hari harus diisi.</div>
                </div>
            </div>
            <!-- /hutang -->
            <div class="col-sm-12"><hr/></div>
            <!-- piutang  -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Beredar</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutangberedar',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Piutang beredar harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Lalai 1-12 Bulan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanglalai_1bulan',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Piutang lalai 1-12 bulan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Piutang Lalai > 12 Bulan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('piutanglalai_12bulan',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Piutang lalai > 12 bulan harus diisi.</div>
                </div>
            </div>
            <!-- /piutang-->
            <div class="col-sm-12"><hr/></div>
            <!-- dcu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Cadangan Umum</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('dcu',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Cadangan umum harus diisi.</div>
                </div>
            </div>
            <!-- /dcu -->
            <!-- dcr -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Cadangan Resiko</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('dcr',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Cadangan resiko harus diisi.</div>
                </div>
            </div>
            <!-- /dcr -->
            <!-- iuran -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Dana Gedung</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('iuran_gedung',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Dana gedung harus diisi.</div>
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
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <!-- /donasi -->
            <!-- beban -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Beban Penyisihan Cadangan Resiko</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('beban_penyisihandcr',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Beban penyisihan cadangan resiko harus diisi.</div>
                </div>
            </div>
            <!-- /beban -->
            <div class="col-sm-12"><hr/></div>
            <!-- total pendapatan -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Pendapatan</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalpendapatan',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Total pendapatan harus diisi.</div>
                </div>
            </div>
            <!-- /total pendapatan-->
            <!-- total biaya -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Total Biaya</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('totalbiaya',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Total biaya harus diisi.</div>
                </div>
            </div>
            <!-- /total biaya-->
            <!-- shu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Sisa Hasil Usaha (SHU)</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('shu',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Sisa hasil usaha (SHU) harus diisi.</div>
                </div>
            </div>
            <!-- /shu-->
            <!-- shu -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Sisa Hasil Usaha (SHU) Tahun Lalu</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('shu_lalu',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Sisa hasil usaha (SHU) tahun lalu harus diisi.</div>
                </div>
            </div>
            <!-- /shu-->
            <div class="col-sm-12"><hr/></div>
            <!-- bjs saham -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Balas Jasa Simpanan (BJS) Saham</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('bjs_saham',null,array('class' => 'form-control', 'placeholder' => '0',
                           'data-inputmask' => "'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                    </div>
                    <div class="help-block">Isi 0 apabila tidak ada.</div>
                </div>
            </div>
            <!-- /bjs saham -->
            <!-- inflasi -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Laju Inflasi</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('lajuinflasi',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'decimal','digits': 2,'autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                        <span class="input-group-addon">%</span>   
                    </div>
                    <div class="help-block">Laju inflasi harus diisi.</div>
                </div>
            </div>
            <!-- /inflasi-->
            <!-- hargapasar -->
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Harga Pasar</h5>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('hargapasar',null,array('class' => 'form-control', 'placeholder' => '0','required',
                           'data-inputmask' => "'alias':'decimal','digits': 2,'autoUnmask': true, 'removeMaskOnSubmit': true")) }}
                        <span class="input-group-addon">%</span>
                    </div>
                    <div class="help-block">Harga pasar harus diisi.</div>
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

