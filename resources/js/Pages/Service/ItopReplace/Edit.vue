<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";

const props = defineProps({
    itopReplace: Object,
})

const form = useForm({
    number: props.itopReplace.number,
    sim_serial: props.itopReplace.sim_serial,
    balance: props.itopReplace.balance,
    reason: props.itopReplace.reason,
    remarks: props.itopReplace.remarks,
    description: props.itopReplace.description,
    status: props.itopReplace.status,
})

</script>

<template>
    <Head title="Update replace"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Update Replace
                </h2>

                <div>
                    <Link :href="route('itopReplace.index')" class="hover:text-green-400">Back to list</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <form @submit.prevent="form.put(route('itopReplace.update', props.itopReplace.id))">
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

                                <!-- Remarks -->
                                <TextInput
                                    label="Remarks"
                                    icon="comments"
                                    v-model="form.remarks"
                                    :message="form.errors.remarks"
                                />

                                <!-- Status -->
                                <SelectInput
                                    label="Status"
                                    icon="signal"
                                    v-model="form.status">
                                    <option value="complete">Complete</option>
                                    <option value="processing">Processing</option>
                                    <option value="pending">Pending</option>
                                </SelectInput>

                                <!-- Description -->
                                <TextArea
                                    label="Description"
                                    icon="paragraph"
                                    v-model="form.description"
                                    :message="form.errors.description"
                                />
                            </div>

                            <PrimaryButton :disable="form.processing">Save Changes</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
