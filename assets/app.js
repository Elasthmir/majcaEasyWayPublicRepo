import { createApp } from 'vue';
import Hello from './vue/controllers/Hello.vue';  // Adjust path if necessary
import Content from './vue/controllers/Content.vue';
import Modal from './vue/controllers/Modal.vue';
const app = createApp({
  components: {
    Hello,   // Register your Hello component
    Content,
    Modal,
  }

});
const mainContent = createApp({
  components: {
    // Register your Hello component
  }

});

app.mount('#app');  // Mount it on the div with id 'app'
//mainContent.mount('#mainContent');