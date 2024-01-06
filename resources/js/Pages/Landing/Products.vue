<template>
  <AppLayout>

    <Head>
      <title>Browse</title>
    </Head>

    <section>
      <div class="flex flex-col 2xl:flex-row gap-4 mx-auto">
        <div class="w-[40rem]">
          <div class="w-full hidden 2xl:block">
            <FilterProduct :data="{ brands, categories }" />
          </div>
          <div class="w-full block 2xl:hidden">
            <OffCanvasFilter :data="{ brands, categories }" />
          </div>
        </div>
        <DataView :value="products" paginator :rows="20" class="mx-auto" :class="{'mt-auto': !products.length}">
          <template #list="props">
            <div class="bg-dark-primary grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 xl:px-0 w-fit mx-auto">
              <CardProduct v-if="props.items.length" v-for="product in props.items" :key="product" :product="product" />
            </div>
          </template>
        </DataView>
      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SelectTag from '@/Components/SelectTag.vue';
import CardProduct from '@/Components/CardProduct.vue';
import FilterProduct from '@/Components/FilterProduct.vue';
import OffCanvasFilter from '@/Components/OffCanvasFilter.vue';
import { MinusIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
import { Head, useForm } from '@inertiajs/vue3';

import DataView from 'primevue/dataview';

export default {
  components: {
    AppLayout,
    Head,
    CardProduct,
    FilterProduct,
    OffCanvasFilter,
    SelectTag,
    MinusIcon,
    MagnifyingGlassIcon,
    DataView,
  },
  props: {
    categories: {
      type: Array,
      default: () => []
    },
    brands: {
      type: Array,
      default: () => []
    },
    products: {
      type: Array,
      default: () => []
    },
  },
  data() {
    return {
      filter: useForm({
        categories: "",
        brands: "",
        min_price: {
          currency: null,
          value: null,
        },
        max_price: {
          currency: null,
          value: null
        },
      }),
      page: 1,
      skip: 0,
    }
  },
}
</script>

<style>
.p-paginator {
  background-color: #222222;
  color: white;
}

.p-dataview-emptymessage {
  background-color: #222222;
  color: white;
  text-align: center;
}
</style>
