<script setup>

import {router, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import Pagination1 from "@/Components/Pagination1.vue";
import PaginationWithoutLinks1 from "@/Components/PaginationWithoutLinks1.vue";

const page = usePage();

const props = defineProps({
    liftings: Object,
    allTimeGroupedData: Object,
    currentMonthGroupedData: Object,
    filters: Object,
    status: String,
})

// const numberFormat = (data) => console.log(data);
const numberFormat = (int) => new Intl.NumberFormat('en-IN').format(int);

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

        <div class="py-12 mx-auto max-w-7xl sm:px-4 lg:px-8">
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
                                <button class="text-red-600 hover:text-red-500" @click="delLifting(lifting.id, lifting.house.data.name)">Delete</button>
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

        <div class="pb-5 mx-auto max-w-7xl sm:px-4 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="grid lg:grid-cols-3 p-3 text-gray-900 dark:text-gray-100">

                    <div>
                        <h3 class="font-semibold">All Time Record</h3>
                        <!-- Tree Root -->
                        <div class="hs-accordion-treeview-root" role="tree" aria-orientation="vertical">
                            <!-- 1st Level Accordion Group -->
                            <div class="hs-accordion-group" role="group">
                                <!-- 1st Level Accordion -->
                                <div v-for="(categories, houseName) in props.allTimeGroupedData" :key="houseName" class="mb-10 hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-heading-one">
                                    <!-- 1st Level Accordion Heading -->
                                    <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                                        <button class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-expanded="true" aria-controls="hs-basic-usage-example-tree-collapse-one">
                                            <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                                            </svg>
                                        </button>

                                        <div class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                                            <div class="flex items-center gap-x-3">
                                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
                                                </svg>
                                                <div class="grow">
                                                  <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{houseName}}
                                                  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 1st Level Accordion Heading -->

                                    <!-- 1st Level Collapse -->
                                    <div id="hs-basic-usage-example-tree-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="group" aria-labelledby="hs-basic-usage-example-tree-heading-one">
                                        <!-- 2nd Level Accordion Group -->
                                        <div class="hs-accordion-group ps-7 relative before:absolute before:top-0 before:start-3 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700" role="group" data-hs-accordion-always-open="">
                                            <!-- 2nd Level Nested Accordion -->
                                            <div v-for="(subcategories, category) in categories" :key="category" class="hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-sub-heading-one">
                                                <!-- 2nd Level Accordion Heading -->
                                                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                                                    <button class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-expanded="true" aria-controls="hs-basic-usage-example-tree-sub-collapse-one">
                                                        <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                            <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                                                        </svg>
                                                    </button>

                                                    <div class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                                                        <div class="flex items-center gap-x-3">
                                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
                                                            </svg>
                                                            <div class="grow">
                                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                                  {{ category }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End 2nd Level Accordion Heading -->

                                                <!-- 2nd Level Collapse -->
                                                <div id="hs-basic-usage-example-tree-sub-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="group" aria-labelledby="hs-basic-usage-example-tree-sub-heading-one">
                                                    <!-- 3rd Level Accordion Group -->
                                                    <div class="hs-accordion-group ps-7 relative before:absolute before:top-0 before:start-3 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700" role="group" data-hs-accordion-always-open="">
                                                        <!-- 3rd Level Accordion -->
                                                        <div v-for="(codes, subcategory) in subcategories" :key="subcategory" class="hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-sub-level-two-heading-one">
                                                            <!-- 3rd Level Accordion Heading -->
                                                            <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                                                                <button class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-expanded="true" aria-controls="hs-basic-usage-example-tree-sub-level-two-collapse-one">
                                                                    <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M5 12h14"></path>
                                                                        <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                                                                    </svg>
                                                                </button>

                                                                <div class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                                                                    <div class="flex items-center gap-x-3">
                                                                        <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
                                                                        </svg>
                                                                        <div class="grow">
                                                                          <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                                            {{subcategory}}
                                                                          </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End 3rd Level Accordion Heading -->

                                                            <!-- 3rd Level Collapse -->
                                                            <div id="hs-basic-usage-example-tree-sub-level-two-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="group" aria-labelledby="hs-basic-usage-example-tree-sub-level-two-heading-one">
                                                                <div class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">
                                                                    <!-- 3rd Level Item -->
                                                                    <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer" role="treeitem">
                                                                        <div v-for="(details, code) in codes" :key="code" class="flex items-center gap-x-3">
                                                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                                                <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                                            </svg>
                                                                            <div class="grow">
                                                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                                                  {{code}}: {{numberFormat(details.total_quantity)}}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End 3rd Level Item -->
                                                                </div>
                                                            </div>
                                                            <!-- End 3rd Level Collapse -->
                                                        </div>
                                                        <!-- End 3rd Level Accordion -->
                                                    </div>
                                                    <!-- End 3rd Level Accordion Group -->
                                                </div>
                                                <!-- End 2nd Level Collapse -->
                                            </div>
                                            <!-- End 2nd Level Nested Accordion -->
                                        </div>
                                        <!-- 2nd Level Accordion Group -->
                                    </div>
                                    <!-- End 1st Level Collapse -->
                                </div>
                                <!-- End 1st Level Accordion -->
                            </div>
                            <!-- End 1st Level Accordion Group -->
                        </div>
                        <!-- End Tree Root -->
                    </div>

                    <div>
                        <h3 class="font-semibold">Current Month Record</h3>
                        <!-- Tree Root -->
                        <div class="hs-accordion-treeview-root" role="tree" aria-orientation="vertical">
                            <!-- 1st Level Accordion Group -->
                            <div class="hs-accordion-group" role="group">
                                <!-- 1st Level Accordion -->
                                <div v-for="(categories, houseName) in props.currentMonthGroupedData" :key="houseName" class="mb-10 hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-heading-one">
                                    <!-- 1st Level Accordion Heading -->
                                    <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                                        <button class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-expanded="true" aria-controls="hs-basic-usage-example-tree-collapse-one">
                                            <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                                            </svg>
                                        </button>

                                        <div class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                                            <div class="flex items-center gap-x-3">
                                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
                                                </svg>
                                                <div class="grow">
                                                  <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{houseName}}
                                                  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 1st Level Accordion Heading -->

                                    <!-- 1st Level Collapse -->
                                    <div id="hs-basic-usage-example-tree-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="group" aria-labelledby="hs-basic-usage-example-tree-heading-one">
                                        <!-- 2nd Level Accordion Group -->
                                        <div class="hs-accordion-group ps-7 relative before:absolute before:top-0 before:start-3 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700" role="group" data-hs-accordion-always-open="">
                                            <!-- 2nd Level Nested Accordion -->
                                            <div v-for="(subcategories, category) in categories" :key="category" class="hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-sub-heading-one">
                                                <!-- 2nd Level Accordion Heading -->
                                                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                                                    <button class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-expanded="true" aria-controls="hs-basic-usage-example-tree-sub-collapse-one">
                                                        <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                            <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                                                        </svg>
                                                    </button>

                                                    <div class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                                                        <div class="flex items-center gap-x-3">
                                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
                                                            </svg>
                                                            <div class="grow">
                                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                                  {{ category }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End 2nd Level Accordion Heading -->

                                                <!-- 2nd Level Collapse -->
                                                <div id="hs-basic-usage-example-tree-sub-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="group" aria-labelledby="hs-basic-usage-example-tree-sub-heading-one">
                                                    <!-- 3rd Level Accordion Group -->
                                                    <div class="hs-accordion-group ps-7 relative before:absolute before:top-0 before:start-3 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700" role="group" data-hs-accordion-always-open="">
                                                        <!-- 3rd Level Accordion -->
                                                        <div v-for="(codes, subcategory) in subcategories" :key="subcategory" class="hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-sub-level-two-heading-one">
                                                            <!-- 3rd Level Accordion Heading -->
                                                            <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                                                                <button class="hs-accordion-toggle size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-expanded="true" aria-controls="hs-basic-usage-example-tree-sub-level-two-collapse-one">
                                                                    <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M5 12h14"></path>
                                                                        <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                                                                    </svg>
                                                                </button>

                                                                <div class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                                                                    <div class="flex items-center gap-x-3">
                                                                        <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
                                                                        </svg>
                                                                        <div class="grow">
                                                                          <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                                            {{subcategory}}
                                                                          </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End 3rd Level Accordion Heading -->

                                                            <!-- 3rd Level Collapse -->
                                                            <div id="hs-basic-usage-example-tree-sub-level-two-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="group" aria-labelledby="hs-basic-usage-example-tree-sub-level-two-heading-one">
                                                                <div class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">
                                                                    <!-- 3rd Level Item -->
                                                                    <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer" role="treeitem">
                                                                        <div v-for="(details, code) in codes" :key="code" class="flex items-center gap-x-3">
                                                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                                                <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                                            </svg>
                                                                            <div class="grow">
                                                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                                                  {{code}}: {{numberFormat(details.total_quantity)}}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End 3rd Level Item -->
                                                                </div>
                                                            </div>
                                                            <!-- End 3rd Level Collapse -->
                                                        </div>
                                                        <!-- End 3rd Level Accordion -->
                                                    </div>
                                                    <!-- End 3rd Level Accordion Group -->
                                                </div>
                                                <!-- End 2nd Level Collapse -->
                                            </div>
                                            <!-- End 2nd Level Nested Accordion -->
                                        </div>
                                        <!-- 2nd Level Accordion Group -->
                                    </div>
                                    <!-- End 1st Level Collapse -->
                                </div>
                                <!-- End 1st Level Accordion -->
                            </div>
                            <!-- End 1st Level Accordion Group -->
                        </div>
                        <!-- End Tree Root -->
                    </div>

                    <div>
                        <h3 class="font-semibold">Filtered Record</h3>
                        <p>Deposit: {{new Intl.NumberFormat('en-IN').format(page.props.filteredDepositSum)}}</p>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
