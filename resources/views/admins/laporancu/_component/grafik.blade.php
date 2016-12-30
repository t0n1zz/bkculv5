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
        data: data_l_biasa,
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

    @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*'))  
        var config2 = {
            type: 'bar',
            data: data_l_biasa2,
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
        var config3 = {
            type: 'bar',
            data: data_l_biasa3,
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
    @elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
        var config3 = {
            type: 'line',
            data: data_l_biasa3,
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
    @endif

    @if(!Request::is('admins/laporancu/index_bkcu')) 
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
    @endif

    window.onload = function() {
        var ctx = document.getElementById("chart").getContext("2d");
        window.chart = new Chart(ctx, config);

        @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*')) 
            var ctx2 = document.getElementById("chart2").getContext("2d");
            var ctx3 = document.getElementById("chart3").getContext("2d");
            window.chart2 = new Chart(ctx2, config2);
            window.chart3 = new Chart(ctx3, config3);
        @elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
            var ctx3 = document.getElementById("chart3").getContext("2d");
            window.chart3 = new Chart(ctx3, config3);    
        @endif
        
        @if(!Request::is('admins/laporancu/index_bkcu'))
            var ctx4 = document.getElementById("chart4").getContext("2d");
            window.chart4 = new Chart(ctx4, config4);
        @endif
    };
</script>