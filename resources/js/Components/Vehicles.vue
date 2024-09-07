<template>
  <div>
    <div class="tabs">
      <button v-for="(tab, index) in tabs" :key="index" :class="{ 'active': currentTab === index }" @click="changeTab(index)">
        {{ tab }}
      </button>
    </div>

    <div v-if="currentTab === 0">
      <VehicleList :type="'all'" />
    </div>
    <div v-if="currentTab === 1">
      <VehicleList :type="'trailer'" />
    </div>
    <div v-else-if="currentTab === 2">
      <VehicleList :type="'truck'" />
    </div>
  </div>
</template>


<script setup>
import VehicleList from './VehicleList.vue';
import { ref } from 'vue';

const tabs = ref(['All','Trailers', 'Trucks']);
const currentTab = ref(0);

function changeTab(index) {
  currentTab.value = index;
}
</script>

<style scoped>
.tabs button {
  margin-right: 10px;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  background-color: #f0f0f0;
  cursor: pointer;
}

.tabs button.active {
  background-color: #ddd;
}
</style>