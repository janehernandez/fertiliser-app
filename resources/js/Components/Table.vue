<script setup>
import { split, size } from 'lodash'
import { computed } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
  resources: {
    type: Array,
    default: () => [],
    required: true,
  },
  links: {
    type: Array,
    default: () => [],
    required: true,
  },
  columns: {
    type: Array,
    default: () => [],
    required: true,
  },
  headClass: {
    type: String,
    default: null,
  },
})

const totalResources = computed(() => size(props.resources))
const totalColumns = computed(() => size(props.columns))

const getResourceAttribute = (resource, attribute) => {
  const nodes = split(attribute, '.')
  let key = resource
  nodes.forEach((value) => {
    key = key[value] || ''
  })

  return key
}
</script>

<template>
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th v-for="column in columns" :key="`columns-${column.name}`" scope="col" class="py-3 px-6">
          {{ column.name }}
        </th>
      </tr>
    </thead>

    <tbody v-if="totalResources > 0">
      <tr
        v-for="resource in resources"
        :key="resource.id"
        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
      >
        <td v-for="column in columns" :key="`cell-${resource.id}-${column.name}`" class="py-4 px-6">
          <slot :name="`cell-${column.attribute}`" v-bind="{ column, resource }">
            {{ getResourceAttribute(resource, column.attribute) }}
          </slot>
        </td>
      </tr>
    </tbody>

    <tbody v-else>
      <tr>
        <td class="py-4 px-6 text-center" :colspan="totalColumns">No Records Found</td>
      </tr>
    </tbody>
  </table>

  <div v-if="totalResources > 0" class="flex justify-center mt-4 mb-4">
    <nav aria-label="Page navigation example">
      <ul class="flex list-style-none">
        <li v-for="(link, index) in links" class="page-item" :key="`link-${index}`">
          <Link
            v-if="link.url"
            :href="link.url"
            class="page-link relative block py-1.5 px-3 rounded border-0 outline-none transition-all duration-300 rounded"
            :class="[
              {
                'bg-blue-600 hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md':
                  link.active,
              },
              {
                'bg-transparent text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none':
                  !link.active,
              },
            ]"
          >
            <span v-html="link.label" />
          </Link>

          <span
            v-else
            class="cursor-not-allowed page-link relative block py-1.5 px-3 rounded border-0 outline-none transition-all duration-300 rounded bg-transparent text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
            v-html="link.label"
          />
        </li>
      </ul>
    </nav>
  </div>
</template>
