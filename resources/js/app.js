require('./bootstrap');

import { createApp } from 'vue'
import App from './components/app.vue';

import Toaster from "@meforma/vue-toaster";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faPlay, faPlusSquare, faTrash } from "@fortawesome/free-solid-svg-icons";

library.add(faPlay);
library.add(faPlusSquare);
library.add(faTrash);

const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(Toaster, {
    position: "top-right",
  });
app.mount("#app");
