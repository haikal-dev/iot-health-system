<template>
    <tr>
        <td>{{ id }}</td>
        <td>{{ patient.name }}</td>
        <td>{{ patient.registered_at }}</td>
        <td>
            <button class="btn btn-primary" @click="review()">Review</button>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['patient', 'id'],

    methods: {
        review(){
            this.$emit('review', this.patient.id);
        }
    }
}
</script>
