<template>
  <div>
    <gmap-info-window
      :opened="infoWindowOpened"
      :options="infoWindowOptions"
      :position="infoWindowPosition"
      @closeclick="handleInfoWindowClose"
    >
      <v-card v-if="activePlace" max-width="250">
        <v-img
          :src="setImageSize(activePlace.photos[0], '200')"
          :lazy-src="setImageSize(activePlace.photos[0], '10')"
          height="100px"
          dark
        ></v-img>
        <v-list two-line>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title class="text-red-600 font-semibold">
                <strong>
                  {{ activePlace.name }}
                </strong>
              </v-list-item-title>
              <v-list-item-subtitle>
                {{ activePlace.categories[0].name }}
              </v-list-item-subtitle>
              <p class="text-xs text-gray-500">
                {{ activePlace.location.region }},
                {{ activePlace.location.locality }}
                {{ activePlace.location.postcode }}
              </p>
              <div class="md:flex md:items-center justify-around md:mt-4">
                <WeatherDialog
                  :weather="weather"
                  :activePlace="activePlace"
                  @updateWeather="updateWeather($event)"
                />
                <GalleryDialog 
                  :activePlace="activePlace" 
                />
              </div>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card>
    </gmap-info-window>
  </div>
</template>

<script>
import WeatherDialog from "../Weather/Dialog";
import GalleryDialog from "../Gallery/Dialog";

export default {
  components: {
    WeatherDialog,
    GalleryDialog,
  },
  props: {
    activePlace: Object,
    infoWindowOpened: Boolean,
    infoWindowOptions: Object,
    infoWindowPosition: Object,
  },
  data() {
    return {
      weather: {},
    };
  },
  methods: {
    handleInfoWindowClose() {
      this.$emit("updateInfoWindowStateMap", false);
      this.activePlace = null;
      this.infoWindowOpened = false;
    },
    updateWeather(event) {
      this.weather = event;
    },
  },
};
</script>
