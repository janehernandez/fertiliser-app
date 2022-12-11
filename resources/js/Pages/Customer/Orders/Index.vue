<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import { filter } from 'lodash'

import AppLayout from '@/Layouts/AppLayout.vue'
import Table from '@/Components/Table.vue'
import DialogModal from '@/Components/DialogModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import OrderSummary from '@/Components/Orders/Summary.vue'
import common from '@/Composables/common'

const { formatPrice } = common()

let columns = [
  { name: 'Order No.', attribute: 'order_no' },
  { name: 'Total Quantity', attribute: 'total_quantity' },
  { name: 'Total Amount', attribute: 'total_amount' },
]

let columns_breakdown = [
  { name: 'Fertiliser Code', attribute: 'product.code' },
  { name: 'Purchased Quantity', attribute: 'quantity' },
  { name: 'Availed Price', attribute: 'availed_price' },
  { name: 'Total Price', attribute: 'total_price' },
]

const showBreakdownModal = ref(false)
const breakdown = ref(false)

const showOrderBreakdown = (id) => {
  breakdown.value = filter(usePage().props.value.logOrders, function (item) {
    return item.order_id === id
  })

  showBreakdownModal.value = true
}

const closeModal = () => {
  showBreakdownModal.value = false
}
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Orders</h2>
    </template>

    <OrderSummary />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <Table
            :resources="$page.props.orders.data"
            :links="$page.props.orders.links"
            :columns="columns"
          >
            <template #cell-order_no="{ resource }">
              <span class="cursor-pointer" @click="showOrderBreakdown(resource.id)">
                {{ resource.order_no }}
              </span>
            </template>

            <template #cell-total_quantity="{ resource }">
              {{ resource.total_quantity === 0 ? '0' : resource.total_quantity }}
            </template>

            <template #cell-total_amount="{ resource }">
              {{ formatPrice(resource.total_amount) }}
            </template>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>

  <DialogModal :show="showBreakdownModal" @close="closeModal">
    <template #title> Order Breakdown </template>

    <template #content>
      <Table :resources="breakdown" :columns="columns_breakdown">
        <template #cell-availed_price="{ resource }">
          {{ formatPrice(resource.availed_price) }}
        </template>

        <template #cell-total_price="{ resource }">
          {{ formatPrice(resource.total_price) }}
        </template>
      </Table>
    </template>

    <template #footer>
      <SecondaryButton @click="closeModal"> Close </SecondaryButton>
    </template>
  </DialogModal>
</template>
