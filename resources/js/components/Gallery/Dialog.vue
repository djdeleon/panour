<template>
  <div>
    <v-dialog transition="dialog-bottom-transition" max-width="600">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-bind="attrs"
          v-on="on"
          elevation="1"
          class="red--text"
          small
          outlined
        >
          Gallery
        </v-btn>
      </template>
      <template v-slot:default="dialog">
        <GalleryCards :dialog="dialog" :activePlace="activePlace" />
      </template>
    </v-dialog>
  </div>
</template>

<script>
import GalleryCards from "./Cards";

export default {
  components: {
    GalleryCards,
  },
  props: {
    activePlace: Object,
  },
};
</script>
