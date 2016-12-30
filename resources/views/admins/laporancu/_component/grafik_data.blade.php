<script>
    var data_l_biasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_l_lbiasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_p_biasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }

        ]
    };
    var data_p_lbiasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aset = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "aset (ASET)",
                data: {!! json_encode($gaset,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aktivalancar = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aktiva Lancar",
                data: {!! json_encode($gaktivalancar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_simpanansaham = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Saham",
                data: {!! json_encode($gsimpanansaham,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_unggulan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Unggulan",
                data: {!! json_encode($gnonsaham_unggulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_harian = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Harian & Deposito",
                data: {!! json_encode($gnonsaham_harian,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_hutangspd = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Hutang SPD",
                data: {!! json_encode($ghutangspd,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangberedar = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Beredar",
                data: {!! json_encode($gpiutangberedar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_1bulan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai 1-12 Bulan",
                data: {!! json_encode($gpiutanglalai_1bulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_12bulan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai > 12 Bulan",
                data: {!! json_encode($gpiutanglalai_12bulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcr = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCR",
                data: {!! json_encode($gdcr,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcu = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCU",
                data: {!! json_encode($gdcu,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalpendapatan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Pendapatan",
                data: {!! json_encode($gtotalpendapatan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalbiaya = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Biaya",
                data: {!! json_encode($gtotalbiaya,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_shu = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "SHU",
                data: {!! json_encode($gshu,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalanggota = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Anggota",
                data: {!! json_encode($gtotalanggota,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangbersih = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Bersih",
                data: {!! json_encode($gpiutangbersih,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasioberedar = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Beredar",
                data: {!! json_encode($grasioberedar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasiolalai = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Lalai",
                data: {!! json_encode($grasiolalai,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
</script>