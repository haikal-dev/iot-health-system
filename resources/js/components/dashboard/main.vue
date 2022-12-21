<template>
    <div>
        <h5 class="card-title text-primary">Welcome Izzati! 🎉</h5>
        <p class="mb-4">
            You have done <span class="fw-bold">{{ task_count }}%</span> of your tasks. <span v-if="task_count <= 99">Complete your task today!</span>
        </p>
    </div>
</template>

<script>
export default {
    data(){
        return {
            task_count: 0
        }
    }
}
</script>