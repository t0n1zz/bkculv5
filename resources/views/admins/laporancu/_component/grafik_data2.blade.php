<script>
    var data_l_biasa2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa2,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_l_lbiasa2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa2,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_p_biasa2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa2,JSON_NUMERIC_CHECK) !!}
            }

        ]
    };
    var data_p_lbiasa2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa2,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_aset2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "aset (ASET)",
                data: {!! json_encode($gaset2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aktivalancar2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aktiva Lancar",
                data: {!! json_encode($gaktivalancar2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_simpanansaham2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Saham",
                data: {!! json_encode($gsimpanansaham2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_unggulan2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Unggulan",
                data: {!! json_encode($gnonsaham_unggulan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_harian2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Harian & Deposito",
                data: {!! json_encode($gnonsaham_harian2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_hutangspd2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Hutang SPD",
                data: {!! json_encode($ghutangspd2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangberedar2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Beredar",
                data: {!! json_encode($gpiutangberedar2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_1bulan2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai 1-12 Bulan",
                data: {!! json_encode($gpiutanglalai_1bulan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_12bulan2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai > 12 Bulan",
                data: {!! json_encode($gpiutanglalai_12bulan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcr2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCR",
                data: {!! json_encode($gdcr2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcu2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCU",
                data: {!! json_encode($gdcu2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalpendapatan2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Pendapatan",
                data: {!! json_encode($gtotalpendapatan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalbiaya2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Biaya",
                data: {!! json_encode($gtotalbiaya2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_shu2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "SHU",
                data: {!! json_encode($gshu2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalanggota2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Anggota",
                data: {!! json_encode($gtotalanggota2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangbersih2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Bersih",
                data: {!! json_encode($gpiutangbersih2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasioberedar2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Beredar",
                data: {!! json_encode($grasioberedar2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasiolalai2 = {
        labels: {!! json_encode($gperiode2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Lalai",
                data: {!! json_encode($grasiolalai2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
</script>
