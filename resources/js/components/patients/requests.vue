<template>
    <div>
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
                        v-on:review="(id) => { review(id) }" />
                </tbody>
            </table>
        </div>
        <div v-if="dialog" class="modal fade show" tabindex="-1" aria-hidden="false" style="display: block;"
            aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">{{ patient.name }}</h5>
                        <button type="button" class="btn-close" aria-label="Close" @click="dialogBox()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="approve()">Approve</button>
                        <button type="button" class="btn btn-outline-secondary" @click="dialogBox()">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
import requests_lists from './requests-lists.vue';

export default {
    components: {
        requests_lists
    },

    data() {
        return {
            patients: [],
            patient: [],
            dialog: false
        }
    },

    created() {
        this.fetch_patients();
    },

    methods: {
        fetch_patients() {
            axios.get('/v2/patient')
                .then((res) => {
                    // console.log(res);
                    if (res.status == 200) {
                        if (res.data.status) {
                            this.patients = res.data.patients;
                        }
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        review(id) {
            axios.get('/v2/patient/id/' + id)
                .then((res) => {
                    // console.log(res);
                    if (res.data.status) {
                        this.patient = res.data.patient;
                        this.dialogBox();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        dialogBox() {
            this.dialog = !this.dialog;
        },

        approve() {
            //
        }
    }
}
</script>