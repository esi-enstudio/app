<script setup>

import {router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {debounce, runInContext as $inertia} from "lodash";
import {onMounted, ref, watch} from "vue";
import TextInput from "@/Components/TextInput.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import PaginationWithoutLinks from "@/Components/PaginationWithoutLinks.vue";
import {useTheme} from "vuetify";

import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    users: Object,
    // searchTerm: String,
    // status: String,
})

const users = ref(usePage().props.users);
const search = ref('');
const itemsPerPage = ref(users.value.per_page || 0);
const page = ref(users.value.current_page || 0);
const loading = ref(false);
const sortBy = ref(null);
const sortDesc = ref(false);


const headers = [
    { text: "ID", value: "id", sortable: true },
    { text: "Name", value: "name", sortable: true },
    { text: "Email", value: "email", sortable: true },
    { text: "Actions", value: "actions", sortable: false },
];

function fetchData() {
    loading.value = true;
    $inertia.get(route('user.index'), {
        search: search.value,
        itemsPerPage: itemsPerPage.value,
        page: page.value,
        sortBy: sortBy.value,
        sortDesc: sortDesc.value,
    }, { preserveState: true })
        .then(() => {
            loading.value = false;
        });
}

function handleSort({ sortBy: newSortBy, sortDesc: newSortDesc }) {
    sortBy.value = newSortBy;
    sortDesc.value = newSortDesc;
    fetchData();
}

function editUser(user) {
    console.log("Edit user:", user);
}

function deleteUser(user) {
    console.log("Delete user:", user);
}

// Fetch data when pagination or items per page change
watch([page, itemsPerPage], fetchData);

const currentTheme = ref('light'); // Default theme
const theme = useTheme(); // Access Vuetify's theme system

onMounted(() => {
    if (typeof window !== 'undefined') {
        const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        currentTheme.value = isDarkMode ? 'dark' : 'light';

        // Set the theme directly
        theme.global.name.value = currentTheme.value;
    }
});

// const search = ref(props.searchTerm)
//
// watch(search, debounce(
//     (query) => router.get('/user', { search: query }, { preserveState:true }),
//     500
// ))

// const delUser = (id, name) => {
//
//     if (confirm(`Are you sure to delete "${name}" user?`))
//     {
//         router.delete(route('user.destroy', id));
//     }
// }
</script>

<template>
    <Head title="Users" />
<!--    <SessionMessage :status="status"/>-->

    <AuthenticatedLayout>
        <v-container>
            <v-card>
                <v-card-title>
                    <v-text-field
                        v-model="search"
                        label="Search"
                        variant="outlined"
                        clearable
                        @input="fetchData"
                    />
                </v-card-title>
                {{console.log(users)}}
                <v-data-table
                    :headers="headers"
                    :items="users.data"
                    :server-items-length="users.total"
                    :items-per-page.sync="itemsPerPage"
                    :page.sync="page"
                    :loading="loading"
                    item-value="id"
                    class="elevation-1"
                    @update:sort="handleSort"
                >
                    <template #top>
                        <v-toolbar flat>
                            <v-toolbar-title>Users</v-toolbar-title>
                        </v-toolbar>
                    </template>
                    <template #item.actions="{ item }">
                        <v-btn icon @click="editUser(item)">
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn icon @click="deleteUser(item)">
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-card>
        </v-container>


<!--        <div class="py-12">-->
<!--            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">-->
<!--                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">-->
<!--                    <div class="md:block hidden">-->
<!--                        <div class="flex justify-end px-3 pt-4">-->
<!--                            <TextInput-->
<!--                                type="search"-->
<!--                                icon="search"-->
<!--                                v-model="search"-->
<!--                                placeholder="Type something..."-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="md:hidden block">-->
<!--                        <div class="flex justify-end px-3 pt-4">-->
<!--                            <TextInput-->
<!--                                type="search"-->
<!--                                class="w-full"-->
<!--                                icon="search"-->
<!--                                v-model="search"-->
<!--                                placeholder="Type something..."-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">-->
<!--                        <table class="w-full whitespace-nowrap">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>SL</th>-->
<!--                                <th>Avatar</th>-->
<!--                                <th>Name</th>-->
<!--                                <th>Email</th>-->
<!--                                <th>Phone</th>-->
<!--                                <th>Role</th>-->
<!--                                <th>Status</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->

<!--                            <tbody>-->
<!--                            <tr v-for="(user, i) in props.users.data" :key="user.id">-->
<!--                                <td>{{++i}}</td>-->
<!--                                <td>-->
<!--                                    <img class="w-[24px]" :src="user.avatar ? ('storage/' + user.avatar) : ('https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png')" alt="User Avatar">-->
<!--                                </td>-->
<!--                                <td>{{user.name}}</td>-->
<!--                                <td>{{user.email}}</td>-->
<!--                                <td>{{user.phone}}</td>-->
<!--                                <td>{{user.role}}</td>-->
<!--                                <td>{{user.status}}</td>-->
<!--                                <td class="text-center space-x-2">-->
<!--                                    <Link :href="route('user.show', user.id)" class="hover:text-green-400">Show</Link>-->
<!--                                    <Link :href="route('user.edit', user.id)" class="hover:text-green-400">Edit</Link>-->
<!--                                    <button class="hover:text-red-500" @click="delUser(user.id, user.name)">Delete</button>-->
<!--                                </td>-->
<!--                            </tr>-->

<!--                            <tr v-if="props.users.data.length < 1">-->
<!--                                <td colspan="8">No data found.</td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->

<!--                    <div class="px-3 pb-4">-->
<!--                        <div class="lg:block hidden">-->
<!--                            <Pagination :links="props.users.meta"/>-->
<!--                        </div>-->

<!--                        <div class="lg:hidden block">-->
<!--                            <PaginationWithoutLinks :links="props.users"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
