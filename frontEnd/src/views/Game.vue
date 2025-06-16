<template>
    <ModalFirst :titleCat="titleCat" :gameTask="gameTask" :idGame="games[0]?.game.id" :description="description" :twoDescription="twoDescription"/>
    <ModalEnd @gameTask="gameTaskFun()" :prevLink="prevLink" :endGame12="endGame12" :idGame="games[0]?.game.id" :modal="modal" :count="count" :length="length" :children="children" v-if="modal === true"/>
    <div v-if="!gameTask" class="main d-flex flex-column align-items-center justify-content-center" style="background-size: cover;">
        <div class="loading position-absolute d-flex align-items-center justify-content-center" style="height: 100vh !important; width:100%; z-index:5600; background-color:#262626;">
            <div class="spinner-border text-white" style="width:550px; height:550px; border-width:15px" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>
        <div class="DragPlaces d-flex flex-row flex-wrap align-items-center justify-content-center gap-3 col-12">
            <DragPlace @changeValue="changeValue" class="first" :gameTask="false" :idGame="games[0]?.game.id" :rightExpenses="false" :right-income="false" :length="length" v-bind:children="children" v-bind:categories="categories[0]" v-bind:list1="list1" v-bind:cat="cat1" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace @changeValue="changeValue" class="second" :gameTask="false" :idGame="games[0]?.game.id" :rightExpenses="false" :right-income="false" :length="length" v-bind:children="children" v-bind:categories="categories[1]" v-if="cat2 !== ''" v-bind:list1="list2" v-bind:cat="cat2" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace @changeValue="changeValue" class="third" :gameTask="false"  :idGame="games[0]?.game.id" :rightExpenses="false" :right-income="false" :length="length" v-bind:children="children" v-bind:categories="categories[2]" v-if="cat3 !== ''" v-bind:list1="list3" v-bind:cat="cat3" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace @changeValue="changeValue" class="fourth" :gameTask="false" :idGame="games[0]?.game.id" :rightExpenses="false" :right-income="false" :length="length" v-bind:children="children" v-bind:categories="categories[3]" v-if="cat4 !== ''" v-bind:list1="list4" v-bind:cat="cat4" :two="two" :three="three" :four="four"></DragPlace>
        </div>
        <DragWord v-if="words.length > 0" :idGame="games[0]?.game.id" v-bind:words="words" v-bind:adult="adult"/>
        <div v-if="adult" class="container-fluid d-flex justify-content-center mt-1">
            <CheckButt v-if="adult" :idGame="games[0]?.game.id" @changeValue="changeValue" v-bind:list1="list1" v-bind:list2="list2" v-bind:list3="list3" v-bind:list4="list4" v-bind:categories="categories"/>
        </div>
    </div>

    <!--Вторая задача для бухгалтеров-->
    <div v-if="gameTask" class="main d-flex flex-column align-items-center justify-content-center" style="background-size: cover;">
        <div class="loading position-absolute d-flex align-items-center justify-content-center" style="height: 100vh !important; width:100%; z-index:5600; background-color:#262626;">
            <div class="spinner-border text-white" style="width:550px; height:550px; border-width:15px" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>
        <div class="DragPlaces d-flex flex-row flex-wrap align-items-center justify-content-center gap-3 col-12">
            <DragPlace ref="dragPlaceOne" @changeValue="changeValue" :gameTask="true" class="first" :idGame="games[0]?.game.id" :rightIncome="rightIncome" :rightExpenses ="false" v-model:income="income" :length="length" v-bind:children="children" v-bind:categories="categories[0]" v-bind:list1="list1" v-bind:cat="cat1" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace ref="dragPlaceTwo" @changeValue="changeValue" :gameTask="true" class="second" :idGame="games[0]?.game.id" :rightExpenses="rightExpenses" :rightIncome="false" v-model:expenses="expenses" :length="length" v-bind:children="children" v-bind:categories="categories[1]" v-if="cat2 !== ''" v-bind:list1="list2" v-bind:cat="cat2" :two="two" :three="three" :four="four"></DragPlace>
        </div>
        <DragWord v-if="words.length > 0" :idGame="games[0]?.game.id" v-bind:words="words" v-bind:adult="adult"/>
        <div class="mb-2" style="position: absolute; z-index: 20; bottom: 6rem;">
            <div :style="games[0]?.game.id === 12 || games[0]?.game.id === 13 ? 'background-color: #57936E' : ''" class="py-3 fs-5 border border-white gap-3 d-flex align-items-center rounded px-3 py-2 mt-2">
                <label class="mb-0 fw-bold text-white" v-if="games[0]?.game.id === 12">Прибыль</label>
                <label class="mb-0 fw-bold text-white" v-if="games[0]?.game.id === 13">ИТОГО</label>
                <input type="number" class="fs-4 form-control" :class="checkProfit !== '' ? (checkProfit ? 'right' : 'wrong') : ''" v-model="profit">
            </div>
        </div>
        <div v-if="adult" :style="games[0]?.game.id === 12 || games[0]?.game.id === 13 ? 'margin-top: 7rem' : ''" :class="games[0]?.game.id !== 12 && games[0]?.game.id !== 13 ? 'mt-1' : ''" class="container-fluid d-flex justify-content-center">
            <CheckButt v-if="adult" :idGame="games[0]?.game.id" @changeValue="changeValue" v-bind:list1="list1" v-bind:list2="list2" v-bind:list3="list3" v-bind:list4="list4" v-bind:categories="categories"/>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import draggable from "vuedraggable"
