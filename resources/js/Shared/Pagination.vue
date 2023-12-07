<template>
  <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-300 bg-transparent border border-gray-50/10 rounded-s-lg hover:bg-gold-600">Previous</a>
      </li>
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-transparent border border-gray-50/10 hover:bg-gold-600">1</a>
      </li>
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-transparent border border-gray-50/10 hover:bg-gold-600">2</a>
      </li>
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-transparent border border-gray-50/10 hover:bg-gold-600">3</a>
      </li>
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-transparent border border-gray-50/10 hover:bg-gold-600">4</a>
      </li>
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-transparent border border-gray-50/10 hover:bg-gold-600">5</a>
      </li>
      <li>
        <a href="#"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-transparent border border-gray-50/10 rounded-e-lg hover:bg-gold-600">Next</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    links: {
      type: Array,
      default: () => []
    },
  },
};
</script>