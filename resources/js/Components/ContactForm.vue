<template>
  <form @submit.prevent="submit">
    <input type="hidden" v-model="form.related_id" />
    <div class="-mx-2 md:items-center md:flex">
      <div class="flex-1 px-2">
        <label class="block mb-2 text-sm text-gray-300">Full Name</label>
        <input type="text" placeholder="John Doe" v-model="form.name"
          class="block w-full px-5 py-3 mt-2 text-gray-300 bg-transparent border border-gold-600 rounded-md focus:border-gold-700 focus:ring-gold-700 focus:outline-none focus:ring focus:ring-opacity-40" :class="{'border-red-500': errors?.name && !form.name}" />
        <small v-if="errors?.name && !form.name" class="text-red-500">{{ errors?.name[0] }}</small>
      </div>

      <div class="flex-1 px-2 mt-4 md:mt-0">
        <label class="block mb-2 text-sm text-gray-300">Email address</label>
        <input type="email" placeholder="johndoe@example.com" v-model="form.email"
          class="block w-full px-5 py-3 mt-2 text-gray-300 bg-transparent border border-gold-600 rounded-md focus:border-gold-700 focus:ring-gold-700 focus:outline-none focus:ring focus:ring-opacity-40" :class="{'border-red-500': errors?.email && !form.email}" />
        <small v-if="errors?.email && !form.email" class="text-red-500">{{ errors?.email[0] }}</small>
      </div>
    </div>

    <div class="w-full mt-4">
      <label class="block mb-2 text-sm text-gray-300">Message</label>
      <textarea v-model="form.message"
        class="block w-full h-32 px-5 py-3 mt-2 text-gray-300 bg-transparent border border-gold-600 rounded-md md:h-56 focus:border-gold-700 focus:ring-gold-700 focus:outline-none focus:ring focus:ring-opacity-40" :class="{'border-red-500': errors?.message && !form.message}"
        placeholder="Message"></textarea>
      <small v-if="errors?.message && !form.message" class="text-red-500">{{ errors?.message[0] }}</small>
    </div>

    <button
      class="w-full px-6 py-3 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gold-600 rounded-md hover:bg-gold-700 focus:outline-none focus:ring focus:ring-gold-600 focus:ring-opacity-50">
    Submit
  </button>
</form>
</template>

<script>
import { Notify } from 'notiflix/build/notiflix-notify-aio';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';

export default {
  props: {
    product: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      form: useForm({
        name: null,
        email: null,
        message: null,
        related_id:  null,
      }),
      errors: {},
    }
  },
  methods: {
    submit() {
      const request = {
        name: this.form.name,
        email: this.form.email,
        message: this.form.message,
      };
      if (this.product) {
        request.related_id = this.product.id
      }

      

      axios.post(route('ticket.store'), request).then((response) => {
        if (response.data.status == 'success') {
          this.$emit('submitted');
          Notify.success('Your request has been submitted.');
          this.form.reset();
          this.errors = {}
        } else {
          Notify.failure('Error occured. Try again later.');
        }
      }).catch((response) => {
        Notify.failure('Error occured. Try again.');
        this.errors = response.response.data.errors
      });
    }
  },
}

</script>