<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const menus = [
    {icon: 'mdi-home', label: 'Dashboard', route: 'dashboard', children: []},
    {icon: 'mdi-home', label: 'DD House', route: 'ddHouse', children: [
            {label: 'All House', route: 'ddHouse.index'},
            {label: 'Create House', route: 'ddHouse.create'},
        ]},
    {icon: 'mdi-home', label: 'Rso', route: 'rso', children: [
            {label: 'All Rso', route: 'rso.index'},
            {label: 'Create Rso', route: 'rso.create'},
        ]},
    {icon: 'mdi-home', label: 'Users', route: 'user.index', children: []},
    {icon: 'mdi-home', label: 'Itop Replace', route: 'itopReplace', children: [
            {label: 'All Replace', route: 'itopReplace.index'},
            {label: 'Create Replace', route: 'itopReplace.create'},
        ]},
]
const sidebarToggle = ref(true);
const profileMenu = ref(true);

// State to track the currently open dropdown
const openDropdown = ref(false);

// Toggle dropdown visibility
const toggleDropdown = (index) => {
    openDropdown.value = openDropdown.value === index ? false : index;
};
</script>

<template>
    <!-- Dashboard Wrapper -->
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div
            :class="{'hidden' : sidebarToggle}"
             class="bg-gray-800 text-gray-100 w-full md:w-64 px-4 py-6 md:block">
            <div class="text-2xl font-bold mb-4">
                <Link :href="route('dashboard')">
                    <ApplicationLogo
                        class="h-[6rem] text-gray-800 dark:text-gray-200 w-full"
                    />
                </Link>
            </div>
            <nav class="space-y-2">
                <ul>
                    <li v-for="(menu, index) in menus" :key="index">
                        <Link
                            v-if="menu.children.length < 1"
                            class="block px-4 py-2 rounded hover:bg-gray-500 font-semibold"
                            :class="{'bg-gray-700' : route().current(menu.route)}"
                            :href="route(menu.route)"
                        >
                            {{menu.label}}
                        </Link>

                        <span
                            v-else
                            @click="toggleDropdown(index)"
                            class="block px-4 py-2 rounded hover:bg-gray-500 cursor-pointer font-semibold"
                            :class="{'bg-gray-700' : route().current(menu.route+'.*')}"
                        >
                            {{menu.label}}
                            {{openDropdown + '-' + index}}

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>

                        <div
                            v-if="menu.children.length > 0"
                            :class="{'hidden' : openDropdown !== index}"
                            class="space-y-2 bg-slate-600 rounded"
                        >
                            <ul>
                                <li>
                                    <Link
                                        v-for="(subMenu, index) in menu.children"
                                        :key="index"
                                        :href="route(subMenu.route)"
                                        class="block pl-8 py-2 rounded hover:bg-gray-700"
                                    >
                                        {{subMenu.label}}
                                        {{openDropdown + '-' + index}}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Top Navbar -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <!-- Menu Show/Hide Button -->
                <button @click="sidebarToggle = !sidebarToggle" id="menu-btn" class="text-gray-700 focus:outline-none md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" placeholder="Search..." class="bg-gray-200 rounded-full py-2 px-4 focus:outline-none">
                </div>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="profileMenu = !profileMenu" class="flex items-center space-x-2 text-gray-700">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                        <span>Admin</span>
                    </button>
                    <div :class="{'hidden' : profileMenu}" class="absolute right-0 mt-2 bg-white border rounded shadow-md">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 p-4 space-y-6">
                <slot/>
            </main>

        </div>
    </div>

<!--    <div>-->
<!--        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">-->
<!--            <nav class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">-->
<!--                &lt;!&ndash; Primary Navigation Menu &ndash;&gt;-->
<!--                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">-->
<!--                    <div class="flex h-16 justify-between">-->
<!--                        <div class="flex">-->
<!--                            &lt;!&ndash; Logo &ndash;&gt;-->

<!--                            &lt;!&ndash; Category &ndash;&gt;-->
<!--                            <div class="hidden sm:ms-6 xl:flex sm:items-center">-->
<!--                                <div class="relative ms-3">-->
<!--                                    <Dropdown align="right" width="48">-->
<!--                                        <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                :class="route().current('ddHouse.*') || route().current('user.*') || route().current('rso.*') || route().current('retailer.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'-->
<!--                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"-->
<!--                                            >-->
<!--                                                Category-->
<!--                                                <svg-->
<!--                                                    class="-me-0.5 ms-2 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                        </template>-->

