<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;"
                            v-if="(length === count && children === false && idGame !== 12) && (length === count && children === false && idGame !== 13)">
                            Победа!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;"
                            v-else-if="(children === false && count !== 0 && idGame !== 12) && (children === false && count !== 0 && idGame !== 13)">
                            Поздравляем!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;"
                            v-else-if="(children === false && idGame !== 12) && (children === false && idGame !== 13)">
                            Сожалеем!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-else-if="idGame !== 12 || idGame !== 13">
                            Поздравляем!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-else-if="(idGame === 12 || idGame === 13) && endGame12 === false">
                            Успешно!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-else>
                            Вы отлично справились с заданием!
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p class="modalText" v-if="(length === count && children === false || children === true) && idGame !== 12">
                            Вы распределили всё правильно!
                        </p>
                        <p class="modalText" v-else-if="(children === true && idGame !== 12) && (children === true && idGame !== 13)  && (children === true && idGame !== 14)">
                            Вы верно распределили {{ count }} из {{ length }} элемента(ов)
                        </p>
                        <p class="modalText" v-else-if="idGame !== 12 && idGame !== 13 && idGame !== 14">
                            Вы верно распределили {{ count }} из {{ length }} элемента(ов)
                        </p>
                        <p class="modalText" v-else-if="(idGame === 12 && idGame!==13 && idGame !==14) && endGame12 === true">
                            Вы верно распределили доходы и расходы предприятия
                        </p>
                        <p class="modalText" v-else-if="(idGame !== 12 && idGame !==14 && idGame === 13) && endGame12 === true">
                            Вы верно распределили услуги и материальные ценности
                        </p>
                        <p class="modalText" v-else-if="(idGame === 14 && idGame !== 12 && idGame!==13)">
                            Сочетание профессиональных знаний и навыков с перечисленными личностными качествами позволяет бухгалтеру достигать высоких результатов в своей карьере
                            и становится незаменимым специалистом для любой организации.
                            <br><br>
                            Вы верно распределили {{ count }} из {{ length }} элемента(ов)
                        </p>
                    </div>


                    <div v-if="(prevLink === 'http://sorter.sfera.local' || prevLink === '') && (idGame !== 12 && idGame !== 13)" class="modal-footer d-flex justify-content-center">
                        <button @click="emitToParentWindow" class="btn btnModal"
                                style="font-size:20px; width: 75% !important;">Вернуться на главную</button>
                    </div>
                    <div v-else-if="(prevLink === 'http://sorter.sfera.local' || prevLink === '') && (idGame === 12 || idGame === 13) && (endGame12 === true)" class="modal-footer d-flex justify-content-center">
                        <button @click="emitToParentWindow" class="btn btnModal"
                                style="font-size:20px; width: 75% !important;">Вернуться на главную</button>
                    </div>
                    <div v-else-if="(idGame === 12 || idGame === 13) && !endGame12" class="modal-footer d-flex justify-content-center">
                        <button @click="newTaskGame" class="btn btnModal"
                                style="font-size:20px; width: 75% !important;">Перейти к следующему заданию</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import router from "@/router/index.js";
import {kindergartenLink} from "@/main.js";

export default {
    props: {
        prevLink:{
            type: String,
            required: true
        },
        endGame12:{
            type: Boolean,
            required: true,
            default: false
        },
        idGame: {
            type: Number,
            default: 0,
            required: true
        },
        modal: {
            type: Boolean,
        },
        count: {
            type: Number
        },
        length: {
            type: Number
        },
        children: {
            type: Boolean
        }
    },
    data () {
        return {

        }
    },
    methods: {
        kindergartenLink() {
            return kindergartenLink
        },
        emitToParentWindow() {
            console.log(this.prevLink)
            if (this.prevLink === "") {
                router.push({name: "home"})
            } else {
                window.location.href = this.prevLink;
            }
        },

        newTaskGame(){
            this.$emit('gameTask')
        }
    },
}
</script>
