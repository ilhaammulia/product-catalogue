<template>
  <AppLayout>

    <Head>
      <title>Home</title>
    </Head>
    <section>
      <section class="bg-dark-primary">
        <div class="grid py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
          <div class="mr-auto place-self-center lg:col-span-7">
            <h1
              class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
              Embrace Exquisite Living, in Every Exquisite Detail.</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Explore
              timeless elegance curated for connoisseurs-a collection embodying luxury, rarity, and sophistication.
              Discover our exclusive sanctuary for refined tastes and unparalleled splendor.</p>
            <Link :href="route('landing.products')"
              class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-gold-600 hover:bg-gold-700 focus:ring-4 focus:ring-gold-800">
              Browse
              <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </Link>
            <Link :href="route('landing.contact')"
              class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-300 border border-gold-600 rounded-lg hover:bg-gold-600 focus:ring-4 focus:ring-gold-800">
              Contact Us
            </Link>
          </div>
          <div class="hidden lg:mt-0 lg:col-span-5 lg:flex h-full w-full">
            <img src="/assets/img/banner/hero.webp" alt="mockup"
              style="clip-path: polygon(25% 0, 100% 0%, 100% 100%, 0 100%)">
          </div>
        </div>
      </section>

      <section>
        <div class="mb-3 font-bold text-2xl">
          <span class="text-900">Explore Our Exclusive Categories</span>
        </div>
        <div class="text-700 text-sm mb-6">Dive into curated categories for luxury aficionados seeking sophistication.</div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          <div v-for="cat in categories" :key="cat" class=" cursor-pointer text-gray-400 transition duration-100 hover:text-gold-400">
            <Link :href="route('landing.products')" class="group relative block h-96 overflow-hidden">
              <img
                :src="cat.img"
                loading="lazy" alt=""
                class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
            </Link>

            <div class="py-4 px-2">
              <p class="lg:text-lg font-bold">{{ cat.title }}</p>
              <p class="text-sm">{{ cat.desc }}</p>
            </div>
          </div>
        </div>
      </section>

      <section>
        <div class="mt-12 font-bold text-2xl">
          <span class="text-900">Popular Collections</span>
        </div>
        <div class="text-700 text-sm mb-6">Select from Diverse Brand Variants: Explore Premium Product Range.</div>
        <div class="bg-dark-primary grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 xl:px-0 mx-auto">
          <CardProduct v-if="products" v-for="product in products" :key="product" :product="product" />
        </div>
      </section>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from 'primevue/button';
import { Head, Link } from '@inertiajs/vue3';
import { ChevronRightIcon } from '@heroicons/vue/24/solid';
import CardProduct from '@/Components/CardProduct.vue';

export default {
  components: {
    AppLayout, CardProduct, Link,
    Head, Button, ChevronRightIcon
  },
  data() {
    return {
      categories: [
        { title: 'Cars', desc: 'Unveil Automotive Elegance: Luxury Driven to Perfection.', img: '/assets/img/categories/cars.jpg' },
        { title: 'Jet', desc: 'Experience Elite Aviation: Unparalleled Luxury in Flight.', img: '/assets/img/categories/jet.jpg' },
        { title: 'Watch', desc: 'Elevate Timekeeping: Impeccable Craftsmanship Unveiled.', img: '/assets/img/categories/watch.webp' },
        { title: 'Accessories', desc: 'Adornments of Elegance: Exquisite Accents, Timeless Grace.', img: '/assets/img/categories/necklace.jpg' },
      ]
    }
  },
  props: {
    products: {
      type: Array,
      default: () => []
    }
  }
}
</script>
