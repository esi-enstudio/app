<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import {watch} from "vue";

const props = defineProps({
    lifting: Object,
    houses: Object,
    products: Object,
})

const form = useForm({
    dd_house_id: props.lifting.dd_house_id,
    products: props.lifting.products.map(product => ({
        id: product.id,
        name: product.name || null,
        code: product.code || null,
        category: product.category || null,
        sub_category: product.sub_category || null,
        face_value: product.face_value || null,
        lifting_price: product.lifting_price || null,
        offer: product.offer || null,
        quantity: product.quantity || null,
    })),
    deposit: props.lifting.deposit,
    itopup: props.lifting.itopup,
    attempt: props.lifting.attempt,
});

// Add a new product row
const addProduct = () => {
    form.products.push({
        id: null,
        name: null,
        code: null,
        category: null,
        sub_category: null,
        face_value: null,
        lifting_price: null,
        offer: null,
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

        if (selectedProduct) {
            product.name = selectedProduct.name;
            product.code = selectedProduct.code;
            product.category = selectedProduct.category;
            product.sub_category = selectedProduct.sub_category;
            product.face_value = selectedProduct.face_value;
            product.lifting_price = selectedProduct.lifting_price;
            product.offer = selectedProduct.offer;
        }
    }
};

// Watch for changes in the selected product_id and populate the details
watch(() => form.products.map((p) => p.id), () => {
        form.products.forEach(populateProductDetails);
    }
);

</script>

<template>
    <Head title="Update replace"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Update lifting
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

                        <form @submit.prevent="form.put(route('lifting.update', props.lifting.id))">
                            <div class="grid md:grid-cols-2 gap-6 mb-5">

                                <div class="space-y-4">
                                    <!-- House -->
                                    <SelectInput
                                        label="House"
                                        icon="house"
                                        v-model="form.dd_house_id"
                                        :message="form.errors.dd_house_id"
                                    >
                                        <option value="" disabled>Select a house</option>
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
                                    <TextInput
                                        label="Bank Deposit"
                                        icon="bangladeshi-taka-sign"
                                        v-model="form.deposit"
                                        :message="form.errors.deposit"
                                        placeholder="Deposit amount"
                                        type="number"
                                    />
                                    <span class="text-sm text-green-500">Itop-Up: {{new Intl.NumberFormat('en-IN').format(form.itopup)}}</span>

                                    <!-- Lifting Attempt -->
                                    <SelectInput
                                        label="Lifting Attempt"
                                        v-model="form.attempt"
                                        :message="form.errors.attempt"
                                    >
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

                                        <div class="flex items-center justify-between text-xs text-slate-500" v-if="product.id">
                                            <p>
                                                <strong>Category:</strong> {{ product.category }}
                                                <span v-if="product.sub_category">/ {{product.sub_category}}</span>
                                            </p>
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
                                    <button class="bg-indigo-600 hover:bg-indigo-500 px-4 py-1 rounded-full text-white mt-2" type="button" @click="addProduct">Add Product</button>
                                </div>
                            </div>

                            <PrimaryButton class="" :disable="form.processing">Save Changes</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
