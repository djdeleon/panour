<template>
  <v-dialog transition="dialog-bottom-transition" max-width="400">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        @click="handleWeather(activePlace)"
        v-bind="attrs"
        v-on="on"
        elevation="1"
        class="red--text"
        small
        outlined
      >
        Weather
      </v-btn>
    </template>
    <template v-slot:default="dialog">
      <WeatherCard
        :dialog="dialog"
        :weather="weather"
        :activePlace="activePlace"
      />
    </template>
  </v-dialog>
</template>

<script>
import WeatherCard from "./Card.vue";
import WeatherService from "../../services/WeatherService";

export default {
  components: {
    WeatherCard,
  },
  props: {
    weather: Object,
    activePlace: Object,
  },
  methods: {
    handleWeather(place) {
      WeatherService.getPlaceWeather(
        place.geocodes.main.latitude,
        place.geocodes.main.longitude
      )
        .then((response) => response.json())
        .then((data) => {
          this.$emit("updateWeather", data);
        })
        .catch(() => history.go());
    },
  },
};
</script>
