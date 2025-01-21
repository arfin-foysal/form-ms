<template>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
      <h3 class="text-2xl font-semibold mb-6 text-gray-700">{{ formTitle }}</h3>
  
      <form :method="formMethod" :action="formAction" class="space-y-6" @submit.prevent="submitForm">
        <!-- Sorted Fields -->
        <div class="min-h-[200px] border-2 border-dashed border-gray-300 p-6 rounded-lg">
          <draggable
            v-model="formFields"
            group="fields"
            item-key="id"
            class="space-y-6"
          >
            <template #item="{ element, index }">
              <div class="p-6 mb-6 bg-gray-100 border rounded-lg relative shadow-sm">
                <label class="font-semibold flex items-center mb-3 text-gray-800">
                  {{ element.label }}
                  <span v-if="element.required" class="ml-2 text-red-500">*</span>
                </label>
  
                <!-- Input Types -->
                <div v-if="element.type === 'text'">
                  <input
                    v-model="element.value"
                    type="text"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700 placeholder-gray-500', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'email'">
                  <input
                    v-model="element.value"
                    type="email"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700 placeholder-gray-500', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'textarea'">
                  <textarea
                    v-model="element.value"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700 placeholder-gray-500', { 'border-red-500': errors[element.name] }]"
                  ></textarea>
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'password'">
                  <input
                    v-model="element.value"
                    type="password"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700 placeholder-gray-500', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'number'">
                  <input
                    v-model="element.value"
                    type="number"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700 placeholder-gray-500', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'select'">
                  <select
                    v-model="element.value"
                    :name="element.name"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700', { 'border-red-500': errors[element.name] }]"
                  >
                    <option v-for="option in element.options" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'radio'">
                  <div v-for="option in element.options" :key="option.value" class="mb-3">
                    <label class="flex items-center">
                      <input
                        v-model="element.value"
                        type="radio"
                        :name="element.name"
                        :value="option.value"
                        :required="element.required"
                        :class="{ 'border-red-500': errors[element.name] }"
                      />
                      {{ option.label }}
                    </label>
                  </div>
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'checkbox'">
                  <div v-for="option in element.options" :key="option.value" class="mb-3">
                    <label class="flex items-center">
                      <input
                        v-model="element.value"
                        type="checkbox"
                        :name="element.name"
                        :value="option.value"
                        :required="element.required"
                        :class="{ 'border-red-500': errors[element.name] }"
                      />
                      {{ option.label }}
                    </label>
                  </div>
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'file'">
                  <input
                    type="file"
                    :name="element.name"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'date'">
                  <input
                    v-model="element.value"
                    type="date"
                    :name="element.name"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'time'">
                  <input
                    v-model="element.value"
                    type="time"
                    :name="element.name"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
  
                <div v-if="element.type === 'url'">
                  <input
                    v-model="element.value"
                    type="url"
                    :name="element.name"
                    :placeholder="element.placeholder"
                    :required="element.required"
                    :class="['w-full p-3 border rounded-md bg-gray-50 text-gray-700 placeholder-gray-500', { 'border-red-500': errors[element.name] }]"
                  />
                  <p v-if="errors[element.name]" class="text-sm text-red-500">{{ errors[element.name] }}</p>
                </div>
              </div>
            </template>
          </draggable>
        </div>
  
        <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
          Submit
        </button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { reactive, defineProps } from 'vue';
  import draggable from 'vuedraggable';
  
  // Define props passed from the backend (via Inertia)
  const props = defineProps({
    form: {
      type: Object,
      default: () => ({
        fields: [],
        title: '',
      }),
    },
  });
  
  // Form data
  const formFields = reactive(props.form.fields || []);  // Using the passed fields from the backend
  const formTitle = props.form.title || '';  // Using the passed title from the backend
  
  // Errors object to hold validation messages
  const errors = reactive({});
  
  // Simple submit handler
  const submitForm = () => {
    errors.value = {};  // Reset errors
  
    // Validate each field
    formFields.forEach((field) => {
      if (field.required && !field.value) {
        errors[field.name] = 'This field is required';
      }
  
      if (field.validation) {
        const validationRules = field.validation.split('|');
        validationRules.forEach((rule) => {
          const [ruleName, ruleValue] = rule.split(':');
          // Handle custom validation logic here
          if (ruleName === 'email' && !/\S+@\S+\.\S+/.test(field.value)) {
            errors[field.name] = 'Please enter a valid email address';
          }
        });
      }
    });
  
    // Continue with form submission if no errors
    if (Object.keys(errors).length === 0) {
      console.log('Form submitted successfully!');
    }
  };
  </script>
  