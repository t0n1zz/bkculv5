<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
        <h4>No. Perkiraan</h4>
        <div class="input-group">
            <span class="input-group-addon">0-9</span>
            <input type="text" name="kode" id="noprk" class="form-control" placeholder="Silahkan masukkan No Perkiraan" required>
        </div> 
    </div>
  </div>
  <div class="col-sm-8">
    <div class="form-group">
      <h4>Nama Perkiraan</h4>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-font"></i></span>
          <input type="text" name="name" id="nmprk" class="form-control" placeholder="Silahkan masukkan Nama Perkiraan" required>
      </div> 
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <h4>Induk</h4>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-list"></i></span>
          <select name="kode_induk" id="induk" class="form-control">
              <option hidden>Pilih induk perkiraan</option>
              @if(!empty($datas))
                @foreach($datas->unique('kode_induk')->sortBy('kode_induk') as $data2)
                  @if(!empty($data2->kode_induk))
                      <option value="{{ $data2->induk->id }}">{{ '[ '.$data2->induk->kode_induk.' ] '. $data2->induk->name_induk }}</option>
                  @endif
                @endforeach
              @endif
          </select>
      </div> 
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <h4>Kelompok</h4>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-list"></i></span>
          <select name="kelompok" id="kelompok" class="form-control" required>
              <option hidden>Pilih kelompok perkiraan</option>
              @if(!empty($datas))
                @foreach($datas->unique('kelompok')->sortBy('kelompok') as $kelompok)
                  @if(!empty($kelompok->kelompok))
                      <option value="{{ $kelompok->kelompok }}">{{ $kelompok->kelompok }}</option>
                  @endif
                @endforeach
              @endif
          </select>
      </div> 
    </div>
  </div>    
  <div class="col-sm-6">
      <div class="form-group">
          <h4>Saldo Awal</h4>
          <div class="input-group">
              <span class="input-group-addon">0-9</span>
              <input type="text" name="awal" id="sldawal" class="form-control" data-inputmask="'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true">
          </div> 
      </div>
  </div>
  <div class="col-sm-6">
      <div class="form-group">
          <h4>Saldo Akhir</h4>
          <div class="input-group">
              <span class="input-group-addon">0-9</span>
              <input type="text" name="akhir" id="sldakhir" class="form-control" data-inputmask="'alias':'numeric','groupSeparator': ',', 'autoGroup': true,'digits': 0,'radixPoint': ',','autoUnmask': true, 'removeMaskOnSubmit': true">
          </div> 
      </div>
  </div>
</div>   