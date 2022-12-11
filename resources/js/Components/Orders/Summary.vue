<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import { sumBy, map } from 'lodash'
import common from '@/Composables/common'

const { formatPrice } = common()

const totalOrdersPurchased = computed(() => {
  let data = map(usePage().props.value.orders.data, (item) => {
    return {
      ...item,
      total_amount: parseFloat(item.total_amount),
      total_quantity: parseInt(item.total_quantity),
    }
  })

  return {
    total_amount: sumBy(data, 'total_amount'),
    total_quantity: sumBy(data, 'total_quantity'),
  }
})
</script>

<template>
  <div class="pt-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-6/12 px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-8">
                <div class="flex flex-wrap">
                  <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                      Total Fertilisers Availed
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ totalOrdersPurchased.total_quantity }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 xl:w-6/12 px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-8">
                <div class="flex flex-wrap">
                  <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                      Total Amount Purchased
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ formatPrice(totalOrdersPurchased.total_amount) }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
