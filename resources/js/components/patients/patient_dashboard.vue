<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="title">Patient Information</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input :disabled="form_disabled" class="form-control" type="text" v-model="patient.name" />
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Age</label>
                                    <input :disabled="form_disabled" class="form-control" type="number" v-model="patient.age" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Identity Card No.</label>
                                    <input :disabled="form_disabled" class="form-control" type="number" v-model="patient.ic_no" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Mobile No.</label>
                                    <input :disabled="form_disabled" class="form-control" type="number" v-model="patient.hp_no" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea :disabled="form_disabled" class="form-control textarea" v-model="patient.address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="title">Health Information</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="">Diabetes</label>
                                <br />
                                <input :disabled="form_disabled" type="radio" v-model="patient.diabetes" value="NO" /> No
                                <br/>
                                <input :disabled="form_disabled" type="radio" v-model="patient.diabetes" value="YES" /> Yes
                            </div>
                            <div class="col">
                                <label for="">High Blood Pressure</label>
                                <br />
                                <input :disabled="form_disabled" type="radio" v-model="patient.hbpressure" value="NO" /> No
                                <br/>
                                <input :disabled="form_disabled" type="radio" v-model="patient.hbpressure" value="YES" /> Yes
                            </div>
                            <div class="col">
                                <label for="">Asthma</label>
                                <br />
                                <input :disabled="form_disabled" type="radio" v-model="patient.asthma" value="NO" /> No
                                <br/>
                                <input :disabled="form_disabled" type="radio" v-model="patient.asthma" value="YES" /> Yes
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="">Had Operation</label>
                                <br />
                                <input :disabled="form_disabled" type="radio" v-model="patient.do_operation" value="NO" /> No
                                <br/>
                                <input :disabled="form_disabled" type="radio" v-model="patient.do_operation" value="YES" /> Yes
                            </div>
                            <div class="col-md-8">
                                <label for="">Any other diseases</label>
                                <textarea :disabled="form_disabled" class="form-control textarea" v-model="patient.other_diseases"></textarea>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="col" align="right">
                                <button v-if="!form_disabled" class="btn btn-primary" @click="save()">Save Changes</button>
                                <button v-if="form_disabled" class="btn btn-primary" @click="enable_edit()">Edit Patient</button>
                                <button v-else class="btn btn-danger" @click="enable_edit()">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],

    data() {
        return {
            patient: [],
            form_disabled: true
        }
    },

    created() {
        this.fetch_client();
    },

    methods: {
        fetch_client(){
            axios.get('/v2/patient/id/' + this.id)
            .then((res) => {
                if (res.data.status) {
                    // console.log(res.data.patient);
                    this.patient = res.data.patient;
                }
            })
            .catch((err) => {
                console.log(err);
            });
        },

        enable_edit(){
            if(this.patient.id !== undefined){
                this.form_disabled = !this.form_disabled;
            }
        },

        save(){
            axios.put('/v2/patient/id/' + this.patient.id, {
                api: 'update',
                name: this.patient.name,
                age: this.patient.age,
                ic_no: this.patient.ic_no,
                hp_no: this.patient.hp_no,
                address: this.patient.address,
                diabetes: this.patient.diabetes,
                hbpressure: this.patient.hbpressure,
                asthma: this.patient.asthma,
                do_operation: this.patient.do_operation,
                other_diseases: this.patient.other_diseases
            })
            .then((res) => {
                if(res.data.status){
                    this.enable_edit();
                    alert("Changes have been saved successfully.");
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }
    }
}
</script>

<style scoped>
.title {
    font-size: 1.5rem;
    font-weight: bold;
}

.dropdown-divider {
    margin: 0;
    padding: 0;
}

.textarea {
    height: 150px;
}
</style>