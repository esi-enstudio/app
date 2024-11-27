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
    houses: Object,
    status: String,
})

let managers = ref({})
let supervisors = ref({})
let rsos = ref({})
let retailers = ref({})

const form = useForm({
    dd_house_id: null,
    for: null,
    manager: null,
    supervisor: null,
    rso_id: null,
    retailer_id: null,
    type: null,
    name: null,
    month: null,
    amount: null,
    receive_date: new Date().toISOString().slice(0,10),
    description: null,
    remarks: null,
})

const showManagerField = computed(() => form.for === "Manager");
const showSupervisorField = computed(() => form.for === "Supervisor");
const showRsoField = computed(() => form.for === "Rso");
const showRetailerField = computed(() => form.for === "Retailer");

// Handle parent field changes
const handleForChange = () => {
    if (form.for !== "Manager") {
        form.manager = ""; // Reset child field if it's hidden
    }

    if(form.for !== "Supervisor") {
        form.supervisor = ""; // Reset child field if it's hidden
    }

    if(form.for !== "Rso") {
        form.rso_id = ""; // Reset child field if it's hidden
    }

    if(form.for !== "Retailer") {
        form.retailer_id = ""; // Reset child field if it's hidden
    }
};

// Get data for selected house
watch(() => form.dd_house_id, (id) => {

    // Get Manager for selected house
    axios.get('/api/managers?id=' + id).then((response) => {
        managers.value = response.data
    })

    // Get Supervisor for selected house
    axios.get('/api/supervisors?id=' + id).then((response) => {
        supervisors.value = response.data
    })

    // Get Rso for selected house
    axios.get('/api/rsos?id=' + id).then((response) => {
        rsos.value = response.data
    })

    // Get Retailer for selected house
    axios.get('/api/retailers?id=' + id).then((response) => {
        retailers.value = response.data
    })
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
                                    @change="handleForChange"
                                    :message="form.errors.for"
                                >
                                    <option value="DD">DD House</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Rso">Rso</option>
                                    <option value="Retailer">Retailer</option>
                                </SelectInput>

                                <!-- Conditional Rendering -->
                                <!-- Manager -->
                                <SelectInput
                                    v-if="showManagerField"
                                    label="Manager"
                                    icon="people-arrows"
                                    v-model="form.manager"
                                    :message="form.errors.manager"
                                >
                                    <option v-for="manager in managers" :key="manager.id" :value="manager.id">
                                        {{manager.phone +' - '+ manager.name}}
                                    </option>
                                </SelectInput>

                                <!-- Supervisor -->
                                <SelectInput
                                    v-if="showSupervisorField"
                                    label="Supervisor"
                                    icon="people-arrows"
                                    v-model="form.supervisor"
                                    :message="form.errors.supervisor"
                                >
                                    <option v-for="supervisor in supervisors" :key="supervisor.id" :value="supervisor.id">
                                        {{supervisor.phone +' - '+ supervisor.name}}
                                    </option>
                                </SelectInput>

                                <!-- Rso -->
                                <SelectInput
                                    v-if="showRsoField"
                                    label="Rso"
                                    icon="people-arrows"
                                    v-model="form.rso_id"
                                    :message="form.errors.rso_id"
                                >
                                    <option v-for="rso in rsos" :key="rso.id" :value="rso.id">
                                        {{rso.user.phone +' - '+ rso.user.name}}
                                    </option>
                                </SelectInput>

                                <!-- Retailer -->
                                <SelectInput
                                    v-if="showRetailerField"
                                    label="Retailer"
                                    icon="people-arrows"
                                    v-model="form.retailer_id"
                                    :message="form.errors.retailer_id"
                                >
                                    <option v-for="retailer in retailers" :key="retailer.id" :value="retailer.id">
                                        {{retailer.code +' - '+ retailer.number}}
                                    </option>
                                </SelectInput>
                                <!-- Conditional Rendering End-->

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
