<script>
export default {
  name: "Hello",
  props: {

  },
  data(){
    return {
      menuList: [
        { id: 0, text: 'HOME' },
        { id: 1, text: 'ABOUT' },
        { id: 2, text: 'SERVICES' },
        { id: 3, text: 'CONTACT' },
        { id: 4, text: 'CONTACT US' }

    ]
    }
  }
}
</script>


<template>
  <div class="menuList">
    <a href="/">
      <img src="../../images/logo (1) — kopia.png" alt="MajcaEasyWayLogo">
    </a>
    <div class="menuLinks">
      <div class="card" v-for="item in menuList" ref="items"  >
        <div class="front">
          <span>
            {{ item.text }} 
          </span>
        </div>
        <div class="back">
          <span >
            {{ item.text }} 
          </span>
        </div>
        
      </div>  
    </div>
  </div>
</template>


<style>
        
  @media screen and (max-width: 500px) {
    body {
      display: flex;
      justify-content: center;
      align-items: center;
  }
}


</style>



