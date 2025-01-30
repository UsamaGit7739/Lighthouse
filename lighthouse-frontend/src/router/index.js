import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/components/Login.vue';  // Using alias for clarity
import PerformanceTest from '@/components/PerformanceTest.vue';

const routes = [
  { path: '/', component: Login },
  { path: '/performance', component: PerformanceTest }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
