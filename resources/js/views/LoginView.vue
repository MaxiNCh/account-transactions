<template>
  <div class="login-form text-center w-100 m-auto">
    <form @submit.prevent="submitForm">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating my-2">
        <input
          v-model="form.email"
          type="email"
          class="form-control"
          id="floatingInput"
          placeholder="name@example.com"
        />
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating my-2">
        <input
          v-model="form.password"
          type="password"
          class="form-control"
          id="floatingPassword"
          placeholder="Password"
        />
        <label for="floatingPassword">Password</label>
      </div>

      <div v-if="error" class="text-danger">
        {{ error }}
      </div>

      <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Sign in</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useUsersStore } from '@/store/users';

const router = useRouter();
const usersStore = useUsersStore();

const form = {
  email: '',
  password: ''
};

let error = ref(null);

async function submitForm() {
  error.value = null;
  try {
    await usersStore.login(form);
    await usersStore.getUser();
    router.push({ name: 'home' });
  } catch (e) {
    error.value = e.message;
  }
}
</script>

<style lang="scss" scoped>
.login-form {
  max-width: 330px;
}
</style>
