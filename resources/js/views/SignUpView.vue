<template>
  <div class="login-form text-center w-100 m-auto">
    <form autocomplete="off" @submit.prevent="submitForm">
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
      <div class="form-floating my-2">
        <input v-model="form.name" type="text" id="name" class="form-control" placeholder="Your Name" />
        <label class="form-label" for="name">Your Name</label>
      </div>
      <div class="form-floating my-2">
        <input v-model="form.email" type="email" class="form-control" id="email" placeholder="name@example.com" />
        <label for="email">Email address</label>
      </div>
      <div class="form-floating my-2">
        <input
          v-model="form.password"
          type="password"
          class="form-control"
          id="password"
          placeholder="Password"
          autocomplete="new-password"
        />
        <label for="password">Password</label>
      </div>
      <div class="form-floating my-2">
        <input
          v-model="form.password_confirmation"
          type="password"
          class="form-control"
          id="repeatPassword"
          placeholder="Repeat your password"
        />
        <label for="repeatPassword">Repeat your password</label>
      </div>

      <div v-if="error" class="text-danger">
        {{ error }}
      </div>

      <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Register</button>
      <p class="text-center text-muted mt-3 mb-0">
        Have already an account? <RouterLink to="/login" class="fw-bold text-body"><u>Login here</u></RouterLink>
      </p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useUsersStore } from '@/store/users';

const router = useRouter();
const usersStore = useUsersStore();
const error = ref(null);

const form = {
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
};

async function submitForm() {
  try {
    error.value = null;
    await usersStore.register(form);
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
