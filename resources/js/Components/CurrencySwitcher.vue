<template>
  <button data-modal-target="currency-modal" data-modal-toggle="currency-modal"
    class="flex justify-center items-center gap-2 py-2 px-6 rounded-md text-gray-100 font-semibold bg-gold-600 hover:bg-gold-700"
    type="button" @click="toggleModal">
    <v-icon :name="`ci-color-${$store.state.currency.text.toLowerCase()}`" />
    <p>{{ $store.state.currency.text }}</p>
  </button>

  <div id="currency-modal" ref="currencyModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-dark-primary rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-300">
            Select Currency
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gold-600 hover:text-gray-400 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-hide="currency-modal" ref="closeBtn" @click="toggleModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5 space-y-4">
          <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
            <div v-for="currency in $page.props.rates" :key="currency" @click="changeCurrency(currency)"
              class="flex justify-center items-center gap-2 py-2 px-2 md:px-6 rounded-lg cursor-pointer hover:bg-gold-700">
              <div class="flex justify-between items-center w-full gap-4">
                <v-icon :name="`ci-color-${currency.text.toLowerCase()}`" />
                <span class="text-white font-semibold">{{ currency.text }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ChevronRightIcon } from "@heroicons/vue/24/solid";
import { Modal } from 'flowbite';

export default {
  components: {
    ChevronRightIcon,
  },
  data() {
    return {
      modal: null
    }
  },
  mounted() {
    this.modal = new Modal(this.$refs.currencyModal);
  },
  methods: {
    changeCurrency(currency) {
      this.$refs.closeBtn.click();
      this.$store.commit('setCurrency', currency);
      localStorage.setItem('currency', JSON.stringify(currency));

    },
    toggleModal() {
      this.modal.toggle();
    }
  },
}
</script>