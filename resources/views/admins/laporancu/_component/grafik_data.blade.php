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

<script>
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };
    var config = {
        @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
            type: 'bar',
        @else
            type: 'line',
        @endif
        data: data_totalanggota,
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

    $.each(config.data.datasets, function(i, dataset) {
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
        $('#chart_select').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id == "l_biasa") { // require a URL
                config.data = data_l_biasa;
            }else if(id == "l_lbiasa"){
                config.data = data_l_lbiasa;
            }else if(id =="p_biasa"){
                config.data = data_p_biasa;
            }else if(id =="p_lbiasa"){
                config.data = data_p_lbiasa;
            }else if(id =="totalanggota"){
                config.data = data_totalanggota;
            }else if(id =="kekayaan"){
                config.data = data_kekayaan;
            }else if(id =="aktivalancar"){
                config.data = data_aktivalancar;
            }else if(id =="simpanansaham"){
                config.data = data_simpanansaham;
            }else if(id =="nonsaham_unggulan"){
                config.data = data_nonsaham_unggulan;
            }else if(id =="nonsaham_harian"){
                config.data = data_nonsaham_harian
            }else if(id =="hutangspd"){
                config.data = data_hutangspd
            }else if(id =="aset"){
                config.data = data_aset   
            }else if(id =="piutangberedar"){
                config.data = data_piutangberedar;
            }else if(id =="piutanglalai_1bulan"){
                config.data = data_piutanglalai_1bulan;
            }else if(id =="piutanglalai_12bulan"){
                config.data = data_piutanglalai_12bulan;
            }else if(id =="dcr"){
                config.data = data_dcr;
            }else if(id =="dcu"){
                config.data = data_dcu;
            }else if(id =="totalpendapatan"){
                config.data = data_totalpendapatan;
            }else if(id =="totalbiaya"){
                config.data = data_totalbiaya;
            }else if(id =="shu"){
                config.data = data_shu;
            }else if(id =="piutangbersih"){
                config.data = data_piutangbersih;
            }else if(id =="rasioberedar"){
                config.data = data_rasioberedar;
            }else if(id =="rasiolalai"){
                config.data = data_rasiolalai;
            }
            $.each(config.data.datasets, function(i, dataset) {
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
            window.chart.update();
            return false;
        });
    });
</script>