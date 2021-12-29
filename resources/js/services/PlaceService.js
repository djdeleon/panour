import axios from 'axios'

const apiClient = axios.create({
	baseURL: "https://api.foursquare.com/v3",
	headers: {
		Accept: "application/json",
		Authorization: process.env.MIX_FOUR_SQUARE_API_KEY,
	},
})

export default {
	getPlaces(category, city) {
		return apiClient.get(`/places/search?query=${category}&near=${city}&sort=POPULARITY`)
	},
	getPlacePhotos(id) {
		return apiClient.get(`https://api.foursquare.com/v3/places/${id}/photos`)
	},
}
