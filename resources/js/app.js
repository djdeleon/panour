require("./bootstrap");

import Vue from "vue";

import App from "./components/App";

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify);

import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_MAP_API_KEY,
    },
});

Vue.mixin({
  methods: {
		setImageSize(photo, size) {
			return `${photo.prefix}${size}${photo.suffix}`;
		},
  },
});

const app = new Vue({
	vuetify: new Vuetify(),
	el: "#app",
	components: { App },
});
