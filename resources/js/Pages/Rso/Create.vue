<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    ddHouses: Object,
    users: Object,
    zms: Object,
    managers: Object,
    supervisors: Object,
})

const form = useForm({
    dd_house_id: null,
    user_id: null,
    zm_number: null,
    manager_number: null,
    supervisor_number: null,
    osrm_code: null,
    employee_code: null,
    code: null,
    number: null,
    pool_number: null,
    bank_account_name: null,
    bank_name: null,
    bank_account_number: null,
    brunch_name: null,
    routing_number: null,
    religion: null,
    education: null,
    blood_group: null,
    gender: null,
    present_address: null,
    permanent_address: null,
    father_name: null,
    mother_name: null,
    market_type: null,
    salary: null,
    category: null,
    agency_name: null,
    dob: null,
    nid: null,
    division: null,
    district: null,
    thana: null,
    sr_no: null,
    designation: null,
    joining_date: null,
    remarks: null,
})

</script>

<template>
    <Head title="Create Rso"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new rso
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('rso.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form @submit.prevent="form.post(route('rso.store'))" class="grid md:grid-cols-2 gap-6">

                            <!-- House -->
                            <SelectInput label="DD House" icon="house" v-model="form.dd_house_id">
                                <option
                                    v-for="ddHouse in ddHouses"
                                    :key="ddHouse.id"
                                    :value="ddHouse.id"
                                >
                                    {{ddHouse.code}} - {{ddHouse.name}}
                                </option>

                                <option v-if="props.ddHouses.length < 1">
                                    No House found
                                </option>
                            </SelectInput>

                            <!-- User -->
                            <SelectInput label="User" icon="user" v-model="form.user_id">
                                <option
                                    v-for="user in users"
                                    :key="user.id"
                                    :value="user.id"
                                >
                                    {{user.name}}
                                </option>

                                <option v-if="props.users.length < 1">
                                    No User found
                                </option>
                            </SelectInput>

                            <!-- ZM Number -->
                            <SelectInput label="ZM Number" icon="user" v-model="form.zm_number">
                                <option
                                    v-for="zm in zms"
                                    :key="zm.id"
                                    :value="zm.phone"
                                >
                                    {{zm.name}}
                                </option>

                                <option v-if="props.zms.length < 1">
                                    No ZM found
                                </option>
                            </SelectInput>

                            <!-- Manager Number -->
                            <SelectInput label="Manager Number" icon="user" v-model="form.manager_number">
                                <option
                                    v-for="manager in managers"
                                    :key="manager.id"
                                    :value="manager.phone"
                                >
                                    {{manager.name}}
                                </option>

                                <option v-if="props.managers.length < 1">
                                    No Manager found
                                </option>
                            </SelectInput>

                            <!-- Supervisor Number -->
                            <SelectInput label="Supervisor Number" icon="user" v-model="form.supervisor_number">
                                <option
                                    v-for="supervisor in supervisors"
                                    :key="supervisor.id"
                                    :value="supervisor.phone"
                                >
                                    {{supervisor.name}}
                                </option>

                                <option v-if="props.supervisors.length < 1">
                                    No Supervisor found
                                </option>
                            </SelectInput>

                            <!-- OSRM Code -->
                            <TextInput
                                label="OSRM Code"
                                icon="code-compare"
                                v-model="form.osrm_code"
                                :message="form.errors.osrm_code"
                            />

                            <!-- Employee Code -->
                            <TextInput
                                label="Employee Code"
                                icon="code-branch"
                                v-model="form.employee_code"
                                :message="form.errors.employee_code"
                            />

                            <!-- RS0 Code -->
                            <TextInput
                                label="RS0 Code"
                                icon="code-merge"
                                v-model="form.code"
                                :message="form.errors.code"
                            />

                            <!-- AC Number -->
                            <TextInput
                                label="AC Number"
                                icon="phone"
                                v-model="form.number"
                                :message="form.errors.number"
                            />

                            <!-- Pool Number -->
                            <TextInput
                                label="Pool Number"
                                icon="phone"
                                v-model="form.pool_number"
                                :message="form.errors.pool_number"
                            />

                            <!-- Bank Account Name -->
                            <TextInput
                                label="Bank Account Name"
                                icon="address-card"
                                v-model="form.bank_account_name"
                                :message="form.errors.bank_account_name"
                            />

                            <!-- Bank Name -->
                            <TextInput
                                label="Bank Name"
                                icon="building-columns"
                                v-model="form.bank_name"
                                :message="form.errors.bank_name"
                            />

                            <!-- Bank Account Number -->
                            <TextInput
                                label="Bank Account Number"
                                icon="hashtag"
                                v-model="form.bank_account_number"
                                :message="form.errors.bank_account_number"
                            />

                            <!-- Brunch Name -->
                            <TextInput
                                label="Brunch Name"
                                icon="code-branch"
                                v-model="form.brunch_name"
                                :message="form.errors.brunch_name"
                            />

                            <!-- Routing Number -->
                            <TextInput
                                label="Routing Number"
                                icon="hashtag"
                                v-model="form.routing_number"
                                :message="form.errors.routing_number"
                            />

                            <!-- Religion -->
                            <TextInput
                                label="Religion"
                                icon="mosque"
                                v-model="form.religion"
                                :message="form.errors.religion"
                            />

                            <!-- Education -->
                            <TextInput
                                label="Education"
                                icon="school"
                                v-model="form.education"
                                :message="form.errors.education"
                            />

                            <!-- Blood Group -->
                            <TextInput
                                label="Blood Group"
                                icon="droplet"
                                v-model="form.blood_group"
                                :message="form.errors.blood_group"
                            />

                            <!-- Gender -->
                            <TextInput
                                label="Gender"
                                icon="venus-mars"
                                v-model="form.gender"
                                :message="form.errors.gender"
                            />

                            <!-- Father Name -->
                            <TextInput
                                label="Father Name"
                                icon="person"
                                v-model="form.father_name"
                                :message="form.errors.father_name"
                            />

                            <!-- Mother Name -->
                            <TextInput
                                label="Mother Name"
                                icon="person-dress"
                                v-model="form.mother_name"
                                :message="form.errors.mother_name"
                            />

                            <!-- Present Address -->
                            <TextInput
                                label="Present Address"
                                icon="location-dot"
                                v-model="form.present_address"
                                :message="form.errors.present_address"
                            />

                            <!-- Permanent Address -->
                            <TextInput
                                label="Permanent Address"
                                icon="location-dot"
                                v-model="form.permanent_address"
                                :message="form.errors.permanent_address"
                            />

                            <!-- Market Type -->
                            <TextInput
                                label="Market Type"
                                icon="store"
                                v-model="form.market_type"
                                :message="form.errors.market_type"
                            />

                            <!-- Salary -->
                            <TextInput
                                label="Salary"
                                icon="hand-holding-dollar"
                                v-model="form.salary"
                                :message="form.errors.salary"
                            />

                            <!-- Category -->
                            <TextInput
                                label="Category"
                                icon="table-cells"
                                v-model="form.category"
                                :message="form.errors.category"
                            />

                            <!-- Agency Name -->
                            <TextInput
                                label="Agency Name"
                                icon="magento"
                                v-model="form.agency_name"
                                :message="form.errors.agency_name"
                            />

                            <!-- Date Of Birth -->
                            <TextInput
                                label="Date Of Birth"
                                icon="calendar-days"
                                type="date"
                                v-model="form.dob"
                                :message="form.errors.dob"
                            />

                            <!-- NID -->
                            <TextInput
                                label="NID"
                                icon="id-badge"
                                v-model="form.nid"
                                :message="form.errors.nid"
                            />

                            <!-- Division -->
                            <TextInput
                                label="Division"
                                icon="clone"
                                v-model="form.division"
                                :message="form.errors.division"
                            />

                            <!-- District -->
                            <TextInput
                                label="District"
                                icon="square"
                                v-model="form.district"
                                :message="form.errors.district"
                            />

                            <!-- Thana -->
                            <TextInput
                                label="Thana"
                                icon="meteor"
                                v-model="form.thana"
                                :message="form.errors.thana"
                            />

                            <!-- SR No -->
                            <TextInput
                                label="SR No"
                                icon="list-ol"
                                v-model="form.sr_no"
                                :message="form.errors.sr_no"
                            />

                            <!-- Designation -->
                            <TextInput
                                label="Designation"
                                icon="map-pin"
                                v-model="form.designation"
                                :message="form.errors.designation"
                            />

                            <!-- Joining Date -->
                            <TextInput
                                label="Joining Date"
                                icon="calendar-days"
                                type="date"
                                v-model="form.joining_date"
                                :message="form.errors.joining_date"
                            />

                            <!-- Remarks -->
                            <TextInput
                                label="Remarks"
                                icon="comments"
                                v-model="form.remarks"
                                :message="form.errors.remarks"
                            />

                            <div>
                                <PrimaryButton :disable="form.processing">Create RS0</PrimaryButton>
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
