<template>
  <AppLayout>

    <Head>
      <title>About Us</title>
    </Head>
    <section>
      <main id="content" role="main" class="max-w-60">
        <div class="md:max-w-screen-sm text-center px-4 sm:px-6 lg:px-8 pt-12 md:pt-24 pb-6 mx-auto">
          <h1 class="text-2xl font-bold md:text-4xl text-gold-600">About Us</h1>
        </div>

        <div class="md:max-w-screen-sm lg:max-w-[992px] px-4 sm:px-6 lg:px-8 pb-12 md:pt-6 sm:pb-20 mx-auto">
          <div class="grid gap-4 md:gap-8">
            <div>
              <p class="mb-5 text-gray-400">Coinluxe is a premier online platform at the intersection of luxury goods and cryptocurrency. Our platform was founded on the belief that discerning consumers should have a seamless, secure, and sophisticated space to access high-end luxury products using digital currency.</p>

              <p class="mb-5 text-gray-400">At Coinluxe, we've curated a handpicked selection of exquisite items, ranging from fine watches and jewelry to rare collectibles, all from globally renowned brands. Our mission is to bridge the gap between traditional luxury retail and the evolving landscape of digital currencies.</p>

              <p class="mb-5 text-gray-400">We take pride in providing a distinctive shopping experience that combines luxury, convenience, and cutting-edge technology. Our commitment to excellence extends beyond the products we offer; it encompasses the assurance of a secure and transparent transactional environment for our valued customers.</p>

              <p class="mb-5 text-gray-400">With a team dedicated to innovation and customer satisfaction, Coinluxe continues to redefine the paradigms of luxury shopping. Whether you're an aficionado of timeless elegance or seeking unique investment opportunities, Coinluxe is your gateway to a world where luxury meets the future of commerce.</p>

              <p class="mb-5 text-gray-400">Welcome to Coinluxe, where sophistication meets blockchain technology, and luxury becomes digital.</p>
            </div>        
          </div>
        </div>
    </main>
  </section>
</AppLayout></template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3'

export default {
  components: {
    AppLayout,
    Head
  },
}
</script>
