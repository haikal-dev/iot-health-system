<template>
    <tr>
        <td>{{ id }}</td>
        <td>{{ patient.name }}</td>
        <td>{{ patient.registered_at }}</td>
        <td>
            <button class="btn btn-primary" title="View Informations" @click="info()">
                <i class='bx bxs-file'></i>
            </button>
            &nbsp;
            <button class="btn btn-danger" title="Remove Patient" @click="remove()">
                <i class="bx bx-trash"></i>
            </button>
        </td>
    </tr>
</template>

<script>
import axios from 'axios';

export default {
    props: ['patient', 'id'],

    methods: {
        info(){
            this.$emit('patient_info', this.patient.id);
        },

        remove(){
            let msg = confirm("Are you sure want to remove this patient and its database?");

            if(msg){
                axios.delete('/v2/patient/id/' + this.patient.id)
                .then((res) => {
                    // console.log(res);
                    if(res.data.status){
                        this.$emit('datachanged');
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }
        }
    }
}
</script>