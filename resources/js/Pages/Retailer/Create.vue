<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";

const props = defineProps({
    ddHouses: Object,
    users: Object,
    zms: Object,
    managers: Object,
    supervisors: Object,
    rsos: Object,
})

const form = useForm({
    dd_house_id: null,
    user_id: null,
    rso_id: null,
    zm: null,
    manager: null,
    supervisor: null,
    code: null,
    name: null,
    number: null,
    type: null,
    sso: null,
    service_point: null,
    category: null,
    father_name: null,
    mother_name: null,
    division: null,
    district: null,
    thana: null,
    address: null,
    dob: null,
    nid: null,
    lat: null,
    long: null,
    description: null,
    remarks: null,
})

</script>

<template>
    <Head title="Create Retailer"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new retailer
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('retailer.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form @submit.prevent="form.post(route('retailer.store'))">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- House -->
                                <SelectInput
                                    label="DD House"
                                    icon="house"
                                    v-model="form.dd_house_id"
                                    :message="form.errors.dd_house_id"
                                >
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
                                <SelectInput
                                    label="User"
                                    icon="user"
                                    v-model="form.user_id"
                                    :message="form.errors.user_id"
                                >
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

                                <!-- Rso -->
                                <SelectInput
                                    label="Rso"
                                    icon="user"
                                    v-model="form.rso_id"
                                    :message="form.errors.rso_id"
                                >
                                    <option
                                        v-for="rso in rsos"
                                        :key="rso.id"
                                        :value="rso.id"
                                    >
                                        {{rso.number}} - {{rso.user.name}}
                                    </option>

                                    <option v-if="props.rsos.length < 1">
                                        No Rso found
                                    </option>
                                </SelectInput>

                                <!-- ZM -->
                                <SelectInput
                                    label="ZM"
                                    icon="user"
                                    v-model="form.zm"
                                    :message="form.errors.zm"
                                >
                                    <option
                                        v-for="zm in zms"
                                        :key="zm.id"
                                        :value="zm.id"
                                    >
                                        {{zm.name}}
                                    </option>

                                    <option v-if="props.zms.length < 1">
                                        No ZM found
                                    </option>
                                </SelectInput>

                                <!-- Manager -->
                                <SelectInput
                                    label="Manager"
                                    icon="user"
                                    v-model="form.manager"
                                    :message="form.errors.manager"
                                >
                                    <option
                                        v-for="manager in managers"
                                        :key="manager.id"
                                        :value="manager.id"
                                    >
                                        {{manager.name}}
                                    </option>

                                    <option v-if="props.managers.length < 1">
                                        No Manager found
                                    </option>
                                </SelectInput>

                                <!-- Supervisor -->
                                <SelectInput
                                    label="Supervisor"
                                    icon="user"
                                    v-model="form.supervisor"
                                    :message="form.errors.supervisor"
                                >
                                    <option
                                        v-for="supervisor in supervisors"
                                        :key="supervisor.id"
                                        :value="supervisor.id"
                                    >
                                        {{supervisor.name}}
                                    </option>

                                    <option v-if="props.supervisors.length < 1">
                                        No Supervisor found
                                    </option>
                                </SelectInput>

                                <!-- Retailer Code -->
                                <TextInput
                                    label="Retailer Code"
                                    icon="code-merge"
                                    v-model="form.code"
                                    :message="form.errors.code"
                                />

                                <!-- Retailer Name -->
                                <TextInput
                                    label="Retailer Name"
                                    icon="shop"
                                    v-model="form.name"
                                    :message="form.errors.name"
                                />

                                <!-- Itop Number -->
                                <TextInput
                                    label="Itop Number"
                                    icon="phone"
                                    v-model="form.number"
                                    :message="form.errors.number"
                                />

                                <!-- Type -->
                                <TextInput
                                    label="Type"
                                    icon="typo3"
                                    v-model="form.type"
                                    :message="form.errors.type"
                                />

                                <!-- SSO -->
                                <SelectInput
                                    label="SSO"
                                    icon="check"
                                    v-model="form.sso"
                                    :message="form.errors.sso"
                                >
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </SelectInput>

                                <!-- Service Point -->
                                <SelectInput
                                    label="Service Point"
                                    icon="shop"
                                    v-model="form.service_point"
                                    :message="form.errors.service_point"
                                >
                                    <option value="bssp">BSSP</option>
                                    <option value="rbsp">RBSP</option>
                                </SelectInput>

                                <!-- Category -->
                                <SelectInput
                                    label="Category"
                                    icon="list"
                                    v-model="form.category"
                                    :message="form.errors.category"
                                >
                                    <option value="cat1">Cat 1</option>
                                    <option value="cat2">Cat 2</option>
                                </SelectInput>

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

                                <!-- Address -->
                                <TextInput
                                    label="Address"
                                    icon="location-dot"
                                    v-model="form.address"
                                    :message="form.errors.address"
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

                                <!-- Latitude -->
                                <TextInput
                                    label="Latitude"
                                    icon="earth-asia"
                                    v-model="form.lat"
                                    :message="form.errors.lat"
                                />

                                <!-- Longitude -->
                                <TextInput
                                    label="Longitude"
                                    icon="earth-europe"
                                    v-model="form.long"
                                    :message="form.errors.long"
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

                            <PrimaryButton :disable="form.processing">Create Retailer</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
