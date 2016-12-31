<script>
    var data_l_biasa3 = {
        labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_l_lbiasa3 = {
        labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_p_biasa3 = {
        labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }

        ]
    };
    var data_p_lbiasa3 = {
        labels: {!! json_encode($gperiode3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa3,JSON_NUMERIC_CHECK) !!},
                fill: false
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
</script>

<script>
    var config3 = {
        @if(Request::is('admins/laporancu'))
            type: 'bar',
        @else
            type: 'line',
        @endif
        data: data_totalanggota3,
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

    $.each(config3.data.datasets, function(i, dataset) {
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
        $('#chart_select3').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id == "l_biasa") { // require a URL
                config3.data = data_l_biasa3;
            }else if(id == "l_lbiasa"){
                config3.data = data_l_lbiasa3;
            }else if(id =="p_biasa"){
                config3.data = data_p_biasa3;
            }else if(id =="p_lbiasa"){
                config3.data = data_p_lbiasa3;
            }else if(id =="totalanggota"){
                config3.data = data_totalanggota3;
            }else if(id =="kekayaan"){
                config3.data = data_kekayaan3;
            }else if(id =="aktivalancar"){
                config3.data = data_aktivalancar3;
            }else if(id =="simpanansaham"){
                config3.data = data_simpanansaham3;
            }else if(id =="nonsaham_unggulan"){
                config3.data = data_nonsaham_unggulan3;
            }else if(id =="nonsaham_harian"){
                config3.data = data_nonsaham_harian3;
            }else if(id =="hutangspd"){
                config3.data = data_hutangspd3;
            }else if(id =="piutangberedar"){
                config3.data = data_piutangberedar3;
            }else if(id =="piutanglalai_1bulan"){
                config3.data = data_piutanglalai_1bulan3;
            }else if(id =="piutanglalai_12bulan"){
                config3.data = data_piutanglalai_12bulan3;
            }else if(id =="dcr"){
                config3.data = data_dcr3;
            }else if(id =="dcu"){
                config3.data = data_dcu3;
            }else if(id =="totalpendapatan"){
                config3.data = data_totalpendapatan3;
            }else if(id =="totalbiaya"){
                config3.data = data_totalbiaya3;
            }else if(id =="shu"){
                config3.data = data_shu3;
            }else if(id =="piutangbersih"){
                config3.data = data_piutangbersih3;
            }else if(id =="rasioberedar"){
                config3.data = data_rasioberedar3;
            }else if(id =="rasiolalai"){
                config3.data = data_rasiolalai3;
            }
            $.each(config3.data.datasets, function(i, dataset) {
                dataset.borderColor = "rgba(75,192,192,0.4)";
                dataset.backgroundColor = "rgba(75,192,192,1)";
                dataset.pointBorderColor = "rgba(75,192,192,1)";
                dataset.pointBackgroundColor = "#fff";
                dataset.pointBorderWidth = 1;
                dataset.pointHoverBackgroundColor = "rgba(75,192,192,1)";
                dataset.pointHoverBorderColor = "rgba(220,220,220,1)";
                dataset.pointHoverBorderWidth = 2;
                dataset.pointRadius = 5;
                dataset.pointHitRadios = 10;
            });
            window.chart3.update();
            return false;
        });
    });    
</script>