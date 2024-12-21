<script setup>
import { ref } from 'vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const menus = [
  {icon: 'mdi-home', label: 'Dashboard', route: 'dashboard', children: []},
  // Category
  {icon: 'mdi-home', label: 'Category', route: 'dashboard', children: [
      // Users
      {icon: 'mdi-home', label: 'Users', route: 'user.index'},
      // DD House
      {icon: 'mdi-home', label: 'House', route: 'ddHouse.index'},
      // Rso
      {icon: 'mdi-home', label: 'Rso', route: 'rso.index'},
      // Retailer
      {icon: 'mdi-home', label: 'Retailer', route: 'retailer.index'},
    ]
  },

  // Services
  {icon: 'mdi-home', label: 'Services', route: 'dashboard', children: [
      // Itop Replace
      {icon: 'mdi-home', label: 'Itop Replace', route: 'itopReplace.index'},
      // Commission
      {icon: 'mdi-home', label: 'Commission', route: 'commission.index'},
      // Lifting
      {icon: 'mdi-home', label: 'Lifting', route: 'lifting.index'},
    ]
  },

  // Inventory
  {icon: 'mdi-home', label: 'Inventory', route: 'dashboard', children: [
      // Product
      {icon: 'mdi-home', label: 'Product', route: 'product.index'},
    ]
  },

  // Sales & Stock
  // {icon: 'mdi-home', label: 'Sales & Stock', route: 'dashboard', children: [
  //     // House Stock
  //     {icon: 'mdi-home', label: 'House Stock', route: ''},
  //     // RS0 Stock
  //     {icon: 'mdi-home', label: 'RS0 Stock', route: ''},
  //     // Today Sale
  //     {icon: 'mdi-home', label: 'Today Sale', route: ''},
  //   ]
  // },
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
  <VApp>
    <VNavigationDrawer expand-on-hover >
      <v-list>
        <v-list-item
            prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
            subtitle="sandra_a88@gmailcom"
            title="Sandra Adams"
        ></v-list-item>
      </v-list>
      <v-divider></v-divider>

      <v-list density="compact" nav>
        <div>
          <v-list-group v-for="(menu, index) in menus" :key="index">
            <template #activator="{ props }">
              <v-list-item
                  v-bind="props"
                  :prepend-icon="menu.icon"
                  :title="menu.label"
              ></v-list-item>
            </template>
            <v-list-item
                title="Create House"
                value="Create House"
            ></v-list-item>
            <v-list-item
                title="Edit House"
                value="Edit House"
            ></v-list-item>
          </v-list-group>
        </div>

<!--        <v-list-group value="Users">-->
<!--          <template #activator="{ props }">-->
<!--            <v-list-item-->
<!--                v-bind="props"-->
<!--                prepend-icon="mdi-account-circle"-->
<!--                title="Users"-->
<!--            ></v-list-item>-->
<!--          </template>-->

<!--          <v-list-group value="Admin">-->
<!--            <template #activator="{ props }">-->
<!--              <v-list-item-->
<!--                  v-bind="props"-->
<!--                  title="Admin"-->
<!--              ></v-list-item>-->
<!--            </template>-->
<!--          </v-list-group>-->


<!--        </v-list-group>-->


      </v-list>

      <!-- Sidebar -->
      <div
          :class="{'hidden' : sidebarToggle}"
          class="bg-gray-800 text-gray-100 w-full md:w-64 px-4 py-6 md:block">
        <div class="text-2xl font-bold mb-4">
          <Link :href="route('dashboard')">
            <ApplicationLogo class="w-full h-20"/>
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
                    </Link>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </VNavigationDrawer>
    <VMain>
      <!-- Dashboard Wrapper -->
      <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
<!--        <div-->
<!--            :class="{'hidden' : sidebarToggle}"-->
<!--            class="bg-gray-800 text-gray-100 w-full md:w-64 px-4 py-6 md:block">-->
<!--          <div class="text-2xl font-bold mb-4">-->
<!--            <Link :href="route('dashboard')">-->
<!--              <ApplicationLogo class="w-full h-20"/>-->
<!--            </Link>-->
<!--          </div>-->
<!--          <nav class="space-y-2">-->
<!--            <ul>-->
<!--              <li v-for="(menu, index) in menus" :key="index">-->
<!--                <Link-->
<!--                    v-if="menu.children.length < 1"-->
<!--                    class="block px-4 py-2 rounded hover:bg-gray-500 font-semibold"-->
<!--                    :class="{'bg-gray-700' : route().current(menu.route)}"-->
<!--                    :href="route(menu.route)"-->
<!--                >-->
<!--                  {{menu.label}}-->
<!--                </Link>-->

<!--                <span-->
<!--                    v-else-->
<!--                    @click="toggleDropdown(index)"-->
<!--                    class="block px-4 py-2 rounded hover:bg-gray-500 cursor-pointer font-semibold"-->
<!--                    :class="{'bg-gray-700' : route().current(menu.route+'.*')}"-->
<!--                >-->
<!--                            {{menu.label}}-->

<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />-->
<!--                            </svg>-->
<!--                        </span>-->

<!--                <div-->
<!--                    v-if="menu.children.length > 0"-->
<!--                    :class="{'hidden' : openDropdown !== index}"-->
<!--                    class="space-y-2 bg-slate-600 rounded"-->
<!--                >-->
<!--                  <ul>-->
<!--                    <li>-->
<!--                      <Link-->
<!--                          v-for="(subMenu, index) in menu.children"-->
<!--                          :key="index"-->
<!--                          :href="route(subMenu.route)"-->
<!--                          class="block pl-8 py-2 rounded hover:bg-gray-700"-->
<!--                      >-->
<!--                        {{subMenu.label}}-->
<!--                      </Link>-->
<!--                    </li>-->
<!--                  </ul>-->
<!--                </div>-->
<!--              </li>-->
<!--            </ul>-->
<!--          </nav>-->
<!--        </div>-->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

          <!-- Top Navbar -->
          <header class="bg-white shadow-md p-2 flex justify-between items-center">
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
              <v-list>
                <v-list-item
                    @click="profileMenu = !profileMenu"
                    :prepend-avatar="'storage/' + $page.props.auth.user.avatar"
                    :title="$page.props.auth.user.name"
                    :subtitle="$page.props.auth.user.phone"
                    class="rounded"
                />
              </v-list>

              <div :class="{'hidden' : profileMenu}" class="absolute z-50 right-0 mt-2 bg-white border rounded shadow-md">
                <Link :href="route('profile.edit')" class="block px-4 py-2 hover:bg-gray-100">Profile</Link>
                <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 hover:bg-gray-100">Logout</Link>
              </div>
            </div>
          </header>

          <!-- Dashboard Content -->
          <main class="flex-1 p-4 space-y-6">
            <slot/>
          </main>

        </div>
      </div>
    </VMain>
  </VApp>

</template>
