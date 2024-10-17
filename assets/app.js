import { createApp } from 'vue';
import Hello from './vue/controllers/Hello.vue';  // Adjust path if necessary

const app = createApp({
  components: {
    Hello,   // Register your Hello component
  }
  
});

app.mount('#app');  // Mount it on the div with id 'app'
