<input type="text" name="sekarangorganisasi" id="sekarangorganisasi" value="0" hidden>
<input type="text" name="tipeorganisasi" id="tipeorganisasi" value="" hidden>
@if(!Request::is('admins/staf/detail*'))
<div class="form-group">
    <h4>Terlibat dalam organisasi lain?</h4>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="radio" name="radioorganisasi" id="radioorganisasi" onclick="func_organsasiyes()" value="true" required>
                </span>
                {!! Form::text('null','Ya',array('class' => 'form-control', 'id' => 'statustext' ,'disabled' => 'true')) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="radio" name="radioorganisasi" id="radioorganisasi" onclick="func_organsasino()" value="true" required>
                </span>
                {!! Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'statustext' ,'disabled' => 'true')) !!}
            </div>
        </div>
    </div>
</div>
@endif
@if(!Request::is('admins/staf/detail*'))
<div class="row" id="organisasi" style="display: none;">
@else
<div class="row">
@endif
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Organisasi</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('namaorganisasi',null,array('class' => 'form-control','id'=>'namaorganisasi',
                  'placeholder' => 'Silahkan masukkan nama organisasi','autocomplete'=>'off'))}}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>  
            </div>
            <div class="help-block">Organisasi harus diisi.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group" >
            <h4>Jabatan/peran</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('jabatanorganisasi',null,array('class' => 'form-control','id'=>'jabatanorganisasi',
                  'placeholder' => 'Silahkan masukkan nama jabatan/peran','autocomplete'=>'off'))}}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>  
            </div>
            <div class="help-block">Jabatan/peran mulai harus diisi.</div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <h4>Tempat</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('tempatorganisasi',null,array('class' => 'form-control','id'=>'tempatorganisasi','placeholder' => 'Silahkan masukkan tempat organisasi','autocomplete'=>'off'))}}
            </div>
            <div class="help-block">Tempat harus diisi.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Tanggal Mulai</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('mulaiorganisasi',null,array('class' => 'form-control','id'=>'mulaiorganisasi',
                    'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Tanggal Selesai</h4>
            <div class="input-group" id="groupselesaiorganisasi">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('selesaiorganisasi',null,array('class' => 'form-control','id'=>'selesaiorganisasi',
                    'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="masihaktiforganisasi()" >Masih Aktif</button>
                </div>
            </div>
            <div class="input-group" id="masihorganisasi" style="display: none;">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="Masih Aktif" readonly class="form-control" />
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="nonaktiforganisasi()" ><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>




