<script>
export default {
  name: "Hello",
  props: {
    name: {
      type: String,
      required: true
    }
  },
  data(){
    return {
      list: [1, 2, 3]
    }
  }
}
</script>


<template>
  <div>
    bye {{ name }}
    <li v-for="item in list" ref="items">
      {{ item }}
    </li>
  </div>
</template>

