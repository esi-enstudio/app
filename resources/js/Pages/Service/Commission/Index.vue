<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from 'vue';
import SelectInput from "@/Components/SelectInput.vue";
import {router} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import Pagination1 from "@/Components/Pagination1.vue";
import PaginationWithoutLinks1 from "@/Components/PaginationWithoutLinks1.vue";
import SessionMessage from "@/Components/SessionMessage.vue";

// Props passed from the server
const props = defineProps({
    commissions: Object,
    filters: Object,
    status: String,
    houses: Array, // Related data like DD Houses
});

// Reactive filters object
const filters = ref({ ...props.filters });

// Filter function to trigger server-side filtering
const filter = () => {
    router.get(route('commission.index'), filters.value, {
        preserveState: true,
        preserveScroll: true,
    });
};

// Reset Filters function
const resetFilters = () => {
    // Clear all filters
    filters.value = {
        dd_house_id: '',
        for: '',
        type: '',
        month: '',
        received_date: '',
    };

    // Refresh the page without filters
    router.get(route('commission.index'), {}, {
        preserveState: false,
        preserveScroll: true,
    });
};

const delCommission = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" ?`))
    {
        router.delete(route('commission.destroy', id));
    }
}

const exportData = () => {
    const queryParams = new URLSearchParams(filters.value).toString();
    window.location.href = `${route('commission.export')}?${queryParams}`;
};
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

        <!-- Filter Section -->
        <div class="py-5">
            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">
                        <div class="flex items-center justify-between mb-5">
                            <!-- Section Title -->
                            <p class="text-2xl">Commission Filter</p>

                            <div class="flex items-center justify-between gap-3">
                                <!-- Reset Button -->
                                <button class="bg-red-600 py-2 px-5 rounded-md" @click="resetFilters"><i class="fa-solid fa-rotate"></i></button>
                                <!-- Print Button -->
                                <button @click="exportData" class="bg-green-600 py-2 px-5 rounded-md"><i class="fa-solid fa-file-excel"></i></button>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-5 gap-6 mb-5">
                            <!-- House -->
                            <SelectInput
                                label="House"
                                icon="house"
                                v-model="filters.house"
                                @change="filter"
                            >
                                <option
                                    v-for="house in houses"
                                    :key="house.id"
                                    :value="house.id"
                                >
                                    {{house.code}}
                                </option>

                                <option v-if="props.houses.length < 1">
                                    No House found
                                </option>
                            </SelectInput>
                            <!-- For -->
                            <SelectInput
                                label="Commission For"
                                icon="people-arrows"
                                v-model="filters.for"
                                @change="filter"
                            >
                                <option value="DD">DD House</option>
                                <option value="Manager">Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Rso">Rso</option>
                                <option value="Retailer">Retailer</option>
                            </SelectInput>
                            <!-- Type -->
                            <SelectInput
                                label="Commission Type"
                                icon="font-awesome"
                                v-model="filters.type"
                                @change="filter"
                            >
                                <option value="">All Type</option>
                                <option value="regional_budget">Regional Budget</option>
                                <option value="shera_partner">Shera Partner</option>
                                <option value="ga">GA</option>
                                <option value="roi_support">ROI Support</option>
                                <option value="sc_lifting">SC Lifting</option>
                                <option value="weekly_activation">Weekly Activation</option>
                                <option value="deno">Deno</option>
                                <option value="accelerate">Accelerate</option>
                                <option value="bundle_booster">Bundle Booster</option>
                                <option value="recharge_data_voice_mix">Recharge, Data, Voice, Mix</option>
                                <option value="bsp_rent">BSP Rent</option>
                                <option value="my_bl_referral">My BL Referral</option>
                                <option value="other">Other</option>
                            </SelectInput>
                            <!-- Month -->
                            <TextInput
                                label="Month"
                                icon="calendar"
                                type="month"
                                v-model="filters.month"
                                @change="filter"
                            />
                            <!-- Receive Date -->
                            <TextInput
                                label="Receive Date"
                                icon="calendar"
                                type="date"
                                v-model="filters.receive_date"
                                @change="filter"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Section End -->

        <!-- Table Section -->
        <div class="py-5">
            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
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
                                    {{commission.dd_house.name}}
                                    <p class="text-sm text-slate-400">{{commission.dd_house.code}}</p>
                                </td>

                                <!-- Commission For -->
                                <td>
                                    {{commission.for}}
                                    <p class="text-sm text-slate-400">{{commission.c_type}}</p>
                                </td>

                                <!-- Commission Name -->
                                <td>
                                    {{commission.name}}
                                    <p class="text-sm text-slate-400">{{commission.month_name}}</p>
                                </td>

                                <!-- Net Amount -->
                                <td>
                                    {{commission.taka}}
                                </td>

                                <!-- Receive Date -->
                                <td>
                                    {{commission.receive}}
                                </td>

                                <!-- Status -->
                                <td class="text-center">
                                    <span v-if="commission.status === 'pending'" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{commission.c_status}}</span>

                                    <span v-else class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{commission.c_status}}</span>
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
                            <Pagination1 :data="props.commissions"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks1 :data="props.commissions"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Section End -->

    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
