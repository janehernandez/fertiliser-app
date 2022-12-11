import { computed } from 'vue'
import { ref } from '@vue/runtime-core'
import { usePage } from '@inertiajs/inertia-vue3'
import { isEmpty, sumBy, remove } from 'lodash'

export default function productsData() {
  const orders = ref([])
  let columns = [
    { name: 'Product Name', attribute: 'name' },
    { name: 'Product Code', attribute: 'code' },
    { name: 'Available Qty', attribute: 'quantity' },
    { name: 'Unit Price', attribute: 'unit_price' },
  ]

  if (!usePage().props.value.user.is_admin) {
    columns = remove(columns, (column, key) => key > 0)
    columns.push({ name: 'Purchase', attribute: 'actions' })
  }

  const addPurchase = (resource) => {
    if (
      !isEmpty(orders.value[resource.id]) &&
      orders.value[resource.id].purchased_quantity >= resource.quantity
    ) {
      return
    }

    if (isEmpty(orders.value[resource.id])) {
      orders.value[resource.id] = {
        purchased_quantity: 1,
        availed_price: parseFloat(resource.unit_price),
        total_price: parseFloat(resource.unit_price),
      }
    } else {
      orders.value[resource.id].purchased_quantity += 1
      orders.value[resource.id].total_price =
        orders.value[resource.id].availed_price * orders.value[resource.id].purchased_quantity
    }
  }

  const removePurchase = (resource) => {
    if (orders.value[resource.id].purchased_quantity <= 0) {
      return
    }

    orders.value[resource.id].purchased_quantity -= 1
    orders.value[resource.id].total_price =
      orders.value[resource.id].purchased_quantity === 0
        ? 0
        : orders.value[resource.id].availed_price * orders.value[resource.id].purchased_quantity
  }

  const purchaseSummary = computed(() => {
    if (!orders.value) {
      return null
    }

    return {
      total_price: sumBy(orders.value, 'total_price'),
      total_quantity: sumBy(orders.value, 'purchased_quantity'),
    }
  })

  const resetPurchase = () => {
    orders.value = []
  }

  return {
    columns,
    orders,
    addPurchase,
    removePurchase,
    purchaseSummary,
    resetPurchase,
  }
}
