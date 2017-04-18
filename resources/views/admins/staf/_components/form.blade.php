<div class="row">
    <div class="col-sm-12">
        <h4>Foto</h4>
        <div class="thumbnail">
            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                {{ Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
            @else
                {{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
            @endif
            <div class="caption">
                {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>No. Identitas</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('nid',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor identitas',
                            'required','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">No. Identitas harus diisi.</div>
                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama staf',
                            'required','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Nama harus diisi.</div>
                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tempat & Tanggal Lahir</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                {{ Form::text('tempat_lahir',null,array('class' => 'form-control', 'placeholder' => 'Tempat'))}}
                                {{ $errors->first('tempat_lahir', '<p class="text-warning">:message</p>') }}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php
                                if(!empty($data->tanggal_lahir)){
                                    $timestamp = strtotime($data->tanggal_lahir);
                                    $tanggal = date('d/m/Y',$timestamp);
                                }
                                ?>
                                <input type="text" name="tanggal_lahir" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                       data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h4>Gender</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="kelamin">
                            <option selected disabled>Jenis kelamin</option>
                            <option value="Pria"
                            @if(!empty($data))
                                @if($data->kelamin == "Pria")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                                    >Pria</option>
                            <option value="Wanita"
                            @if(!empty($data))
                                @if($data->kelamin == "Wanita")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                                    >Wanita</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h4>Agama</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="agama">
                            <option selected disabled>Agama</option>
                            <option value="Khatolik"
                            @if(!empty($data))
                                @if($data->agama == "Khatolik")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Khatolik</option>
                            <option value="Protestan"
                            @if(!empty($data))
                                @if($data->agama == "Protestan")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Protestan</option>
                            <option value="Kong Hu Cu"
                            @if(!empty($data))
                                @if($data->agama == "Kong Hu Cu")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Kong Hu Cu</option>
                            <option value="Buddha"
                            @if(!empty($data))
                                @if($data->agama == "Buddha")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Buddha</option>
                            <option value="Hindu"
                            @if(!empty($data))
                                @if($data->agama == "Hindu")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Hindu</option>
                            <option value="Islam"
                            @if(!empty($data))
                                @if($data->agama == "Islam")
                                    {{ "selected" }}
                                        @endif
                                    @endif
                            >Islam</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kontak</h4>
                    {{ Form::textarea('kontak',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan informasi kontak anda yang bisa dihubungi')) }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Alamat</h4>
                    {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder' => 'Silahkan masukkan alamat tempat tinggal anda saat ini')) }}
                </div>
            </div>
        </div>
    </div>
</div>