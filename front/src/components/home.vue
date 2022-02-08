<template>
  <q-page padding>
    <h1 class="flex flex-center">Welcome</h1>

    <div class="flex flex-center">
      <p v-for="n in 5" :key="n">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil
        praesentium molestias a adipisci, dolore vitae odit, quidem consequatur
        optio voluptates asperiores pariatur eos numquam rerum delectus commodi
        perferendis voluptate?
      </p>
    </div>

    <div class="q-pa-md q-gutter-sd">
      <div class="row justify-between">
        <q-parallax
          :speed="0.6"
          src="https://media.gqmagazine.fr/photos/5f27c9550bc2e326afb66fda/master/pass/GettyImages-1084251084portada.jpg"
        >
          <h1 class="text-white">Basic</h1>
        </q-parallax>
      </div>
    </div>

    <div class="flex flex-center">
      <p v-for="n in 15" :key="n">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil
        praesentium molestias a adipisci, dolore vitae odit, quidem consequatur
        optio voluptates asperiores pariatur eos numquam rerum delectus commodi
        perferendis voluptate?
      </p>
    </div>
  </q-page>
</template>

<style></style>

<script>
import { useMeta, useQuasar } from "quasar";
import { ref } from "vue";

const metaData = {
  // sets document title
  title: "Home",
  // optional; sets final title as "Index Page - My Website", useful for multiple level meta
  // titleTemplate: title => `${title} - My Website`,

  // meta tags
  meta: {
    // description: { name: "description", content: "Page 1" },
    // keywords: { name: "keywords", content: "Quasar website" },
    equiv: {
      "http-equiv": "Content-Type",
      content: "text/html; charset=UTF-8",
    },
    // note: for Open Graph type metadata you will need to use SSR, to ensure page is rendered by the server
    ogTitle: {
      property: "og:title",
      // optional; similar to titleTemplate, but allows templating with other meta properties
      template(ogTitle) {
        return `${ogTitle}`;
      },
    },
  },

  // CSS tags
  link: {
    material: {
      rel: "stylesheet",
      href: "https://fonts.googleapis.com/icon?family=Material+Icons",
    },
  },

  // JS tags
  script: {
    ldJson: {
      type: "application/ld+json",
      innerHTML: `{ "@context": "http://schema.org" }`,
    },
  },

  // <html> attributes
  htmlAttr: {
    "xmlns:cc": "http://creativecommons.org/ns#", // generates <html xmlns:cc="http://creativecommons.org/ns#">,
    empty: undefined, // generates <html empty>
  },

  // <body> attributes
  bodyAttr: {
    "action-scope": "xyz", // generates <body action-scope="xyz">
    empty: undefined, // generates <body empty>
  },

  // <noscript> tags
  noscript: {
    default: "This is content for browsers with no JS (or disabled JS)",
  },
};

export default {
  name: "Home",
  setup() {
    const $q = useQuasar();
    useMeta(metaData);
    return {
      dark: $q.dark,
      drawer: ref(false),
      miniState: ref(true),
    };
  },
};
</script>
