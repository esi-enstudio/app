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
                <h1>The current theme is: {{ currentTheme }}</h1>
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
