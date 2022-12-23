<template>
    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
            <div class="card-title">
                <h5 class="mb-2">Wireless Monitoring</h5>
                <span v-if="network_status == 'ready'" class="badge bg-label-warning rounded-pill"><i class="bx bx-time"></i> {{ network_update }}</span>
            </div>
            <div v-if="network_status == 'ready'" class="mt-sm-auto">
                <small class="fw-semi-bold"><i class="bx bx-wifi"></i> {{ network_ssid }}</small>
                    
                <h3 class="mb-0">{{ network_ip_addr }}</h3>
            </div>
            <div v-else-if="network_status == 'init'" align="center">
                Fetching wireless network...
            </div>
            <div v-else-if="network_status == 'empty'">
                Wireless information not found.
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            network_status: 'init',
            network_ssid: '',
            network_ip_addr: '',
            network_update: ''
        }
    },

    created(){
        this.initWifi();
    },

    methods: {
        initWifi(){
            setInterval(() => {
                axios.get('/v2/wifi')
                .then((res) => {
                    console.log(res);
                    if(res.status == 200){
                        if(!res.data.wifi.ssid){
                            this.network_status = 'empty';
                        }

                        else {
                            this.network_ssid = res.data.wifi.ssid;
                            this.network_ip_addr = res.data.wifi.ip_address;
                            this.network_update = res.data.wifi.created_at;
                            this.network_status = 'ready';
                        }
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