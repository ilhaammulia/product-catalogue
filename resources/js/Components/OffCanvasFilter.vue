<template>
  <!-- drawer init and toggle -->
  <button
    class="text-white inline-flex items-center gap-x-2 bg-transparent border border-gray-700 hover:bg-white/10 focus:outline-none focus:ring-1 focus:ring-gray-600 font-medium rounded-lg text-sm px-5 py-2.5"
    type="button" data-drawer-target="offcanvas-filter" data-drawer-show="offcanvas-filter"
    data-drawer-body-scrolling="true" aria-controls="offcanvas-filter">
    <AdjustmentsHorizontalIcon class="w-4 h-4 text-gray-300" />
    <span class="text-gray-300 font-semibold">Filter</span>
  </button>

  <div id="offcanvas-filter"
    class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-dark-secondary w-64 dark:bg-gray-800"
    tabindex="-1" aria-labelledby="offcanvas-filter-label">
    <h5 id="offcanvas-filter-label" class="text-base font-semibold text-gray-300 uppercase">Filter</h5>
    <button type="button" data-drawer-hide="offcanvas-filter" aria-controls="offcanvas-filter"
      class="text-gray-400 bg-transparent hover:bg-gold-600 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
      <span class="sr-only">Close menu</span>
    </button>
    <div class="py-4 overflow-y-auto">
      <FilterProduct :data="data" />
    </div>
  </div>
</template>

<script>
import { AdjustmentsHorizontalIcon } from "@heroicons/vue/24/solid";
import FilterProduct from "./FilterProduct.vue";

export default {
  components: {
    AdjustmentsHorizontalIcon,
    FilterProduct,
  },
  props: {
    data: {
      type: Object,
      default: () => {}
    }
  }
}
</script>