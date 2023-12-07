<template>
  <AppLayout>
    <Head title="Dashboard" />

    <section class="mt-4">
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdminSidebar from '@/Components/AdminSidebar.vue';
import SmallCard from '@/Components/SmallCard.vue';
import { Head } from '@inertiajs/vue3';

export default {
  components: {
    AppLayout,
    AdminSidebar,
    SmallCard,
    Head,
  }
}
</script>