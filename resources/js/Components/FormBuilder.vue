<script setup>
import { ref, h } from 'vue';
import draggable from 'vuedraggable';

const formFields = ref([]);
const availableFields = ref([
  {
    type: 'text',
    name: 'name',
    label: 'Name',
    placeholder: 'Enter your name',
    required: true
  },
  {
    type: 'email',
    name: 'email',
    label: 'Email',
    placeholder: 'Enter your email',
    required: true,
    validation: 'email'
  },
  {
    type: 'textarea',
    name: 'message',
    label: 'Message',
    placeholder: 'Enter your message',
    required: true,
    validation: 'min:10|max:500'
  },
  {
    type: 'password',
    name: 'password',
    label: 'Password',
    placeholder: 'Enter your password',
    required: true,
    validation: 'min:8'
  },
  {
    type: 'number',
    name: 'age',
    label: 'Age',
    placeholder: 'Enter your age',
    required: false,
    validation: 'min:18|max:100'
  },
  {
    type: 'date',
    name: 'dob',
    label: 'Date of Birth',
    required: false,
    validation: 'before:today'
  },
  {
    type: 'file',
    name: 'profile_picture',
    label: 'Picture',
    required: false,
    validation: 'mimes:jpg,jpeg,png|max:2048'
  },
  {
    type: 'checkbox',
    name: 'agree',
    label: 'I agree to the terms and conditions',
    required: true,
    options: [{ value: 'yes', label: 'Yes' }],
    validation: 'accepted'
  },
  {
    type: 'radio',
    name: 'gender',
    label: 'Gender',
    required: true,
    options: [
      { value: 'male', label: 'Male' },
      { value: 'female', label: 'Female' },
      { value: 'other', label: 'Other' }
    ]
  },
  {
    type: 'select',
    name: 'country',
    label: 'Country',
    placeholder: 'Select a country',
    required: true,
    options: [
      { value: 'bd', label: 'Bangladesh' },
      { value: 'in', label: 'India' },
      { value: 'us', label: 'United States' }
    ]
  },
  {
    type: 'color',
    name: 'favorite_color',
    label: 'Favorite Color',
    required: false,
    validation: 'regex:^#[0-9a-fA-F]{6}$'
  },
  {
    type: 'range',
    name: 'satisfaction',
    label: 'Satisfaction Level',
    min: 1,
    max: 10,
    step: 1,
    required: true,
    validation: 'integer|min:1|max:10'
  },
  {
    type: 'time',
    name: 'meeting_time',
    label: 'Meeting Time',
    required: false
  },
  {
    type: 'url',
    name: 'website',
    label: 'Website',
    placeholder: 'Enter your website',
    required: false,
    validation: 'url'
  },
  {
    type: 'tel',
    name: 'phone',
    label: 'Phone Number',
    placeholder: 'Enter your phone number',
    required: true,
    validation: 'regex:/^\\+?[0-9]{7,15}$/'
  }
]);

const formTitle = ref('Contact Form');
const formMethod = ref('POST');
const formAction = ref('/submit');
</script>

<template>
  <div class="grid grid-cols-3 gap-5 p-5">
    <div class="bg-white p-5 rounded-lg shadow-lg">
      <h3 class="text-lg font-semibold mb-4">Available Fields</h3>
      <draggable 
  :list="availableFields"
  :group="{ name: 'fields', pull: 'clone', put: false }"
  item-key="name"
  :clone="item => ({...item})"
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

    <div class="col-span-2 bg-white p-5 rounded-lg shadow-lg">
      <h3 class="text-lg font-semibold mb-4">Form Preview</h3>
      <form :method="formMethod" :action="formAction" class="space-y-4">
        <input type="text" v-model="formTitle" class="w-full p-2 border rounded-md mb-4" placeholder="Form Title">

        <draggable 
          v-model="formFields"
          group="fields"
          item-key="name"
          class="min-h-[200px] border-2 border-dashed border-gray-300 p-5 rounded-lg"
        >
          <template #item="{ element }">
            <div class="p-4 mb-4 bg-gray-100 border rounded-lg">
              <label class="font-semibold flex items-center mb-2">
                {{ element.label }}
                <span v-if="element.required" class="ml-1 text-red-500">*</span>
              </label>
              
              <textarea
                v-if="element.type === 'textarea'"
                :name="element.name"
                :placeholder="element.placeholder"
                :required="element.required"
                class="w-full p-2 border rounded-md"  
              ></textarea>

              <select
                v-else-if="element.type === 'select'"
                :name="element.name"
                :required="element.required"
                class="w-full p-2 border rounded-md"
              >
                <option value="">{{ element.placeholder }}</option>
                <option
                  v-for="option in element.options"
                  :key="option.value"
                  :value="option.value"
                >
                  {{ option.label }}
                </option>
              </select>

              <div v-else-if="element.type === 'radio' || element.type === 'checkbox'" class="flex flex-col space-y-2">
                <div
                  v-for="option in element.options"
                  :key="option.value"
                  class="flex items-center"
                >
                  <input
                    :type="element.type"
                    :name="element.name"
                    :value="option.value"
                    :required="element.required"
                    class="mr-2"
                  >
                  <label>{{ option.label }}</label>
                </div>
              </div>

              <input
                v-else
                :type="element.type"
                :name="element.name"
                :placeholder="element.placeholder"
                :required="element.required"
                class="w-full p-2 border rounded-md"
              >

              <div v-if="element.validation" class="mt-2 text-sm text-gray-500 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                {{ element.validation }}
              </div>
            </div>
          </template>
        </draggable>

        <div v-if="formFields.length > 0" class="text-center mt-4">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</template> 
