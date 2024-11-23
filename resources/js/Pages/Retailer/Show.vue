<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    retailer: Object,
})
console.log(props.retailer)
const delRetailer = (id, name) => {

    if (confirm(`Are you sure to delete "${name}"?`))
    {
        router.delete(route('retailer.destroy', id));
    }
}

</script>

<template>
    <Head title="Retailer Details" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    <span class="text-2xl italic">
                        {{ props.retailer.name}}
                    </span> Details...
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="mb-4 text-right">
                            <Link :href="route('retailer.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <table>
                            <tr>
                                <td colspan="2">
                                    <img
                                        :src="props.retailer.user.avatar
                                        ? `/storage/${props.retailer.user.avatar}`
                                        : `https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png`"
                                        alt="Retailer Avatar">
                                </td>
                            </tr>

                            <tr>
                                <td>ID</td>
                                <td>{{props.retailer.id}}</td>
                            </tr>

                            <tr>
                                <td>Cluster</td>
                                <td>{{props.retailer.dd_house.cluster ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>Region</td>
                                <td>{{props.retailer.dd_house.region ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>DD House</td>
                                <td>
                                    {{
                                        props.retailer.dd_house.code
                                        +' - '+
                                        props.retailer.dd_house.name
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Retailer Name</td>
                                <td>
                                    {{
                                        props.retailer.name
                                        +' - '+
                                        props.retailer.code
                                        +' - '+
                                        props.retailer.number
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Owner Name</td>
                                <td>{{
                                        props.retailer.user.name
                                        +' - '+
                                        props.retailer.user.phone
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Type</td>
                                <td>{{ props.retailer.type }}</td>
                            </tr>

                            <tr>
                                <td>Enabled</td>
                                <td>{{ props.retailer.enabled ? 'Yes' : 'No' }}</td>
                            </tr>

                            <tr>
                                <td>SSO</td>
                                <td>{{ props.retailer.sso ? 'Yes' : 'No' }}</td>
                            </tr>

                            <tr>
                                <td>Service Point</td>
                                <td>{{ props.retailer.service_point ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Category</td>
                                <td>{{ props.retailer.category ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Father Name</td>
                                <td>{{ props.retailer.father_name ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Mother Name</td>
                                <td>{{ props.retailer.mother_name ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Division</td>
                                <td>{{ props.retailer.division ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>District</td>
                                <td>{{ props.retailer.district ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Thana</td>
                                <td>{{ props.retailer.thana ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Address</td>
                                <td>{{ props.retailer.address ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Date Of Birth</td>
                                <td>{{ props.retailer.dob ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>NID</td>
                                <td>{{ props.retailer.nid ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Latitude</td>
                                <td>{{ props.retailer.lat }}</td>
                            </tr>

                            <tr>
                                <td>Longitude</td>
                                <td>{{ props.retailer.long }}</td>
                            </tr>

                            <tr>
                                <td>Rso Name</td>
                                <td>
                                    {{
                                        props.retailer.rso.user.name
                                        +' - '+
                                        props.retailer.rso.number
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Zm</td>
                                <td>
                                    {{
                                        props.retailer.zm.name
                                        +' - '+
                                        props.retailer.zm.phone
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Manager</td>
                                <td>
                                    {{
                                        props.retailer.manager.name
                                        +' - '+
                                        props.retailer.manager.phone
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Supervisor</td>
                                <td>
                                    {{
                                        props.retailer.supervisor.name
                                        +' - '+
                                        props.retailer.supervisor.phone
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td>{{ props.retailer.description }}</td>
                            </tr>

                            <tr>
                                <td>Remarks</td>
                                <td>{{ props.retailer.remarks }}</td>
                            </tr>

                            <tr>
                                <td>Created</td>
                                <td>{{props.retailer.created}}</td>
                            </tr>

                            <tr>
                                <td>Updated</td>
                                <td>{{props.retailer.updated}}</td>
                            </tr>

                            <tr>
                                <td>Disabled</td>
                                <td>{{props.retailer.disabled}}</td>
                            </tr>
                        </table>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Edit -->
                            <Link :href="route('retailer.edit', props.retailer.id)" class="block hover:text-green-400">Edit</Link>

                            <!-- Delete -->
                            <button class="hover:text-red-500 hover:font-semibold" @click="delRetailer(props.retailer.id, props.retailer.name)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
