<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Nama Ayah</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('nameayah',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama ayah','autocomplete'=>'off'))}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Nama Ibu</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('nameibu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama ibu','autocomplete'=>'off'))}}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <h4>Status Pernikahan</h4>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                <select class="form-control" name="status" onChange="func_selectstatus(value);" required> 
                    <option value="" hidden>Status</option>
                    <option value="Menikah"
                    @if(!empty($data))
                        @if($data->status == "Menikah")
                            {{ "selected" }}
                                @endif
                            @endif
                    >Menikah</option>
                    <option value="Belum Menikah"
                    @if(!empty($data))
                        @if($data->status == "Belum Menikah")
                            {{ "selected" }}
                                @endif
                            @endif
                    >Belum Menikah</option>
                    <option value="Duda/Janda"
                    @if(!empty($data))
                        @if($data->status == "Duda/Janda")
                            {{ "selected" }}
                                @endif
                            @endif
                    >Duda/Janda</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-12" id="pasangan" style="display: none;">
        <div class="form-group">
            <h4>Nama Pasangan</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('namepasangan',null,array('class' => 'form-control','id'=>'namepasangan','placeholder' => 'Silahkan masukkan nama pasangan','autocomplete'=>'off'))}}
            </div>
        </div>
    </div>
    <div class="col-sm-12" id="anak" style="display: none;">
        <button type="button" class="btn btn-default btn-block" id="anaktambah" onclick="func_anaktambah()">Punya Anak</button>
    </div>
</div> 