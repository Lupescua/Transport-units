<template>
  <div>
    <input type="text" v-model="searchQuery" placeholder="Search...">
    <button @click="searchVehicles">Search</button>
      <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Model</th>
            <th scope="col">Width (m)</th>
            <th scope="col">Length (m)</th>
            <th scope="col">Capacity (cbm)</th>
            <th scope="col">Actions</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border" v-for="(vehicle, index) in filteredVehicles" :key="index">
          <!-- Use index as key for the default empty row -->
            <td><input type="text" v-model="vehicle.name"  :disabled="!editing[vehicle.id]" ></td>
            <td><select v-model="vehicle.type">
              <option value="trailer">Trailer</option>
              <option value="truck">Truck</option>
            </select></td>
            <td><input type="text" v-model="vehicle.model"  :disabled="!editing[vehicle.id]" ></td>
            <td><input type="number" v-model="vehicle.width"  :disabled="!editing[vehicle.id]" ></td>
            <td><input type="number" v-model="vehicle.length"  :disabled="!editing[vehicle.id]" ></td>
            <td><input type="number" v-model="vehicle.load_capacity"  :disabled="!editing[vehicle.id]" ></td>
            <td>
            <button class="btn btn-primary" @click="editVehicle(vehicle.id)"  v-if="!editing[vehicle.id]">Edit</button>
            <button class="btn btn-primary" @click="updateVehicle(vehicle)" v-if="editing[vehicle.id]">Save</button>
            </td>
            <td>
            <button class="btn btn-primary" @click="deleteVehicle(vehicle.id)">Delete</button>
            </td>
          </tr>
          <tr class="border">
            <td><input type="text" v-model="newVehicleData.name" required></td>
            <td><select v-model="newVehicleData.type" required >
              <option value="trailer">Trailer</option>
              <option value="truck">Truck</option>
            </select></td>
            <td><input type="text" v-model="newVehicleData.model" required ></td>
            <td><input type="number" v-model="newVehicleData.width" required ></td>
            <td><input type="number" v-model="newVehicleData.length" required ></td>
            <td><input type="number" v-model="newVehicleData.load_capacity" required ></td>
            <td>
              <button class="btn btn-primary" @click="createVehicle">Add</button>
            </td>
          </tr>
        </tbody>
      </table>
  </div>
</template>

<script setup>
import Vehicles from './Vehicles.vue';
import { ref, onMounted, defineProps, computed } from 'vue';
import axios from 'axios';

const props = defineProps(['type']);

const vehicles = ref([]);
const newVehicleData = ref( {
    name: '',
    type: '',
    model: '',
    length: '',
    width: '',
    load_capacity: '',
  },);
const searchQuery = ref('');
const editing = ref({});

function fetchVehiclesInBackground() {
  fetch(`/vehicles/${props.type}`)
    .then(response => response.json())
    .then(data => {
      // Check if the data is the same as the current vehicles ref
      if (JSON.stringify(data) !== JSON.stringify(vehicles.value)) {
        // Update the vehicles ref with the new data
        vehicles.value = data;
      }
    })
    .catch((error) => {
      console.error('Error fetching vehicles in background:', error);
    });
}

function updateVehicle(vehicle) {
  const { id } = vehicle;
   // Update the vehicles ref immediately
  const updatedVehicles = [...vehicles.value];
  const index = updatedVehicles.findIndex(v => v.id === id);
  if (index !== -1) {
    updatedVehicles[index] = vehicle;
  }
  vehicles.value = updatedVehicles;

  // Trigger a background fetch to update the data
  axios.put(`/vehicles/${id}`, vehicle)
    .then(() => {
      // reset editing state
      editing.value = {}
      // Fetch the updated vehicles list in the background
      fetchVehiclesInBackground();
    })
    .catch((error) => {
      console.error('Error updating vehicle:', error);
    });
}

function editVehicle(id) {
  editing.value[id] = true;
  // disable the edit button for all other vehicles
  for (let i in editing.value) {
    if (i !== id.toString()) {
      editing.value[i] = false
    }
  }
}

function createVehicle() {
  // Create a new vehicle object
  const newVehicle = { ...newVehicleData.value };

   // Update the vehicles ref immediately
  vehicles.value = [...vehicles.value, newVehicle];

  // Trigger a background fetch to update the data
  axios.post('/vehicles', newVehicle)
    .then(() => {
    // Reset the newVehicleData object to its initial state
      newVehicleData.value = {
        name: '',
        type: '',
        model: '',
        length: '',
        width: '',
        load_capacity: ''
      };
      // Fetch the updated vehicles list in the background
      fetchVehiclesInBackground();
    })
    .catch((error) => {
      console.error('Error creating vehicle:', error);
    });
}

function deleteVehicle(id) {
 // Update the vehicles ref immediately
  const updatedVehicles = vehicles.value.filter(v => v.id !== id);
  vehicles.value = updatedVehicles;

  // Trigger a background fetch to update the data
  axios.delete(`/vehicles/delete/${id}`)
    .then(() => {
      // Fetch the updated vehicles list in the background
      fetchVehiclesInBackground();
    })
    .catch((error) => {
      console.error('Error deleting vehicle:', error);
    });
}

const filteredVehicles = computed(() => {
  if (!searchQuery.value) return vehicles.value;
  return vehicles.value.filter(vehicle => {
    return Object.values(vehicle).some(value => {
      return String(value).toLowerCase().includes(searchQuery.value.toLowerCase());
    });
  });
});

onMounted(fetchVehiclesInBackground);
</script>