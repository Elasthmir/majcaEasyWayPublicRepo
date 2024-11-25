import { createApp } from 'vue';
import Hello from './vue/controllers/Hello.vue';  // Adjust path if necessary
import Content from './vue/controllers/Content.vue';
import Modal from './vue/controllers/Modal.vue';
import Quizz from './vue/controllers/Quizz.vue';
const app = createApp({
  components: {
    Hello,   // Register your Hello component
    Content,
    Modal,
    Quizz
  }

});
const mainContent = createApp({
  components: {
    Quizz
  }

});

app.mount('#app');  // Mount it on the div with id 'app'
mainContent.mount('#mainContent');