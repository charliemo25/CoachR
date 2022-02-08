import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/home.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/logged",
    name: "Logged",
    // beforeEnter: (to, from, next) => {
    //   const user = localStorage.getItem('user');
    //   if (!user) {
    //     next('/')
    //   }
    // },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../components/test2.vue"),
  },
  // otherwise redirect to home
  {
    path: "/:catchAll(.*)",
    redirect: '/',
  } 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const user = JSON.parse(localStorage.getItem("user"));
  if (user && to.path !== '/logged') {
    next('/logged');
  }
  next();
})

export default router;
