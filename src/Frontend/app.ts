import Vue from "vue";
import App from "./Components/App.vue";
import Vuex from 'vuex'

// @ts-ignore
import Datepicker from "vuejs-datepicker";
Vue.component("datepicker", Datepicker);

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        activeHotel: null,
        reviews: [],
        hotels: [],
        interval: null,
        apiCalled: false
    },
    mutations: {
        setHotels(state, hotels) {
            state.hotels = hotels
        },
        setReviews(state, reviews) {
            state.reviews = reviews
        },
        setInterval(state, interval) {
            state.interval = interval
        },
        setApiCalled(state) {
            state.apiCalled = true
        },
    },
    getters: {
        getHotels(state) {
            return state.hotels
        },
        getReviews(state) {
            return state.reviews
        },
        getInterval(state) {
            return state.interval
        },
        getApiCalled(state) {
            return state.apiCalled
        }
    }
})

Vue.config.productionTip = false;

new Vue({
    store,
    render: h => h(App)
}).$mount("#app");
