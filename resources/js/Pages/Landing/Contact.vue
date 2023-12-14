<template>
  <AppLayout>
    <Head title="Contact Us" />
    <section class="bg-dark-primary">
    <div class="container px-6 py-12 mx-auto">
      <div>
        <p class="font-medium text-gray-300">Contact us</p>
        <h1 class="mt-2 text-2xl font-semibold text-gray-300 md:text-3xl">Chat to our friendly team</h1>
        <p class="mt-3 text-gray-500">We’d love to hear from you. Please fill out this form or shoot usan email.</p>
      </div>

      <div class="grid grid-cols-1 gap-12 mt-10 lg:grid-cols-2">
        <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
          <div>
            <span class="inline-block p-3 text-gold-100 rounded-full bg-gold-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
              </svg>
            </span>

            <h2 class="mt-4 text-base font-medium text-gray-300">Email</h2>
            <p class="mt-2 text-sm text-gray-500">Our friendly team is here to help.</p>
            <p class="mt-2 text-sm text-gold-500">support@coinluxe.io</p>
          </div>

          <div>
            <span class="inline-block p-3 text-gold-100 rounded-full bg-gold-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
              </svg>
            </span>

            <h2 class="mt-4 text-base font-medium text-gray-300">Live chat</h2>
            <p class="mt-2 text-sm text-gray-500">Our friendly team is here to help.</p>
            <p class="mt-2 text-sm text-gold-500">Send message here</p>
          </div>

          <div>
            <span class="inline-block p-3 text-gold-100 rounded-full bg-gold-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
              </svg>
            </span>

            <h2 class="mt-4 text-base font-medium text-gray-300">Office</h2>
            <p class="mt-2 text-sm text-gray-500">Come say hello at our office HQ.</p>
            <p class="mt-2 text-sm text-gold-500">201 N Los Angeles St, Los Angeles, CA 90012-3303, United States</p>
          </div>

          <div>
            <span class="inline-block p-3 text-gold-100 rounded-full bg-gold-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
              </svg>
            </span>

            <h2 class="mt-4 text-base font-medium text-gray-300">Phone</h2>
            <p class="mt-2 text-sm text-gray-500">Mon-Fri from 8am to 5pm.</p>
            <p class="mt-2 text-sm text-gold-500">(909) 206-2463</p>
          </div>
        </div>

        <div class="p-4 py-6 rounded-lg bg-dark-secondary md:p-8">
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
