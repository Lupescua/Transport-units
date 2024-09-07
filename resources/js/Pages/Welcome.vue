<template>
    <Vehicles :vehicles="props.vehicles"> vehicles </Vehicles>
</template>

<script setup>

import Vehicles from '../Components/Vehicles.vue'

const props = defineProps({
  vehicles: Array
})
</script>

