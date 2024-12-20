<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { useTheme } from 'vuetify';

const currentTheme = ref('light'); // Default theme
const theme = useTheme(); // Access Vuetify's theme system

onMounted(() => {
    if (typeof window !== 'undefined') {
        const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        currentTheme.value = isDarkMode ? 'dark' : 'light';

        // Set the theme directly
        theme.global.name.value = currentTheme.value;
    }
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <v-app>
            <v-container>
                <!-- KPI Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-bold">Total Sales</h3>
                        <p class="text-gray-600 mt-2">$12,345</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-bold">New Users</h3>
                        <p class="text-gray-600 mt-2">345</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-bold">Active Sessions</h3>
                        <p class="text-gray-600 mt-2">1,234</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-bold">Reports</h3>
                        <p class="text-gray-600 mt-2">87</p>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Monthly Sales Chart</h3>
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <p>Chart Placeholder</p>
                    </div>
                </div>
            </v-container>
        </v-app>
<!--        <template #header>-->
<!--            <h2-->
<!--                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"-->
<!--            >-->
<!--                Dashboard-->
<!--            </h2>-->
<!--        </template>-->

<!--        <div class="py-12">-->
<!--            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">-->
<!--                <div-->
<!--                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"-->
<!--                >-->
<!--                    <div class="p-6 text-gray-900 dark:text-gray-100">-->
<!--                        <p>Welcome back...</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </AuthenticatedLayout>
</template>
