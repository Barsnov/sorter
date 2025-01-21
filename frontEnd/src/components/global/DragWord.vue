<template>
    <div class="d-flex align-items-center justify-content-center" :class="adult ? 'blockBtn' : ''" style="position: absolute;
    text-align: center; z-index:500; width:240px; height:15rem;">
        <draggable
            class="list-group-word border p-2 w-100 bgListWord"
            :list="words"
            group="people"
            itemKey="name"
            @change="log"
            @move="Moving"
        >
            <!-- style="max-height:100%" -->
            <template #item="{ element }">
                <div class="list-group-item-word rounded text-white" :id="`element_${element.id}`"
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
        }
    },
    components: {
        draggable
    },
    props: {
        words: {
            type: Array
        },
        adult: {
            type: Boolean
        }

    },
    methods: {
        log(event) {
            if (event) {
                document.querySelector('.list-group-word').classList.remove('blockingList');
            }
            for (let i = 0; i < this.words.length; i++) {
                if (this.words[i] != this.words[0]) {
                    let word = document.getElementById(`element_${this.words[i].id}`);
                    word.classList.add('d-none');
                }
            }
        },
        Moving(event) {
            if (event) {
                // console.log(document.querySelector('list-group-word'));
                document.querySelector('.list-group-word').classList.add('blockingList');
            }
        },
        loading() {
            for (let i = 0; i < this.words.length; i++) {
                if (this.words[i] != this.words[0]) {
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
