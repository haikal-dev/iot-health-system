<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Patient Name</th>
                    <th>Requested At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <requests_lists v-for="(data, index) in patients" :patient="data" :id="index + 1" :key="index"
                    v-on:review="(id) => { $emit('review', id) }" />
            </tbody>
        </table>
    </div>

</template>

<script>
import axios from 'axios';
import requests_lists from './requests-lists.vue';

export default {
    props: ['patients'],
    components: {
        requests_lists
    },

    data() {
        return {
            // patients: [],
        }
    },

    methods: {
        //
    }
}
</script>