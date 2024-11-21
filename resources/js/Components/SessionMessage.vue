<template>
    <div>
        <p v-if="status" class="text-center text-green-800 bg-green-200">{{ status }}</p>
    </div>
</template>

<script setup>
defineProps({ status: String })
</script>
