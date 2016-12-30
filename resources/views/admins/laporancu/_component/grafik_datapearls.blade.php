<script>
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
</script>

{{-- <script>
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };
    var config4 = {
        @if(!Request::is('admins/laporancu/index_cu/*'))
            type: 'bar',
        @else
            type: 'line',
        @endif
        data: data_p1,
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
    $.each(config4.data.datasets, function(i, dataset) {
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
    window.onload = function() {
        var ctx4 = document.getElementById("chart4").getContext("2d");
        window.chart4 = new Chart(ctx4, config4);
    };
    $(function(){
        $('#chart_select4').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id == "p1") { // require a URL
                config4.data = data_p1;
            }else if(id == "p2"){
                config4.data = data_p2;
            }else if(id =="e1"){
                config4.data = data_e1;
            }else if(id =="e5"){
                config4.data = data_e5;
            }else if(id =="e6"){
                config4.data = data_e6;
            }else if(id =="e9"){
                config4.data = data_e9;
            }else if(id =="a1"){
                config4.data = data_a1;
            }else if(id =="a2"){
                config4.data = data_a2;
            }else if(id =="r7"){
                config4.data = data_r7;
            }else if(id =="r9"){
                config4.data = data_r9;
            }else if(id =="l1"){
                config4.data = data_l1;
            }else if(id =="s10"){
                config4.data = data_s10;
            }else if(id =="s11"){
                config4.data = data_s11;
            }

            $.each(config4.data.datasets, function(i, dataset) {
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
            window.chart4.update();
            return false;
        });
    });
</script> --}}