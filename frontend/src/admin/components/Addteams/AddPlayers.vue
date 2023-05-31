<template>
  <div>
    <div class="px-4 py-6 sm:p-8">
      <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[0].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Surname</label>
          <div class="mt-2"> 
            <input v-model="players[0].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6" >
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[1].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Surname</label>
          <div class="mt-2"> 
            <input v-model="players[1].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Name</label>
          <div class="mt-2"> 
            <input v-model="players[2].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Surname</label>
          <div class="mt-2"> 
            <input v-model="players[2].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Name</label >
          <div class="mt-2"> 
            <input v-model="players[3].name" type="text"  class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label  class="block text-sm leading-6 text-gray-900">Surname</label>
          <div class="mt-2"> 
            <input v-model="players[3].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Name</label>
          <div class="mt-2"> 
            <input v-model="players[4].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Surname</label>
          <div class="mt-2"> 
            <input v-model="players[4].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[5].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Surname</label>
          <div class="mt-2"> 
            <input v-model="players[5].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900">Name</label>
          <div class="mt-2"> 
            <input v-model="players[6].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Surname</label>
          <div class="mt-2"> 
            <input v-model="players[6].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[7].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Surname</label>
          <div class="mt-2"> 
            <input v-model="players[7].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[8].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Surname</label>
          <div class="mt-2"> 
            <input v-model="players[8].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
      </div>
      <div
        class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[9].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Surname</label>
          <div class="mt-2"> 
            <input v-model="players[9].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Name</label>
          <div class="mt-2"> 
            <input v-model="players[10].name" type="text" class="block w-full rounded-md focus:outline-none px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
        <div class="sm:col-span-3">
          <label class="block text-sm leading-6 text-gray-900" >Surname</label>
          <div class="mt-2"> 
            <input v-model="players[10].surname" type="text" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import { ref, watch } from "vue"

const emit = defineEmits(['players'])
const players = ref([
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
  {"name":"", "surname":""},
])

watch(players, (newValue, oldValue) => {
  
  emit('players', newValue)
}, { deep: true });

</script>