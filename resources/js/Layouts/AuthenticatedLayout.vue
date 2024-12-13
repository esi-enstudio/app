<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);

const cards = ['Today', 'Yesterday']
const menuItems = [
    {icon: 'bangladeshi-taka-sign', label: 'Dashboard', route: 'dashboard', type: 'fas'},
    {icon: 'video', label: 'DD House', route: 'ddHouse.index', type: 'fas'},
    {icon: 'mdi-abugida-thai', label: 'All Rso', route: 'rso.index', type: 'mdi'},
    {icon: 'mdi-delete', label: 'Users', route: 'user.index', type: 'mdi'},
    {icon: 'mdi-alert-octagon', label: 'Itop Replace', route: 'itopReplace.index', type: 'mdi'},
]

const drawer = ref(null)
</script>

<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer">
            <v-sheet
                class="pa-4"
                color="grey-lighten-4"
            >
                <v-avatar
                    class="mb-4"
                    color="grey-darken-1"
                    size="64"
                ></v-avatar>

                <div>john@google.com</div>
            </v-sheet>
            <v-divider></v-divider>
            <v-list>
              <v-list-item v-for="(menu, index) in menuItems" :key="index">
                  <v-icon v-if="menu.type === 'fas'" :icon="`fas fa-${menu.icon}`" />
                  <v-icon v-if="menu.type === 'mdi'" :icon="`mdi:${menu.icon}`" />

                  <Link :href="route(menu.route)">{{menu.label}}</Link>
              </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <v-container class="py-8 px-6" fluid>
                <v-app-bar scroll-behavior="elevate">
                    <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

                    <v-app-bar-title>Application</v-app-bar-title>
                </v-app-bar>
                <slot />
            </v-container>
        </v-main>
    </v-app>

    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 xl:flex">
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                            </div>

                            <!-- Category -->
                            <div class="hidden sm:ms-6 xl:flex sm:items-center">
                                <div class="relative ms-3">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                :class="route().current('ddHouse.*') || route().current('user.*') || route().current('rso.*') || route().current('retailer.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"
                                            >
                                                Category
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <!-- Users -->
                                            <DropdownLink :href="route('user.index')" :active="route().current('user.*')">
                                                Users
                                            </DropdownLink>

                                            <!-- DD House -->
                                            <DropdownLink :href="route('ddHouse.index')" :active="route().current('ddHouse.*')">
                                                DD House
                                            </DropdownLink>

                                            <!-- Rso -->
                                            <DropdownLink :href="route('rso.index')" :active="route().current('rso.*')">
                                                Rso
                                            </DropdownLink>

                                            <!-- Retailer -->
                                            <DropdownLink :href="route('retailer.index')" :active="route().current('retailer.*')">
                                                Retailer
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="hidden sm:ms-6 xl:flex sm:items-center">
                                <div class="relative ms-3">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                :class="route().current('itopReplace.*') || route().current('commission.*') || route().current('lifting.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"
                                            >
                                                Services
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <!-- Itop Replace -->
                                            <DropdownLink :href="route('itopReplace.index')" :active="route().current('itopReplace.*')">
                                                Itop Replace
                                            </DropdownLink>

                                            <!-- Commission -->
                                            <DropdownLink :href="route('commission.index')" :active="route().current('commission.*')">
                                                Commission
                                            </DropdownLink>

                                            <!-- Lifting -->
                                            <DropdownLink :href="route('lifting.index')" :active="route().current('lifting.*')">
                                                Lifting
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Inventory -->
                            <div class="hidden sm:ms-6 xl:flex sm:items-center">
                                <div class="relative ms-3">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                :class="route().current('product.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"
                                            >
                                                Inventory
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <!-- Product -->
                                            <DropdownLink :href="route('product.index')" :active="route().current('product.*')">
                                                Product
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Sales & Stock -->
                            <div class="hidden sm:ms-6 xl:flex sm:items-center">
                                <div class="relative ms-3">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                :class="route().current('product.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"
                                            >
                                                Sales & Stock
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <!-- House Stock -->
                                            <DropdownLink href="#">
                                                House Stock
                                            </DropdownLink>

                                            <!-- RS0 Stock -->
                                            <DropdownLink href="#">
                                                RS0 Stock
                                            </DropdownLink>

                                            <!-- Today Sale -->
                                            <DropdownLink href="#">
                                                Today Sale
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 xl:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center xl:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{block: showingNavigationDropdown, hidden: !showingNavigationDropdown,}" class="xl:hidden">
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Category -->
                    <div class="space-y-1 pb-3 pt-2">
                        Category
<!--                        <ResponsiveNavLink-->
<!--                            :href="route('dashboard')"-->
<!--                            :active="route().current('dashboard')">-->
<!--                            Category-->
<!--                        </ResponsiveNavLink>-->
                    </div>

                    <!-- Category -->
                    <div class="hidden sm:ms-6 sm:flex sm:items-center">
                        <div class="relative ms-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                :class="route().current('ddHouse.*') || route().current('user.*') || route().current('rso.*') || route().current('retailer.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"
                                            >
                                                Category
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                </template>

                                <template #content>
                                    <!-- Users -->
                                    <DropdownLink :href="route('user.index')" :active="route().current('user.*')">
                                        Users
                                    </DropdownLink>

                                    <!-- DD House -->
                                    <DropdownLink :href="route('ddHouse.index')" :active="route().current('ddHouse.*')">
                                        DD House
                                    </DropdownLink>

                                    <!-- Rso -->
                                    <DropdownLink :href="route('rso.index')" :active="route().current('rso.*')">
                                        Rso
                                    </DropdownLink>

                                    <!-- Retailer -->
                                    <DropdownLink :href="route('retailer.index')" :active="route().current('retailer.*')">
                                        Retailer
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
                        <div class="px-4">
                            <div
                                class="text-base font-medium text-gray-800 dark:text-gray-200"
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-white shadow dark:bg-gray-800"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
