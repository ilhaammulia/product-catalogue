<template>
  <AppLayout>

    <Head title="Edit Product" />

    <a :href="route('admin.product')"
      class="flex justify-center items-center gap-2 py-2 px-4 max-w-[100px] rounded-md text-gray-100 font-semibold bg-gold-600 hover:bg-gold-700"
      type="button">
      <ArrowLeftIcon class="w-5 h-5" />
      <p>Back</p>
    </a>

    <section class="mt-4 flex flex-col sm:flex-row justify-between items-start gap-4">
      <div class="flex flex-col gap-4 w-full">
        <div class="flex items-center justify-center w-full">
          <label for="dropzone-file"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-trnsparent border-gray-50/10">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
              <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
              </svg>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                or
                drag and drop</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="dropzone-file" type="file" class="hidden" @change="handleUploadFile" accept="video/*,image/*" />
          </label>
        </div>
        <ScrollPanel :class="{ 'border-red-600': $page.props.errors.files && !form.files.length }"
          class="h-[334px] w-full overflow-y-auto border border-dashed border-gray-50/10 rounded-lg">
          <ul class="flex flex-col justify-end text-start gap-2 p-4">
            <li v-for="file in form.files" :key="file"
              class="flex items-center gap-x-2 p-3 text-sm font-semibold rounded-md bg-dark-secondary border border-gray-50/10 text-gray-300">
              <div class="w-full flex justify-between truncate">
                <a :href="'/storage/' + file.path" target="_blank" class="me-3 flex-1 w-0 truncate">
                  {{ file.name || file.filename }}
                </a>
                <button type="button" @click="handleDeleteFile(file)" class="flex items-center gap-x-2 whitespace-nowrap">
                  <TrashIcon class="w-4 h-4 text-red-500" />
                </button>
              </div>
            </li>
          </ul>
        </ScrollPanel>
        <p v-if="$page.props.errors.files && !form.files.length" class="mt-2 text-sm text-red-600">{{
          $page.props.errors.files }}</p>
      </div>

      <div class="w-full flex flex-col border border-dashed border-gray-50/10 px-6 py-4 rounded-lg">
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label for="product-name" class="block text-sm font-medium mb-2 text-gray-400">Product Name</label>
            <div class="relative">
              <input type="text" id="product-name" name="product_name" v-model="form.name"
                :class="{ 'border-red-600': $page.props.errors.name && !form.name }"
                class="py-3 px-4 ps-11 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                placeholder="Apple iPhone">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <CubeIcon class="w-4 h-4 text-gray-300" />
              </div>
            </div>
            <p v-if="$page.props.errors.name && !form.name" class="mt-2 text-sm text-red-600">{{ $page.props.errors.name
            }}</p>
          </div>
          <div>
            <label for="product-link" class="block text-sm font-medium mb-2 text-gray-400">Product Link</label>
            <div class="relative">
              <input type="text" id="product-link" name="product_link" v-model="form.link"
                :class="{ 'border-red-600': $page.props.errors.link && !form.link }"
                class="py-3 px-4 ps-11 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                placeholder="https://">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <LinkIcon class="w-4 h-4 text-gray-300" />
              </div>
            </div>
            <p v-if="$page.props.errors.link && !form.link" class="mt-2 text-sm text-red-600">{{ $page.props.errors.link
            }}</p>
          </div>
        </div>
        <div class="mt-4">
          <label for="product-description" class="block text-sm font-medium mb-2 text-gray-400">Product
            Description</label>
            <Editor v-model="form.description" editorStyle="height: 320px;" :class="{ 'border-red-600': $page.props.errors.description && !form.description }" />
          <p v-if="$page.props.errors.description && !form.description" class="mt-2 text-sm text-red-600">{{
            $page.props.errors.description }}</p>
        </div>
        <div class="mt-4">
          <label class="block text-sm font-medium mb-2 text-gray-400">Product Categories</label>
          <MultiSelect v-model="form.categories" :options="categories" filter optionLabel="name" placeholder="Categories" :maxSelectedLabels="5"
            class="w-full md:w-20rem rounded-md text-gray-300 text-sm bg-dark-primary border border-gray-50/10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none" />
          <CategoryModal>
            <p class="text-gray-300 text-sm mt-2 bg-gold-600 hover:bg-gold-700 focus:bg-gold-700 px-6 py-1 rounded-md font-semibold">Add</p>
          </CategoryModal>
        </div>
        <div class="mt-4">
          <label class="block text-sm font-medium mb-2 text-gray-400">Product Brand</label>
          <Dropdown id="product-brand" v-model="form.brand_id" placeholder="Brand" :options="brands" editable
            optionLabel="name" :class="{ 'border-red-600': $page.props.errors.brand_id && !form.brand_id }"
            class="flex justify-center w-full border border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none" />
          <p v-if="$page.props.errors.brand_id && !form.brand_id" class="mt-2 text-sm text-red-600">{{
            $page.props.errors.brand_id }}</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
          <div>
            <label for="product-price" class="block text-sm font-medium mb-2 text-gray-400">Product Price</label>
            <div class="relative">
              <input type="text" id="product-price" v-model="form.price" name="product-price"
                class="py-3 px-4 ps-11 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none"
                placeholder="0.00">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <span class="text-gray-500">Ƀ</span>
              </div>
              <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                <span class="text-gray-500">BTC</span>
              </div>
            </div>
          </div>
          <div>
            <label for="product-quantity" class="block text-sm font-medium mb-2 text-gray-400">Product Quantity</label>
            <div class="py-2.5 px-3 bg-transparent border border-gray-50/20 rounded-lg">
              <div class="w-full flex justify-between items-center gap-x-5">
                <div class="grow">
                  <input class="w-full p-0 bg-transparent border-0 text-gray-300 focus:ring-0" type="text"
                    v-model="form.stock">
                </div>
                <div class="flex justify-end items-center gap-x-1.5">
                  <button type="button" @click="form.stock--"
                    class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md bg-gold-500 text-gray-300 shadow-sm hover:bg-gold-600 disabled:opacity-50 disabled:pointer-events-none">
                    <MinusIcon class="w-4 h-4" />
                  </button>
                  <button type="button" @click="form.stock++"
                    class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md bg-gold-500 text-gray-300 shadow-sm hover:bg-gold-600 disabled:opacity-50 disabled:pointer-events-none">
                    <PlusIcon class="w-4 h-4" />
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-400">Stock Status</label>
            <select id="product-brand" v-model="form.stock_status"
              class="p-3 block w-full border-gray-50/20 bg-dark-primary shadow-sm rounded-md text-sm text-white focus:z-10 focus:border-gray-500 focus:ring-gray-500 disabled:opacity-50 disabled:pointer-events-none">
              <option value="in_stock">In Stock</option>
              <option value="out_of_stock">Out of Stock</option>
            </select>
          </div>
        </div>
        <button type="button" @click="handleSubmit"
          class="w-full mt-6 px-6 py-2.5 text-sm font-medium tracking-wider text-white transition-colors duration-300 transform md:w-auto focus:outline-none bg-gold-600 rounded-md hover:bg-gold-700 focus:ring focus:ring-gray-100 focus:ring-opacity-80">
          Submit
        </button>
      </div>
    </section>

  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdminSidebar from '@/Components/AdminSidebar.vue';
