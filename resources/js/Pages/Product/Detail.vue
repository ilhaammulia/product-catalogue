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
          <div class="w-full flex justify-center items-center h-60 md:h-96 bg-gray-200 rounded-sm mb-12">
            Banner
          </div>
          <h1 class="mt-2 mb-6 text-xl font-bold md:text-2xl text-gray-300">Related Products</h1>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 xl:px-0 w-fit mx-auto">
            <!-- <CardProduct v-for="product in related_products" :key="product" :product="product" /> -->
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
    }
  },
  data() {
    return {
      showAll: false,
      related_products: [{ "id": 1, "title": "iPhone 9", "price": 549, "thumbnail": "https://i.dummyjson.com/data/products/1/thumbnail.jpg", "description": "An apple mobile which is nothing like apple" }, { "id": 2, "title": "iPhone X", "price": 899, "thumbnail": "https://i.dummyjson.com/data/products/2/thumbnail.jpg", "description": "SIM-Free, Model A19211 6.5-inch Super Retina HD display with OLED technology A12 Bionic chip with ..." }, { "id": 3, "title": "Samsung Universe 9", "price": 1249, "thumbnail": "https://i.dummyjson.com/data/products/3/thumbnail.jpg", "description": "Samsung's new variant which goes beyond Galaxy to the Universe" }, { "id": 4, "title": "OPPOF19", "price": 280, "thumbnail": "https://i.dummyjson.com/data/products/4/thumbnail.jpg", "description": "OPPO F19 is officially announced on April 2021." }, { "id": 5, "title": "Huawei P30", "price": 499, "thumbnail": "https://i.dummyjson.com/data/products/5/thumbnail.jpg", "description": "Huawei’s re-badged P30 Pro New Edition was officially unveiled yesterday in Germany and now the device has made its way to the UK." }, { "id": 6, "title": "MacBook Pro", "price": 1749, "thumbnail": "https://i.dummyjson.com/data/products/6/thumbnail.png", "description": "MacBook Pro 2021 with mini-LED display may launch between September, November" }, { "id": 7, "title": "Samsung Galaxy Book", "price": 1499, "thumbnail": "https://i.dummyjson.com/data/products/7/thumbnail.jpg", "description": "Samsung Galaxy Book S (2020) Laptop With Intel Lakefield Chip, 8GB of RAM Launched" }, { "id": 8, "title": "Microsoft Surface Laptop 4", "price": 1499, "thumbnail": "https://i.dummyjson.com/data/products/8/thumbnail.jpg", "description": "Style and speed. Stand out on HD video calls backed by Studio Mics. Capture ideas on the vibrant touchscreen." }, { "id": 9, "title": "Infinix INBOOK", "price": 1099, "thumbnail": "https://i.dummyjson.com/data/products/9/thumbnail.jpg", "description": "Infinix Inbook X1 Ci3 10th 8GB 256GB 14 Win10 Grey – 1 Year Warranty" }, { "id": 10, "title": "HP Pavilion 15-DK1056WM", "price": 1099, "thumbnail": "https://i.dummyjson.com/data/products/10/thumbnail.jpeg", "description": "HP Pavilion 15-DK1056WM Gaming Laptop 10th Gen Core i5, 8GB, 256GB SSD, GTX 1650 4GB, Windows 10" }],
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
