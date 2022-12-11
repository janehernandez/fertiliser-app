<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Products from '@/Components/Products/Index.vue'
</script>

<template>
  <AppLayout title="Purchase">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Purchase
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <Products />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
