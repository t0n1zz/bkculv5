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

<script>
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };

    var config2 = {
        type: 'bar',
        data: data_totalanggota2,
        options:{
            responsive: true,
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: ''
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        callback: function(value, index, values) {
                            if(parseInt(value) > 1000){
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            } else {
                                return value;
                            }
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                            return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
                        });
                    }
                }
            }
        }
    };

    $.each(config2.data.datasets, function(i, dataset) {
        dataset.borderColor = randomColor(0.4);
        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = "#fff";
        dataset.pointBorderWidth = 1;
        dataset.pointHoverBackgroundColor = randomColor(0.5);
        dataset.pointHoverBorderColor = randomColor(0.7);
        dataset.pointHoverBorderWidth = 2;
        dataset.pointRadius = 5;
        dataset.pointHitRadios = 10;
    });
</script>

<script>
    $(function(){
       $('#chart_select2').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id == "l_biasa") { // require a URL
                config2.data = data_l_biasa2;
            }else if(id == "l_lbiasa"){
                config2.data = data_l_lbiasa2;
            }else if(id =="p_biasa"){
                config2.data = data_p_biasa2;
            }else if(id =="p_lbiasa"){
                config2.data = data_p_lbiasa2;
            }else if(id =="totalanggota"){
                config2.data = data_totalanggota2;
            }else if(id =="kekayaan"){
                config2.data = data_kekayaan2;
            }else if(id =="aktivalancar"){
                config2.data = data_aktivalancar2;
            }else if(id =="simpanansaham"){
                config2.data = data_simpanansaham2;
            }else if(id =="nonsaham_unggulan"){
                config2.data = data_nonsaham_unggulan2;
            }else if(id =="nonsaham_harian"){
                config2.data = data_nonsaham_harian2;
            }else if(id =="hutangspd"){
                config2.data = data_hutangspd2;
            }else if(id =="piutangberedar"){
                config2.data = data_piutangberedar2;
            }else if(id =="piutanglalai_1bulan"){
                config2.data = data_piutanglalai_1bulan2;
            }else if(id =="piutanglalai_12bulan"){
                config2.data = data_piutanglalai_12bulan2;
            }else if(id =="dcr"){
                config2.data = data_dcr2;
            }else if(id =="dcu"){
                config2.data = data_dcu2;
            }else if(id =="totalpendapatan"){
                config2.data = data_totalpendapatan2;
            }else if(id =="totalbiaya"){
                config2.data = data_totalbiaya2;
            }else if(id =="shu"){
                config2.data = data_shu2;
            }else if(id =="piutangbersih"){
                config2.data = data_piutangbersih2;
            }else if(id =="rasioberedar"){
                config2.data = data_rasioberedar2;
            }else if(id =="rasiolalai"){
                config2.data = data_rasiolalai2;
            }
            $.each(config2.data.datasets, function(i, dataset) {
                dataset.borderColor = randomColor(0.4);
                dataset.backgroundColor = randomColor(0.5);
                dataset.pointBorderColor = randomColor(0.7);
                dataset.pointBackgroundColor = "#fff";
                dataset.pointBorderWidth = 1;
                dataset.pointHoverBackgroundColor = randomColor(0.5);
                dataset.pointHoverBorderColor = randomColor(0.7);
                dataset.pointHoverBorderWidth = 2;
                dataset.pointRadius = 5;
                dataset.pointHitRadios = 10;
            });
            window.chart2.update();
            return false;
        }); 
    });
</script>
