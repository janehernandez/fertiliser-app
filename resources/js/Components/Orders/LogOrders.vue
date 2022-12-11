<script setup>
import Table from '@/Components/Table.vue'
import common from '@/Composables/common'

const { formatPrice } = common()
const columns = [
  { name: 'Order No.', attribute: 'order.order_no' },
  { name: 'Product Code', attribute: 'product.code' },
  { name: 'Purchased Quantity', attribute: 'quantity' },
  { name: 'Availed Price', attribute: 'availed_price' },
  { name: 'Total Amount', attribute: 'total_price' },
]
</script>

<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mb-8 text-2xl">Transactions</div>

      <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <Table
          :resources="$page.props.logOrders.data"
          :links="$page.props.logOrders.links"
          :columns="columns"
        >
          <template #cell-total_price="{ resource }">
            {{ formatPrice(resource.total_price) }}
          </template>
        </Table>
      </div>
    </div>
  </div>
</template>
