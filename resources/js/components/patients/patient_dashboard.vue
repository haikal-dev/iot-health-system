<template>
    <div>
        <div class="row">
            <div class="col-md-6 col-lg-6 order-1 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="patient-info"><small>NAME</small><br/>{{ patient.name }}</div>
                        <div class="patient-info"><small>IDENTITY CARD</small><br/>{{ patient.ic_no }}</div>
                        <div class="patient-info"><small>TELEGRAM ID</small><br/>{{ patient.telegram_id }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 order-1 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>TEMPERATURE ANALYSIS</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div v-if="!temperature.render" style="margin: 10px 20px;">
                                    Rendering data...
                                </div>
                                <div v-else>
                                    <div v-if="temperature.data.temp.length > 0" id="tempChart"></div>
                                    <div v-else>
                                        <div class="alert alert-info text-primary" style="margin: 10px 20px;">No data is
                                            available.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>HEARTBEAT ANALYSIS</h4>
                    </div>
                    <div class="card-body px-0">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <div v-if="!chart_has_render" style="margin: 10px 20px;">
                                    Rendering data...
                                </div>
                                <div v-else>
                                    <div v-if="sensor.hr && sensor.hr.length > 0" id="incomeChart"></div>
                                    <div v-else>
                                        <div class="alert alert-info text-primary" style="margin: 10px 20px;">No data is
                                            available.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['patient_id'],

    data() {
        return {
            sensor: [],
            chart_has_render: false,
            patient: [],
            temperature: {
                data: [],
                render: false
            }
        }
    },

    created() {
        this.fetch_patient_detail();
        this.fetch_patient_dashboard();
        this.fetch_patient_temperature();
    },

    methods: {
        fetch_patient_detail() {
            axios.get('/v2/patient/id/' + this.patient_id)
                .then((res) => {
                    // console.log(res);
                    if (res.data.status) {
                        this.patient = res.data.patient;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        fetch_patient_temperature(){
            setInterval(() => {
                axios.get('/v2/charts/temperature/id/' + this.patient_id)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.status) {
                            this.temperature.data = res.data.response;
                            if (!this.temperature.render) {
                                this.render_temperature_chart();
                                this.temperature.render = true;
                            }
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }, 5000);
        },

        render_temperature_chart(){
            let vm = this;

            window.$(function () {
                let cardColor, headingColor, axisColor, shadeColor, borderColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;

                const tempChartEl = document.querySelector('#tempChart'),
                    tempChartConfig = {
                        series: [
                            {
                                data: vm.temperature.data.temp,
                                name: 'Temperature (degree celcius)'
                            }
                        ],
                        chart: {
                            height: 150,
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
                            categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
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
                            max: 100,
                            tickAmount: 4
                        }
                    };
                if (typeof tempChartEl !== undefined && tempChartEl !== null) {
                    const tempChart = new ApexCharts(tempChartEl, tempChartConfig);
                    tempChart.render();

                    // console.log('chart created!');

                    setInterval(() => {
                        tempChart.updateSeries([
                            {
                                data: vm.temperature.data.temp
                            }
                        ]);
                        // console.log('chart updated!');
                    }, 1000);
                }
            });
        },

        fetch_patient_dashboard() {
            setInterval(() => {
                axios.get('/v2/charts/heartbeat/id/' + this.patient_id)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.success) {
                            this.sensor = res.data.response;
                            if (!this.chart_has_render) {
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
                                data: vm.sensor.hr,
                                name: 'HeartBeat (bpm)'
                            },
                            {
                                data: vm.sensor.spo,
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
                            categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
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
                                data: vm.sensor.hr
                            },
                            {
                                data: vm.sensor.spo
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

<style scoped>
.patient-info {
    margin-bottom: 10px;
    font-weight: bold;
    font-size: 1.2rem;
}

.patient-info small {
    font-size: 0.7rem;
    color: blue;
}
</style>