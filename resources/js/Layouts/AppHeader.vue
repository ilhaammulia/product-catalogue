<template>
  <nav class="container bg-dark-primary border-gray-50/20 mx-auto pt-4 md:pt-0 px-5">
    <div class="flex flex-wrap items-center justify-between mx-auto py-2">
      <Link :href="route('landing.home')" class="flex items-center space-x-3 rtl:space-x-reverse">
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-gold-600">Coinluxe</span>
      </Link>
      <div class="flex items-center gap-4 md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
        <form @submit="handleSearch">
          <div class="w-full sm:max-w-sm md:max-w-md mx-auto hidden md:block">
            <label for="search-box" class="sr-only">Label</label>
            <div class="relative flex rounded-lg shadow-sm">
              <input type="text" id="search-box" name="search" placeholder="Search products" v-model="form.search"
                class="py-2 px-4 ps-11 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-s-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <MagnifyingGlassIcon class="w-4 h-4 text-gray-300" />
              </div>
              <button type="button" @click="handleSearch"
                class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-gold-600 text-white hover:bg-gold-700 disabled:opacity-50 disabled:pointer-events-none ">Search</button>
            </div>
          </div>
        </form>
        <CurrencySwitcher />

        <button v-if="$page.props.auth.user" @click="handleMenuOpen" aria-haspopup="true" class="flex justify-center items-center gap-2 py-2 px-4 rounded-md text-gray-100 font-semibold bg-gold-600 hover:bg-gold-700">
          <UserIcon class="w-6 h-6" />
        </button>
        <Menu ref="menu" id="overlay_menu" :model="items" :popup="true" class="bg-dark-secondary rounded-md">
          <template #item="{ item, props }">
            <Link v-bind="props.action" class="font-medium text-gray-300" :href="item.link">
              {{ item.label }}
            </Link>
          </template>
          <template #end>
            <hr class="border-gray-50/20" />
            <Link href="/logout" method="post" as="button" class="font-medium text-gray-300 py-2 px-4">Logout</Link>
          </template>
        </Menu>

        <button type="button" @click="toggleNavbar"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden border border-gray-50/20 focus:outline-none focus:ring-2 focus:ring-gray-50/20"
          aria-controls="navbar-language" aria-expanded="false">
          <Bars3Icon class="w-4 h-4 text-gray-300" />
        </button>
      </div>
      <div :class="{'hidden': !isNavbarOpen}" class="items-center justify-between w-full md:w-auto md:order-1" id="navbar-language">
        <ul class="flex flex-col gap-4 font-medium mt-4 rounded-lg bg-transparent">
          <li>
            <Link class="font-medium text-gray-300 hover:text-gray-400" :href="route('landing.home')">Home</Link>
          </li>
          <li>
            <Link class="font-medium text-gray-300 hover:text-gray-400" :href="route('landing.products')">Browse</Link>
          </li>
          <li>
            <Link class="font-medium text-gray-300 hover:text-gray-400" :href="route('landing.about')">About Us</Link>
          </li>
          <li>
            <Link class="font-medium text-gray-300 hover:text-gray-400" :href="route('landing.terms')">Term of Service</Link>
          </li>
          <li>
            <Link class="font-medium text-gray-300 hover:text-gray-400" :href="route('landing.contact')">Contact Us</Link>
          </li>
          <li>
            <div class="w-full sm:max-w-sm md:max-w-md mx-auto">
              <form @submit="handleSearch">
                <label for="search" class="sr-only">Label</label>
                <div class="relative flex rounded-lg shadow-sm">
                  <input type="text" id="search" name="search" placeholder="Search products" v-model="form.search"
                    class="py-2 px-4 ps-11 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-s-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none">
                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <MagnifyingGlassIcon class="w-4 h-4 text-gray-300" />
                  </div>
                  <button type="submit" @click="handleSearch"
                    class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-gold-600 text-white hover:bg-gold-700 disabled:opacity-50 disabled:pointer-events-none ">Search</button>
                </div>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="hidden sm:flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-gold-600 text-sm py-4">
    <nav class="container w-full mx-auto sm:flex sm:items-center sm:justify-between" aria-label="Global">
      <div id="navbar-dark" class="hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
        <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-start sm:mt-0 sm:ps-5">
          <Link class="font-medium text-white hover:text-gray-200" :href="route('landing.home')">Home</Link>
          <Link class="font-medium text-white hover:text-gray-200" :href="route('landing.products')">Browse</Link>
          <Link class="font-medium text-white hover:text-gray-200" :href="route('landing.about')">About Us</Link>
          <Link class="font-medium text-white hover:text-gray-200" :href="route('landing.terms')">Term of Service</Link>
          <Link class="font-medium text-white hover:text-gray-200" :href="route('landing.contact')">Contact Us</Link>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import CurrencySwitcher from "@/Components/CurrencySwitcher.vue";
import { MagnifyingGlassIcon, Bars3Icon, UserIcon, } from "@heroicons/vue/24/solid";
import { Link, useForm } from '@inertiajs/vue3';

import Menu from 'primevue/menu';
import "primevue/resources/themes/viva-dark/theme.css";


export default {
  components: {
    CurrencySwitcher,
    Link,
    MagnifyingGlassIcon,
    Bars3Icon,
    UserIcon,
    Menu
  },
  data() {
    return {
      items: [
          {
              label: 'Dashboard',
              link: route('admin.dashboard')
          },
          {
              label: 'Product',
              link: route('admin.product')
          },
          {
              label: 'User',
              link: route('admin.users')
          },
          {
              label: 'Ticket',
              link: route('admin.ticket')
          },
      ],
      isNavbarOpen: false,
      form: useForm({
        search: null,
      })
    }
  },
  methods: {
    handleMenuOpen(event) {
      this.$refs.menu.toggle(event);
    },
    toggleNavbar() {
      this.isNavbarOpen = !this.isNavbarOpen;
    },
    
    handleSearch() {
      this.form.get(route('landing.products', {search: this.form.search}));
    }
  }
}
</script>