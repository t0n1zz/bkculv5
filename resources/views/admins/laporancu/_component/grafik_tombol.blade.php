<script>
    $(function(){
        // bind change event to select
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
        @if(!Request::is('admins/laporancu/index_cu/*'))
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
        @endif
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
</script>