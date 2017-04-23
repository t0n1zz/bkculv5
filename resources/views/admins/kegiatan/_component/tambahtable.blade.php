<thead class="bg-light-blue-active color-palette">
    <tr>
        <th hidden></th>
        <th hidden></th>
        <th data-sortable="false">Foto</th>
        <th class="sort" data-priority="1">Nama</th>
        <th>Lembaga</th>
        <th>Jabatan</th>
        <th class="none">NIM</th>
        <th class="none">NID</th>
        <th class="none">Pendidikan</th>
        <th class="none">Agama</th>
        <th class="none">Status</th>
        <th class="none">Tgl. Lahir</th>
        <th class="none">Umur</th>
        <th class="none">Alamat</th>
        <th class="none">Kontak</th>
        <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
    @foreach($datastaf as $dataf)
        <?php
            $date = new Date($dataf->staf->tanggal_lahir);
            $tempat ="";
            $pekerjaan = "";
            $pendidikan ="";
            $i = 0; 
            if(!empty($dataf->staf->pekerjaan_aktif)){
                foreach($dataf->staf->pekerjaan_aktif as $p){
                    $i++;
                    if($p->tipe == "1"){
                        $tempat .= 'CU ' . $p->cuprimer->name ;
                        $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                    }elseif($p->tipe == "2"){
                        $tempat .= $p->lembaga->name;
                        $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                    }elseif($p->tipe == "3"){
                        $tempat .= 'Puskopdit BKCU Kalimantan';
                        $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                    }
                    if($i < $dataf->staf->pekerjaan_aktif->count()){
                        $tempat .= ', ';
                        $pekerjaan .= ', ';
                    }
                }
            }
            
            if(!empty($dataf->staf->pendidikan)){
                $pendidikan = $dataf->staf->pendidikan->first();
                if(!empty($pendidikan)){
                    if($pendidikan->tingkat == 1){
                        $tingkat = "SD";
                    }elseif($pendidikan->tingkat == 2){
                        $tingkat = "SMP";
                    }elseif($pendidikan->tingkat == 3){
                        $tingkat = "SMA/SMK";
                    }elseif($pendidikan->tingkat == 4){
                        $tingkat = "D1";
                    }elseif($pendidikan->tingkat == 5){
                        $tingkat = "D2";
                    }elseif($pendidikan->tingkat == 6){
                        $tingkat = "D3";
                    }elseif($pendidikan->tingkat == 7){
                        $tingkat = "D4";
                    }elseif($pendidikan->tingkat == 8){
                        $tingkat = "S1";
                    }elseif($pendidikan->tingkat == 9){
                        $tingkat = "S2";
                    }elseif($pendidikan->tingkat == 10){
                        $tingkat = "S3";
                    }else{
                        $tingkat = "";
                    }
                }
            }
         
            $newarr = explode("\n",$dataf->staf->alamat);
            foreach($newarr as $str){
                $alamat = $str;
            }

            $newarr2 = explode("\n",$dataf->staf->kontak);
            foreach($newarr2 as $str2){
                $kontak = $str2;
            }
            ?>
        <tr>
            <td hidden>{{ $dataf->id_staf }}</td>
            @if(!empty($dataf->staf->gambar) && is_file($imagepath2.$dataf->staf->gambar."n.jpg"))
                <td hidden>{{ asset($imagepath2.$dataf->staf->gambar.'n.jpg') }}</td>
                <td style="white-space: nowrap"><div class="modalphotos" >
                        {{ Html::image($imagepath2.$dataf->staf->gambar.'n.jpg',asset($imagepath2.$dataf->staf->gambar."jpg"),
                         array('class' => 'img-responsive',
                        'id' => 'tampilgambar', 'width' => '40px')) }}
                    </div></td>
            @else
                @if($dataf->staf->kelamin == "Wanita")
                    <td hidden>{{ asset('images/no_image_woman.jpg') }}</td>
                    <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                @else
                    <td hidden>{{ asset('images/no_image_man.jpg') }}</td>
                    <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                @endif
            @endif
            <td>{{ $dataf->staf->name }}</td>
            <td class="warptext">{!! $tempat !!}</td>
            <td class="warptext">{!! $pekerjaan !!}</td>
            <td>{{ $dataf->staf->nim }}</td>
            <td>{{ $dataf->staf->nid }}</td>
            @if(!empty($pendidikan))
                <td>{{ $tingkat . ' ' . $pendidikan->name . ' ' . $pendidikan->tempat}}</td>
            @else
                <td></td>    
            @endif
            <td>{{ $dataf->staf->agama }}</td>
            <td>{{ $dataf->staf->status }}</td>
            <td data-order="{{ $dataf->tanggal_lahir }}">{{ $date->format('d F Y') }}</td>
            <td>{{ $dataf->staf->age }} Tahun</td>
            <td>{{ $alamat }}</td>
            <td>{{ $kontak }}</td>
            <td></td>
        </tr>
    @endforeach
</tbody>