<template>
  <q-layout view="hHh Lpr lff">
    <Header :user="user" />
    <Drawer :user="user" />

    <q-page-container>
      <router-view />
      <q-page-scroller
        position="bottom-right"
        :scroll-offset="150"
        :offset="[18, 18]"
      >
        <q-btn fab icon="keyboard_arrow_up" color="primary" />
      </q-page-scroller>
    </q-page-container>
  </q-layout>
</template>

<script>
import Header from "./components/templates/header";
import Drawer from "./components/templates/drawer";

export default {
  name: "App",
  data() {
    return {
      user: JSON.parse(localStorage.getItem("user")),
    };
  },
  components: { Header, Drawer },
  setup() {
    return {
      thumbStyle: {
        right: "4px",
        borderRadius: "5px",
        backgroundColor: "#027be3",
        width: "5px",
        opacity: 0.75,
      },

      barStyle: {
        right: "2px",
        borderRadius: "9px",
        backgroundColor: "#027be3",
        width: "9px",
        opacity: 0.2,
      },
    };
  },
  mounted() {
    console.log(this.user);
  },
};
</script>
