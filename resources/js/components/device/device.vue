<template>
    <tr>
        <td>{{ id }}</td>
        <td>{{ device.serial_number }}</td>
        <td v-if="device.pairing_id != ''">
            <span v-if="device.pairing_id == 'deleted'" class="badge badge-danger">
                PATIENT WAS DELETED
            </span>
            <span v-else>{{ device.pairing_id }}</span>
        </td>
        <td v-else>
            <span class="badge badge-danger">NO PAIRING</span>
        </td>
        <td>{{ device.last_updated != '' ? device.last_updated : '-' }}</td>
        <td>
            <button v-if="device.pairing_id == ''" class="btn btn-primary" @click="pair()">Pair</button>
            <button v-else class="btn btn-danger" @click="unpair()">Unpair</button>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['device', 'id'],
    methods: {
        pair() {
            this.$emit('pair', this.device.id);
        },

        unpair(){
            this.$emit('unpair', this.device.id);
        }
    }
}
</script>

<style scoped>

.badge-danger {
    background-color: red;
    color: white;
    padding: 5px;
    font-size: 0.8rem;
}

</style>