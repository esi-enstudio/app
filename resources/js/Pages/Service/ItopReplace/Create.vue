<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";

const form = useForm({
    number: null,
    sim_serial: null,
    balance: null,
    reason: null,
    remarks: null,
    description: null,
})

</script>

<template>
    <Head title="Create replace"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new replace
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('itopReplace.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form @submit.prevent="form.post(route('itopReplace.store'))">
                            <div class="grid md:grid-cols-2 gap-6">

                                <!-- Itop Number -->
                                <TextInput
                                    label="Itop Number"
                                    icon="phone"
                                    v-model="form.number"
                                    :message="form.errors.number"
                                />

                                <!-- Serial Number -->
                                <TextInput
                                    label="Serial Number"
                                    icon="typo3"
                                    v-model="form.sim_serial"
                                    :message="form.errors.sim_serial"
                                />

                                <!-- Balance -->
                                <TextInput
                                    label="Balance"
                                    icon="bangladeshi-taka-sign"
                                    v-model="form.balance"
                                    :message="form.errors.balance"
                                />

                                <!-- Reason -->
                                <TextInput
                                    label="Reason"
                                    icon="question"
                                    v-model="form.reason"
                                    :message="form.errors.reason"
                                />

                                <!-- Description -->
                                <TextArea
                                    label="Description"
                                    icon="paragraph"
                                    v-model="form.description"
                                    :message="form.errors.description"
                                />

                                <!-- Remarks -->
                                <TextInput
                                    label="Remarks"
                                    icon="comments"
                                    v-model="form.remarks"
                                    :message="form.errors.remarks"
                                />
                            </div>

                            <PrimaryButton :disable="form.processing">Add New Entry</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
