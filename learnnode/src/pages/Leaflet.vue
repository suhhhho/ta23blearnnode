<script setup>
import { ref } from 'vue';
import LeafletMap from '../components/LeafletMap.vue';
 
let coords = ref([59.42691, 24.74344]);
let tartuCoords = [58.376824, 26.728565];
let zoom = ref(19);
let homeCoords = [58.398015, 26.715771];
let homePolygon = [
  [58.397924, 26.715352],
  [58.398167, 26.716014],
  [58.398091, 26.716111],
  [58.397867, 26.715426],
  [58.397924, 26.715352]
];
</script>

<template>
    <button class="button is-primary" @click="coords=homeCoords">Go to home</button>
    <button class="button is-primary" @click="coords=tartuCoords">Go to Tartu</button>
    <input type="range" min="1" max="19" step="1" v-model="zoom">
    <LeafletMap 
        :center="coords" 
        :zoom="zoom"
        :marker="homeCoords"
        :polygon="homePolygon"
    ></LeafletMap>
</template>