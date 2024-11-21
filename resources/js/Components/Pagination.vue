<script setup>
const props = defineProps({
    links: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div v-if="props.links.from" class="flex items-center justify-between mt-3">
        <div>
            Showing
            <span class="font-bold">{{props.links.from}}</span>
            to
            <span class="font-bold">{{props.links.to}}</span>
            of
            <span class="font-bold">{{props.links.total}}</span>
            results
        </div>

        <div>
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in props.links.links"
                :href="link.url"
                v-html="link.label"
                class="px-2 border border-green-400 rounded-md mx-1 hover:bg-green-400 hover:text-white"
                :class="{'text-gray-400 border-gray-400 hover:bg-gray-400 cursor-not-allowed' : !link.url, 'font-bold text-white bg-green-400 rounded-md' : link.active}"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
