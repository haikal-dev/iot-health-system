<template>
    <tr>
        <td>{{ id }}</td>
        <td>{{ patient.name }}</td>
        <td>{{ patient.registered_at }}</td>
    </tr>
</template>

<script>
export default {
    props: ['patient', 'id']
}
</script>