<template>
  <AppLayout>

    <Head title="Dashboard" />

    <section class="mt-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
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
        <SmallCard title="Total Tickets">
          <template #icon>
            <EnvelopeIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ meta.total_tickets }}</span>
          </template>
        </SmallCard>
        <SmallCard title="Total Users">
          <template #icon>
            <UsersIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ meta.total_users }}</span>
          </template>
        </SmallCard>
      </div>

      <div class="mt-8">
        <DataTable :value="notifications" showGridlines scrollable scrollHeight="800px" paginator :rows="10"
        :rowsPerPageOptions="[10, 20, 50]" tableStyle="min-width: 50rem;" class="rounded-lg">
          <template #header>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 px-4 py-6">
              <div>
                <span class="text-lg font-semibold">Today Notification</span>
              </div>
            </div>
          </template>
          <template #empty>Notification empty.</template>
          <Column field="name" header="Name" sortable class="px-8 py-6"></Column>
          <Column field="message" header="Message" class="max-w-sm px-8 py-6"></Column>
          <Column field="created_at" header="Created At" sortable></Column>
        </DataTable>
      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdminSidebar from '@/Components/AdminSidebar.vue';
import SmallCard from '@/Components/SmallCard.vue';
import { Head } from '@inertiajs/vue3';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import "primevue/resources/themes/mdc-dark-deeppurple/theme.css";

import { CubeIcon, ArchiveBoxArrowDownIcon, EnvelopeIcon, UsersIcon } from '@heroicons/vue/24/solid';

export default {
  components: {
    AppLayout,
    AdminSidebar,
    SmallCard, DataTable, Column,
    Head, CubeIcon, ArchiveBoxArrowDownIcon,
    EnvelopeIcon, UsersIcon
  },
  props: {
    meta: {
      type: Object,
      default: () => { }
    },
    notifications: {
      type: Array,
      default: () => [],
    }
  }
}
</script>