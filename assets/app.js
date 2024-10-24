import { createApp } from 'vue';
import Hello from './vue/controllers/Hello.vue';  // Adjust path if necessary
import Content from './vue/controllers/Content.vue';
const app = createApp({
  components: {
    Hello,   // Register your Hello component
    Content,
  }

});
const mainContent = createApp({
  components: {
    // Register your Hello component
  }

});

app.mount('#app');  // Mount it on the div with id 'app'
//mainContent.mount('#mainContent');