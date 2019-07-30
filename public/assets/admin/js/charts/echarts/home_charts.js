$(function () {

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'assets/admin/js/plugins/visualization/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/pie',
            'echarts/chart/funnel',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

            // var user_pie = ec.init(document.getElementById('user_pie'), limitless);
            var trans_column = ec.init(document.getElementById('trans_column'), limitless);


            // Charts setup
            // ------------------------------

            //
            // User pie options
            //

            user_pie_options = {

                // Add title
                title: {
                    text: 'Pengguna',
                    subtext: 'Pengguna Senapati',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    position: [100],
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['Member', 'Agen']
                },

                // Add series
                series: [{
                    name: 'Pengguna',
                    type: 'pie',
                    radius: '50%',
                    center: ['50%', '70%'],
                    data: [
                        {value: 335, name: 'Member'},
                        {value: 310, name: 'Agen'}
                    ]
                }]
            };

            //
            // Basic columns options
            //

            trans_column_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Booking', 'Konfirmasi', 'Profit']
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Booking',
                        type: 'bar',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                    {
                        name: 'Konfirmasi',
                        type: 'bar',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                    {
                        name: 'Profit',
                        type: 'bar',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    }
                ]
            };

            // Apply options
            // ------------------------------

            var monthData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            var loadBookingChart = function () {
                $.ajax({
                    url: chartBookingURL + '?type=' + $('#select_type').val() + '&year=' + $('#select_year').val()
                }).done(function(data) {
                    $.each(data, function(i, chartData) {
                        monthData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        $.each(chartData, function(j, item) {
                            monthData[j-1] = item;
                        })
                        trans_column_options.series[i].data = monthData;
                    })

                    trans_column.setOption(trans_column_options);
                });
            }

            loadBookingChart();

            $('#select_type, #select_year').on('change', function(){
              $(this).closest('.heading-elements').find('a[data-action=reload]').click();
              loadBookingChart();
            });

            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    // user_pie.resize();
                    trans_column.resize();
                }, 200);
            }
        }
    );
});
