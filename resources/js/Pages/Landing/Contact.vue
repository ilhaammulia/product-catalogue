<template>
  <AppLayout>
    <Head title="Contact Us" />
    <section class="bg-dark-primary">
    <div class="container px-6 py-12 mx-auto">
      <div class="text-center">
        <p class="font-medium text-gray-300">Contact us</p>
        <h1 class="mt-2 text-2xl font-semibold text-gray-300 md:text-3xl">Chat to our friendly team</h1>
        <p class="mt-3 text-gray-500">We’d love to hear from you. Please fill out this form or shoot usan email.</p>
      </div>
      <div class="w-full max-w-4xl mt-4 lg:mt-6 mx-auto">
        <div class="p-4 py-6 rounded-lg bg-dark-secondary md:p-8 w-full">
          <ContactForm />
        </div>
      </div>
    </div>
  </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContactForm from '@/Components/ContactForm.vue';
import { Head } from '@inertiajs/vue3';
export default {
  components: {
    AppLayout,
    Head,
    ContactForm,
  }
}
</script>
