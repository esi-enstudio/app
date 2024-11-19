<script setup>
defineProps({
    links: Array,
})
</script>

<template>
    <div v-if="links.meta.from" class="flex items-center justify-between mt-3">
        <div>
            Showing
            <span class="font-bold">{{links.meta.from}}</span>
            to
            <span class="font-bold">{{links.meta.to}}</span>
            of
            <span class="font-bold">{{links.meta.total}}</span>
            results
        </div>
        <div>
            <Link :href="links.links.first" class="border border-2 border-green-600 px-4 py-1 rounded-md">First</Link>
            <Link :href="links.links.last" class="border border-2 border-green-600 px-4 py-1 rounded-md">Last</Link>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
