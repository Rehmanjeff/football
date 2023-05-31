<template>
  <div>
    <div class="p-8 space-y-12">
      <div class="grid grid-cols-1 pb-12 border-b gap-x-8 gap-y-10 border-gray-900/10 md:grid-cols-3">
        <div>
          <h2 class="text-base font-semibold leading-7 text-gray-900">{{ playerName }}</h2>
          <p class="mt-1 text-sm leading-6 text-gray-600"> Transfer player from one team to another</p>
        </div>

        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
          <div class="col-span-4">
            <label class="block text-sm leading-6 text-gray-900">Purchasing team</label>
            <div class="relative mt-2">
              <select v-model="buyerId" class="block w-full px-2 py-2 pr-8 text-gray-900 bg-white border-0 rounded-md shadow-sm appearance-none focus:outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">Select team</option>
                <option v-for="team in buyerTeams" :key="team.id" :value="team.id">
                  {{ team.name }}
                </option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center px-2 -ml-8 text-gray-700 pointer-events-none">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" >
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"  clip-rule="evenodd"/>
                </svg>
              </div>
            </div>
            <div v-if="teamError" class="text-sm text-red-500">{{ teamError }} </div>
          </div>

          <div class="sm:col-span-4">
            <label class="block text-sm leading-6 text-gray-900">Purchase amount</label>
            <div class="mt-2">
              <input v-model="moneyBalance" type="number" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
            </div>
            <div v-if="moneyError" class="text-sm text-red-500">{{ moneyError }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-end px-8 mt-6 gap-x-6">
      <div @click="proceedTransferPlayer" :class="loading == true ? '' : 'cursor-pointer hover:bg-indigo-500'" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Submit
      </div>
    </div>
    <PageNotification @close=closeNotification :show=notification.show :type=notification.type :message=notification.message :messageDetails=notification.messageDetails></PageNotification>
  </div>
</template>
  
<script setup>
import { ref, onMounted, reactive } from "vue"
import Team from "@/composables/Team.js"
import Player from "@/composables/Player.js"
import { useRoute } from 'vue-router'
import PageNotification from '@/admin/components/PageNotification.vue'

const buyerId = ref('')
const moneyBalance = ref('')
const teamError = ref('')
const moneyError = ref('')
const buyerTeams = ref([])
const { allTeams, transferTeamPlayer } = Team()
const { playerDetails } = Player()
const route = useRoute()
const sellerId = ref(route.params.teamId)
const playerId = ref(route.params.playerId)
const loading = ref(false)
const playerName = ref('')
const notification = reactive({
    show: false,
    message: null,
    messageDetails: '',
    type: ''
})

const proceedTransferPlayer = () => {

  let hasError = false
  resetErrors()

  if (moneyBalance.value <= 0) {
    moneyError.value = 'Amount cannot be empty'
    hasError = true
  }
  if (buyerId.value == '') {
    teamError.value = 'Must select a team that is purchasing the player'
    hasError = true
  }

  if(!hasError && loading.value === false){

    loading.value = true

    let data = {
      from_team: sellerId.value,
      to_team: buyerId.value,
      player: playerId.value,
      amount: moneyBalance.value
    }

    transferTeamPlayer(data).then((returnData) => {

      loading.value = false
      const response = JSON.parse(JSON.stringify(returnData))

      if(response.status == 200){

        resetForm()

        notification.type = 'success'
        notification.message = response.data.message
        notification.show = true
      }else if(response.status == 400){

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

const resetForm = () => {

  buyerId.value = moneyBalance.value = ''
}

const resetErrors = () => {

  moneyError.value = teamError.value = ''
}

const closeNotification = () => {

  notification.show = false
}

onMounted(() => {

  let data = {
    id: playerId.value
  }
  playerDetails(data).then((data) => {
      
    if(data.status === 200){

      playerName.value = data.data.name
      if(data.data.surname){
        
        playerName.value += ' ' + data.data.surname
      }
    }
  })

  allTeams().then((data) => {
      
    if(data.status === 200){

      // a team cannot be a seller and buyer at the same time
      buyerTeams.value = data.data.filter(team => Number(team.id) !== Number(sellerId.value))
    }
  })
})
</script>