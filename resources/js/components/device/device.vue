<template>
    <tr>
        <td>{{ id }}</td>
        <td>{{ device.serial_number }}</td>
        <td>{{ device.pairing_id != '' ? device.pairing_id : 'NO PAIRING' }}</td>
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