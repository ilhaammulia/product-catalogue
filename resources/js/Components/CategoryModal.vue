<template>
  <button data-modal-target="category-modal" data-modal-toggle="category-modal" @click="toggleModal" type="button">
    <slot></slot>
  </button>

  <div id="category-modal" aria-hidden="true" ref="categoryModal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-dark-primary rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-50/10">
          <h3 class="text-md font-semibold text-gray-300">
            Create Category
          </h3>
          <button type="button" @click="toggleModal" ref="closeBtn"
            class="text-gray-300 bg-transparent hover:bg-gold-600 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="category-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>

        <form class="p-4 md:p-5" @submit.prevent="handleSubmit">
          <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Name</label>
              <input type="text" name="name" id="name" v-model="form.name"
                class="py-2 px-4 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                placeholder="Category name" required="">
            </div>
          </div>
          <button type="submit"
            class="text-white inline-flex items-center bg-gold-600 hover:bg-gold-700 focus:ring-4 focus:outline-none focus:ring-gold-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ChevronRightIcon } from "@heroicons/vue/24/solid";
import { useForm } from '@inertiajs/vue3';
import { Modal } from 'flowbite';

export default {
  components: {
    ChevronRightIcon,
  },
  data() {
    return {
      form: useForm({
        name: null
      }),
      modal: null
    }
  },
  mounted() {
    this.modal = new Modal(this.$refs.categoryModal);
  },
  methods: {
    toggleModal() {
      this.modal.toggle();
    },
    handleSubmit() {
      this.$refs.closeBtn.click();
      this.form.post(route('admin.product.category.add'), {
        preserveState: true,
      });
      this.form.reset();
    }
  },
}
</script>