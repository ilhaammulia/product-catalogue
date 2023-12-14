<template>
  <button @click="toggleModal" class="flex justify-center p-2 bg-blue-600 rounded-lg hover:bg-blue-700 focus:bg-blue-700">
    <slot></slot>
  </button>

  <!-- Main modal -->
  <div ref="modal" id="contact-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-dark-primary rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 rounded-t">
          <h3 class="text-xl font-semibold text-gray-300">
            {{ form.id ? 'Update' : 'Add' }} User
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
          <form class="" @submit.prevent="handleSubmit">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label :for="`name${form.id}`" class="block mb-2 text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" :id="`name${form.id}`" v-model="form.name"
                  class="py-2 px-4 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                  placeholder="Name">
              </div>
              <div class="col-span-2">
                <label :for="`email${form.id}`" class="block mb-2 text-sm font-medium text-gray-300">Email address</label>
                <input type="text" name="email" :id="`email${form.id}`" v-model="form.email"
                  class="py-2 px-4 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                  placeholder="Email address">
              </div>
              <div class="col-span-2">
                <label :for="`password${form.id}`" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" :id="`password${form.id}`" v-model="form.password"
                  class="py-2 px-4 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                  placeholder="Your new password">
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
  </div>
</template>

<script>
import { Modal } from 'flowbite';
import { useForm } from '@inertiajs/vue3';

export default {
  data() {
    return {
      modal: null,
      form: useForm({
        id: this.user?.id ?? null,
        name: this.user?.name ?? null,
        email: this.user?.email ?? null,
        password: null,
      })
    }
  },
  mounted() {
    this.modal = new Modal(this.$refs.modal, { placement: 'center' });
  },
  methods: {
    toggleModal() {
      this.modal.toggle();
    },
    handleSubmit() {
      this.toggleModal();
      if (this.form.id) {
        this.form.post(route('admin.user.update', {id: this.form.id}));
      } else {
        this.form.post(route('admin.user.store'));
      }
      
    }
  },
  props: {
    user: {
      type: Object,
      default: () => { },
    }
  },
}
</script>