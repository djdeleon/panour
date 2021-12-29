<template>
  <div>
    <div class="hidden">
      {{ places.context.geo_bounds.circle.center }}
    </div>
    <gmap-map
      :center="mapCenter"
      :zoom="10"
      :options="gmapOptions"
      map-type-id="terrain"
      style="width: 100%; height: 526px"
    >
      <PlaceDetails
        :activePlace="activePlace"
        :infoWindowOpened="infoWindowOpened"
        :infoWindowPosition="infoWindowPosition"
        :infoWindowOptions="infoWindowOptions"
      />
      <gmap-marker
        v-for="place in places.results"
        :key="place.id"
        :position="getPosition(place)"
        :clickable="true"
        :draggable="false"
        @click="handleMarkerClicked(place)"
      ></gmap-marker>
    </gmap-map>
  </div>
</template>
 
<script>
import PlaceDetails from "../Place/Details";
import PlaceService from "../../services/PlaceService";

export default {
  components: {
    PlaceDetails,
  },
  props: {
    places: Object|Array,
    closeInfoWindow: Boolean,
  },
  data() {
    return {
      gmapOptions: {
        mapTypeControl: false,
        fullscreenControl: false,
      },
      infoWindowOptions: {
        pixelOffset: {
          width: 0,
          height: -35,
        },
      },
      activePlace: null,
      infoWindowOpened: false,
    };
  },
  methods: {
    getPosition(place) {
      return {
        lat: parseFloat(place.geocodes.main.latitude),
        lng: parseFloat(place.geocodes.main.longitude),
      };
    },
    handleMarkerClicked(place) {
      this.$emit("updateInfoWindowStateMap", true);
      this.getPlacePhotos(place.fsq_id);
      this.activePlace = place;
      this.infoWindowOpened = true;
    },
    getPlacePhotos(id) {
      PlaceService.getPlacePhotos(id)
        .then((response) => (this.photos = response.data))
        .catch(() => history.go());
    },
  },
  computed: {
    mapCenter() {
      return {
        lat: parseFloat(this.places.context.geo_bounds.circle.center.latitude),
        lng: parseFloat(this.places.context.geo_bounds.circle.center.longitude),
      };
    },
    infoWindowPosition() {
      if (this.activePlace) {
        return {
          lat: parseFloat(this.activePlace.geocodes.main.latitude),
          lng: parseFloat(this.activePlace.geocodes.main.longitude),
        };
      }
    },
  },
  watch: {
    closeInfoWindow(val) {
      this.infoWindowOpened = val;
    },
  },
};
</script>
