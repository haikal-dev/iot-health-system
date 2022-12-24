<template>
    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
        <div v-if="status == 'ready'" class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
            <div class="card-title">
                <h5 class="mb-2">Sensor Activity</h5>
                <span class="badge bg-label-warning rounded-pill"><i class="bx bx-time"></i> {{ sensors.created_at }}</span>
            </div>
            <div class="mt-sm-auto">
                <small class="text-nowrap fw-semibold">
                    <i class='bx bxs-heart'></i> {{ sensors.spo }} %</small>
                    <br/>
                <temperature />
                <h3 class="mb-0"><i class='bx bx-pulse'></i> {{ sensors.hr }} bpm</h3>
            </div>
        </div>
        <div v-else class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
            <div class="card-title">
                <h5 class="mb-2">Sensor Activity</h5>
            </div>
            <div class="mt-sm-auto">
                <p v-if="status == 'init'">Initializing...</p>
                <p v-else-if="status == 'empty'">No live record</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import temperature from './temperature.vue';

export default {
    components: {
        temperature
    },
    data(){
        return {
            status: 'init',
            sensors: []
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
                    if(!res.data.sensors.id){
                        this.status = 'empty';
                    }

                    else {
                        this.sensors = res.data.sensors;
                        this.status = 'ready';
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