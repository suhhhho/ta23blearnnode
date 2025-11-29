<script setup>
 import L from 'leaflet';
 import 'leaflet/dist/leaflet.css';
 import { onMounted, useId, watch, ref } from 'vue';
 
 delete L.Icon.Default.prototype._getIconUrl;
 L.Icon.Default.mergeOptions({
   iconRetinaUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon-2x.png',
   iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
   shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png'
 });
 
 let { center, zoom, marker, polygon } = defineProps({
   center: {
     type: Array,
     required: true
   },
   zoom: {
     type: Number,
     required: true
   },
   marker: {
     type: Array,
     default: null
   },
   polygon: {
     type: Array,
     default: () => []
   }
 });
 
 let id = 'map-' + useId();
 let map;
 let markerInstance = ref(null);
 let polygonInstance = ref(null);

 const updateMarker = (coords) => {
   if (!map) return;
   
   if (markerInstance.value) {
     map.removeLayer(markerInstance.value);
   }
   
   if (coords) {
     markerInstance.value = L.marker(coords).addTo(map);
   }
 };
 
 const updatePolygon = (points) => {
   if (!map || !points || points.length < 3) return;
   
   if (polygonInstance.value) {
     map.removeLayer(polygonInstance.value);
   }
   
   polygonInstance.value = L.polygon(points, { color: 'red' }).addTo(map);
 };

 onMounted(() => {
     console.log(document.getElementById(id));
 
     map = L.map(id).setView(center, zoom);
     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
         maxZoom: 19,
         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
     }).addTo(map);
     
     if (marker) updateMarker(marker);
     if (polygon && polygon.length > 0) updatePolygon(polygon);
 });
 
 watch(() => center, (newCenter, oldCenter) => {
     console.log(newCenter, oldCenter);
     map.panTo(newCenter);
 });
 
 watch(() => zoom, newZoom => {
     map.setZoom(newZoom);
 });
 
 watch(() => marker, (newMarker) => {
     updateMarker(newMarker);
 });
 
 watch(() => polygon, (newPolygon) => {
     updatePolygon(newPolygon);
 }, { deep: true });
 </script>
 
 <template>
      <div :id="id"></div>
 </template>
 
 <style scoped>
 div { 
     height: 40vh;
 }
 </style>