<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card v-for="item in list" :key="item.id" class="bg-blue text-white">
      <q-card-section style="max-width: 80vw">
        <div class="text-h6">{{ item.titre }}</div>
        <div class="text-subtitle2">{{ item.description }}</div>
      </q-card-section>

      <q-card-actions>
        <q-btn label="Modifier" @click="modify(item)" flat />
        <q-btn label="Supprimer" @click="removeInlist(item)" flat />
      </q-card-actions>
    </q-card>

    <q-card class="bg-green text-white">
      <q-card-actions>
        <q-btn label="Ajouter une tâche" @click="add = true" flat />
      </q-card-actions>
    </q-card>

    <q-dialog v-model="modifyModal" persistent="persistent">
      <q-card style="width: 500px; max-width: 80vw">
        <q-form @submit="getModify()" class="q-gutter-md">
          <q-card-section>
            <div class="text-h6">Modifier votre tâche</div>
          </q-card-section>

          <q-card-section class="q-pt-none">
            <div class="q-gutter-y-md column">
              <q-input
                maxlength="25"
                counter
                filled
                autogrow
                lazy-rules
                v-model="item.titre"
                label="Titre"
                :rules="[
                  (val) =>
                    (val && val.length > 0 && val !== ' ' && val.length) ||
                    'Veuillez entrer un titre',
                ]"
              />
              <q-input
                filled
                autogrow
                lazy-rules
                v-model="item.description"
                label="Description"
                :rules="[
                  (val) =>
                    (val && val.length > 0 && val !== ' ') ||
                    'Veuillez entrer une description',
                ]"
              />
            </div>
          </q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="Annuler" color="primary" @click="close()" />
            <q-btn flat label="Modifier" type="submit" color="primary" />
          </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>

    <q-dialog v-model="add">
      <q-card style="width: 500px; max-width: 80vw">
        <q-form @submit="addInlist()" class="q-gutter-md">
          <q-card-section>
            <div class="text-h6">Ajouter une tâche a votre liste</div>
          </q-card-section>

          <q-card-section class="q-pt-none">
            <div class="q-gutter-y-md column">
              <q-input
                maxlength="25"
                counter
                autogrow
                lazy-rules
                :rules="[
                  (val) =>
                    (val && val.length > 0 && val !== ' ') ||
                    'Veuillez entrer un titre',
                ]"
                filled
                v-model="item.titre"
                label="Titre"
              />
              <q-input
                autogrow
                lazy-rules
                :rules="[
                  (val) =>
                    (val && val.length > 0 && val !== ' ') ||
                    'Veuillez entrer un commentaire',
                ]"
                filled
                v-model="item.description"
                label="Description"
              />
            </div>
          </q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="Ajouter" type="submit" color="primary" />
          </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
  </div>
</template>

<style></style>

<script>
import { useQuasar } from "quasar";
import { ref } from "vue";

export default {
  name: "ToDoList",
  data() {
    return {
      list: [],
      item: {
        id: null,
        titre: null,
        description: null,
      },
    };
  },
  setup() {
    const $q = useQuasar();

    return {
      showNotif(message, color, position) {
        $q.notify({
          message: message,
          color: color,
          position: position,
        });
      },
      modifyModal: ref(false),
      add: ref(false),
      persistent: ref(true),
    };
  },
  beforeMount() {
    this.getList();
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
    modify(item) {
      this.modifyModal = true;
      this.item = item;
    },
    async close() {
      this.item = {};
      this.modifyModal = false;
      await this.getList();
    },
    async getList() {
      const request = new Request("/list", this.getConfig("GET", false));
      const res = await fetch(request);
      const list = await res.json();
      this.list = list;
    },
    async getModify() {
      if (this.item.titre.length && this.item.description.length) {
        this.showNotif("Tâche modifié !", "green", "bottom-right");
        this.list = this.list.filter((elem) => elem.id !== this.item.id);
        this.list.push(this.item);
        const request = new Request(
          "/update",
          this.getConfig("POST", this.list)
        );
        const res = await fetch(request);
        if (res) {
          this.item = {};
          this.modifyModal = false;
        }
      }
    },
    async addInlist() {
      if (this.item.titre !== null && this.item.description !== null) {
        this.showNotif("Tâche ajouté !", "green", "bottom-right");
        this.add = false;
        this.item.id = this.list.length;
        this.list.push(this.item);
        const request = new Request(
          "/update",
          this.getConfig("POST", this.list)
        );
        await fetch(request);
        this.item = {};
      }
    },
    async removeInlist(item) {
      this.showNotif("Tâche supprimé !", "green", "bottom-right");
      this.list = this.list.filter((elem) => elem.id !== item.id);
      const request = new Request("/update", this.getConfig("POST", this.list));
      await fetch(request);
    },
  },
  props: {
    outlined: {
      type: Boolean,
      default: true,
    },
    dense: {
      type: Boolean,
      default: true,
    },
  },
};
</script>
