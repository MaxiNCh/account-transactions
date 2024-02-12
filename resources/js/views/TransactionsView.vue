<template>
  <div class="container text-center">
    <h1>Transactions</h1>

    <form class="d-flex my-4 col-3" @submit.prevent="searchTransactions">
      <input v-model="searchValue" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <div class="row mb-3">
      <div class="col-1 my-3"><strong>#</strong></div>
      <div class="col-2 my-3"><strong>Amount</strong></div>
      <div class="col-6 my-3"><strong>Note</strong></div>
      <div class="col-3 my-3"><strong>Creation date</strong></div>
      <template v-for="(transaction, index) in accountStore.transactions" :key="transaction.id">
        <div class="col-1 my-3">{{ index + 1 }}</div>
        <div class="col-2 my-3">{{ transaction.amount }}</div>
        <div class="col-6 my-3">{{ transaction.note }}</div>
        <div class="col-3 my-3">{{ formatDate(transaction.created_at) }}</div>
      </template>
    </div>
  </div>
</template>

<script setup>
import { useAccountStore } from '@/store/account';
import { formatDate } from '@/utils/date';
import { ref } from 'vue';

const accountStore = useAccountStore();
accountStore.getTransactions();

const searchValue = ref('');

function searchTransactions() {
  accountStore.getTransactions(searchValue.value);
}
</script>
