<script setup>
defineProps({
    disable: Boolean,
})
</script>

<template>
    <button
        type="submit"
        :class="disable ? 'cursor-not-allowed opacity-50' : ''"
        class="text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-400 dark:focus:ring-red-600" :disabled="disable"
    >
        <slot/>
    </button>
</template>

<style scoped lang="scss">

</style>
