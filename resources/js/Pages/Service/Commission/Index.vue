<script setup>

import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {debounce} from "lodash";
import {ref, watch} from "vue";
import TextInput from "@/Components/TextInput.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import PaginationWithoutLinks from "@/Components/PaginationWithoutLinks.vue";
import Verified from "@/Components/Verified.vue";

const props = defineProps({
    commissions: Object,
    searchTerm: String,
    status: String,
})

const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/commission', { search: query }, { preserveState:true }),
    500
))

const delCommission = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" ?`))
    {
        router.delete(route('commission.destroy', id));
    }
}
</script>

<template>
    <Head title="Commission" />
    <SessionMessage :status="status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Commission
                </h2>

                <Link :href="route('commission.create')" class="block border border-green-400 px-4 py-1 rounded-lg hover:bg-green-400 hover:text-white">
                    Add New
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="md:block hidden">
                        <div class="flex justify-end px-3 pt-4">
                            <TextInput
                                type="search"
                                icon="search"
                                v-model="search"
                                placeholder="Type something..."
                            />
                        </div>
                    </div>

                    <div class="md:hidden block">
                        <div class="flex justify-end px-3 pt-4">
                            <TextInput
                                type="search"
                                class="w-full"
                                icon="search"
                                v-model="search"
                                placeholder="Type something..."
                            />
                        </div>
                    </div>

                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>House</th>
                                <th>For/Type</th>
                                <th>Name/Month</th>
                                <th>Net Amount</th>
                                <th>Receive Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr class="font-semibold" v-for="(commission, i) in props.commissions.data" :key="commission.id">
                                <!-- SL -->
                                <td>{{++i}}</td>

                                <!-- House -->
                                <td>
                                    {{commission.house.name}}
                                    <p class="text-sm text-slate-400">{{commission.house.code}}</p>
                                </td>

                                <!-- Commission For -->
                                <td>
                                    {{commission.for}}
                                    <p class="text-sm text-slate-400">{{commission.type}}</p>
                                </td>

                                <!-- Commission Name -->
                                <td>
                                    {{commission.name}}
                                    <p class="text-sm text-slate-400">{{commission.month}}</p>
                                </td>

                                <!-- Net Amount -->
                                <td>
                                    {{commission.amount}}
                                </td>

                                <!-- Receive Date -->
                                <td>
                                    {{commission.receive_date}}
                                </td>

                                <!-- Status -->
                                <td class="text-center">
                                    <span v-if="commission.status === 'Pending'" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{commission.status}}</span>

                                    <span v-else class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{commission.status}}</span>
                                </td>

                                <!-- Action -->
                                <td class="text-center space-x-2">
                                    <Link :href="route('commission.edit', commission.id)" class="hover:text-green-400">Edit</Link>
                                    <button class="hover:text-red-500" @click="delCommission(commission.id, commission.name)">Delete</button>
                                </td>
                            </tr>

                            <tr v-if="props.commissions.data.length < 1">
                                <td colspan="10">No data found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 pb-4">
                        <div class="lg:block hidden">
                            <Pagination :links="props.commissions.meta"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks :links="props.commissions"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
