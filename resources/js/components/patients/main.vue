<template>
    <div>
        <div v-if="page == 'index'" class="nav-align-top mb-4">
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
                    <patient_list :patients="request_patients" v-on:patient_info="(id) => { patient_info(id) }" v-on:datachanged="reload_data_changed()" />
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <patient_requests :patients="patients" v-on:review="(id) => { review_request_patient(id) }" />
                </div>
            </div>
        </div>
        
        <patientDetails v-else-if="page == 'patientDetails'" :id="patient_dashboard.id" v-on:monitor="monitor_patient()" />
        
        <patientDashboard v-else-if="page == 'patient-dashboard'"
        :patient_id="patient_dashboard.id" />

        <div v-if="dialog" class="modal fade show" tabindex="-1" aria-hidden="false" style="display: block;"
            aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Patient Informations</h5>
                        <button type="button" class="btn-close" aria-label="Close" @click="dialogBox()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input class="form-control" type="text" v-model="patient.name" disabled />
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Identity Card No.</label>
                                            <input class="form-control" type="number" v-model="patient.ic_no"
                                                disabled />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Age</label>
                                            <input class="form-control" type="number" v-model="patient.age" disabled />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Mobile No</label>
                                            <input class="form-control" type="number" v-model="patient.hp_no"
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Address</label>
                                    <textarea class="form-control" style="height: 100px;" v-model="patient.address"
                                        disabled></textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Diabetes</label>
                                            <br />
                                            <input type="radio" v-model="patient.diabetes" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.diabetes" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">High Blood Pressure</label>
                                            <br />
                                            <input type="radio" v-model="patient.hbpressure" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.hbpressure" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Asthma</label>
                                            <br />
                                            <input type="radio" v-model="patient.asthma" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.asthma" value="YES" /> Yes
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Had Operation?</label>
                                            <br />
                                            <input type="radio" v-model="patient.do_operation" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.do_operation" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Fever?</label>
                                            <br />
                                            <input type="radio" v-model="patient.fever" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.fever" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Cough?</label>
                                            <br />
                                            <input type="radio" v-model="patient.cough" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.cough" value="Dry Cough" /> Dry Cough
                                            <br />
                                            <input type="radio" v-model="patient.cough" value="Cough With Mucus" /> Cough With Mucus
                                            <br />
                                            <input type="radio" v-model="patient.cough" value="Normal Cough" /> Normal Cough
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Shortness Of Breath?</label>
                                            <br />
                                            <input type="radio" v-model="patient.shortness_breath" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.shortness_breath" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Fatique</label>
                                            <br />
                                            <input type="radio" v-model="patient.fatique" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.fatique" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Body Aches</label>
                                            <br />
                                            <input type="radio" v-model="patient.body_aches" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.body_aches" value="YES" /> Yes
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Loss of Smell / Taste</label>
                                            <br />
                                            <input type="radio" v-model="patient.loss_taste" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.loss_taste" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Sore Throats</label>
                                            <br />
                                            <input type="radio" v-model="patient.sore_throats" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.sore_throats" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Diarrhea</label>
                                            <br />
                                            <input type="radio" v-model="patient.diarrhea" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.diarrhea" value="YES" /> Yes
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Nausea or Vomitting</label>
                                            <br />
                                            <input type="radio" v-model="patient.nausea_vomitting" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.nausea_vomitting" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">How many days you have been sick?</label>
                                            <br />
                                            <input type="radio" v-model="patient.day_sick" value="Less than 7 days" /> Less than 7 days
                                            <br />
                                            <input type="radio" v-model="patient.day_sick" value="More than 7 days" /> More than 7 days
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Heart Diseases</label>
                                            <br />
                                            <input type="radio" v-model="patient.heart_diseases" value="NO" /> No
                                            <br />
                                            <input type="radio" v-model="patient.heart_diseases" value="YES" /> Yes
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="">Other diseases</label>
                                        <textarea class="form-control" style="height: 100px;" v-model="patient.other_diseases" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="approve()">Approve</button>
                        <!-- <button type="button" class="btn btn-outline-secondary" @click="dialogBox()">
                            Remove
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import patient_list from './lists.vue';
import patient_requests from './requests.vue';
import patientDetails from './details.vue';
import patientDashboard from './patient_dashboard.vue';

export default {
    components: {
        patient_list, 
        patient_requests,
        patientDetails,
        patientDashboard
    },

    data() {
        return {
            dialog: false,
            patient: [],
            patients: [],
            request_patients: [],
            page: 'index',
            patient_dashboard: {
                id: ''
            }
        }
    },

    created() {
        this.fetch_patients();
        this.fetch_request_patients();
    },

    methods: {
        monitor_patient(){
            this.page = 'patient-dashboard';
        },

        fetch_request_patients() {
            axios.get('/v2/patient?data=approved')
                .then((res) => {
                    // console.log(res);
                    if (res.status == 200) {
                        if (res.data.status) {
                            this.request_patients = res.data.patients;
                        }
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        reload_data_changed(){
            this.fetch_request_patients();
        },

        patient_info(id){
            this.patient_dashboard.id = id;
            this.page = 'patientDetails';
        },

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

        dialogBox() {
            this.dialog = !this.dialog;
        },

        review_request_patient(id) {
            axios.get('/v2/patient/id/' + id)
                .then((res) => {
                    // console.log(res);
                    if (res.data.status) {
                        this.patient = res.data.patient;
                        this.updateAge();
                        this.dialogBox();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        updateAge(){
            let date = new Date();
            let current_year = date.getFullYear();

            let pattern = "\\d{6}\\d{2}\\d{4}$";
            let result = this.patient.ic_no.match(pattern);
            if(result == null || this.patient.ic_no.length > 12){
                this.patient.age = 0;
                return;
            }

            let pattern_age = /^(\d{1,2})/;
            let result_age = this.patient.ic_no.match(pattern_age);
            let year = 0;
            let age = 0;

            let limiter = Math.ceil(current_year.toString().match(/\d{2}$/)[0]);

            if(result_age[0] > limiter){
                year = 1900 + Math.ceil(result_age[0]);
                age = current_year - year;
            }

            else {
                year = 2000 + Math.ceil(result_age[0]);
                age = current_year - year;
            }

            this.patient.age = age;
        },

        dialogBox() {
            this.dialog = !this.dialog;
        },

        approve() {
            let msg = confirm("Are you sure want to approve this patient?");

            if (msg) {
                // console.log('approved');
                axios.put('/v2/patient/id/' + this.patient.id, {
                    api: 'approve'
                })
                .then((res) => {
                    if(res.data.status){
                        // console.log(res);
                        this.fetch_patients();
                        this.fetch_request_patients();
                        this.dialogBox();
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