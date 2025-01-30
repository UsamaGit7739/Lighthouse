<template>
  <div class="login-container">
    <button @click="loginWithGoogle" class="login-btn">Login with Google</button>
  </div>
</template>

<script setup>
import Layout from './inc/Layout.vue';
import axios from "axios";

const loginWithGoogle = async () => {
  try {
    const { data } = await axios.get("http://127.0.0.1:8000/api/auth/google");
    if (data.url) {
      window.location.href = data.url; // Redirect user to Google OAuth
    } else {
      console.error("Google login URL not received.");
    }
  } catch (error) {
    console.error("Error during login:", error);
  }
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.login-btn {
  background-color: #4285f4;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  font-size: 18px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}
</style>
