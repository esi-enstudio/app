<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import {ref} from "vue";

const props = defineProps({
    houses: Object,
    status: String,
    // users: Object,
    // zms: Object,
    // managers: Object,
    // supervisors: Object,
    // rsos: Object,
})

const form = useForm({
    dd_house_id: null,
    for: null,
    type: null,
    name: null,
    month: null,
    amount: null,
    receive_date: new Date().toISOString().slice(0,10),
    description: null,
    remarks: null,
})

const submit = () => {
    form.post(route('commission.store'), {
        onSuccess: () => form.reset()
    })
}

</script>

<template>
    <Head title="Add New"/>
    <SessionMessage :status="props.status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Add new commission
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

                        <form @submit.prevent="submit">
                            <div class="grid md:grid-cols-2 gap-6">

                                <!-- House -->
                                <SelectInput
                                    label="House"
                                    icon="house"
                                    v-model="form.dd_house_id"
                                    :message="form.errors.dd_house_id"
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
                                    :message="form.errors.for"
                                >
                                    <option value="dd">DD House</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="rso">Rso</option>
                                    <option value="retailer">Retailer</option>
                                </SelectInput>

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

                                <!-- Description -->
                                <TextArea
                                    label="Description"
                                    icon="paragraph"
                                    v-model="form.description"
                                    :message="form.errors.description"
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
