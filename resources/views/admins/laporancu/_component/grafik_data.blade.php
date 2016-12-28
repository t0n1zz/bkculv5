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
            ,
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
    var data_anggota = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa,JSON_NUMERIC_CHECK) !!}
            },
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa,JSON_NUMERIC_CHECK) !!}
            },
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa,JSON_NUMERIC_CHECK) !!}
            },
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    @if(Request::is('admins/laporancu'))
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

        var data_l_biasa3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Anggota Lelaki Biasa",
                    data: {!! json_encode($gl_biasa3,JSON_NUMERIC_CHECK) !!}
                }
            ]
        };
        var data_l_lbiasa3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Anggota Lelaki Luar Biasa",
                    data: {!! json_encode($gl_lbiasa3,JSON_NUMERIC_CHECK) !!}
                }
            ]
        };
        var data_p_biasa3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Anggota Perempuan Biasa",
                    data: {!! json_encode($gp_biasa3,JSON_NUMERIC_CHECK) !!}
                }

            ]
        };
        var data_p_lbiasa3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Anggota Perempuan Luar Biasa",
                    data: {!! json_encode($gp_lbiasa3,JSON_NUMERIC_CHECK) !!}
                }
            ]
        };
        var data_aset3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "aset (ASET)",
                    data: {!! json_encode($gaset3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_aktivalancar3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Aktiva Lancar",
                    data: {!! json_encode($gaktivalancar3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_simpanansaham3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Simpanan Saham",
                    data: {!! json_encode($gsimpanansaham3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_nonsaham_unggulan3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Simpanan Non Saham Unggulan",
                    data: {!! json_encode($gnonsaham_unggulan3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_nonsaham_harian3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Simpanan Non Saham Harian & Deposito",
                    data: {!! json_encode($gnonsaham_harian3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_hutangspd3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Hutang SPD",
                    data: {!! json_encode($ghutangspd3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_piutangberedar3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Piutang Beredar",
                    data: {!! json_encode($gpiutangberedar3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_piutanglalai_1bulan3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Piutang Lalai 1-12 Bulan",
                    data: {!! json_encode($gpiutanglalai_1bulan3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_piutanglalai_12bulan3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Piutang Lalai > 12 Bulan",
                    data: {!! json_encode($gpiutanglalai_12bulan3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_dcr3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "DCR",
                    data: {!! json_encode($gdcr3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_dcu3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "DCU",
                    data: {!! json_encode($gdcu3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_totalpendapatan3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Total Pendapatan",
                    data: {!! json_encode($gtotalpendapatan3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_totalbiaya3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Total Biaya",
                    data: {!! json_encode($gtotalbiaya3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_shu3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "SHU",
                    data: {!! json_encode($gshu3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_totalanggota3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Total Anggota",
                    data: {!! json_encode($gtotalanggota3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_piutangbersih3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Piutang Bersih",
                    data: {!! json_encode($gpiutangbersih3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_rasioberedar3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Rasio Piutang Beredar",
                    data: {!! json_encode($grasioberedar3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
        var data_rasiolalai3 = {
            labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
            datasets: [
                {
                    label: "Rasio Piutang Lalai",
                    data: {!! json_encode($grasiolalai3,JSON_NUMERIC_CHECK) !!},
                    fill: false
                }
            ]
        };
    @endif
    @if(!Request::is('admins/laporancu/index_bkcu')) 
    var data_p1 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "P1",
                data: {!! json_encode($gp1,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_p2 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "P2",
                data: {!! json_encode($gp2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_e1 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "E1",
                data: {!! json_encode($ge1,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_e5 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "E5",
                data: {!! json_encode($ge5,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_e6 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "E6",
                data: {!! json_encode($ge6,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_e9 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "E9",
                data: {!! json_encode($ge9,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_a1 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "A1",
                data: {!! json_encode($ga1,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_a2 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "A2",
                data: {!! json_encode($ga2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_r7 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "R7",
                data: {!! json_encode($gr7,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_r9 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "R9",
                data: {!! json_encode($gr9,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_l1 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "L1",
                data: {!! json_encode($gl1,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_s10 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "S10",
                data: {!! json_encode($gs10,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_s11 = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "S11",
                data: {!! json_encode($gs11,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    @endif
</script>