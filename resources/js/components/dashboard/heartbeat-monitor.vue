<template>
    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
        <div v-if="heartbeat.value > 0" class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
            <div class="card-title">
                <h5 class="text-nowrap mb-2">Heartbeat Sensor Activity</h5>
                <span class="badge bg-label-warning rounded-pill">Updated {{ heartbeat.created_at }}</span>
            </div>
            <div class="mt-sm-auto">
                <small :class="[(heartbeat.graph.status == 'increase' ? 'text-success' : 'text-danger'), 'text-nowrap', 'fw-semibold']">
                    <i :class="['bx', (heartbeat.graph.status == 'increase') ? 'bx-chevron-up' : 'bx-chevron-down']"></i> {{ heartbeat.graph.percent }} %</small>
                <h3 class="mb-0">{{ heartbeat.value }} bpm</h3>
            </div>
        </div>
        <div v-else class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
            <div class="card-title">
                <h5 class="text-nowrap mb-2">Heartbeat Sensor Activity</h5>
            </div>
            <div class="mt-sm-auto">
                <h3 v-if="data_not_null">Initializing...</h3>
                <h3 v-else>No live record</h3>
            </div>
        </div>
        <div id="profileReportChart"></div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            data_not_null: true,
            heartbeat: {
                graph: {
                    status: 'increase',
                    percentage: '0'
                },
                value: 'initialize...'
            }
        }
    },

    created(){
        this.fetchHeartbeat();
    },

    methods: {
        fetchHeartbeat(){
            setInterval(() => {
                axios.get('/v2/fetchHeartbeat')
                .then((res) => {
                    if(res.data.heartbeat.graph == 0){
                        this.data_not_null = false;
                    }

                    else {
                        this.heartbeat = res.data.heartbeat;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }, 5000);
        }
    }
}
</script>