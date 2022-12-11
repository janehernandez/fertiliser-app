<script setup>
import { ref } from '@vue/runtime-core'
import common from '@/Composables/common'

const { formatPrice } = common()
const summary_labels = ref({
  total_orders: 'Total Orders',
  total_quantities: 'Total Fertiliser Sold (QTY)',
  total_sold: 'Total Amount Sold',
})
</script>

<template>
  <div class="pt-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div>
        <div class="flex flex-wrap">
          <div
            v-for="(summary, index) in $page.props.summary"
            :key="index"
            class="w-full lg:w-4/12 xl:w-4/12 px-4"
          >
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-8">
                <div class="flex flex-wrap">
                  <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                      {{ summary_labels[index] }}
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ index === 'total_sold' ? formatPrice(summary) : summary }}
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
