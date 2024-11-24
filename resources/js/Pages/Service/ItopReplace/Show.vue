<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import Pagination from "@/Components/Pagination.vue";
import PaginationWithoutLinks from "@/Components/PaginationWithoutLinks.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";

const props = defineProps({
    itopReplace: Object,
    replaceHistory: Object,
    searchTerm: String,
})

const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/itopReplace/'+props.itopReplace.id, { search: query }, { preserveState:true }),
    500
))

const delReplaceRecord = (id, name) => {

    if (confirm(`Are you sure to delete "${name}"?`))
    {
        router.delete(route('itopReplace.destroy', id));
    }
}

</script>

<template>
    <Head title="Itop Replace Details" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Replace Details...
                </h2>
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
                                <th>Itop Number</th>
                                <th>Balance</th>
                                <th>Reason</th>
                                <th>Requested From/By</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr class="font-semibold" v-for="(history, i) in props.replaceHistory.data" :key="history.id">
                                <!-- SL -->
                                <td>{{++i}}</td>

                                <!-- Itop Number -->
                                <td>
                                    {{history.number}}
                                    <p class="text-sm text-slate-400">{{history.sim_serial}}</p>
                                </td>

                                <!-- Balance -->
                                <td class="text-center">
                                    {{history.balance}}
                                </td>

                                <!-- Reason -->
                                <td class="text-center">
                                    {{history.reason}}
                                </td>

                                <!-- Requested From -->
                                <td class="text-center">
                                    {{history.remarks}} <i v-if="history.user.name" class="text-sky-500 fa-solid fa-arrow-right-long"></i> {{history.user.name}}
                                </td>

                                <!-- Status -->
                                <td class="text-center">
                                    <span v-if="history.status === 'Pending'" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{history.status}}</span>

                                    <span v-else-if="history.status === 'Processing'"  class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">{{history.status}}</span>

                                    <span v-else class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{history.status}}</span>
                                </td>
                            </tr>

                            <tr v-if="props.replaceHistory.data.length < 1">
                                <td colspan="8">No data found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 pb-4">
                        <div class="lg:block hidden">
                            <Pagination :links="props.replaceHistory.meta"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks :links="props.replaceHistory"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-5">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="mb-4 text-right">
                            <Link :href="route('itopReplace.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <div class="space-y-5">
                            <p>
                                <span class="font-semibold text-blue-400">{{props.itopReplace.remarks}},</span>
                                &nbsp;
                                <span class="font-semibold text-green-400">{{props.itopReplace.number}}</span>
                                &nbsp;
                                নাম্বারটি
                                &nbsp;
                                <span class="font-semibold text-sky-400">{{props.itopReplace.created}}</span>
                                &nbsp;
                                তারিখে
                                &nbsp;
                                <span class="font-semibold text-pink-400">{{props.itopReplace.user.name ?? 'N/A'}}</span>
                                &nbsp;
                                ভাইয়ের কাছে রিপ্লেস করার জন্য দেয়।
                            </p>
                            <p>
                                <span class="font-semibold text-pink-400">{{props.itopReplace.user.name ?? 'N/A'}}</span>
                                &nbsp;
                                ভাই
                                &nbsp;
                                <span class="font-semibold text-sky-400">{{props.itopReplace.requested}}</span>
                                &nbsp;
                                তারিখে রিপ্লেসের জন্য মেইল পাঠায়।
                            </p>
                            <p>
                                <span class="font-semibold text-sky-400">{{props.itopReplace.completed}}</span>
                                &nbsp;
                                তারিখে সিমটি রিপ্লেস হয়।
                            </p>
                            <p>
                                রিপ্লেসে দেওয়ার সময় উক্ত সিমে
                                &nbsp;
                                <span class="font-semibold text-indigo-400">{{props.itopReplace.balance ?? 'N/A'}}</span>
                                &nbsp;
                                টাকা ব্যালেন্স ছিল।
                            </p>
                            <p>
                                সিমটি
                                &nbsp;
                                <span class="font-semibold text-yellow-500">{{props.itopReplace.dd_house.name ?? 'N/A'}}</span>
                                &nbsp;
                                এর ছিল।
                            </p>
                            <p>
                                এটি এখন পর্যন্ত
                                &nbsp;
                                <span class="font-semibold text-red-500">{{props.replaceHistory.meta.total ?? 'N/A'}}</span>
                                &nbsp;
                                বার রিপ্লেস হয়েছে।
                            </p>
                            &nbsp;
                            <p>রিপ্লেস করার কারণঃ <span class="font-semibold text-slate-500">{{props.itopReplace.reason ?? 'N/A'}}</span></p>

                            <p>
                                বর্তমান অবস্থাঃ
                                <span :class="{
                                    'text-yellow-500' : props.itopReplace.status === 'Pending',
                                    'text-pink-500' : props.itopReplace.status === 'Processing',
                                    'text-green-500' : props.itopReplace.status === 'Complete',}"
                                >
                                    {{props.itopReplace.status}}
                                    </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
