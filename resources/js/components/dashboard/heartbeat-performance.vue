<template>
    <!-- Expense Overview -->
    <div class="col-md-12 col-lg-12 order-1 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h4>HEARTBEAT PERFORMANCES</h4>
            </div>
            <div class="card-body px-0">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                        <div v-if="sensor.sensor_value && sensor.sensor_value.length > 0" id="incomeChart"></div>
                        <div v-else>
                            <div class="alert alert-info text-primary" style="margin: 10px 20px;">No data is available.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Expense Overview -->
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            sensor: [],
            chart_has_render: false
        }
    },
    created() {
        this.fetchHeartbeatPerformances();
    },

    methods: {
        fetchHeartbeatPerformances(){
            setInterval(() => {
                axios.get('/v2/charts/heartbeat')
                .then((res) => {
                    // console.log(res);

                    if(res.status == 200 && res.data.success){
                        this.sensor = res.data.response;
                        if(!this.chart_has_render){
                            this.renderChart();
                            this.chart_has_render = true;
                        }
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }, 5000);

            
        },

        renderChart() {

            let vm = this;

            window.$(function () {
                let cardColor, headingColor, axisColor, shadeColor, borderColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;

                const incomeChartEl = document.querySelector('#incomeChart'),
                    incomeChartConfig = {
                        series: [
                            {
                                data: vm.sensor.sensor_value,
                                name: 'HeartBeat (bpm)'
                            },
                            {
                                data: vm.sensor.spo_value,
                                name: 'SPO2 (%)'
                            }
                        ],
                        chart: {
                            height: 215,
                            parentHeightOffset: 0,
                            parentWidthOffset: 0,
                            toolbar: {
                                show: false
                            },
                            type: 'area'
                        },
                        dataLabels: {
                            enabled: true
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth'
                        },
                        legend: {
                            show: true
                        },
                        markers: {
                            size: 6,
                            colors: 'transparent',
                            strokeColors: 'transparent',
                            strokeWidth: 4,
                            discrete: [
                                // {
                                //     fillColor: config.colors.white,
                                //     seriesIndex: 0,
                                //     dataPointIndex: 10,
                                //     strokeColor: config.colors.primary,
                                //     strokeWidth: 2,
                                //     size: 6,
                                //     radius: 8
                                // }
                            ],
                            hover: {
                                size: 7
                            }
                        },
                        colors: [config.colors.primary, config.colors.danger],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: shadeColor,
                                shadeIntensity: 0.6,
                                opacityFrom: 0.5,
                                opacityTo: 0.25,
                                stops: [0, 95, 1000]
                            }
                        },
                        grid: {
                            borderColor: borderColor,
                            strokeDashArray: 3,
                            padding: {
                                top: -20,
                                bottom: -8,
                                left: -10,
                                right: 8
                            }
                        },
                        xaxis: {
                            categories: [1,2,3,4,5,6,7,8,9,10],
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                show: true,
                                style: {
                                    fontSize: '13px',
                                    colors: axisColor
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                show: true
                            },
                            min: 10,
                            max: 200,
                            tickAmount: 4
                        }
                    };
                if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
                    const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
                    incomeChart.render();

                    // console.log('chart created!');
                    
                    setInterval(() => {
                        incomeChart.updateSeries([
                            {
                                data: vm.sensor.sensor_value
                            },
                            {
                                data: vm.sensor.spo_value
                            }
                        ]);
                        // console.log('chart updated!');
                    }, 1000);
                }
            });

        }
    }
}
</script>