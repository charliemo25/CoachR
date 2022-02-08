<template>
  <q-chip>
    <q-avatar>
      <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
    </q-avatar>
    {{ user ? user.email : null }}
  </q-chip>
</template>

<script>
import { ref } from "vue";
import { useQuasar } from "quasar";

export default {
  name: "Profil",
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
    openLogin() {
      this.modifyModal = true;
    },
    login() {
      localStorage.user = this.user;
      this.modifyModal = false;
      this.showNotif("Connecté !", "green", "bottom-right");
    },
  },
  // persist() {

  //   console.log("logged");
  // },
};
</script>
