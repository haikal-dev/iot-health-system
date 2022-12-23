<template>
    <div>
        <h5 class="card-title text-primary">Welcome Izzati! 🎉</h5>
        <p class="mb-4">
            You have done <span class="fw-bold">{{ task_count }}%</span> of your tasks. <span v-if="task_count <= 99">Complete your task today!</span>
        </p>
        <div>
            <button class="btn btn-danger" @click="reset_info()">
                Reset Live Records
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            task_count: 0
        }
    },

    methods: {
        reset_info(){
            let msg = confirm("This will remove all records that stored in the cloud including heartbeat and networking data. Do you want to continue?");

            if(msg){
                axios.get('/v2/reset')
                .then((res) => {
                    // console.log(res);
                    if(res.status == 200 && res.data.success){
                        alert("All records has been reset.");
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