import { defineStore } from 'pinia';
import axios from 'axios';

export const useUsersStore = defineStore('users', {
  state: () => ({
    userData: window.userData
  }),

  getters: {
    isAuth: (state) => !!state.userData
  },

  actions: {
    async register(data) {
      try {
        await axios.post('register', data);
      } catch (error) {
        throw Error(error.response?.data?.message || error.message);
      }
    },

    async login(data) {
      try {
        await axios.post('login', data);
      } catch (error) {
        throw Error(error.response?.data?.message || error.message);
      }
    },

    async logout() {
      try {
        await axios.post('logout');
        this.userData = null;
      } catch (error) {
        throw Error(error.response?.data?.message || error.message);
      }
    },

    async getUser() {
      try {
        const response = await axios.get('user');
        if (response.status === 200) {
          this.userData = response.data;
        }
      } catch (error) {
        console.error(error.message);
      }
    }
  }
});
