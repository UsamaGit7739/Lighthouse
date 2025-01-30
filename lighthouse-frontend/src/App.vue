<script setup>
import { ref, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import Layout from './components/inc/Layout.vue';

const router = useRouter();
const route = useRoute();
const logoUrl = ref(`${import.meta.env.VITE_API_URL}/images/logo.svg`);

// Function to update the title dynamically
const updateTitle = () => {
  const titles = {
    '/': 'Login',
    '/performance': 'Performance',
  };
  document.title = titles[route.path] || 'LightHoue';
};

onMounted(() => {
  updateTitle();
});

// Watch for route changes and update the title
watch(route, () => {
  updateTitle();
});

const urlParams = new URLSearchParams(window.location.search);
const token = urlParams.get("token");

if (token) {
  localStorage.setItem("token", token); // Save token
  router.push("/performance"); // Redirect after login
}
</script>

<template>
  <Layout :logoUrl="logoUrl">
    <router-view />
  </Layout>
</template>
