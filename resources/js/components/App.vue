<template>
  <div class="text-center">
    <v-overlay :value="overlay" opacity="0.85">
      <v-progress-circular
        indeterminate
        size="64"
        color="#ff1919"
      ></v-progress-circular>
    </v-overlay>
    <v-app id="inspire">
      <v-main class="lighten-2">
        <v-container fluid class="grey lighten-5">
          <v-row>
            <v-col cols="12" sm="6">
              <v-card class="pa-5 pt-0" outlined tile>
                <Header
                  :name="name"
                  :places="places"
                  :cities="cities"
                  :categories="categories"
                  @updatePlaces="updatePlaces($event)"
                  @updateLoadingState="updateLoadingState($event)"
                  @updateInfoWindowState="updateInfoWindowState($event)"
                />
              </v-card>
            </v-col>
            <v-col cols="12" sm="6">
              <v-card class="pa-5" outlined tile>
                <div>
                  <v-overlay
                    :absolute="true"
                    :value="overlayMap"
                    opacity="0.75"
                  >
                    <v-progress-circular
                      indeterminate
                      size="64"
                      color="#ff1919"
                    ></v-progress-circular>
                  </v-overlay>
                  <Map
                    :places="places"
                    :closeInfoWindow="closeInfoWindow"
                    @updateInfoWindowStateMap="updateInfoWindowStateMap($event)"
                  />
                </div>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </v-app>
  </div>
</template>

<script>
import Map from "./Index/Map";
import Header from "./Index/Header";
import MainService from "../services/MainService";
import PlaceService from "../services/PlaceService";

export default {
  components: {
    Map,
    Header,
  },
  props: {
    name: String,
  },
  data() {
    return {
      cities: [],
      places: [],
      categories: [],
      overlay: true,
      overlayMap: false,
      closeInfoWindow: false,
    };
  },
  methods: {
    getCities() {
      MainService.getCities()
        .then((response) => (this.cities = response.data.data))
        .catch(() => history.go());
    },
    getCategories() {
      MainService.getCategories()
        .then((response) => (this.categories = response.data.data))
        .catch(() => history.go());
    },
    getPlaces() {
      PlaceService.getPlaces("Food", "Tokyo")
        .then((response) => {
          this.places = response.data;
          this.places.results.forEach((item, index) => {
            this.attachedPlacePhotos(item.fsq_id, index);
          });
        })
        .catch(() => history.go());
    },
    attachedPlacePhotos(id, index) {
      PlaceService.getPlacePhotos(id)
        .then((response) => {
          this.places.results[index].photos = response.data;
          this.overlay = false;
        })
        .catch(() => history.go());
    },
    updatePlaces(event) {
      this.places = event;
    },
    updateLoadingState(event) {
      this.overlayMap = event;
    },
    updateInfoWindowState(event) {
      this.closeInfoWindow = event;
    },
    updateInfoWindowStateMap(event) {
      this.closeInfoWindow = event;
    },
  },
  created() {
    this.getCities();
    this.getPlaces();
    this.getCategories();
  },
};
</script>
