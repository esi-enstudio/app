<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


const props = defineProps({
    result: Object,
})
console.log(props.result)
// const search = ref(props.searchTerm)
//
// watch(search, debounce(
//     (query) => router.get('/itopReplace/'+props.itopReplace.id, { search: query }, { preserveState:true }),
//     500
// ))

// const delReplaceRecord = (id, name) => {
//
//     if (confirm(`Are you sure to delete "${name}"?`))
//     {
//         router.delete(route('itopReplace.destroy', id));
//     }
// }

</script>

<template>
    <Head title="Filtered Commission" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Filtered data...
                </h2>

                <div>
                    <Link :href="route('commission.index')" class="hover:text-green-400">Back to list</Link>
                </div>
            </div>
        </template>

<!--        <div class="py-12">-->
<!--            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">-->
<!--                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">-->

<!--                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">-->
<!--                        <table class="w-full whitespace-nowrap">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>SL</th>-->
<!--                                <th>House</th>-->
<!--                                <th>Itop Number</th>-->
<!--                                <th>Rso</th>-->
<!--                                <th>Supervisor</th>-->
<!--                                <th>Balance</th>-->
<!--                                <th>Reason</th>-->
<!--                                <th>Description</th>-->
<!--                                <th>Requested From/By</th>-->
<!--                                <th>Status</th>-->
<!--                            </tr>-->
<!--                            </thead>-->

<!--                            <tbody>-->

<!--                            <tr class="font-semibold">-->
<!--                                &lt;!&ndash; SL &ndash;&gt;-->
<!--                                <td></td>-->

<!--                                &lt;!&ndash; House &ndash;&gt;-->
<!--                                <td></td>-->

<!--                                &lt;!&ndash; Itop Number &ndash;&gt;-->
<!--                                <td></td>-->

<!--                                &lt;!&ndash; Rso &ndash;&gt;-->
<!--                                <td></td>-->

<!--                                &lt;!&ndash; Supervisor &ndash;&gt;-->
<!--                                <td></td>-->

<!--                                &lt;!&ndash; Balance &ndash;&gt;-->
<!--                                <td class="text-center"></td>-->

<!--                                &lt;!&ndash; Reason &ndash;&gt;-->
<!--                                <td class="text-center"></td>-->

<!--                                &lt;!&ndash; Description &ndash;&gt;-->
<!--                                <td class="text-center"></td>-->

<!--                                &lt;!&ndash; Requested From &ndash;&gt;-->
<!--                                <td class="text-center"></td>-->

<!--                                &lt;!&ndash; Status &ndash;&gt;-->
<!--                                <td class="text-center"></td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->

<!--&lt;!&ndash;                    <div class="px-3 pb-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="lg:block hidden">&ndash;&gt;-->
<!--&lt;!&ndash;                            <Pagination :links="props.replaceHistory.meta"/>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->

<!--&lt;!&ndash;                        <div class="lg:hidden block">&ndash;&gt;-->
<!--&lt;!&ndash;                            <PaginationWithoutLinks :links="props.replaceHistory"/>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
