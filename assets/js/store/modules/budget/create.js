import SubmissionError from '../../../error/SubmissionError';
import fetch from '../../../utils/fetch';
import {
  BUDGET_CREATE_ERROR,
  BUDGET_CREATE_LOADING,
  BUDGET_CREATE_SUCCESS,
  BUDGET_CREATE_VIOLATIONS,
  BUDGET_CREATE_RESET
} from './mutation-types';

const state = {
  loading: false,
  error: '',
  created: null
};

function error(error) {
  return {type: BUDGET_CREATE_ERROR, error};
}

function loading(loading) {
  return {type: BUDGET_CREATE_LOADING, loading};
}

function success(created) {
  return {type: BUDGET_CREATE_SUCCESS, created};
}

function violations(violations) {
  return {type: BUDGET_CREATE_VIOLATIONS, violations};
}

function reset() {
  return {type: BUDGET_CREATE_RESET};
}

const getters = {
  created: state => state.created,
  error: state => state.error,
  loading: state => state.loading,
  violations: state => state.violations,
};

const actions = {
  create({ commit }, values) {
    commit(loading(true));
    return fetch('/budgets', {method: 'POST', body: JSON.stringify(values)})
      .then(response => {
        commit(loading(false));

        return response.json();
      })
      .then(data => {
        commit(success(data));
      })
      .catch(e => {
        commit(loading(false));

        if (e instanceof SubmissionError) {
          commit(violations(e.errors));
          commit(error(e.errors._error));
          return;
        }

        commit(error(e.message));
      });
  },
  reset({ commit }) {
    commit(reset());
  }
};

const mutations = {
    [BUDGET_CREATE_ERROR] (state, payload) {
      state.error = payload.error;
    },
    [BUDGET_CREATE_LOADING] (state, payload) {
      state.loading = payload.loading;
    },
    [BUDGET_CREATE_SUCCESS] (state, payload) {
      state.created = payload.created;
    },
    [BUDGET_CREATE_VIOLATIONS] (state, payload) {
      state.violations = payload.violations;
    },
    [BUDGET_CREATE_RESET] (state) {
      state.loading = false;
      state.error = '';
      state.created = null;
      state.violations = null;
    }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
