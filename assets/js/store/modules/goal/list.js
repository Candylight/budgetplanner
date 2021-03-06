import fetch from '../../../utils/fetch';
import {
  GOAL_LIST_ERROR,
  GOAL_LIST_LOADING,
  GOAL_LIST_RESET,
  GOAL_LIST_VIEW,
  GOAL_LIST_SUCCESS
} from './mutation-types';

const state = {
  loading: false,
  error: '',
  items: [],
  view: []
};

function error(error) {
  return {type: GOAL_LIST_ERROR, error};
}

function loading(loading) {
  return {type: GOAL_LIST_LOADING, loading};
}

function success(items) {
  return {type: GOAL_LIST_SUCCESS, items};
}

function view(items) {
  return { type: GOAL_LIST_VIEW, items};
}

const getters = {
  error: state => state.error,
  items: state => state.items,
  loading: state => state.loading,
  view: state => state.view
};

const actions = {
    getItems({ commit }, page = '/goals') {
      commit(loading(true));

      fetch(page)
        .then(response => response.json())
        .then(data => {
          commit(loading(false));
          commit(success(data['hydra:member']));
          commit(view(data['hydra:view']));
        })
        .catch(e => {
          commit(loading(false));
          commit(error(e.message));
        });
    }
};

const mutations = {
    [GOAL_LIST_ERROR] (state, payload) {
      state.error = payload.error;
    },
    [GOAL_LIST_LOADING] (state, payload) {
      state.loading = payload.loading;
    },
    [GOAL_LIST_VIEW] (state, payload) {
      state.view = payload.items;
    },
    [GOAL_LIST_SUCCESS] (state, payload) {
      state.items = payload.items;
    },
    [GOAL_LIST_RESET] (state) {
      state.items = [];
    }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
