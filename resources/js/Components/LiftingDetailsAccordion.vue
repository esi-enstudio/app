<template>
    <div class="hs-accordion-treeview-root" role="tree" aria-orientation="vertical">
        <!-- 1st Level Accordion Group -->
        <div class="hs-accordion-group" role="group">
            <!-- 1st Level Accordion -->
            <div v-for="house in groupedData" :key="house.name" class="mb-5 hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-heading-one">
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
                            <div class="grow">
                              <span class="text-sm text-gray-800 dark:text-neutral-200">
                                {{house.name}}
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
                        <div v-for="category in house.categories" :key="category.name" class="hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-sub-heading-one">
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
                                        <div class="grow">
                                            <p class="text-sm dark:text-neutral-200">
                                              {{ category.name }} (
                                                <span class="font-semibold text-red-500">Type: {{category.count}}</span>,
                                                <span class="font-semibold text-green-500">Qty: {{numberFormat(category.quantity)}}</span>,
                                                <span class="font-semibold text-blue-500">Price: {{numberFormat(category.price)}}</span>
                                                )
                                            </p>
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
                                    <div
                                        v-for="subcategory in category.subcategories" :key="subcategory.name"
                                        class="hs-accordion active" role="treeitem" aria-expanded="true" id="hs-basic-usage-example-tree-sub-level-two-heading-one">
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
                                                    <div class="grow">
                                                      <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ subcategory.name }}
                                                          (
                                                            <span class="font-semibold text-red-500">Type: {{subcategory.count}}</span>,
                                                            <span class="font-semibold text-green-500">Qty: {{numberFormat(subcategory.quantity)}}</span>,
                                                            <span class="font-semibold text-blue-500">Price: {{numberFormat(subcategory.price)}}</span>
                                                          )
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
                                                    <div
                                                        v-for="code in subcategory.codes" :key="code.product_code"
                                                        class="flex items-center gap-x-3">
                                                        <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                        </svg>
                                                        <div class="grow">
                                                            <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                              {{code.code}}:
                                                                <span class="font-semibold text-pink-500">{{numberFormat(code.quantity)}}</span>,
                                                                <span class="font-semibold text-blue-500">Price: {{numberFormat(code.price)}}</span>
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
</template>

<script setup>
defineProps({
    groupedData: Object,
});

const numberFormat = (int) => new Intl.NumberFormat('en-IN').format(int);
</script>

<style lang="scss" scoped>

</style>
