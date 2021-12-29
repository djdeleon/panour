<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <v-card>
        <v-card-title class="text-h5 text-red-600 justify-center lighten-2">
          No Results Found
        </v-card-title>

        <v-divider></v-divider>

        <v-card-text class="mt-5">
          <p class="text-lg tracking-wider">
            Sorry! No Results found for <span class="text-red-400">{{ selectedCategory }} in {{ selectedCity }}</span>
          </p>
          <p>Redirecting you back to the homepage...</p>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  props: {
		dialog: Boolean,
		selectedCity: String,
		selectedCategory: String,
	},
};
</script>
