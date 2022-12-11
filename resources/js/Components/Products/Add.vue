<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import ActionSection from '@/Components/ActionSection.vue'
import DangerButton from '@/Components/DangerButton.vue'
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const showNewProductModal = ref(false)

const form = useForm({
  quantity: '',
  unit_price: '',
})

const createNewProduct = () => {
  showNewProductModal.value = true
}

const closeModal = () => {
  form.reset()
  showNewProductModal.value = false
}

const submit = () => {
  form.post(route('app.product.store'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <div class="flex justify-center my-5">
    <PrimaryButton @click="createNewProduct"> Create Product </PrimaryButton>
  </div>

  <!-- Create New Feriliser Modal -->
  <DialogModal :show="showNewProductModal" @close="closeModal">
    <template #title> Add New Product </template>

    <template #content>
      <div class="col-span-6 sm:col-span-4 mt-2">
        <InputLabel for="quantity" value="Quantity" />
        <TextInput
          id="quantity"
          v-model="form.quantity"
          type="number"
          min="0"
          class="mt-1 block w-full"
        />
        <InputError :message="form.errors.quantity" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-4 mt-2">
        <InputLabel for="unit_price" value="Unit Price" />
        <TextInput
          id="unit_price"
          v-model="form.unit_price"
          type="number"
          min="0"
          class="mt-1 block w-full"
        />
        <InputError :message="form.errors.unit_price" class="mt-2" />
      </div>
    </template>

    <template #footer>
      <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

      <PrimaryButton
        class="ml-3"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        @click="submit"
      >
        Add Product
      </PrimaryButton>
    </template>
  </DialogModal>
</template>
