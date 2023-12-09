<template>
  <div class="hs-accordion-group w-full">
    <div class="hs-accordion active border border-gray-50/10 -mt-px first:rounded-t-xl last:rounded-b-xl bg-transparent"
      id="filter-category">
      <button
        class="hs-accordion-toggle inline-flex items-center gap-x-3 w-full font-semibold text-start text-white py-4 px-5 hover:text-gray-100 disabled:opacity-50 disabled:pointer-events-none"
        aria-controls="filter-category-content">
        <ChevronUpIcon class="rotate-90 hs-accordion-active:rotate-0 w-4 h-4" />
        Categories
      </button>
      <div id="filter-category-content"
        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
        aria-labelledby="filter-category">
        <div class="flex flex-col gap-2 pb-4 px-5 max-h-48 overflow-y-auto">
          <div v-for="(category, index) in data.categories" :key="category" class="flex">
            <input type="checkbox"
              class="shrink-0 mt-0.5 border-gold-200 rounded text-gold-600 focus:ring-gold-500 disabled:opacity-50 disabled:pointer-events-none"
              :id="category.name" :name="category.name" @change="toggleC(category, index)">
            <label for="hs-default-checkbox" class="text-sm text-gray-200 ms-3">{{ category.name }}</label>
          </div>
        </div>
      </div>
    </div>

    <div class="hs-accordion active border border-gray-50/10 -mt-px first:rounded-t-sm last:rounded-b-lg bg-transparent"
      id="filter-brand">
      <button
        class="hs-accordion-toggle inline-flex items-center gap-x-3 w-full font-semibold text-start text-white py-4 px-5 hover:text-gray-100 disabled:opacity-50 disabled:pointer-events-none"
        aria-controls="filter-brand-content">
        <ChevronUpIcon class="rotate-90 hs-accordion-active:rotate-0 w-4 h-4" />
        Brands
      </button>
      <div id="filter-brand-content" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
        aria-labelledby="filter-brand">
        <div class="flex flex-col gap-2 pb-4 px-5 max-h-48 overflow-y-auto">
          <div v-for="(brand, index) in data.brands" :key="brand" class="flex">
            <input type="checkbox"
              class="shrink-0 mt-0.5 border-gold-200 rounded text-gold-600 focus:ring-gold-500 disabled:opacity-50 disabled:pointer-events-none"
              :id="brand.name" :name="brand.name" @change="toggleB(brand, index)">
            <label for="hs-default-checkbox" class="text-sm text-gray-200 ms-3">{{ brand.name }}</label>
          </div>
        </div>
      </div>
    </div>

    <div class="hs-accordion active border border-gray-50/10 -mt-px first:rounded-t-sm last:rounded-b-lg bg-transparent"
      id="filter-price">
      <button
        class="hs-accordion-toggle inline-flex items-center gap-x-3 w-full font-semibold text-start text-white py-4 px-5 hover:text-gray-100 disabled:opacity-50 disabled:pointer-events-none"
        aria-controls="filter-price-content">
        <ChevronUpIcon class="rotate-90 hs-accordion-active:rotate-0 w-4 h-4" />
        Price Range
      </button>
      <div id="filter-price-content" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
        aria-labelledby="filter-price">
        <div class="pb-4 px-5">
          <div>
            <label for="min-price" class="block text-sm font-medium mb-2 text-gray-200">Min Price</label>
            <div class="relative">
              <input type="text" id="min-price" name="inline-add-on" v-model="filter.min_price.value"
                class="py-3 px-4 ps-9 pe-20 block w-full text-white border-gray-100/20 shadow-sm rounded-sm text-sm focus:z-10 bg-transparent focus:border-gray-100/20 focus:ring-gray-100/20 disabled:opacity-50 disabled:pointer-events-none"
                placeholder="0.00">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <span class="text-gray-500">Ƀ</span>
              </div>
              <div class="absolute inset-y-0 end-0 flex items-center text-gray-500 pe-px">
                <label for="hs-inline-leading-select-currency" class="sr-only">Currency</label>
                <select id="hs-inline-leading-select-currency" name="hs-inline-leading-select-currency" v-model="filter.min_price.currency"
                  class="block w-full border-transparent rounded-sm bg-transparent focus:ring-gray-100/20 focus:border-gray-100/20">
                  <option v-for="currency in $page.props.rates" :key="currency" :value="currency.text">{{ currency.text }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <label for="min-price" class="block text-sm font-medium mb-2 text-gray-200">Max Price</label>
            <div class="relative">
              <input type="text" id="min-price" name="minPrice" v-model="filter.max_price.value"
                class="py-3 px-4 ps-9 pe-20 block w-full text-white border-gray-100/20 shadow-sm rounded-sm text-sm focus:z-10 bg-transparent focus:border-gray-100/20 focus:ring-gray-100/20 disabled:opacity-50 disabled:pointer-events-none"
                placeholder="0.00">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <span class="text-gray-500">Ƀ</span>
              </div>
              <div class="absolute inset-y-0 end-0 flex items-center text-gray-500 pe-px">
                <label for="hs-inline-leading-select-currency" class="sr-only">Currency</label>
                <select id="hs-inline-leading-select-currency" name="maxPrice" v-model="filter.max_price.currency"
                  class="block w-full border-transparent rounded-sm bg-transparent focus:ring-gray-100/20 focus:border-gray-100/20">
                  <option v-for="currency in $page.props.rates" :key="currency" :value="currency.text">{{ currency.text }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="mt-4 flex justify-center">
            <button @click="applyFilter" class="bg-gold-600 hover:bg-gold-700 focus:bg-gold-700 px-4 py-2 rounded-md w-full">Apply</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ChevronUpIcon } from '@heroicons/vue/24/solid';
import { useForm, router } from '@inertiajs/vue3';


export default {
  components: {
    ChevronUpIcon,
  },
  props: {
    data: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      filter: useForm({
        categories: [],
        brands: [],
        min_price: {
          currency: 'BTC',
          value: null,
        },
        max_price: {
          currency: 'BTC',
          value: null,
        }
      })
    }
  },
  methods: {
    toggleC(category, index) {
      if (this.filter.categories.includes(category.id)) {
        this.filter.categories.splice(index, 1);
      } else {
        this.filter.categories.push(category.id);
      }
    },
    toggleB(brand, index) {
      if (this.filter.brands.includes(brand.id)) {
        this.filter.brands.splice(index, 1);
      } else {
        this.filter.brands.push(brand.id);
      }
    },
    applyFilter() {
      const request = {
        categories: this.filter.categories,
        brands: this.filter.brands,
        min_price: {
          currency: this.filter.min_price.currency,
          value: this.filter.min_price.value,
        },
        max_price: {
          currency: this.filter.max_price.currency,
          value: this.filter.max_price.value,
        }
      };
      this.filter.reset();
      router.post(route('landing.products.filter'), request);
    }
  }
}
</script>