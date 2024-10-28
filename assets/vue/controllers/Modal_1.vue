<style>
.modal-mask {
  position: fixed;

  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  transition: opacity 0.3s ease;
  color: #42b983;
}

.modal-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  width: 300px;
  margin: auto;
  padding: 20px 30px;
  background-color: #000;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  transform: scale(1.1);
}
label{
  color: #42b983;
}
.imagAndBox{
  display: flex;
  flex-direction: row;
}
</style>


<template>
  <Transition name="modal">
    <div v-if="show" class="modal-mask">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header">Default Header</slot>
        </div>
        
        <div class="imagAndBox">
          <input type="radio" id="jack" value="ava1" v-model="checkedNames" />
          <img src="../../images/avatars/ava1.png" alt="">
        </div>
        <div class="imagAndBox">
          <input type="radio" id="john" value="ava2" v-model="checkedNames" />
          <img src="../../images/avatars/ava2.png" alt="">
        </div>
        <div class="imagAndBox">
          <input type="radio" id="mike" value="Mike" v-model="checkedNames" />
          <label for="mike">Mike</label>
        </div>


        <div class="modal-body">
          <slot name="body">Default Body</slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            Default Footer
            <button class="modal-default-button" @click="$emit('close')">OK</button>
          </slot>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script>
export default {
  name: "Modal_1",
  props: {
    show: Boolean
  },
  data() {
    return {
      checkedNames: []
    }
  },
  watch: {
    checkedNames(newVal) {
      this.$emit("childToParent", newVal); // Emit checkedNames to parent when updated
    }
  },
}
</script>

