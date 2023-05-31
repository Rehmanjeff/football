<template>
  <div class="sm:px-6 lg:px-8">
    <div class="mt-4 sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Teams</h1>
        <p class="mt-2 text-sm text-gray-700">  A list of all teams and their players</p>
      </div>
      <RouterLink :to="{ name: 'Addteam' }">
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
          <button type="button"  class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add team</button>
        </div>
      </RouterLink>
    </div>
    <TeamForm />
  </div>
</template>
  
  <script setup>
import { PlusIcon } from "@heroicons/vue/20/solid"

import TeamForm from "../components/TeamList/TeamForm.vue"
import { ref, computed, watch, onMounted } from "vue"
import { useRoute } from "vue-router"

const teams = ref([])

const route = useRoute()

// watch(
//   () => route.params.id,
//   (newValue, oldValue) => {
//     console.log(newValue)
//   }
// )
</script>