
<template>
  <footer class="bg-base-dark">
    <div class="container px-6 py-12 mx-auto">
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">
        <div class="sm:col-span-2">
          <h1 class="max-w-lg text-xl font-semibold tracking-tight text-white xl:text-2xl">Subscribe
            our newsletter to get update.</h1>

          <div class="flex flex-col mx-auto mt-6 space-y-3 md:space-y-0 md:flex-row">
            <input id="email" type="text"
              class="px-4 py-2 text-white bg-transparent border rounded-sm focus:border-gray-500 focus:ring-gray-500"
              placeholder="Email Address">

            <button
              class="w-full px-6 py-2.5 text-sm font-medium tracking-wider text-white transition-colors duration-300 transform md:w-auto md:mx-4 focus:outline-none bg-gold-600 rounded-sm hover:bg-gold-700 focus:ring focus:ring-gray-100 focus:ring-opacity-80">
              Subscribe
            </button>
          </div>
        </div>

        <div>
          <p class="font-semibold text-gray-100">Products</p>

          <div class="flex flex-col items-start mt-5 space-y-2">
            <a :href="route('landing.home')"
              class="text-gray-300 transition-colors duration-300 hover:underline hover:text-gold-500">Home</a>
            <a :href="route('landing.products')"
              class="text-gray-300 transition-colors duration-300 hover:underline hover:text-gold-500">Browse</a>
          </div>
        </div>

        <div>
          <p class="font-semibold text-gray-100">Company</p>

          <div class="flex flex-col items-start mt-5 space-y-2">
            <a :href="route('landing.about')"
              class="text-gray-300 transition-colors duration-300 hover:underline hover:text-gold-500">About Us</a>
            <a :href="route('landing.terms')"
              class="text-gray-300 transition-colors duration-300 hover:underline hover:text-gold-500">Term of Service</a>
            <a :href="route('landing.contact')"
            class="text-gray-300 transition-colors duration-300 hover:underline hover:text-gold-500">Contact Us</a>
          </div>
        </div>
      </div>

      <hr class="my-6 border-gray-700 md:my-8">

      <div class="flex items-center justify-center sm:justify-between flex-col sm:flex-row gap-2">
        <a class="inline-flex items-center gap-x-2 text-xl font-semibold text-gold-600" href="#">
          <!-- <img class="w-10 h-auto" src="../docs/assets/img/logo/logo-short.png" alt="Logo"> -->
          Brand
        </a>

        <div class="flex justify-between items-center">
          <p class="text-gray-300 font-medium">CopyRight © 2017 - 2023 brand.com. All Rights Reserved.</p>
      </div>
    </div>
  </div>
</footer>
</template>

<script></script>