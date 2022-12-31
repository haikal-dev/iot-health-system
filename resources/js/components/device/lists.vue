<template>
    <div>
        <h3>Device Management System</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Device Serial No.</th>
                        <th>Pairing with</th>
                        <th>Updated At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <device_detail v-for="(device, index) in devices" :device="device" :key="index" :id="index + 1" v-on:pair="(id) => { pair(id) }" v-on:unpair="(id) => { reset_pairing(id) }" />
                </tbody>
            </table>
        </div>
        <div v-if="dialog" class="modal fade show" tabindex="-1" aria-hidden="false" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Device Pairing: {{ device.serial_number }}</h5>
                        <button type="button" class="btn-close" aria-label="Close" @click="dialogBox()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Patient</label>
                                <select class="form-control" v-model="dialog_form.patient_id">
                                    <option value="0">Please select patient to pair with...</option>
                                    <option v-for="(p, i) in patients" :value="p.id" :key="i">{{ p.name }} [{{ p.ic_no }}]</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" @click="dialogBox()">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary" @click="start_pairing()">Start Pairing</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import device_detail from './device.vue';

export default {
    components: {
        device_detail
    },
    data() {
        return {
            devices: [],
            dialog: false,
            device: [],
            dialog_form: {
                patient_id: 0
            },
            patients: []
        }
    },

    created() {
        this.fetch_device_lists();
    },

    methods: {
        fetch_device_lists() {
            axios.get('/v2/device')
                .then((res) => {
                    // console.log(res);
                    if (res.status == 200) {
                        this.devices = res.data.devices;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        dialogBox(){
            this.dialog = !this.dialog;
        },

        pair(id){
            // console.log(id);
            axios.get('/v2/device/id/' + id)
            .then((res) => {
                // console.log(res);
                if(res.status == 200){
                    this.fetch_patient_lists();
                    this.device = res.data.device;
                    this.dialogBox();
                }
            })
            .catch((err) => {
                console.log(err);
            });
        },

        reset_pairing(id){
            let msg = confirm("Are you sure want to unpair this device?");

            if(msg){
                axios.put('/v2/device/id/' + id, {
                    pairing_id: ''
                })
                .then((res) => {
                    if(res.data.status){
                        this.fetch_device_lists();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }
        },

        start_pairing(){
            var msg = confirm("Are you sure want to pair the device with this patient?");

            if(msg){
                if(this.dialog_form.patient_id == 0){
                    alert("Patient name are required!");
                    return;
                }


                // console.log(this.device);
                axios.put('/v2/device/id/' + this.device.id, {
                    pairing_id: this.dialog_form.patient_id
                })
                .then((res) => {
                    if(res.data.status){
                        this.fetch_device_lists();
                        this.dialogBox();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }
        },

        fetch_patient_lists(){
            axios.get('/v2/patient?data=approvedHasTelegram')
            .then((res) => {
                // console.log(res);
                this.patients = res.data.patients;
            })
            .catch((err) => {
                console.log(err);
            });
        }
    }
}
</script>