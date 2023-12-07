<template>
  <div class="rounded-lg flex-col bg-dark-secondary flex">
    <div class="flex-1 p-6">
      <div class="justify-between items-center flex">
        <div class="flex items-center justify-center">
          <div>
            <h3 class="text-lg leading-tight text-gray-500 ">{{ title }}</h3>
            <h1 class="text-3xl leading-tight font-semibold">
              <slot name="body"></slot>
            </h1>
          </div>
        </div>
        <slot name="icon"></slot>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    title: String
  }
}
</script>