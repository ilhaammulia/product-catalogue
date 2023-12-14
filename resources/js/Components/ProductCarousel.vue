<template>
  <div>
    <div class="f-carousel overflow-hidden bg-dark-secondary" id="myCarousel">
      <div class="f-carousel__slide rounded-lg w-full object-cover object-center border border-gray-50/10" v-for="file in attachments" :key="file" :data-thumb-src="file.type == 'image' ? file.src : '/assets/img/video-placeholder.jpg'">
        <img v-if="file.type == 'image'" class="xl:p-8 " alt="product item" data-fancybox="gallery" :data-lazy-src="file.src" />
        <a v-else :href="file.src" data-fancybox="gallery"><img alt="video thumbnail" data-lazy-src="/assets/img/video-placeholder.jpg" /></a>
      </div>
    </div>
  </div>
</template>

<script>
import { Fancybox, Carousel } from '@fancyapps/ui';
import { Thumbs } from "@fancyapps/ui/dist/carousel/carousel.thumbs.umd.js";

import '@fancyapps/ui/dist/fancybox/fancybox.css';
import "@fancyapps/ui/dist/carousel/carousel.umd.js";

export default {
  name: 'Gallery',
  props: {
    attachments: {
      type: Array,
      default: () => []
    },
    options: Object,
  },
  data: () => ({
  }),
  methods: {
    slideTo(val) {
      this.currentSlide = val
    },
  },
  mounted() {
    Fancybox.bind(this.$refs.container, '[data-fancybox]', {
      ...(this.options || {}),
    });

    new Carousel(document.getElementById('myCarousel'), { Dots: false, Thumbs: { type: 'classic' } }, { Thumbs })
  },
  updated() {
    Fancybox.unbind(this.$refs.container);
    Fancybox.close();

    Fancybox.bind(this.$refs.container, '[data-fancybox]', {
      ...(this.options || {}),
    });
  },
  unmounted() {
    Fancybox.destroy();
  },
}
</script>

<style>
#myCarousel {
  max-width: 640px;
  margin: 0 auto;
}

#myCarousel .f-carousel__slide {
  display: flex;
  justify-content: center;
  align-items: center;
}

.f-carousel__thumbs {
  margin-top: 12px !important;
}

</style>