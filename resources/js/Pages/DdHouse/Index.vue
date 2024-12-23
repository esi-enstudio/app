<script setup>

import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {debounce} from "lodash";
import {ref, watch} from "vue";
import TextInput from "@/Components/TextInput.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import PaginationWithoutLinks from "@/Components/PaginationWithoutLinks.vue";

const props = defineProps({
    ddHouses: Object,
    searchTerm: String,
    status: String,
})

const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/ddHouse', { search: query }, { preserveState:true }),
    500
))

const delHouse = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" house?`))
    {
        router.delete(route('ddHouse.destroy', id));
    }
}
</script>

<template>
    <Head title="DD House" />

    <SessionMessage :status="status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    DD House
                </h2>

                <Link :href="route('ddHouse.create')" class="block border border-green-400 px-4 py-1 rounded-lg hover:bg-green-400 hover:text-white">
                    Add New
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">

                    <div class="grid md:grid-cols-2">
                        <div class="px-3 pt-4">
                            <button class="text-pink-600 bg-pink-200 text-center md:text-start px-4 py-1 rounded-lg">
                                <i class="fa-solid fa-file-import"></i>
                            </button>
                        </div>

                        <div>
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
                        </div>
                    </div>


                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>DD Code</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(ddHouse, i) in ddHouses.data" :key="ddHouse.id">
                                <td>{{++i}}</td>
                                <td>
                                    <i v-if="!ddHouse.status" class="fa-solid fa-ban mx-2 text-red-600"></i>
                                    {{ddHouse.code}}
                                </td>
                                <td>{{ddHouse.name}}</td>
                                <td>{{ddHouse.created}}</td>
                                <td>{{ddHouse.updated}}</td>
                                <td class="text-center space-x-2">
                                    <Link :href="route('ddHouse.show', ddHouse.id)" class="hover:text-green-400">Show</Link>
                                    <Link :href="route('ddHouse.edit', ddHouse.id)" class="hover:text-green-400">Edit</Link>
                                    <button class="hover:text-red-500" @click="delHouse(ddHouse.id, ddHouse.name)">Delete</button>
                                </td>
                            </tr>

                            <tr v-if="props.ddHouses.data.length < 1">
                                <td colspan="6">No data found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 pb-4">
                        <div class="lg:block hidden">
                            <Pagination :links="props.ddHouses.meta"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks :links="props.ddHouses"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
