<template>
  <AppLayout>

    <Head>
      <title>{{ product.name }}</title>
    </Head>

    <section class="overflow-hidden bg-dark-primary py-8">
      <div class="max-w-7xl px-4 py-4 mx-auto lg:py-8 md:px-6">
        <div class="flex flex-wrap -mx-4">
          <div class="w-full px-4 md:w-1/2 ">
            <div class="sticky top-0 overflow-hidden">
              <ProductCarousel :attachments="product.attachments" :options="carouselOptions" />
            </div>
          </div>
          <div class="w-full px-4 md:w-1/2 ">
            <div class="lg:pl-20">
              <div class="mb-8 ">
                <span v-if="product.brand" class="text-lg font-semibold text-gold-600 uppercase">{{ product.brand.name }}</span>
                <h2 class="max-w-xl mt-2 mb-6 text-2xl font-bold md:text-4xl text-gray-300">{{ product.name }}</h2>
                <p v-if="product.description.length > 200" class="max-w-md mb-8 text-gray-300 font-medium text-justify">
                  {{ showAll ? product.description : product.description.slice(0, 200) + '...' }}
                  <span @click="showAll = !showAll" class="underline cursor-pointer">{{ showAll ? 'Show Less' : 'Show More' }}</span>
                </p>
                <p v-else class="max-w-md mb-8 text-gray-300 font-medium text-justify">
                  {{ product.description }}
                </p>
                <p class="inline-block mb-8 text-lg font-semibold text-gold-500 ">
                  <span>Ƀ {{ (product.price * $store.state.currency.value).toFixed(4) }} {{ $store.state.currency.text
                  }}</span>
                </p>
              </div>
              <div class="flex flex-wrap items-center -mx-4 ">
                <div class="w-full px-4 mb-4 lg:w-1/2 lg:mb-0">
                  <a :href="product.link" target="_blank"
                    class="flex items-center justify-center w-full p-4 text-white font-semibold rounded-md bg-gold-600 hover:bg-gold-700 hover:text-gray-100">
                    Buy Product
                  </a>
                </div>
                <div class="w-full px-4 mb-4 lg:mb-0 lg:w-1/2">
                  <ContactModal :product="product">
                    Make Request
                  </ContactModal>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-24 mx-auto">
          <div class="w-full hidden sm:flex justify-center items-center h-full rounded-sm overflow-hidden mb-12">
            <img class="w-full h-full" src="/assets/img/banner/banner.png" />
          </div>
          <h1 class="mt-2 mb-6 text-xl font-bold md:text-2xl text-gray-300">Related Products</h1>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 xl:px-0 w-fit mx-auto">
            <CardProduct v-for="product in related_products" :key="product" :product="product" />
          </div>
          <div class="flex justify-center mt-12">
            <a :href="route('landing.products')" class="py-4 px-12 text-white font-semibold rounded-full border border-gold-600 hover:bg-gold-600 hover:text-gray-100 cursor-pointer">
              Browse More
            </a>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CardProduct from '@/Components/CardProduct.vue';
import ContactModal from '@/Components/ContactModal.vue';
import { Head } from '@inertiajs/vue3';
import ProductCarousel from '@/Components/ProductCarousel.vue';

export default {
  components: {
    AppLayout,
    Head,
    ProductCarousel,
    CardProduct,
    ContactModal
  },
  props: {
    product: {
      type: Object,
      default: () => { }
    },
    related_products: {
      type: Array,
      default: () => [ ]
    }
  },
  data() {
    return {
      showAll: false,
      carouselOptions: {
        compact: false,
        idle: false,

        animated: false,
        showClass: false,
        hideClass: false,

        dragToClose: false,
        contentClick: false,

        Images: {
          zoom: false,
        },

        Toolbar: {
          display: {
            left: [],
            middle: ['infobar'],
            right: ['close'],
          },
        },

        Thumbs: {
          type: 'classic',
        },
      }
    }
  }
}
</script>
