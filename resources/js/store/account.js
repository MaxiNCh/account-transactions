import axios from 'axios';
import { defineStore } from 'pinia';

export const useAccountStore = defineStore('account', {
  state: () => ({
    account: null,
    transactions: []
  }),

  getters: {
    lastTransactions(state) {
      return state.account?.last_transactions || [];
    }
  },

  actions: {
    async getAccount() {
      try {
        const response = await axios.get('/user/account');
        this.account = response.data;
      } catch (e) {
        console.error(e);
      }
    },

    async getTransactions(search) {
      try {
        const response = await axios.get('/user/transactions', { params: { search } });
        this.transactions = response.data;
      } catch (e) {
        console.error(e);
      }
    }
  }
});
