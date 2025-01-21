<template>
  <AuthenticatedLayout>
    <div class="grid grid-cols-3 gap-5 p-5">
      <!-- Available Fields (drag to form) -->
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
            <div class="w-32 h-32 p-2 bg-gray-100 border rounded-lg flex items-center justify-center text-center">
              <i class="fas fa-grip-vertical mr-2 text-gray-500"></i>
              <span class="text-sm">{{ element.label }}</span>
            </div>
          </template>
        </draggable>
      </div>

      <!-- Form Preview (editable form) -->
      <div class="col-span-2 bg-white p-5 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Edit Form</h3>
        <form @submit.prevent="handleSubmit" class="space-y-4">
          <!-- Form Title -->
          <input
            v-model="formTitle"
            type="text"
            class="w-full p-2 border rounded-md mb-4"
            placeholder="Form Title"
            :required="true"
          />

          <!-- Sorted Fields -->
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

          <!-- Add New Field -->
          <div class="text-center mt-4">
            <button
              type="button"
              @click="addNewField"
              class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
            >
              Add New Field
            </button>
          </div>

          <!-- Submit Button -->
          <div v-if="formFields.length > 0" class="text-center mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
              Update Form
            </button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import draggable from 'vuedraggable';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from './../../Layouts/AuthenticatedLayout.vue';

// Define props passed from the backend (via Inertia)
const props = defineProps({
  form: Object,
  config: Object,
});

// Form data
const formFields = ref(props.form.fields || []);  // Using the passed fields from the backend
const formTitle = ref(props.form.title || '');    // Using the passed title from the backend
const formId = ref(props.form.id || null);

// Form data
const availableFields = ref(props.config.forms || []);  // Using the passed fields from the backend

// Handle form submission
const handleSubmit = () => {
  formFields.value.forEach((field, index) => {
    field.order = index + 1; // Ensure the order is updated
    field.name = field.name || `field_${index + 1}`; // Assign default name if not set

    // If the field is required and has no value, send `null` or an empty string
    if (field.required && (field.value === "" || field.value === undefined || field.value === null)) {
      field.value = null; // or "" for empty string
    }
  });

  // Check if title is set and fields are populated
  if (formTitle.value.trim() && formFields.value.length > 0) {
    Inertia.post(`/forms/${formId.value}`, {
      title: formTitle.value,
      fields: formFields.value
    }).then(() => {
      Inertia.visit(`/forms/success`); // Redirect to success page after submission
    }).catch(error => {
      console.error('Error submitting the form:', error); // Log error if submission fails
    });
  } else {
    // Handle validation error for missing title or fields
    console.error('Form title or fields are missing.');
  }
};

// Remove field from form
const removeField = (index) => {
  formFields.value.splice(index, 1);
};

// Add new field to form
const addNewField = () => {
  const newField = {
    name: 'newField',
    label: 'New Field',
    type: 'text',
    value: '',
    placeholder: 'Enter value',
    required: false
  };
  formFields.value.push(newField);
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
