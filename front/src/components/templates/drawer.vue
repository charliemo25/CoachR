<template>
  <q-drawer
    v-model="drawer"
    show-if-above
    :mini="miniState"
    @mouseover="miniState = false"
    @mouseout="miniState = true"
    :width="200"
    :breakpoint="500"
    bordered
    v-bind="dark.isActive ? dark : !dark"
  >
    <q-scroll-area class="fit">
      <q-list padding>
        <q-item clickable v-ripple to="/">
          <q-item-section avatar>
            <q-icon name="home" />
          </q-item-section>

          <q-item-section> Bienvenue ! </q-item-section>
        </q-item>

        <q-item clickable v-ripple to="/test2">
          <q-item-section avatar>
            <q-icon name="send" />
          </q-item-section>

          <q-item-section> Test 2 </q-item-section>
        </q-item>

        <q-separator />

        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="drafts" />
          </q-item-section>

          <q-item-section> Drafts </q-item-section>
        </q-item>
      </q-list>
    </q-scroll-area>
  </q-drawer>
</template>

<script>
import { useQuasar } from "quasar";
import { ref } from "vue";

export default {
  name: "Drawer",

  setup() {
    const $q = useQuasar();

    return {
      leftDrawerOpen: ref(false),
      dark: $q.dark,
      drawer: ref(false),
      miniState: ref(true),
    };
  },
};
</script>
