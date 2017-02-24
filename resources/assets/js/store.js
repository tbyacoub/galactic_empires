import Vuex from 'vuex'

import Vue from 'vue'

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
        planets: [],
        index: 0,
    },
    getters: {
        getPlanets(state){
            return state.planets;
        },
        getName(state) {
            return state.planets[state.index].name;
        },
        getMetal(state){
            return (100 - (state.planets[state.index].resources.metal/99999)*100) + '%';
        },
        getCrystal(state){
            return (100 - (state.planets[state.index].resources.crystal/99999)*100) + '%';
        },
        getEnergy(state){
            return (100 - (state.planets[state.index].resources.energy/99999)*100) + '%';
        },
        render(state){
            return state.planets.length > 0;
        }
    },
    mutations: {
        // sync actions
        SET_PLANETS(state, planets) {
            state.planets = planets;
        },
        SET_PLANET(state, index) {
            state.index = index;
        }
    },
    actions: {
        // async actions
    }

});
