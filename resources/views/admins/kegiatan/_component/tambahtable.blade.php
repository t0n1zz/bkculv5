<thead class="bg-light-blue-active color-palette">
    <tr>
        <th hidden></th>
        <th hidden></th>
        <th data-sortable="false">Foto</th>
        <th class="sort" data-priority="1">Nama</th>
        <th>Jabatan</th>
        <th>Pendidikan</th>
        <th class="none">NIM</th>
        <th class="none">NID</th>
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
            $date = new Date($dataf->tanggal_lahir);
            $tempat ="";
            $pekerjaan = "";
            $pendidikan ="";
            $i = 0; 
            if(!empty($dataf->pekerjaan_aktif)){
                foreach($dataf->pekerjaan_aktif as $p){
                    $i++;
                    if($p->tipe == "1"){
                        $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                    }elseif($p->tipe == "2"){
                        $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                    }elseif($p->tipe == "3"){
                        $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                    }
                    if($i < $dataf->pekerjaan_aktif->count()){
                        $pekerjaan .= ', ';
                    }
                }
            }
            
            if(!empty($dataf->pendidikan_tertinggi)){
                $pendidikan = $dataf->pendidikan_tertinggi->first();
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
         
            $newarr = explode("\n",$dataf->alamat);
            foreach($newarr as $str){
                $alamat = $str;
            }

            $newarr2 = explode("\n",$dataf->kontak);
            foreach($newarr2 as $str2){
                $kontak = $str2;
            }
            ?>
        <tr>
            <td hidden>{{ $dataf->id_staf }}</td>
            @if(!empty($dataf->gambar) && is_file($imagepath2.$dataf->gambar."n.jpg"))
                <td hidden>{{ asset($imagepath2.$dataf->gambar.'n.jpg') }}</td>
                <td style="white-space: nowrap"><div class="modalphotos" >
                        {{ Html::image($imagepath2.$dataf->gambar.'n.jpg',asset($imagepath2.$dataf->gambar."jpg"),
                         array('class' => 'img-responsive',
                        'id' => 'tampilgambar', 'width' => '40px')) }}
                    </div></td>
            @else
                @if($dataf->kelamin == "Wanita")
                    <td hidden>{{ asset('images/no_image_woman.jpg') }}</td>
                    <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                @else
                    <td hidden>{{ asset('images/no_image_man.jpg') }}</td>
                    <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                        'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                @endif
            @endif
            <td>{{ $dataf->name }}</td>
            <td class="warptext">{!! $pekerjaan !!}</td>
            @if(!empty($pendidikan))
                <td>{{ $tingkat . ' ' . $pendidikan->name . ' ' . $pendidikan->tempat}}</td>
            @else
                <td></td>    
            @endif
            <td>{{ $dataf->nim }}</td>
            <td>{{ $dataf->nid }}</td>
            <td>{{ $dataf->agama }}</td>
            <td>{{ $dataf->status }}</td>
            <td data-order="{{ $dataf->tanggal_lahir }}">{{ $date->format('d F Y') }}</td>
            <td>{{ $dataf->age }} Tahun</td>
            <td>{{ $alamat }}</td>
            <td>{{ $kontak }}</td>
            <td></td>
        </tr>
    @endforeach
</tbody>