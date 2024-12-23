<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted, ref, watch} from "vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import {useTheme} from "vuetify";
import $inertia, {debounce} from "lodash";
import {router, usePage} from "@inertiajs/vue3";

const { props } = usePage()
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

const users = props.users
const search = ref(props.searchTerm)

watch(search, debounce(
    (query) => router.get('/user', { search: query }, { preserveState:true }),
    500
))

const delUser = (id, name) => {

  if (confirm(`Are you sure to delete "${name}" user?`))
  {
    router.delete(route('user.destroy', id));
  }
}

// Handle page change
const changePage = (page) => {
  console.log(page)
  $inertia.get(route('user.index'), { page }, {
    preserveState: true, // Keep current state for filters, search, etc.
    preserveScroll: true, // Avoid scrolling to the top
  })
}

console.log(props)
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

          <!-- Table -->
          <VTable density="compact" class="w-full whitespace-nowrap">
            <thead>
            <tr>
              <th>SL</th>
              <th>Avatar</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(user, i) in users.data" :key="user.id">
              <td>{{++i}}</td>
              <td>
                <img class="w-[24px]" :src="user.avatar ? ('storage/' + user.avatar) : ('https://icons.veryicon.com/png/o/miscellaneous/user-avatar/user-avatar-male-5.png')" alt="User Avatar">
              </td>
              <td>{{user.name}}</td>
              <td>{{user.email}}</td>
              <td>{{user.phone}}</td>
              <td>{{user.role}}</td>
              <td>{{user.status}}</td>
              <td class="text-center space-x-2">
                <Link :href="route('user.show', user.id)" class="hover:text-green-400">Show</Link>
                <Link :href="route('user.edit', user.id)" class="hover:text-green-400">Edit</Link>
                <button class="hover:text-red-500" @click="delUser(user.id, user.name)">Delete</button>
              </td>
            </tr>

            <tr v-if="users.data.length < 1">
              <td colspan="8">No data found.</td>
            </tr>
            </tbody>
          </VTable>

          <div v-if="users.links.length > 0" class="flex items-center justify-between mt-3">
            <div>
              Showing
              <span class="font-bold">{{users.from}}</span>
              to
              <span class="font-bold">{{users.to}}</span>
              of
              <span class="font-bold">{{users.total}}</span>
              results
            </div>

            <div>
              <v-pagination
                  v-model="users.current_page"
                  :length="users.last_page"
                  class="my-4"
                  @input="changePage"
              ></v-pagination>


<!--              <Component-->
<!--                  :is="link.url ? 'Link' : 'span'"-->
<!--                  v-for="link in props.data.links"-->
<!--                  :href="link.url"-->
<!--                  v-html="link.label"-->
<!--                  class="px-2 border border-green-400 rounded-md mx-1 hover:bg-green-400 hover:text-white"-->
<!--                  :class="{'text-gray-400 border-gray-400 hover:bg-gray-400 cursor-not-allowed' : !link.url, 'font-bold text-white bg-green-400 rounded-md' : link.active}"-->
<!--              />-->
            </div>
          </div>




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
