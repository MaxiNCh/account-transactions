import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';
import TransactionsView from '@/views/TransactionsView.vue';
import SignUpView from '@/views/SignUpView.vue';
import LoginView from '@/views/LoginView.vue';
import { useUsersStore } from '@/store/users';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/transactions',
      name: 'transactiosn',
      component: TransactionsView
    },
    {
      path: '/sign-up',
      name: 'sign-up',
      component: SignUpView,
      beforeEnter: toHome
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      beforeEnter: toHome
    }
  ]
});

router.beforeEach((to) => {
  const publicPages = ['login', 'sign-up'];
  const authRequired = !publicPages.includes(to.name);
  const usersStore = useUsersStore();

  if (authRequired && !usersStore.isAuth) {
    return '/login';
  }
});

function toHome() {
  const usersStore = useUsersStore();
  if (usersStore.isAuth) {
    return '/';
  }
}

export default router;
