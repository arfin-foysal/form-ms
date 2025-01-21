<template>
  <AuthenticatedLayout>
    <div class="bg-white p-5 rounded-lg shadow-lg">
      <h3 class="text-lg font-semibold mb-4">Form Preview</h3>
      <form :method="formMethod" :action="formAction" class="space-y-4">
        <!-- Form Title -->
        <input
          v-model="formTitle"
          type="text"
          class="w-full p-2 border rounded-md mb-4"
          placeholder="Form Title"
          disabled
        />

        <!-- Sorted Fields -->
        <div class="min-h-[200px] border-2 border-dashed border-gray-300 p-5 rounded-lg">
          <draggable
            v-model="formFields"
            group="fields"
            item-key="name"
            class="space-y-4"
            :disabled="true"
          >
            <template #item="{ element, index }">
              <div class="p-4 mb-4 bg-gray-100 border rounded-lg relative">
                <label class="font-semibold flex items-center mb-2">
                  <input
                    v-model="element.label"
                    type="text"
                    class="w-full p-2 border rounded-md mb-2"
                    placeholder="Field Label"
                    disabled
                  />
                  <span v-if="element.required" class="ml-1 text-red-500">*</span>
                </label>

                <!-- Input Types -->
                <div v-if="element.type === 'text'">
                  <input
                    v-model="element.value"
                    type="text"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'email'">
                  <input
                    v-model="element.value"
                    type="email"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'textarea'">
                  <textarea
                    v-model="element.value"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  ></textarea>
                </div>
                <div v-if="element.type === 'password'">
                  <input
                    v-model="element.value"
                    type="password"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'number'">
                  <input
                    v-model="element.value"
                    type="number"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'select'">
                  <select
                    v-model="element.value"
                    :name="element.name"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  >
                    <option v-for="option in element.options" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                </div>
                <div v-if="element.type === 'radio'">
                  <div v-for="option in element.options" :key="option.value" class="mb-1">
                    <label class="flex items-center">
                      <input
                        v-model="element.value"
                        type="radio"
                        :name="element.name"
                        :value="option.value"
                        :required="element.required"
                        class="mr-2"
                        disabled
                      />
                      {{ option.label }}
                    </label>
                  </div>
                </div>
                <div v-if="element.type === 'checkbox'">
                  <div v-for="option in element.options" :key="option.value" class="mb-1">
                    <label class="flex items-center">
                      <input
                        v-model="element.value"
                        type="checkbox"
                        :name="element.name"
                        :value="option.value"
                        :required="element.required"
                        class="mr-2"
                        disabled
                      />
                      {{ option.label }}
                    </label>
                  </div>
                </div>
                <div v-if="element.type === 'file'">
                  <input
                    type="file"
                    :name="element.name"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'date'">
                  <input
                    v-model="element.value"
                    type="date"
                    :name="element.name"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'datetime-local'">
                  <input
                    v-model="element.value"
                    type="datetime-local"
                    :name="element.name"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'time'">
                  <input
                    v-model="element.value"
                    type="time"
                    :name="element.name"
                    :required="element.required"
                    class="w-full p-2 border rounded-md"
                    disabled
                  />
                </div>
                <div v-if="element.type === 'color'">
                  <input
                    v-model="element.value"
                    type="color"
                    :name="element.name"
                    :required="element.required"
                    class="w-12 h-12 border rounded-md"
                    disabled
                  />
                </div>
              </div>
            </template>
          </draggable>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import draggable from 'vuedraggable';
import AuthenticatedLayout from './../../Layouts/AuthenticatedLayout.vue';

// Define props passed from the backend (via Inertia)
const props = defineProps({
  form: Object,
});

// Form data
const formFields = ref(props.form.fields || []);  // Using the passed fields from the backend
const formTitle = ref(props.form.title || '');    // Using the passed title from the backend
</script>
