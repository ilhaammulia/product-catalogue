<template>
  <AppLayout>

    <Head title="Ticket" />

    <section class="mt-4">
      <div class="max-w-sm mb-8">
        <SmallCard title="Total Tickets">
          <template #icon>
            <EnvelopeIcon class="w-12 h-12 text-gold-500" />
          </template>
          <template #body>
            <span class="text-gray-200 font-bold text-3xl">{{ tickets.length }}</span>
          </template>
        </SmallCard>
      </div>

      <DataTable v-model:filters="filters" :value="tickets" showGridlines scrollable scrollHeight="800px" paginator
        :rows="10" :rowsPerPageOptions="[10, 20, 50]" tableStyle="min-width: 50rem;"
        :globalFilterFields="['name', 'email', 'message', 'created_at']" class="rounded-lg">
        <template #header>
          <div class="flex flex-col sm:flex-row justify-between items-center gap-4 px-4 py-6">
            <div>
              <span class="text-lg font-semibold">Request Tickets</span>
            </div>
            <div class="flex justify-en">
              <span class="p-input-icon-left">
                <MagnifyingGlassIcon class="w-4 h-4" />
                <InputText v-model="filters['global'].value" placeholder="Search"
                  class="ps-10 border-gray-50/20 bg-dark-primary shadow-sm rounded-s-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none" />
              </span>
            </div>
          </div>
        </template>
        <template #empty>No tickets found.</template>
        <Column field="email" header="Email" sortable class="px-8 py-6"></Column>
        <Column field="name" header="Name" sortable class="px-8 py-6"></Column>
        <Column field="message" header="Message" class="max-w-sm px-8 py-6"></Column>
        <Column field="product" header="Product" class="px-8 py-6">
          <template #body="props">
            <a v-if="props.data.product"
              class="bg-gold-600 text-gray-300 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full"
              :href="props.data.product.link">{{ props.data.product.name }}</a>
          </template>
        </Column>
        <Column field="created_at" header="Created At" sortable></Column>
        <Column field="action" header="Action" class="px-8 py-6">
          <template #body="props">
            <button @click="handleDeleteTicket(props.data)" class="flex justify-center p-2 bg-red-600 rounded-lg hover:bg-red-700 focus:bg-red-700">
              <TrashIcon class="w-5 h-5 text-white font-bold" />
            </button>
          </template>
        </Column>
      </DataTable>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SmallCard from '@/Components/SmallCard.vue';
import { Head } from '@inertiajs/vue3';
import { MagnifyingGlassIcon, EnvelopeIcon } from '@heroicons/vue/24/outline';
import { TrashIcon } from '@heroicons/vue/24/solid';
import { Notify } from 'notiflix';

import { FilterMatchMode } from 'primevue/api';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import "primevue/resources/themes/mdc-dark-deeppurple/theme.css";


export default {
  components: {
    AppLayout,
    SmallCard,
    Head, MagnifyingGlassIcon, EnvelopeIcon, TrashIcon,
    DataTable, Column, InputText,
  },
  props: {
    tickets: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      filters: {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      },
    }
  },
  methods: {
    handleDeleteTicket(ticket) {
      this.$inertia.delete(route('admin.ticket.delete', { id: ticket.id }), {
        onSuccess: () => {
          Notify.success('The ticket has been deleted.');
        },
        onError: () => {
          Notify.failure('Error occured. Try again.');
        }
      });
    }
  }
}
</script>