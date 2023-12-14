<template>
  <DataTable v-model:filters="filters" :value="users" dataKey="id" showGridlines scrollable scrollHeight="800px" paginator :rows="10"
    :rowsPerPageOptions="[10, 20, 50]" tableStyle="min-width: 50rem;width: 100%;"
    :globalFilterFields="['name', 'price', 'stock', 'stock_status', 'created_at']" class="rounded-lg w-full">
    <template #header>
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 py-6 px-4">
        <div>
          <span class="text-lg font-semibold">Users</span>
        </div>
        <div class="flex justify-end items-center gap-4">
          <UserModal class="px-4 lg:px-6 py-2 bg-gold-600 hover:bg-gold-700 focus:bg-gold-700 text-gray-300 rounded-md">
            <PlusIcon class="w-4 h-4 text-white font-bold" />
          </UserModal>
          <span class="p-input-icon-left">
            <MagnifyingGlassIcon class="w-4 h-4" />
            <InputText v-model="filters['global'].value" placeholder="Search"
              class="ps-10 border-gray-50/20 bg-dark-primary shadow-sm rounded-s-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none" />
          </span>
        </div>
      </div>
    </template>
    <template #empty>No user found.</template>
    <Column field="no" header="No" sortable class="px-8 py-6">
      <template #body="props">
        {{ props.index + 1 }}
      </template>
    </Column>
    <Column field="name" header="Name" sortable class="px-8 py-6"></Column>
    <Column field="email" header="Email Address" sortable class="px-7 py-6"></Column>
    <Column field="created_at" header="Created At" sortable></Column>
    <Column field="action" header="Action" class="px-8 py-6 flex justify-center items-center gap-2">
      <template #body="props">
          <UserModal :user="{ ...props.data }"
            class="flex justify-center p-2 bg-blue-600 rounded-lg hover:bg-blue-700 focus:bg-blue-700">
            <PencilIcon class="w-5 h-5 text-white font-bold" />
          </UserModal>
          <ConfirmDialog></ConfirmDialog>
          <button @click="handleDelete(props.data)" v-if="$page.props.auth.user.id != props.data.id"
            class="flex justify-center p-2 bg-red-600 rounded-lg hover:bg-red-700 focus:bg-red-700">
            <TrashIcon class="w-5 h-5 text-white font-bold" />
          </button>
      </template>
    </Column>
  </DataTable>
</template>

<script>
import { FilterMatchMode } from 'primevue/api';

import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from "primevue/useconfirm";

import UserModal from '@/Components/UserModal.vue';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import "primevue/resources/themes/mdc-dark-deeppurple/theme.css";

import { MagnifyingGlassIcon, TrashIcon, LinkIcon, PencilIcon, PlusIcon } from '@heroicons/vue/24/outline';

export default {
  components: {
    DataTable, Column, InputText, ConfirmDialog, UserModal,
    MagnifyingGlassIcon, TrashIcon, LinkIcon, PencilIcon, PlusIcon
  },
  props: {
    users: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      filters: {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      },
      confirm: useConfirm()
    }
  },
  methods: {
    handleDelete(user) {
      this.confirm.require({
          message: 'Are you sure you want to proceed?',
          header: 'Confirmation',
          accept: () => {
              this.deleteUser(user.id);
          },
          reject: () => {
            this.confirm.close();
          },
          onHide: () => {
            this.confirm.close();
          }
      }); 
    },
    deleteUser(id) {
      this.confirm.close();
      return this.$inertia.delete(route('admin.user.delete', {id}));
    }
  },
}
</script>

<style scoped>
</style>