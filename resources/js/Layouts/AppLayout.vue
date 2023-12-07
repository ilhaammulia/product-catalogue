<template>
  <div class="bg-dark-primary min-h-screen h-full">
    <AppHeader />
    <main class="container mx-auto mb-auto p-6">
      <slot />
    </main>
    <ScrollToTop />
    <AppFooter />
  </div>
</template>

<script setup>
import AppHeader from './AppHeader.vue';
import AppFooter from './AppFooter.vue';

import ScrollToTop from '@/Components/ScrollToTop.vue';
</script>