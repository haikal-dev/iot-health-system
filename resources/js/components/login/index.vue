<template>
    <div>
        <div v-if="tokenIsRequest">
            <div class="mb-3">
                <label for="email" class="form-label">One Time Token</label>
                <input v-model="form.token" type="text" class="form-control" placeholder="6 digit token..." autofocus />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" @click="signin()">Sign in</button>
            </div>
        </div>

        <div v-else>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" @click="request_token()">Request Token Access</button>
            </div>
        </div>

        <p class="text-center">
            <span>Your token access will be send to telegram!</span>
        </p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            tokenIsRequest: false,
            form: {
                token: ''
            }
        }
    },

    methods: {
        request_token(){
            axios.get('/v2/token/request')
            .then((res) => {
                // console.log(res);
                if(res.status == 200){
                    this.tokenIsRequest = true;
                }
            })
            .catch((err) => {
                console.log(err);
            });
        },

        signin(){
            if(this.form.token != ''){
                axios.post('/login', {
                    token: this.form.token
                })
                .then((res) => {
                    // console.log(res);
                    if(res.status == 200){
                        if(!res.data.success){
                            alert(res.data.response);
                        }

                        else {
                            window.location = '/';
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