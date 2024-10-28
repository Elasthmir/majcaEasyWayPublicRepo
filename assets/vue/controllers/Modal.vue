<template>
  <button id="show-modal" @click="showModal = true">Show Modal</button>
  <Modal_1 :show="showModal" @childToParent="updateFavorite" @close="showModal = false">
    <template #header>
      <h3>Custom Header</h3>
    </template>
  </Modal_1>
  <p>Selected Names: {{ checkedNames }}</p>
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
      checkedNames: [],
      checkedNames1: 'aaa',
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
