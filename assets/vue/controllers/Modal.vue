<template>
  <button id="show-modal" @click="showModal = true">Avatary</button>
  <Modal_1 :show="showModal" @childToParent="updateFavorite" @close="showModal = false">
    <template #header>
      <h3>Custom Header</h3>
    </template>
  </Modal_1>
  <p>Selected Names: {{ checkedNames }}</p><br>
  <label for="registration_form_imageName">Image name</label>
  <input 
    type="text" 
    v-model="imageName" 
    class="vue-input" 
    @input="updateSymfonyField"
    name="registration_form[imageName]" 
    maxlength="20"
  />
</template>

<script>
import Modal_1 from './Modal_1.vue';

export default {
  name: "Modal",
  components: {
    Modal_1,
  },
  data() {
    return {
      showModal: false,
      checkedNames: [], // Tablica
      imageName: '', // Ciąg
    };
  },
  methods: {
    updateFavorite(data) {
  console.log('Data received from Modal_1:', data);

  if (Array.isArray(data)) {
    this.checkedNames = data; // Jeśli dane to tablica
    this.imageName = this.checkedNames.join(', '); // Połącz w string
  } else if (typeof data === 'string') {
    this.checkedNames = [data]; // Jeśli dane to string, zamień na tablicę
    this.imageName = data; // Ustaw wartość `imageName` na string
  } else {
    console.error('Data received is not an array or string:', data);
  }

  setTimeout(() => {
  this.updateSymfonyField();
}, 1000); // 100 ms opóźnienia
},

updateSymfonyField() {


  const symfonyField = document.querySelector('#symfony-image-name'); // Szuka elementu po ID
  if (symfonyField) {
    symfonyField.value = this.imageName; // Ustawia wartość
    symfonyField.dispatchEvent(new Event('input', { bubbles: true })); // Informuje Symfony o zmianie
    console.log("Symfony field updated:", symfonyField.value);
  } else {
    console.error("Symfony field not found");
  }
}


},
watch: {
  checkedNames(newValue) {
    if (Array.isArray(newValue)) {
      this.imageName = newValue.join(', '); // Ustawia imageName jako połączone wartości
      this.updateSymfonyField(); // Synchronizuje pole Symfony
    } else {
      console.error("Expected an array, but got:", newValue);
    }
  }
}

};
</script>
