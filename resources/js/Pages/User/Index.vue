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
    users: Object,
    searchTerm: String,
    status: String,
})

const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/user', { search: query }, { preserveState:true }),
    500
))

const delUser = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" user?`))
    {
        router.delete(route('user.destroy', id));
    }
}
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Users
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">

                        <SessionMessage :status="status"/>

                        <div class="flex items-center justify-between mb-3">
                            <Link :href="route('user.create')" class="border border-green-400 px-4 py-2 rounded-lg hover:bg-green-400 hover:text-white">
                                Add New
                            </Link>

                            <div>
                                <TextInput
                                    type="search"
                                    class="mt-1 block w-full"
                                    v-model="search"
                                    placeholder="Type something..."
                                />
                            </div>
                        </div>

                        <table class="w-full whitespace-nowrap">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(user, i) in props.users.data" :key="user.id">
                                <td>{{++i}}</td>
                                <td>
                                    <img class="w-[35px]" :src="user.avatar ? ('storage/' + user.avatar) : ('https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png')" alt="User Avatar">
                                </td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.phone}}</td>
                                <td>{{user.role}}</td>
                                <td>{{user.status}}</td>
                                <td class="text-center space-x-2">
                                    <Link :href="route('user.show', user.id)" class="hover:text-green-400">Show</Link>
                                    <Link :href="route('user.edit', user.id)" class="hover:text-green-400">Edit</Link>
                                    <button class="hover:text-red-500" @click="delUser(user.id, user.name)">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <Pagination :links="props.users"/>

                        <PaginationWithoutLinks :links="props.users"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
