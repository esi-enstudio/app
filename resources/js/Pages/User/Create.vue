<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
    avatar: null,
    name: null,
    phone: null,
    email: null,
    remarks: null,
    role: null,
    password: null,
    password_confirmation: null,
})

</script>

<template>
    <Head title="Create User"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new user
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('user.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form @submit.prevent="form.post(route('user.store'))" class="space-y-6">
                            <!-- Image Upload -->
                            <ImageUpload @image="(e) => form.avatar = e"/>

                            <!-- Full Name -->
                            <TextInput
                                label="Full Name"
                                icon="user-plus"
                                v-model="form.name"
                                :message="form.errors.name"
                            />

                            <!-- Phone Number -->
                            <TextInput
                                label="Phone Number"
                                icon="phone"
                                v-model="form.phone"
                                :message="form.errors.phone"
                            />

                            <!-- Email -->
                            <TextInput
                                label="Email"
                                icon="at"
                                v-model="form.email"
                                :message="form.errors.email"
                            />

                            <!-- Role -->
                            <SelectInput
                                label="Role"
                                icon="person-circle-question"
                                v-model="form.role"
                                :message="form.errors.role"
                            >
                                <option value="user">User</option>
                                <option value="md">Md</option>
                                <option value="zm">Zm</option>
                                <option value="manager">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="rso">Rso</option>
                                <option value="operator">Dms Operator</option>
                                <option value="account">Account</option>
                            </SelectInput>

                            <!-- Password -->
                            <TextInput
                                label="Password"
                                icon="lock"
                                type="password"
                                v-model="form.password"
                                :message="form.errors.password"
                            />

                            <!-- Confirm Password -->
                            <TextInput
                                label="Confirm Password"
                                icon="lock"
                                type="password"
                                v-model="form.password_confirmation"
                            />

                            <!-- Remarks -->
                            <TextInput
                                label="Remarks"
                                icon="comments"
                                v-model="form.remarks"
                                :message="form.errors.remarks"
                            />

                            <div>
                                <PrimaryButton :disable="form.processing">Create</PrimaryButton>
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
