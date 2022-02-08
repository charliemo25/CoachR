<template>
  <q-btn
    stretch
    flat
    label="Déconnexion"
    @click="logout()"
    v-if="user !== 'null'"
  />
</template>

<script>
import { ref } from "vue";
import { useQuasar } from "quasar";

export default {
  name: "Logout",
  props:['user'],
  setup() {
    const $q = useQuasar();

    return {
      modifyModal: ref(false),
      isPwd: ref(true),
      showNotif(message, color, position) {
        $q.notify({
          message: message,
          color: color,
          position: position,
        });
      },
    };
  },
  methods: {
    logout() {
      console.log(localStorage);
      localStorage.removeItem('user');
      this.showNotif("Déconnecté !", "green", "bottom-right");
      this.$router.push('/')
    },
  },
  // persist() {

  //   console.log("logged");
  // },
};
</script>
