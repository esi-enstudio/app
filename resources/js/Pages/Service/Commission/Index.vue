<script setup>

import {router, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {debounce} from "lodash";
import {ref, watch} from "vue";
import TextInput from "@/Components/TextInput.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import PaginationWithoutLinks from "@/Components/PaginationWithoutLinks.vue";
import Verified from "@/Components/Verified.vue";
import SelectInput from "@/Components/SelectInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    commissions: Object,
    houses: Object,
    searchTerm: String,
    status: String,
})

const form = useForm({
    house: null,
    for: null,
    type: null,
    month: null,
    receive_date: null,
})

const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/commission', { search: query }, { preserveState:true }),
    500
))

const delCommission = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" ?`))
    {
        router.delete(route('commission.destroy', id));
    }
}
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
                        <form @submit.prevent="form.post(route('commission.filter'))">
                            <div class="grid lg:grid-cols-5 gap-6 mb-5">
                                <!-- House -->
                                <SelectInput
                                    label="House"
                                    icon="house"
                                    v-model="form.house"
                                    :message="form.errors.house"
                                >
                                    <option
                                        v-for="house in houses"
                                        :key="house.id"
                                        :value="house.id"
                                    >
                                        {{house.code}} - {{house.name}}
                                    </option>

                                    <option v-if="props.houses.length < 1">
                                        No House found
                                    </option>
                                </SelectInput>
                                <!-- For -->
                                <SelectInput
                                    label="Commission For"
                                    icon="people-arrows"
                                    v-model="form.for"
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
                                    v-model="form.type"
                                >
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
                                    v-model="form.month"
                                />
                                <!-- Receive Date -->
                                <TextInput
                                    label="Receive Date"
                                    icon="calendar"
                                    type="date"
                                    v-model="form.receive_date"
                                />
                            </div>

                            <div class="text-right">
                                <PrimaryButton :disable="form.processing">Apply Filter</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Section End -->

        <!-- Table Section -->
        <div class="py-5">
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
                                    {{commission.house.name}}
                                    <p class="text-sm text-slate-400">{{commission.house.code}}</p>
                                </td>

                                <!-- Commission For -->
                                <td>
                                    {{commission.for}}
                                    <p class="text-sm text-slate-400">{{commission.type}}</p>
                                </td>

                                <!-- Commission Name -->
                                <td>
                                    {{commission.name}}
                                    <p class="text-sm text-slate-400">{{commission.month}}</p>
                                </td>

                                <!-- Net Amount -->
                                <td>
                                    {{commission.amount}}
                                </td>

                                <!-- Receive Date -->
                                <td>
                                    {{commission.receive_date}}
                                </td>

                                <!-- Status -->
                                <td class="text-center">
                                    <span v-if="commission.status === 'Pending'" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{commission.status}}</span>

                                    <span v-else class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{commission.status}}</span>
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
                            <Pagination :links="props.commissions.meta"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks :links="props.commissions"/>
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
