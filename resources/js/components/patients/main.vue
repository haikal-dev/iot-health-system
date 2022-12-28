<template>
    <div>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-patient-list" aria-controls="navs-patient-list" aria-selected="true">
                        Informations
                        <!-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span> -->
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                        aria-selected="false">
                        Requests
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-patient-list" role="tabpanel">
                    <patient_list />
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <patient_requests
                        v-on:review="(id) => { review_request_patient(id) }" />
                </div>
            </div>
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
import patient_list from './lists.vue';
import patient_requests from './requests.vue';

export default {
    components: {
        patient_list, patient_requests
    },

    data() {
        return {
            dialog: false,
            patient: []
        }
    },

    methods: {
        dialogBox() {
            this.dialog = !this.dialog;
        },

        review_request_patient(id) {
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