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
    // itopReplaces: Object,
    // searchTerm: String,
    status: String,
})

// const search = ref(props.searchTerm)
//
// watch(search, debounce(
//     (query) => router.get('/itopReplace', { search: query }, { preserveState:true }),
//     500
// ))

const delReplaceRecord = (id, number) => {

    if (confirm(`Are you sure to delete "${number}"?`))
    {
        router.delete(route('itopReplace.destroy', id));
    }
}
</script>

<template>
    <Head title="Liftings" />
    <SessionMessage :status="status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Liftings
                </h2>

                <Link :href="route('lifting.create')" class="block border border-green-400 px-4 py-1 rounded-lg hover:bg-green-400 hover:text-white">
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
                                <th>Itop Number</th>
                                <th>Rso</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr class="font-semibold">
                                <!-- SL -->
                                <td>{{++i}}</td>

                                <!-- House -->
<!--                                <td>-->
<!--                                    {{itopReplace.house.name}}-->
<!--                                    <p class="text-sm text-slate-400">{{itopReplace.house.code}}</p>-->
<!--                                </td>-->

                                <!-- Action -->
<!--                                <td class="text-center space-x-2">-->
<!--                                    <Link :href="route('itopReplace.show', itopReplace.id)" class="hover:text-green-400">Details</Link>-->
<!--                                    <Link :href="route('itopReplace.edit', itopReplace.id)" class="hover:text-green-400">Edit</Link>-->
<!--                                    <button class="hover:text-red-500" @click="delReplaceRecord(itopReplace.id, itopReplace.number)">Delete</button>-->
<!--                                </td>-->
                            </tr>

<!--                            <tr v-if="props.itopReplaces.data.length < 1">-->
<!--                                <td colspan="8">No data found.</td>-->
<!--                            </tr>-->
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 pb-4">
                        <div class="lg:block hidden">
<!--                            <Pagination :links="props.itopReplaces.meta"/>-->
                        </div>

                        <div class="lg:hidden block">
<!--                            <PaginationWithoutLinks :links="props.itopReplaces"/>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
