<div class="row">
	<div class="col-sm-3">
		<div class="form-group">
            <h4>Nama CU</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::text('nid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                    'required','autocomplete'=>'off'))}}
            </div>
            {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
        </div>		
	</div>
	<div class="col-sm-2">
		<div class="form-group">
            <h4>No. BA</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::text('nid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                    'required','autocomplete'=>'off'))}}
            </div>
            {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
        </div>		
	</div>
	<div class="col-sm-3">
		<div class="form-group">
            <h4>Total Simpanan</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::text('nid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                    'required','autocomplete'=>'off'))}}
            </div>
            {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
        </div>		
	</div>
	<div class="col-sm-3">
		<div class="form-group">
            <h4>Total Pinjaman</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::text('nid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                    'required','autocomplete'=>'off'))}}
            </div>
            {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
        </div>		
	</div>
	<div class="col-sm-1">
        <button type="button" class="btn btn-default btn-block" id="cutambah" onclick="func_cutambah()">X</button>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-default btn-block" id="cutambah" onclick="func_cutambah()">Punya keanggotaan di CU</button>
    </div>
</div> 