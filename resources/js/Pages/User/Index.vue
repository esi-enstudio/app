<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted, ref, watch} from "vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import {useTheme} from "vuetify";
import {debounce} from "lodash";

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

const serverItems = ref([])
const totalItems = ref(0)
const loading = ref(false)
const itemsPerPage = ref(5)
const search = ref('') // Search term

const headers = ref([
  { title: 'Avatar', key: 'avatar' },
  { title: 'Name', key: 'name' },
  { title: 'Phone', key: 'phone' },
  { title: 'Email', key: 'email' },
  { title: 'Role', key: 'role' },
  { title: 'Status', key: 'status' },
  { title: 'Remarks', key: 'remarks' },
  { title: 'Is Disabled', key: 'disabled_at' },
  { title: 'Created', key: 'created_at' },
  { title: 'Last Update', key: 'updated_at' },
])

// Fetch data from server
const fetchServerData = async ({ page, itemsPerPage, sortBy }) => {
  loading.value = true
  try {
    const sortKey = sortBy.length ? sortBy[0].key : null
    const sortOrder = sortBy.length ? sortBy[0].order : null

    const response = await axios.get('/api/users', {
      params: {
        page,
        itemsPerPage,
        sortBy: sortKey,
        sortOrder,
        search: search.value, // Include search query
      },
    })
    serverItems.value = response.data.items
    totalItems.value = response.data.total
  } catch (error) {
    console.error('Failed to fetch server data:', error)
  } finally {
    loading.value = false
  }
}

// Handle search input changes
const onSearchChange = debounce(() => {
  fetchServerData({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: [] })
}, 500) // Delay API calls by 500ms

// Watch the search field for changes
watch(search, (newValue, oldValue) => {
  if (newValue === '') {
    // Reload items when the search field is cleared
    fetchServerData({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: [] })
  }
})

// Initial data fetch
fetchServerData({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: [] })
</script>

<template>
    <Head title="Users" />
<!--    <SessionMessage :status="status"/>-->

    <AuthenticatedLayout>
        <VContainer>
          <!-- Search Input -->
          <v-text-field
              v-model="search"
              prepend-inner-icon="mdi-magnify"
              density="compact"
              variant="outlined"
              label="Search users"
              type="search"
              @input="onSearchChange"
          ></v-text-field>

          <!-- Data Table -->
          <VDataTableServer
              :headers="headers"
              :items="serverItems"
              :items-per-page="itemsPerPage"
              :loading="loading"
              :items-length="totalItems"
              @update:options="fetchServerData"
              class="elevation-1"
          >
            <template #loading>
<!--              <v-progress-linear indeterminate class="ma-0"></v-progress-linear>-->
            </template>
          </VDataTableServer>

<!--          <VCard>-->
<!--            <VCardItem>-->
<!--              <VCardTitle>-->
<!--                Users-->
<!--              </VCardTitle>-->

<!--              <VCardSubtitle>-->
<!--                Showing all user's in this application-->
<!--              </VCardSubtitle>-->

<!--              <VCardText>-->
<!--                &lt;!&ndash; Search Input &ndash;&gt;-->
<!--                <v-text-field-->
<!--                    v-model="search"-->
<!--                    :loading="loading"-->
<!--                    prepend-inner-icon="mdi-magnify"-->
<!--                    density="compact"-->
<!--                    variant="outlined"-->
<!--                    label="Search users"-->
<!--                    clearable-->
<!--                    @input="onSearchChange"-->
<!--                ></v-text-field>-->

<!--                <VDataTableServer-->
<!--                    :headers="headers"-->
<!--                    :items="serverItems"-->
<!--                    :items-per-page="itemsPerPage"-->
<!--                    :loading="loading"-->
<!--                    :items-length="totalItems"-->
<!--                    @update:options="fetchServerData"-->
<!--                    class="elevation-1"-->
<!--                >-->
<!--                  <template #loading>-->
<!--&lt;!&ndash;                                  <v-progress-linear indeterminate class="ma-0"></v-progress-linear>&ndash;&gt;-->
<!--                  </template>-->
<!--                </VDataTableServer>-->
<!--              </VCardText>-->
<!--            </VCardItem>-->
<!--          </VCard>-->


        </VContainer>


<!--        <div class="py-12">-->
<!--            <div class="mx-auto max-w-7xl sm:px-4 lg:px-8">-->
<!--                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">-->
<!--                    <div class="md:block hidden">-->
<!--                        <div class="flex justify-end px-3 pt-4">-->
<!--                            <TextInput-->
<!--                                type="search"-->
<!--                                icon="search"-->
<!--                                v-model="search"-->
<!--                                placeholder="Type something..."-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="md:hidden block">-->
<!--                        <div class="flex justify-end px-3 pt-4">-->
<!--                            <TextInput-->
<!--                                type="search"-->
<!--                                class="w-full"-->
<!--                                icon="search"-->
<!--                                v-model="search"-->
<!--                                placeholder="Type something..."-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="p-3 text-gray-900 dark:text-gray-100 overflow-x-auto">-->
<!--                        <table class="w-full whitespace-nowrap">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>SL</th>-->
<!--                                <th>Avatar</th>-->
<!--                                <th>Name</th>-->
<!--                                <th>Email</th>-->
<!--                                <th>Phone</th>-->
<!--                                <th>Role</th>-->
<!--                                <th>Status</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->

<!--                            <tbody>-->
<!--                            <tr v-for="(user, i) in props.users.data" :key="user.id">-->
<!--                                <td>{{++i}}</td>-->
<!--                                <td>-->
<!--                                    <img class="w-[24px]" :src="user.avatar ? ('storage/' + user.avatar) : ('https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png')" alt="User Avatar">-->
<!--                                </td>-->
<!--                                <td>{{user.name}}</td>-->
<!--                                <td>{{user.email}}</td>-->
<!--                                <td>{{user.phone}}</td>-->
<!--                                <td>{{user.role}}</td>-->
<!--                                <td>{{user.status}}</td>-->
<!--                                <td class="text-center space-x-2">-->
<!--                                    <Link :href="route('user.show', user.id)" class="hover:text-green-400">Show</Link>-->
<!--                                    <Link :href="route('user.edit', user.id)" class="hover:text-green-400">Edit</Link>-->
<!--                                    <button class="hover:text-red-500" @click="delUser(user.id, user.name)">Delete</button>-->
<!--                                </td>-->
<!--                            </tr>-->

<!--                            <tr v-if="props.users.data.length < 1">-->
<!--                                <td colspan="8">No data found.</td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->

<!--                    <div class="px-3 pb-4">-->
<!--                        <div class="lg:block hidden">-->
<!--                            <Pagination :links="props.users.meta"/>-->
<!--                        </div>-->

<!--                        <div class="lg:hidden block">-->
<!--                            <PaginationWithoutLinks :links="props.users"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