<!--                                        <template #content>-->
<!--                                            &lt;!&ndash; Users &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('user.index')" :active="route().current('user.*')">-->
<!--                                                Users-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; DD House &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('ddHouse.index')" :active="route().current('ddHouse.*')">-->
<!--                                                DD House-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; Rso &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('rso.index')" :active="route().current('rso.*')">-->
<!--                                                Rso-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; Retailer &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('retailer.index')" :active="route().current('retailer.*')">-->
<!--                                                Retailer-->
<!--                                            </DropdownLink>-->
<!--                                        </template>-->
<!--                                    </Dropdown>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            &lt;!&ndash; Services &ndash;&gt;-->
<!--                            <div class="hidden sm:ms-6 xl:flex sm:items-center">-->
<!--                                <div class="relative ms-3">-->
<!--                                    <Dropdown align="right" width="48">-->
<!--                                        <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                :class="route().current('itopReplace.*') || route().current('commission.*') || route().current('lifting.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'-->
<!--                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"-->
<!--                                            >-->
<!--                                                Services-->
<!--                                                <svg-->
<!--                                                    class="-me-0.5 ms-2 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                        </template>-->

<!--                                        <template #content>-->
<!--                                            &lt;!&ndash; Itop Replace &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('itopReplace.index')" :active="route().current('itopReplace.*')">-->
<!--                                                Itop Replace-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; Commission &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('commission.index')" :active="route().current('commission.*')">-->
<!--                                                Commission-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; Lifting &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('lifting.index')" :active="route().current('lifting.*')">-->
<!--                                                Lifting-->
<!--                                            </DropdownLink>-->
<!--                                        </template>-->
<!--                                    </Dropdown>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            &lt;!&ndash; Inventory &ndash;&gt;-->
<!--                            <div class="hidden sm:ms-6 xl:flex sm:items-center">-->
<!--                                <div class="relative ms-3">-->
<!--                                    <Dropdown align="right" width="48">-->
<!--                                        <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                :class="route().current('product.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'-->
<!--                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"-->
<!--                                            >-->
<!--                                                Inventory-->
<!--                                                <svg-->
<!--                                                    class="-me-0.5 ms-2 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                        </template>-->

<!--                                        <template #content>-->
<!--                                            &lt;!&ndash; Product &ndash;&gt;-->
<!--                                            <DropdownLink :href="route('product.index')" :active="route().current('product.*')">-->
<!--                                                Product-->
<!--                                            </DropdownLink>-->
<!--                                        </template>-->
<!--                                    </Dropdown>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            &lt;!&ndash; Sales & Stock &ndash;&gt;-->
<!--                            <div class="hidden sm:ms-6 xl:flex sm:items-center">-->
<!--                                <div class="relative ms-3">-->
<!--                                    <Dropdown align="right" width="48">-->
<!--                                        <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                :class="route().current('product.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'-->
<!--                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"-->
<!--                                            >-->
<!--                                                Sales & Stock-->
<!--                                                <svg-->
<!--                                                    class="-me-0.5 ms-2 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                        </template>-->

<!--                                        <template #content>-->
<!--                                            &lt;!&ndash; House Stock &ndash;&gt;-->
<!--                                            <DropdownLink href="#">-->
<!--                                                House Stock-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; RS0 Stock &ndash;&gt;-->
<!--                                            <DropdownLink href="#">-->
<!--                                                RS0 Stock-->
<!--                                            </DropdownLink>-->

<!--                                            &lt;!&ndash; Today Sale &ndash;&gt;-->
<!--                                            <DropdownLink href="#">-->
<!--                                                Today Sale-->
<!--                                            </DropdownLink>-->
<!--                                        </template>-->
<!--                                    </Dropdown>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="hidden sm:ms-6 xl:flex sm:items-center">-->
<!--                            &lt;!&ndash; Settings Dropdown &ndash;&gt;-->
<!--                            <div class="relative ms-3">-->
<!--                                <Dropdown align="right" width="48">-->
<!--                                    <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"-->
<!--                                            >-->
<!--                                                {{ $page.props.auth.user.name }}-->

<!--                                                <svg-->
<!--                                                    class="-me-0.5 ms-2 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                    </template>-->

