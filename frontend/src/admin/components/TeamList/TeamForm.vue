<template>
  <div>
    <ul role="list" class="grid grid-cols-1 mt-8 mb-6 gap-x-6 gap-y-8 lg:grid-cols-3 xl:gap-x-8">
      <li v-for="team in teams" :key="team.id" class="border border-gray-200 rounded-xl">
        <div class="flex items-center p-6 border-b cursor-pointer gap-x-4 border-gray-900/5 bg-gray-50">
          <img :src="team.country.flag_file" :alt="team.name" class="flex-none object-cover bg-white"/>
          <div class="text-sm font-medium leading-6 text-gray-900">
            {{ team.name }}
          </div>
          <Menu as="div" class="relative ml-auto">
            <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
              <MenuItems class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                <MenuItem v-slot="{ active }">
                  <a href="#" :class="[ active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900', ]" >
                    View
                  </a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a href="#" :class="[active ? 'bg-gray-50' : '','block px-3 py-1 text-sm leading-6 text-gray-900', ]">
                    Edit
                    </a>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
        <dl v-for="player in team.players" :key="player.id" class="px-6 py-2 mt-1 -my-2 text-sm leading-6 border-b divide-y divide-gray-100" >
          <div class="flex justify-between gap-x-4">
            <dt class="text-gray-500">
              {{ player.name }} <span v-if="player.surname">{{ player.surname }}</span>
            </dt>
            <Menu as="div" class="relative ml-auto">
              <MenuButton class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500">
                <span class="sr-only">Open options</span>
                <EllipsisHorizontalIcon class="w-5 h-5" aria-hidden="true" />
              </MenuButton>
              <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                <MenuItems class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                  <MenuItem v-slot="{ active }">
                    <RouterLink :to="{name: 'TransferPlayer', params: { teamId: team.id, playerId: player.id }}" :class="[ active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900 ',]">
                      Transfer
                    </RouterLink>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </dl>
      </li>
    </ul>

    <nav class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6" aria-label="Pagination">
      <div class="flex justify-between flex-1 sm:justify-end">
        <RouterLink :to="{ name: 'TeamList', query: { page: Number(currentPage) - Number(1) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0" :class="{ 'opacity-50 pointer-events-none': currentPage <= 1 }">
          Previous
        </RouterLink>
        <RouterLink :to="{ name: 'TeamList', query: { page: Number(currentPage) + Number(1) } }" class="relative inline-flex items-center px-3 py-2 ml-3 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0" :class="{ 'opacity-50 pointer-events-none': currentPage >= pagination.total_pages }">
          Next
        </RouterLink>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue"
import { EllipsisHorizontalIcon } from "@heroicons/vue/20/solid"
import { ref, computed, onMounted, watch } from "vue"
import { useRoute } from "vue-router"
import Team from "@/composables/Team.js"

const teams = ref([])
const pagination = ref({})
const route = useRoute()
const currentPage = ref(route.query.page ? parseInt(route.query.page) : 1);
const { paginatedTeams } = Team()

const fetchTeams = (page) => {

  paginatedTeams(currentPage.value).then((returnData) => {

    const response = JSON.parse(JSON.stringify(returnData))

    if(response.status == 200){

      teams.value = response.data.data
      pagination.value = response.data.pagination
    }
  })
}

watch(() => route.query.page, (newVal, oldVal) => {
  
  currentPage.value = newVal
  fetchTeams(currentPage.value)  
})

onMounted(()=>{

  fetchTeams(currentPage.value)
})
</script>