import DragPlace from '@/components/global/DragPlace.vue';
import DragWord from '@/components/global/DragWord.vue'
import CheckButt from '@/components/global/CheckButt.vue'
import ModalFirst from '@/components/global/ModalFirst.vue'
import ModalEnd from '@/components/global/ModalEnd.vue'
import {toRef} from "vue";
export default {
  components: {
    draggable, DragPlace, DragWord, CheckButt, ModalFirst, ModalEnd
  },
  data() {
    return {
        // Для бухгалтеров - id:12
        endGame12: false,
        gameTask: false,
        expenses: '',
        income: '',
        profit: '',
        rightExpenses: 0,
        rightIncome: 0,
        rightProfit: 0,
        checkProfit: '',
        // Описание

        description:'',
        twoDescription: '',

        // Отображающиеся слова
        list1: [],
        list2: [],
        list3: [],
        list4: [],

        //   Число верных ответов
        count:0,

        //   Запрос
        games:[],
        length:0,

        //   Категории
        cat1:'',
        cat2:'',
        cat3:'',
        cat4:'',
        categories:[],
        words:[],

        //   CSS file
          path:'',
          arrayStyle:[],

        //   Проверка
        children: false,
        adult: false,
        modal: false,
        // Кол-во элементов
        two:false,
        three:false,
        four:false,
        titleCat:'',

        prevLink: '',
    };
  },
  methods: {
      toRef,
      getGames(id){
          this.prevLink = document.referrer
          axios.get(`${import.meta.env.VITE_API_URL}/api/game/${id}`).then(res => {
              this.games = res.data;
              this.titleCat = this.games[0].game.title;
              this.description = this.games[0].game.description
              if (this.games[0]?.game.id === 12){
                  this.description = this.games[0].game.description.split('1.')[0] + '<br>' + (this.games[0].game.description.split('1.')[1]).split('2.')[0]
                  this.twoDescription = this.games[0].game.description.split('1.')[0] + '<br>' + (this.games[0].game.description.split('1.')[1]).split('2.')[1]
              }
              console.log(this.description, this.twoDescription)
              this.path = this.games[0].game.style_id.path;
              this.cat1 = this.games[0].category.title;
              this.cat2 = this.games[1].category.title;
              if(this.games.length === 3){ this.cat3 = this.games[2].category.title}
              if(this.games.length === 4){ this.cat3 = this.games[2].category.title;this.cat4 = this.games[3].category.title}

              this.games.forEach(element => {
                  this.categories.push(element.category_id);
              });

              this.games.forEach(element => {
                  element.category_id.forEach(elem => {
                      this.words.push(elem);
                  });
              });
              this.length = this.words.length;
              this.words.sort(()=> Math.random() - 0.5);
              if(this.games[0].game.button === 'false'){
                  this.children = true;
                  this.adult = false;
              } else if(this.games[0].game.button === 'true'){
                  this.children = false;
                  this.adult = true;
              }

              setTimeout(() => {
                  if(this.categories.length === 2){
                      this.two = true;
                  } else if(this.categories.length === 3){
                      let block = document.querySelector('.third');
                      block.classList.add('threeBlocks');
                      document.querySelector('.DragPlaces').classList.add('addMr');
                      block.insertAdjacentElement("beforeEnd",block.firstChild.firstChild);
                      block.lastChild.classList.add("borderForThree");
                      this.three = true;
                      block.firstChild.firstChild.classList.add("justif");
                  } else{
                      this.four = true;
                  }
              }, 50);
          });
          console.log(this.words)
      },
      CreateCss(id){
        axios.get(`${import.meta.env.VITE_API_URL}/api/gamed/${id}`).then(res => {
            this.arrayStyle = res.data;
            let css = document.createElement( "link" );
            css.href = `${import.meta.env.VITE_API_URL}${this.arrayStyle.style.path}`;
            css.type = "text/css";
            css.rel = "stylesheet";
            css.media = "screen,print";
            document.head.appendChild(css)
            setTimeout(() => {
              document.querySelector(".loading").classList.add('closeLoading');
            }, 3000);
          });
        },
      changeValue(value, idGame){
          if (this.gameTask){
              this.checkProfit = this.rightProfit === Number(this.profit)
              console.log(this.$refs.dragPlaceOne.checkAnswer(), this.$refs.dragPlaceTwo.checkAnswer())
              if (this.$refs.dragPlaceOne.checkAnswer() && this.$refs.dragPlaceTwo.checkAnswer() && this.checkProfit){
                  this.modal = true
                  this.endGame12 = true
              }
          }else {
              if (idGame === 12 && value === 14) {
                  this.modal = true;
                  this.list1.forEach((item) => {
                      this.rightIncome += Number(item.price)
                  })
                  this.list2.forEach((item) => {
                      this.rightExpenses += Number(item.price)
                  });
                  this.rightProfit = this.rightIncome - this.rightExpenses
              }else if(idGame === 13 && value === 13){
                  this.modal = true;
                  this.list1.forEach((item) => {
                      this.rightIncome += Number(item.price)
                  })
                  this.list2.forEach((item) => {
                      this.rightExpenses += Number(item.price)
                  });
                  this.rightProfit = this.rightIncome + this.rightExpenses
              }else if (idGame !== 13 && idGame !== 12){
                  this.count = value;
                  if(this.words.length === 0){
                      // axios.post("http://192.168.10.53:7171/user/points", {teamName: new URL(location.href).searchParams.get("teamName"), points: this.count});
                      this.modal = true;
                      this.arrayStyle = [];
                  }
              }
          }
        },

      gameTaskFun(){
          this.gameTask = true;
          this.modal = false;
          const diag = document.querySelector(".modal-container");
          diag.classList.remove("d-none");
          setTimeout(() => {
              document.querySelector(".loading").classList.add('closeLoading');
          }, 3000);
      }
  },
  mounted() {
      this.CreateCss(this.$route.params.id);
      this.getGames(this.$route.params.id);
  },
};
</script>
<style>
</style>
