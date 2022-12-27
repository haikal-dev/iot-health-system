<template>
    <div>
        <h3 style="margin-bottom: 30px; color: blue;" align="center">Registration Form</h3>
        <div v-if="!form.isSent">
            <h4>Self Information</h4>
            <hr />
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input class="form-control" type="text" v-model="form.name" placeholder="Syed Saddiq" />
            </div>
            <div class="form-group mb-3">
                <label for="">Age</label>
                <input class="form-control" type="number" v-model="form.age" placeholder="36" />
            </div>
            <div class="form-group mb-3">
                <label for="">Identification No.</label>
                <input class="form-control" type="number" v-model="form.ic" placeholder="850908027893" />
            </div>
            <div class="form-group mb-3">
                <label for="">Mobile No.</label>
                <input class="form-control" type="number" v-model="form.mobileNo" placeholder="850908027893" />
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
                age: '',
                ic: '',
                mobileNo: '',
                address: '',
                health: {
                    diabetes: '',
                    highbloodpressure: '',
                    asthma: '',
                    doOperation: '',
                    any: ''
                },
                isSent: false
            }
        }
    },

    methods: {
        register() {
            if (
                this.form.name == '' ||
                this.form.age == '' ||
                this.form.ic == '' ||
                this.form.mobileNo == '' ||
                this.form.address == '' ||
                this.form.health.diabetes == '' ||
                this.form.health.highbloodpressure == '' ||
                this.form.health.asthma == '' ||
                this.form.health.doOperation == ''
            ) {
                alert("Don't leave form empty!");
            }

            else {
                axios.post('/register', {
                    name: this.form.name,
                    age: this.form.age,
                    ic_no: this.form.ic,
                    hp_no: this.form.mobileNo,
                    address: this.form.address,
                    diabetes: this.form.health.diabetes,
                    hbpressure: this.form.health.highbloodpressure,
                    asthma: this.form.health.asthma,
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