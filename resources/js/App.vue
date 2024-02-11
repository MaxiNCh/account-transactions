<template>
  <BaseLayout>
    <RouterView />
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '@/layouts/BaseLayout.vue';
import { useUsersStore } from '@/store/users';

const usersStore = useUsersStore();
usersStore.getUser();
</script>
