<template>
  <q-btn stretch flat label="Inscription" @click="openSignup()" />
  <q-dialog v-model="modifyModal">
    <q-card style="width: 500px; max-width: 80vw">
      <q-form @submit="signup()" class="q-gutter-md">
        <q-card-section>
          <div class="text-h6 flex flex-center">Inscription</div>
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
                  val === 'test' ||
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
                  val === 'test' ||
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
          <q-btn autogrow label="Inscription" type="submit" color="green" />
        </q-card-actions>
      </q-form>
    </q-card>
  </q-dialog>
</template>

<script>
import { ref } from "vue";

export default {
  name: "Signup",
  data() {
    return {
      user: {
        email: null,
        password: null,
      },
    };
  },
  setup() {
    return {
      modifyModal: ref(false),
      isPwd: ref(true),
    };
  },
  methods: {
    getConfig(method, body) {
      if (body) {
        return {
          headers: { "Content-Type": "application/json" },
          method: method,
          mode: "cors",
          cache: "default",
          body: JSON.stringify(body),
        };
      } else {
        return {
          method: method,
          mode: "cors",
          cache: "default",
        };
      }
    },
    openSignup() {
      this.modifyModal = true;
    },
    async signup() {
      const request = new Request(
        "/api/user",
        this.getConfig("POST", this.list)
      );
      const result = await fetch(request);
      console.log(result);
    },
  },
};
</script>
