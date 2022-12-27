<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <approved_lists
                    v-for="(patient, index) in patients"
                    :patient="patient"
                    :key="index"
                    :id="index+1" />
            </tbody>
        </table>
    </div>
</template>

<script>
import approved_lists from './approved_lists.vue';

export default {
    components: {
        approved_lists
    },

    data(){
        return {
            patients: []
        }
    },

    created() {
        this.fetch_patients();
    },

    methods: {
        fetch_patients(){
            axios.get('/v2/patient?data=approved')
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