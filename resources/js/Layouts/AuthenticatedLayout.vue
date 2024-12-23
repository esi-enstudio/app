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
          {icon: 'mdi-home', label: 'All User', route: 'user.index', children: []},
          // Add New
          {icon: 'mdi-home', label: 'Add New User', route: 'user.create', children: []},
        ]
      },

      // DD House
      {icon: 'mdi-home', label: 'House', children: [
          // All House
          {icon: 'mdi-home', label: 'All House', route: 'ddHouse.index', children: []},
          // Add New
          {icon: 'mdi-home', label: 'Add New House', route: 'ddHouse.create', children: []},
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

const drawer = ref(true)
// const rail = ref(false)
</script>

<template>
    <VApp>
        <VNavigationDrawer permanent expand-on-hover rail>
            <v-list>
                <v-list-item
                    prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                    subtitle="sandra_a88@gmailcom"
                    title="Sandra Adams"
                />
            </v-list>

            <VDivider></VDivider>

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
                        <Link :href="route(menu.route)">
                            <v-list-item-title v-text="menu.label"/>
                        </Link>
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

                        <div v-for="(dropdown, i) in menu.children" :key="i">
                            <!-- First Level Menu -->
                            <v-list-item v-if="dropdown.children.length < 1" :value="dropdown.label">
                                <Link :href="route(dropdown.route)">
                                    <v-list-item-title v-text="dropdown.label"/>
                                </Link>
                            </v-list-item>
                            <!-- First Level Menu End -->

                            <!-- First Level Dropdown Menu -->
                            <v-list-group v-else>
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
                        </div>
                    </v-list-group>
                    <!-- Main Menu With Dropdown End -->
                </div>
            </v-list>
        </VNavigationDrawer>

        <VAppBar scroll-behavior="elevate hide">
            <VAppBarTitle>Application</VAppBarTitle>

          <template v-slot:append>
            <v-btn icon="mdi-dots-vertical"></v-btn>
          </template>
        </VAppBar>

        <VMain>
            <slot/>
        </VMain>
    </VApp>
</template>
