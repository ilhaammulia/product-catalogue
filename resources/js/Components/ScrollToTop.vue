<template>
  <div ref="scrollTopButton" class="hidden sm:flex invisible sticky w-full justify-end bottom-0 pb-5 pr-8">
    <div class="text-gray-400 hover:text-brown-400 transition">
      <button @click="scrollToTop" class="bg-gold-600 hover:bg-gold-700 rounded-full shadow-lg">
        <ChevronUpIcon class="h-12 w-12 text-white" />
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { ChevronUpIcon } from "@heroicons/vue/20/solid";

export default defineComponent({
  components: {
    ChevronUpIcon
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
  },

  beforeUnmount() {
    window.removeEventListener("scroll", this.handleScroll);
  },

  methods: {
    handleScroll() {
      const scrollBtn = this.$refs.scrollTopButton;

      if (window.scrollY > 200) {
        scrollBtn.classList.remove("invisible");
      } else {
        scrollBtn.classList.add("invisible");
      }
    },
    scrollToTop() {
        window.scrollTo({ top: 0, behavior: "smooth" });
    },
  },
});
</script>