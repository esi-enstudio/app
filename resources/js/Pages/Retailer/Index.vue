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
    retailers: Object,
    searchTerm: String,
    status: String,
})

const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/retailer', { search: query }, { preserveState:true }),
    500
))

const delRetailer = (id, name) => {

    if (confirm(`Are you sure to delete "${name}"?`))
    {
        router.delete(route('retailer.destroy', id));
    }
}
</script>

<template>
    <Head title="Retailer" />
    <SessionMessage :status="status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Retailer
                </h2>

                <Link :href="route('retailer.create')" class="block border border-green-400 px-4 py-1 rounded-lg hover:bg-green-400 hover:text-white">
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
                                <th>Avatar</th>
                                <th>House</th>
                                <th>Retailer Info</th>
                                <th>Rso</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr class="font-semibold" v-for="(retailer, i) in props.retailers.data" :key="retailer.id">
                                <!-- SL -->
                                <td>{{++i}}</td>

                                <!-- Avatar -->
                                <td>
                                    <img class="w-[24px]" :src="retailer.user.avatar ? ('storage/' + retailer.user.avatar) : ('https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png')" alt="Retailer Avatar">
                                </td>

                                <!-- House -->
                                <td>
                                    {{retailer.house.name}}
                                    <p class="text-sm text-slate-400">{{retailer.house.code}}</p>
                                </td>

                                <!-- Retailer Info -->
                                <td>
                                    <div class="flex justify-between gap-6">
                                        <div>
                                            <div class="flex items-start">
                                                <p>{{retailer.name}} <span v-if="retailer.code">({{retailer.code}})</span></p>
                                                <Verified v-if="retailer.enabled" color="green"/>
                                            </div>
                                            <p class="text-sm text-slate-400">{{retailer.number}}</p>
                                        </div>

                                        <div class="flex flex-col justify-between items-end">
                                            <div class="flex items-start justify-between gap-1 text-xs">
                                                <span v-if="retailer.sso === 'Y'" class="text-purple-500 font-medium dark:text-purple-500">
                                                    SSO
                                                </span>
                                            </div>

                                            <div>
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium rounded-full dark:bg-gray-700 dark:text-gray-300">
                                                {{retailer.user.name}}
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Rso -->
                                <td>
                                    <p>{{retailer.rso.user.name}} <span v-if="retailer.rso.code">({{retailer.rso.code}})</span></p>
                                    <p class="text-sm text-slate-400">{{retailer.rso.number}}</p>
                                </td>

                                <!-- Action -->
                                <td class="text-center space-x-2">
                                    <Link :href="route('retailer.show', retailer.id)" class="hover:text-green-400">Show</Link>
                                    <Link :href="route('retailer.edit', retailer.id)" class="hover:text-green-400">Edit</Link>
                                    <button class="hover:text-red-500" @click="delRetailer(retailer.id, retailer.user.name)">Delete</button>
                                </td>
                            </tr>

                            <tr v-if="props.retailers.data.length < 1">
                                <td colspan="8">No data found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 pb-4">
                        <div class="lg:block hidden">
                            <Pagination :links="props.retailers"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks :links="props.retailers"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
