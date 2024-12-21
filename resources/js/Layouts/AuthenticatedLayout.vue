<script setup>
import { ref } from 'vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const menus = [
  {subheader: 'Dashboard', menuItems: [
      {icon: 'mdi-home', label: 'Dashboard', route: 'dashboard', children: []},
    ]
  },

  // Category
  {subheader: 'Category', menuItems: [
      // Users
      {icon: 'mdi-home', label: 'Users', children: [
          // All User
          {icon: 'mdi-home', label: 'All User', route: 'user.index'},
          // Add New
          {icon: 'mdi-home', label: 'Add New', route: 'user.create'},
        ]
      },

      // DD House
      {icon: 'mdi-home', label: 'House', children: [
          // All House
          {icon: 'mdi-home', label: 'All House', route: 'ddHouse.index'},
          // Add New
          {icon: 'mdi-home', label: 'Add New', route: 'ddHouse.create'},
        ]
      },

      // Rso
      {icon: 'mdi-home', label: 'Rso', route: 'rso.index', children: []},
      // Retailer
      {icon: 'mdi-home', label: 'Retailer', route: 'retailer.index', children: []},
    ]
  },

  // Services
  {subheader: 'Services', menuItems: [
      // Itop Replace
      {icon: 'mdi-home', label: 'Itop Replace', route: 'itopReplace.index', children: []},
      // Commission
      {icon: 'mdi-home', label: 'Commission', route: 'commission.index', children: []},
      // Lifting
      {icon: 'mdi-home', label: 'Lifting', route: 'lifting.index', children: []},
    ]
  },

  // Inventory
  {subheader: 'Inventory', menuItems: [
      // Product
      {icon: 'mdi-home', label: 'Product', route: 'product.index', children: []},
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
        />
      </v-list>

      <v-divider></v-divider>

      <v-list v-for="(subheading, index) in menus" :key="index">

        <v-list-subheader>{{subheading.subheader}}</v-list-subheader>

        <!-- Main Menu -->
        <div v-for="(menu, indx) in subheading.menuItems" :key="indx">
          <v-list-item
              v-if="menu.children.length < 1"
              :value="indx"
              :prepend-icon="menu.icon"
              color="primary"
              rounded="md"
          >
            <v-list-item-title v-text="menu.label"/>
          </v-list-item>

          <!-- Main Menu With Dropdown -->
          <v-list-group v-else :value="menu.label">
            <!-- Main Menu Title -->
            <template v-slot:activator="{ props }">
              <v-list-item
                  v-bind="props"
                  :prepend-icon="menu.icon"
                  :title="menu.label"
                  color="primary"
                  rounded="md"
              />
            </template>
            <!-- Main Menu Title End -->

            <!-- First Level Dropdown Menu -->
            <v-list-group v-for="(dropdown, i) in menu.children" :key="i">
              <!-- First Level Dropdown Menu Title -->
              <template v-slot:activator>
                <v-list-item
                    :value="dropdown.label"
                    :title="dropdown.label"
                ></v-list-item>
              </template>
              <!-- First Level Dropdown Menu Title End -->
            </v-list-group>
            <!-- First Level Dropdown Menu End -->
          </v-list-group>
          <!-- Main Menu With Dropdown End -->
        </div>
      </v-list>
    </VNavigationDrawer>
    <VMain>
      <!-- Dashboard Wrapper -->
<!--      <div class="flex flex-col md:flex-row min-h-screen">-->
<!--        &lt;!&ndash; Sidebar &ndash;&gt;-->
<!--&lt;!&ndash;        <div&ndash;&gt;-->
<!--&lt;!&ndash;            :class="{'hidden' : sidebarToggle}"&ndash;&gt;-->
<!--&lt;!&ndash;            class="bg-gray-800 text-gray-100 w-full md:w-64 px-4 py-6 md:block">&ndash;&gt;-->
<!--&lt;!&ndash;          <div class="text-2xl font-bold mb-4">&ndash;&gt;-->
<!--&lt;!&ndash;            <Link :href="route('dashboard')">&ndash;&gt;-->
<!--&lt;!&ndash;              <ApplicationLogo class="w-full h-20"/>&ndash;&gt;-->
<!--&lt;!&ndash;            </Link>&ndash;&gt;-->
<!--&lt;!&ndash;          </div>&ndash;&gt;-->
<!--&lt;!&ndash;          <nav class="space-y-2">&ndash;&gt;-->
<!--&lt;!&ndash;            <ul>&ndash;&gt;-->
<!--&lt;!&ndash;              <li v-for="(menu, index) in menus" :key="index">&ndash;&gt;-->
<!--&lt;!&ndash;                <Link&ndash;&gt;-->
<!--&lt;!&ndash;                    v-if="menu.children.length < 1"&ndash;&gt;-->
<!--&lt;!&ndash;                    class="block px-4 py-2 rounded hover:bg-gray-500 font-semibold"&ndash;&gt;-->
<!--&lt;!&ndash;                    :class="{'bg-gray-700' : route().current(menu.route)}"&ndash;&gt;-->
<!--&lt;!&ndash;                    :href="route(menu.route)"&ndash;&gt;-->
<!--&lt;!&ndash;                >&ndash;&gt;-->
<!--&lt;!&ndash;                  {{menu.label}}&ndash;&gt;-->
<!--&lt;!&ndash;                </Link>&ndash;&gt;-->

<!--&lt;!&ndash;                <span&ndash;&gt;-->
<!--&lt;!&ndash;                    v-else&ndash;&gt;-->
<!--&lt;!&ndash;                    @click="toggleDropdown(index)"&ndash;&gt;-->
<!--&lt;!&ndash;                    class="block px-4 py-2 rounded hover:bg-gray-500 cursor-pointer font-semibold"&ndash;&gt;-->
<!--&lt;!&ndash;                    :class="{'bg-gray-700' : route().current(menu.route+'.*')}"&ndash;&gt;-->
<!--&lt;!&ndash;                >&ndash;&gt;-->
<!--&lt;!&ndash;                            {{menu.label}}&ndash;&gt;-->

<!--&lt;!&ndash;                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">&ndash;&gt;-->
<!--&lt;!&ndash;                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />&ndash;&gt;-->
<!--&lt;!&ndash;                            </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                        </span>&ndash;&gt;-->

<!--&lt;!&ndash;                <div&ndash;&gt;-->
<!--&lt;!&ndash;                    v-if="menu.children.length > 0"&ndash;&gt;-->
<!--&lt;!&ndash;                    :class="{'hidden' : openDropdown !== index}"&ndash;&gt;-->
<!--&lt;!&ndash;                    class="space-y-2 bg-slate-600 rounded"&ndash;&gt;-->
<!--&lt;!&ndash;                >&ndash;&gt;-->
<!--&lt;!&ndash;                  <ul>&ndash;&gt;-->
<!--&lt;!&ndash;                    <li>&ndash;&gt;-->
<!--&lt;!&ndash;                      <Link&ndash;&gt;-->
<!--&lt;!&ndash;                          v-for="(subMenu, index) in menu.children"&ndash;&gt;-->
<!--&lt;!&ndash;                          :key="index"&ndash;&gt;-->
<!--&lt;!&ndash;                          :href="route(subMenu.route)"&ndash;&gt;-->
<!--&lt;!&ndash;                          class="block pl-8 py-2 rounded hover:bg-gray-700"&ndash;&gt;-->
<!--&lt;!&ndash;                      >&ndash;&gt;-->
<!--&lt;!&ndash;                        {{subMenu.label}}&ndash;&gt;-->
<!--&lt;!&ndash;                      </Link>&ndash;&gt;-->
<!--&lt;!&ndash;                    </li>&ndash;&gt;-->
<!--&lt;!&ndash;                  </ul>&ndash;&gt;-->
<!--&lt;!&ndash;                </div>&ndash;&gt;-->
<!--&lt;!&ndash;              </li>&ndash;&gt;-->
<!--&lt;!&ndash;            </ul>&ndash;&gt;-->
<!--&lt;!&ndash;          </nav>&ndash;&gt;-->
<!--&lt;!&ndash;        </div>&ndash;&gt;-->

<!--        &lt;!&ndash; Main Content &ndash;&gt;-->
<!--        <div class="flex-1 flex flex-col">-->

<!--          &lt;!&ndash; Top Navbar &ndash;&gt;-->
<!--          <header class="bg-white shadow-md p-2 flex justify-between items-center">-->
<!--            &lt;!&ndash; Menu Show/Hide Button &ndash;&gt;-->
<!--            <button @click="sidebarToggle = !sidebarToggle" id="menu-btn" class="text-gray-700 focus:outline-none md:hidden">-->
<!--              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />-->
<!--              </svg>-->
<!--            </button>-->

<!--            &lt;!&ndash; Search Bar &ndash;&gt;-->
<!--            <div class="relative">-->
<!--              <input type="text" placeholder="Search..." class="bg-gray-200 rounded-full py-2 px-4 focus:outline-none">-->
<!--            </div>-->

<!--            &lt;!&ndash; Profile Dropdown &ndash;&gt;-->
<!--            <div class="relative">-->
<!--              <v-list>-->
<!--                <v-list-item-->
<!--                    @click="profileMenu = !profileMenu"-->
<!--                    :prepend-avatar="'storage/' + $page.props.auth.user.avatar"-->
<!--                    :title="$page.props.auth.user.name"-->
<!--                    :subtitle="$page.props.auth.user.phone"-->
<!--                    class="rounded"-->
<!--                />-->
<!--              </v-list>-->

<!--              <div :class="{'hidden' : profileMenu}" class="absolute z-50 right-0 mt-2 bg-white border rounded shadow-md">-->
<!--                <Link :href="route('profile.edit')" class="block px-4 py-2 hover:bg-gray-100">Profile</Link>-->
<!--                <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 hover:bg-gray-100">Logout</Link>-->
<!--              </div>-->
<!--            </div>-->
<!--          </header>-->

<!--          &lt;!&ndash; Dashboard Content &ndash;&gt;-->
<!--          <main class="flex-1 p-4 space-y-6">-->
<!--            <slot/>-->
<!--          </main>-->

<!--        </div>-->
<!--      </div>-->
    </VMain>
  </VApp>

</template>
