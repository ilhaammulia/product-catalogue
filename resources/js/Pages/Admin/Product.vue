<template>
  <AppLayout>
    <Head title="Product" />

    <section class="mt-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
        <SmallCard title="Total Products">
          <template #icon>
            <CubeIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ meta.total_products }}</span>
          </template>
        </SmallCard>
        <SmallCard title="Total Stocks">
          <template #icon>
            <ArchiveBoxArrowDownIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ meta.total_stocks }}</span>
          </template>
        </SmallCard>
        <SmallCard title="Out of Stock">
          <template #icon>
            <ArchiveBoxXMarkIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ meta.total_out_of_stocks }}</span>
          </template>
        </SmallCard>
      </div>

      <div>
        <VueTable :products="products" class="mt-6 w-full" />
      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdminSidebar from '@/Components/AdminSidebar.vue';
import SmallCard from '@/Components/SmallCard.vue';
import VueTable from '@/Components/VueTable.vue';
import { Head } from '@inertiajs/vue3';

import { CubeIcon, ArchiveBoxArrowDownIcon, ArchiveBoxXMarkIcon } from '@heroicons/vue/24/solid';

export default {
  components: {
    AppLayout,
    AdminSidebar,
    SmallCard,
    VueTable,
    Head,
    CubeIcon,
    ArchiveBoxArrowDownIcon, ArchiveBoxXMarkIcon
  },
  props: {
    meta: {
      type: Object,
      default: () => {}
    },
    products: {
      type: Array,
      default: () => []
    }
  }
}
</script>