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
                                    <input :disabled="form_disabled" class="form-control" type="text"
                                        v-model="patient.name" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Telegram ID</label>
                                    <input disabled class="form-control" type="text" v-model="patient.telegram_id" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Age</label>
                                    <input :disabled="form_disabled" class="form-control" type="number"
                                        v-model="patient.age" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Identity Card No.</label>
                                    <input :disabled="form_disabled" @change="verifyIC()" class="form-control" type="number"
                                        v-model="patient.ic_no" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Mobile No.</label>
                                    <input :disabled="form_disabled" class="form-control" type="number"
                                        v-model="patient.hp_no" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea :disabled="form_disabled" class="form-control textarea"
                                        v-model="patient.address"></textarea>
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
                                <div class="form-group mb-3">
                                    <label for="">Diabetes</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.diabetes" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.diabetes" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">High Blood Pressure</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.hbpressure" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.hbpressure" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Asthma</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.asthma" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.asthma" value="YES" /> Yes
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Had Operation?</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.do_operation" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.do_operation" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Fever?</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.fever" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.fever" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Cough?</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.cough" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.cough" value="Dry Cough" /> Dry Cough
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.cough" value="Cough With Mucus" /> Cough With
                                    Mucus
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.cough" value="Normal Cough" /> Normal Cough
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Shortness Of Breath?</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.shortness_breath" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.shortness_breath" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Fatique</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.fatique" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.fatique" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Body Aches</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.body_aches" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.body_aches" value="YES" /> Yes
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Loss of Smell / Taste</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.loss_taste" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.loss_taste" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Sore Throats</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.sore_throats" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.sore_throats" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Diarrhea</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.diarrhea" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.diarrhea" value="YES" /> Yes
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Nausea or Vomitting</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.nausea_vomitting" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.nausea_vomitting" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">How many days you have been sick?</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.day_sick" value="Less than 7 days" /> Less than
                                    7 days
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.day_sick" value="More than 7 days" /> More than
                                    7 days
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Heart Diseases</label>
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.heart_diseases" value="NO" /> No
                                    <br />
                                    <input :disabled="form_disabled" type="radio" v-model="patient.heart_diseases" value="YES" /> Yes
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Other diseases</label>
                                <textarea :disabled="form_disabled" class="form-control" style="height: 100px;" v-model="patient.other_diseases"></textarea>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="col">
                                <button v-if="!form_disabled" class="btn btn-primary" @click="save()">Save
                                    Changes</button>
                                <button v-if="form_disabled" class="btn btn-warning" @click="monitor()">Monitor</button>
                                <button v-if="form_disabled" class="btn btn-info" @click="message()">Message</button>
                                <button v-if="form_disabled" class="btn btn-primary" @click="enable_edit()">Edit
                                    Patient</button>
                                <button v-else class="btn btn-danger" @click="enable_edit()">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!textbox_message.disabled" class="modal fade show" tabindex="-1" aria-hidden="false" style="display: block;"
            aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">SECURE MESSAGE / NOTIFICATION</h5>
                        <button type="button" class="btn-close" aria-label="Close" @click="message()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                Dear {{ patient.name }},<br/>
                                <br/>
                                <div class="form-group mb-3">
                                    <textarea v-model="textbox_message.text" class="textarea form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <button class="btn btn-danger form-control" @click="use_tpl('positive')">POSITIVE</button>
                            </div>
                            <div class="col form-group">
                                <button class="btn btn-success form-control" @click="use_tpl('negative')">NEGATIVE</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="send_message()">Send</button>
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
            form_disabled: true,
            textbox_message: {
                text: '',
                disabled: true
            },
            ic_verified: false
        }
    },

    created() {
        this.fetch_client();
    },

    methods: {
        fetch_client() {
            axios.get('/v2/patient/id/' + this.id)
                .then((res) => {
                    if (res.data.status) {
                        // console.log(res.data.patient);
                        this.patient = res.data.patient;
                        this.updateAge();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        use_tpl(result){
            if(result == 'negative'){
                this.textbox_message.text = "Congratulations, the results of your COVID-19 test came back negative. " +
                "This means that you do not currently have COVID-19 and do not need to quarantine or take any other special precautions at this time.";
            }

            else if(result == 'positive'){
                this.textbox_message.text = "I'm sorry to inform you that the results of your COVID-19 test came back positive. " +
                "This means that you have COVID-19 and will need to quarantine for at least 10 days to prevent the spread of the virus to others. We will also need to monitor your symptoms and discuss any necessary treatment options with you.";
            }
        },

        enable_edit() {
            if (this.patient.id !== undefined) {
                this.form_disabled = !this.form_disabled;
            }
        },

        message() {
            if(this.patient.id !== undefined){
                this.textbox_message.disabled = !this.textbox_message.disabled;
            }
        },

        verifyIC(){
            let date = new Date();
            let current_year = date.getFullYear();

            let pattern = "\\d{6}\\d{2}\\d{4}$";
            let result = this.patient.ic_no.match(pattern);
            if(result == null || this.patient.ic_no.length > 12){
                this.patient.age = 0;
                alert("Identity Card No. was not valid!");
                console.log(result);
                this.ic_verified = false;
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

            console.log('age changed: ' + this.patient.age);
            this.ic_verified = true;
        },

        updateAge(){
            let date = new Date();
            let current_year = date.getFullYear();

            let pattern = "\\d{6}\\d{2}\\d{4}$";
            let result = this.patient.ic_no.match(pattern);
            if(result == null || this.patient.ic_no.length > 12){
                this.patient.age = 0;
                this.ic_verified = false;
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
            this.ic_verified = true;
        },

        send_message(){
            let msg = confirm("Confirm want to send the message to this patient?");

            if(msg){
                axios.post('/v2/telegram/send', {
                    name: this.patient.name,
                    text: this.textbox_message.text,
                    telegram_id: this.patient.telegram_id
                })
                .then((res) => {
                    if(res.data.status){
                        alert("Message has been sent successfully.");
                        this.textbox_message.text = '';
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }
        },

        monitor() {
            if (this.patient.id !== undefined) {
                this.$emit('monitor');
            }
        },

        save() {
            if(this.ic_verified){
                axios.put('/v2/patient/id/' + this.patient.id, {
                api: 'update',
                name: this.patient.name,
                telegram_id: this.patient.telegram_id,
                age: this.patient.age,
                ic_no: this.patient.ic_no,
                hp_no: this.patient.hp_no,
                address: this.patient.address,
                diabetes: this.patient.diabetes,
                hbpressure: this.patient.hbpressure,
                asthma: this.patient.asthma,
                do_operation: this.patient.do_operation,
                fever: this.patient.fever,
                cough: this.patient.cough,
                shortness_breath: this.patient.shortness_breath,
                fatique: this.patient.fatique,
                body_aches: this.patient.body_aches,
                loss_taste: this.patient.loss_taste,
                sore_throats: this.patient.sore_throats,
                diarrhea: this.patient.diarrhea,
                nausea_vomitting: this.patient.nausea_vomitting,
                day_sick: this.patient.day_sick,
                heart_diseases: this.patient.heart_diseases,
                other_diseases: this.patient.other_diseases
            })
                .then((res) => {
                    if (res.data.status) {
                        this.enable_edit();
                        alert("Changes have been saved successfully.");
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            }

            else {
                alert("Identity card no. was not valid!");
            }
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