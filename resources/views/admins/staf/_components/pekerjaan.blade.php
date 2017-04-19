<?php 
 $cu = Auth::user()->getCU();   
?>
<input type="text" name="sekarangpekerjaan" id="sekarangpekerjaan" value="0" hidden>
<input type="text" name="tipepekerjaan" id="tipepekerjaan" 
    @if($cu == '0')
        value=""
    @else
        value="1"
    @endif     
hidden>

@if($cu != '0')
    <input type="text" name="selectcu" value="{{ $cu }}" hidden>
@endif

@if($cu == '0')
    <div class="form-group" id="tempat" >
        <h4>Tempat</h4>
        <div class="row">
            <div class="col-sm-6">
                <div class="input-group">
            <span class="input-group-addon">
                <input type="radio" name="radiotempat" id="radiocu" onclick="func_radiocu()" value="true">
            </span>
                    <select class="form-control placeholder" onChange="func_selectcu(value);" name="selectcu" id="selectcu" disabled>
                        <option hidden>Credit Union</option>
                        <option value="bkcu">Puskopdit BKCU Kalimantan</option>
                        <option disabled>--------------</option>
                            @foreach($culists as $culist)
                                <option value="{{ $culist->no_ba }}">{{ $culist->name }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="radiotempat" id="radiolembaga" onclick="func_radiolembaga()" value="true">
                    </span>
                    <select class="form-control" onChange="func_selectlembaga(value);" name="selectlembaga" id="selectlembaga" disabled>
                        <option hidden>Bukan Credit Union</option>
                        @foreach($lembagas as $lembaga)
                            <option value="{{ $lembaga->id }}">{{ $lembaga->name }}</option>
                        @endforeach    
                        <option disabled>--------------</option> 
                        <option value="tambah" >Tambah Lembaga Baru</option>
                    </select>
                    <span class=""></span>    
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="lembagabaru">
        <div class="col-sm-12"><hr/></div>
        <div class="col-sm-6">
            <div class="form-group" >
                <h4>Nama Lembaga</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('namalembaga',null,array('class' => 'form-control','id'=>'namalembaga',
                        'placeholder' => 'Silahkan masukkan nama lembaga','autocomplete'=>'off'))}}
                </div>
                <div class="help-block">Nama lembaga harus diisi.</div>
            </div>

        </div>
        <div class="col-sm-6">
            <div class="form-group" >
                <h4>Alamat Lembaga</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('alamatlembaga',null,array('class' => 'form-control','id'=>'alamatlembaga',
                        'placeholder' => 'Silahkan masukkan tempat lembaga','autocomplete'=>'off'))}}
                </div>
                <div class="help-block">Alamat lembaga harus diisi</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group" >
                <h4>Email Lembaga</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('emaillembaga',null,array('class' => 'form-control',
                        'placeholder' => 'Silahkan masukkan email lembaga','autocomplete'=>'off'))}}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group" >
                <h4>Telepon Lembaga</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('telplembaga',null,array('class' => 'form-control',
                        'placeholder' => 'Silahkan masukkan telepon lembaga','autocomplete'=>'off'))}}
                </div>
            </div>
        </div>
        <div class="col-sm-12"><hr/></div>
    </div>
@endif

<div class="form-group" id="jabatan" 
    @if($cu == '0') 
      style="display: none;"
    @endif>
    <h4>Jabatan</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-font"></i></span>
        {{ Form::text('namapekerjaan',null,array('class' => 'form-control','id'=>'namapekerjaan',
          'placeholder' => 'Silahkan masukkan jabatan','autocomplete'=>'off'))}}
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>  
    </div>
    <div class="help-block">Jabatan harus diisi.</div>
</div>

<div class="form-group" id="tingkatcu" 
    @if($cu == '0') 
      style="display: none;"
    @endif>
    <h4>Tingkatan</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-list"></i></span>
        <select class="form-control placeholder" name="selecttingkatcu" onChange="func_selecttingkatan(value);" id="selecttingkatcu">
            <option value="0" hidden>Silahkan pilih tingkat</option>
            <option value="Pengurus">Pengurus</option>
            <option value="Pengawas">Pengawas</option>
            <option value="Komite">Komite</option>
            <option value="Senior Manajer">Senior Manajer (General Manager, CEO, Deputy)</option>
            <option value="Manajer">Manajer</option>
            <option value="Supervisor">Supervisor (Kepala Bagian, Kepala Divisi, Kepala/Koordinator TP, Kepala Bidang)</option>
            <option value="Staf">Staf</option>
        </select>
    </div>
    <div class="help-block">Tingkatan harus diisi.</div>
</div>

@if($cu == '0')
    <div class="form-group" id="tingkatlembaga" style="display: none;">
    <h4>Tingkatan</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-list"></i></span>
        <select class="form-control placeholder" name="selecttingkatlembaga" id="selecttingkatlembaga">
            <option value="0" hidden>Silahkan pilih tingkat</option>
            <option value="Senior Manajer">Senior Manajer (General Manager/CEO)</option>
            <option value="Manajer">Manajer</option>
            <option value="Supervisor">Supervisor (Kepala Bagian, Kepala Divisi, Kepala Bidang)</option>
            <option value="Staf">Staf</option>
        </select>
    </div>
    <div class="help-block">Tingkatan harus diisi.</div>
</div>
@endif

<div class="row" id="waktupekerjaan" 
    @if($cu == '0') 
      style="display: none;"
    @endif>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Tanggal Mulai</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('mulaipekerjaan',null,array('class' => 'form-control','id'=>'mulaipekerjaan','autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Tanggal Selesai</h4>
            <div class="input-group" id="groupselesaipekerjaan">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('selesaipekerjaan',null,array('class' => 'form-control','id'=>'selesaipekerjaan',
                    'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                <div class="input-group-btn" id="btnsekarang">
                    <button type="button" class="btn btn-default" onclick="masihaktifpekerjaan()" >Masih Bekerja</button>
                </div>
            </div>
            <div class="input-group" id="masihpekerjaan" style="display: none;">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="Masih Bekerja" readonly class="form-control" />
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="nonaktifpekerjaan()" ><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>


