<script setup>
const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div v-if="props.data.from" class="lg:flex items-center justify-between mt-3 text-center space-y-6">
        <div>
            Showing
            <span class="font-bold">{{props.data.from}}</span>
            to
            <span class="font-bold">{{props.data.to}}</span>
            of
            <span class="font-bold">{{props.data.total}}</span>
            results
        </div>

        <div class="items-center gap-2 inline-flex">
            <Link :href="props.data.first_page_url" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">First</Link>
            <Link :href="props.data.prev_page_url ?? ''" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Prev</Link>
            <Link :href="props.data.next_page_url ?? ''" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Next</Link>
            <Link :href="props.data.last_page_url" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Last</Link>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
