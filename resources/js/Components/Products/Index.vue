<script setup>
import { ref } from '@vue/reactivity'
import { isEmpty, pickBy } from 'lodash'
import { Inertia } from '@inertiajs/inertia'
import Table from '@/Components/Table.vue'
import AddProduct from '@/Components/Products/Add.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import productsData from '@/Composables/productsData'
import common from '@/Composables/common'

const { formatPrice } = common()
const { columns, orders, addPurchase, removePurchase, purchaseSummary, resetPurchase } =
  productsData()

const submit = () => {
  Inertia.post(
    route('app.customer.purchase'),
    { list: pickBy(orders.value) },
    {
      onSuccess: () => {
        resetPurchase()
      },
      onError: () => {
        alert('Something went wrong while purchasing the product')
      },
      onFinish: () => resetPurchase(),
    },
  )
}
</script>

<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mb-8 text-2xl">Fertilisers</div>

      <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <Table
          v-if="$page.props.user.is_admin"
          :resources="$page.props.products.data"
          :links="$page.props.products.links"
          :columns="columns"
        >
          <template #cell-unit_price="{ resource }">
            {{ formatPrice(resource.unit_price) }}
          </template>

          <template #cell-quantity="{ resource }">{{
            resource.quantity === 0 ? '0' : resource.quantity
          }}</template>
        </Table>

        <Table
          v-else
          :resources="$page.props.products.data"
          :links="$page.props.products.links"
          :columns="columns"
        >
          <template #cell-unit_price="{ resource }"> $ {{ resource.unit_price }} </template>

          <template #cell-actions="{ resource }">
            <div class="flex justify-between items-center">
              <PrimaryButton @click="removePurchase(resource)"> - </PrimaryButton>
              <InputLabel
                for="name"
                :value="
                  isEmpty(orders[resource.id]) || orders[resource.id].purchased_quantity === 0
                    ? '0'
                    : orders[resource.id].purchased_quantity
                "
              />
              <PrimaryButton @click="addPurchase(resource)"> + </PrimaryButton>
            </div>
          </template>
        </Table>
      </div>

      <AddProduct v-if="$page.props.user.is_admin" />

      <div
        v-if="!$page.props.user.is_admin && !isEmpty($page.props.products.data)"
        class="flex justify-between items-center mt-10"
      >
        <h1>Total Price: {{ formatPrice(purchaseSummary.total_price) }}</h1>
        <h1>Total Quantity: {{ purchaseSummary.total_quantity }}</h1>
        <PrimaryButton @click="submit"> Purchase </PrimaryButton>
      </div>
    </div>
  </div>
</template>
