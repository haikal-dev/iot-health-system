<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Registered At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <approved_lists
                    v-for="(patient, index) in patients"
                    :patient="patient"
                    :key="index"
                    :id="index+1"
                    v-on:patient_info="(id) => { $emit('patient_info', id) }"
                    v-on:datachanged="$emit('datachanged')" />
            </tbody>
        </table>
    </div>
</template>

<script>
import approved_lists from './approved_lists.vue';

export default {
    props: ['patients'],

    components: {
        approved_lists
    },

    data(){
        return {
            // patients: []
        }
    },

    methods: {
        //
    }
}
</script>