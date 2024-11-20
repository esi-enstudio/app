<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({ user: Object })

const form = useForm({
    avatar: null,
    name: props.user.name,
    phone: props.user.phone,
    email: props.user.email,
    password: null,
    password_confirmation: null,
    remarks: props.user.remarks,
    role: props.user.role,
    status: props.user.status,
    _method: "put",
})

</script>

<template>
    <Head title="Create User"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Update user
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

                        <form @submit.prevent="form.post(route('user.update', props.user.id))">
                            <!-- Image Upload -->
                            <ImageUpload @image="(e) => form.avatar = e" :userAvatar="props.user.avatar"/>

                            <div class="grid md:grid-cols-2 gap-6 mt-10 mb-5">
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
                                    <option value="admin">Admin</option>
                                    <option value="md">Md</option>
                                    <option value="zm">Zm</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="rso">Rso</option>
                                    <option value="operator">Dms Operator</option>
                                    <option value="account">Account</option>
                                </SelectInput>

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
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </SelectInput>
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
