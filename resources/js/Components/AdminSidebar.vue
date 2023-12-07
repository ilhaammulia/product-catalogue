import { Bars3Icon } from '@heroicons/vue/24/solid';
<template>
  <button data-drawer-target="admin-sidebar" data-drawer-toggle="admin-sidebar" aria-controls="admin-sidebar"
    type="button"
    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg lg:hidden border border-gray-50/20 focus:outline-none focus:ring-2 focus:ring-gray-50/20">
    <span class="sr-only">Open sidebar</span>
    <Bars3BottomLeftIcon class="w-4 h-4 text-gray-300" />
  </button>

  <aside id="admin-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full xl:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-dark-secondary">
      <ul class="space-y-2 font-semibold">
        <li>
          <a :href="route('admin.dashboard')"
            class="flex items-center p-2 text-gray-300 hover:bg-gold-600 rounded-lg group">
            <span class="ms-3">Dashboard</span>
          </a>
        </li>
        <li>
          <a :href="route('admin.product')"
            class="flex items-center p-2 text-gray-300 hover:bg-gold-600 rounded-lg group">
            <span class="ms-3">Product Management</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
import {Bars3BottomLeftIcon} from '@heroicons/vue/24/solid';

export default {
  components: {
    Bars3BottomLeftIcon,
  }
}
</script>