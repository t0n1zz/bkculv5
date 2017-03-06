<div class="input-group tabletools">
    <div class="input-group-addon"><i class="fa fa-search"></i></div>
    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
</div>
<table class="table table-hover table-bordered" id="dataTables-all" cellspacing="0" width="100%" >
    <thead class="bg-light-blue-active color-palette">
        <tr>
            <th data-sortable="false" >#</th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th>Credit Union</th>
            <th>Periode Laporan</th>
            <th>Tgl. Terima</th>
            <th>Tgl. Ubah</th>
            <th>Tgl. Hapus</th>
            <th>Anggota Lelaki Biasa</th>
            <th>Anggota Lelaki L.Biasa</th>
            <th>Anggota Perempuan Biasa</th>
            <th>Anggota Perempuan L.Biasa</th>
            <th>Total Anggota</th>
            <th>ASET</th>
            <th>Aktiva LANCAR</th>
            <th>Simpanan Saham(SP+SW)</th>
            <th>Simpanan Non-Saham Unggulan</th>
            <th>Simpanan Non-Saham Harian & Deposito</th>
            <th>Hutang SPD</th>
            <th>Piutang Beredar</th>
            <th>Piutang Bersih</th>
            <th>Piutang Lalai 1-12 Bulan</th>
            <th>Piutang Lalai > 12 Bulan</th>
            <th>Rasio Piutang Beredar</th>
            <th>Rasio Piutang Lalai</th>
            <th>DCR</th>
            <th>DCU</th>
            <th>Total Pendapatan</th>
            <th>Total Biaya</th>
            <th>SHU</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datashapus as $data)
            <?php

                $date = new Date($data->periode);
                $periode = $date->format('F Y');
                $rasio_beredar = $data->aset != 0 ? ($data->piutangberedar / $data->aset) : ($data->piutangberedar / 1);
                $rasio_lalai = $data->piutangberedar != 0 ? (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar) : (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / 1);
                $total = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;
                $piutangbersih = $data->piutangberedar - ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan);
            ?>
            <tr>
                <td class="bg-blue disabled color-palette"></td>
                <td hidden>{{ $data->id }}</td>
                <td hidden>{{ $data->no_ba }}</td>
                @if(!empty($data->cuprimer))
                    <td hidden>{{ $data->cuprimer->no_ba }}</td>
                    <td>{{ $data->cuprimer->name }}</td>
                @else
                    <td hidden>-</td>
                    <td>-</td>
                @endif
                <td data-order="{{ $data->periode }}"> @if(!empty($data->periode)){{ $periode }}@else{{ '-' }}@endif</td>
                <td data-order="{{ $data->created_at }}">@if(!empty($data->created_at)){{ $data->created_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                <td data-order="{{ $data->updated_at }}">@if(!empty($data->updated_at)){{ $data->updated_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                <td data-order="{{ $data->deleted_at }}">@if(!empty($data->deleted_at)){{ $data->deleted_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                <td>{{ number_format($data->l_biasa,"0",",",".") }}</td>
                <td>{{ number_format($data->l_lbiasa,"0",",",".") }}</td>
                <td>{{ number_format($data->p_biasa,"0",",",".") }}</td>
                <td>{{ number_format($data->p_lbiasa,"0",",",".") }}</td>
                <td>{{ number_format($total,"0",",",".") }}</td>
                <td>{{ number_format($data->aset,"0",",",".") }}</td>
                <td>{{ number_format($data->aktivalancar,"0",",",".") }}</td>
                <td>{{ number_format($data->simpanansaham,"0",",",".") }}</td>
                <td>{{ number_format($data->nonsaham_unggulan,"0",",",".") }}</td>
                <td>{{ number_format($data->nonsaham_harian,"0",",",".") }}</td>
                <td>{{ number_format($data->hutangspd,"0",",",".") }}</td>
                <td>{{ number_format($data->piutangberedar,"0",",",".")}}</td>
                <td>{{ number_format($piutangbersih,"0",",",".") }}</td>
                <td>{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}</td>
                <td>{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}</td>
                <td>{{ number_format($rasio_beredar*100,"0",",",".") }} %</td>
                <td>{{ number_format($rasio_lalai*100,"0",",",".") }} %</td>
                <td>{{ number_format($data->dcr,"0",",",".") }}</td>
                <td>{{ number_format($data->dcu,"0",",",".")}}</td>
                <td>{{ number_format($data->totalpendapatan,"0",",",".") }}</td>
                <td>{{ number_format($data->totalbiaya,"0",",",".") }}</td>
                <td>{{ number_format($data->shu,"0",",",".") }}</td>
            </tr>
        @endforeach
    </tbody>
</table>