<!--                                    <template #content>-->
<!--                                        <DropdownLink-->
<!--                                            :href="route('profile.edit')"-->
<!--                                        >-->
<!--                                            Profile-->
<!--                                        </DropdownLink>-->
<!--                                        <DropdownLink-->
<!--                                            :href="route('logout')"-->
<!--                                            method="post"-->
<!--                                            as="button"-->
<!--                                        >-->
<!--                                            Log Out-->
<!--                                        </DropdownLink>-->
<!--                                    </template>-->
<!--                                </Dropdown>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        &lt;!&ndash; Hamburger &ndash;&gt;-->
<!--                        <div class="-me-2 flex items-center xl:hidden">-->
<!--                            <button-->
<!--                                @click="showingNavigationDropdown = !showingNavigationDropdown"-->
<!--                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">-->
<!--                                <svg-->
<!--                                    class="h-6 w-6"-->
<!--                                    stroke="currentColor"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: showingNavigationDropdown,-->
<!--                                            'inline-flex':-->
<!--                                                !showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M4 6h16M4 12h16M4 18h16"-->
<!--                                    />-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: !showingNavigationDropdown,-->
<!--                                            'inline-flex':-->
<!--                                                showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M6 18L18 6M6 6l12 12"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Responsive Navigation Menu &ndash;&gt;-->
<!--                <div :class="{block: showingNavigationDropdown, hidden: !showingNavigationDropdown,}" class="xl:hidden">-->
<!--                    <div class="space-y-1 pb-3 pt-2">-->
<!--                        <ResponsiveNavLink-->
<!--                            :href="route('dashboard')"-->
<!--                            :active="route().current('dashboard')">-->
<!--                            Dashboard-->
<!--                        </ResponsiveNavLink>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Category &ndash;&gt;-->
<!--                    <div class="space-y-1 pb-3 pt-2">-->
<!--                        Category-->
<!--&lt;!&ndash;                        <ResponsiveNavLink&ndash;&gt;-->
<!--&lt;!&ndash;                            :href="route('dashboard')"&ndash;&gt;-->
<!--&lt;!&ndash;                            :active="route().current('dashboard')">&ndash;&gt;-->
<!--&lt;!&ndash;                            Category&ndash;&gt;-->
<!--&lt;!&ndash;                        </ResponsiveNavLink>&ndash;&gt;-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Category &ndash;&gt;-->
<!--                    <div class="hidden sm:ms-6 sm:flex sm:items-center">-->
<!--                        <div class="relative ms-3">-->
<!--                            <Dropdown align="right" width="48">-->
<!--                                <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                :class="route().current('ddHouse.*') || route().current('user.*') || route().current('rso.*') || route().current('retailer.*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-green-600 text-sm font-medium leading-[3.7rem] text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'-->
<!--                                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-[3.7rem] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'"-->
<!--                                            >-->
<!--                                                Category-->
<!--                                                <svg-->
<!--                                                    class="-me-0.5 ms-2 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                </template>-->

<!--                                <template #content>-->
<!--                                    &lt;!&ndash; Users &ndash;&gt;-->
<!--                                    <DropdownLink :href="route('user.index')" :active="route().current('user.*')">-->
<!--                                        Users-->
<!--                                    </DropdownLink>-->

<!--                                    &lt;!&ndash; DD House &ndash;&gt;-->
<!--                                    <DropdownLink :href="route('ddHouse.index')" :active="route().current('ddHouse.*')">-->
<!--                                        DD House-->
<!--                                    </DropdownLink>-->

<!--                                    &lt;!&ndash; Rso &ndash;&gt;-->
<!--                                    <DropdownLink :href="route('rso.index')" :active="route().current('rso.*')">-->
<!--                                        Rso-->
<!--                                    </DropdownLink>-->

<!--                                    &lt;!&ndash; Retailer &ndash;&gt;-->
<!--                                    <DropdownLink :href="route('retailer.index')" :active="route().current('retailer.*')">-->
<!--                                        Retailer-->
<!--                                    </DropdownLink>-->
<!--                                </template>-->
<!--                            </Dropdown>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Responsive Settings Options &ndash;&gt;-->
<!--                    <div-->
<!--                        class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">-->
<!--                        <div class="px-4">-->
<!--                            <div-->
<!--                                class="text-base font-medium text-gray-800 dark:text-gray-200"-->
<!--                            >-->
<!--                                {{ $page.props.auth.user.name }}-->
<!--                            </div>-->
<!--                            <div class="text-sm font-medium text-gray-500">-->
<!--                                {{ $page.props.auth.user.email }}-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="mt-3 space-y-1">-->
<!--                            <ResponsiveNavLink :href="route('profile.edit')">-->
<!--                                Profile-->
<!--                            </ResponsiveNavLink>-->
<!--                            <ResponsiveNavLink-->
<!--                                :href="route('logout')"-->
<!--                                method="post"-->
<!--                                as="button"-->
<!--                            >-->
<!--                                Log Out-->
<!--                            </ResponsiveNavLink>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </nav>-->

<!--            &lt;!&ndash; Page Heading &ndash;&gt;-->
<!--            <header-->
<!--                class="bg-white shadow dark:bg-gray-800"-->
<!--                v-if="$slots.header"-->
<!--            >-->
<!--                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">-->
<!--                    <slot name="header" />-->
<!--                </div>-->
<!--            </header>-->

<!--            &lt;!&ndash; Page Content &ndash;&gt;-->
<!--            <main>-->
<!--                <slot />-->
<!--            </main>-->
<!--        </div>-->
<!--    </div>-->
</template>
