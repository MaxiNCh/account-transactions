<template>
  <div class="container text-center">
    <h1>Account</h1>

    <div class="row mt-5 mb-3">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-1 my-3"><strong>#</strong></div>
          <div class="col-md-2 my-3"><strong>Amount</strong></div>
          <div class="col-md-6 my-3"><strong>Note</strong></div>
          <div class="col-md-3 my-3"><strong>Creation date</strong></div>
          <template v-for="(transaction, index) in accountStore.lastTransactions" :key="transaction.id">
            <div class="col-md-1 my-3">{{ index + 1 }}</div>
            <div class="col-md-2 my-3">{{ transaction.amount }}</div>
            <div class="col-md-6 my-3">{{ transaction.note }}</div>
            <div class="col-md-3 my-3">{{ formatDate(transaction.created_at) }}</div>
          </template>
        </div>
      </div>
      <div class="col-md-4 themed-grid-col d-flex align-items-center justify-content-center">
        <h5>Balance: {{ accountStore.account?.balance }}</h5>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAccountStore } from '@/store/account';
import { formatDate } from '@/utils/date';
import { onBeforeUnmount } from 'vue';

const accountStore = useAccountStore();
accountStore.getAccount();
const interval = setInterval(() => accountStore.getAccount(), 10000);

onBeforeUnmount(() => clearInterval(interval));
</script>
