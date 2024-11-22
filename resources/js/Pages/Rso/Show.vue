<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    rso: Object,
})

const delRso = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" rso?`))
    {
        router.delete(route('rso.destroy', id));
    }
}

</script>

<template>
    <Head title="RS0 Details" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    <span class="text-2xl italic">
                        {{ props.rso.user.name}}
                    </span> Details...
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="mb-4 text-right">
                            <Link :href="route('rso.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <table>
                            <tr>
                                <td colspan="2">
                                    <img
                                        :src="props.rso.user.avatar
                                        ? `/storage/${props.rso.user.avatar}`
                                        : `https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png`"
                                        alt="Rso Avatar">
                                </td>
                            </tr>

                            <tr>
                                <td>ID</td>
                                <td>{{props.rso.id}}</td>
                            </tr>

                            <tr>
                                <td>Cluster</td>
                                <td>{{props.rso.dd_house.cluster ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>Region</td>
                                <td>{{props.rso.dd_house.region ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>DD House</td>
                                <td>{{props.rso.dd_house.code}} - {{props.rso.dd_house.name}}</td>
                            </tr>

                            <tr>
                                <td>Name</td>
                                <td>{{props.rso.user.name}}</td>
                            </tr>

                            <tr>
                                <td>Bank Account Name</td>
                                <td>{{props.rso.bank_account_name}}</td>
                            </tr>

                            <tr>
                                <td>Ac Number</td>
                                <td>{{props.rso.number}}</td>
                            </tr>

                            <tr>
                                <td>Pool Number</td>
                                <td>{{props.rso.pool_number}}</td>
                            </tr>

                            <tr>
                                <td>Personal Number</td>
                                <td>{{props.rso.user.phone}}</td>
                            </tr>

                            <tr>
                                <td>OSRM Code</td>
                                <td>{{props.rso.osrm_code}}</td>
                            </tr>

                            <tr>
                                <td>Employee Code</td>
                                <td>{{props.rso.employee_code}}</td>
                            </tr>

                            <tr>
                                <td>RS0 Code</td>
                                <td>{{props.rso.code}}</td>
                            </tr>

                            <tr>
                                <td>Bank Name</td>
                                <td>{{props.rso.bank_name}}</td>
                            </tr>

                            <tr>
                                <td>Account Number</td>
                                <td>{{props.rso.bank_account_number}}</td>
                            </tr>

                            <tr>
                                <td>Brunch Name</td>
                                <td>{{props.rso.brunch_name}}</td>
                            </tr>

                            <tr>
                                <td>Routing Number</td>
                                <td>{{props.rso.routing_number}}</td>
                            </tr>

                            <tr>
                                <td>Religion</td>
                                <td>{{props.rso.religion}}</td>
                            </tr>

                            <tr>
                                <td>Education</td>
                                <td>{{props.rso.education}}</td>
                            </tr>

                            <tr>
                                <td>Blood Group</td>
                                <td>{{props.rso.blood_group ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>Gender</td>
                                <td>{{props.rso.gender}}</td>
                            </tr>

                            <tr>
                                <td>Present Address</td>
                                <td>{{props.rso.present_address}}</td>
                            </tr>

                            <tr>
                                <td>Permanent Address</td>
                                <td>{{props.rso.present_address}}</td>
                            </tr>

                            <tr>
                                <td>Father Name</td>
                                <td>{{props.rso.father_name}}</td>
                            </tr>

                            <tr>
                                <td>Mother Name</td>
                                <td>{{props.rso.mother_name}}</td>
                            </tr>

                            <tr>
                                <td>Market Type</td>
                                <td>{{props.rso.market_type}}</td>
                            </tr>

                            <tr>
                                <td>Salary</td>
                                <td>{{props.rso.salary}}</td>
                            </tr>

                            <tr>
                                <td>Category</td>
                                <td>{{props.rso.category}}</td>
                            </tr>

                            <tr>
                                <td>Date Of Birth</td>
                                <td>{{props.rso.dateOfBirth}}</td>
                            </tr>

                            <tr>
                                <td>NID</td>
                                <td>{{props.rso.nid}}</td>
                            </tr>

                            <tr>
                                <td>Thana</td>
                                <td>{{props.rso.thana}}</td>
                            </tr>

                            <tr>
                                <td>District</td>
                                <td>{{props.rso.district}}</td>
                            </tr>

                            <tr>
                                <td>Division</td>
                                <td>{{props.rso.division}}</td>
                            </tr>

                            <tr>
                                <td>SR No</td>
                                <td>{{props.rso.sr_no}}</td>
                            </tr>

                            <tr>
                                <td>Designation</td>
                                <td>{{props.rso.designation}}</td>
                            </tr>

                            <tr>
                                <td>Joining Date</td>
                                <td>{{props.rso.join}}</td>
                            </tr>

                            <tr>
                                <td>Resign Date</td>
                                <td>{{props.rso.resign}}</td>
                            </tr>

                            <tr>
                                <td>Remarks</td>
                                <td>{{props.rso.remarks}}</td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td
                                    :class="props.rso.status === 1
                                    ? 'text-green-600 font-semibold'
                                    : 'text-red-600 font-semibold'"
                                >
                                    {{props.rso.status === 1 ? 'Active' : 'Inactive'}}
                                </td>
                            </tr>

                            <tr>
                                <td>Created</td>
                                <td>{{props.rso.created}}</td>
                            </tr>

                            <tr>
                                <td>Updated</td>
                                <td>{{props.rso.updated}}</td>
                            </tr>

                        </table>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Edit -->
                            <Link :href="route('rso.edit', props.rso.id)" class="block hover:text-green-400">Edit</Link>

                            <!-- Delete -->
                            <button class="hover:text-red-500 hover:font-semibold" @click="delRso(props.rso.id, props.rso.user.name)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
