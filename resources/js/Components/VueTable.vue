<template>
  <DataTable v-model:filters="filters" :value="products" showGridlines scrollable scrollHeight="800px" paginator :rows="10"
    :rowsPerPageOptions="[10, 20, 50]" tableStyle="min-width: 50rem;width: 100%;"
    :globalFilterFields="['name', 'price', 'stock', 'stock_status', 'created_at']" class="rounded-lg w-full">
    <template #header>
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 py-6 px-4">
        <div>
          <span class="text-lg font-semibold">Products</span>
        </div>
        <div class="flex justify-end items-center gap-4">
          <Link :href="route('admin.product.add')" class="px-4 lg:px-6 py-2 bg-gold-600 hover:bg-gold-700 focus:bg-gold-700 text-gray-300 rounded-md">
            <PlusIcon class="w-4 h-4 text-white font-bold" />
          </Link>
          <span class="p-input-icon-left">
            <MagnifyingGlassIcon class="w-4 h-4" />
            <InputText v-model="filters['global'].value" placeholder="Search"
              class="ps-10 border-gray-50/20 bg-dark-primary shadow-sm rounded-s-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none" />
          </span>
        </div>
      </div>
    </template>
    <template #empty>No product found.</template>
    <Column field="no" header="No" sortable class="px-8 py-6">
      <template #body="props">
        {{ props.index + 1 }}
      </template>
    </Column>
    <Column field="name" header="Name" sortable class="px-8 py-6">
      <template #body="props">
        <Link v-if="props.data.link" class="text-gray-300 text-sm font-medium rounded-full underline truncate"
          :href="route('landing.product.detail', {slug: props.data.slug})">{{ props.data.name }}</Link>
        <p v-else>{{ props.data.name }}</p>
      </template>
    </Column>
    <Column field="price" header="Price" sortable class="max-w-sm px-8 py-6">
      <template #body="props">
        $ {{ props.data.price }} USD
      </template>
    </Column>
    <Column field="stock" header="Stock" sortable class="px-8 py-6"></Column>
    <Column field="stock_status" header="Stock Status" sortable class="px-8 py-6">
      <template #body="props">
        <p v-if="props.data.stock_status == 'in_stock'" class="bg-teal-600 text-gray-300 text-sm font-medium me-2 px-4 py-0.5 whitespace-nowrap rounded-full text-center">In Stock</p>
        <p v-if="props.data.stock_status == 'out_of_stock'" class="bg-red-600 text-gray-300 text-sm font-medium me-2 px-4 py-0.5 whitespace-nowrap rounded-full text-center">Out of Stock</p>
      </template>
    </Column>
    <Column field="created_at" header="Created At" sortable></Column>
    <Column field="action" header="Action" class="px-8 py-6 flex justify-center items-center gap-2">
      <template #body="props">
          <a v-if="props.data.link" :href="props.data.link" target="_blank"
            class="flex justify-center p-2 bg-green-600 rounded-lg hover:bg-green-700 focus:bg-green-700">
            <LinkIcon class="w-5 h-5 text-white font-bold" />
          </a>
          <Link :href="route('admin.product.edit', {id: props.data.id})"
            class="flex justify-center p-2 bg-blue-600 rounded-lg hover:bg-blue-700 focus:bg-blue-700">
            <PencilIcon class="w-5 h-5 text-white font-bold" />
          </Link>
          <ConfirmDialog></ConfirmDialog>
          <button @click="handleDelete(props.data)"
            class="flex justify-center p-2 bg-red-600 rounded-lg hover:bg-red-700 focus:bg-red-700">
            <TrashIcon class="w-5 h-5 text-white font-bold" />
          </button>
      </template>
    </Column>
  </DataTable>
</template>

<script>
import "primevue/resources/themes/mdc-dark-deeppurple/theme.css";
import { FilterMatchMode } from 'primevue/api';

import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from "primevue/useconfirm";

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';

import { MagnifyingGlassIcon, TrashIcon, LinkIcon, PencilIcon, PlusIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';

export default {
  components: {
    DataTable, Column, InputText, ConfirmDialog, Link,
    MagnifyingGlassIcon, TrashIcon, LinkIcon, PencilIcon, PlusIcon
  },
  props: {
    products: {
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
    handleDelete(product) {
      this.confirm.require({
          message: 'Are you sure you want to proceed?',
          header: 'Confirmation',
          accept: () => {
              this.deleteProduct(product.id);
          },
          reject: () => {
            this.confirm.close();
          },
          onHide: () => {
            this.confirm.close();
          }
      }); 
    },
    deleteProduct(id) {
      this.confirm.close();
      return this.$inertia.delete(route('admin.product.delete', {id}));
    }
  },
}
</script>