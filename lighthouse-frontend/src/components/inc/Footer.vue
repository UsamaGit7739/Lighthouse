<template>
  <footer class="footer bg-dark text-white">
    <div class="container text-center">
      <img :src="logoUrl" alt="Logo" height="50" />
      <p class="mt-2">© 2025 LightHouse. All Rights Reserved.</p>
    </div>
  </footer>
</template>

<script setup>
/* No dynamic logic here; just a reusable footer component */
</script>

<style scoped>
.footer {
  padding: 20px 0;
}

.footer img {
  height: 50px;
}
</style>
