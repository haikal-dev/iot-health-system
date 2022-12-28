<template>
    <tr>
        <td>{{ id }}</td>
        <td>{{ patient.name }}</td>
        <td>{{ patient.registered_at }}</td>
        <td>
            <button class="btn btn-primary" title="View Informations" @click="info()">
                <i class='bx bxs-file'></i>
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['patient', 'id'],

    methods: {
        info(){
            window.location = '/patients/id/' + this.patient.id;
        }
    }
}
</script>