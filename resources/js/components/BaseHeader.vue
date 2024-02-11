<template>
  <header
    class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom"
  >
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
        <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><RouterLink to="/" class="nav-link px-2 link-secondary">Home</RouterLink></li>
      <li><a href="#" class="nav-link px-2">Transactions</a></li>
    </ul>

    <div class="col-md-3 text-end d-flex justify-content-end align-items-center">
      <template v-if="usersStore.userData">
        <h4 class="mb-0 me-3">Hello, {{ usersStore.userData.name }}!</h4>
        <button class="btn btn-primary" type="button" @click="signOut">Sign out</button>
      </template>
      <template v-else>
        <RouterLink to="/login" type="button" class="btn btn-outline-primary me-2">Login</RouterLink>
        <RouterLink to="/sign-up" type="button" class="btn btn-primary">Sign-up</RouterLink>
      </template>
    </div>
  </header>
</template>

<script setup>
import { useUsersStore } from '@/store/users';
import { useRouter } from 'vue-router';

const usersStore = useUsersStore();
const router = useRouter();

async function signOut() {
  await usersStore.logout();
  router.push({ name: 'login' });
}
</script>
