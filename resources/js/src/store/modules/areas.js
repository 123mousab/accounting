let token = localStorage.getItem('token') || null;

let state = {
    data: [],
    row: {},
}

let actions = {
    /* eslint-disable */
    getData({ commit }, params) {
        return new Promise((resolve, reject) => {
            window.axios.defaults.headers.common = {
                'Authorization': 'Berear ' + token,
            }
            window.axios.get(`
            ${window.hostUrl}${params.resource}
            `).then((response) => {
                commit('setData', response.data);
                resolve(response);
            }).catch((error) => { reject(error) })
        });
    },

    showData({ commit }, params) {
        return new Promise((resolve, reject) => {
            if (token) {
                window.axios.defaults.headers.common = {
                    'Authorization': 'Berear ' + token,

                }
            }
            window.axios.get(`${window.hostUrl}${params.resource}/${params.id}`).then((response) => {
                commit('setRow', response.data);
                resolve(response);
            }).catch((error) => { reject(error) })
        });
    },

    postData({ commit }, params) {
        return new Promise((resolve, reject) => {
            if (token) {
                window.axios.defaults.headers.common = {
                    'Authorization': 'Berear ' + token,

                }
            }
            window.axios.post(`${window.hostUrl}${params.resource}`, params.inputs).then((response) => {
                resolve(response);
            }).catch((error) => { reject(error) })
        });
    },

    putData({ commit }, params) {
        return new Promise((resolve, reject) => {
            if (token) {
                window.axios.defaults.headers.common = {
                    'Authorization': 'Berear ' + token,

                }
            }
            window.axios.put(`${window.hostUrl}${params.resource}/${params.id}`, params.inputs).then((response) => {
                // commit('setData', response.data);
                resolve(response);
            }).catch((error) => { reject(error) })
        });
    },

    delData({ commit }, params) {
        return new Promise((resolve, reject) => {
            if (token) {
                window.axios.defaults.headers.common = {
                    'Authorization': 'Berear ' + token,

                }
            }
            window.axios.delete(`${window.hostUrl}${params.resource}/${params.id}`).then((response) => {
                commit('removeRow', params.id);
                resolve(response);
            }).catch((error) => { reject(error) })
        });
    },
}

let mutations = {
    setData: (state, res) => {
        state.data = res;
    },

    setRow: (state, res) => {
        state.row = res;
    },

    removeRow: (state, id) => {
        const rowId = state.data.findIndex((i) => i.id === id);
        state.data.splice(rowId, 1)
    }

}


export default {
    namespaced: true,
    state: state,
    actions: actions,
    mutations: mutations,
}
