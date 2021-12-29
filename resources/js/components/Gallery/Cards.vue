<template>
  <div>
    <v-card>
      <v-card-text>
        <div class="text-h5 pt-3 text-red-600">
          {{ activePlace.name }}
        </div>
        <v-row class="mt-3">
          <v-col
            v-for="photo in getPlacePhotos"
            :key="photo.id"
            class="d-flex child-flex"
            cols="4"
          >
            <v-img
              :src="setImageSize(photo, '500')"
              :lazy-src="setImageSize(photo, '10')"
              aspect-ratio="1"
              class="grey lighten-2"
            >
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular
                    indeterminate
                    color="grey lighten-5"
                  ></v-progress-circular>
                </v-row>
              </template>
            </v-img>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions class="justify-center">
        <v-btn
          class="mb-3"
          dark
          small
          color="#ff1919"
          @click="dialog.value = false"
        >
          Close
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
  props: {
    dialog: Object,
    activePlace: Object,
  },
  computed: {
    getPlacePhotos() {
      if (this.activePlace) {
        return this.activePlace.photos.splice(1);
      }
    },
  },
};
</script>
