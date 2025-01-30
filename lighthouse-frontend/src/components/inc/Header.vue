<template>
  <header class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img :src="logoUrl" alt="Logo" height="50" />
      </a>
    </div>
  </header>
</template>

<script setup>
defineProps({
  logoUrl: {
    type: String,
    required: true, // Make it required if it's always passed
  },
});
</script>

<style scoped>
.navbar {
  padding: 10px 0;
}

.navbar .navbar-brand img {
  height: 50px;
}
</style>
