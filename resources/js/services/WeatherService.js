const params = {
	units: "metric",
	exclude: "hourly,daily,minutely",
	api_key: process.env.MIX_WEATHER_API_KEY,
	url_base: "https://api.openweathermap.org/data/2.5/",
}

export default {
	getPlaceWeather(lat, lon) {
		return fetch(`${params.url_base}/onecall?lat=${lat}&lon=${lon}&exclude=${params.exclude}&units=${params.units}&appid=${params.api_key}`)
	},
}
