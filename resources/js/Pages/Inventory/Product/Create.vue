<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
    name: null,
    code: null,
    category: null,
    sub_category: null,
    face_value: null,
    lifting_price: null,
    offer: null,
})

</script>

<template>
    <Head title="Add new product"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new product
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('product.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form @submit.prevent="form.post(route('product.store'))">

                            <div class="grid md:grid-cols-2 gap-6 mt-10 mb-5">
                                <!-- Product Name -->
                                <TextInput
                                    label="Product Name"
                                    icon="share"
                                    v-model="form.name"
                                    :message="form.errors.name"
                                />

                                <!-- Product Code -->
                                <TextInput
                                    label="Product Code"
                                    icon="share"
                                    v-model="form.code"
                                    :message="form.errors.code"
                                />

                                <!-- Category -->
                                <TextInput
                                    label="Category"
                                    icon="share"
                                    v-model="form.category"
                                    :message="form.errors.category"
                                />

                                <!-- Sub Category -->
                                <TextInput
                                    label="Sub Category"
                                    icon="share"
                                    v-model="form.sub_category"
                                    :message="form.errors.sub_category"
                                />

                                <!-- Face Value -->
                                <TextInput
                                    label="Face Value"
                                    icon="share"
                                    v-model="form.face_value"
                                    :message="form.errors.face_value"
                                />

                                <!-- Lifting Price -->
                                <TextInput
                                    label="Lifting Price"
                                    icon="share"
                                    v-model="form.lifting_price"
                                    :message="form.errors.lifting_price"
                                />

                                <!-- Offer -->
                                <TextInput
                                    label="Offer"
                                    icon="share"
                                    v-model="form.offer"
                                    :message="form.errors.offer"
                                />
                            </div>

                            <PrimaryButton :disable="form.processing">Create new product</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

</style>
