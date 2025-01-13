<script>
export default {
  name: "Hello",
  props: {

  },
  data(){
    return {
      menuList: [
        { id: 0, text: 'LOSUJ 1 PYTANIE' },
        { id: 1, text: 'TEST 40 PYTAŃ' },
        { id: 2, text: 'RANKINGH' },
        { id: 3, text: 'ZALOGUJ' },
        { id: 4, text: 'ZAREJESTRUJ' }

    ]
    }
  }
}
</script> 


<template>
  <div class="menuList">
    <a href="/" class="home">
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



