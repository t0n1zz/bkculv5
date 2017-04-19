<input type="text" name="sekarangpendidikan" id="sekarangpendidikan" value="0" hidden>
<input type="text" name="tipependidikan" id="idtipe" value="" hidden>
<div class="form-group">
    <h4>Tingkat Pendidikan</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-list"></i></span>
        <select class="form-control placeholder" onChange="func_selectpendidikan(value);"  name="selectpendidikan" id="selectpendidikan">
            <option value="0" hidden>Silahkan pilih pendidikan</option>
            <option value="1">SD</option>
            <option value="2">SMP</option>
            <option value="3">SMA/SMK</option>
            <option value="4">D1</option>
            <option value="5">D2</option>
            <option value="6">D3</option>
            <option value="7">D4</option>
            <option value="8">S1</option>
            <option value="9">S2</option>
            <option value="10">S3</option>
            <option value="lain">Lain-lain</option>
        </select>
    </div>
</div>
<div class="form-group" id="jurusan" style="display: none;">
    <h4>Jurusan/Bidang</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-font"></i></span>
        {{ Form::text('namapendidikan',null,array('class' => 'form-control','id'=>'namapendidikan',
          'placeholder' => 'Silahkan masukkan jurusan/bidang','autocomplete'=>'off'))}}
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>  
    </div>
    <div class="help-block">Jurusan/bidang harus diisi.</div>
</div>
<div id="pendidikangroup" style="display: none;">
    <div class="form-group">
        <h4>Tempat</h4>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-font"></i></span>
            {{ Form::text('tempatpendidikan',null,array('class' => 'form-control','id'=>'tempatpendidikan',
                'placeholder' => 'Silahkan masukkan tempat pendidikan','autocomplete'=>'off'))}}
        </div>
        <div class="help-block">Tempat harus diisi.</div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <h4>Tanggal Mulai</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {{ Form::text('mulaipendidikan',null,array('class' => 'form-control','id'=>'mulaipendidikan',
                        'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <h4>Tanggal Selesai</h4>
                <div class="input-group" id="groupselesaipendidikan">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {{ Form::text('selesaipendidikan',null,array('class' => 'form-control','id'=>'selesaipendidikan',
                        'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="masihaktifpendidikan()" >Masih Belajar</button>
                    </div>
                </div>
                <div class="input-group" id="masihpendidikan" style="display: none;">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" value="Masih Belajar" readonly class="form-control" />
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="nonaktifpendidikan()" ><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
