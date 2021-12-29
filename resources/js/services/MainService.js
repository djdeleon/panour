import axios from 'axios'

const apiClient = axios.create({
    baseURL: "/api"
})

export default {
    getCities() {
        return apiClient.get("/cities")
    },
    getCategories() {
        return apiClient.get("/categories")
    },
}
