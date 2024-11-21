<script setup>
const props = defineProps({
    links: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div v-if="props.links.meta.from" class="lg:flex items-center justify-between mt-3 text-center space-y-6">
        <div>
            Showing
            <span class="font-bold">{{props.links.meta.from}}</span>
            to
            <span class="font-bold">{{props.links.meta.to}}</span>
            of
            <span class="font-bold">{{props.links.meta.total}}</span>
            results
        </div>

        <div class="items-center gap-2 inline-flex">
            <Link :href="props.links.links.first" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">First</Link>
            <Link :href="props.links.links.prev ?? ''" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Prev</Link>
            <Link :href="props.links.links.next ?? ''" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Next</Link>
            <Link :href="props.links.links.last" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Last</Link>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
