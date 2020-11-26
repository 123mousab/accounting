import Vue from 'vue'
import Vuex from 'vuex'
import state from './vuexy/state'
import getters from './vuexy/getters'
import mutations from './vuexy/mutations'
import actions from './vuexy/actions'
import modules from './modules';

Vue.use(Vuex)

export default new Vuex.Store({
  getters,
  mutations,
  state,
  actions,
  modules: { ...modules },
  strict: process.env.NODE_ENV !== 'production'
})
