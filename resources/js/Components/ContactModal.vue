<template>
  <button
    @click="toggleModal"
    class="flex items-center justify-center w-full p-4 text-white font-semibold rounded-md border border-gold-600 hover:bg-gold-600 hover:text-gray-100">
    <slot></slot>
  </button>

  <!-- Main modal -->
  <div ref="modal" id="contact-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-dark-primary rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 rounded-t">
          <h3 class="text-xl font-semibold text-gray-300">
            Form Request
          </h3>
          <button type="button"
            class="text-gray-300 bg-transparent hover:bg-gold-600 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            @click="toggleModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          <ContactForm @submitted="toggleModal" :product="product" />
      </div>
    </div>
  </div>
</div></template>

<script>
import ContactForm from './ContactForm.vue';
import { Modal } from 'flowbite';

export default {
  components: {
    ContactForm,
  },
  data() {
    return {
      modal: null,
    }
  },
  mounted() {
    this.modal = new Modal(this.$refs.modal, { placement: 'center' });
  },
  methods: {
    toggleModal() {
      this.modal.toggle();
    },
  },
  props: {
    product: {
      type: Object,
      default: () => {},
    }
  },
}
</script>