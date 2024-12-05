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
import SelectInput from "@/Components/SelectInput.vue";
import Pagination1 from "@/Components/Pagination1.vue";
import PaginationWithoutLinks1 from "@/Components/PaginationWithoutLinks1.vue";

const props = defineProps({
    liftings: Object,
    filters: Object,
    status: String,
    filteredDepositTotal: Number,
    unfilteredDepositTotal: Number,
})

// Reactive filters object
const filters = ref({ ...props.filters });

// Filter function to trigger server-side filtering
const filter = () => {
    router.get(route('lifting.index'), filters.value, {
        preserveState: true,
        preserveScroll: true,
    });
};

// Reset Filters function
const resetFilters = () => {
    // Clear all filters
    filters.value = {
        startDate: null,
        endDate: null,
    };

    // Refresh the page without filters
    router.get(route('lifting.index'), {}, {
        preserveState: false,
        preserveScroll: true,
    });
}
const delLifting = (id, house) => {
    if (confirm(`Are you sure to delete "${house}"?`))
    {
        router.delete(route('lifting.destroy', id));
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
                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">

                        <p>Deposit: {{new Intl.NumberFormat('en-IN', {style: 'currency', currency: 'BDT'}).format(filteredDepositTotal)}}</p>
                        <p>Total Deposit: {{new Intl.NumberFormat('en-IN', {style: 'currency', currency: 'BDT'}).format(unfilteredDepositTotal)}}</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">

                        <div class="flex justify-end mb-5">
                            <div class="flex items-end gap-2">
                                <!-- Start Date -->
                                <TextInput
                                    v-model="filters.startDate"
                                    @change="filter"
                                    label="Start Date"
                                    icon="calendar"
                                    type="date"
                                />

                                <!-- End Date -->
                                <TextInput
                                    v-model="filters.endDate"
                                    @change="filter"
                                    label="End Date"
                                    icon="calendar"
                                    type="date"
                                />

                                <!-- Reset Button -->
                                <button class="bg-red-600 text-white py-2 px-5 rounded-md" @click="resetFilters"><i class="fa-solid fa-rotate"></i></button>
                            </div>
                        </div>


                        <table class="w-full whitespace-nowrap">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>House</th>
                                <th>Itop-Up</th>
                                <th>Products</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(lifting, i) in props.liftings.data" :key="lifting.id" class="font-semibold">
                                <!-- SL -->
                                <td class="text-center">{{++i}}</td>

                                <!-- House -->
                                <td class="text-center">
                                    {{lifting.house.data.name}}
                                    <p class="text-sm text-slate-400">{{lifting.house.data.code}}</p>
                                </td>

                                <!-- ItopUp -->
                                <td class="text-center">
                                    <p title="Itop-Up Amount">
                                        {{new Intl.NumberFormat('en-IN').format(lifting.itopup)}}
                                    </p>
                                    <p title="Bank deposit amount" class="text-sm text-green-400">
                                        {{new Intl.NumberFormat('en-IN').format(lifting.deposit)}}
                                    </p>
                                    <p class="text-xs text-slate-400">{{lifting.attempt}} Lifting</p>
                                    <p class="text-xs text-slate-400">{{ lifting.created }}</p>
                                </td>

                                <!-- Products -->
                                <td>
                                    <div class="grid xl:grid-cols-4 lg:grid-cols-3 gap-4">
                                        <div v-for="(item, index) in lifting.products" :key="index">
                                            <!-- Product Category, Sub Category, Code -->
                                            <p v-if="item.code">
                                                <span v-if="item.category !== 'SIM'">{{item.sub_category}},</span>
                                                {{item.code}}
                                            </p>

                                            <!-- Product Quantity -->
                                            <p v-if="item.quantity" class="text-sm text-slate-400">
                                                Quantity: {{new Intl.NumberFormat('en-IN').format(item.quantity)}}p
                                            </p>

                                            <!-- Product Lifting Price -->
                                            <p v-if="item.lifting_price" class="text-xs text-slate-400">Lifting Price: {{new Intl.NumberFormat('en-IN', {style: 'currency', currency: 'BDT', maximumSignificantDigits: 8}).format(item.lifting_price)}}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Action -->
                                <td class="text-center space-x-2">
                                    <Link :href="route('lifting.edit', lifting.id)" class="hover:text-green-400">Edit</Link>
                                    <button class="text-red-600 hover:text-red-500" @click="delLifting(lifting.id, lifting.dd_house.name)">Delete</button>
                                </td>
                            </tr>

                            <tr v-if="props.liftings.data.length < 1">
                                <td colspan="8">No data found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 pb-4">
                        <div class="lg:block hidden">
                            <Pagination1 :data="props.liftings"/>
                        </div>

                        <div class="lg:hidden block">
                            <PaginationWithoutLinks1 :data="props.liftings"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
