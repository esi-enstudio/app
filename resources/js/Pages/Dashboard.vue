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
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-card
                        class="mx-auto my-8"
                        elevation="16"
                        max-width="344"
                    >
                        <v-card-item>
                            <v-card-title>
                                Card title
                            </v-card-title>

                            <v-card-subtitle>
                                Card subtitle secondary text
                            </v-card-subtitle>
                        </v-card-item>

                        <v-card-text>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12">
                    <v-card
                        append-icon="mdi-open-in-new"
                        class="mx-auto"
                        href="https://github.com/vuetifyjs/vuetify/"
                        max-width="344"
                        prepend-icon="mdi-github"
                        rel="noopener"
                        subtitle="Check out the official repository"
                        target="_blank"
                        title="Vuetify on GitHub"
                    ></v-card>
                </v-col>
                <v-col cols="12" md="6">
                    <v-card
                        append-avatar="https://cdn.vuetifyjs.com/images/john.jpg"
                        class="mx-auto"
                        prepend-avatar="https://cdn.vuetifyjs.com/images/logos/v-alt.svg"
                        subtitle="prepend-avatar and append-avatar"
                        title="Avatars"
                    >
                        <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
