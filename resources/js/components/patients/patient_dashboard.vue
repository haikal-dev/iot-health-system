<template>
    <div>Patient Dashboard</div>
</template>

<script>
export default {
    props: ['id'],

    data(){
        return {
            //
        }
    },

    created(){
        console.log(this.id);
    }
}
</script>