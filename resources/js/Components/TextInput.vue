<script setup>
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    label: String,
    important: Boolean,
    disabled: Boolean,
    icon: String,
    placeholder: {
        type: String,
        default: "",
    },
    type: {
        type: String,
        default: 'text',
    },
    message: String,
});
</script>

<template>
    <div>
        <label
            v-if="label"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{label}} <span v-if="important" class="text-red-500">*</span>
        </label>

        <div class="relative rounded-md">
            <div v-if="icon" class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="grid place-content-center text-sm text-slate-400">
                    <i :class="`fa-solid fa-${icon}`"></i>
                </span>
            </div>

            <input
                :name="label"
                :type="type"
                :placeholder="placeholder"
                v-model="model"
                :disabled="disabled"
                :class="{'pl-9' : icon}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-400 dark:focus:border-green-400 dark:focus:bg-slate-700"
            />
        </div>
        <small v-if="message" class="text-red-500 font-semibold">{{ message }}</small>
    </div>
</template>
