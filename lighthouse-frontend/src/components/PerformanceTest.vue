<template>
  <div class="performance-container container mt-5">
    <h2 class="text-center mb-4">Check Website Performance</h2>
    <div class="form-group mb-3">
      <label for="urlInput">Enter Website URL</label>
      <input
        v-model="url"
        id="urlInput"
        type="url"
        class="form-control"
        placeholder="Enter website URL"
      />
    </div>

    <div class="form-group mb-3">
      <label for="platformSelect">Select Platform</label>
      <select v-model="platform" id="platformSelect" class="form-control">
        <option value="desktop">Desktop</option>
        <option value="mobile">Mobile</option>
      </select>
    </div>

    <button @click="fetchPerformance" class="btn btn-primary btn-block">
      Check Performance
    </button>

    <!-- Indeterminate Progress Bar -->
    <div v-if="isLoading" class="mt-3">
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <span>Loading...</span>
    </div>

    <div v-if="performanceScore !== null" class="mt-4">
      <h3>Performance Score: {{ performanceScore }}</h3>
    </div>

    <div v-if="errorMessage" class="error mt-3 alert alert-danger">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const url = ref("");
const platform = ref("desktop");
const performanceScore = ref(null);
const errorMessage = ref("");
const isLoading = ref(false);
const progressValue = ref(0);  // Progress bar value

const fetchPerformance = async () => {
  errorMessage.value = "";
  performanceScore.value = null;
  isLoading.value = true; // Show loading spinner
  progressValue.value = 0; // Reset progress value

  const token = localStorage.getItem("token"); // Get token from storage

  if (!token) {
    errorMessage.value = "Unauthorized: No token found. Please log in.";
    isLoading.value = false;
    return;
  }

  try {
    const { data } = await axios.post(
      "http://127.0.0.1:8000/api/performance",
      { url: url.value, platform: platform.value },
      { 
        headers: { Authorization: `Bearer ${token}` },
        onDownloadProgress: (progressEvent) => {
          // Fallback when total is undefined
          if (progressEvent.lengthComputable) {
            progressValue.value = Math.round((progressEvent.loaded / progressEvent.total) * 100);
          }
        }
      }
    );

    performanceScore.value = data.performance_score;
  } catch (error) {
    console.error("Error fetching performance:", error);
    errorMessage.value = "Error: " + (error.response?.data?.message || "Failed to fetch performance");
  } finally {
    isLoading.value = false; // Hide progress bar/spinner after request
  }
};
</script>




<style scoped>
.performance-container {
  max-width: 600px;
  margin: 0 auto;
}
.error {
  color: red;
}
.progress {
  width: 100%;
}
</style>
