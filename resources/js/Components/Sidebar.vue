<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  isOpen: {
    type: Boolean,
    default: true
  }
});

const emit = defineEmits(['toggle']);
</script>

<template>
  <aside :class="{ 'sidebar': true, 'closed': !isOpen }">
    <div class="sidebar-content">
      <h2>Dashboard</h2>
      <nav>
        <ul>
          <li>
            <a href="#"><i class="fas fa-home"></i> <span>Home</span></a>
          </li>
          <li>
            <a href="#"><i class="fas fa-wpforms"></i> <span>Form Builder</span></a>
          </li>
          <li>
            <a href="#"><i class="fas fa-list"></i> <span>Form List</span></a>
          </li>
          <li>
            <a href="#"><i class="fas fa-cog"></i> <span>Settings</span></a>
          </li>
        </ul>
      </nav>
    </div>
    <button class="toggle-btn" @click="$emit('toggle')">
      <i :class="isOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
    </button>
  </aside>
</template>

<style scoped>
.sidebar {
  width: 250px;
  background-color: #2c3e50;
  color: white;
  position: fixed;
  height: 100vh;
  transition: all 0.3s ease;
  z-index: 1000;
  left: 0;
  top: 0;
}

.sidebar.closed {
  width: 60px;
}

.sidebar.closed .sidebar-content h2,
.sidebar.closed .sidebar-content span {
  display: none;
}

.sidebar.closed .sidebar-content a {
  justify-content: center;
  padding: 12px 0;
}

.sidebar.closed .sidebar-content i {
  margin: 0;
  font-size: 1.2em;
}

.toggle-btn {
  position: absolute;
  right: -40px;
  top: 10px;
  background: #2c3e50;
  border: none;
  color: white;
  padding: 10px 15px;
  cursor: pointer;
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
}

.sidebar-content {
  padding: 20px;
  height: 100%;
  overflow-y: auto;
}

h2 {
  margin-bottom: 30px;
  font-size: 1.5em;
  text-align: center;
}

nav ul {
  list-style: none;
  padding: 0;
}

nav ul li {
  margin-bottom: 15px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  display: flex;
  align-items: center;
  padding: 12px 15px;
  border-radius: 5px;
  transition: background-color 0.3s;
}

nav ul li a:hover {
  background-color: #34495e;
}

nav ul li a i {
  margin-right: 10px;
  width: 20px;
  text-align: center;
}
</style>