import CategoryModal from '@/Components/CategoryModal.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { TrashIcon, CubeIcon, LinkIcon, MinusIcon, PlusIcon, ArrowLeftIcon } from '@heroicons/vue/20/solid';

import Editor from 'primevue/editor';

import ScrollPanel from 'primevue/scrollpanel';
import MultiSelect from 'primevue/multiselect';
import Dropdown from 'primevue/dropdown';
import "primevue/resources/themes/mdc-dark-deeppurple/theme.css";



export default {
  components: {
    AppLayout,
    AdminSidebar,
    Head, CategoryModal, Link, Editor,
    TrashIcon, CubeIcon, LinkIcon, MinusIcon, PlusIcon, ArrowLeftIcon,
    MultiSelect, ScrollPanel, Dropdown,
  },
  data() {
    return {
      form: useForm({
        name: null,
        link: null,
        description: null,
        categories: [],
        brand_id: null,
        price: 0,
        stock: 1,
        stock_status: 'in_stock',
        files: [],
        deleted_files: [],
        new_files: [],
        currency: 'BTC',
      }),
    }
  },
  props: {
    categories: Array,
    brands: Array,
    product: Object,
  },
  mounted() {
    this.form.name = this.product.name;
    this.form.link = this.product.link;
    this.form.description = this.product.description;
    this.form.categories = this.product.categories;
    this.form.brand_id = this.product.brand_id;
    this.form.price = this.product.price;
    this.form.stock = this.product.stock;
    this.form.stock_status = this.product.stock_status;
    this.form.files = this.product.files;
  },
  methods: {
    handleUploadFile(event) {
      const file = event.target.files[0];
      if (file.type.includes('image') || file.type.includes('video')) {
        this.form.new_files.push(file);
        this.form.files.push(file);
      }
    },
    handleDeleteFile(file) {
      if (!this.form.new_files.includes(file)) {
        this.form.deleted_files.push(file);
      } else {
        this.form.new_files.splice(this.form.new_files.indexOf(file), 1);
      }
      this.form.files.splice(this.form.files.indexOf(file), 1);
    },
    handleSubmit() {
      if (this.form.brand_id?.id) {
        this.form.brand_id = this.form.brand_id.id;
      }
      this.form.post(route('admin.product.update', this.product.id), {});
    }
  },
}
</script>

<style>
.p-multiselect-filter {
  background-color: #222222;
  color: rgb(209 213 219);
  border-color: rgb(209 213 219);
}

.p-multiselect-filter:focus {
  border-color: rgb(249 250 251 / 0.2);
}

.p-multiselect-header {
  background-color: #2B2B2B;
}

.p-multiselect-close:hover {
  background-color: #84684a;
}

.p-highlight {
  border-color: #84684a;
}

.p-multiselect-item {
  background-color: #2B2B2B;
  color: rgb(209 213 219);
}

#product-brand>input {
  background-color: #222222;
  color: rgb(209 213 219);
  border-width: 1px;
  border-color: rgb(209 213 219 / 0.1);
}
</style>