import Vue from 'vue'
import Vuex from 'vuex'
import core from './core'

Vue.use(Vuex)

/*export default function () {*/
  const Store = new Vuex.Store({
    modules: {
      core
    }
  })
  //return Store
//}

export default Store;
