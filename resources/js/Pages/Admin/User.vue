<template>
  <AppLayout>
    <Head title="Product" />

    <section class="mt-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
        <SmallCard title="Total Users">
          <template #icon>
            <UsersIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ meta.total_users }}</span>
          </template>
        </SmallCard>
      </div>

      <div>
        <UserTable :users="users" class="mt-6 w-full" />
      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdminSidebar from '@/Components/AdminSidebar.vue';
import SmallCard from '@/Components/SmallCard.vue';
import UserTable from '@/Components/UserTable.vue';
import { Head } from '@inertiajs/vue3';

import { UsersIcon, ArchiveBoxArrowDownIcon, ArchiveBoxXMarkIcon } from '@heroicons/vue/24/solid';

export default {
  components: {
    AppLayout,
    AdminSidebar,
    SmallCard,
    UserTable,
    Head,
    UsersIcon,
    ArchiveBoxArrowDownIcon, ArchiveBoxXMarkIcon
  },
  props: {
    meta: {
      type: Object,
      default: () => {}
    },
    users: {
      type: Array,
      default: () => []
    }
  }
}
</script>