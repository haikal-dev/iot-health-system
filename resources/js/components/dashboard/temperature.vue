<template>
    <small class="text-nowrap fw-semibold">
        <i class='bx bxs-thermometer'></i> {{ sensors.temp ? sensors.temp : 0 }} &#8451;</small>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            sensors: []
        }
    },

    created(){
        this.fetchTemp();
    },

    methods: {
        fetchTemp(){
            setInterval(() => {
                axios.get('/v2/temp')
                .then((res) => {
                    // console.log(res);
                    if(res.status == 200 && res.data.success){
                        this.sensors = res.data;
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