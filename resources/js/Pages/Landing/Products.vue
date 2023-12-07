<template>
  <AppLayout>

    <Head>
      <title>Browse</title>
    </Head>

    <section>
      <div class="w-full hidden sm:flex justify-center items-center h-96 bg-gray-200 rounded-sm mb-12">
        Banner
      </div>

      <div class="flex flex-col 2xl:flex-row gap-4 mx-auto">
        <div class="w-full hidden 2xl:block">
          <FilterProduct :data="{ brands, categories }" />
        </div>
        <div class="w-2/3 block 2xl:hidden">
          <OffCanvasFilter :data="{ brands, categories }" />
        </div>
        <div>
          <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 xl:px-0 w-fit mx-auto">
            <CardProduct v-for="product in products" :key="product" :product="product" />
          </div>
          <InfiniteLoading @infinite="handleLoadMore">
            <template #spinner>
              <div class="flex justify-center mx-auto mt-4">
                <div
                  class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-gold-600 rounded-full"
                  role="status" aria-label="loading">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </template>
            <template #complete>
              <div class="flex justify-center mx-auto mt-8">
                <span class="font-semibold text-white">No more data!</span>
              </div>
            </template>
          </InfiniteLoading>
        </div>
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
import { Head } from '@inertiajs/vue3';

import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";

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
    InfiniteLoading,
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
      page: 0,
    }
  },
  methods: {
    async handleLoadMore($state) {
      try {
        const response = await fetch(
          `https://dummyjson.com/products?limit=10&skip=${this.page}&select=id,title,price,thumbnail,description`
        );
        const json = await response.json();
        if (json.products.length < 10) $state.complete();
        else {
          this.products.push(...json.products);
          $state.loaded();
        }
        this.page += 10;
      } catch (error) {
        $state.error();
      }
    },
  },
}
</script>
