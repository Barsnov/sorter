<template>
    <div class="d-flex align-items-center justify-content-center" :class="adult ? 'blockBtn' : ''" style="position: absolute;
    text-align: center; z-index:500; width:240px; height:15rem;">
        <draggable
            :class="dragWordVisible === true ? 'list-group-word border p-2': ''"
            class="w-100 bgListWord"
            :list="words"
            :group="{ name: 'people', put: false }"
            itemKey="name"
        >
            <!-- style="    max-height:100%" -->
            <template #item="{ element }">
                <div @touchstart.passive="dragWordVisible = !dragWordVisible" @touchend.passive="dragWordVisible = !dragWordVisible" class="list-group-item-word rounded text-white" :id="`element_${element.id}`"
                     :class="element.img ? 'noBorder' : ''">
                    <img v-if="element.img" :src="link + element.img" alt="" class="img">
                    <p class="w-100 h-100 m-0 text-center text-black">{{ element.title }}</p>
                </div>
            </template>
        </draggable>
    </div>
</template>

<script>
import draggable from "vuedraggable"

export default {
    data() {
        return {
            link: '',
            out: false,
            dragWordVisible: true
        }
    },
    components: {
        draggable
    },
    props: {
        idGame: {
            type: Number,
            default: 0,
            required: true
        },
        words: {
            type: Array
        },
        adult: {
            type: Boolean
        }

    },
    methods: {
        loading() {
            this.words.forEach((item)=>{
                item.classCorrect = ''
                if(this.idGame === 12 || this.idGame === 13){
                    let arrayData = item.title.split(';')
                    item.title = arrayData[0]
                    item.price = arrayData[1]
                }
            });
            console.log(this.words)
            for (let i = 0; i < this.words.length; i++) {
                if (this.words[i] !== this.words[0]) {
                    let word = document.getElementById(`element_${this.words[i].id}`);
                    word.classList.add('d-none');
                }
            }
        },
    },
    mounted() {
        this.loading();
        this.link = import.meta.env.VITE_API_URL;
    }
}
</script>
