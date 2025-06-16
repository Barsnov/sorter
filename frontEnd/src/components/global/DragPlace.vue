<template>
    <div class="dragplace col-6 border rounded" style="background-color: rgba(38, 38, 38, .2)">
        <div class="col-12 p-0 m-0 d-flex justify-content-start flex-column align-items-center"
             :class="two ? 'two' : three ? 'three' : four ? 'four' : ''">
            <div class="dragplaceCat rounded-top col-12 d-flex align-items-center justify-content-center"
                 style="background-color: rgb(82, 99, 133); padding: 1rem 0; border: 2px solid white;">
                <h3 class="cat m-0 py-2 d-flex align-items-center justify-content-center text-center text-white">
                    {{ cat }}
                </h3>
            </div>
            <draggable v-if="!gameTask"
                class="list-group p-2 h-100 container-fluid mt-3"
                :group="{ name: 'people', put: true }"
                itemKey="name"
                ghost-class="ghost"
                :empty-insert-threshhold="1500"
                :list="list1"
                @change="log">
                <template #item="{ element }">
                    <div class="list-group-item lgi col-12 border-2" :id="`element_${element.id}`"
                         :class="element.img ? 'bord' : '', three ? 'lg-min' : '',
                          element.classCorrect !== '' ? (element?.classCorrect === true ? 'right' : 'wrong') : ''">
                        <img v-if="element.img" :src="link + element.img" alt="" class="img-enter">
                        <p class="w-100 h-100 p-0 m-0 d-flex align-items-center justify-content-center text-center"
                           v-else>{{ element.title }}</p>
                    </div>
                </template>
            </draggable>

            <draggable v-if="gameTask"
                       class="list-group p-2 h-100 container-fluid mt-3"
                       :group="{ name: 'people', put: true }"
                       itemKey="name"
                       ghost-class="ghost"
                       :empty-insert-threshhold="1500"
                       :list="list1"
                       draggable="false"
                       @change="log">
                <template #item="{ element }">
                    <div class="col-12" :id="`element_${element.id}`">
                        <div class="d-flex gap-2">
                            <p style="height: 3.5rem" :class="element.img ? 'bord' : '', three ? 'lg-min' : '',
                                element.classCorrect !== '' ? (element?.classCorrect === true ? 'right' : 'wrong') : ''" class="list-group-item text-white w-100 p-0 m-0 d-flex align-items-center justify-content-center text-center border px-4 py-2">{{ element.title }}</p>
                            <div class="list-group-item py-2 border-1 border border-white rounded text-center d-flex flex-column justify-content-center" style="width: 8rem; height: 3.5rem"
                            :class="element.classCorrect !== '' ? (element?.classCorrect === true ? 'right' : 'wrong') : ''">
                                <p class="m-0 fw-bold text-white">{{element.price}}</p>
                            </div>
                        </div>
                    </div>
                </template>
            </draggable>

            <div v-if="gameTask" class="">
                <div v-if="expenses === false" class="list-group-item px-3 py-3 fs-5 border border-white gap-3 d-flex align-items-center rounded px-3 py-2 mt-2">
                    <label class="form-label mb-0" v-if="idGame === 12">Доходы</label>
                    <label class="form-label mb-0" v-if="idGame === 13">Услуги</label>
                    <input type="number" class="fs-4 form-control" :class="checkIncome !== '' ? (checkIncome ? 'right' : 'wrong') : ''" :value="income"
                           @input="this.$emit('update:income', $event.target.value)">
                </div>
                <div v-else class="list-group-item px-3 py-3 fs-5 border border-white gap-3 d-flex align-items-center rounded px-3 py-2 mt-2">
                    <label class="form-label mb-0" v-if="idGame === 12">Расходы</label>
                    <label class="form-label mb-0" v-if="idGame === 13">Материальные ценности</label>
                    <input type="number" class="fs-4 form-control" :class="checkExpenses !== '' ? (checkExpenses ? 'right' : 'wrong') : ''" :value="expenses"
                           @input="this.$emit('update:expenses', $event.target.value)">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable"
import game from "../../views/Game.vue";

export default {
    components: {
        draggable
    },
    data() {
        return {
            link: '',
            ctLenght: 0,
            checkExpenses: '',
            checkIncome: '',
        }
    },
    props: {
        expenses:{default: false},
        income:{default: false},
        rightExpenses:{},
        rightIncome:{},

        gameTask:{
            type: Boolean,
            default: false,
            required: true
        },

        list1: {
            type: Array
        },
        idGame: {
            type: Number,
            default: 0,
            required: true
        },
        cat: {
            type: String
        },
        children: {
            type: Boolean,
            default: false
        },
        categories: {
            type: Array
        },
        length: {
            type: Number,
        },
        two: {
            type: Boolean
        },
        three: {
            type: Boolean
        },
        four: {
            type: Boolean
        },
    },
    methods: {
        log(event) {
            if (event.removed) {
                document.querySelector(".list-group-word")?.classList.remove("blockWord")
            }

            if (this.idGame === 12 || this.idGame === 13){
                if(event.added?.element){
                    event.added.element.classCorrect = '';
                }
            }
        },

        checkAnswer(){
            if (this.rightExpenses === false){
                this.checkIncome = Number(this.income) === Number(this.rightIncome);
                return !!this.checkIncome;
            }else{
                this.checkExpenses = Number(this.expenses) === Number(this.rightExpenses);
                return !!this.checkExpenses;
            }
        }

    },
    computed: {
        game() {
            return game
        },
        list() {
            return [...this.list1];
        }
    },
    mounted() {
        this.link = import.meta.env.VITE_API_URL;
    }
}
</script>
