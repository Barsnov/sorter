<template>
  <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="d-flex align-items-center justify-content-center flex-column">
      <div v-for="game in games">
        <RouterLink :to="{path: '/game/'+game.id}" class="btn btn-primary fs-3" style="width: 300px; height:120px;">
          {{ game.title }}
        </RouterLink>
      </div>
    </div>
  </div>
  <router-view></router-view>
  </template>

  <script>
  import axios from 'axios'
  import { RouterLink, RouterView } from 'vue-router';
  export default {
    data() {
      return {
        games:[],
      };
    },
    methods: {
      getGames(){
        axios.get(`${import.meta.env.VITE_API_URL}/api/games`).then(res => {
          this.games = res.data;
        });
      },
      GamePage(id){
        console.log(id);
      }
    },
    mounted() {
      this.getGames();
    },
  };
  </script>
  <style scoped></style>
