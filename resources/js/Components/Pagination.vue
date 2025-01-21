<template>
    <nav v-if="links.length > 0" class="flex justify-center mt-4">
      <ul class="flex space-x-2">
        <li
          v-for="(link, index) in links"
          :key="index"
          :class="[
            'px-4 py-2 rounded-lg cursor-pointer',
            link.active
              ? 'bg-blue-600 text-white'
              : 'bg-gray-200 text-gray-700 hover:bg-blue-300',
          ]"
        >
          <a
            v-if="link.url"
            :href="link.url"
            class="block text-center"
            v-html="link.label"
          ></a>
          <span v-else class="block text-center" v-html="link.label"></span>
        </li>
      </ul>
    </nav>
  </template>
  
  <script setup>
  defineProps({
    links: {
      type: Array,
      required: true,
    },
  });
  </script>
  
  <style scoped>
  .pagination a {
    text-decoration: none;
    transition: background-color 0.3s ease;
  }
  
  .pagination span {
    cursor: not-allowed;
  }
  
  .pagination li:hover {
    transform: scale(1.05);
  }
  </style>
  