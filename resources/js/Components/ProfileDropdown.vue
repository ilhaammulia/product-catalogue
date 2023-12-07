<template>
  <button data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-full h-full">
    <img id="avatarButton" 
    class="w-10 h-10 rounded-full cursor-pointer" src="/assets/img/user-placeholder.jpg" alt="User dropdown">
  </button>
  

  <div id="userDropdown"
    class="z-10 hidden bg-dark-secondary divide-y divide-gray-100 rounded-lg shadow w-44">
    <ul class="py-2 text-sm text-gray-300" aria-labelledby="avatarButton">
      <li>
        <a :href="route('admin.dashboard')" class="block px-4 py-2 hover:bg-gold-600">Dashboard</a>
      </li>
    </ul>
    <div class="py-1">
      <form method="POST" @submit.prevent="logout">
          <button type="submit" class="block px-4 py-2 text-sm text-start text-gray-300 hover:bg-gold-600 cursor-pointer w-full">Logout</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    logout() {
      return this.$inertia.post(route('logout'));
    }
  }
}
</script>