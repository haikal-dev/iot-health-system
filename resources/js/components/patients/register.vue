<template>
    <div>
        <h3 style="margin-bottom: 30px; color: blue;" align="center">Registration Form</h3>
        <div v-if="!form.isSent">
            <h4>Self Information</h4>
            <hr />
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input class="form-control" type="text" v-model="form.name" placeholder="Mohd Ali Bin Abu" />
            </div>
            <div class="form-group mb-3">
                <label for="">Identity Card No.</label>
                <input class="form-control" @change="updateAge()" type="number" v-model="form.ic" placeholder="850908027893" />
            </div>
            <div class="form-group mb-3">
                <label for="">Age</label>
                <input class="form-control" type="number" v-model="form.age" placeholder="0" disabled />
            </div>
            <div class="form-group mb-3">
                <label for="">Mobile No.</label>
                <input class="form-control" type="number" v-model="form.mobileNo" placeholder="01234567890" />
            </div>
            <div class="form-group mb-3">
                <label for="">Telegram ID</label>
                <input class="form-control" type="text" disabled v-model="form.telegram_id" />
            </div>
            <div class="form-group mb-3">
                <label for="">Address</label>
                <textarea style="height: 150px;" class="form-control" type="text" v-model="form.address"
                    placeholder="No 10, Jalan Hang Tuah, 90222, Melaka, Malaysia"></textarea>
            </div>

            <h4 style="margin-top: 30px;">Health Information</h4>
            <hr />
            <div class="form-group mb-3">
                <label for="">Do you have diabetes?</label><br />
                <input type="radio" v-model="form.health.diabetes" value="NO" /> No<br />
                <input type="radio" v-model="form.health.diabetes" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Do you have high blood pressure?</label><br />
                <input type="radio" v-model="form.health.highbloodpressure" value="NO" /> No<br />
                <input type="radio" v-model="form.health.highbloodpressure" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Do you have asthma?</label><br />
                <input type="radio" v-model="form.health.asthma" value="NO" /> No<br />
                <input type="radio" v-model="form.health.asthma" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Have you had operation before?</label><br />
                <input type="radio" v-model="form.health.doOperation" value="NO" /> No<br />
                <input type="radio" v-model="form.health.doOperation" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Fever</label><br />
                <input type="radio" v-model="form.health.fever" value="NO" /> No<br />
                <input type="radio" v-model="form.health.fever" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Cough</label><br />
                <input type="radio" v-model="form.health.cough" value="NO" /> No<br />
                <input type="radio" v-model="form.health.cough" value="Dry Cough" /> Dry Cough<br />
                <input type="radio" v-model="form.health.cough" value="Cough With Mucus" /> Cough With Mucus<br/>
                <input type="radio" v-model="form.health.cough" value="Normal Cough" /> Normal Cough
            </div>

            <div class="form-group mb-3">
                <label for="">Shortness of breath</label><br />
                <input type="radio" v-model="form.health.shortness_breath" value="NO" /> No<br />
                <input type="radio" v-model="form.health.shortness_breath" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Fatique</label><br />
                <input type="radio" v-model="form.health.fatique" value="NO" /> No<br />
                <input type="radio" v-model="form.health.fatique" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Body Aches</label><br />
                <input type="radio" v-model="form.health.body_aches" value="NO" /> No<br />
                <input type="radio" v-model="form.health.body_aches" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Loss of Smell / Taste</label><br />
                <input type="radio" v-model="form.health.loss_taste" value="NO" /> No<br />
                <input type="radio" v-model="form.health.loss_taste" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Sore Throats</label><br />
                <input type="radio" v-model="form.health.sore_throats" value="NO" /> No<br />
                <input type="radio" v-model="form.health.sore_throats" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Diarrhea</label><br />
                <input type="radio" v-model="form.health.diarrhea" value="NO" /> No<br />
                <input type="radio" v-model="form.health.diarrhea" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Nausea or Vomitting?</label><br />
                <input type="radio" v-model="form.health.nausea_vomitting" value="NO" /> No<br />
                <input type="radio" v-model="form.health.nausea_vomitting" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">How many days have you been sick?</label><br />
                <input type="radio" v-model="form.health.day_sick" value="Less than 7 days" /> Less than 7 days<br />
                <input type="radio" v-model="form.health.day_sick" value="More than 7 days" /> More than 7 days
            </div>

            <div class="form-group mb-3">
                <label for="">Heart Diseases</label><br />
                <input type="radio" v-model="form.health.heart_diseases" value="NO" /> No<br />
                <input type="radio" v-model="form.health.heart_diseases" value="YES" /> Yes
            </div>

            <div class="form-group mb-3">
                <label for="">Any other diseases? (Optional)</label><br />
                <textarea style="height: 150px;" class="form-control" type="text" v-model="form.health.any" />
            </div>

            <div class="form-group">
                <button class="form-control btn btn-primary" @click="register()">Register</button>
            </div>
        </div>
        <div v-else>
            <div class="alert alert-success text-primary">Your form has been submitted for approval!</div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                name: '',
                telegram_id: window.telegram_id,
                age: '',
                ic: '',
                mobileNo: '',
                address: '',
                health: {
                    diabetes: '',
                    highbloodpressure: '',
                    asthma: '',
                    doOperation: '',
                    fever: '',
                    cough: '',
                    shortness_breath: '',
                    fatique: '',
                    body_aches: '',
                    loss_taste: '',
                    sore_throats: '',
                    diarrhea: '',
                    nausea_vomitting: '',
                    day_sick: '',
                    heart_diseases: '',
                    any: ''
                },
                isSent: false
            }
        }
    },

    methods: {
        updateAge(){
            let date = new Date();
            let current_year = date.getFullYear();

            let pattern = "\\d{6}\\d{2}\\d{4}$";
            let result = this.form.ic.match(pattern);
            if(result == null){
                alert("Identity Card is invalid!");
                return;
            }

            let pattern_age = /^(\d{1,2})/;
            let result_age = this.form.ic.match(pattern_age);
            let year = 0;
            let age = 0;

            if(result_age[0] > 23){
                year = 1900 + Math.ceil(result_age[0]);
                age = current_year - year;
            }

            else {
                year = 2000 + Math.ceil(result_age[0]);
                age = current_year - year;
            }

            this.form.age = age;
        },
        register() {
            if (
                this.form.name == '' ||
                this.form.telegram_id == '' ||
                this.form.ic == '' ||
                this.form.mobileNo == '' ||
                this.form.address == '' ||
                this.form.health.diabetes == '' ||
                this.form.health.highbloodpressure == '' ||
                this.form.health.asthma == '' ||
                this.form.health.doOperation == '' ||
                this.form.health.fever == '' ||
                this.form.health.cough == '' ||
                this.form.health.shortness_breath == '' ||
                this.form.health.fatique == '' ||
                this.form.health.body_aches == '' ||
                this.form.health.loss_taste == '' ||
                this.form.health.sore_throats == '' ||
                this.form.health.diarrhea == '' ||
                this.form.health.nausea_vomitting == '' ||
                this.form.health.day_sick == '' ||
                this.form.health.heart_diseases == ''
            ) {
                alert("Don't leave form empty!");
            }

            else {
                axios.post('/register', {
                    name: this.form.name,
                    telegram_id: this.form.telegram_id,
                    age: this.form.age,
                    ic_no: this.form.ic,
                    hp_no: this.form.mobileNo,
                    address: this.form.address,
                    diabetes: this.form.health.diabetes,
                    hbpressure: this.form.health.highbloodpressure,
                    asthma: this.form.health.asthma,
                    fever: this.form.health.fever,
                    cough: this.form.health.cough,
                    shortness_breath: this.form.health.shortness_breath,
                    fatique: this.form.health.fatique,
                    body_aches: this.form.health.body_aches,
                    loss_taste: this.form.health.loss_taste,
                    sore_throats: this.form.health.sore_throats,
                    diarrhea: this.form.health.diarrhea,
                    nausea_vomitting: this.form.health.nausea_vomitting,
                    day_sick: this.form.health.day_sick,
                    heart_diseases: this.form.health.heart_diseases,
                    do_operation: this.form.health.doOperation,
                    other_diseases: this.form.health.any
                })
                    .then((res) => {
                        // console.log(res);
                        if (res.status == 200) {
                            if (!res.data.status) {
                                alert(res.data.response);
                            }

                            else {
                                this.form.isSent = true;
                            }
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