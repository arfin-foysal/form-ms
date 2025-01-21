<template>
  <AuthenticatedLayout>
    <div class="grid grid-cols-3 gap-5 p-5">
      <!-- Available Fields -->
      <div class="bg-white p-5 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Available Fields</h3>
        <draggable
          :list="availableFields"
          :group="{ name: 'fields', pull: 'clone', put: false }"
          item-key="name"
          :clone="item => ({ ...item })"
          class="grid grid-cols-3 gap-4"
        >
          <template #item="{ element }">
            <div
              class="w-32 h-32 p-2 bg-gray-100 border rounded-lg flex items-center justify-center text-center"
            >
              <i class="fas fa-grip-vertical mr-2 text-gray-500"></i>
              <span class="text-sm">{{ element.label }}</span>
            </div>
          </template>
        </draggable>
      </div>

      <!-- Form Preview -->
      <div class="col-span-2 bg-white p-5 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Form Preview</h3>
        <form :method="formMethod" :action="formAction" class="space-y-4" @submit.prevent="handleSubmit">
          <input
            type="text"
            v-model="formTitle"
            class="w-full p-2 border rounded-md mb-4"
            placeholder="Form Title"
          />

          <!-- Sorted Form Fields (Before Preview Section) -->
          <draggable
            v-model="formFields"
            group="fields"
            item-key="name"
            class="min-h-[200px] border-2 border-dashed border-gray-300 p-5 rounded-lg"
          >
            <template #item="{ element, index }">
              <div class="p-4 mb-4 bg-gray-100 border rounded-lg relative">
                <label class="font-semibold flex items-center mb-2">
                  <input
                    type="text"
                    v-model="element.label"
                    class="w-full p-2 border rounded-md mb-2"
                    placeholder="Field Label"
                  />
                  <span v-if="element.required" class="ml-1 text-red-500">*</span>
                </label>

                <!-- Required Checkbox -->
                <div class="flex items-center mb-2">
                  <label for="required-checkbox" class="text-sm mr-2">Required</label>
                  <input
                    type="checkbox"
                    v-model="element.required"
                    id="required-checkbox"
                    class="text-blue-500"
                  />
                </div>

                <!-- Textarea -->
                <textarea
                  v-if="element.type === 'textarea'"
                  :name="element.name"
                  :placeholder="element.placeholder"
                  :required="element.required"
                  class="w-full p-2 border rounded-md"
                ></textarea>

                <!-- Select -->
                <select
                  v-else-if="element.type === 'select'"
                  :name="element.name"
                  :required="element.required"
                  class="w-full p-2 border rounded-md"
                >
                  <option value="">{{ element.placeholder }}</option>
                  <option v-for="option in element.options" :key="option.value" :value="option.value">
                    {{ option.label }}
                  </option>
                </select>

                <!-- Other input types: radio, checkbox, text, email, etc. -->

                <!-- Remove Button -->
                <button
                  type="button"
                  @click="removeField(index)"
                  class="absolute top-0 right-0 text-red-500 hover:text-red-700"
                >
                  X
                </button>
              </div>
            </template>
          </draggable>

          <!-- Submit Button -->
          <div v-if="formFields.length > 0" class="text-center mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
              Create Form
            </button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import draggable from 'vuedraggable';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from './../Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  config: Object,
});

const formFields = ref([]);
const availableFields = ref(props.config.forms || []);  // Using the passed fields from the backend

const formTitle = ref('Contact Form');
const formMethod = ref('POST');
const formAction = ref('/submit');

// Handle form submission
const handleSubmit = () => {
  // Update the order dynamically based on the drag-and-drop arrangement
  formFields.value.forEach((field, index) => {
    field.order = index + 1; // Ensure the order is updated
  });

  // Submit the form data along with the ordered fields in JSON
  Inertia.post('/submit', {
    title: formTitle.value,
    fields: formFields.value
  }).then(() => {
    // Redirect or perform actions on success
    Inertia.visit('/form/success'); // Redirect to success page
  }).catch(error => {
    console.log('Error:', error);
  });
};

// Function to remove a field from the formFields array
const removeField = (index) => {
  formFields.value.splice(index, 1);
};
</script>

<style scoped>
.grid {
  gap: 1.25rem;
}
</style>
