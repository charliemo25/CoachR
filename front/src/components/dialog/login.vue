<template>
  <q-btn stretch flat label="Connexion" @click="openLogin()" />
  <q-dialog v-model="modifyModal">
    <q-card style="width: 500px; max-width: 80vw">
      <q-form @submit="login()" class="q-gutter-md">
        <q-card-section>
          <div class="text-h6 flex flex-center">Connectez vous</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="q-gutter-y-md column">
            <q-input
              maxlength="60"
              counter
              autogrow
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0 && val !== ' ') ||
                  'Veuillez entrer un email',
              ]"
              filled
              v-model="user.email"
              label="Email"
            />

            <q-input
              v-model="user.password"
              filled
              :type="isPwd ? 'password' : 'text'"
              label="Mot de passe"
              autogrow
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0 && val !== ' ') ||
                  'Veuillez entrer un mot de passe',
              ]"
            >
              <template v-slot:append>
                <q-icon
                  :name="isPwd ? 'visibility_off' : 'visibility'"
                  class="cursor-pointer"
                  @click="isPwd = !isPwd"
                />
              </template>
            </q-input>
          </div>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn autogrow label="Connexion" type="submit" color="green" />
        </q-card-actions>
      </q-form>
    </q-card>
  </q-dialog>
</template>

<script>
import { ref } from "vue";
import { useQuasar } from "quasar";

export default {
  name: "Login",
  methods: {
    openLogin() {
      this.modifyModal = true;
    },
    login() {
      localStorage.setItem("user", JSON.stringify(this.user));
      this.modifyModal = false;
      this.showNotif("Connecté !", "green", "bottom-right");
      this.$router.push('logged')
      console.log(JSON.parse(localStorage.getItem("user")));
    },
  },
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
    };
  },
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
};
</script>
