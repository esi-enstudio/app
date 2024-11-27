<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import {computed, ref, watch} from "vue";
import axios from "axios";

const props = defineProps({
    commission: Object,
    houses: Object,
})

const form = useForm({
    dd_house_id: props.commission.dd_house.id,
    for: props.commission.for,
    type: props.commission.type,
    name: props.commission.name,
    month: props.commission.month,
    amount: props.commission.amount,
    receive_date: props.commission.receive_date,
    description: props.commission.description,
    remarks: props.commission.remarks,
    status: props.commission.status,
})

</script>

<template>
    <Head title="Update Commission"/>
    <SessionMessage :status="props.status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Update commission
                </h2>

                <div>
                    <Link :href="route('commission.index')" class="hover:text-green-400">Back to list</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="text-2xl font-semibold mb-6">
                            <p>House: {{props.commission.dd_house.name}}</p>
                            <p>
                                Commission For : {{props.commission.for}}
                                <span v-if="props.commission.for === 'Manager'">({{props.commission.manager.name}})</span>
                                <span v-if="props.commission.for === 'Supervisor'">({{props.commission.supervisor.name}})</span>
                                <span v-if="props.commission.for === 'Rso'">({{props.commission.rso.user.name}})</span>
                                <span v-if="props.commission.for === 'Retailer'">({{props.commission.retailer.user.name}})</span>
                            </p>
                            <input v-model="form.dd_house_id" type="hidden" value="{{props.commission.dd_house.id}}">
                            <input v-model="form.for" type="hidden" value="{{props.commission.for}}">
                        </div>

                        <form @submit.prevent="form.put(route('commission.update', props.commission.id))">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Type -->
                                <SelectInput
                                    label="Commission Type"
                                    icon="font-awesome"
                                    v-model="form.type"
                                    :message="form.errors.type"
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

                                <!-- Commission Name -->
                                <TextInput
                                    label="Commission Name"
                                    icon="paragraph"
                                    v-model="form.name"
                                    :message="form.errors.name"
                                />

                                <!-- Month -->
                                <TextInput
                                    label="Month"
                                    icon="calendar"
                                    type="month"
                                    v-model="form.month"
                                    :message="form.errors.month"
                                />

                                <!-- Net Amount -->
                                <TextInput
                                    label="Net Amount"
                                    icon="bangladeshi-taka-sign"
                                    v-model="form.amount"
                                    :message="form.errors.amount"
                                />

                                <!-- Receive Date -->
                                <TextInput
                                    label="Receive Date"
                                    icon="calendar"
                                    type="date"
                                    v-model="form.receive_date"
                                    :message="form.errors.receive_date"
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
                                    <option value="Complete">Complete</option>
                                    <option value="Pending">Pending</option>
                                </SelectInput>

                                <!-- Description -->
                                <TextArea
                                    label="Description"
                                    icon="paragraph"
                                    v-model="form.description"
                                    :message="form.errors.description"
                                />

                            </div>

                            <div class="flex items-center justify-between">
                                <PrimaryButton :disable="form.processing">Save Changes</PrimaryButton>
                                <PrimaryButton class="bg-red-500" :disable="form.processing">Delete</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
