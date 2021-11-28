import axios from "axios";
import {StatusCodes} from "http-status-codes";
import {apiConfig} from "../../../../../utils/settings";
import {store} from "../../../../../utils/window-static-store";

const state = () => ({
  cart: {},
  staticStore: {
    url: {
      apiCart: store.urlCart
    }
  }
});

const getters = {

}

const actions = {
  async getCart({state, commit}) {
    const url = state.staticStore.url.apiCart;
    const result = await axios.get(url, apiConfig);

    if (result.data && result.status === StatusCodes.OK) {
      commit('setCart', result.data['hydra:member']);
      console.log(state.cart)
    }
  }
}

const mutations = {
  setCart(state, cart) {
    state.cart = cart;
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}