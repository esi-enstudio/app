<template>
    <div>
        <p v-if="status" class="text-center text-white bg-green-400">{{ status }}</p>
    </div>
</template>

<script setup>
defineProps({ status: String })
</script>
