import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
     colors:[]
  },
  mutations: {
    setColors(state, colors) {
      state.first_student = { ...student };
    },
    
  }
});

export default store;
