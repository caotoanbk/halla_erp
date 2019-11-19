import Vue from 'vue'
import Vuex from 'vuex'
import VuexORM from '@vuex-orm/core'
import Purchase from '../classes/Purchase'

Vue.use(Vuex)

const database = new VuexORM.Database()

database.register(Purchase)


export default new Vuex.Store({
  plugins: [VuexORM.install(database)]
})