<template>
  <button id="show-modal" @click="showModal = true">Avatary</button>
  <Modal_1 :show="showModal" @childToParent="updateFavorite" @close="showModal = false">
    <template #header>
      <h3>Custom Header</h3>
    </template>
  </Modal_1>
  <p>Selected Names: {{ checkedNames }}</p><br>
  <label for="registration_form_imageName">Image name</label>
  <input type="text" :value="checkedNames" id="registration_form_imageName" name="registration_form[imageName]" maxlength="20"/>
</template>

<script>
import Modal_1 from './Modal_1.vue';
export default {
  name: "Modal",
  components: {
    Modal_1
  },
  data() {
    return {
      showModal: false,
      checkedNames: []
    }
  },
  methods: {
    updateFavorite(data) {
      this.checkedNames = data; // Update checkedNames with data from Modal_1
    },
  },
}
</script>

<style>
/* Add any custom styles for the Modal.vue component here */
</style>
