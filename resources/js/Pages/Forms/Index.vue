<template>
  <AuthenticatedLayout>
    <div class="container mx-auto mt-6">
      <!-- Page Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Form Management</h1>
        <!-- Create Button -->
        <Link
          :href="route('builder')"
          class="bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600 transition duration-300"
        >
          + Create Form
        </Link>
      </div>

      <!-- Forms Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="table-auto w-full">
          <thead class="bg-gray-50 border-b">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                ID
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Title
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Created At
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- No Forms Available -->
            <tr v-if="forms.data.length === 0">
              <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                No forms available
              </td>
            </tr>

            <!-- Forms Rows -->
            <tr
              v-else
              v-for="form in forms.data"
              :key="form.id"
              class="hover:bg-gray-50 transition"
            >
              <td class="px-6 py-4 text-sm text-gray-700">{{ forms.from + forms.data.indexOf(form) }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ form.title }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">
                {{ new Date(form.created_at).toLocaleString() }}
              </td>
              <td class="px-6 py-4 space-x-2">
                <Link
                  :href="route('form.edit', form.id)"
                  class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
                >
                  Edit
                </Link>

                <Link
                  :href="route('form.show', form.id)"
                  class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300"
                >
                  Show
                </Link>

                <Link
                  :href="route('form.delete', form.id)"
                  method="delete"
                  as="button"
                  type="button"
                  class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300"
                >
                  Delete
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6">
        <Pagination :links="forms.links" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  forms: {
    type: Object,
    required: true,
  },
});
</script>

<style>
/* Optional custom styles */
</style>
