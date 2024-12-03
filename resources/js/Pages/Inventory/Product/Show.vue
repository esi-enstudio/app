<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
})

const delUser = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" user?`))
    {
        router.delete(route('user.destroy', id));
    }
}

</script>

<template>
    <Head title="House Details" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    <span class="text-2xl italic">{{ `"${props.user.name}"` }}</span> User Details
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="mb-4 text-right">
                            <Link :href="route('user.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <table>
                            <tr>
                                <td colspan="2">
                                    <img
                                        :src="props.user.avatar
                                        ? `/storage/${props.user.avatar}`
                                        : `https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png`"
                                        alt="User Avatar">
                                </td>
                            </tr>

                            <tr>
                                <td>Name</td>
                                <td>{{props.user.name}}</td>
                            </tr>

                            <tr>
                                <td>Phone Number</td>
                                <td>{{props.user.phone}}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{props.user.email}}</td>
                            </tr>

                            <tr>
                                <td>Role</td>
                                <td>{{props.user.role}}</td>
                            </tr>

                            <tr>
                                <td>Remember Token</td>
                                <td>{{props.user.remember}}</td>
                            </tr>

                            <tr>
                                <td>Remarks</td>
                                <td>{{props.user.remarks}}</td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td :class="props.user.status === 1 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'">{{props.user.status === 1 ? 'Active' : 'Inactive'}}</td>
                            </tr>

                            <tr>
                                <td>Email Verified</td>
                                <td>{{props.user.email_verified}}</td>
                            </tr>

                            <tr>
                                <td>Created Date</td>
                                <td>{{props.user.created}}</td>
                            </tr>

                            <tr>
                                <td>Last Update</td>
                                <td>{{props.user.updated}} <span class="font-bold">({{props.user.update}})</span></td>
                            </tr>

                            <tr>
                                <td>Disabled At</td>
                                <td>{{props.user.disabled}}</td>
                            </tr>

                        </table>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Edit -->
                            <Link :href="route('user.edit', props.user.id)" class="block hover:text-green-400">Edit</Link>

                            <!-- Delete -->
                            <button class="hover:text-red-500 hover:font-semibold" @click="delUser(props.user.id, props.user.name)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
