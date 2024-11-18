<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    code: null,
    name: null,
    cluster: null,
    region: null,
    district: null,
    thana: null,
    email: null,
    address: null,
    proprietor_name: null,
    contact_number: null,
    poc_name: null,
    poc_number: null,
    lifting_date: null,
    remarks: null,
})
</script>

<template>
    <Head title="Create House"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new house
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('ddHouse.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form class="grid lg:grid-cols-2 gap-6" @submit.prevent="form.post(route('ddHouse.store'))">

                            <!-- DD Code -->
                            <div class="mb-3">
                                <InputLabel for="code" value="DD Code" />

                                <TextInput
                                    id="code"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.code"
                                    autofocus
                                    autocomplete="code"
                                />

                                <InputError class="mt-2" :message="form.errors.code" />
                            </div>

                            <!-- DD Name -->
                            <div class="mb-3">
                                <InputLabel for="name" value="DD Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <!-- Cluster -->
                            <div class="mb-3">
                                <InputLabel for="cluster" value="Cluster" />

                                <TextInput
                                    id="cluster"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.cluster"
                                    autocomplete="cluster"
                                />

                                <InputError class="mt-2" :message="form.errors.cluster" />
                            </div>

                            <!-- Region -->
                            <div class="mb-3">
                                <InputLabel for="region" value="Region" />

                                <TextInput
                                    id="region"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.region"
                                    autocomplete="region"
                                />

                                <InputError class="mt-2" :message="form.errors.region" />
                            </div>

                            <!-- District -->
                            <div class="mb-3">
                                <InputLabel for="district" value="District" />

                                <TextInput
                                    id="district"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.district"
                                    autocomplete="district"
                                />

                                <InputError class="mt-2" :message="form.errors.district" />
                            </div>

                            <!-- Thana -->
                            <div class="mb-3">
                                <InputLabel for="thana" value="Thana" />

                                <TextInput
                                    id="thana"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.thana"
                                    autocomplete="thana"
                                />

                                <InputError class="mt-2" :message="form.errors.thana" />
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    autocomplete="email"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <InputLabel for="address" value="Address" />

                                <TextInput
                                    id="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.address"
                                    autocomplete="address"
                                />

                                <InputError class="mt-2" :message="form.errors.address" />
                            </div>

                            <!-- Proprietor Name -->
                            <div class="mb-3">
                                <InputLabel for="proprietor_name" value="Proprietor Name" />

                                <TextInput
                                    id="proprietor_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.proprietor_name"
                                    autocomplete="proprietor_name"
                                />

                                <InputError class="mt-2" :message="form.errors.proprietor_name" />
                            </div>

                            <!-- Contact Number -->
                            <div class="mb-3">
                                <InputLabel for="contact_number" value="Contact Number" />

                                <TextInput
                                    id="contact_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.contact_number"
                                    autocomplete="contact_number"
                                />

                                <InputError class="mt-2" :message="form.errors.contact_number" />
                            </div>

                            <!-- POC Name -->
                            <div class="mb-3">
                                <InputLabel for="poc_name" value="POC Name" />

                                <TextInput
                                    id="poc_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.poc_name"
                                    autocomplete="poc_name"
                                />

                                <InputError class="mt-2" :message="form.errors.poc_name" />
                            </div>

                            <!-- POC Number -->
                            <div class="mb-3">
                                <InputLabel for="poc_number" value="POC Number" />

                                <TextInput
                                    id="poc_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.poc_number"
                                    autocomplete="poc_number"
                                />

                                <InputError class="mt-2" :message="form.errors.poc_number" />
                            </div>

                            <!-- Lifting Date -->
                            <div class="mb-3">
                                <InputLabel for="lifting_date" value="Lifting Date" />

                                <TextInput
                                    id="lifting_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.lifting_date"
                                    autocomplete="lifting_date"
                                />

                                <InputError class="mt-2" :message="form.errors.lifting_date" />
                            </div>

                            <!-- Remarks -->
                            <div class="mb-3">
                                <InputLabel for="remarks" value="Remarks" />

                                <TextInput
                                    id="remarks"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.remarks"
                                    autocomplete="remarks"
                                />

                                <InputError class="mt-2" :message="form.errors.remarks" />
                            </div>

                            <div>
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
