<script setup>
import {router, useForm} from '@inertiajs/vue3';
import SelectInput from "@/Components/SelectInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextArea from "@/Components/TextArea.vue";
import {watch} from "vue";

const props = defineProps({
    houses: Object,
    products: Object,
    liftings: Object,
})

const form = useForm({
    dd_house_id: null,
    products: [
        {
            id: null,
            category: null,
            name: null,
            code: null,
            face_value: null,
            lifting_price: null,
            quantity: null,
        },
    ],
    deposit: null,
    attempt: null,
});

// Add a new product row
const addProduct = () => {
    form.products.push({
        id: null,
        category: null,
        name: null,
        code: null,
        face_value: null,
        lifting_price: null,
        quantity: null,
    });
};

const removeProduct = (index) => {
    if (form.products.length > 1) {
        form.products.splice(index, 1);
    }
};

// Populate product details when a product is selected
const populateProductDetails = (product) => {
    if (product.id) {
        const selectedProduct = props.products.find((p) => p.id === product.id);
        console.log(selectedProduct)
        if (selectedProduct) {
            product.category = selectedProduct.category;
            product.name = selectedProduct.name;
            product.code = selectedProduct.code;
            product.face_value = selectedProduct.face_value;
            product.lifting_price = selectedProduct.lifting_price;
        }
    }
};

// Watch for changes in the selected product_id and populate the details
watch(() => form.products.map((p) => p.id), () => {
        form.products.forEach(populateProductDetails);
    }
);

const submit = () => {
    form.post(route('lifting.store'), {
        onSuccess: () => form.reset()
    })
};
</script>

<template>
    <Head title="Add New"/>
    <SessionMessage :status="props.status"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Create new lifting
                </h2>

                <div>
                    <Link :href="route('lifting.index')" class="hover:text-green-400">Back to list</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <form @submit.prevent="submit">
                            <div class="grid md:grid-cols-2 gap-6 mb-5">

                                <div class="space-y-4">
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

                                    <!-- Bank Deposit -->
                                    <TextInput icon="bangladeshi-taka-sign" v-model="form.deposit" label="Bank Deposit" placeholder="Deposit amount" type="number" required/>

                                    <!-- Lifting Attempt -->
                                    <SelectInput label="Lifting Attempt" v-model="form.attempt">
                                        <option value="" disabled>Select a attempt</option>
                                        <option value="1st">1st Lifting</option>
                                        <option value="2nd">2nd Lifting</option>
                                        <option value="3rd">3rd Lifting</option>
                                        <option value="4th">4th Lifting</option>
                                        <option value="5th">5th Lifting</option>
                                    </SelectInput>
                                </div>

                                <div>
                                    <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Products:</h3>
                                    <div v-for="(product, index) in form.products" :key="index" class="">
                                        <div class="grid md:grid-cols-2 items-center gap-2">
                                            <SelectInput v-model="product.id">
                                                <option value="" disabled>Select a product</option>
                                                <option v-for="p in products" :key="p.id" :value="p.id">
                                                    {{ p.name }} ({{ p.code }})
                                                </option>
                                            </SelectInput>
                                            <TextInput v-model="product.quantity" placeholder="Quantity" type="number"/>
                                        </div>

                                        <div class="flex items-center justify-between text-xs text-slate-600" v-if="product.id">
                                            <p><strong>Category:</strong> {{ product.category }}</p>
                                            <p><strong>Face Value:</strong> ${{ product.face_value }}</p>
                                            <p><strong>Lifting Price:</strong> ${{ product.lifting_price }}</p>
                                        </div>

                                        <div class="mb-2">
                                            <button
                                                v-if="form.products.length > 1"
                                                class="text-red-600 font-semibold"
                                                type="button" @click="removeProduct(index)">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                    <button class="bg-green-500 px-4 py-1 rounded-full text-white mt-2" type="button" @click="addProduct">Add Product</button>
                                </div>
                            </div>

                            <PrimaryButton class="" :disable="form.processing">Create new lifting</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
