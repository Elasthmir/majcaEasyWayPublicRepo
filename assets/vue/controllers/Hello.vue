<script>
export default {
  name: "Hello",
  props: {

  },
  data() {
    return {
      menuList: [
        { id: 0, text: 'LOSUJ 1 PYTANIE', link: 'user' },
        { id: 1, text: 'TEST 40 PYTAŃ', link: 'user' },
        { id: 2, text: 'RANKING', link: 'user' },
        { id: 3, text: 'ZALOGUJ', link: 'login' },
        { id: 4, text: 'ZAREJESTRUJ', link: 'register' }

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
      <div class="card">
        <div class="front">
          <span>
            <a href="/user" class="linkInMenu">LOSUJ 1 PYTANIE</a>
          </span>
        </div>
        <div class="back">
          <span>
            <a href="/user" class="linkInMenu">LOSUJ 1 PYTANIE</a>
          </span>
        </div>
      </div>
      <div class="card">
        <div class="front">
          <span>
            <a href="/user" class="linkInMenu">TEST 40 PYTAŃ</a>
          </span>
        </div>
        <div class="back">
          <span>
            <a href="/user" class="linkInMenu">TEST 40 PYTAŃ</a>
          </span>
        </div>
      </div>
      <div class="card">
        <div class="front">
          <span>
            <a href="/user" class="linkInMenu">RANKING</a>
          </span>
        </div>
        <div class="back">
          <span>
            <a href="/user" class="linkInMenu">RANKING</a>
          </span>
        </div>
      </div>
      <div class="card">
        <div class="front">
          <span>
            <a href="/login" class="linkInMenu">ZALOGUJ</a>
          </span>
        </div>
        <div class="back">
          <span>
            <a href="/login" class="linkInMenu">ZALOGUJ</a>
          </span>
        </div>
      </div>
      <div class="card">
        <div class="front">
          <span>
            <a href="/register" class="linkInMenu">ZAREJESTRUJ</a>
          </span>
        </div>
        <div class="back">
          <span>
            <a href="/register" class="linkInMenu">ZAREJESTRUJ</a>
          </span>
        </div>
      </div>

    </div>
  </div>
</template>


<style>
.linkInMenu {
  text-decoration: none;
  color: #00d092;
}

@media screen and (max-width: 500px) {
  body {
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
