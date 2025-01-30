<template>
  <div>
    <Header />
    <div class="main-content">
      <slot></slot> <!-- This will display the content of the page -->
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import Header from './Header.vue';
import Footer from './Footer.vue';

const props = defineProps({
  title: {
    type: String,
    required: true
  }
});

// Set the document title dynamically
document.title = props.title;
</script>

<style scoped>
.main-content {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80vh;
}
</style>
