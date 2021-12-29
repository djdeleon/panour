<template>
  <div>
    <v-container fluid class="text-center">
      <v-row>
        <v-col>
          <div class="text-4xl text-bold">
            <div class="flex justify-center">
              <v-img :src="panourLogo" max-width="326"></v-img>
            </div>
          </div>
          <div class="mt-1 mb-8 text-gray-500 tracking-widest text-base">
            {{ name }} is a simple map-based web application that provides
            travel information exclusively for people visiting Japan for the
            first time.
          </div>
          <div>
            <div class="mb-2">
              <div class="text-red-500 tracking-widest font-medium text-xl">
                I'm looking for
              </div>
            </div>
            <div class="ml-3 mr-3">
              <v-select
                color="#ff1919"
                item-color="#ff1919"
                v-model="selectedCategory"
                :items="getCategoryNames"
                item-text="name"
                item-value="name"
              >
                <template v-slot:selection="{ item }">
                  <span class="d-flex justify-center" style="width: 100%">
                    {{ item }}
                  </span>
                </template>
              </v-select>
            </div>
            <div class="mb-2 mr-7">
              <div class="text-red-500 tracking-widest font-medium text-xl">
                in
              </div>
            </div>
            <div class="ml-3 mr-5">
              <v-select
                color="#ff1919"
                item-color="#ff1919"
                v-model="selectedCity"
                :items="getCityNames"
                item-text="name"
                item-value="name"
              >
                <template v-slot:selection="{ item }">
                  <span class="d-flex justify-center" style="width: 100%">
                    {{ item }}
                  </span>
                </template>
              </v-select>
            </div>
            <div>
              <v-btn
                @click="handleExplorePlaces()"
                class="white--text mr-5"
                color="#ff1919"
                :loading="isLoading"
                :disabled="isLoading"
              >
                Explore
                <v-icon dark right> mdi-magnify </v-icon>
              </v-btn>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <NoResultsFound
      :dialog="dialog"
      :selectedCity="selectedCity"
      :selectedCategory="selectedCategory"
    />
  </div>
</template>

<script>
import PlaceService from "../../services/PlaceService";
import NoResultsFound from "../Search/NoResultsFound";

export default {
  components: {
    NoResultsFound,
  },
  props: {
    name: String,
    cities: Array,
    categories: Array,
  },
  data() {
    return {
      marker: true,
      dialog: false,
      isLoading: false,
      updatedPlaces: [],
      selectedCity: "Tokyo",
      selectedCategory: "Food",
      panourLogo: "../../images/Panour.jpg",
    };
  },
  methods: {
    toggleMarker() {
      this.marker = !this.marker;
    },
    redirectHomepage() {
      this.dialog = true;

      setTimeout(function () {
        this.dialog = false;
        history.go();
      }, 5000);
    },
    handleExplorePlaces() {
      this.$emit("updateLoadingState", true);
      this.isLoading = true;
      this.getPlaces();
      this.$emit("updateInfoWindowState", false);
    },
    getPlaces() {
      PlaceService.getPlaces(this.selectedCategory, this.selectedCity)
        .then((response) => {
          if (response.data.results.length === 0) this.redirectHomepage();
          this.updatedPlaces = response.data;
          this.updatedPlaces.results.forEach((item, index) => {
            this.attachedPlacePhotos(item.fsq_id, index);
          });
        })
        .catch(() => history.go());
    },
    attachedPlacePhotos(id, index) {
      PlaceService.getPlacePhotos(id)
        .then((response) => {
          this.updatedPlaces.results[index].photos = response.data;
          this.$emit("updatePlaces", this.updatedPlaces);
          this.isLoading = false;
          this.$emit("updateLoadingState", false);
        })
        .catch(() => history.go());
    },
  },
  computed: {
    getCityNames() {
      return this.cities.map((city) => city.name);
    },
    getCategoryNames() {
      return this.categories.map((city) => city.name);
    },
  },
};
</script>

<style>
.v-list-item__title:hover {
  color: #ff1919 !important;
}

.v-list .v-list-item--active {
  background-color: #ff1919 !important;
}

.v-list .v-list-item--active .v-list-item__title {
  color: white !important;
}
</style>
