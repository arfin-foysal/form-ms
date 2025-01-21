  <script setup>
  import { ref } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';


  const isSidebarOpen = ref(true);

  const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
  };

  const menuItems = [
    { icon: '📊', text: 'Dashboard', route: 'form.index' },
    { icon: '📝', text: 'Builder', route: 'builder' },
    { icon: '👤', text: 'Profile', route: 'profile.edit' },
  ];

  const showingNavigationDropdown = ref(false);
  </script>

  <template>  
    <div class="flex min-h-screen">
      <!-- Sidebar -->
      <aside
        :class="[
          'bg-gray-900 dark:bg-gray-950 transition-all duration-300 ease-in-out flex flex-col',
          isSidebarOpen ? 'w-64' : 'w-16'
        ]"
      >
        <div class="p-4 flex items-center justify-between border-b border-gray-700">
          <h2 v-if="isSidebarOpen" class="text-white font-semibold">Dashboard</h2>

          <button
            @click="toggleSidebar"
            class="text-white p-2 hover:bg-gray-700 rounded-lg transition-colors"
          >
            {{ isSidebarOpen ? '←' : '→' }}
          </button>
        </div>
        <nav class="py-4">
          <Link
          
            v-for="(item, index) in menuItems"
            :key="index"
            :href="route(item.route)"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 transition-colors"
          >
            <span class="w-6 text-center">{{ item.icon }}</span>
            <span
              v-if="isSidebarOpen"
              class="ml-4 transition-opacity"
              :class="{ 'opacity-0': !isSidebarOpen }"
            >{{ item.text }}</span>
          </Link>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 bg-gray-100 dark:bg-gray-900">
        <header class="bg-white dark:bg-gray-800 px-8 py-4 shadow-md flex justify-between items-center">
          <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
            Welcome to Form Management System
          </h1>
          <!-- Profile Dropdown -->
          <div class="relative ms-3">
            <Dropdown align="right" width="48">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center rounded-md border border-transparent bg-gray-100 px-3 py-2 text-sm font-medium text-gray-500 transition hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
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
                  :href="route('logout')"
                  method="post"
                  as="button"
                >
                  Log Out
                </DropdownLink>
              </template>
            </Dropdown>
          </div>
        </header>
          <div class="p-8">
      <slot />
          </div>
      </main>
    </div>
  </template>
