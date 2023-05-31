<template>
  <div class="bg-gray-50">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="mb-8 space-y-10 divide-y divide-gray-900/10">
        <div class="grid grid-cols-1 mt-8 gap-x-8 gap-y-8 md:grid-cols-3">
          <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Team</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
              A country can only have one team. The countries displaying here are the ones that are not yet associated with a team.
            </p>
          </div>
          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
              <div class=" gap-x-6 gap-y-8">
                <div class="col-span-full">
                  <label class="block text-sm leading-6 text-gray-900">Name*</label>
                  <div class="mt-2">
                    <input type="text" v-model="teamName" autocomplete="street-address" class="block w-full rounded-md px-2 focus:outline-none border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                  <div v-if="teamError != ''" class="text-sm text-red-500 mt-1">
                    {{ teamError }}
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-row w-full px-4 gap-x-6 sm:px-8 sm:pb-8">
              <div class="w-1/2 sm:col-span-3">
                <label class="block text-sm leading-6 text-gray-900">Money balance*</label>
                <div class="mt-2">
                  <input v-model="moneyBalance" type="number" autocomplete="given-name" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
                <div v-if="moneyError != ''" class="text-sm text-red-500 mt-1">
                  {{ moneyError }}
                </div>
              </div>
              <div class="w-1/2 sm:col-span-3">
                <label class="block text-sm leading-6 text-gray-900">Country*</label>
                <div class="mt-2">
                  <select v-model="country" class="block w-full px-2 py-2.5 bg-white border-0 rounded-md shadow-sm focus:outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Select country</option>
                    <option v-for="country in countries" :key="country.id" :value="country.id">
                      {{ country.name }}
                    </option>
                  </select>
                </div>
                <div v-if="countryError != ''" class="text-sm text-red-500 mt-1">
                  {{ countryError }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
          <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
              Players Information
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
              Here you can add players to the team. Maximum players a team can have is 11
            </p>
          </div>

          <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <AddPlayers v-if="showPlayers" @players="assignPlayers" />
            <Emptystate v-else @buttonClick="togglePlayers" />
          </div>
        </div>
      </div>
      <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
        <button @click="proceedCreateTeam" type="button" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
      </div>
    </div>
    <PageNotification @close=closeNotification :show=notification.show :type=notification.type :message=notification.message :messageDetails=notification.messageDetails></PageNotification>
  </div>
</template>

<script setup>
import Emptystate from "@/admin/components/Addteams/Emptystate.vue"
import AddPlayers from "@/admin/components/Addteams/AddPlayers.vue"
import PageNotification from '@/admin/components/PageNotification.vue'
import Country from "@/composables/Country.js"
import Team from "@/composables/Team.js"
import { ref, onMounted, reactive } from "vue"

const teamName = ref("")
const moneyBalance = ref("")
const country = ref("")
const teamError = ref("")
const moneyError = ref("")
const countryError = ref("")
const { allCountries } = Country()
const { createTeam } = Team()
const countries = ref([])
const players = ref([])
const showPlayers = ref(false)
const loading = ref(false)
const notification = reactive({
    show: false,
    message: null,
    messageDetails: '',
    type: ''
})

const proceedCreateTeam = () => {

  let hasError = false
  resetErrors()

  if (teamName.value == '') {
    teamError.value = 'Team field is required'
    hasError = true
  }
  if (moneyBalance.value <= 0) {
    moneyError.value = 'Money balance field is required'
    hasError = true
  }
  if (country.value == '') {
    countryError.value = 'Must select one country'
    hasError = true
  }

  if(!hasError && loading.value === false){

    loading.value = true

    let data = {
      name: teamName.value,
      money_balance: moneyBalance.value,
      country_id: country.value,
      players: players.value
    }

    createTeam(data).then((returnData) => {

      loading.value = false
      const response = JSON.parse(JSON.stringify(returnData))

      if(response.status == 201){

        resetForm()

        notification.type = 'success'
        notification.message = response.data.message
        notification.show = true
      }else if(response.status == 400 || response.status == 409){

        notification.type = 'error'
        notification.message = response.message
        notification.show = true
      }else{

        notification.type = 'error'
        notification.message = 'Unknown error'
        notification.show = true
      }
    })
  }
}

const togglePlayers = () => {

  showPlayers.value = !showPlayers.value
}

const assignPlayers = (playersData) => {

  let counter = 0
  players.value = []
  for (let index = 0; index < playersData.length; index++) {

    if(playersData[index].name != ''){
      players.value[counter] = playersData[index]
      counter++
    }
  }
}

const resetForm = () => {

  showPlayers.value = false
  players.value = []
  teamName.value = country .value = moneyBalance.value = ''
}

const resetErrors = () => {

  teamError.value = moneyError.value = countryError.value = ''
}

const closeNotification = () => {

  notification.show = false
}

onMounted(() => {

  allCountries().then((data) => {
      
    if(data.status === 200){

      let counter = 0
      for (let index = 0; index < data.data.length; index++) {

        if(data.data[index].has_team === false){
          countries.value[counter] = data.data[index]
          counter++
        }
      }
    }
  })
})
</script>