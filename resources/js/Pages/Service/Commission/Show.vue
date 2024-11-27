<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import Pagination from "@/Components/Pagination.vue";
import PaginationWithoutLinks from "@/Components/PaginationWithoutLinks.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";

// const props = defineProps({
//     itopReplace: Object,
//     replaceHistory: Object,
//     searchTerm: String,
// })

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
    <Head title="Commission Details" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Commission Details...
                </h2>

                <div>
                    <Link :href="route('commission.index')" class="hover:text-green-400">Back to list</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">

                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>House</th>
                                <th>Itop Number</th>
                                <th>Rso</th>
                                <th>Supervisor</th>
                                <th>Balance</th>
                                <th>Reason</th>
                                <th>Description</th>
                                <th>Requested From/By</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr class="font-semibold">
                                <!-- SL -->
                                <td></td>

                                <!-- House -->
                                <td></td>

                                <!-- Itop Number -->
                                <td></td>

                                <!-- Rso -->
                                <td></td>

                                <!-- Supervisor -->
                                <td></td>

                                <!-- Balance -->
                                <td class="text-center"></td>

                                <!-- Reason -->
                                <td class="text-center"></td>

                                <!-- Description -->
                                <td class="text-center"></td>

                                <!-- Requested From -->
                                <td class="text-center"></td>

                                <!-- Status -->
                                <td class="text-center"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

<!--                    <div class="px-3 pb-4">-->
<!--                        <div class="lg:block hidden">-->
<!--                            <Pagination :links="props.replaceHistory.meta"/>-->
<!--                        </div>-->

<!--                        <div class="lg:hidden block">-->
<!--                            <PaginationWithoutLinks :links="props.replaceHistory"/>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
