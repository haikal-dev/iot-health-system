<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Patient Name</th>
                    <th>Requested At</th>
                </tr>
            </thead>
            <tbody>
                <requests_lists
                    v-for="(data, index) in patients"
                    :patient="data"
                    :id="index+1"
                    :key="index" />
            </tbody>
            
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import requests_lists from './requests-lists.vue';

export default {
    components: {
        requests_lists
    },

    data(){
        return {
            patients: []
        }
    },

    created(){
        this.fetch_patients();
    },

    methods: {
        fetch_patients(){
            axios.get('/v2/patient')
            .then((res) => {
                // console.log(res);
                if(res.status == 200){
                    if(res.data.status){
                        this.patients = res.data.patients;
                    }
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }
    }
}
</script>