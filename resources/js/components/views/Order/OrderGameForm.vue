<template>
    <div class="p-4">
        <div class="mb-2 pb-2 w-auto">Game</div>
        <div class="md:flex items-center pb-2 mb-2">

            <select
                v-model="gameGroupID"
                class="form-select appearance-none mr-4 form-control block mb-2 md:mb-0 w-full md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                <option v-for="group in gameGroupsList" v-bind:value="group.id">{{ group.title }}</option>
            </select>

            <select
                id="games"
                name="game"
                v-model="gameForm.orderable"
                class="form-select appearance-none mr-4 form-control block mb-2 md:mb-0 w-full px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                <option v-for="games in gamesList" v-bind:value="games.id">{{ games.title }}</option>
            </select>

            <div @click="submitGameOrder"
                 class="w-full md:w-1/6 mb-2 md:mb-0 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                Start
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: 'OrderGameForm',
    props: ['basket'],
    data() {
        return {
            gameGroupID: null,
            gamesList: null,
            gameGroupsList: null,
            gameForm: {
                orderable: null,
                type: "game",
            }
        }
    },
    watch: {
        gameGroupID() {
            this.getGames();
        }
    },
    created() {
        this.getGamesGroupsList();
    },
    methods: {
        getGamesGroupsList() {
            axios.get('groups', {params: {type: 'game'}})
                .then((res) => {
                    this.gameGroupsList = res.data.data;
                })
        },
        async getGames() {
            await axios.get('games', {params: {group: this.gameGroupID}})
                .then((res) => {
                    this.gamesList = res.data.data;
                })
        },
        submitGameOrder() {
            axios.post(this.basket + '/orders', this.gameForm)
                .then((res) => {
                    this.$emit('updateGame');
                })
        }
    }
}
</script>
