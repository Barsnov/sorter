<template>
    <button @click="CheckResult" v-if="idGame !== 12 && idGame !== 13" class="checkBtn w-25" style="height:80px; font-size:32px; border-radius: 7px;">Проверить</button>
    <button @click="checkDragPlace" v-if="idGame === 12 || idGame === 13" class="checkBtn w-25" style="height:80px; font-size:32px; border-radius: 7px;">Проверить</button>
</template>
<script>
export default {
    emits: ['changeValue'],
    props:{
        list1:{
            type:Array
        },
        list2:{
            type:Array
        },
        list3:{
            type:Array
        },
        list4:{
            type:Array
        },
        categories:{
            type:Array
        },

        idGame: {
            type: Number,
            required: true
        }
    },
    data(){
        return{
            count:0,
        }
    },
    methods:{
        checkDragPlace(){
            if(this.list1.length !== 0){
                this.list1.forEach(element => {
                    element.classCorrect = !!this.categories[0].includes(element);
                });
            }
            if(this.list2.length !== 0){
                this.list2.forEach(element => {
                    element.classCorrect = !!this.categories[1].includes(element);
                });
            }
            this.count = 0
            this.list1.forEach((item)=>{
                if(item.classCorrect === true){
                    this.count ++
                }
            });
            this.list2.forEach((item)=>{
                if(item.classCorrect === true){
                    this.count ++
                }
            });
            this.$emit("changeValue", this.count, this.idGame);
        },

        CheckResult(){
            if(this.list1.length !== 0){
                this.list1.forEach(element => {
                     if(this.categories[0].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');
                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');
                     }
                });
            }
            if(this.list2.length !== 0){
                this.list2.forEach(element => {
                     if(this.categories[1].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');

                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');

                     }
                });
            }
            if(this.list3.length !== 0){
                this.list3.forEach(element => {
                     if(this.categories[2].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');

                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');

                     }
                });
            }
            if(this.list4.length !== 0){
                this.list4.forEach(element => {
                     if(this.categories[3].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');

                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');

                     }
                });
            }


            this.count = document.querySelectorAll('.right-btn').length;
            this.$emit("changeValue", this.count, this.idGame);
    }
}
}
</script>
