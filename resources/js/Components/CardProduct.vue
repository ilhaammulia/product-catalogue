<template>
  <Link :href="route('landing.product.detail', {slug: product.slug})"
    class="relative flex flex-col text-gray-300  bg-dark-secondary shadow-md w-full rounded-xl bg-clip-border">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white h-60 rounded-xl bg-clip-border">
      <img
        :src="product.image"
        class="object-cover w-full h-full" />
    </div>
    <div class="p-6 mb-auto">
      <div class="flex items-center justify-between mb-2">
        <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900 line-clamp-2">
          {{ product.name }}
        </p>
      </div>
      <div v-html="product.description" class="font-sans text-sm antialiased font-normal leading-normal text-gray-400 line-clamp-2"></div>
    </div>
    <div class="p-6 pt-0">
      <p class="text-sm font-medium text-gray-300">
        Ƀ {{ ((product.price) * $store.state.currency.value).toFixed(4) }} {{ $store.state.currency.text }}
      </p>
    </div>
  </Link>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  components: {
    Link
  },
  props: {
    product: {
      type: Object,
      default: () => { }
    },
  },
}
</script>

<style scoped>
@property --num {
  syntax: '<integer>';
  initial-value: 0;
  inherits: false;
}

@keyframes counter {
  from {
    --num: 0;
  }

  to {
    --num: 40;
  }
}
</style>