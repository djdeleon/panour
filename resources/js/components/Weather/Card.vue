<template>
  <v-card>
    <v-card-text>
      <v-row class="mt-5">
        <v-card class="mx-auto" max-width="400">
          <v-list-item two-line>
            <v-list-item-content>
              <v-list-item-title class="text-h5 text-red-600 font-semibold">
                {{ activePlace.location.locality }},
                {{ activePlace.location.region }}
              </v-list-item-title>
              <v-list-item-subtitle
                class="mt-2"
                v-if="weather.current !== undefined"
              >
                {{ weather.current.weather[0].main }}
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-card-text>
            <v-row align="center">
              <v-col
                v-if="weather.current !== undefined"
                class="text-h2"
                cols="12"
              >
                {{ weather.current.temp }}&deg;C
                <v-icon large>
                  {{
                    weather.current.weather[0].main === "Clouds"
                      ? "mdi-cloud"
                      : "mdi-white-balance-sunny"
                  }}
                </v-icon>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-row>
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn
        class="mb-2"
        color="#ff1919"
        dark
        small
        @click="dialog.value = false"
      >
        Close
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    dialog: Object,
    weather: Object,
    activePlace: Object,
  },
};
</script>
